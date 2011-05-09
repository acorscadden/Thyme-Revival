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


  global $_cal_config;
  $BASE_PATH = preg_replace ('' . '/.INSTALL$/', '', dirname (__FILE__)) . '/';
  if (20 < @filesize ($BASE_PATH . 'include/config.php'))
  {
    $conf_file = $BASE_PATH . 'include/config.php';
    $_cal_config['_cal_exists_'] = true;
  }

  if (!$_cal_config['_cal_exists_'])
  {
    @include '' . $BASE_PATH . '../joomla/configuration.php';
    @include '' . $BASE_PATH . '../mambo/configuration.php';
    @include '' . $BASE_PATH . '../configuration.php';
    if (class_exists ('JConfig'))
    {
      $_cal_config['_cal_exists_'] = true;
      $JConfig = new JConfig ();
      list ($host, $port) = explode (':', $JConfig->host);
      $_cal_config['_CAL_SQL_DRIVER_'] = 'mysql';
      $_cal_config['_CAL_DBNAME_'] = $JConfig->db;
      $_cal_config['_CAL_DBUSER_'] = $JConfig->user;
      $_cal_config['_CAL_DBPASS_'] = $JConfig->password;
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $JConfig->dbprefix;
      $_cal_config['source'] = 'Joomla';
      return null;
    }

    if ($mosConfig_db)
    {
      $_cal_config['_cal_exists_'] = true;
      list ($host, $port) = explode (':', $mosConfig_host);
      $_cal_config['_CAL_SQL_DRIVER_'] = 'mysql';
      $_cal_config['_CAL_DBNAME_'] = $mosConfig_db;
      $_cal_config['_CAL_DBUSER_'] = $mosConfig_user;
      $_cal_config['_CAL_DBPASS_'] = $mosConfig_password;
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $mosConfig_dbprefix;
      $_cal_config['source'] = 'Joomla! / Mambo';
      return null;
    }

    @include '' . $BASE_PATH . '../config.php';
    @include '' . $BASE_PATH . '../phpBB2/config.php';
    @include '' . $BASE_PATH . '../forums/config.php';
    @include '' . $BASE_PATH . '../forum/config.php';
    if (($dbms AND $dbname))
    {
      $_cal_config['_cal_exists_'] = true;
      list ($host, $port) = explode (':', $dbhost);
      $_cal_config['_CAL_SQL_DRIVER_'] = strtolower ($dbms);
      $_cal_config['_CAL_DBNAME_'] = $dbname;
      $_cal_config['_CAL_DBUSER_'] = $dbuser;
      $_cal_config['_CAL_DBPASS_'] = $dbpasswd;
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $table_prefix;
      $_cal_config['source'] = 'phpBB';
      return null;
    }

    if ($_DB_name)
    {
      $_cal_config['_cal_exists_'] = true;
      list ($host, $port) = explode (':', $_DB_host);
      $_cal_config['_CAL_SQL_DRIVER_'] = $_DB_dbms;
      $_cal_config['_CAL_DBNAME_'] = $_DB_name;
      $_cal_config['_CAL_DBUSER_'] = $_DB_user;
      $_cal_config['_CAL_DBPASS_'] = $_DB_pass;
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $_DB_table_prefix;
      $_cal_config['source'] = 'Geeklog';
      return null;
    }

    if (!$dbuname)
    {
      @include '' . $BASE_PATH . '../html/config.php';
      @include '' . $BASE_PATH . '../nuke/html/config.php';
    }

    if (($dbuname AND $dbname))
    {
      $_cal_config['_cal_exists_'] = true;
      list ($host, $port) = explode (':', $dbhost);
      switch (strtolower ($dbtype))
      {
        case 'postgres':
        {
          $_cal_config['_CAL_SQL_DRIVER_'] = 'pgsql';
          break;
        }

        case 'mssql':
        {
          $_cal_config['_CAL_SQL_DRIVER_'] = 'mssql';
          break;
        }

        default:
        {
          $_cal_config['_CAL_SQL_DRIVER_'] = 'mysql';
        }
      }

      $_cal_config['_CAL_DBNAME_'] = $dbname;
      $_cal_config['_CAL_DBUSER_'] = $dbuname;
      $_cal_config['_CAL_DBPASS_'] = $dbpass;
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $prefix . '_';
      if ($encoded)
      {
        $_cal_config['_CAL_DBUSER_'] = base64_decode ($_cal_config['_CAL_DBUSER_']);
        $_cal_config['_CAL_DBPASS_'] = base64_decode ($_cal_config['_CAL_DBPASS_']);
      }

      if (isset ($encoded))
      {
        $_cal_config['source'] = 'PostNuke or MDPro';
        return null;
      }

      $_cal_config['source'] = 'phpNuke';
      return null;
    }

    if (($pnconfig['dbname'] AND $pnconfig['dbtype']))
    {
      $_cal_config['_cal_exists_'] = true;
      list ($host, $port) = explode (':', $pnconfig['dbhost']);
      $_cal_config['_CAL_SQL_DRIVER_'] = 'mysql';
      $_cal_config['_CAL_DBNAME_'] = $pnconfig['dbname'];
      $_cal_config['_CAL_DBUSER_'] = $pnconfig['dbuname'];
      $_cal_config['_CAL_DBPASS_'] = $pnconfig['dbpass'];
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $pnconfig['prefix'] . '_';
      if ($pnconfig['encoded'])
      {
        $_cal_config['_CAL_DBUSER_'] = base64_decode ($_cal_config['_CAL_DBUSER_']);
        $_cal_config['_CAL_DBPASS_'] = base64_decode ($_cal_config['_CAL_DBPASS_']);
      }

      $_cal_config['source'] = 'PostNuke or MDPro';
      return null;
    }

    @include '' . $BASE_PATH . '../Settings.php';
    if ($db_server)
    {
      $_cal_config['_cal_exists_'] = true;
      list ($host, $port) = explode (':', $db_server);
      $_cal_config['_CAL_SQL_DRIVER_'] = 'mysql';
      $_cal_config['_CAL_DBNAME_'] = $db_name;
      $_cal_config['_CAL_DBUSER_'] = $db_user;
      $_cal_config['_CAL_DBPASS_'] = $db_passwd;
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $db_prefix;
      $_cal_config['source'] = 'Simple Machines Forum';
      return null;
    }

    @include '' . $BASE_PATH . '../conf/config.php';
    if (@constant ('DB_ENGINE'))
    {
      $_cal_config['_cal_exists_'] = true;
      if (DB_ENGINE == 'postgres')
      {
        $_cal_config['_CAL_SQL_DRIVER_'] = 'pgsql';
      }
      else
      {
        $_cal_config['_CAL_SQL_DRIVER_'] = 'mysql';
      }

      $_cal_config['_CAL_DBNAME_'] = DB_NAME;
      $_cal_config['_CAL_DBUSER_'] = DB_USER;
      $_cal_config['_CAL_DBPASS_'] = DB_PASS;
      $_cal_config['_CAL_DBHOST_'] = DB_HOST;
      $_cal_config['_CAL_DBPORT_'] = DB_PORT;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = DB_TABLE_PREFIX . '_';
      $_cal_config['source'] = 'Exponent';
      return null;
    }

    @include '' . $BASE_PATH . '../manager/includes/config.inc.php';
    if (($dbase AND function_exists ('startCMSSession')))
    {
      $database_type = 'mysql';
      $database_server = 'localhost';
      $database_user = 'root';
      $database_password = 'My$ql';
      $dbase = 'postnuke';
      $table_prefix = 'modx_';
      $_cal_config['_cal_exists_'] = true;
      $_cal_config['_CAL_SQL_DRIVER_'] = strtolower ($database_type);
      list ($host, $port) = explode (':', $database_server);
      $_cal_config['_CAL_DBNAME_'] = $dbase;
      $_cal_config['_CAL_DBUSER_'] = $database_user;
      $_cal_config['_CAL_DBPASS_'] = $database_password;
      $_cal_config['_CAL_DBHOST_'] = $host;
      $_cal_config['_CAL_DBPORT_'] = $port;
      $_cal_config['_CAL_DBPREFIX_'] = 'thyme_';
      $_cal_config['existing_prefix'] = $table_prefix;
      $_cal_config['source'] = 'MODx';
      return null;
    }
  }

  $conf_file = $BASE_PATH . 'include/config.php';
  if ((5 < @filesize ($conf_file) AND @is_readable ($conf_file)))
  {
    $conf_file = $BASE_PATH . 'include/config.php';
    $_cal_config['_cal_exists_'] = true;
  }
  else
  {
    $conf_file = $BASE_PATH . 'INSTALL/default-config.php';
  }

  if (!is_readable ($conf_file))
  {
    return null;
  }

  if (!$fh = fopen ($conf_file, 'r'))
  {
    return null;
  }

  while (!feof ($fh))
  {
    $line = fgets ($fh, 1024);
    if (strpos (strtolower ($line), 'define(') !== 0)
    {
      continue;
    }

    list ($def, $val) = explode (',', $line);
    $def = substr ($def, 8, strlen ($def) - 9);
    $val = trim ($val);
    if ((substr ($val, 0, 1) == '"' OR substr ($val, 0, 1) == '\''))
    {
      $quot = substr ($val, 0, 1);
      $val = substr ($val, 1, strpos (substr ($val, 1), $quot));
      if ($quot == '"')
      {
        $val = eval ('' . 'return "' . $val . '";');
      }
    }
    else
    {
      $val = substr ($val, 0, strpos ($val, ')'));
    }

    $_cal_config[$def] = $val;
  }

  $_cal_config['_cal_exists_'] = ($_cal_config['_CAL_DBNAME_'] AND $_cal_config['_cal_exists_']);
?>