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

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.dst.php");

class _cal_event extends _cal_sql_based
{

   var $id;

   var $type = 0;

   var $title = _EVENT_;
   
   var $allday = 0;

   var $attachments = array();

   var $repeat_every_opts = array( 1 => _REPEATING_EVERY1_, _REPEATING_EVERY2_,
      _REPEATING_EVERY3_, _REPEATING_EVERY4_, _REPEATING_EVERY5_, _REPEATING_EVERY6_);


   var $repeat_every_val_opts = array (_DAYS_, _WEEKS_, _MONTHS_, _YEARS_, 6 => _REPEATING_SELECTED_);

   var $repeat_on_opts = array( 1 => _REPEAT_ON1_, _REPEAT_ON2_, _REPEAT_ON3_,
      _REPEAT_ON4_, _REPEAT_ON5_, _REPEAT_ONL_);

   var $repeat_on_months_opts = array( 1 => _REPEAT_MONTH1_,_REPEAT_MONTH2_, _REPEAT_MONTH3_,
      _REPEAT_MONTH4_, 6 => _REPEAT_MONTH6_, 12 => _REPEAT_MONTHY_);

   var $type_icons = array();

################
# constructor
#################

function _cal_event($eid = 0, $instance = null)
{

   global $_cal_dbpref, $_cal_sql, $_cal_table_cache, $_cur_cal, $_cal_user;

   $eid = intval($eid);

   # mormal events..
   ################
   if($eid > 0) {


      $this->_cal_sql_based("{$_cal_dbpref}Events", "id", $eid);

      $this->add_join("left join {$_cal_dbpref}EventTypes on {$_cal_dbpref}EventTypes.id = {$_cal_dbpref}Events.etype and
        {$_cal_dbpref}EventTypes.calendar = {$_cal_dbpref}Events.calendar");

      $this->add_join("left join {$_cal_dbpref}Calendars on {$_cal_dbpref}Events.calendar = {$_cal_dbpref}Calendars.id");

      if(@constant('_CAL_LOCATIONS_MOD_')) {

        $this->add_join("left join {$_cal_dbpref}Locations on
            {$_cal_dbpref}Events.location_id = {$_cal_dbpref}Locations.id");
      
        $this->add_translation("{$_cal_dbpref}Locations.name","location_name");
      }

      $this->add_translation("{$_cal_dbpref}EventTypes.name","type_name");
      $this->add_translation("{$_cal_dbpref}EventTypes.icon", "type_icon");
      $this->add_translation("{$_cal_dbpref}Events.etype", "type");
      $this->add_translation("{$_cal_dbpref}Events.starttime", "start");
      $this->add_translation("{$_cal_dbpref}Events.endtime", "end");
      $this->add_translation("{$_cal_dbpref}Calendars.title", "cal_title");
      $this->add_translation("{$_cal_dbpref}Calendars.options", "cal_opts");

      if($_cal_table_cache['Events']['fields'])
         $this->fields = $_cal_table_cache['Events']['fields'];

      $this->fill_vars();

      if(!$_cal_table_cache['Events']['fields'])
         $_cal_table_cache['Events']['fields'] = $this->fields;

      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

      if($_cur_cal->id == $this->calendar) {
         $this->cal_obj = $_cur_cal;
      } else {
         $this->cal_obj = new _cal_obj($this->calendar);
      }


      $this->category = $this->type_name;

      # multiple categories
      ####################333
      if(!$this->category && $this->type && !$this->not_found) {


         $this->category = $this->type_name = $this->cal_obj->get_category_name($this->type);

         $this->type_icons = $this->cal_obj->get_category_icons($this->type);

      } else if($this->type_icon) {

         $this->type_icons[] = $this->type_icon;
      } 
       


      if(!$this->allday) {

         list($hr,$mn,$sc) = explode(":", $this->duration);
         $this->ends_at = $this->start + ($hr * 3600) + ($mn * 60);

      }


      # get the list of attachments
      ##############################

         $_cal_sql or $_cal_sql = new _cal_sql();

         $this->attachments = $_cal_sql->query("select id from {$_cal_dbpref}Attachments
		where eid = ". intval($eid));


      # version is parent's version
      #############################
      if($this->override_id) {

         list($ver) = $_cal_sql->query("select version from {$_cal_dbpref}Events where id = ". $this->override_id);

         $this->version = $ver['version'];

         if(!$this->uid) $this->uid = md5($this->override_id) ."@thyme-". $_SERVER['SERVER_NAME'];

      } else {

         if(!$this->uid) $this->uid = md5($this->override_id) ."@thyme-". $_SERVER['SERVER_NAME'];
      }

      if($instance) $this->set_localtime($instance);

      $this->repeats = ($this->freq >= 1);

      if(@constant('_CAL_LOCATIONS_MOD_')) {
         $this->location = $this->location_name;
      }


   # defailt event we're getting
   # ready to create..
   } else {

      $this->_cal_sql_based("{$_cal_dbpref}Events", "id");

      $this->cal_obj = $_cur_cal;
   }

   $this->sequence = "{$_cal_dbpref}events_id_seq";

   # UNSET DETAILS FOR GUESTS?
   if($this->id && $_cal_user->guest && @constant('_CAL_GUEST_NO_EVENT_DETAILS_')) {

      unset($this->url);
      unset($this->location);
      unset($this->notes);
      unset($this->org_name);
      unset($this->org_email);
      unset($this->location_id);

      $this->attachments = array();

      if(@constant('_CAL_GUEST_EVENT_TITLE_')) $this->title = _CAL_GUEST_EVENT_TITLE_;

   }

}

####################################
#
### PRINT ICONS
#
####################################
function print_type_icons($dim = 16, $sep = " ")
{

   echo($this->get_type_icons($dim,$sep));
}

function get_type_icons($dim = 16, $sep = " ")
{

   $icons = array();

   if(is_array($this->type_icons)) {

      require_once(_CAL_BASE_PATH_."include/images.php");

      foreach($this->type_icons as $ti) {

         $icons[] = _ex_img_str(_CAL_BASE_URL_.$ti, _ICON_, $dim, $dim);

      }
   }

   return join($sep,$icons);
}

####################################
# CALCULATE TIME TILL OR FROM EVENT
####################################

function uptime() {
    return null;
}

/*

OLD uptime()

uptime() was used to calculate the time until an event occurs, which was used in
the emails that got sent to approvers. It was determined that this functionality
was no longer needed. Currently, this function doesn't work because $this->start 
doesn't have a value yet. I think that this might be because this class is used
for requests. class.request.php should probably be used for requests instead.

*/

/*
function uptime()
{


   if(@constant("_CAL_NO_EVENT_UPTIME_")) return null;

   $diff = ((_ex_toint($this->start / 86400) * 86400) - ((_ex_localtime() / 86400) * 86400));
    $time = date("m.d.y / H:m:s", _ex_localtime());
   if($diff < 0) {
      $diff = abs($diff);
      $ago = " "._AGO_;
   } else {
      $diff += 86400;
   }


   $days = _ex_toint($diff / 86400);
   $yrs = _ex_toint($days / 365);
   $days -= ($yrs * 365);
   $mos = _ex_toint($days / 30);
   $days -= ($mos * 30);
   $wks = _ex_toint($days / 7);
   $days -= ($wks * 7);

   if($yrs) $up .= $yrs . " " . _YEARS_ ." ";
   if($mos) $up .= $mos ." ". _MONTHS_ ." ";
   if($wks) $up .= $wks ." ". _WEEKS_ ." ";
   if($days) $up .= $days ." ". _DAYS_;

   if(!$up) return null;

   $up .= $ago;

   return $up;

}
*/

#######################
#
### SET LOCAL TIME FOR EVENT
#
#######################################
function set_localtime($instance = null)
{

   global $_cal_user;

   # GET NEXT TIME
   ########################
   if($instance == 'next') {

      if($this->freq > 0 && !$this->override_id) {

         $this->start_timestamp = $this->start = $this->starttime;
         $this->end = $this->endtime;

         require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
         $r = new _cal_repeater($this);

         $n = $r->get_next_time(_ex_date("Y-n-j 0:0", _ex_localtime()), false, _ex_localtime());

         if($n !== null) $instance = $n;

      } else {

         $instance = _ex_date("Y-n-j", $this->starttime);
      }
   }

   if($instance && !strpos($instance,"-"))
      $instance = _ex_date("Y-n-j", $instance);

   $this->instance = $instance;

   if($instance) {

      list($yr,$mo,$da) = explode("-",$instance);

      $secs = $this->start % 86400;
      $this->start = _ex_mktime(0,0,0,$mo,$da,$yr) + ($secs > -1 ? $secs : -$secs);

   }

   if(!($this->allday || !@constant("_CAL_ENABLE_TZ_") || $this->use_tz != 1)) {

      $this->dst_obj or $this->dst_obj = new _cal_dst($this->dst);

      # set timezone and dst
      $this->start -= (($this->timezone * 3600) - ($_cal_user->options->timezone * 3600));

      $this->in_dst = $this->dst_obj->is_dst($this->start);
 
      $this->start += (($_cal_user->dst->is_dst($this->start)) - $this->in_dst) * 3600;
   }

   list($hr,$mn,$sc) = explode(":", $this->duration);
   $this->ends_at = $this->start + ($hr * 3600) + ($mn * 60);


}

############################
#
### SORT VCAL ITEMS
#
############################

function vcal_sort()
{

   $tmparr = explode(",", $this->bymonthday);
   usort($tmparr, "_ex_sort_vcal");
   if(is_array($tmparr)) $this->bymonthday = join(",",$tmparr);


   $tmparr = explode(",", $this->byday);
   usort($tmparr, "_ex_sort_vcal");
   if(is_array($tmparr)) $this->byday = join(",",$tmparr);


   $tmparr = explode(",", $this->bysetpos);
   usort($tmparr, "_ex_sort_vcal");
   if(is_array($tmparr)) $this->bysetpos = join(",",$tmparr);

}


############################
#
### SAVE AN EVENT OBJECT
#
############################
function save()
{

   global $_cal_sql, $_cal_dbpref;

   $this->freq = intval($this->freq);

   $this->venue = 0;
 
   if($this->freq != 5 && $this->freq != 0) $this->finterval = max(1,$this->finterval);

   # trim off extra commas if there are any
   $this->byday = trim($this->byday, ", ");
   $this->bymonthday = trim($this->bymonthday, ", ");
   $this->bymonth = trim($this->bymonth, ", ");
   $this->bysetpos = trim($this->bysetpos, ", ");

   if(!$this->end_after) $this->end_after = 0;

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

   # URL
   ######
   if($this->url && !strpos($this->url,"://"))
      $this->url = 'http://' . $this->url;


   # UPDATE PARENT VERSIOn
   ###########################
   if($this->override_id) {
      $_cal_sql->query("update {$_cal_dbpref}Events set version = version + 1 where id = ". $this->override_id);
   } else {
      $this->override_id = $this->override_date = 0;
   }

   # SET THIS TO AN INTEGER AT LEAST
   if(!$this->flag) $this->flag = 0;

   # UPDATED 
   ###################
   if(!$this->updated) $this->updated = time();

   # UPDATE VERSION
   $this->version++;
 
   # CORRECT SILLY PROGRAMS THAT WANT TO
   # USE SETPOS... UNNEEDEDLY Ugh
   ########################################
   if($this->freq > 0 && $this->byday && !$this->bymonthday && $this->bysetpos) {

   
      # NO MULTIPLES
      #################
      if(!strpos($this->byday,',') && !strpos($this->bysetpos,',')) {

         # IS IT ALREADY PART OF BYDAY?
         #################################
         if(strpos($this->byday, $this->bysetpos) !== 0)
            $this->byday = $this->bysetpos . $this->byday;

         # UNSET IT!
         $this->bysetpos = '';

      }
    

   } 

   # CORRECT START TIME AND END AFTER
   ##################################
   if($this->freq > 0 && !$this->override_id) {

      $this->start_timestamp = $this->start = $this->starttime;
      $this->end = $this->endtime;

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
      $r = new _cal_repeater($this);

      $n = $r->get_next_time(_ex_date("Y-n-j 0:0", $this->starttime), false, $this->starttime);

      if($n !== null)
         $this->starttime = _ex_strtotime($n . _ex_date(" H:i:0", $this->starttime), true);

      if($this->next != $this->starttime) $this->next = $this->starttime;

      # end after
      if(intval($this->end_after) > 0 && !$this->endtime) {
         $this->endtime = $r->get_last_time();
      }


      # CORRECT SILLY PROGRAMS THAT WANT TO USE WEEKLY
      # REPEATING WITH ONLY 1 BYDAY RULE
      ################################################
      if($this->freq == 3 && $this->byday && !strpos($this->byday,','))
         unset($this->byday); 

   }

   if(!strlen(trim($this->title))) $this->title = _EVENT_;

   # CORRECT DURATION
   ####################
   if(!$this->allday) {

      list($dh,$dm) = explode(":",$this->duration);
      $dm -= ($dm % 5);
  
      $this->duration = "$dh:$dm";
   }

   $this->notes = preg_replace("/<\s*script.*script\s*>/i","",$this->notes);

   $sval = parent::save();

   # UID
   ##########
   if(!$this->uid && $this->id) {
      $this->uid = md5($this->id) ."@thyme-". $_SERVER['SERVER_NAME'];
      $_cal_sql->query("update {$_cal_dbpref}Events set uid = '". $this->uid ."' where id = ". $this->id);
   }


   return $sval;
}


###########################
#
### DELETE AN EVENT
#
###########################
function delete($eid, $is_override = false)
{

   global $_cal_sql, $_cal_dbpref;
   $_cal_sql->query("delete from {$_cal_dbpref}Events where id = ". $eid);


   _cal_event::delete_attachments($eid);

   if($is_override) return;

   $_cal_sql->query("delete from {$_cal_dbpref}Reminders where eid = ". $eid);

   # remove exceptions
   #####################
   $_cal_sql->query("delete from {$_cal_dbpref}Exceptions where eid = ". $eid);



}

#############################
#
### DELETE EVENT OVERRIDES
#
#############################

function delete_overrides($eid, $starttime = false)
{
   global $_cal_sql, $_cal_dbpref;

   # get the list of overrides..
   $query = "select id from {$_cal_dbpref}Events where
        (override_id = ". $eid .") ";

   if($starttime)
      $query .= " and override_date >= ". $starttime;

   $orides = $_cal_sql->query($query);

   foreach($orides as $oride)
   {
      _cal_event::delete($oride['id'], true);


   }



}

######################################
#
### FORMAT NOTES
#
######################################
function format_notes($notes = false, $limit = 0)
{

   if($notes === false) $notes = $this->notes;

   if(!$notes) return "";

   if(strpos($notes, "</") || strpos($notes, "/>") || $limit || (strlen(@html_entity_decode($notes, ENT_QUOTES, _CHARSET_)) != strlen($notes))) {

      if($limit) {

          $notes = str_replace(array('&lsquo;',
                 '&rsquo;',
                 '&ldquo;',
                 '&rdquo;',
                 '&mdash;'),
                     array("'",
                     "'",
                     '"',
                     '"',
                     '-'), $notes);

          return @htmlentities(substr(@html_entity_decode(strip_tags(preg_replace("/<br ?\/?>/", "\n", $notes)), ENT_QUOTES, _CHARSET_), 0, $limit), ENT_QUOTES, _CHARSET_) ."...";

     }

      return $notes;

   }

   return preg_replace("/(http[s]?:\/\/.*?)([\W]*(\\s|<|$))/is","<a href='\\1' target=_blank>\\1</a>\\2",
        nl2br(@htmlspecialchars($notes,ENT_QUOTES,_CHARSET_)));

   
}

#######################################
#
### DELETE ATTACHMENTS FOR THIS EVENT
#
######################################
function delete_attachments($eid)
{

   global $_cal_dbpref;
   $attachments = $GLOBALS['_cal_sql']->query("select id from {$_cal_dbpref}Attachments where eid = ". $eid);

   if(!count($attachments)) return;

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.attachment_minimal.php");

   foreach($attachments as $aid)
   {

      _cal_attachment_minimal::delete_attachment($aid['id']);

   }


}

################################################
#
### SEE IF THE CURRENT USER CAN EDIT THIS EVENT
#
################################################
function can_edit()
{

   global $_cal_user;

   if($this->is_request) return false;

   if($_cal_user->id && ($_cal_user->id == $this->owner))
      return true;

   if($_cal_user->access->can_admin($this->cal_obj))
      return true;

   if($_cal_user->access->can_add($this->cal_obj) && ($this->cal_opts & 8) == 0)
      return true;


   return false;

}

############################################
#
### CAN WE VIEW THIS EVENT
#
############################################
function can_view()
{

   global $_cal_user, $_cal_sql, $_cal_dbpref;

   return $_cal_user->access->can_view_from_event($this->cal_obj);


}



}

?>
