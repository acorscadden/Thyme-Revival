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


define("_CAL_BASE_PATH_", preg_replace("/jobs$/","",preg_replace("/\\\/","/",dirname(__FILE__))));

define("_CAL_USE_SESSION_", 0);
define("_CAL_BENCHMARK_", 0);
define("_CAL_DOING_EMAIL_", 1);
define("_CAL_DOING_OPTS_", 1);


require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/send_event.php");

global $_cal_sql, $_cal_user, $_cal_html, $_cal_tmpl, $_cal_form, $_cal_dbpref;

if(!@constant("_CAL_JOB_INTERVAL_")) define("_CAL_JOB_INTERVAL_", 5);

$_cal_html = new _cal_html(true);
$_cal_tmpl = new _cal_template('event_view_template');
$_cal_form = new _cal_form();
$_cal_sql or $_cal_sql = new _cal_sql();

@define("_CAL_INSIDE_JOB_", 1);

# GET TIME
$now = time();
$now -= ($now % 60);

$sql_time_check = _CAL_JOB_INTERVAL_ * 60;

# Get events added that are # at least 5 minutes old,
# but no greater than 10 minutes old
#####################################################

if(_CAL_JOB_INTERVAL_ == 5) {

   $new = $_cal_sql->query("select id, calendar from {$_cal_dbpref}Events where added <= 
       ($now - 300) and added > ($now - 600)", true);

} else {

   $new = $_cal_sql->query("select id, calendar from {$_cal_dbpref}Events where added >=
       ($now - $sql_time_check)", true);

}

# Get events that have been updated at least 5 minutes ago
# but no greater than 10 minutes ago
#######################################################

if(_CAL_JOB_INTERVAL_ == 5) {

   $new += $_cal_sql->query("select -id, calendar from {$_cal_dbpref}Events where updated <=
       $now - 300 and updated > ($now - 600) and (updated - added) > 300", true);

} else {

   if(count($new)) $xtra = " and id not in (". join(array_keys($new),',') .")";
   else $xtra = "";

   $new += $_cal_sql->query("select -id, calendar from {$_cal_dbpref}Events where updated >=
       ($now - $sql_time_check) $xtra", true);

}


$subs = array();
$cals = array();

if(@constant("_CAL_JOB_DEBUG_")) {
   echo("notifications: found ". count($new) ." new or updated events\n");
}


# Get all email addresses subscribed to
# these calendars
##########################################
foreach(array_keys($new) as $_cal_eventid)
{

   # updated or new?
   if($_cal_eventid < 0) {
      $upd = true;
   } else {
      $upd = false;
   }

   $cal = $new[$_cal_eventid];

   $_cal_eventid = abs($_cal_eventid);

   if(@constant("_CAL_JOB_DEBUG_")) {
      echo("notifications: processing calendar {$_cal_eventid}\n");
   }


   $_SESSION['calendar'] = $cal;

   # get subscribers
   if(!$subs[$cal]) {
      $subs[$cal] = $_cal_sql->query("select {$_cal_dbpref}Notifications.*, {$_cal_dbpref}ContactOpts.email,
        {$_cal_dbpref}Users.email as demail, {$_cal_dbpref}Users.name as sname
        from {$_cal_dbpref}Notifications left join {$_cal_dbpref}ContactOpts on
        {$_cal_dbpref}ContactOpts.id = {$_cal_dbpref}Notifications.contact left
        join {$_cal_dbpref}Users on {$_cal_dbpref}Users.id = {$_cal_dbpref}Notifications.uid
        left join {$_cal_dbpref}UserOptions on
        {$_cal_dbpref}UserOptions.id = {$_cal_dbpref}Notifications.uid
        where cid = ". $cal);
   }

   if(!count($subs[$cal])) {
      if(@constant("_CAL_JOB_DEBUG_")) {
         echo("notifications: no notifications match this calendar\n");
         continue;
      }
   } else {

      if(@constant("_CAL_JOB_DEBUG_"))
         echo("notifications: found ". count($subs[$cal]) ." filters for this calendar\n");

   }

   $_cal_event = new _cal_event($_cal_eventid);
   $_cal_event->force_html = 1;

   if(!$cals[$cal]) $cals += $_cal_sql->query("select id, title from {$_cal_dbpref}Calendars where id = ". $cal, true);

   # step through each subscriber
   ##############################
   foreach($subs[$cal] as $s)
   {

      # set user based on userid
      $_cal_user = new _cal_user("","",$s['uid']);
    
      if(@constant("_CAL_JOB_DEBUG_"))
         echo("notifications: checking subscriber {$_cal_user->name} [{$_cal_user->userid}]\n");
      
 
      # check if user exists..
      if(!$_cal_user->id) {
         echo("User with id: {$s['uid']} no longer exists!\n");
         continue;
      }

      if(@constant("_CAL_JOB_DEBUG_")) echo("notifications: checking category\n");
 
      # skip if we don't match the event type
      if($s['etype'] && !($_cal_event->etype & $s['etype'])) continue;


      if(@constant("_CAL_JOB_DEBUG_")) echo("notifications: checking for title\n");

      # skip if we don't match the title
      if($s['titlecontains'] && (stristr($_cal_event->title, $s['titlecontains']) === false)) continue;


      if(@constant("_CAL_JOB_DEBUG_")) echo("notifications: checking to see if notification has already been sent\n");

      # skip if we've already matched a rule
      if($sent[$s['uid'].'-'.$s['contact']][$_cal_eventid]) continue;

      $sent[$s['uid'].'-'.$s['contact']][$_cal_eventid] = 1;


      if(@constant("_CAL_JOB_DEBUG_")) echo("notifications: sending e-mail\n");

      if($upd) {
         $subject = $_cal_event->title ." ". _UPDATED_ON_ ." ". $cals[$cal];
      } else {
         $subject = $_cal_event->title ." ". _ADDED_TO_ ." ". $cals[$cal];
      } 

      if(!send_event($s['contact'],$_cal_event,$subject)) {
         echo("Error sending email\n");
      }

   }

}



?>
