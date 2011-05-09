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


  echo '<html>
<head>
<title>Test Database</title>
</head>
<body>
';
  set_magic_quotes_runtime (0);
  define ('_ERROR_', 'Error');
  $BASE_PATH = preg_replace ('/INSTALL/i', '', preg_replace ('/\\\\/', '/', dirname (__FILE__)));
  define ('_CAL_BASE_PATH_', $BASE_PATH);
  $_REQUEST = $GLOBALS['_REQUEST'] = array_merge ($_GET, $_POST);
  error_reporting (E_ALL & ~E_NOTICE);
  if ($_REQUEST['u'])
  {
    @define ('_CAL_DBUSER_', $_REQUEST['u']);
  }

  if ($_REQUEST['p'])
  {
    define ('_CAL_DBPASS_', $_REQUEST['p']);
  }

  if ($_REQUEST['h'])
  {
    @define ('_CAL_DBHOST_', $_REQUEST['h']);
  }

  if ($_REQUEST['d'])
  {
    @define ('_CAL_SQL_DRIVER_', $_REQUEST['d']);
  }

  if ($_REQUEST['pt'])
  {
    @define ('_CAL_DBPORT_', $_REQUEST['pt']);
  }

  if ($_REQUEST['db'])
  {
    @define ('_CAL_DBNAME_', $_REQUEST['db']);
  }

  global $_cal_config;
  include_once $BASE_PATH . 'INSTALL/parse_config.php';
  if (!$_REQUEST['p'])
  {
    define ('_CAL_DBPASS_', $_cal_config['_CAL_DBPASS_']);
  }

  $drivers = array ('mysql' => 'mysql_connect', 'pgsql' => 'pg_connect', 'mssql' => 'mssql_connect');
  if (!function_exists ($drivers[$_REQUEST['d']]))
  {
    echo '' . '<BR>ERROR: your PHP installation does not have support
	for the database driver (' . $_REQUEST['d'] . ') you have selected. Consult the PHP documentation
	for instructions on how to enable support for your database.<br>';
    return null;
  }

  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql.php';
  $s = new _cal_sql ();
  if (!$s->_connected)
  {
    echo '<br>' . _ERROR_ . ': the user <b>' . @constant ('_CAL_DBUSER_') . '</b> could not connect';
    if (@constant ('_CAL_DBNAME_'))
    {
      echo ' to the <b>' . @constant ('_CAL_DBNAME_') . '</b> database';
    }

    echo '.<br>';
  }
  else
  {
    echo '<font color=green><b>OK</b></font>
';
  }

  echo '<div align=\'center\'><input type=button value=\'Close\' onClick=\'self.close()\'></div>
</body>
</html>
';
?>