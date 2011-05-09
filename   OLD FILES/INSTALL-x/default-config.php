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


  error_reporting (E_ALL ^ E_NOTICE);
  define ('_CAL_LANG_', 'en_US');
  define ('_CAL_SQL_DRIVER_', 'mysql');
  define ('_CAL_DBHOST_', 'localhost');
  define ('_CAL_DBPORT_', '');
  define ('_CAL_DBUSER_', 'sql-user');
  define ('_CAL_DBPASS_', 'sql-pass');
  define ('_CAL_DBNAME_', 'thyme');
  define ('_CAL_DBPREFIX_', 'thyme_');
  define ('_CAL_NOMAP_', 0);
  set_magic_quotes_runtime (0);
?>