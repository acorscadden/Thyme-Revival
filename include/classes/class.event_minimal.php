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
// $Id: class.event_minimal.php,v 1.72 2008/02/11 18:32:27 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.dst.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.event.php");

class _cal_event_minimal extends _cal_sql_based
{

   var $id;

   var $type = 1;

   var $title = _EVENT_;
   
   var $start;
   var $end;

   var $allday = 0;

   var $duration;
 
   var $icon;
   var $type_icon;

   var $type_icons = array();

################
# constructor
#################

function _cal_event_minimal($eid = 0, $instance = null)
{

   global $_cal_dbpref, $_cal_sql, $_cur_cal, $_cal_user;

   # eid is array from event matrix
   ################################
   if(is_array($eid)) {

      foreach(array_keys($eid) as $k)
         $this->$k = $eid[$k];


      $this->starttime = $this->start;
      $this->endtime = $this->end;

      # set localtime?
      if($instance !== null) {

         $this->set_localtime($instance);


      } else {

         if(!$this->allday) {

            list($hr,$mn,$sc) = explode(":", $this->duration);

           $this->ends_at = $this->start + ($hr * 3600) + ($mn * 60);
         }

      }


      ###################
      #
      ## CALCULATE CSS STYLE
      #
      ##########################

      if($this->flag) {

         $this->css_class = "cal_event_imp";

      } else {

         $this->css_class = "cal_event";
      }

      if(!$_cur_cal) {
         require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
         $_cur_cal = new _cal_obj($this->calendar);
      }

      if($_cur_cal->type == 1 || $_cur_cal->type == 2) {
         $this->type_css_class = "cal_event_type_". $this->calendar ."_". $_cur_cal->id;
      } else {
         $this->type_css_class = "cal_event_type_". $this->type ."_". $_cur_cal->id; 
      }
     
      $this->type_css_class .= " cal_event_owner_" . $this->owner;

 
   # mormal events..
   ################
   } else if($eid > 0) {


      $this->_cal_sql_based("{$_cal_dbpref}Events", "id", $eid);

      $this->add_join("left join {$_cal_dbpref}EventTypes on
        {$_cal_dbpref}EventTypes.id = {$_cal_dbpref}Events.etype
        and {$_cal_dbpref}EventTypes.calendar = {$_cal_dbpref}Events.calendar");
      $this->add_translation("{$_cal_dbpref}EventTypes.icon", "type_icon");
      $this->add_translation("{$_cal_dbpref}EventTypes.name", "type_name");
      $this->add_translation("{$_cal_dbpref}Events.etype", "type");
      $this->add_translation("{$_cal_dbpref}Events.starttime", "start");
      $this->add_translation("{$_cal_dbpref}Events.endtime", "end");

      if(@constant('_CAL_LOCATIONS_MOD_')) {

        $this->add_join("left join {$_cal_dbpref}Locations on
            {$_cal_dbpref}Events.location_id = {$_cal_dbpref}Locations.id");

        $this->add_translation("{$_cal_dbpref}Locations.name","location_name");
      }


      $this->fields = array("id","title","icon","duration","allday","flag","calendar","timezone","dst","use_tz","location");

      $this->fill_vars();

      if(!$this->allday) {

         list($hr,$mn,$sc) = explode(":", $this->duration);

         if($hr + $mn < 1) {
            $hr = 1;
            $this->duration = "1:00:00";
         }


         $this->ends_at = $this->start + ($hr * 3600) + ($mn * 60);

      }


      ###################
      #
      ## CALCULATE CSS STYLE
      #
      ##########################

      if($this->flag) {

         $this->css_class = "cal_event_imp";

      } else {

         $this->css_class = "cal_event";
      }

      if($_cur_cal->type == 1 || $_cur_cal->type == 2)
         $this->type_css_class = "cal_event_type_". $this->calendar ."_". $_cur_cal->id;
      else
         $this->type_css_class = "cal_event_type_". $this->type ."_". $_cur_cal->id;

      # for owner
      $this->type_css_class .= " cal_event_owner_". $this->owner;

      # get the list of attachments
      ##############################

         global $_cal_sql;

         $_cal_sql or $_cal_sql = new _cal_sql();

         $this->attachments = $_cal_sql->query("select id from {$_cal_dbpref}Attachments
                where eid = ". $eid);


      # set localtime?
      if($instance !== null) {

         $this->set_localtime($instance);


      }


   # defailt event we're getting
   # ready to create..
   }  else {

      $this->_cal_sql_based("{$_cal_dbpref}Events", "id", $eid);

   }

   $this->sequence = "{$_cal_dbpref}events_id_seq";


   # multiple categories
   ####################333
   if(!$this->type_name && $this->type && !$this->not_found) {

      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

      if($_cur_cal->id == $this->calendar) {
         $_et_cal = $_cur_cal;
      } else {
         $_et_cal = new _cal_obj($this->calendar);
      }

      $this->category = $this->type_name = $_et_cal->get_category_name($this->type);

      $this->type_icons = $_et_cal->get_category_icons($this->type);

   } else if($this->type_icon) {

      $this->type_icons = array($this->type_icon);

   } else if(!is_array($this->type_icons)) {

      $this->type_icons = array();
   }
 
   if(@constant('_CAL_LOCATIONS_MOD_')) {
      $this->location = $this->location_name;
   }

   @include(_CAL_BASE_PATH_."customize/post_get_event_minimal.php"); 

   # UNSET DETAILS FOR GUESTS?
   if($_cal_user->guest && @constant('_CAL_GUEST_NO_EVENT_DETAILS_')) {

      unset($this->url);
      unset($this->location);
      unset($this->notes);
      unset($this->org_name);
      unset($this->org_email);
      unset($this->location_id);

      if(@constant('_CAL_GUEST_EVENT_TITLE_')) $this->title = _CAL_GUEST_EVENT_TITLE_;


   }

}


############################
#
### SET LOCALTIME
#
###########################
function set_localtime($instance = null)
{

   global $_cal_user;

   $this->instance = $instance;

   if($instance)
      $this->start = _ex_strtotime($instance ." ". _ex_date("G:i", $this->start), true);


   if(!($this->allday || !@constant("_CAL_ENABLE_TZ_") || $this->use_tz != 1)) {

      $this->dst_obj or $this->dst_obj = new _cal_dst($this->dst);

      # set timezone and dst
      $this->start -= (($this->timezone * 3600) - ($_cal_user->options->timezone * 3600));
      $this->start += (($_cal_user->dst->is_dst($this->start)) - ($this->dst_obj->is_dst($this->start))) * 3600;
   }

   list($hr,$mn,$sc) = explode(":", $this->duration);
   $this->ends_at = $this->start + ($hr * 3600) + ($mn * 60);



}


function save()
{


   global $_cal_sql;

   $this->freq = intval($this->freq);

   if($this->freq != 5 && $this->freq != 0) $this->finterval = max(1,$this->finterval);

   # trim off extra commas if there are any
   $this->byday = trim($this->byday, ",");
   $this->bymonthday = trim($this->bymonthday, ",");
   $this->bymonth = trim($this->bymonth, ",");
   $this->bysetpos = trim($this->bysetpos, ",");

   # make sure times are correct
   if($this->starttime)
      $this->starttime = _ex_strtotime($this->starttime);

   if($this->endtime)
      $this->endtime = _ex_strtotime($this->endtime);

   # set next and endtime ..
   if($this->freq == 0) {
      $this->next = $this->starttime;
      $this->endtime = 0;
   } else {
      $this->next = 0;
   }

   # ONLY EASTER CAN HAVE A NEGATIVE INTERVAL
   if($this->freq != 5)
      $this->finterval = abs($this->finterval);

   # OWNER
   #########
   if(!$this->id || !$this->added) {
      $this->owner = $GLOBALS['_cal_user']->id;
      $this->added = time();
   }

   # UPDATE PARENT VERSIOn
   ###########################
   if($this->override_id)
      $_cal_sql->query("update {$GLOBALS['_cal_dbpref']}Events set version = version + 1
                where id = ". $this->override_id);


   # UPDATED
   ###################
   if(!$this->updated) $this->updated = time();

   # UPDATE VERSION
   $this->version++;


   # CORRECT START TIME AND END AFTER
   ##################################
   if($this->freq > 0 && !$this->override_id) {

      $this->start_timestamp = $this->start = $this->starttime;
      $this->end = $this->endtime;

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
      $r = new _cal_repeater($this);

      $n = $r->get_next_time(_ex_date("Y-n-j 0:0", $this->starttime));

      if($n !== null)
         $this->starttime = _ex_strtotime($n . _ex_date(" H:i:0", $this->starttime));


      # end after
      if($this->end_after > 1 && !$this->endtime)
         $event->endtime = $r->get_last_time();

   }

   if(!strlen(trim($this->title))) $this->title = _EVENT_;

   $sval = parent::save();

   # UID
   ##########
   if(!$this->uid && $this->id) {
      $this->uid = md5($this->id) ."@thyme-". $_SERVER['SERVER_NAME'];
      $_cal_sql->query("update {$GLOBALS['_cal_dbpref']}Events
        set uid = '". $this->uid ."' where id = ". $this->id);
   }

   return $sval;
}

function format_notes($notes = false) {

   if($notes === false) $notes = $this->notes;
   return _cal_event::format_notes($notes);

}




}

?>
