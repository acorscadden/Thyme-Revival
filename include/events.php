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

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/helpers/tie_to.php");

   require_once(@constant("_CAL_BASE_PATH_") . "include/attachments.php");


   global $_cal_sql, $_cal_html, $_cal_err_msgs, $_cal_user, $_cal_vcal_wdays, $_cal_event, $_cur_cal, $_cal_dbpref, $cal, $_cal_tmpl;


   $_REQUEST['instance'] = preg_replace('/[^0-9-]/','',$_REQUEST['instance']);
   $_REQUEST['eid'] = intval($_REQUEST['eid']);

   ####################################
   #
   ### CHECK FOR ADD ACTION ON A VIEW
   #
   ###################################
   if($_REQUEST['event_action'] == _ADD_ && $_cur_cal->has_subcals && $_cur_cal->show_add) {

      require_once(_CAL_BASE_PATH_.'include/classes/class.table.php');

      # get list of calendars we can add or request on
      $cids = array_merge(array_keys($_cur_cal->requestable),array_keys($_cur_cal->addable));

      $cals = $_cal_sql->query("select id, title from {$_cal_dbpref}Calendars
        where id in (". join(',',$cids).") order by lower(title)", true);

      $_cal_html->print_heading(_NEW_EVENT_);

      $_cal_form = new _cal_form('pick_cal_add');
      $_cal_form->print_header();
      $_cal_form->print_hidden('event_action', _ADD_);
      $_cal_form->print_hidden('m');
      $_cal_form->print_hidden('d');
      $_cal_form->print_hidden('y');

      $_cal_url = new _cal_url();
      $_cal_url->addArg('calendar', $_cur_cal->id);
      $_cal_form->print_hidden('return_url', $_cal_url->toString());
      $_REQUEST['return_url'] = $_cal_url->toString();

      echo("<div align='center'><h4 style='display: inline'>"._CALENDAR_.": </h4> ".
        $_cal_form->select('calendar', $cals) ."</div><br />");

      $_cal_table = new _cal_table();
      $_cal_table->print_header(array());
      $_cal_table->print_row(array(
        $_cal_form->submit('cdc', _NEXT_) ." ".
            "<input type='button' value='". _CANCEL_."' class='".
                _CAL_CSS_BUTTON_."' onClick='history.go(-1)'>"));
      $_cal_table->print_footer();

      $_cal_form->print_footer();

      # CHECK FOR ONLY ONE CAL IN LIST
      if(count($cals) === 1) {

         $_cal_html->js_onload[] = "document.forms['pick_cal_add'].submit();";

      }
 
      return;
   }

   if($_REQUEST['return_url']) $GLOBALS['_cal_persistent_url']['return_url'] = $_REQUEST['return_url'];

   #######################################
   ### FOR EVENT COPY
   #######################################
   if(!defined('_COPY_')) define('_COPY_','Copy');
   if($_REQUEST['event_action'] == _COPY_) {
      $_cal_event = new _cal_event(intval($_REQUEST['eid']));
      $_cur_cal = $_cal_event->cal_obj;
   }
 
   #############################################
   #
   ### ADDING AN EVENT OR REQUESTING ONE
   #
   #############################################
   $valid_req_actions = array(_ADD_=>1,_SAVE_=>1,_NEXT_=>1,_PREV_=>1);

   $te = new _cal_event(intval($_REQUEST['eid']));

   # if we're not just viewing, and we can't add, and
   # requests are configured it's a request
   ##########################################################
   if(($valid_req_actions[$_REQUEST['event_action']] && 
        !$_cal_user->access->can_add($_cur_cal)  && ($_cur_cal->options & 2) && $_cur_cal->type == 0)

        ||

   # we can add, technically .. but event requests are configured..
   # in 'View-Only' mode
   ##############################################################
        (($valid_req_actions[$_REQUEST['event_action']] && (!($_cal_user->id > 0 && $te->id > 0 && $te->can_edit())) && 
        $_cal_user->access->can_add($_cur_cal)  && !$_cal_user->access->can_admin($_cur_cal) && (($_cur_cal->options & 130) == 130)))

        ||

   # an admin wants to edit an event request
   ############################################
        ($_REQUEST['eid'] < 0)

   ) {
      require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.request.php");

      $_cal_event = new _cal_request(abs($_REQUEST['eid']));
      unset($_REQUEST['instance']);
      unset($_REQUEST['apply_to1']);

      # if we're editing an event request, make sure we can admin the calendar
      # it belongs to
      ####################################################333
      if($_REQUEST['eid'] < 0 && !$_cal_user->access->can_admin($_cal_event->cal_obj)) {

         $_cal_html->permission_denied();
         return;

      } else if($_REQUEST['eid'] < 0 && !$_REQUEST['return_url']) {
 
        $_REQUEST['return_url'] = _CAL_BASE_URL_._CAL_PAGE_MAIN_.'?module=requests';
        $GLOBALS['_cal_persistent_url']['return_url'] = $_REQUEST['return_url'];

      } 


   } else {
      $_cal_event = new _cal_event($_REQUEST['eid']);

   }

   if(!$_cal_event->calendar) {

      $_cal_event->calendar = $_cur_cal->id;
      $_cal_event->cal_title = $_cur_cal->title;
      $_cal_event->cal_obj = $_cur_cal;
   }

   $_cal_event->next = 0;

   if(!$_cal_event->calendar) {
      echo("No calendar selected.");
      return;
   }

   $_return_url = $_REQUEST['return_url'];


#######################################
#
###  CHECK EVENT ACTION
#
#######################################
switch(strtolower($_REQUEST['event_action']))
{



   ######################################
   #
   ### CANCEL? JUST GO TO RETURN_URL
   #
   #######################################
   case strtolower(_CANCEL_):

      $url = new _cal_url(_CAL_PAGE_MAIN_);
      $url->amp = '&';

      if($_return_url) {
         $url->base = $_return_url;
         $url->args = array();
      }

      $_cal_html->js_redirect($url->toString() . $mark);

      echo("<br><br>");
      echo("<table align='center'><tr><td><h3><a href=\"" . $url->toString() . $mark ."\">". _RETURN_ .
      "</a></h3></td></tr></table>");

      echo("<br><br>");

      return;

   #######################################
   #
   ### FOR EVENT REQUESTS
   #
   ######################################

   case strtolower(_NEXT_):

      $_cal_html->print_heading(_REQUESTS_ ." - ". $_cal_event->cal_title);

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

      ?>
      <br><br>
      <?php

         unset($_REQUEST['event_action']);

         $_cal_form = new _cal_form("requestfrm");
         $_cal_form->print_header();

         # dump all request vars to hidden elements
         $_cal_form->dump_request();


      ?>
      <table class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." ". _CAL_CSS_CAL_CONTENT_)?>' width=400 align='center' cellpadding=8>
      <tr><th><?php echo(_REQUEST_NOTES_); ?></th></tr>
      <tr><td><?php echo($_cal_form->textarea("request_notes",5, 70)) ?>
      <br><br>
      <?php

         $_cal_form->defaults['request_contact'] = $GLOBALS['_cal_user']->email or
            $_cal_form->defaults['request_contact'] = $_REQUEST['org_email'];

         if(@constant("_CAL_MAIL_FROM_")) {

            echo($_cal_form->checkbox("request_notify") ." ");
            echo(_REQUEST_NOTIFY_STATUS_ ." ");
            echo($_cal_form->textbox("request_contact", 32, 32));
         }
      ?>

      </td></tr>
      <tr>
      <td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
      <?php
         echo($_cal_form->submit("event_action", _PREV_, " style='width: 100px' ") ." &nbsp; &nbsp; ");
         echo($_cal_form->submit("event_action", _SAVE_, " style='width: 100px' ") ." &nbsp; &nbsp; ");
         echo($_cal_form->submit("event_action", _CANCEL_, " style='width: 100px' "));
       ?>
       </td></tr></table>
       <br><br>
       <?php

        $_cal_form->print_footer();

       return;


   #####################################
   #
   ### SAVE EVENT
   #
   ####################################
   
   case strtolower(_SAVE_):
   case strtolower(_SAVE_ADD_):   

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/helpers/tie_to.php");


      # UNSET UPDATED LOGIC:
      #
      # * if ADDING an override (apply_to1 == this), do not unset update, the event
      #   override added field will take care of the notification
      #
      # * if UPDATING an override usnet updated
      # 
      # * if ADDING an event, do nothing, updated is not set
      #
      # * if UPDATING an event, unset updated
      #
      ###########################################################################

      
      # save end time for deleting
      # overrides and exclusions
      $or_endtime = $_cal_event->end;
      $or_starttime = $_cal_event->start;

      _ex_tie_to($_cal_event, $_REQUEST);

      # Reset calendar id if set by request
      ########################################
      if($_REQUEST['calendar'] != $_cal_event->cal_obj->id)
         $_cal_event->calendar = $_cal_event->cal_obj->id;

      # EVENT HAS NO ID, BUT ecalendar IS SET
      # EVENT WAS COPIED FROM A VIEW
      if(!$_cal_event->id && $_REQUEST['ecalendar']) {
         $_cal_event->calendar = intval($_REQUEST['ecalendar']);
         $_cal_event->cal_obj = new _cal_obj(intval($_REQUEST['ecalendar']));
         unset($_REQUEST['ecalendar']);
      }

      # CHECK FOR ACCESS
      #####################
      if(!$_cal_event->is_request && !$_cal_event->can_edit()) {
        $_cal_html->permission_denied();
        return;
      }
         

      # CHANGE OWNER?
      #####################
      if(intval($_REQUEST['chown_user']) && $_cal_user->access->can_admin($_cal_event->cal_obj) &&
            !$_cal_event->is_request && $_cal_event->id) {

         $_cal_sql->query("update {$_cal_dbpref}Events set owner = ". intval($_REQUEST['chown_user'])
                  ." where id = {$_cal_event->id} or override_id = {$_cal_event->id}");

         $_cal_event->owner = intval($_REQUEST['chown_user']);

      }

      # CHANGE CALENDAR
      #######################
      $_REQUEST['ecalendar'] = intval($_REQUEST['ecalendar']);
      if($_REQUEST['ecalendar'] && (!$_cal_event->is_request || $_cal_user->access->can_admin($_cal_event->cal_obj))) {

         $acal = new _cal_obj($_REQUEST['ecalendar']);

         # see if user can add to target calendar
         if($_cal_user->access->can_add($acal)) {

            # update overrides
            if(!$_cal_event->is_request && $_cal_event->id) {

               $_cal_sql->query("update {$_cal_dbpref}Events set calendar = {$_REQUEST['ecalendar']}
                   where override_id = {$_cal_event->id}");
            }
            $_cal_event->calendar = $_REQUEST['ecalendar'];
 
            $_cal_event->cal_obj = $acal;
            $_cal_event->cal_title = $acal->title;
            $_cal_event->type = $_cal_event->etype = 0;

         }
      }

      # APPLY TO THIS DATE ONLY..
      ##############################
      if($_REQUEST['apply_to1'] == "this") {

         # set this override stuff..
         #############################
         $_cal_event->override_id = $_REQUEST['eid'];
         $_cal_event->override_date = _ex_strtotime($_REQUEST['instance']);
         unset($_cal_event->keyval);

         # unset next time event will happen
         $_cal_sql->query("update {$_cal_dbpref}Events set
            next = 0 where id = ". intval($_REQUEST['eid']));

         # override events do not repeat.
         ################################
         $_cal_event->freq = 0;

         unset($_cal_event->updated);

      # APPLY TO ALL DATES (or it doesnt' repeat)
      ##################################
      } else if(!$_cal_event->is_request) {
     

         # if we've changed a date or rrule
         ####################################
         if($_REQUEST['rrule_diff'] && $_REQUEST['eid']) {
            
            _cal_event::delete_overrides($_REQUEST['eid']);

            $_cal_sql->query("delete from {$_cal_dbpref}Exceptions where eid = ". $_REQUEST['eid']);

         }
 
         $_cal_event->updated = null;

      }


      #################################
      # set starting time and duration
      # if it is not an all day event..
      ##################################

      if($_cal_event->allday == 0) {

         $_cal_event->duration = intval($_cal_event->duration_hr).':'.
                intval($_cal_event->duration_min).':0';

      } else {

         $_cal_event->starttime_hr = $_cal_event->starttime_min = 0;
         $_cal_event->duration = '0:0:0';
      }


      # is the event flagged?
      ########################
      $_cal_event->flag = intval($_REQUEST['flag']);


      ###############################
      # set repeating options ...
      # or rather, zero out options
      # which we should ignore
      ##################################################
      if(($_cal_event->ends == "after" && $_cal_event->end_after == 1) || $_REQUEST['apply_to1'] == "this") {

         $_cal_event->freq = 0;
    

      #####################
      # SIMPLE REPEAT
      ##################### 
      } elseif($_cal_event->r_source == _SIMPLE_) {

         # set repeating options for event


         ####################
         # REPEAT EVERY X
         ####################
         if($_cal_event->repeat == "repeat") {

            $_cal_event->finterval = $_cal_event->repeat_every;

            /*
               FORM:
                    0 = days
                    1 = weeks
                    2 = months
                    3 = years
                    4 = easter yearly
                    6 = selected days

               DB:
                    0 = don't repeat
                    1 = years
                    2 = months
                    3 = weeks
                    4 = days
                    5 = easter yearly
            */

            $_cal_event->byday = $_cal_event->bymonth = $_cal_event->bysetpos = $_cal_event->bymonthday = '';

            $_cal_event->wkst = $_cal_user->options->week_start;

            switch(intval($_cal_event->repeat_every_val))
            {

               # daily
               case 0:
                  $_cal_event->freq = 4;
                  break;
                 
               # weekly
               case 1:
                  $_cal_event->freq = 3;
                  break;

               # monthly
               case 2:
                  $_cal_event->freq = 2;
                  break;

               # yeary
               case 3:
                  $_cal_event->freq = 1;
                  break;
             
               # selected days
               case 6:
                  $_cal_event->freq = 3;
                  $touched = 0;
                  for($i = 1; $i < 8; $i++)
                  {
                     if($_REQUEST["repeat_selected_" . $i] > 0) {
                        $_cal_event->byday .= $_cal_vcal_wdays[($i - 1)] .",";
                     }
                     
                  }
                  if(!strlen($_cal_event->byday)) { $_cal_event->byday = $_cal_vcal_wdays[0]; }
                  $_cal_event->byday = rtrim($_cal_event->byday, ",");
                  break;
            }



         ######################
         # REPEAT ON X
         ######################
         } else {

            $_cal_event->finterval = $_cal_event->repeat_on_months;
            $_cal_event->freq = 2; # monthly
            if($_cal_event->repeat_on > 5) $_cal_event->repeat_on = -1;

            $_cal_event->byday = $_cal_event->repeat_on . $_cal_vcal_wdays[$_cal_event->repeat_on_wday];

         }

         $_cal_event->bysetpos = '';

      ###################
      # ADVANCED REPEAT
      ###################
      } else if($_cal_event->r_source == _ADVANCED_) {

         $_cal_event->freq = $_cal_event->r_freq + 1;

         switch($_cal_event->r_freq)
         {

            # years
            case 0:
               $_cal_event->bymonth = mklist_request("r_year_month_", 12);
               $_cal_event->byday = mklist_request("r_year_wday_", 7);
               $_cal_event->byday = str_replace(range(0,6), $_cal_vcal_wdays, $_cal_event->byday);
               $_cal_event->bymonthday = rtrim($_cal_event->r_years_mdays_hidden,",");
               $_cal_event->finterval = $_cal_event->r_years;
               break;

            # months
            case 1:
               $_cal_event->byday = rtrim($_cal_event->r_months_wdays_hidden, ",");
               $_cal_event->bymonthday = rtrim($_cal_event->r_months_mdays_hidden, ",");
               $_cal_event->bymonth = null;
               $_cal_event->finterval = $_cal_event->r_months;
               break;

            # weeks
            case 2:
               $_cal_event->byday = mklist_request("r_week_wday_", 7);
               $_cal_event->byday = str_replace(range(0,6), $_cal_vcal_wdays,$_cal_event->byday);
               $_cal_event->bymonthday = null;
               $_cal_event->bymonth = mklist_request("r_week_month_", 12);
               $_cal_event->finterval = $_cal_event->r_weeks;
               break;

            # days 
            case 3:
               $_cal_event->byday = mklist_request("r_day_wday_", 7);
               $_cal_event->byday = str_replace(range(0,6), $_cal_vcal_wdays,$_cal_event->byday);
               $_cal_event->bymonthday = null;
               $_cal_event->bymonth = mklist_request("r_day_month_", 12);
               $_cal_event->finterval = $_cal_event->r_days;
               break;

            # easter
            case 4:
               $_cal_event->finterval = intval($_cal_event->r_easter);
               if($_cal_event->r_easter_when != 1) $_cal_event->finterval = -($_cal_event->finterval);
               # unset all other rules
               $_cal_event->byday = $_cal_event->bymonth = $_cal_event->bymonthday = null;
               break;


         }


         if($_cal_event->r_freq != 4) $_cal_event->finterval = max(1,$_cal_event->finterval);
         $_cal_event->bysetpos = rtrim($_REQUEST['r_months_setpos_hidden'], ",");
         $_cal_event->wkst = $_cal_event->r_wkst;

      #######################
      # EVENT DOES NOT REPEAT
      #######################
      } else {

         $_cal_event->freq = $_cal_event->end_after = $_cal_event->ends = 0;


      }

      #################################
      # set start date..
      ################################
      $_cal_event->starttime = _ex_mktime($_cal_event->starttime_hr,$_cal_event->starttime_min,0,
                $_cal_event->startdate_mo,$_cal_event->startdate_da,$_cal_event->startdate_yr);

      #################################
      # set ending date if event ends..
      #################################
      if($_cal_event->ends == 1) {

         $_cal_event->end_after = 0;
         
         $_cal_event->endtime = _ex_strtotime($_cal_event->enddate_yr.'-'.$_cal_event->enddate_mo.
         	'-'.$_cal_event->enddate_da);

         # error check end date..
         $start = _ex_mktime(0,0,0,$_cal_event->startdate_mo,
         	$_cal_event->startdate_da,$_cal_event->startdate_yr);


         # just set it to a day ahead if it's wrong
         if($_cal_event->endtime <= $start) {
            $_cal_event->endtime = $start + 86400;
         }


      } else if($_cal_event->ends == "after" && $_cal_event->end_after > 1 && !$_cal_event->override_id) {

         $_cal_event->start = $_cal_event->start_timestamp = $_cal_event->starttime;

         $r = new _cal_repeater($_cal_event);
         $_cal_event->endtime = $r->get_last_time();

      } else {
     
         $_cal_event->endtime = null;
         $_cal_event->end_after = 0;

      }

      if(!isset($_cal_event->override_id)) {
         $_cal_event->override_id = 0;
      }

      # CHECK FOR MULTIPLE TYPES
      #############################
      if($_cal_event->cal_obj->options & 32) {

         $_cal_event->type = 0;

         foreach(array_keys($_cal_event->cal_obj->get_categories()) as $cat_id) {
            if($_REQUEST['et_' . $cat_id]) $_cal_event->type += $cat_id;
         }
      }
  
      $_cal_event->etype = $_cal_event->type;


      # no blank event titles
      if(!strlen(trim($_cal_event->title)))
         $_cal_event->title = "-----";

      ##########################
      #
      ### DELETE OLD EXCEPTIONS
      #
      ##########################
      if(!$_cal_event->override_id && $_REQUEST['eid'] && $or_endtime) {

         _cal_event::delete_overrides($_REQUEST['eid'], $or_endtime);

      }


      ###########
      if(!$_cal_event->save()) {
         echo("<BR>". _ERROR_. ": events.php :: \$_cal_event->save()<br>\n");
         return;
      }

      ######################
      #
      ### UPDATE EXCLUSIONS
      #
      ######################

      if($_cal_event->id && !$_cal_event->is_request && !$_cal_event->override_id) {

         # delete all that happen after our end date
         ############################################
         if($or_endtime) {
            $_cal_sql->query("delete from {$_cal_dbpref}Exceptions where eid = ". $_REQUEST['eid'] ." and
               (exdate >= ". $or_endtime ." or exdate <= ". $or_starttime .")");
         }

         $exes = $_cal_sql->query("select exdate, id
            from {$_cal_dbpref}Exceptions where eid = ". $_cal_event->id, true);


         $new_exes = array_map("d_to_t",explode(",",rtrim($_REQUEST['r_exclude_hidden'],",")));

         $create = $delete = array();

         foreach($new_exes as $ex)
         {
            if($ex === null) continue;

            if(isset($exes[$ex])) {
               unset($exes[$ex]);
               continue;
            }
            $create[] = $ex;
         }

         # delete old ones still in the list..
         foreach($exes as $ex)
         {
            $_cal_sql->query("delete from {$_cal_dbpref}Exceptions where id = ". $ex);
         }


         # insert new ones
         foreach($create as $ex)
         {

            # don't add if it's before starttime
            if($ex <= $e->starttime) continue;

            $_cal_sql->query("insert into {$_cal_dbpref}Exceptions (eid, exdate) values (".
                $_cal_event->id .", ". $_cal_sql->escape_string($ex) .")");

         }

      }

      ##############################
      #
      ### HANDLE REQUESTS
      #
      ##############################
      if($_cal_event->is_request && !($_REQUEST['eid'] < 0)) {


         if(!$_cal_event->cal_obj->request_post) {

               $url = new _cal_url(_CAL_PAGE_MAIN_);
               $url->amp = '&';

               if($_return_url) {
                  $url->base = $_return_url;
                  $url->args = array();
               }

               $_cal_html->js_redirect($url->toString() . $mark);

               echo("<br><br>");
               echo("<table align='center'><tr><td><h3><a href=\"" . $url->toString() . $mark ."\">". _RETURN_ .
                  "</a></h3></td></tr></table>");

               echo("<br><br>");

               return;
           }
          
           $_cal_html->print_heading(_REQUESTS_ ." - ". $_cal_event->cal_title);


           require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
           
           
           ?>
           <br><br>
           <h4 style='padding: 8px'><?php echo(nl2br($_cal_event->cal_obj->request_post)) ?></h4>
           <br><br> 
           <?php
  
             $_cal_form = new _cal_form();
             $_cal_form->print_header();
           
           ?>
           <table class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." "._CAL_CSS_CAL_CONTENT_) ?>' width=300 align='center' cellpadding=8>
           <tr>
           <td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
           <?php
              if($_REQUEST['return_url']) {
                echo("<input type=button value='"._CLOSE_."' style='width: 100px' onClick='document.location = \"{$_REQUEST['return_url']}\"'>");
              } else {
                echo($_cal_form->submit("", _CLOSE_, " style='width: 100px' "));
              }
           ?>
           </td></tr></table>
           
           <br><br>
           
           
           <?php 

           $_cal_form->print_footer(); 
          
           return; 


      }


      ###################
      #
      ### ATTACHMENTS
      #
      ###################

   case strtolower(_UPDATE_ATTACHMENTS_):


      # CHECK FOR ACCESS
      #####################
      if(!$_cal_event->is_request && !$_cal_event->can_edit()) {
        $_cal_html->permission_denied();
        return;
      }


         update_attachments($_cal_event);


      $url = new _cal_url(_CAL_PAGE_MAIN_);
      $url->amp = '&';

      if($_return_url) {
         $url->base = $_return_url;
         $url->args = array();
      }

      if(!count($_cal_err_msgs) && strcasecmp($_REQUEST['event_action'],_SAVE_ADD_) == 0) {

         $url->addArg("event_action", _ADD_);

      } else if(count($_cal_err_msgs) || strcasecmp($_REQUEST['event_action'],_UPDATE_ATTACHMENTS_) == 0) {

         $url->addArg("event_action", _EDIT_);
         $url->addArg("eid", $_cal_event->id);
         $url->addArg("attachments_updated", 1);
 
         $mark = "#attach";

      } else if(!$_cal_event->is_request && @constant('_CAL_VIEW_EVENT_AFTER_SAVE_')) {

         $url = new _cal_url();
         $url->amp = "&";
         $url->eq = "=";
         $url->start = "?";

         $url->addArg("event_action", _VIEW_);
         $url->addArg("eid", $_cal_event->id);
         $url->addArg("event", $_cal_event->id);

      }


      if(count($_cal_err_msgs)) {
         $_cal_html->print_heading(_ERROR_);
         echo("<br><br>");

         foreach($_cal_err_msgs as $err)
         {
            echo("<h3><font class='"._CAL_CSS_HIL_."'>". $err ."</font></h3><br>");
         }

      } else {
         $_cal_html->js_redirect($url->toString() . $mark);
      }

      echo("<br><br>");
      echo("<table align='center'><tr><td><h3><a href=\"" . $url->toString() . $mark ."\">". _RETURN_ .
         "</a></h3></td></tr></table>");

      echo("<br><br>");

      break;




#####################################
#
### EDIT OR ADD EVENT
#
#####################################

   case strtolower(_PREV_):
     _ex_tie_to($_cal_event, $_REQUEST);
     $_REQUEST['header_displayed'] = _NEXT_;

     if(!$_cal_event->is_request) {
        $_cal_html->permission_denied();
        return;
     }
 
 
   case strtolower(_ADD_):

     $_cal_event->start = _ex_mktime(0,0,0,$_REQUEST[$cal->listeners['month']],
        $_REQUEST[$cal->listeners["day"]],$_REQUEST[$cal->listeners['year']]);

     $_cal_event->rep_sel = _NONE_;
     $_cal_event->freq = 0;
     $_cal_event->finterval = 0;
     $_cal_event->repeat=0;
     $_cal_event->repeat_on= 0;
     $_cal_event->repeat_every = $_cal_event->repeat_every_val = $_cal_event->repeat_on =
     $_cal_event->repeat_on_wday = $_cal_event->repeat_on_months = 0;

   case strtolower(_COPY_):

     if($_REQUEST['instance']) {
        $_cal_event->set_localtime($_REQUEST['instance']);
     }

     $_cal_event->id = $_cal_event->keyval = 0;
     $_cal_event->not_found = 1;

     $_cal_event->override_id = 0;
     $_cal_event->override_date = 0;
     $_cal_event->attachments = array();

     unset($_REQUEST['eid']);
     unset($_REQUEST['instance']);
     unset($_cal_event->instance);


    if(!$_cal_event->is_request && !$_cal_user->access->can_add($_cal_event->cal_obj)) {
        $_cal_html->permission_denied(); # fixed
        return;
     }

   case strtolower(_EDIT_):

     # CHECK FOR ACCESS TO EDIT

     if(!$_cal_event->is_request && $_cal_event->id > 0 && !$_cal_event->can_edit()) {
        $_cal_html->permission_denied(); # fixed
        return;
     }

     if(!$_REQUEST['header_displayed'] && $_cal_event->is_request && $_cal_event->cal_obj->request_pre) $request_header = 1;
     require(@constant("_CAL_BASE_PATH_") . "include/templates/event_edit_tpl.php");
     break;


###################################
#
## EXPORT EVENT
#
###################################

   case strtolower(_EXPORT_):

      require(@constant("_CAL_BASE_PATH_") . "include/event_export.php");
      break;

###################################
#
## EMAIL EVENT
#
###################################

   case strtolower(_TELL_A_FRIEND_):
   case strtolower(_EMAIL_):

      require(@constant("_CAL_BASE_PATH_") . "include/event_email.php");
      break;


###################################
#
### RESET AN OVERRIDE EVENT
#
###################################

   case strtolower(_RESET_):


      # CHECK FOR ACCESS
      #####################
      if(!$_cal_event->can_edit()) {
        $_cal_html->permission_denied();
        return;
      }

      # just set the override id to 0 and
      # lte the _DELETE_ case take care of it

      $_REQUEST['really_delete'] = 1;
      
      # increment version
      $_cal_sql->query("update {$_cal_dbpref}Events set version = version + 1 where id = ". $_cal_event->override_id);

      $_cal_event->override_id = 0;

###################################
#
### DELETE AN AVENT
#
###################################
   case strtolower(_DELETE_):

      # CHECK FOR ACCESS
      #####################
      if(!$_cal_event->can_edit()) {
        $_cal_html->permission_denied();
        return;
      }

     
      if($_REQUEST['really_delete'] == 1) {

         update_attachments($_cal_event);


         $url = new _cal_url(_CAL_PAGE_MAIN_);
         if($_return_url) {
            $url->base = $_return_url;
            $url->args = array();
         }

         $_cal_sql or $_cal_sql = new _cal_sql();

         # just delete this instance..
         #############################   
         if($_REQUEST['apply_to1'] == "this") {

            # create an override event with a zero
            # start time
            $exdate = _ex_strtotime($_REQUEST['instance'] ." 0:0:0");

            $_cal_sql->query("insert into {$_cal_dbpref}Exceptions (eid, exdate) values (".
                $_cal_event->id .", ". $_cal_sql->escape_string($exdate) .")");

            # set the current event's next time
            # to 0 so the event_list class will
            # update it
            $_cal_event->next = 0;

            $_cal_event->save();


         # delete override
         } else if($_cal_event->override_id) {

            # increment version
            $_cal_sql->query("update {$_cal_dbpref}Events set version = version + 1 where id = ". $_cal_event->override_id);
            
            _cal_event::delete($_cal_event->id, true);

            # insert exclusion for this event
            $_cal_sql->query("insert into {$_cal_dbpref}Exceptions (eid, exdate) values (". $_cal_event->override_id
                .", ". $_cal_event->override_date .")");
     

         } else {

            # deleting all events? remove all overrides
            # for this event. They're no longer needed 
            if(($_REQUEST['apply_to1'] == "all" || !$_REQUEST['apply_to1']) && !$_cal_event->override_id > 0) {
               _cal_event::delete_overrides($_REQUEST['eid']);
            }

        
            _cal_event::delete($_REQUEST['eid'], intval($_cal_event->override_id > 0));
 
         }

        

         $_cal_html->js_redirect($url->toString());

         echo("<a href='". $url->toString() ."'>". _RETURN_ ."</a><br>\n");

         break;

      }


      require(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_list.php");

      $_cal_event_list = new _cal_event_list();
      $_cal_event_list->display_delete_event($_REQUEST['eid']); 

      break;


################################
#
### ASK TO DELETE MULTIPLE EVENTS
#
################################
   case 'delete_multi':


      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_list.php");

      $_cal_event_list = new _cal_event_list();
      $_cal_event_list->display_delete_multi();

      break;


##################################
#
### REALLY DELETE MULTIPLE EVENTS
#
##################################

   case strtolower(_DELETE_CHECKED_):

      $keys = array_keys($_REQUEST);

      $url = new _cal_url(_CAL_PAGE_MAIN_);

      if($_return_url) {
         $url->base = $_return_url;
         $url->args = array();
      }
 
      foreach($keys as $key) {

         if(substr($key, 0, 7) != "delete_") {
            continue;
         }

         $eid = ereg_replace("delete_", "", $key);

         $_cal_event = new _cal_event($eid);

         if(!$_cal_event->can_edit()) continue;
       
         _cal_event::delete_overrides($eid);
         _cal_event::delete($eid);

      }

      $_cal_html->js_redirect($url->toString());

      echo("<a href='". $url->toString() ."'>". _RETURN_ ."</a><br>\n");

      break;



################################
#
### VEIW OR UPDATE AN EVENT
#
###############################

   case strtolower(_UPDATE_):
   case strtolower(_VIEW_):
   case "view":

      global $_cal_user, $_cal_tmpl, $_cal_form, $_cal_event;

      require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.form.php");

      $_cal_form = new _cal_form("eviewp");
      $_cal_form->print_header();

      require(@constant("_CAL_BASE_PATH_") . "include/templates/event_view_tpl.php");

      if($_cal_event->can_edit()) {

         $hidden = $_cal_form->fromRequest("eid");
         $hidden .= $_cal_form->fromRequest("instance");

         if($_cal_event->freq > 0)
            $hidden .= $_cal_form->hidden("apply_to1", "this");

         if($_cal_event->is_request) {
            $button = $_cal_form->submit('event_action',_EDIT_) ." &nbsp; ";
            $xtra = 'onClick="location=\''._CAL_PAGE_MAIN_.'?module=requests\';return false"';
         } else {
            if(@constant("_CAL_EVENT_COPY_") && $_cal_user->access->can_add($_cal_event->cal_obj)) {
               $button = $_cal_form->submit('event_action', _COPY_) ." &nbsp; ";
            } else { $button = ""; }
            $button .= $_cal_form->submit('event_action',_EDIT_) ." &nbsp; ";
            $button .= $_cal_form->submit('event_action',_DELETE_) ." &nbsp; ";
         }

      }


      $_cal_tmpl->toolbar($hidden, $button .$_cal_form->submit('', _CLOSE_, $xtra),"");

      $_cal_tmpl->print_footer();

      $_cal_form->print_footer();
      break;


################################
#
### LIST EVENTS || SEARCH
#
################################
   default:


     require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_list.php");

     $_cal_event_list = new _cal_event_list($_SESSION['searchfor']);

     $_cal_event_list->display_events($_REQUEST['page']);
     


}



###########################
#
### convert date into time
### used by array_map above
#
##########################

function d_to_t($da)
{

   if(!strstr($da, '-')) return null;

   list($yr,$mo,$da) = explode("-",$da);
   return _ex_mktime(0,0,0,$mo,$da,$yr);

}

#########################
#
### CREATE A LIST FROM REQUEST.. :)
#
#################################
function mklist_request($name, $max)
{

   $list = '';
   for($i = 0; $i <= $max; $i++)
   {

      if($_REQUEST[$name . $i]) $list .= $i .",";

   }

   return rtrim($list, ",");
}

?>
