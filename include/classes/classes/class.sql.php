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


  $driver = @constant ('_CAL_BASE_PATH_') . 'include/classes/sql/class.' . _CAL_SQL_DRIVER_ . '.php';
  if (!file_exists ($driver))
  {
    error_reporting (E_ALL);
    echo 'ERROR :: SQL driver "<b>' . _CAL_SQL_DRIVER_ . '</b>" not found!<br><br>';
    require_once $driver;
    exit ();
  }

  require_once $driver;
?>