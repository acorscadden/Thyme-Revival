<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
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
//

   global $_cal_user, $_cal_sql;

if(!@constant("_DEBUG_"))
   error_reporting(E_ALL ^ (E_NOTICE));

   define("_CAL_BENCHMARK_", 0);

   define("_CAL_USE_SESSION_", 1);

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.attachment_minimal.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.event.php");

   $s = new _cal_session();
   $s->start();

   $_cal_user = new _cal_user();
   $_cal_user->login();

   $a = new _cal_attachment_minimal($_REQUEST['aid']);

   $e = new _cal_event($a->eid);

   if(!$e->can_view()) {

      $lurl = new _cal_url(_CAL_PAGE_LOGIN_);
      $lurl->addArg("lp", "download_attachment.php?aid=" . $_REQUEST['aid']);
      header("Location: ". $lurl->toString());
      exit;
   }


   header("Content-Type: ". $a->filetype);
   header("Content-Disposition: attachment; filename=\"". $a->filename ."\"");
   header("Content-Length: " . $a->filesize);
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0", true);
   header("Pragma: no-cache");

   set_magic_quotes_runtime(0);

   $a->print_attachment();



?>
