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

if(!@constant("_DEBUG_"))
   error_reporting(E_ALL ^ (E_NOTICE));


##########################
#
### CALENDAR SUPER CLASS
#
##########################

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.calendar_real.php");
require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

# notes popups
$GLOBALS['_cal_notes'] = array();


class calendar extends _cal_calendar_real
{

var $theme;
var $week_start;

var $user_vars;

var $divid = 'cal';

function calendar($yr = null, $mo = null, $da = null)
{

   $this->_cal_calendar_real($yr,$mo,$da);
   $this->user_vars = get_class_vars(get_class($GLOBALS['_cal_user']->options));

}



#################################
#
### SET A VARIABLE IF IT EXISTS
#
#################################

function set($name, $val)
{

   global $_cal_sql, $_cal_dbpref, $_cur_cal;

   $name = strtolower($name);

   if(array_key_exists($name, $this->user_vars)) {
      if($name) $GLOBALS['_cal_user']->options->$name = $val;
   }

   if($name) $this->$name = $val;

   switch ($name)
   {

      case "time":
         $this->set_curtime = false;
         $this->fill_date_vars();

      case "timezone":
      case "dst":
      case "week_start":
       $this->fill_date_vars();
       break;

      case "theme":
         require_once(@constant("_CAL_BASE_PATH_") ."include/theme_engine.php");
         _ex_theme_set($GLOBALS['_cal_user']->options->theme);
         break;


      case "category":

         # SET CATEGORY
         #########################

         if(!($_cur_cal && $_cur_cal->id)) break;

         $_cur_cal->get_categories();

         while(list($k,$v) = each($_cur_cal->categories)) {
            if(strtolower($val) == strtolower($v)) {
               $this->event_types = $k;
               break;
            }
         }

         break;

      # SET CALENDAR
      #####################
      case "calendar":

         if(preg_match("/[^\d]/",$val)) {

            require_once(_CAL_BASE_PATH_."include/classes/class.sql.php");
            $_cal_sql or $_cal_sql = new _cal_sql();

            list($_cal_id) = $_cal_sql->query("select id, id from {$_cal_dbpref}Calendars
               where lower(title)  = '". strtolower($_cal_sql->escape_string($val)) ."'");

            $this->calendar = $val = $_cal_id['id'];

         }

         $GLOBALS['_cur_cal'] = new _cal_obj(abs($val));
         break;

   }

}


#################################
#
### DISPLAY FUNCTIONS
#
#################################
function display_day()
{
   require_once(@constant("_CAL_BASE_PATH_") . "include/js/notes_popups.js");

   echo("<div id='".$this->divid."'>\n");
   parent::display_day();

   if(!@constant("_CAL_THEME_POPUPS_"))
      echo("</div>");

   # print notes popups
   foreach($GLOBALS['_cal_notes'] as $n) {
      print $n;
   }
   require(@constant("_CAL_BASE_PATH_") . "include/event_notes_popup.php");

   if(@constant("_CAL_THEME_POPUPS_")) echo("</div>");

}
function display_week()
{
   require_once(@constant("_CAL_BASE_PATH_") . "include/js/notes_popups.js");

   echo("<div id='".$this->divid."'>\n");
   parent::display_week();

   if(!@constant("_CAL_THEME_POPUPS_")) echo("</div>");

   # print notes popups
   foreach($GLOBALS['_cal_notes'] as $n) {
      print $n;
   }
   require(@constant("_CAL_BASE_PATH_") . "include/event_notes_popup.php");

   if(@constant("_CAL_THEME_POPUPS_")) echo("</div>");

}
function display_month()
{
   require_once(@constant("_CAL_BASE_PATH_") . "include/js/notes_popups.js");

   echo("<div id='".$this->divid."'>\n");
   parent::display_month();

   if(!@constant("_CAL_THEME_POPUPS_")) echo("</div>");
   # print notes popups
   foreach($GLOBALS['_cal_notes'] as $n) {
      print $n;
   }
   require(@constant("_CAL_BASE_PATH_") . "include/event_notes_popup.php");

   if(@constant("_CAL_THEME_POPUPS_")) echo("</div>");

}
function display_month_mini()
{

   echo("<div id='".$this->divid."'>\n");
   parent::display_month_mini();
   echo("</div>");
}
function display_year()
{
   echo("<div id='".$this->divid."'>\n");
   parent::display_year();
   echo("</div>");
   # print notes popups

}

function display_years_mini()
{
   echo("<div id='".$this->divid."'>\n");
   parent::display_years_mini();
   echo("</div>");
}

function display_year_mini()
{
   echo("<div id='".$this->divid."'>\n");
   parent::display_year_mini();
   echo("</div>");
}

#################################
#
### REGISTER A PERSISTENT URL VAR
#
################################
function register_persistent($k,$v)
{

   $GLOBALS['_cal_persistent_url'][$k] = $v;

}

############################
# ### RETURN AN EVENT OBJECT
#
############################

function get_event($eid, $instance)
{

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");

   if(strlen($instance) && !strpos($instance, "-")) $instance = _ex_date("Y-n-j", $instance);

   $e = new _cal_event($eid, $instance);

   return $e;


}


##########################
#
# GET CATEGORIES
#
#########################

function get_categories()
{
   global $_cur_cal;

   if(!($_cur_cal && $_cur_cal->id)) return array(_ALL_);

   return array( _ALL_) + $_cur_cal->get_categories();
}

############################
#
### GET CALENDARS
#
###########################
function get_calendars($access_lvl = 0)
{

   return $GLOBALS['_cal_user']->access->get_cals_sel($access_lvl);

}

#############################
#
### GET A LIST OF EVENT IDS
#
#############################

function get_event_list($view, $start = null)
{


   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");

   $current = ($view == 'current');

   if($start === null) {
      $start = $this->time;
      $tmptime = null;
   } else {
      $tmptime = $cal->time;
      $start = _ex_strtotime($start);
      $this->set("time", $start);
   }

   if($view == 'current') {
      $start = _ex_localtime() - 86400;
      $view = _ex_date("Y-n-j",$start + (86400 * 2));
      $start = _ex_date("Y-n-j", $start); 
   }

   if(!strpos($view,'-')) $this->fill_date_vars(); 

   $em = new _cal_event_matrix($start, $view, $this->event_types, $this->calendar, $this->filter);

   $hndl = $em->matrix;

   # exclude days outside of month
   ##################################
   if($this->exclude_outside && $view == 'month') {

      $st = abs((_ex_mktime(0,0,0,$this->mon,1,$this->year) - $this->m_starttime) / 86400);
      $nd = _ex_date("t",$this->time);

      $this->m_starttime = _ex_mktime(0,0,0,$this->mon, 1, $this->year);

      $hndl = array_slice($hndl, $st, $nd);

   }

   # Remove non-current events
   ############################
   if($current) {

      require_once(_CAL_BASE_PATH_."include/classes/class.event_minimal.php");

      $now = _ex_localtime();

      $events = array();

      foreach($hndl as $day) {

         foreach($day as $e) {

            $event = new _cal_event_minimal($e);

            # Event starts AFTER NOW
            if($event->start > $now) continue;

            # Event ends BEFORE NOW
            if($event->allday) $event->ends_at = $event->start + 86400;
            if($event->ends_at < $now) continue;

            $events[] = $e;

         }

      }

      return $events;
   }

   if($tmptime !== null) {
      $this->set("time", $tmptime);
      $this->fill_date_vars();
   }

   return $hndl;
}


##########################
#
### PRINT A DATE
#
##########################

function format_date($str_format, $time = null)
{

   # we want to override weekdays 
   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");

   if($time === null) {
     $time = $this->time;
   }

   return _ex_date($str_format, $time);
}


}

?>
