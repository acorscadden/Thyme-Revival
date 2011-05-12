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
// $Id: class.request.php,v 1.47 2008/02/27 20:00:13 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.event.php");

   global $_cal_user;

class _cal_request extends _cal_sql_based
{

   var $id;

   var $type = 1;

   var $title = _EVENT_;
   
   var $allday = 0;

   var $attachments = array();

   var $is_request = true;

   var $repeat_every_opts = array( 1 => _REPEATING_EVERY1_, _REPEATING_EVERY2_,
      _REPEATING_EVERY3_, _REPEATING_EVERY4_, _REPEATING_EVERY5_, _REPEATING_EVERY6_);


   var $repeat_every_val_opts = array (_DAYS_, _WEEKS_, _MONTHS_, _YEARS_, 6 => _REPEATING_SELECTED_);

   var $repeat_on_opts = array( 1 => _REPEAT_ON1_, _REPEAT_ON2_, _REPEAT_ON3_,
      _REPEAT_ON4_, _REPEAT_ON5_, _REPEAT_ONL_);

   var $repeat_on_months_opts = array( 1 => _REPEAT_MONTH1_,_REPEAT_MONTH2_, _REPEAT_MONTH3_,
      _REPEAT_MONTH4_, 6 => _REPEAT_MONTH6_, 12 => _REPEAT_MONTHY_);


################
# constructor
#################

function _cal_request($eid = 0, $instance = 0) 
{

   global $_cal_dbpref, $_cur_cal;

   # grab from sql
   ##################

   # mormal events..
   ################
   if($eid > 0) {

      $this->_cal_sql_based("{$_cal_dbpref}Requests", "id", $eid);
      $this->add_join("left join {$_cal_dbpref}EventTypes on
        {$_cal_dbpref}EventTypes.id = {$_cal_dbpref}Requests.etype and
        {$_cal_dbpref}EventTypes.calendar = {$_cal_dbpref}Requests.calendar");
      $this->add_join("left join {$_cal_dbpref}Calendars on
        {$_cal_dbpref}Requests.calendar = {$_cal_dbpref}Calendars.id");
      $this->add_translation("{$_cal_dbpref}EventTypes.name","type_name");
      $this->add_translation("{$_cal_dbpref}EventTypes.icon", "type_icon");
      $this->add_translation("{$_cal_dbpref}Requests.etype", "type");
      $this->add_translation("{$_cal_dbpref}Requests.starttime", "start");
      $this->add_translation("{$_cal_dbpref}Requests.endtime", "end");
      $this->add_translation("{$_cal_dbpref}Calendars.title", "cal_title");

      $this->fill_vars();

      $r = new _cal_repeater($this);

      $this->repeat_every = $r->repeat_every;
      $this->repeat_every_val = $r->repeat_every_val;

      if(!$this->allday) {

         list($hr,$mn,$sc) = explode(":", $this->duration);
         $this->ends_at = $this->start + ($hr * 3600) + ($mn * 60);

      }

      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

      if($_cur_cal->id == $this->calendar) {
         $this->cal_obj = $_cur_cal;
      } else {
         $this->cal_obj = new _cal_obj($this->calendar);
      }


   # default event we're getting
   # ready to create..
   } else {

      $this->_cal_sql_based("{$_cal_dbpref}Requests", "id");
      $this->cal_obj = $_cur_cal;

      $this->not_found = true;
   }

   $this->sequence = "{$_cal_dbpref}requests_id_seq";

   $this->category = $this->type_name;

   # multiple categories
   ####################333
   if(!$this->type_name && $this->type && !$this->not_found) {


         $this->category = $this->type_name = $this->cal_obj->get_category_name($this->type);

         $this->type_icons = $this->cal_obj->get_category_icons($this->type);

   } else if($this->type_icon) {

         $this->type_icons[] = $this->type_icon;
   }

}


####################################
#
### CREATE EVENT FROM REQUEST
#
###################################

function mk_event()
{

   global $_cal_user;

   if(!$this->id) return;

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.event.php");

   $e = new _cal_event();

   # exclude these vars
   $excludes = array_flip(array("sequence","translations","key","keyval","id","fields","joins","table","excludes"));

   # CHOWN EVENTS SUBMITTED BY GUEST USER
   if(!$this->owner)
      $this->owner = intval($_cal_user->id);

   # set event
   foreach(array_keys(get_object_vars($this)) as $v)
   {

      if(isset($excludes[$v])) continue;

      $e->$v = $this->$v;
      

   }

   $e->id = 1;
   $e->added = time();

   # save event
   if($e->save())
      $this->delete();

}

################################
#
### delete request
#
#################################

function delete()
{

   global $_cal_dbpref;

   if(!$this->id) return;

   $GLOBALS['_cal_sql']->query("delete from {$_cal_dbpref}Requests where id = ". $this->id);

}

####################################
# CALCULATE TIME TILL OR FROM EVENT
####################################

function uptime()
{

   $diff = (_ex_strtotime(_ex_date("Y-n-j 0:0:0",$this->start)) - _ex_strtotime(_ex_date("Y-n-j 0:0:0", time())));

   if($diff < 0) {
      $diff = abs($diff);
      $ago = " "._AGO_;
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
   $up .= $ago;


   return $up;

}

############################
#
### SET LOCALTIME
#
###########################
function set_localtime($instance = null)
{

   global $_cal_user;

   if($this->allday || !@constant("_CAL_ENABLE_TZ_")) return;

   $this->dst_obj or $this->dst_obj = new _cal_dst($this->dst);

   # set timezone and dst
   $this->start -= (($this->timezone * 3600) - ($_cal_user->options->timezone * 3600));
   $this->start += (($_cal_user->dst->is_dst($this->start)) - ($this->dst_obj->is_dst($this->start))) * 3600;

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

################################################
#
### SEE IF THE CURRENT USER CAN EDIT THIS EVENT
#
################################################
function can_edit()
{

   global $_cal_user;

   return (!$this->id || $_cal_user->access->can_admin($this->cal_obj));

}

function can_view()
{

   global $_cal_user;

   return (!$this->id || $_cal_user->access->can_admin($this->cal_obj) || $this->not_found);

}

function save()
{

   global $_cal_sql, $_cur_cal, $_cal_user, $_cal_html, $_cal_modules, $_cal_form, $_cal_tmpl;

   if($this->freq != 5 && $this->freq != 0) $this->finterval = max(1,$this->finterval);

   # trim off extra commas if there are any
   $this->byday = trim($this->byday, ",");
   $this->bymonthday = trim($this->bymonthday, ",");
   $this->bymonth = trim($this->bymonth, ",");
   $this->bysetpos = trim($this->bysetpos, ",");

   # make sure times are correct
   if($this->starttime && strpos($this->starttime, '-'))
      $this->starttime = _ex_strtotime($this->starttime);

   if($this->endtime && strpos($this->endtime, '-'))
      $this->endtime = _ex_strtotime($this->endtime);

   # set next ..
   if($this->freq == 0)
      $this->next = $this->starttime;
   else
      $this->next = 0;

   if(!$this->id) {
      $this->owner = $GLOBALS['_cal_user']->id;
      $this->added = time();
   }

   $this->owner = intval($this->owner);

   $this->updated = time();
   $this->added or $this->added = time();

   $this->uid = 'req-' . time() ."-". rand(0,100) ."@thyme-". $_SERVER['SERVER_NAME'];

   #######################
   #
   ### SEND EMAIL TO OWNER
   #
   #######################
   if(!parent::save()) return false;

   if(!$this->cal_obj) {
      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
      $this->cal_obj = new _cal_obj($this->calendar);
   }

   if($this->cal_obj->request_notify && $this->not_found && @constant("_CAL_MAIL_FROM_")) {


      ###########################
      #
      ### CHECK CURRENT OBJECTS
      #
      ###########################
      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");

      $_cal_html or $_cal_html = new _cal_html();
      $_cal_form or $_cal_form = new _cal_form(); 
      $_cal_tmpl or $_cal_tmpl = new _cal_template('event_view_template');

      $_tmp_usr = $_cal_user->id;

      $_cal_user = new _cal_user("","",$this->cal_obj->owner);

      $subject = _PENDING_REQUEST_ ." ". $this->cal_obj->title;

      require_once(@constant("_CAL_BASE_PATH_") ."include/send_event.php");
      require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");

      $msg = $subject;
      $msg .= "\n\n" . _REQUESTS_ .": ". _CAL_BASE_URL_._CAL_PAGE_MAIN_."?module=requests\n\n";

      $murl = new _cal_url(_CAL_PAGE_MAIN_);
      $murl->addArg("module", "requests");
      $murl->addArg("rid", abs($this->id));
      $murl->addArg("r_action", "accept");

      $htmlmsg = "<div align='center'>
                <a class='"._CAL_CSS_ULINE_." "._CAL_CSS_BODY_."' href='". $murl->toString() ."'>"._ACCEPT_."</a> &nbsp; &nbsp; &nbsp; ";

      $murl->addArg("r_action", "reject");

      $htmlmsg .= "<a class='"._CAL_CSS_ULINE_." "._CAL_CSS_BODY_."' href='". $murl->toString() ."'>"._REJECT_."</a></div>\n";

      # force html format
      $this->force_html = 1;
      send_event($this->cal_obj->request_contact, $this, $subject, $msg, $htmlmsg);

      $_cal_user = new _cal_user($_tmp_usr);

      unset($_REQUEST['eid']);

   }

   return true;
}

function format_notes($notes = false, $limit = 0) {

   if($notes === false) $notes = $this->notes;
   return _cal_event::format_notes($notes, $limit);

}

}

?>
