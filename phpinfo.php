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


  error_reporting (0);
  if ($_REQUEST['s'] != md5 ('pinf' . $_SERVER['HTTP_HOST'] . '-g4f2462ce4fd9cb83eebad4a83fb9b0a83d'))
  {
    return null;
  }

  phpinfo ();
?>