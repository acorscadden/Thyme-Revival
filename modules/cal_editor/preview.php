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

if(!@constant("_DEBUG_"))
   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.cal_editor$/","",dirname(__FILE__));

   define("_CAL_URL_PERSISTENT_", 1);

   require_once($BASE_PATH.'include/config.php');
   
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.calendar.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.session.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

   ################################
   #
   ### ARE WE ALLOWED TO BE HERE?
   #
   ################################
   $s = new _cal_session();
   $s->start(true);
 
   $user = new _cal_user(null,null,$_SESSION['uid']);
   $user->login();

   # intruder alert!

   if(!$user->admin) {
      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
      $html = new _cal_html();
      $html->permission_denied(); # fixed
      return;
   }


   $user = null;
   $s->stop();

   unset($_SESSION);

   #################################

   # strip slashes from request?
if(get_magic_quotes_gpc()) {
   foreach(array_keys($_REQUEST) as $key)
   {
      if(is_array($_REQUEST[$key])) {
         $_REQUEST[$key] = array_map("stripslashes", $_REQUEST[$key]);
         continue;
      }
      $_REQUEST[$key] = stripslashes($_REQUEST[$key]);
   }
}



   global $_cal_user, $_cur_cal;

   $_cal_user = new _cal_user(null,null,0);
   $_cal_user->login();
 

   # CAN THE GUEST ACCOUNT
   # VIEW THIS CALENDAR
   ########################################## 
   $_cur_cal = new _cal_obj($_REQUEST['ecalendar']);

   if(!$_cal_user->access->can_view($_cur_cal)) {

      echo("The guest account does not have access to view this calendar.
        Please add the Guest account to this calendar's member's list to 
        enable it in the calendar publisher, or select a different calendar
        on the General tab.");
   
      exit; 


   } 

   if($_REQUEST['m'] && $_REQUEST['y']) {
      $cal = new calendar($_REQUEST['y'],$_REQUEST['m'],$_REQUEST['d']);
   } else if($_REQUEST['current_date']) {
      $cal = new calendar();
   } else {
      $cal = new calendar($_REQUEST['caldate_yr'],$_REQUEST['caldate_mo'],
        $_REQUEST['caldate_da']);
   }

   $cal->set("theme", $_REQUEST['theme']);
   $cal->set("week_start", intval($_REQUEST['week_start']));
   $cal->set("timezone", $_REQUEST['timezone']);
   $cal->set("dst", $_REQUEST['dst']);
 
   $cal->set("calendar", $_REQUEST['ecalendar']);

   $cal->set("e_typename", intval($_REQUEST['e_typename']));
   $cal->set("e_popup",intval($_REQUEST['e_popup']));
   $cal->set("e_n_popup",intval($_REQUEST['e_n_popup']));

   $cal->set("e_collapse", intval($_REQUEST['e_collapse']));
   $cal->set("e_size", $_REQUEST['e_size']);


   if($_REQUEST['cal_width'])
      $cal->set("width", $_REQUEST['cal_width']);


   if($_REQUEST['seltypes'] > 0 ) {
      $cal->set("event_types", $_REQUEST['seltypes']);
   }


   if(intval($_REQUEST['row_height']) > 0) {
      $cal->set("row_height", intval($_REQUEST['row_height']));
   }

   if(strlen($_REQUEST['txt_next']) > 0) {

      if($_REQUEST['next_img_url'])
         $cal->set("img_next", $_REQUEST['txt_next']);
      else
         $cal->set("txt_next", @htmlspecialchars($_REQUEST['txt_next'], ENT_QUOTES, _CHARSET_));
   }

   if(strlen($_REQUEST['txt_prev']) > 0) {
 
      if($_REQUEST['prev_img_url'])
         $cal->set("img_prev", $_REQUEST['txt_prev']);
      else
         $cal->set("txt_prev", @htmlspecialchars($_REQUEST['txt_prev'], ENT_QUOTES, _CHARSET_));

   }

   if(strlen($_REQUEST['event_view_url']))
      $cal->set("event_view_url", $_REQUEST['event_view_url']);

   if(strlen($_REQUEST['minical_date_url']))
      $cal->set("minical_date_url", $_REQUEST['minical_date_url']);


   $cal->set("exclude_outside", intval($_REQUEST["exclude_outside"]));

   $cal->set("time_interval", intval($_REQUEST['time_interval']));
   $cal->set("workday_start_hr", intval($_REQUEST['workday_start_hr']));
   $cal->set("workday_end_hr", intval($_REQUEST['workday_end_hr']));
   $cal->set("hour_format", intval($_REQUEST['hour_format']));
   $cal->set("header_align", $_REQUEST['header_align']);
   $cal->set("static", intval($_REQUEST['static']));
   $cal->set("show_weeks", intval($_REQUEST['show_weeks']));
   $cal->set("event_links", intval($_REQUEST['event_links']));
   $cal->set("show_events", intval($_REQUEST['show_events']));
   $cal->set("show_header_links", intval($_REQUEST['show_header_links']));
   $cal->set("show_header", intval($_REQUEST['show_header']));
   $cal->set("hil_day", intval($_REQUEST['hil_day']));
   $cal->set("abbr_weekdays", intval($_REQUEST['abbr_weekdays']));
   $cal->set("hour_format", $_REQUEST['hour_format']);
   $cal->set("hil_week", intval($_REQUEST['hil_week']));

   if($_REQUEST['header_text'] != "") {
      $cal->set("header", $_REQUEST['header_text']);
   }


echo("<html>
<head>
<title>Preview</title>\n");

if($_REQUEST['apply_css_from'] == 2) {
    $cal->apply_style();
    require_once(_CAL_BASE_PATH_ ."/modules/cal_editor/gen_css.php");
} else if($_REQUEST['apply_css_from'] == 1) {
$cal->apply_style($_REQUEST['theme']);
}

echo("
</head>
<body>\n<div id='cal'>");


   switch($_REQUEST["v"])
   {
      case "y":
         $cal->display_year();
         break;

      case "m":
         $cal->display_month();
         break;

      case "d":
         $cal->display_day();
         break;

      case "w":
         $cal->display_week();
         break;

      case "mm";
         $cal->display_month_mini();
         break;

   }

   echo("</div>\n");
   echo("\n</body>\n</html>\n");

?>
