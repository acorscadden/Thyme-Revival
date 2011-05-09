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
// $Id: multi_reminders.php,v 1.7 2007/01/16 23:30:06 root Exp $
//


global $_cal_dbpref, $_cal_event, $_cal_user;

if($_cal_event->override_id)
   $rid = $_cal_event->override_id;
else
   $rid = $_cal_event->id;


$reminders = $_cal_sql->query("select {$_cal_dbpref}Reminders.*, {$_cal_dbpref}ContactOpts.email
    from {$_cal_dbpref}Reminders
    left join {$_cal_dbpref}ContactOpts on
        {$_cal_dbpref}ContactOpts.id = {$_cal_dbpref}Reminders.contact
    left join {$_cal_dbpref}Users on
        {$_cal_dbpref}Users.id = {$_cal_dbpref}ContactOpts.uid
    where {$_cal_dbpref}Reminders.uid != ". $_cal_user->id .
    " and eid = ". $rid ." order by {$_cal_dbpref}Users.name, {$_cal_dbpref}Reminders.uid,
        remindtime desc");

######################
#
## CHECK FOR UPDATES
#
######################
if($_REQUEST['event_action'] == _UPDATE_) {


   for($i = 0; $i < count($reminders); $i++) {
   
      # check all reminders...
      $rtime = ($_REQUEST["remind_days_{$reminders[$i]['id']}"] * 1440) +
        ($_REQUEST["remind_time_{$reminders[$i]['id']}_hr"] * 60) +
        ($_REQUEST["remind_time_{$reminders[$i]['id']}_min"]);

      $or_remind = $reminders[$i]['remindtime'];

      if($rtime != $or_remind && $reminders[$i]['id'] != $_REQUEST['remove_remind_id']) {

         $_cal_sql->query("update {$_cal_dbpref}Reminders set remindtime = {$rtime} where
            id = {$reminders[$i]['id']}");

         $reminders[$i]['remindtime'] = $rtime;
      }

   }

}

if($_REQUEST['remind_multi_add_id']) {

   $ruser = new _cal_user("","",$_REQUEST['remind_multi_add_id']);

   $tmpuser = $_cal_user;

   $_cal_user = $ruser;

   if(!$_cal_event->can_view()) {

      echo("<script language=javascript type='text/javascript'>
        alert('". sprintf(_USER_CAN_NOT_VIEW_, $_cal_user->name)."');
       </script>\n");


   } else {
      $rid = $_cal_sql->query("insert into {$_cal_dbpref}Reminders (eid,uid,remindtime,contact)
       values(". $_cal_event->id .", ". intval($_REQUEST['remind_multi_add_id']) .", 60, 0)");


      $reminders[] = array('id' => $rid, 'eid' => $_cal_event->id,
        'uid' => intval($_REQUEST['remind_multi_add_id']),
        'remindtime' => 60, 'contact' => 0, 'email' => '');
   }
   $_cal_user = $tmpuser;
}


#####################
#
### REMOVE REMINDER?
#
#####################
if($_REQUEST['remove_remind_id']) {

   $_cal_sql->query("delete from {$_cal_dbpref}Reminders where id = ".
        intval($_REQUEST['remove_remind_id']));
}

$eml_list = array(0 => $_cal_user->email);


####################
#
## PRINT FORM
#
#####################

$_cal_tmpl->row_header_width = 0;

if(@constant("_CAL_JOB_INTERVAL_") > 5) $atleast = _REMIND_AT_LEAST_ ." ";
else $atleast = "";

$_cal_url = new _cal_url(_CAL_PAGE_MAIN_);
$_cal_url->fromRequest('eid');
$_cal_url->fromRequest('instance');
$_cal_url->addArg('event_action', _VIEW_);
$_cal_url->amp = '&';

if(count($reminders)) {
   $_cal_tmpl->section_spacer();
   $_cal_tmpl->section_row("",$_cal_form->print_hidden("remove_remind_id", '0')."
<script language='javascript' type='text/javascript'>

function remove_remind(rid) {

". ($_cal_user->options->e_popup ? "
   document.forms['".$_cal_form->name."'].elements['remove_remind_id'].value = rid;
   document.forms['".$_cal_form->name."'].submit();
" : "
   document.location = '". $_cal_url->toString() ."&remove_remind_id=' + rid;
") ."
}

</script>");
}


foreach($reminders as $r) {

if($r['id'] == $_REQUEST['remove_remind_id']) continue;

if($r['uid'] > 0) {
   $ruser = new _cal_user("","",$r['uid']);
} else {
   $ruser->name = $r['email'];
}


$_cal_form->defaults["remind_days_{$r['id']}"] = intval($r['remindtime'] / 1440);

$_cal_form->defaults["remind_time_{$r['id']}_hr"] = intval(($r['remindtime'] % 1440) / 60);

$_cal_form->defaults["remind_time_{$r['id']}_min"] = $r['remindtime'] % 60;


$_cal_tmpl->section_row("", "{$ruser->name} ".$atleast . 
    $_cal_form->select("remind_days_{$r['id']}", range(0,15)) ." ". _DAYS_ ." ".
    $_cal_form->durationselect("remind_time_{$r['id']}") . _BEFORE_EVENT_MULTI_ . " ". 
    "<input type='button' value='"._REMOVE_."' class='"._CAL_CSS_BUTTON_."'  onClick='return remove_remind(". $r['id'].")'>");

}


?> 
