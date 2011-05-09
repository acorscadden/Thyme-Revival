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
//

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.mailer.php");

################################
#
### GET A LIST OF EXPORT FORMATS
#
################################

$dh = dir(@constant("_CAL_BASE_PATH_") ."/modules/sync/export");
while (false !== ($entry = $dh->read())) {

   if(substr($entry, 0,1) == ".") continue;

   @include_once(@constant("_CAL_BASE_PATH_") . "modules/sync/export/".$entry."/register_format.php");

}
$dh->close();

$GLOBALS['ms_quirks'] = 1;

function send_event($contact_id,&$evnt,$subject,$txtmsg= "", $htmlmsg="", $mixed = null)
{

   global $_cal_sql, $_cal_user, $_cal_html, $_cal_tmpl, $_cal_form, $_cal_modules;

   $_cal_event = $evnt;

   $_cal_sql or $_cal_sql = new _cal_sql();

   if($contact_id == 0) {

      $s['email'] = $_cal_user->email;
      $s['name'] = $_cal_user->name;


   } else if(is_array($contact_id)) {

       $s = $contact_id;

       if(strpos($s['email'], '<') !== false) {
          $s['name'] = preg_replace("/\s*<.*/", "",$s['email']);
          $s['email'] = preg_replace("/.*<(.*)>.*/", '\\1',$s['email']);
       }

   } else {

      global $_cal_dbpref;

      list($s) = $_cal_sql->query("select {$_cal_dbpref}ContactOpts.email,
           {$_cal_dbpref}Users.email as demail, {$_cal_dbpref}Users.name as sname
           from {$_cal_dbpref}ContactOpts
           left join {$_cal_dbpref}Users on {$_cal_dbpref}Users.id = {$_cal_dbpref}ContactOpts.uid
           left join {$_cal_dbpref}UserOptions on {$_cal_dbpref}UserOptions.id = {$_cal_dbpref}ContactOpts.uid
           where {$_cal_dbpref}ContactOpts.id = " . $contact_id);
    }

   # check that the user can access this event..
   ############################################
   if(!$_cal_event->can_view()) {
      echo("Access denied for user ". $_cal_user->userid ." to event ". $_cal_event->title ."\n");
      return;
   }


   if($_cal_event->force_html) $s['format'] = 'html';

      if(!$s['email']) $s['email'] = $s['demail'];
      if(!$s['format']) $s['format'] = 'html';


      # check for custom authentication
      ##################################
      if(function_exists("_ex_auth_login") && !$s['email']) {

         list($u) = _ex_auth_get_users_by_id(array($s['uid']));

         $s['email'] = $u['email'];
      }

      $mod = $_cal_modules['sync']['export'][$s['format']];

      # include format file...
      ########################
      if(!include_once(@constant("_CAL_BASE_PATH_") . "modules/sync/export/" . $mod['include'])) {
         echo("Unknown format ". $s['format'] ." for addres: ". $s['email'] ." for user: ".
            $s['sname'] ."\n");
         $s['format'] = 'html';
         include_once(@constant("_CAL_BASE_PATH_") . "modules/sync/export/" . $mod['include']);
      }

      if($_cal_event->is_request && $_cal_event->id > 0)
         $_cal_event->id = -($_cal_event->id);
 
      $_REQUEST['eid'] = $eid = $_cal_event->id;


      if(!is_object($_cal_event)) {
         echo("unhandled!\n");
         echo($_cal_event);
         return;
      }

      $filename = $_cal_event->title .$mod['ext'];

      $to = $s['email'];
 
      if(!strpos($to,'@')) {
         echo("Invalid email address: $to : for {$s['sname']}\n");
         return false;
      }

      # COMPOSE HEADER OF EMAIL
      #########################
      $mime_boundary = "==multipart_boundary_x".md5(time())."x";

 
      $mail_from = ($GLOBALS['_MAIL_FROM_'] ? $GLOBALS['_MAIL_FROM_'] : _CAL_MAIL_FROM_);

      $header = "Return-path: $mail_from\n";
      $header .= "Sender: $mail_from\n"; 
      $header .= "From: $mail_from\n";


      $body = "";

      if($s['format'] == 'html') $mixed = false;
      else if($mixed === null) $mixed = true;

      # IF IT'S TEXT, NO NEED TO ATTACH
      if($s['format'] != 'text') {

         $header .= "MIME-Version: 1.0\n";
         $header .= "Content-type: multipart/". ($mixed ? "mixed" : "alternative") .
                ";\n charset=\""._CHARSET_."\";\n boundary=\"$mime_boundary\"\n\n";

         # COMPOSE BODY OF EMAIL
         ########################
         $body = "This is a multi-part message in MIME format.\n\n" .
           "--{$mime_boundary}\n" .
           "Content-Type: text/plain; charset=\""._CHARSET_."\"\n" .
           "Content-Transfer-Encoding: 7bit\n\n";


      }

      if($txtmsg) $body .= $txtmsg ."\n\n";

      $body .= _EVENT_ .": ". $_cal_event->title ." : ". $_cal_event->cal_title ."\n\n";
      $body .= _VIEW_ .": ". @constant("_CAL_BASE_URL_") . _CAL_PAGE_MAIN_ .
           "?event_action=view&eid=". $eid ."\n\n";

      $body .= $msg ."\n\n";


      if($s['format'] != 'text') {
         $body .= "--{$mime_boundary}\n" . 
             "Content-Type: {$mod['content_type']}; charset=\""._CHARSET_."\"\n" . 
             ($mixed ? "Content-Disposition: attachment; filename=\"{$_cal_event->title}{$mod['ext']}\"\n" : "") . (@constant("_CAL_DISABLE_BASE64_EMAIL_") ? "\n\n" : 
             "Content-Transfer-Encoding: base64\n\n");
      }

      # EXPORT ATTACHMENT
      if(!$attch[$s['format']]) {
         ob_start();
         call_user_func($mod['header']);

         if($s['format'] == 'html' && $htmlmsg)
            echo(nl2br($htmlmsg) ."<br><br>");

         call_user_func($mod['export'], $eid, $_REQUEST['instance']);     
         call_user_func($mod['footer']);

         if($s['format'] == 'text' || @constant("_CAL_DISABLE_BASE64_EMAIL_")) {
            $attch[$s['format']] = ob_get_contents();
         } else {
            $attch[$s['format']] = chunk_split(base64_encode(ob_get_contents())) ."\n\n";
         }

         ob_end_clean();
      }

      $body .= $attch[$s['format']];

      if($s['format'] != 'text') $body .= "--{$mime_boundary}--\n";

    
      $_cal_mailer = new _cal_mailer();

        if(strpos(_CAL_MAIL_FROM_, '<')) {

           $from['name'] = preg_replace("/\s*<.*/", "", _CAL_MAIL_FROM_);
           $from['email'] = preg_replace("/.*<\s*/", "",_CAL_MAIL_FROM_);
           $from['email'] = preg_replace("/\s*>\s*/", "", $from['email']);

        } else {

           $from['email'] = _CAL_MAIL_FROM_;
        }

        $_cal_mailer->From     = $from['email'];
        $_cal_mailer->FromName = $from['name'];

        $_cal_mailer->to = array();
        $_cal_mailer->AddAddress($s['email'],$s['name']);

        if(!($_cal_mailer->Send($header,$body,$subject))) {
           echo("<font class='"._CAL_CSS_HIL_."'>"._ERROR_ .": ". $_cal_mailer->ErrorInfo ."</font><br>");
           return false;
        }
        return true;
 

}



?>
