<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 eXtrovert Software                           |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@extrosoft.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: export_outlook2003.php,v 1.16 2007/03/22 13:24:07 ian Exp $
//

   define("_CAL_BASE_PATH_", preg_replace("/modules.sync.export.ical$/","",dirname(__FILE__)));

   require_once(@constant("_CAL_BASE_PATH_") . "modules/sync/export/ical/export_ical.php");

   $GLOBALS['ms_quirks'] = 1;


function export_event_outlook2003($eid, $instance = null, $orride = false)
{
   global $_cal_user, $_cal_timezone_options, $_cal_sql, $_cal_dst_config_cache, $_cal_vcal_wdays;

   export_event_ical($eid, $instance, $orride = false, 'REQUEST');

}

function email_outlook2003($to,&$event,$subject,$message)
{

   global $_cal_user, $_cal_timezone_options, $_cal_sql, $_cal_dst_config_cache, $_cal_vcal_wdays;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.mailer.php");

   if(strpos($to, '<') !== false) {
      $to = preg_replace("/.*<(.*)>.*/", '\\1',$to);
   }

   # build header.
   #################
   if($_cal_user->email) {
      if($_cal_user->name) $from = '"'.$_cal_user->name .'" <'. $_cal_user->email .">";
      else $from = $_cal_user->email;
   } else {
      $from = @constant("_CAL_MAIL_FROM_");
   }

   $header = "From: $from\n";
   $header .= "MIME-Version: 1.0\n";
   $header .= "Content-type: text/calendar; method=REQUEST;\n\tcharset=\"utf-8\"\n";
   $header .= "Content-Transfer-Encoding: 7bit\n";

   # build body of message
   #######################
   ob_start();
   echo("\r\n");
   export_header_ical();
   export_event_outlook2003($event->id, $_REQUEST['instance'], false);
   export_footer_ical();
   $body = ob_get_contents();
   ob_end_clean();


   $_cal_mailer = new _cal_mailer();

   $_cal_mailer->From     = $_cal_user->email;
   $_cal_mailer->FromName = $_cal_user->name;

   $_cal_mailer->AddAddress($to);

   if(!$_cal_mailer->Send($header, $body, $subject)) {
      echo("<font class='"._CAL_CSS_HIL_."'>"._ERROR_ .": ". $_cal_mailer->ErrorInfo ."</font><br>");
      return false;
   }

   return true;

}

?>
