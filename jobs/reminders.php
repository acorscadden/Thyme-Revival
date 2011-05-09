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
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/send_event.php");

global $_cal_sql, $_cal_user, $_cal_html, $_cal_tmpl, $_cal_form, $_cal_dbpref;


@define("_CAL_INSIDE_JOB_", 1);

$_cal_html = new _cal_html(true);
$_cal_tmpl = new _cal_template('event_view_template');
$_cal_form = new _cal_form();
$_cal_sql or $_cal_sql = new _cal_sql();

if(!@constant("_CAL_JOB_INTERVAL_")) define("_CAL_JOB_INTERVAL_", 5);

# GET TIME
$now = time();
$now -= ($now % 60);

# OVERRIDE CHECK DATES
# 17 days
$orcheck = (86400 * 17);

# HOLD REMINDERS TO DELETE
$deletes = array();


##########################################################
#
### GET ALL RREMINDERS WHERE THE NEXT REMINDER IS < NOW
#
##########################################################

$rs = $_cal_sql->query("select * from {$_cal_dbpref}Reminders order by uid");

########################
#
### CHECK FOR OVERRIDES
#
########################

foreach($rs as $r)
{
   # CHECK FOR AN UPCOMING OVERRIDE
   #################################
   if(!$orchecked[$r['eid']]) {
      $ors = $_cal_sql->query("select id from {$_cal_dbpref}Events where override_id = ".
        $r['eid'] ." and (starttime <= ". ($now + $orcheck) ."
        and starttime >= ". ($now - $orcheck) .")");

      $orchecked[$r['eid']] = 1;

      foreach($ors as $or) {
         $n = $r;
         $n['eid'] = $or['id'];
         array_push($rs, $n);
      }
   }
}

if(@constant("_CAL_DEBUG_REMINDERS_") && !count($rs))
   echo("No reminders.\n");

$user_time = 0;

foreach($rs as $r)
{

   if(@constant("_CAL_DEBUG_REMINDERS_")) {
      echo("checking Reminder: {$r['id']} eid: {$r['eid']} uid: {$r['uid']} ...\n");
   }

   # SET CURRENT USER
   ####################
   if($r['uid'] != $_cal_user->id) {
      $_cal_user = new _cal_user("","",$r['uid']);
      $user_time = $_cal_user->to_localtime($now);
   }

   $e = new _cal_event($r['eid']);

   # * if it doesn't have a calendar, it prorbaby no longer exists.
   # * if we can't view the event, delete the reminder
   ###############################################################
   if(!$e->calendar || !$e->can_view()) {

      if(@constant("_CAL_DEBUG_REMINDERS_")) {
         echo("... event has no calendar or user does not have access to view. Skipping ...\n");
      }
      $deletes[] = $r['id'];
      continue;
   }

   $e->start = $e->start_timestamp = $e->starttime;

   $rep = new _cal_repeater($e);

   # get_next_time is only accurate up to the day
   $next = $rep->get_next_time(_ex_date("Y-n-j H:i", $user_time + (_CAL_JOB_INTERVAL_*60)),
        false, $user_time + (_CAL_JOB_INTERVAL_ * 60));

   # next may return today even if the time
   # has passed
   ########################################
   $e->set_localtime($next);

   # see if we're past now
   ##########################
   if($e->start < $user_time) {

      $next = $rep->get_next_time(_ex_date("Y-n-j H:i", $e->start + 86400),
           false, $e->start + 86400);

   }


   if(@constant("_CAL_DEBUG_REMINDERS_") && $next === null) {
      echo(".. event will not happen again or has an override. Skipping ...\n");
   }

   # * if it won't happen again in the future
   ##########################################
   if($next === null && !$e->override_id) {
      $deletes[] = $r['id'];
      continue;
   } else if($next === null) {
      continue;
   }

   $user_time = $_cal_user->to_localtime($now);

   #############################
   #
   ### CHECK TARGET TIME
   #
   #############################
   if(_CAL_JOB_INTERVAL_ > 5 && (($e->start - ($r['remindtime'] * 60)) > $user_time)) {


      // 1142200800set next to 2006-3-13<br>start is 1142236800 remind time is 1500 target is 1142146800 target_diff is -1142146200 user time is 1142200800

      # target time of reminder
      $target = $e->start - ($r['remindtime'] * 60);

      #              # mins left before event starts - # the reminder target
      $target_diff = (($target - $user_time) / 60);

      # if we haven't passed the target time
      if($target_diff > 0 && $target_diff < _CAL_JOB_INTERVAL_) $force = 1;
      else $force = 0;


   }

   #############################
   #
   # MATCHED RERMINDER TIME
   #
   #############################

   if((($e->start - ($r['remindtime'] * 60)) == $user_time) || $force) {

      # force sending in HTML format
      $e->force_html = 1;

      $rtimes = array();

      # fix remind time
      ######################
      $r['remindtime'] = ($e->start - $user_time) / 60;
      
      # find remind time.
      ####################
      if(intval($r['remindtime'] / 1440) > 0) {
         $rtimes[] = intval($r['remindtime'] / 1440) ." ". _DAYS_;
         $r['remindtime'] = ($r['remindtime'] % 1440);

      }

      if(intval($r['remindtime'] / 60) > 0) {
         $rtimes[] = intval($r['remindtime'] / 60) ." ". _HRS_;
         $r['remindtime'] = ($r['remindtime'] % 60);
      }

      if($r['remindtime']) $rtimes[] = $r['remindtime'] ." " . _MINS_;

      if(@constant("_CAL_DEBUG_REMINDERS_")) {
         echo("... matched. Sending email\n");
      }

      $e->set_localtime('next');
      $_REQUEST['instance'] = $e->instance;

      # send email
      ########################
      send_event($r['contact'], $e,
            _REMINDERS_ ." : ". $e->title ." : " . _WILL_OCCUR_IN_ ." ". join(", ", $rtimes));

      # if it doesn't repeat, delete this reminder
      if(!$e->freq && !$e->override_id) $deletes[] = $r['id'];


   } else if(($e->start < $_cal_user->to_localtime($now)) && !$e->freq && !$e->override_id) {

      $deletes[] = $r['id'];

   } else {

      if(@constant("_CAL_DEBUG_REMINDERS_")) {
         echo("... not time for reminder. Skipping ...\n");
      }
   }

}

####################################
#
### DELETE OLD REMINDERS
#
###################################
if(count($deletes))
   $_cal_sql->query("delete from {$_cal_dbpref}Reminders where id in (". join(",",$deletes) .")");

?>
