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


  $errors = array ();
  $warnings = array ();
  $php_ini = '<b>' . @constant ('_PHP_INI_') . '</b>';
  if (@constant ('_APACHE_'))
  {
    $htaccess = 'or an .htaccess file';
  }

  if (!_is_writeable ($_cal_config_file))
  {
    $errors[] = 'The file <b>' . $_cal_config_file . '</b>
	is not writable
        by your web server.
        Please make sure this file exists and change the permissions. E.g.
	' . (@constant ('_WIN32_') ? 'give the ' . (@constant ('_APACHE_') ? 'SYSTEM Account' : 'Internet Guest Account (probably IUSR_' . getenv ('COMPUTERNAME')) . ') permission to modify the file and make sure it is not marked as read-only.' : 'chmod 666 config.php.');
  }

  if (get_magic_quotes_gpc ())
  {
  }

  if (ini_get ('magic_quotes_sybase'))
  {
    $errors[] = '' . 'The PHP setting \'magic_quotes_sybase\' is on. You will need to
	turn this off by setting it to \'Off\' in ' . $php_ini . ' ' . $htaccess . '.';
  }

?>