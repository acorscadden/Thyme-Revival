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


  function _is_writeable ($fl)
  {
    return @fopen ($fl, 'r+');
  }

  function sysinfo ()
  {
    ob_start ();
    @phpinfo (INFO_GENERAL);
    $php_info = ob_get_contents ();
    ob_end_clean ();
    foreach (split ('
', $php_info) as $line)
    {
      if (eregi ('\\(php.ini\\).*(</B></td><TD ALIGN="left">| => |v">)([^ <]*)(.*</td.*)?', $line, $match))
      {
        define ('_PHP_INI_', $match[2]);
        if (!@file_exists ($php_ini_path))
        {
          $php_ini_path = '';
          continue;
        }

        continue;
      }
    }

    define ('_APACHE_', preg_match ('/Apache/i', $_SERVER['SERVER_SOFTWARE']));
    define ('_WIN32_', substr (strtolower (PHP_OS), 0, 3) == 'win');
  }

  header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header ('Last-Modified: ' . gmdate ('D, d M Y H:i:s') . ' GMT');
  header ('Cache-Control: post-check=0, pre-check=0', false);
  header ('Pragma: no-cache');
  set_magic_quotes_runtime (0);
  error_reporting (E_ALL ^ E_NOTICE);
  $_REQUEST = $GLOBALS['_REQUEST'] = array_merge ($_GET, $_POST);
  @define ('_CAL_BASE_PATH_', @dirname (__FILE__) . '/');
  sysinfo ();
  if (!defined ('PATH_SEPARATOR'))
  {
    if (@constant ('_WIN32_'))
    {
      @define ('PATH_SEPARATOR', ';');
    }
    else
    {
      @define ('PATH_SEPARATOR', ':');
    }
  }

  ini_set ('include_path', '.' . PATH_SEPARATOR . dirname (__FILE__) . PATH_SEPARATOR . ini_get ('include_path'));
  if ($_SERVER['HTTP_REFERER'])
  {
    $BASE_URL = dirname ($_SERVER['HTTP_REFERER']) . '/';
  }

  define ('_CAL_BASE_URL_', $BASE_URL);
  if (@constant ('_WIN32_'))
  {
    define ('_PERMISSIONS_', ' make sure the file/directory is writable
    by ISSUR ');
    define ('_PATHSEP_', '\\');
  }
  else
  {
    define ('_PERMISSIONS_', ' chmod 666 ');
    define ('_PATHSEP_', '/');
  }

  if (get_magic_quotes_gpc ())
  {
    foreach (array_keys ($_REQUEST) as $key)
    {
      if (is_array ($_REQUEST[$key]))
      {
        $_REQUEST[$key] = array_map ('stripslashes', $_REQUEST[$key]);
        continue;
      }

      $_REQUEST[$key] = stripslashes ($_REQUEST[$key]);
    }
  }

  define ('_ERROR_', 'Error');
  global $_cal_form;
  global $_cal_html;
  global $this_ver;
  global $_cal_config;
  global $_cal_user;
  require _CAL_BASE_PATH_ . 'INSTALL/parse_config.php';
  $_cal_user->options->orrientation = '_LEFT_';
  $this_ver = '1.3';
  require _CAL_BASE_PATH_ . 'INSTALL/class.html.php';
  require _CAL_BASE_PATH_ . 'include/classes/class.form.php';
  $_cal_html = new html ();
  $_cal_form = new _cal_form ('instfrm');
  $_cal_html->print_header ('Thyme Installation' . (isset ($_REQUEST['faq']) ? ' Guide' : ''));
  $_cal_form->print_header ();
  $_cal_html->adv ();
  _ex_content_header ();
  $step = $_REQUEST['step'];
  if ($_REQUEST['action'] == 'Next')
  {
    ++$step;
  }

  if ($_REQUEST['action'] == 'Previous')
  {
    $step = (1 < $step ? $step - 1 : '');
  }

  if (($_REQUEST['action'] == 'Continue' OR $_REQUEST['action'] == 'Previous'))
  {
    $ignore_errors = 1;
  }

  $finish = $_REQUEST['action'] == 'Finish';
  unset ($_REQUEST[action]);
  unset ($_REQUEST[step]);
  echo '<table width=\'100%\' cellpadding=8 style=\'border-left: 2px solid black; padding: 0px; border-right: 2px solid black;\'>
<tr>
   <td>
';
  clearstatcache ();
  $_cal_config_file = 'include/config.php';
  $step_file = 'INSTALL/step' . $step . '.php';
  if (!_is_writeable ($_cal_config_file))
  {
    $fh = @fopen ($_cal_config_file, 'a');
    @fclose ($fh);
    @chmod ($_cal_config_file, 438);
  }

  require_once _CAL_BASE_PATH_ . 'INSTALL/tests.php';
  if (isset ($_REQUEST['faq']))
  {
    $_cal_html->print_heading ('Installation Guide');
    require _CAL_BASE_PATH_ . 'INSTALL/install_guide.php';
  }
  else
  {
    if (((!isset ($_REQUEST['tested']) AND !$ignore_errors) AND !$step))
    {
      $_cal_html->print_heading ('Checking Your Configuration');
      echo '<div align=\'center\'><br><br>';
      echo '<img src=\'images/progress_bar.gif\'><br><br></div>
';
      $_cal_html->js_onload[] = 'setTimeout(\'document.location="install.php?tested=1"\', 2000);';
    }
    else
    {
      if (isset ($_REQUEST['tested']))
      {
        $_cal_html->print_heading ('Checking Your Configuration');
        if (count ($errors))
        {
          echo 'The configuration check produced the following errors:<br><br>
';
          echo '<ul>
';
          foreach ($errors as $err)
          {
            echo '<li>' . $err . '<br><br>';
          }

          echo '</ul>
';
        }

        if (count ($warnings))
        {
          echo 'The configuration check produced the following warnings:<br><br>
';
          echo '<ul>
';
          foreach ($warnings as $err)
          {
            echo '<li>' . $err . '<br><br>';
          }

          echo '</ul>
';
        }
        else
        {
          if (!count ($errors))
          {
            echo 'Your configuration passed all tests. Click \'Continue\' below to proceed with
            the installation.<br><br>';
          }
        }

        if ((count ($errors) OR count ($warnings)))
        {
          echo 'For more information on these messages and how to correct them,
                please see the the Installation Guide (link at this page\'s footer).
                Please do not reload this page
                via your web browser. Use the \'Retry\' button instead.<br><br>';
        }

        echo '<table cellpadding=5>
        <tr class=\'' . _CAL_CSS_TOOLBAR_ . '\'>
            <td align=\'center\'>';
        if ((count ($errors) OR count ($warnings)))
        {
          echo $_cal_form->submit ('action', 'Retry', 'style=\'width: 80px\'') . ' ';
        }

        if (!count ($errors))
        {
          echo $_cal_form->submit ('action', 'Continue', 'style=\'width: 80px\'');
        }

        echo '</td>
</tr>
</table>
';
      }
      else
      {
        if (!_is_writeable ($_cal_config_file))
        {
          echo '<h3>Error</h3><br><br>';
          echo 'The file <b>' . $_cal_config_file . '</b> is not writable
        by your web server.
        Please make sure this file exists and change the permissions.  E.g. ';
          if (@constant ('_WIN32_'))
          {
            echo 'give the Internet Guest Account (probably IUSR_' . getenv ('COMPUTERNAME') . ') permission to modify the file.';
          }
          else
          {
            echo 'chmod 666 config.php.';
          }

          echo '<br><br>';
          $_cal_form->dump_request ();
          echo '<div align=\'center\'>' . $_cal_form->submit ('action', 'Retry') . '</div>
';
        }
        else
        {
          if ($finish)
          {
            require_once _CAL_BASE_PATH_ . 'INSTALL/finish.php';
          }
          else
          {
            if (!is_readable ($step_file))
            {
              echo '<h3>Error</h3><br><br>';
              echo 'The file <b>' . $step_file . '</b> could not be opened.
	Please ensure that it is readable by your web server. Also be sure to 
	check permissions on
        the INSTALL directory itself.<br>';
              $_cal_form->dump_request ();
              echo '<div align=\'center\'>' . $_cal_form->submit ('action', 'Retry') . '</div>
';
            }
            else
            {
              if (1 < $step)
              {
                require _CAL_BASE_PATH_ . 'INSTALL/step' . ($step - 1) . '.php';
                if (($ignore_errors OR $errno = call_user_func ('check_step' . ($step - 1)) == 1))
                {
                  require _CAL_BASE_PATH_ . 'INSTALL/step' . $step . '.php';
                  call_user_func ('step' . $step);
                }
                else
                {
                  echo '<br><br>Step ' . ($step - 1) . ' <font color=\'red\'><b>failed</b></font><br><br>';
                  echo 'You may go back and try to correct this failure by clicking <b>Previous</b>.';
                  if ($errno == 0)
                  {
                    echo ' To
                ignore any errors and continue, you may cilck <b>Continue</b>, however, 
                Thyme may not install properly.';
                  }

                  echo ' If the installation continues to fail on this
                error and will not install properly, you may have to manually perform this step.
                Please review the Installation Guide for more
                information.<br><br>';
                  $_REQUEST['step'] = $step;
                  $_cal_form->dump_request ();
                  echo '<table cellpadding=5>
<tr class=\'' . _CAL_CSS_TOOLBAR_ . '\'>
<td align=\'center\'>
';
                  echo $_cal_form->submit ('action', 'Previous', 'style=\'width: 80px;\'');
                  if ($errno == 0)
                  {
                    echo ' ' . $_cal_form->submit ('action', 'Continue', 'style=\'width: 80px;\'');
                  }

                  echo '</td>
</tr>
</table>
';
                }
              }
              else
              {
                require _CAL_BASE_PATH_ . 'INSTALL/step' . $step . '.php';
                call_user_func ('step' . $step);
              }
            }
          }
        }
      }
    }
  }

  echo '   </td>
 </tr>
</table>
';
  if (isset ($_REQUEST['faq']))
  {
    $faq = array ();
  }
  else
  {
    $faq = array ('<a
        href=\'install.php?faq\'
        class=\'main_header\' target=\'_new\'>Installation Guide</a>');
  }

  _ex_content_footer ($faq);
  $_cal_form->print_hidden ('step', $step);
  $_cal_form->print_footer ();
  $_cal_html->print_footer ();
?>