<?php

//
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 eXtrovert Software and Thymenews                  |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@thymenews.com.                                               |
// +----------------------------------------------------------------------+
//


  function check_step2 ()
  {
    global $_cal_form;
    global $_cal_config;
    if (!$_REQUEST['subact'])
    {
      return true;
    }

    $_REQUEST['db_pref'] = trim ($_REQUEST['db_pref']);
    if (($_cal_config['existing_prefix'] AND strtolower ($_cal_config['existing_prefix']) == strtolower ($_REQUEST['db_pref'])))
    {
      $_REQUEST['db_pref'] = 'thyme_';
    }

    define ('_CAL_DBHOST_', $_REQUEST['db_host']);
    define ('_CAL_DBPORT_', $_REQUEST['db_port']);
    define ('_CAL_DBUSER_', $_REQUEST['db_user']);
    define ('_CAL_DBPASS_', $_REQUEST['db_pass']);
    define ('_CAL_DBNAME_', $_REQUEST['db_name']);
    define ('_CAL_DBPREFIX_', $_REQUEST['db_pref']);
    define ('_CAL_SQL_DRIVER_', $_REQUEST['db_driver']);
    require_once 'include/classes/class.sql.php';
    $s = new _cal_sql ();
    if (!$s->_connected)
    {
      return false;
    }

    require_once 'INSTALL/detect_version.php';
    $s->quiet = true;
    $version = detect_version ($s);
    $s->quiet = false;
    if ($version == $GLOBALS['this_ver'])
    {
    }

    if ($_REQUEST['subact'] == 'upgrade')
    {
      require_once 'INSTALL/detect_version.php';
      list ($ver_from) = explode (' ', detect_version ($s));
      list ($ver_to) = explode (' ', $GLOBALS['this_ver']);
      $i = $ver_from;
      while ($i < $ver_to)
      {
        $ufile = $BASE_PATH . 'INSTALL/sql/upgrade.' . $i . '-' . ($i + 0.0100000000000000002081668) . '.' . _CAL_SQL_DRIVER_;
        if (!is_readable ($ufile))
        {
          continue;
        }

        if (!$fh = fopen ($ufile, 'r'))
        {
          exit ('error opening upgrade file ' . $ufile . '<br>
');
        }

        $contents = fread ($fh, filesize ($ufile));
        fclose ($fh);
        $cmds = preg_split ('/;[
|
]+/', $contents);
        $cmds = array_map ('trim', $cmds);
        foreach ($cmds as $cmd)
        {
          if (!strlen ($cmd))
          {
            continue;
          }

          $res = $s->query ($cmd);
          if (!$res)
          {
            $failed = 1;
            continue;
          }
        }

        $i += 0.0100000000000000002081668;
      }

      return !$failed;
    }

    if ($_REQUEST['subact'] == 'install')
    {
      if (_CAL_SQL_DRIVER_ == 'mssql')
      {
        $s->query ('exec sp_dboption \'' . _CAL_DBNAME_ . '\', \'quoted identifier\', \'on\'');
      }

      $_cal_form->print_hidden ('sql_new_install', 1);
      $inst_file = 'INSTALL/sql/install.' . @constant ('_CAL_SQL_DRIVER_');
      if (@constant ('_CAL_SQL_DRIVER_') == 'mysql')
      {
        $res = @mysql_query ('show tables');
        $tables = @mysql_fetch_row ($res);
        mysql_free_result ($res);
        if ((!is_array ($tables) OR !count ($tables)))
        {
          mysql_query ('ALTER DATABASE ' . @constant ('_CAL_DBNAME_') . ' CHARACTER SET latin1;');
        }
      }

      $failed = 0;
      if (!$fh = fopen ($inst_file, 'r'))
      {
        exit ('error opening install file ' . $inst_file . '<br>
');
      }

      $contents = fread ($fh, filesize ($inst_file));
      fclose ($fh);
      $contents = str_replace ('_db_pref_', _CAL_DBPREFIX_, $contents);
      list ($contents, $triggers) = preg_split ('/-+\\sBEGIN TRIGGERS -+\\s/', $contents);
      $cmds = preg_split ('/;[
|
]+/', $contents);
      $me = $contents;
      $inst_file = 'INSTALL/sql/post-install.sql';
      if (!$fh = fopen ($inst_file, 'r'))
      {
        exit ('error opening install file ' . $inst_file . '<br>
');
      }

      $contents = fread ($fh, filesize ($inst_file));
      fclose ($fh);
      if (_CAL_SQL_DRIVER_ != 'mssql')
      {
        $contents .= '
update _db_pref_Users set id = 0 where id = 2;
';
      }

      $contents = str_replace ('_db_pref_', _CAL_DBPREFIX_, $contents);
      $cmds = array_merge ($cmds, preg_split ('/;[
|
]+/', $contents));
      $cmds = array_map ('trim', $cmds);
      $first = 1;
      $rollbacks = array ();
      echo '<pre>
';
      foreach ($cmds as $cmd)
      {
        if (!strlen ($cmd))
        {
          continue;
        }

        if (preg_match ('/(?:^|
|
)create (.*?) (.*?)[\\s|\\(]/is', $cmd, $items))
        {
          if (strcasecmp ($items[1], 'index'))
          {
            $rollbacks[] = 'drop ' . $items[1] . ' ' . $items[2];
          }
        }

        $res = $s->query ($cmd);
        if (!$res)
        {
          $failed = 1;
          if ($first == 1)
          {
            $rollbacks = array ();
            break;
          }
        }

        $first = 0;
      }

      echo '</pre>
';
      if ($failed)
      {
        echo 'Install failed. Removing entities ...<br>';
        foreach ($rollbacks as $cmd)
        {
          echo '' . $cmd . '<br>';
          $s->query ($cmd);
        }

        return false;
      }

      return !$failed;
    }

  }

  function step2 ()
  {
    global $_cal_html;
    global $_cal_form;
    global $_cal_config;
    global $_cal_dbpref;
    define ('_CAL_DBHOST_', $_REQUEST['db_host']);
    define ('_CAL_DBPORT_', $_REQUEST['db_port']);
    define ('_CAL_DBUSER_', $_REQUEST['db_user']);
    define ('_CAL_DBPASS_', $_REQUEST['db_pass']);
    define ('_CAL_DBNAME_', $_REQUEST['db_name']);
    define ('_CAL_SQL_DRIVER_', $_REQUEST['db_driver']);
    define ('_CAL_DB_PREFIX_', $_REQUEST['db_pref']);
    $_cal_dbpref = _CAL_DB_PREFIX_;
    require_once 'include/classes/class.sql.php';
    $s = new _cal_sql ();
    $s->quiet = true;
    $exists = count ($s->getFields ('' . $_cal_dbpref . 'Events'));
    if ($exists)
    {
      $action = 'Upgrade';
    }
    else
    {
      $action = 'Installation';
    }

    $_cal_html->print_heading ('Step 2 :: Database Table ' . $action);
    if ($exists)
    {
      require_once 'INSTALL/detect_version.php';
      $version = detect_version ($s);
      echo '<br>Thyme has detected an existing installation.<br><br>';
      if ($version == $GLOBALS['this_ver'])
      {
        echo 'Your current database scheme is up to date. Nothing to do.<br>';
        $_cal_form->print_hidden ('subact', '');
      }
      else
      {
        echo 'This installation will upgrade from <b>' . $version . '</b>';
        echo ' to <b>' . $GLOBALS['this_ver'] . '</b><br>';
        $_cal_form->print_hidden ('subact', 'upgrade');
      }
    }
    else
    {
      echo '<br>Thyme has detected that this is a new install.<br><br>';
      if (($_cal_config['_cal_exists_'] AND $_cal_config['_CAL_DBNAME_'] != $_REQUEST['db_name']))
      {
        echo '<font class=\'hil\'>Warning:</font> ';
        echo 'It appears you have an existing configuration file that used a different
	   database name; \'<b>' . $_cal_config['_CAL_DBNAME_'] . '</b>\'. You chose the name \'<b>';
        echo $_REQUEST['db_name'] . '</b>\'. ';
        echo 'You may either go back to Step 1 and change it or rename the database
        to the name you have selected; \'<b>' . $_REQUEST['db_name'] . '</b>\'.<br><br>';
        echo 'Or you may click next to perform a new install in the \'<b>' . $_REQUEST['db_name'] . '</b>\' database. This new installation would not contain any of
          your existing events or settings (if any exist).<br><br>';
        echo 'See \'Step 2\' in the Installation Guide for more information.<br><br>';
        $button = 'Retry';
        echo '<br><br>';
      }
      else
      {
        echo 'Click \'Next\' to install tables in the \'<b>' . $_REQUEST['db_name'] . '</b>\'
	    database.';
      }

      $_cal_form->print_hidden ('subact', 'install');
    }

    echo '<br><br>
<table cellpadding=5>
<tr class=\'toolbar\'>
';
    $_cal_form->print_hidden ('db_driver');
    $_cal_form->print_hidden ('db_host');
    $_cal_form->print_hidden ('db_port');
    $_cal_form->print_hidden ('db_user');
    $_cal_form->print_hidden ('db_pass');
    $_cal_form->print_hidden ('db_pref');
    $_cal_form->print_hidden ('db_name');
    if ($button)
    {
      echo '<td align=\'center\'>' . $_cal_form->submit ('action', $button, 'style=\'width: 80px;\'') . '</td>';
    }

    echo '  <td align=\'center\'>
';
    echo $_cal_form->submit ('action', 'Previous', ' style=\'width: 80px;\'');
    echo '
';
    echo $_cal_form->submit ('action', 'Next', ' style=\'width: 80px;\'');
    echo '</tr>
</table>

';
  }

  echo '
';
?>