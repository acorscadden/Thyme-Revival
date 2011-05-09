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
// $Id: reminders.php,v 1.20 2006/08/07 13:42:33 ian Exp $
//


global $_cal_dbpref, $_cal_event, $_cal_user;

if($_cal_event->override_id)
   $rid = $_cal_event->override_id;
else
   $rid = $_cal_event->id;


$reminders = $_cal_sql->query("select * from {$_cal_dbpref}Reminders where uid = ". $_cal_user->id .
    " and eid = ". $rid ." order by remindtime desc");

######################
#
## CHECK FOR UPDATES
#
######################
if($_REQUEST['event_action'] == _UPDATE_) {


   # 1ST REMINDER
   if($_REQUEST['remind1']) {


      $rtime = ($_REQUEST['remind1_days'] * 1440) + ($_REQUEST['remind1_time_hr'] * 60) + ($_REQUEST['remind1_time_min']);

      if(!$rtime) $rtime = 60;

      # UPDATE
      if($_REQUEST['remind1id']) {
         $_cal_sql->query("update {$_cal_dbpref}Reminders set remindtime = ". $rtime .", contact = ".
            $_cal_sql->escape_string($_REQUEST['remind1_email']) ." where id = ".
            $_cal_sql->escape_string($_REQUEST['remind1id']));

      # INSERT
      } else {
         $_cal_sql->query("insert into {$_cal_dbpref}Reminders (eid, uid, remindtime, contact) values (".
               $rid .",". $_cal_user->id . ",". $rtime .",".
                $_cal_sql->escape_string($_REQUEST['remind1_email']) .")");
      }

   # REMIND ID BUT NOT CHECKED
   } else if($_REQUEST['remind1id']) {

      $_cal_sql->query("delete from {$_cal_dbpref}Reminders
            where id = ". $_cal_sql->escape_string($_REQUEST['remind1id']));

   }

   # 2ND REMINDER
   if($_REQUEST['remind2']) {


      $rtime = ($_REQUEST['remind2_days'] * 1440) + ($_REQUEST['remind2_time_hr'] * 60) + ($_REQUEST['remind2_time_min']);

      if(!$rtime) $rtime = 60;

      # UPDATE
      if($_REQUEST['remind2id']) {

         $_cal_sql->query("update {$_cal_dbpref}Reminders set remindtime = ". $rtime .", contact = ".
            $_cal_sql->escape_string($_REQUEST['remind2_email']) .
            " where id = ". $_cal_sql->escape_string($_REQUEST['remind2id']));

      # INSERT
      } else {
         $_cal_sql->query("insert into {$_cal_dbpref}Reminders (eid, uid, remindtime, contact) values (".
               $rid .",". $_cal_user->id . ",". $rtime .",".
            $_cal_sql->escape_string($_REQUEST['remind2_email']) .")");
      }

   # REMIND ID BUT NOT CHECKED
   } elseif($_REQUEST['remind2id']) {

      $_cal_sql->query("delete from {$_cal_dbpref}Reminders
            where id = ". $_cal_sql->escape_string($_REQUEST['remind2id']));

   }
 
   $reminders = $_cal_sql->query("select * from {$_cal_dbpref}Reminders where uid = ". $_cal_user->id .
       " and eid = ". $rid ." order by remindtime");
  
}

$eml_list = array(0 => $_cal_user->email);

$eml_list += $_cal_sql->query("select id, email from {$_cal_dbpref}ContactOpts where uid = ".
    $_cal_user->id, true);

####################
#
## FORM DEFAULTS
#
####################
$_cal_form->defaults['remind1'] = isset($reminders[0]);
$_cal_form->defaults['remind2'] = isset($reminders[1]);

$_cal_form->defaults['remind1_days'] = intval($reminders[0]['remindtime'] / 1440);
$_cal_form->defaults['remind2_days'] = intval($reminders[1]['remindtime'] / 1440);

$_cal_form->defaults['remind1_email'] = $reminders[0]['contact'];
$_cal_form->defaults['remind2_email'] = $reminders[1]['contact'];

$_cal_form->defaults['remind1_time_hr'] = intval(($reminders[0]['remindtime'] % 1440) / 60);
$_cal_form->defaults['remind2_time_hr'] = intval(($reminders[1]['remindtime'] % 1440) / 60);

$_cal_form->defaults['remind1_time_min'] = $reminders[0]['remindtime'] % 60;
$_cal_form->defaults['remind2_time_min'] = $reminders[1]['remindtime'] % 60;



####################
#
## PRINT FORM
#
#####################

$_cal_tmpl->row_header_width = 0;

if(@constant("_CAL_JOB_INTERVAL_") > 5) $atleast = _REMIND_AT_LEAST_;
else $atleast = "";

$_cal_tmpl->section_row("", $atleast ." ". $_cal_form->checkbox('remind1') ." " .
    $_cal_form->select("remind1_days", range(0,15)) ." ". _DAYS_ ." ".
    $_cal_form->durationselect("remind1_time") ." ". $_cal_form->print_hidden("remind1id", $reminders[0]['id']) .
    _BEFORE_EVENT_ . " ". $_cal_form->select("remind1_email", $eml_list));

$_cal_tmpl->section_row("", $atleast ." ". $_cal_form->checkbox('remind2') ." " .
    $_cal_form->select("remind2_days", range(0,15)) ." ". _DAYS_ ." ".
    $_cal_form->durationselect("remind2_time") ." ". $_cal_form->print_hidden("remind2id", $reminders[1]['id']) .
    _BEFORE_EVENT_ . " ". $_cal_form->select("remind2_email", $eml_list));

if(@constant('_CAL_MULTI_REMIND_') && 
   (

    (_CAL_MULTI_REMIND_ == 1 && ($_cal_event->owner == $_cal_user->id || $_cal_user->access->can_admin($_cal_event->cal_obj)))
    ||

    (_CAL_MULTI_REMIND_ == 2 &&  $_cal_user->access->can_admin($_cal_event->cal_obj))
    ||
    (_CAL_MULTI_REMIND_ == 3 && $_cal_user->admin)
   )
 ) {

   require_once(_CAL_BASE_PATH_."include/classes/class.url.php");
   $_cal_url = new _cal_url("modules/groups/pick_users.php");
   $_cal_url->addArg("callback","add_reminder");

   $add = "<input type=button value='"._ADD_."' class='"._CAL_CSS_BUTTON_."'
        onClick='newWin(\"". $_cal_url->toString() ."\",500,300)'>";
}

#########################
#
### MULTIPLE REMINDERS
#
##########################
if(@constant('_CAL_MULTI_REMIND_') &&
   (

    (_CAL_MULTI_REMIND_ == 1 && ($_cal_event->owner == $_cal_user->id || $_cal_user->access->can_admin($_cal_event->cal_obj))
)
    ||

    (_CAL_MULTI_REMIND_ == 2 &&  $_cal_user->access->can_admin($_cal_event->cal_obj))
    ||
    (_CAL_MULTI_REMIND_ == 3 && $_cal_user->admin)
   )
 ) {

   require_once(_CAL_BASE_PATH_."include/multi_reminders.php");
}

$_cal_tmpl->toolbar("",$_cal_form->submit("event_action",_UPDATE_) ." ". $add .
    $_cal_form->print_hidden('remind_multi_add_id','0'),"");

require_once(_CAL_BASE_PATH_."include/js/newWin.js");


require_once(_CAL_BASE_PATH_."include/classes/class.url.php");

$_cal_url = new _cal_url(_CAL_PAGE_MAIN_);
$_cal_url->fromRequest('eid');
$_cal_url->fromRequest('instance');
$_cal_url->fromRequest('event_action');
$_cal_url->amp = '&';

?> 
<script language='javascript' type='text/javascript'>
<!--

function add_reminder(rid,name)
{
<?php if($_cal_user->options->e_popup): ?>
   document.forms['<?php echo($_cal_form->name) ?>'].elements['remind_multi_add_id'].value = rid;
   document.forms[0].submit();
<?php else: ?>
   document.location = '<?php echo($_cal_url->toString()) ?>&remind_multi_add_id=' + rid;
<?php endif ?>
}

//-->
</script>
