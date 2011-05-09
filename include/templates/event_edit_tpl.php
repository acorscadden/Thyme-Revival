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
// $Id: event_edit_tpl.php,v 1.169 2009/01/23 01:44:50 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");

   if(!@defined("_CAL_AMP_")) {
     if(strlen(@ini_get("arg_separator.output"))) define("_CAL_AMP_", ini_get("arg_separator.output"));
     else define("_CAL_AMP_", '&');
   }

   ############################
   #
   ### TABBED OR NOT TABBED
   #
   ###########################
   if(@constant("_CAL_EVENT_SERIAL_")) {
      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");
   } else {
      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template_tabbed.php");
   }

   require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");
   
   global $_cal_weekdays, $_cal_months, $_cal_weekdays_abbr, $_cal_sql, 
            $_cal_user, $_cal_form, $_cal_vcal_wdays, $_cal_dbpref, $_cal_event;

   define("_CAL_DOING_OPTS_", 1);
   require(@constant("_CAL_BASE_PATH_") ."include/languages/". _CAL_LANG_ .".php");

   ###################################
   #
   ### FOR REQUESTS
   #
   ###################################
   if($request_header && $_REQUEST['eid'] >= 0) {
      require_once(@constant("_CAL_BASE_PATH_") ."include/templates/event_request_tpl.php");
      return;
   } 

   $_cal_form = new _cal_form("EventForm");
   $_cal_form->method = "POST";

  $in_joomla = (defined( '_VALID_MOS' ) && $GLOBALS['mainframe'] && !(@constant("_CAL_DISABLE_JOS_EDITOR_")) && !@constant('_THYME_IN_JOOMLA15_'));


  if((!@constant("_CAL_DISABLE_WYSIWYG_")) && strpos($_SERVER['HTTP_USER_AGENT'], "Safari") === false) {

      if($in_joomla) {
         require_once(_CAL_BASE_PATH_."modules/joomla/joomla_editor.php");
      } else {
         require_once(_CAL_BASE_PATH_."include/editor.php");
      } 
   }


   $_cal_form->print_header("enctype='multipart/form-data'");


   $_cal_form->print_hidden("ecalendar", ($_REQUEST['event_action'] == _COPY_ ? $_cal_event->calendar : 0));

   $_cal_sql or $_cal_sql = new _cal_sql();

  ########################################
  # is this a new event? set the defaults
  #######################################t
  if($_cal_event->id < 1 && $_REQUEST['event_action'] != _PREV_ && $_REQUEST['event_action'] != _COPY_) {


     if(!$_cal_user->access->can_add($_cur_cal) && ($_cur_cal->options & 2 < 2 && $_cur_cal->type == 0)) {
        $_cal_html->permission_denied(false); # fixed
        return;
     }

     if($_REQUEST['h']) $h = $_REQUEST['h'];
     else $h = 12;

     $_cal_event->start = _ex_mktime($h,0,0,$_REQUEST[$cal->listeners['month']],
	 $_REQUEST[$cal->listeners['day']], $_REQUEST[$cal->listeners["year"]]);
     $_cal_event->r_wkst = $_cal_user->options->week_start;

     # set simple repeat options
     $_cal_event->repeat_on_wday = _ex_date("w", $_cal_event->start);
     $_cal_event->repeat_on = ceil($_REQUEST[$cal->listeners["day"]]/7);

     # some advanced options..
     $_cal_event->r_years = $_cal_event->r_months = $_cal_event->r_weeks = 1;
     $_cal_event->r_easter = '0';

     $_cal_event->rep_sel = _NONE_;

     $_cal_event->org_name = $_cal_user->name;
     $_cal_event->org_email = $_cal_user->email;

     $_cal_event->timezone = $_cal_user->options->timezone;
     $_cal_event->dst = $_cal_user->options->dst;

     $_cal_event->calendar = $_cur_cal->id;
 
     $_cal_event->duration = "01:00"; 

     @include_once(_CAL_BASE_PATH_."customize/event_defaults.php");

  ############################
  # Set event values..
  ############################
  } else {

     ##################
     # sort vcal items
     ###################
     $_cal_event->vcal_sort();

     # set locale option
     $_cal_form->defaults['locale'] = $_cal_event->use_tz;

     # can we edit this event?
     if($_REQUEST['event_action'] != _PREV_ && !$_cal_event->can_edit()) {
        $_cal_html->permission_denied(false); # fixed
        return;
     }

     # set an interval if we don't have one
     if($_cal_event->freq != 5) $_cal_event->finterval = max(1,$_cal_event->finterval);


     # check for a simple repeating event
     if($_cal_event->freq == 0) {
        $_cal_event->rep_sel = _NONE_;
     } else if(


        ($_cal_event->freq < 5) &&

        (strpos($_cal_event->bymonthday, ",") === false) && 
        (strpos($_cal_event->bymonth, ",") === false) &&

        !$_cal_event->bysetpos &&
        
        # check for repeat every
        (
         (
           # repeating weekly 
           ###################
           (
             ($_cal_event->freq == 3 && !preg_match("/[0-9]/",$_cal_event->byday)
                  &&
               ($_cal_event->wkst == $_cal_user->options->week_start
                  ||
                $_cal_event->finterval < 2
               )
             )

               ||
           # if we don't have a byday we can do simple mode
              (!$_cal_event->byday)
           )

               &&
           # set simple repeat rule
           ($_cal_event->repeat_every_mask = 1)
               &&

           # bymonthday only contains 1 and it is > 0
           (
              (strpos($_cal_event->bymonthday,",") === false
              &&
              $_cal_event->bymonthday > 0)

              || !strlen(trim($_cal_event->bymonthday))
           ) 

         ) || (

           # repeating monthly
           ####################
           $_cal_event->freq == 2

               &&

               strpos($_cal_event->byday,",") === false && preg_match("/[0-9]/",$_cal_event->byday)
                
               &&

           # no bymonth rule
           !strlen($_cal_event->bymonth)

               &&

          # set simple repeat rule
          $_cal_event->repeat_on_months = $_cal_event->finterval

         ) # </ finterval && .. check for repeat every or repeat on

         ||
         (
            # repeating yearly
            ##################
            $_cal_event->freq == 1
               && 
            (!strlen($_cal_event->bymonth) || $_cal_event->bymonth == _ex_date("n", $_cal_event->start))
               &&
            (!strlen($_cal_event->bymonthday) || $_cal_event->bymonthday == _ex_date("j", $_cal_event->start))
               &&
            ($_cal_event->repeat_every_mask = 1)
         )

         ||

         (

           # repeating daily
           $_cal_event->freq == 4
              &&
           (!(strlen($_cal_event->bymonth) || strlen($_cal_event->bymonthday) || strlen($_cal_event->byday) ||
                strlen($_cal_event->bysetpos)))
             &&
           $_cal_event->repeat_every_mask = 1

         )
       )

     ) {

        $_cal_event->rep_sel = _SIMPLE_;

        # set up first, second, last etc..
        preg_match("/(\-?[0-9])/", $_cal_event->byday, $foo);
        $_cal_event->repeat_on = intval($foo[0]);
        if(intval($foo[0]) < 0) $_cal_event->repeat_on = 6;


     } else {
        $_cal_event->rep_sel = _ADVANCED_;
     }

     # for simple
     $_cal_event->repeat_every = $_cal_event->finterval;

     switch($_cal_event->freq)
     {


        case 1:
           $_cal_event->r_years = $_cal_event->finterval;
           $wday = "r_year_wday_";
           $bymonth = "r_year_month_";
           $mday = "r_years_mdays";
           break;

        case 2:
           $_cal_event->r_months = $_cal_event->finterval;
           $_cal_event->repeat_every_val = 2;
           $wday = "r_months_wdays";
           $mday = "r_months_mdays";
           $setpos = "r_months_setpos";
           break;

        case 3:
           $_cal_event->r_weeks = $_cal_event->finterval;

           if(strlen($_cal_event->byday))
              $_cal_event->repeat_every_val = 6;
           else
              $_cal_event->repeat_every_val = 1;

           $wday = "r_week_wday_";
           $bymonth = "r_week_month_";
           break;

        case 4:
           $_cal_event->r_days = $_cal_event->finterval;
           $_cal_event->repeat_every_val = 0;
           $wday = "r_day_wday_";
           $bymonth = "r_day_month_";
           break;

        case 5:
           $_cal_event->r_easter = abs($_cal_event->finterval);
           $_cal_event->r_easter_when = intval($_cal_event->finterval > 0);
           break;

     }
     if(!isset($_cal_event->repeat_every_val)) $_cal_event->repeat_every_val = 3;

     ######################
     # SET/FIX BYDAY
     ######################
     $_cal_event->byday = str_replace(" ", "", $_cal_event->byday);
     # grab values for checkboxes
     $vals = array_flip(explode(",", str_replace($_cal_vcal_wdays,range(0,6),$_cal_event->byday)));
     $keys = explode(",", $_cal_event->byday);

     $byday = preg_replace("/(\-?\d)?([A-Z]{2})/", "\\1 \\2", $_cal_event->byday);
     $byday = str_replace(array("-1","1"), array(_LAST_." ",_REPEAT_ON1_." "),
        strtoupper($byday));

     for($i = 2; $i < 6; $i++)
     {
        $byday = str_replace($i, $_cal_event->repeat_on_opts[$i] ." ",
            $byday);
     }
     $byday = str_replace($_cal_vcal_wdays, $_cal_weekdays, $byday);
     $byday = preg_replace("/(^|,) /", "\\1"._REPEATING_EVERY1_." ", $byday);
     $wdays = explode(",",$byday);

     # for repeat on weekday in simple repeating
     list($null,$null,$_cal_form->defaults['repeat_on_wday']) = preg_split("/ /", $byday);
     $_cal_form->defaults['repeat_on_wday'] =
        intval(array_search($_cal_form->defaults['repeat_on_wday'], $_cal_weekdays));

     # checkboxes?
     if(substr($wday, -1, 1) == "_") 
     {
        for($i = 0; $i < 7; $i++) {
           if(isset($vals[$i])) {
              $_cal_form->defaults[$wday.$i] = 1;
              $_cal_form->defaults["repeat_selected_".($i+1)] = 1;
           }
        }

     # select box
     } else {

       $byday = array();
       for($i = 0; $i < count($keys); $i++)
       {
          $byday[$keys[$i]] = $wdays[$i];
          $_cal_form->defaults["repeat_selected_".($i+1)] = intval(isset($vals[$i]));
       }

       if($wday) $_cal_event->$wday = $byday;

     }

     #########################
     # SET/FIX BYMONTHDAYS
     ########################
     $_cal_event->bymonthday = str_replace(" ","",$_cal_event->bymonthday);
     $keys = explode(",",$_cal_event->bymonthday);
     $bymonthday = preg_replace("/\-1([^0-9]|$)/", _LAST_."\\1", $_cal_event->bymonthday);
     $bymonthday = preg_replace("/\-(\d+)/", "\\1 "._FROM_LAST_, $bymonthday);
     $vals = explode(",",$bymonthday);
     for($i = 0; $i < count($keys); $i ++)
     { 
        $mdays[$keys[$i]] = $vals[$i];
     }
     if($mday) $_cal_event->$mday = $mdays;


     ####################
     # SET/FIX BYMONTH
     ####################
     $_cal_event->bymonth = str_replace(" ", "", $_cal_event->bymonth);
     $vals = array_flip(explode(",",$_cal_event->bymonth));
     for($i = 1; $i < 13; $i++) 
     {
        if(isset($vals[$i])) $_cal_form->defaults[$bymonth.$i] = 1;

     }
    
     #######################
     # SET/FIX BYSETPOS
     ######################
     $_cal_event->bysetpos = str_replace(" ","",$_cal_event->bysetpos);
     $keys = explode(",",$_cal_event->bysetpos);
     $bysetpos = preg_replace("/\-1([^0-9]|$)/", _LAST_."\\1", $_cal_event->bysetpos);
     $bysetpos = preg_replace("/\-(\d+)/", "\\1 "._FROM_LAST_, $bysetpos);
     $vals = explode(",",$bysetpos);
     for($i = 0; $i < count($keys); $i++)
     {
        $pos[$keys[$i]] = $vals[$i];
     }
 
     if($setpos) $_cal_event->$setpos = $pos;

     #################
     # SET WKST
     ################
     $_cal_form->defaults["r_wkst"] = $_cal_event->wkst;



     #######################
     # CHECK FOR EXCLUDES
     #######################
     if($_cal_event->id) {
        $excludes = $_cal_sql->query("select exdate from
           {$_cal_dbpref}Exceptions where (eid = ". $_cal_event->id .")
           order by exdate desc");
     } else {
        $excludes = array();
     }



  } # </ if existing event >

  # format timezone
  $_cal_event->timezone = number_format($_cal_event->timezone, 1);

  if(($_cal_events->calendar == $_cur_cal->id) || !$_cal_event->calendar) {

     $_cal_event->calendar = $_cur_cal->id;
     $_cal_event->cal_title = $_cur_cal->title;
     $_cal_event->cal_options = $_cur_cal->options;
     $_cal_event->cal_etypes = $_cur_cal->get_categories();

  } else {

     require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

     $_cal_obj = new _cal_obj($_cal_event->calendar);

     $_cal_event->calendar = $_cal_obj->id;
     $_cal_event->cal_title = $_cal_obj->title;
     $_cal_event->cal_options = $_cal_obj->options;
     $_cal_event->cal_etypes = $_cal_obj->get_categories();

  }


  # split things up and add them to our form...
  ##########################################
  list($s_yr,$s_mo,$s_da) = explode("-",_ex_date("Y-n-j", $_cal_event->start));
  list($hr,$min) = explode(":", _ex_date("H:i", $_cal_event->start));


  list($i_yr, $i_mo, $i_da) = explode("-", $_REQUEST['instance']);

  $_cal_form->defaults['startdate_yr'] = intval($s_yr);
  $_cal_form->defaults['startdate_mo'] = intval($s_mo);
  $_cal_form->defaults['startdate_da'] = intval($s_da);

  $_cal_form->defaults['starttime_hr'] = intval($hr);
  $_cal_form->defaults['starttime_min'] = intval($min);

  list($_cal_form->defaults['duration_hr'], $_cal_form->defaults['duration_min']) =
	explode(":", $_cal_event->duration, 2);

  $_cal_form->defaults['duration_min'] -= ($_cal_form->defaults['duration_min'] % 5);

  # default values for form
  if($_cal_event->end == "" || !isset($_cal_event->end) || !$_cal_event->freq) {
     $_cal_form->defaults['enddate_da'] = $_cal_form->defaults['startdate_da'];
     $_cal_form->defaults['enddate_mo'] = $_cal_form->defaults['startdate_mo'];
     $_cal_form->defaults['enddate_yr'] = $_cal_form->defaults['startdate_yr'];
  
  } else {

     list($yr,$mo,$da) = explode("-",_ex_date("Y-n-j", $_cal_event->end));

     $_cal_form->defaults['enddate_da'] = intval($da);
     $_cal_form->defaults['enddate_mo'] = intval($mo);
     $_cal_form->defaults['enddate_yr'] = intval($yr);

  }


  # values for form from event object.
  ####################################
  $tmparr = get_object_vars($_cal_event);
  while( list($key, $val) = each($tmparr)) {
     $_cal_form->defaults[$key] = $val;
  }


  if($_cal_event->id < 1) ($_cal_form->defaults['type'] = intval($_SESSION['evnt_type']) 
    or $_cal_form->defaults['type'] = intval($_REQUEST[$cal->listeners['cat']]));
  

  # icon url..
  $iurl = new _cal_url(($_cal_event->icon ? $_cal_event->icon : "images/spacer.png"));

  $_cal_html->print_heading(($_cal_event->id != 0 ? $_cal_event->title : _NEW_EVENT_) );

  # progress bar
  #################
  echo("<div id='progress' align='center'
        style='display: none; width: 100%; '>
        <br><br><br><img name='pbar' src='".
        _CAL_BASE_URL_."images/progress_bar.gif' alt='progress bar'><br><br><br></div>\n");

  echo("<div id='saveevent'>\n");

  $_cal_tmpl = new _cal_template("event_edit_template");
  $_cal_tmpl->row_header_width = 100;

  $_cal_tmpl->print_header("event");

  $_cal_form->print_hidden('icon', $_cal_event->icon);
  $_cal_form->print_hidden('iebug', 1);

  # hidden form value to check for changing rrule or date
  $_cal_form->print_hidden('rrule_diff', 0);


   if($_REQUEST['instance']) {
       echo($_cal_form->fromRequest('instance'));
   }
   if($_cal_event->id) {
      echo($_cal_form->print_hidden('eid', $_REQUEST['eid']));
   }


   #############################
   #
   ###  generate toolbar
   #
   ###########################
   $l = $_cal_form->submit("event_action", ($_cal_event->is_request ? ((@constant("_CAL_NO_REQUEST_EMAIL_") || $_cal_user->access->can_admin($_cal_event->cal_obj)) ? _SAVE_ : _NEXT_) : _SAVE_)) ." "; 
   if($_cal_event->id > 0 && !$_cal_event->is_request) {
      $l .= $_cal_form->submit("event_action", _DELETE_);
   }

   $url = new _cal_url(_CAL_PAGE_MAIN_);
   $url->amp = '&';

   if($_REQUEST['return_url']) {
         $url->base = $_REQUEST['return_url'];
         $url->args = array();
      }

   $l .= " <input type='button' class='". _CAL_CSS_BUTTON_. "' value='". _CANCEL_."'
        onClick='document.location = \"". $url->toString() ."\"'>";

   if($_cal_event->freq > 0 && !$_cal_event->is_request) {
      $r = "<font class='"._CAL_CSS_HIL_."'>". _APPLY_TO_ ."
      <input type=radio id='all1' onClick='update_repeater(1)'
             name='apply_to1'
      ". (@constant("_CAL_APPLY_THIS_DEFAULT_") ? "" : "checked") ."
             value='all'> <b>". _ALL_DATES_ ."</b>

      <input type=radio id='this1' onClick='update_repeater(1)'
      ". (@constant("_CAL_APPLY_THIS_DEFAULT_") ? "checked" : "") ." 
             name='apply_to1' value='this'> <b>". _THIS_DATE_ ."</b></font>";

   } elseif($_cal_event->override_id) {
      
         $tmpevent = new _cal_event($_cal_event->override_id);
      
      $r = _RESET_INSTANCE_ ." ( <a class='"._CAL_CSS_HIL_."'
	href='javascript:newWin(\"event_view.php?eid=".$_cal_event->override_id ."\")'>".
	$tmpevent->title ."</a>) " .
        $_cal_form->submit('event_action', _RESET_);
     
   }

   if(@constant("_CAL_EVENT_SERIAL_") != 2)
      $_cal_tmpl->toolbar($l,"",$r);

   ####################
   #
   ### GENERAL
   #
   ####################

   $_cal_tmpl->new_section(_GENERAL_);

   $_cal_url = new _cal_url("modules/common_files/change_calendar.php");
   $_cal_url->addArg("callback", "change_cal");
   $_cal_url->addArg("access_lvl", 1);

   #######################
   # CALENDAR
   #######################
   if($_cal_event->calendar > 0) 
      $_cal_tmpl->section_row(_CALENDAR_, "<span id='cal_title_span'>".$_cal_event->cal_title ."</span>".
        (($_cal_event->id != 0 || $_REQUEST['event_action'] == _COPY_) ? "
        <input type=button value='"._CHANGE_."' onClick='newWin(\"".$_cal_url->toString()."\")'>" : "")); 

   ############################
   # OWNER
   ###########################
   if($_cal_user->access->can_admin($_cal_event->cal_obj) && !$_cal_event->is_request && $_cal_event->id) {

          $url = new _cal_url("modules/common_files/add_members.php");
          $url->amp = '&';
          $url->addArg("callback", "chown_submit");
          $url->addArg("uo", 1);

      $eo = new _cal_user(null,null,intval($_cal_event->owner));
      $_cal_tmpl->section_row(_OWNER_, "<span id='chown_user_span'>".$eo->name ." (". $eo->userid .")</span>
         <input name='chown_user' type='hidden' value='' > ".
        " <input type=button value='"._CHANGE_."' onClick='newWin(\"".$url->toString()."\")'>");
   }

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_TITLE_, $_cal_form->textbox("title", 50, "maxlength=255"));

   $_cal_tmpl->section_spacer();

   # multiple categories
   if($_cal_event->cal_options & 32) {

      foreach(array_keys($_cal_event->cal_etypes) as $et) {

         if((($et * 1) & ($_cal_event->etype * 1)) > 0)
            $_cal_form->defaults["et_".$et] = $et;
        
      }

      # COMPILE LIST OF CHECKBOXES
      ##############################
      $et_sel = "<table border=0 class='"._CAL_CSS_BOUNDING_TABLE_."'
        cellpadding=2 cellspacing=0 align=left>
        <tr class='"._CAL_CSS_ROW_HEADER_."' valign='top'>";

      $i = 0;
      foreach(array_keys($_cal_event->cal_etypes) as $et) {
         if(!(($i++) % 3) && $i > 1) $et_sel .= "</tr><tr class='"._CAL_CSS_ROW_HEADER_."' valign='top'>";
         $et_sel .= "<td class='"._CAL_CSS_ROW_HEADER_."' align='left'>";
         $et_sel .= $_cal_form->checkbox("et_".$et) .$_cal_event->cal_etypes[$et] ." &nbsp; ";
         $et_sel .= "</td>";
      }
      while((($i++) % 3)) $et_sel .= "<td class='"._CAL_CSS_ROW_HEADER_."'> &nbsp; </td>";
      $et_sel .= "</tr></table>";

      $_cal_tmpl->section_row(_EVENT_TYPES_, "<span id='category_span'>".$et_sel."</span>");

   } else {

      $_cal_tmpl->section_row(_EVENT_TYPE_, "<span id='category_span'>".$_cal_form->select("type", array('('._NONE_.')') + $_cal_event->cal_etypes) ."</span>");
   }
   

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_DATE_, $_cal_form->dateselect("startdate",
	'onChange="javascript:setWeekday(\'startdate\')"') . " " .
	"<b><span id='startdate_lbl'></span></b> &nbsp;<a href='javascript:startdate_picker()'>".
        "<img src='". $_cal_html->get_img_url("modules/common_files/date_picker.gif") .
    "' alt='". _DATE_ ."' border=0 align='middle'></a>&nbsp ".


    (@constant("_CAL_USE_SESSION_") ? " [". $_cal_form->checkbox("conflicts") . _CHECK_FOR_CONFLICTS_." ]" :
        "<input type='hidden' name='conflicts'>"));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_TIME_,  "

      <table border=0 cellpadding=4 style='border-collapse: collapse'>
      <tr class='"._CAL_CSS_ROW_HEADER_."'>
         <td>
		<input type=radio name='allday'
                ". ($_cal_event->allday == 1 ? " checked " : "") ."
		value='1'></td>
         <td colspan=2>". _THIS_EVENT_ALLDAY_ ."</td>
      </tr>
      <tr class='"._CAL_CSS_ROW_HEADER_."'>
         <td> 
		<input type=radio
                ". ($_cal_event->allday == 0 ? " checked " : "") ."
                name='allday' value='0'></td>
         <td>". _STARTS_AT_ .":</td>
         <td>". $_cal_form->timeselect("starttime") ."</td>
      </tr>
      <tr class='"._CAL_CSS_ROW_HEADER_."'>
         <td></td>
         <td>". _DURATION_ .":</td>
         <td>". $_cal_form->durationselect("duration") ."</td>
      </tr>
      ". (@constant("_CAL_CALL_FOR_TIMES_ENABLE_") ? "
      <tr class='"._CAL_CSS_ROW_HEADER_."'>
         <td>
        <input type=radio name='allday'
                ". ($_cal_event->allday == 2 ? " checked " : "") ."
        value='2'></td>
       <td colspan=2>". _CAL_CALL_FOR_TIMES_ ."</td>
      
      </tr>
        " : "") ."
      </table>");

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_NAME_, $_cal_form->textbox('org_name', 30));
   $_cal_tmpl->section_row(_EMAIL_, $_cal_form->textbox('org_email', 30));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_URL_, $_cal_form->textbox('url', 50));

   $_cal_tmpl->section_spacer();


   if((!@constant("_CAL_DISABLE_WYSIWYG_")) && strpos($_SERVER['HTTP_USER_AGENT'], "Safari") === false) {

      if($in_joomla) {

        ob_start();
        editorArea('editor1',$_cal_event->notes,'notes','90%','400','70','15').
           '<br>(Joomla editor)';
        $notes_field = ob_get_contents();
        ob_end_clean();

        $_cal_tmpl->section_row(_NOTES_,$notes_field);

      } else {

      $_cal_tmpl->section_row(_NOTES_,$_cal_form->textarea('notes',20,75,
        "$_cal_editor_attrib style='width: 90%; border: 1px solid black'"));

     }

   } else {
   
      $_cal_tmpl->section_row(_NOTES_,

      '<table class="'._CAL_CSS_BOUNDING_TABLE_.'" border=0 style="border-collapse: collapse" width="100%">
            <tr class="'._CAL_CSS_ROW_HEADER_.'" valign="top"><td>'.
            $_cal_form->textarea('notes',5,70, " 
        style='width: 100%'").
        '<br><a href="javascript:preview_notes()">'._PREVIEW_.  '</a>'.
        '</td><td><input type=button onClick="grow_textarea(\'notes\')" class="'._CAL_CSS_BUTTON_.'"
                value="+" style="width: 28px"><br>'.
        '<input type=button onClick="shrink_textarea(\'notes\')" class="'._CAL_CSS_BUTTON_.'"
                value="-" style="width: 28px;"></td>'.
      '</tr></table>');

   }	

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_FLAG_, $_cal_form->checkbox("flag", 
	($_cal_event->flag == 1  ? 'checked' : ''))." " . _FLAG_THIS_);



   $icon = "
    <img src='" . $iurl->toString() ."' height=16 width=16
         align='middle' alt='event icon' name='icon'>
        [<a class='"._CAL_CSS_ROW_HEADER_."'
        href='javascript:newWin(\""._CAL_BASE_URL_.
        "image_browser.php?image=icon"._CAL_AMP_."form=EventForm\")'>".
    _BROWSE_ ."</a>]
        [<a class='"._CAL_CSS_ROW_HEADER_."'
        href='javascript:noIcon()'>". _NONE_ ."</a>]\n";

   if($_cal_event->icon) {
       $icon .= "[<a class='"._CAL_CSS_ROW_HEADER_."'
           href='javascript:setIcon(\"". $_cal_event->icon ."\")'>".
       _RESET_ ."</a>]\n";
    }


    $_cal_tmpl->section_row(_ICON_, $icon);

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->end_section();


   ##################################
   #
   ### TIMEZONE
   #
   #####################################

if(@constant("_CAL_ENABLE_TZ_")) {

   $_cal_tmpl->new_section(_TIMEZONE_, true);


   if($_cal_event->id < 1)
   {

      $_cal_form->defaults['timezone'] = number_format($_cal_user->options->timezone, 1);
      $_cal_form->defaults['dst'] = $_cal_user->options->dst;
      $_cal_form->defaults['locale'] = 0;

   }
   $w = $_cal_tmpl->row_header_width;

   $_cal_tmpl->row_header_width = 170;

      ob_start();
      echo("<div align='left' id='locale_div' style='display: ".
           ($_cal_form->defaults['use_tz'] ? "inline" : "none") ."'>
         <table border=0 align=left style='border-collapse: collapse; border: 0px'>");
         require_once(@constant("_CAL_BASE_PATH_") . "modules/options/locale.php");
         echo("</table>\n");
      echo("</div>");
      $locale_conf = ob_get_contents();
      ob_end_clean();

     $_cal_tmpl->section_row(_TIMEZONE_." ". $_cal_form->select("use_tz", array(_NONE_,_FORCE_),
        " onChange='set_imp_locale(this)'"), $locale_conf);


   $_cal_tmpl->row_header_width = $w;

   $_cal_tmpl->end_section(); 

}

   #############################
   #
   ### REPEATING
   #
   ##############################

   $_cal_tmpl->new_section(_REPEATING_, true);



   if($_cal_event->override_id > 0 && $_cal_event->override_date) {
   
      $_cal_tmpl->section_row("","<b>". _REPEATING_NO_ ."</b><br><br>");

   } else {


      $_cal_tmpl->new_row();
      $_cal_form->print_hidden("r_source");
      ?>

      <span id='rep_<?php echo(_NONE_) ?>'><a href='javascript:rep_sel("<?php echo(_NONE_) ?>")' class='<?php echo(_CAL_CSS_ULINE_)?>'
        ><?php echo(_NONE_) ?></a></span> ||
      <span id='rep_<?php echo(_SIMPLE_) ?>'><a href='javascript:rep_sel("<?php echo(_SIMPLE_) ?>")' class='<?php echo(_CAL_CSS_ULINE_)?>'
        ><?php echo(_SIMPLE_) ?></a></span> ||
      <span id="rep_<?php echo(_ADVANCED_) ?>"><a href="javascript:rep_sel('<?php echo(_ADVANCED_) ?>')" class='<?php echo(_CAL_CSS_ULINE_)?>'
        ><?php echo(_ADVANCED_) ?></a></span><br>
        <hr align="left"> <?php
      $_cal_tmpl->end_row();


      $_cal_tmpl->new_row();

      ########################
      # NO REPEATING
      ########################

      echo("<div id='"._NONE_."_repeat' style='display: none'>\n");
         echo('<b>'._REPEATING_NO_.'</b><br><br>');
      echo("</div>\n");

 
      #######################
      # SIMPLE REPEATING
      #####################

      echo("<div id='"._SIMPLE_."_repeat' style='display: none'>\n");

         require(@constant("_CAL_BASE_PATH_") ."include/templates/simple_repeat.php");

          echo("<hr align='center'>\n");

     echo("</div>");

      ##################
      # ADVANCED REPEATING
      ######################

      echo("<div id='"._ADVANCED_."_repeat' style='display: none'>\n");

         require(@constant("_CAL_BASE_PATH_") ."include/templates/advanced_repeat.php");

      echo("</div>\n");
      
        

      #######################
      # END DATE
      ########################

      # already created above for start date
      # picker, just need to change elm 
      $purl = new _cal_url("modules/common_files/date_picker.php");
      $purl->addArg("form", $_cal_form->name);
      $purl->addArg("elm", "enddate");


      ?>

      <div id='end_date' style='display: none'>

       <table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellspacing=0 cellpadding=5>
        <tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'><td>

       <table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellspacing=0 cellpadding=2>
        <tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'><td><?php
 
      echo("<input type=radio  ".
         ($_cal_event->end == "" || !isset($_cal_event->end) ? "checked" : "") .
         " name='ends' value='0'> ".  _END_DATE_NO_.'</td></tr>');

      echo("<tr class='"._CAL_CSS_ROW_HEADER_."'><td><input type=radio ".
         ($_cal_event->end != "" ? "checked" : "" ). "
         name='ends' value='1'> ". _END_DATE_UNTIL_ ." ".
   	$_cal_form->dateselect("enddate", 'onChange="javascript:setWeekday(\'enddate\')"') .
        " &nbsp; <a href='javascript:newWin(\"". $purl->toString() ."\", 220, 250)'>".
        "<img src='". $_cal_html->get_img_url("modules/common_files/date_picker.gif") .
        "' alt='". _DATE_ ."' border=0 align='middle'></a>&nbsp; ".
        "<b><span id='enddate_lbl'></span></b></td></tr>\n");

   
       echo("<tr class='"._CAL_CSS_ROW_HEADER_."'><td><input type=radio ".
         ($_cal_event->end_after > 0 ? "checked" : "") . "
         name='ends' value='after'> ". _END_DATE_AFTER_ ."
         <input type=text class='"._CAL_CSS_TEXTBOX_."' size=3 maxlength=3 name='end_after'
         value='". max(1, intval($_cal_event->end_after)) ."'> ". _OCCURRENCES_ .'</td></tr>'); 


      echo("</table>\n");

      # EXCLUSIONS
      ?>
      </td><td align='center'>

      <table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellpadding=10 cellspacing=0>
         <tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='top'><td align=center style='border-left: 1px solid;
            padding-left: 12px;'>
      <?php

       $eurl = new _cal_url("modules/common_files/date_picker.php");
       $eurl->fromRequest("m");
       $eurl->fromRequest("y");
       $eurl->addArg("form", $_cal_form->name);
       $eurl->addArg("callback", "r_add_exclude");
       $eurl->addArg("d", 1);
       $eurl->addArg("m", $_SESSION['m']);
       $eurl->addArg("y", $_SESSION['y']);
       $eurl->fromRequest("eid");

       echo(_EXCLUDE_DATES_.'<br>');

       # build exclude list..
       count($excludes) or $excludes = array();
       foreach($excludes as $ex)
       {
          $exes[_ex_date("Y-n-j", $ex['exdate'])] =
            $_cal_weekdays[_ex_date("w",$ex['exdate'])] . " ". _ex_date(_DATE_INT_FULL_, $ex['exdate']);
       }

       echo($_cal_form->mselect_h("r_exclude", $exes, 5, "style='width: 12em'"));

      ?>
      </td><td align=left> <br>
      <?php
      echo("<input class='add_button "._CAL_CSS_BUTTON_."'
        type=button onClick='newWin(\"". $eurl->toString() ."\", 220, 250)'
        value='". _ADD_ ."'><br>");

      echo("<br><input type='button' value='". _REMOVE_ ."' class='remove_button ".
        _CAL_CSS_BUTTON_."'
        onClick='rem_sel(\"r_exclude\")'>\n");


      ?>
      </td></tr></table>

      </td></tr></table>
      </div>

      <?php
      $_cal_tmpl->end_row();

   }

   $_cal_tmpl->section_spacer();


   ##################
   # EXCEPTIONS
   ####################

   $_cal_tmpl->end_section();


   ##########################
   #
   ### LOCATION INFO
   #
   ###########################

   $_cal_tmpl->new_section(_LOCATION_, true);

   # USING LOCATIONS MOD
   if(@constant('_CAL_LOCATIONS_MOD_')) {

      global $_cal_loc_opts;

      $_cal_loc_opts = $_cal_sql->query("select variable,
        setting from {$_cal_dbpref}ModuleSettings
        where module = 'locations'", true);

      $flds = array('addr_st','addr_st2','addr_ci','state','zip','phone');
   
      if($_cal_loc_opts['require_loc']) {
   
         if($_cal_user->access->can_admin($_cal_event->cal_obj)) {
   
            $_cal_form->onSubmit[] = "
             if(!document.forms['EventForm'].elements['location_id'].selectedIndex) {
                return confirm('"._LOCATION_WARN_ ."');
            }
            ";
         } else {
   
            $_cal_form->onSubmit[] = "
                if(!document.forms['EventForm'].elements['location_id'].selectedIndex) {
                alert('"._MUST_SELECT_LOCATION_."');
               return false;
                }
              return true;
            ";
         }
   
      }
   
      if($_cal_loc_opts['use_locations'] == 'spec') {
   
         $_cal_locs = $_cal_sql->query("select {$_cal_dbpref}Locations.id,
            name, ". join(",",$flds) .", {$_cal_dbpref}LocationMembers.cid
           from {$_cal_dbpref}Locations
            left join {$_cal_dbpref}LocationMembers on
               {$_cal_dbpref}LocationMembers.cid = {$_cal_event->cal_obj->id}
            where (id = ". intval($_cal_event->location_id) .") or
           ({$_cal_dbpref}LocationMembers.lid > 0 and published = 1)");
   
      } else {
   
         $_cal_locs = $_cal_sql->query("select {$_cal_dbpref}Locations.id,
            name, ". join(",",$flds) ."
           from {$_cal_dbpref}Locations where id = ".
            intval($_cal_event->location_id) ." or 
           published = 1");
      }
  
      $_cal_loc_sel = array();
      for($i = 0; $i < count($_cal_locs); $i++) {
         $_cal_loc_sel[$_cal_locs[$i]['id']] = $_cal_locs[$i]['name'];
   
         $_cal_locs[$i]['address'] = $_cal_locs[$i]['addr_st'] .
           ($_cal_locs[$i]['addr_st2'] ? "<br>" . $_cal_locs[$i]['addr_st2'] : "") .
            "<br>".$_cal_locs[$i]['addr_ci'] .", ". $_cal_locs[$i]['state'] ." ".
            $_cal_locs[$i]['zip'];
   
      }
      
      uasort($_cal_loc_sel, 'strnatcasecmp');
      $_cal_loc_sel = array(0 => '') + $_cal_loc_sel;
 
      $_cal_form->defaults['location_id'] = intval($_cal_event->location_id);
   
      ############################
      # ADD LOCATION
      #############################
      if($_cal_user->admin ||
           ($_cal_user->access->can_admin($_cal_event->cal_obj) && $_cal_loc_opts['allow_ad
   d'])
           || $_cal_loc_opts['allow_add'] == 2) {
   
                $add_btn = " <input type=button value='". _ADD_."'
                onClick='newWin(\""._CAL_BASE_URL_.
                "modules/locations/add_location_popup.php?eid={$_cal_event->id}\")'>";
   
      } else {
         $add_btn = "";
      }
   
      $_cal_tmpl->section_row("",$_cal_form->select('location_id', $_cal_loc_sel,
           "onChange = 'upd_loc_sel(this.value)'") . $add_btn);
   
      $_cal_tmpl->section_row(_ADDRESS_, "<span id='loc_street'></span>");
      $_cal_tmpl->section_row(_PHONE_, "<span id='loc_phone'></span>");  

   #########################
   #
   ### NO LOCATIONS MOD
   #
   #########################
   } else {

      if(($_cal_event->cal_obj->options & 64)) {
   
         if(@constant("_CAL_LOCATION_IGNORE_PHONE_")) $cal_q_phone = "";
         else $cal_q_phone = ", phone ";
   
   
         if(!@@constant("_CAL_LOCATION_LIMIT_")) $cal_q_limit = 5;
         else $cal_q_limit = _CAL_LOCATION_LIMIT_;
   
   
         if(@constant("_CAL_LOCATION_ALL_")) $cal_q_cals = "";
         else $cal_q_cals = "(calendar = {$_cal_event->cal_obj->id}) and ";
   
   
         if($_cal_sql->subselects) {
   
            $q = "select distinct(location), addr_ci, addr_st, updated
                {$cal_q_phone} from {$_cal_dbpref}Events,
               (select location as maxloc, max(updated) as maxupdated from {$_cal_dbpref}Events
               where {$cal_q_cals}
               location != '' and location is not null group by location)
               as t2 where location = t2.maxloc and updated = t2.maxupdated
               order by updated desc, location desc";
   
            if($cal_q_limit) {
               $q = $_cal_sql->sql_limit($q,$cal_q_limit,0);
            }
   
            $_cal_locs = $_cal_sql->query($q);
   
            if(count($_cal_locs)) {
   
               $_c_loc_sel = array(0 => '');
   
               foreach($_cal_locs as $_cal_l) {
   
                  $_c_loc_sel[] = $_cal_l['location'];
   
               }
   
               $_cal_tmpl->section_row("",$_cal_form->select('_loc-preset', $_c_loc_sel,
                  "onChange='cal_set_loc(this.selectedIndex)'"));
            }
   
   
         } else {
   
   
            $q = "select ". $_cal_sql->sql_alias("max(updated)", "updated") .",
                   location from {$_cal_dbpref}Events
                  where {$cal_q_cals} (location != '' and location is not null)
                  group by location order by updated desc";
   
            if($cal_q_limit) {
               $q = $_cal_sql->sql_limit($q,$cal_q_limit,0);
            }
   
            $_cal_locs = $_cal_sql->query($q, true);
   
            if(count($_cal_locs)) {
   
               natcasesort($_cal_locs);
   
               $_c_loc_sel = array_merge(array(0 => ""), $_cal_locs);
   
               $_cal_tmpl->section_row("",$_cal_form->select('_loc-preset', $_c_loc_sel,                                        "onChange='cal_set_loc(this.selectedIndex)'"));
   
               $_cal_locs_sql = array();
               foreach($_cal_locs as $_cal_l) $_cal_locs_sql[] = $_cal_sql->escape_string($_cal_l);
   
               # get most recent locations
               ############################
               $_cal_locs = $_cal_sql->query("select location, updated, addr_ci, addr_st {$cal_q_phone}
                     from {$_cal_dbpref}Events
                     where updated in (". join(",", array_keys($_cal_locs)) .") and
                     location in ('". join("','", $_cal_locs_sql) ."') order by lower(location), updated");
   
   
               # create uniqued
               foreach($_cal_locs as $loc) $_cal_tmp_locs[$loc['location']] = $loc;
               $_cal_locs = array();
               array_shift($_c_loc_sel);
               foreach($_c_loc_sel as $loc) {
                  $_cal_locs[] = $_cal_tmp_locs[$loc];
               }
   
            }
   
   
         }
   
      } else {
         $_cal_locs = array();
      }
   
   
      if(($_cal_event->cal_options & 64) && @constant("_CAL_FORCE_LOCATION_") && !$_cal_user->access->can_admin($_cal_event->cal_obj)) {
   
         $_cal_tmpl->section_row(_LOCATION_, "<span id='location'></span>". $_cal_form->hidden('location'));
   
         $_cal_tmpl->section_spacer();
   
         $_cal_tmpl->section_row(_ADDRESS_, "<span id='addr_st'></span>".
               $_cal_form->hidden('addr_st')."<br>". _ADDRESS_1_);
   
   
         $_cal_tmpl->section_row("", "<span id='addr_ci'></span>".
               $_cal_form->hidden('addr_ci') ."<br>". _ADDRESS_2_);
   
         $_cal_tmpl->section_spacer();
   
         $_cal_tmpl->section_row(_PHONE_, "<span id='phone'></span>".$_cal_form->hidden('phone'));
   
   
      } else {
   
         $_cal_tmpl->section_row(_LOCATION_, $_cal_form->textbox('location',60,"maxlength=255"));
   
         $_cal_tmpl->section_spacer();
   
         $_cal_tmpl->section_row(_ADDRESS_, $_cal_form->textbox('addr_st', 40, "maxlength=40") ."
           <br>". _ADDRESS_1_);
   
   
         $_cal_tmpl->section_row("", $_cal_form->textbox('addr_ci', 40, "maxlength=40") ."
               <br>". _ADDRESS_2_);
   
         $_cal_tmpl->section_spacer();
   
         $_cal_tmpl->section_row(_PHONE_, $_cal_form->textbox('phone', 30, "maxlength=30"));
      }
   
       $_cal_tmpl->section_spacer();
 
    }
 
    $_cal_tmpl->end_section();



   ##########################
   #
   ### ATTACHMENTS
   #
   if((count($_cal_event->attachments) > 0 || (@constant("_CAL_ATTACHMENTS_") && $_cal_event->cal_options & 1)) && !$_cal_event->is_request) {
   #########################################

   $_cal_tmpl->new_section(_ATTACHMENTS_, true);

   if($_REQUEST["attachments_updated"]) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

   #$_cal_tmpl->section_spacer();

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.attachment.php");

   $zippable = $i = 0;

   foreach($_cal_event->attachments as $a)
   {

      $aid = $a['id'];

      $durl = new _cal_url("download_attachment.php");
      $durl->addArg("aid", $a['id']);

      $a = new _cal_attachment($a['id']);

         if(strpos($a->filename, '/')) {
            $durl = new _cal_url();
            $durl->base = $a->filename;
            $a->url = true;
            $a->url_title = ($a->filetype ? $a->filetype : $a->filename);
         } else {
            $zippable++;
         }


      $_cal_tmpl->section_row(++$i, "<img src='". @constant("_CAL_BASE_URL_") . "mime_icons/" .
           $a->icon ."' alt='type_icon' align='middle'> ".
           "<a href='". $durl->toString() ."' ". ($a->url ? " target='_blank' " : "") .">".($a->url ? $a->url_title : $a->filename) .
           "</a> ".
           ($a->url ? "" : "<font size=1>(". $a->size .")</font> ") .
           $_cal_form->checkbox("delete_attach_". $aid) . " " . _DELETE_);


      # NOTE
      # ----
      # Using the orignal attachment id $aid for the checkbox so that we
      # know which one we're deleting.  If the attachment is a pointer to
      # another attachment, the id gets changed internally.
      #####################################################################

   }

   if(!@constant("_CAL_ATTACHMENTS_") || ($_cal_event->cal_options & 1) == 0)
      $ma = 0;
   else if(@constant("_CAL_ATTACHMENTS_MAX_") < 1)
      $ma = count($_cal_event->attachments) + 3;
   else
      $ma = ($zippable >= @constant("_CAL_ATTACHMENTS_MAX_") ? 0 : ($zippable + 3));

   ###########################
   #
   # FILES
   #
   #########################
   while($zippable++ < $ma) {
      $_cal_tmpl->section_row(++$i, "<input type='file' size=50 name='attachment". $i."'>"); 
   }

   if($zippable || $ma) $_cal_tmpl->section_row("", "<hr align='center' width='100%'>");
   ############################
   #
   # URLS
   #
   ############################
   for($i = 0; $i < 4; $i++) {
      $_cal_tmpl->section_row(_URL_, $_cal_form->textbox('url_attachment_'. $i, 50, " maxlength=255").
        " ". _TITLE_ .": ". $_cal_form->textbox('url_attachment_title_'. $i, 20, " maxlength=255"));
   }

   if($_REQUEST['eid']) {
      $_cal_tmpl->new_row();
      $_cal_tmpl->toolbar($_cal_form->submit('event_action', _UPDATE_ATTACHMENTS_));
      $_cal_tmpl->end_row();
   }

   $_cal_tmpl->end_section();


   ###########################
   } # </ if _CAL_ATTACHMENTS_


    # change the toolbar form values..

    if(@constant("_CAL_EVENT_SERIAL_") != 2)
       $r = str_replace("1", "2", $r);


    # set it up to be written by javaScript
    #####################################
    $r = str_replace("'", "\\'", $r);
    $r = str_replace(array("\r","\n"), "", $r);
    $r = str_replace("/","\\/", $r);

    # we only really pay attention to the first radio values. The ones
    # at the top of the page. And clicking on these changes those
    # via javascript.  Only write these if the browser is javascript
    # enabled

    $_cal_tmpl->toolbar($l,"","<script language='javascript' type='text/javascript'>\ndocument.write('".
	$r."');\n</script>");

    $_cal_tmpl->print_footer();


    echo("</div>\n");

?>
<script language="javascript" type='text/javascript'>
<!--

function show_progress()
{

   var dv = document.getElementById('saveevent');
   var pg = document.getElementById('progress');

   if(dv && pg) {
      dv.style.display = 'none';
      pg.style.display = 'block';
   }

   setTimeout('document.images["pbar"].src = "<?php echo($_cal_html->get_img_url("images/progress_bar.gif")) ?>"', 100);

}

<?php

  $_cal_form->onSubmit[] = "return cal_add_event_check()";
?>

function cal_add_event_check()
{

   if(!checksave()) {
      return false;
   }

   show_progress();
   return true;

}

function startdate_picker()
{

   var elms = document.EventForm.elements;

   var urlargs = '?form=EventForm&elm=startdate';
   urlargs += '&y=' + elms['startdate_yr'].options[elms['startdate_yr'].selectedIndex].value;
   urlargs += '&m=' + elms['startdate_mo'].options[elms['startdate_mo'].selectedIndex].value;
   urlargs += '&d=' + elms['startdate_da'].options[elms['startdate_da'].selectedIndex].value;

   if(document.EventForm.elements['conflicts'].checked) {

      urlargs += '&conflicts=1';
      newWin('<?php echo(@constant("_CAL_BASE_URL_")) ?>modules/common_files/day_conflicts.php' + urlargs, 500, 350);

   } else {

     
      newWin('<?php echo(@constant("_CAL_BASE_URL_")) ?>modules/common_files/date_picker.php' + urlargs,220,250);
   }

}

function noIcon()
{

   document.images['icon'].src = '<?php echo(_CAL_BASE_URL_) ?>images/spacer.png';
   document.EventForm.elements['icon'].value = "";
}

function setIcon(file)
{

   document.images['icon'].src = file;
   document.EventForm.elements['icon'].value = file;
}

function checkInput(obj){ 

   var result = true;
   var max = <?php echo(intval(_CAL_NOTES_LEN_)) ?>;

   if(max < 1) return true;

   if (obj.value.length > max){ 
      var stripped = obj.value.substring(0, max); 
      obj.value = stripped; 
      result = false; 
   } 

   if (window.event) 
      window.event.returnValue = result; 

   return result; 
} 

   var wkdays = new Array(<?php echo('"'.$_cal_weekdays[0].'","'.$_cal_weekdays[1].'","'.$_cal_weekdays[2].'","'.$_cal_weekdays[3].  '","'.$_cal_weekdays[4].'","'.$_cal_weekdays[5].'","'.$_cal_weekdays[6].'"') ?>);

function setWeekday(elm)
{

   var mo = document.EventForm.elements[elm + '_mo'].options[document.EventForm.elements[elm + '_mo'].selectedIndex].value - 1;

   var da = document.EventForm.elements[elm + '_da'].options[document.EventForm.elements[elm + '_da'].selectedIndex].value;

   var yr = document.EventForm.elements[elm + '_yr'].options[document.EventForm.elements[elm + '_yr'].selectedIndex].value;


   var date = new Date(yr,mo,da);

   document.getElementById(elm + "_lbl").innerHTML = wkdays[date.getDay()];


}


function update_repeater(x)
{

  var i = 0;
  var len = document.EventForm.elements.length;
  var elems = document.EventForm.elements;

  var checked;

   for (i = 0; i < len; i++)
   {
      if (x == 1)
      {
         if (elems[i].name == 'apply_to1' && elems[i].checked == true)
            checked = elems[i].value;
      } else {

         if (elems[i].name == 'apply_to2' && elems[i].checked == true)
            checked = elems[i].value;
      }
   }

   for (i = 0; i < len; i++)
   {

      if (elems[i].name == 'apply_to1' || elems[i].name == 'apply_to2')
      {
         if (elems[i].value == checked)
            elems[i].checked = true;
         else
            elems[i].checked = false;
      }

   }

   <?php if($_REQUEST['instance']): ?>
   if(checked == "all")
   {

      document.EventForm.startdate_yr.value = <?php echo(intval($s_yr)) ?>;
      document.EventForm.startdate_mo.value = <?php echo(intval($s_mo)) ?>;
      document.EventForm.startdate_da.value = <?php echo(intval($s_da)) ?>;

   } else {

      add_yr("startdate","<?php echo(intval($i_yr)) ?>");
      add_yr("enddate", "<?php echo(intval($i_yr)) ?>");

      document.EventForm.startdate_yr.value = <?php echo(intval($i_yr)) ?>;
      document.EventForm.startdate_mo.value = <?php echo(intval($i_mo)) ?>;
      document.EventForm.startdate_da.value = <?php echo(intval($i_da)) ?>;

   }
   <?php endif ?>


   setWeekday('startdate');
}


var reps = new Array("<?php echo(_NONE_) ?>","<?php echo(_SIMPLE_) ?>","<?php echo(_ADVANCED_) ?>");

function set_imp_locale(sel)
{

   if(sel.selectedIndex == 1) {
      document.getElementById('locale_div').style.display = 'inline';
   } else {
      document.getElementById('locale_div').style.display = 'none';
   }
}

function add_yr(elm, y)
{

    var opts = document.EventForm.elements[elm + '_yr'].options;

    if(opts[opts.length - 1].value != y)
       opts[opts.length] = new Option(y,y);

}

function rep_sel(sel_name)
{

   for(i = 0; i < reps.length; i++)
   {

     if(reps[i] == sel_name) {

        document.getElementById(sel_name + '_repeat').style.display = 'inline';
        document.getElementById('rep_' + sel_name).innerHTML = '<b>' + sel_name + "<\/b>";

     } else {

        document.getElementById(reps[i] + '_repeat').style.display = 'none';
        document.getElementById('rep_' + reps[i]).innerHTML = '<a href="javascript:rep_sel(\''+ reps[i] + '\')" class="<?php echo(_CAL_CSS_ULINE_) ?>">' + reps[i] + "<\/a>";
         
     }
   }

   if(sel_name == '<?php echo(_NONE_) ?>') {
      document.getElementById('end_date').style.display = 'none';
   } else {
      document.getElementById('end_date').style.display = 'inline';
   }

   document.forms['<?php echo($_cal_form->name) ?>'].elements['r_source'].value = sel_name;

}

function r_add_exclude(y,m,d)
{

   var mydate = new Date(y,m - 1,d);
   var wkday = wkdays[mydate.getDay()];

   <?php if(@constant("_CAL_EURO_DATE_")): ?>
   date = d + '/' + m + '/' + y;
   <?php else: ?>
   date = m + '/' + d + '/' + y;
   <?php endif ?>

   var dval = y + '-' + m + '-' + d;

   var optlen = document.<?php echo($_cal_form->name) ?>.elements['r_exclude'].options.length;
   var opt = new Option(wkday + ' ' + date, dval);

    for(i = 0; i < optlen; i++)
    {

       if(document.<?php echo($_cal_form->name) ?>.elements['r_exclude'].options[i].value == dval) {
          return;
       }

    }

   document.<?php echo($_cal_form->name) ?>.elements['r_exclude'].options[optlen] = opt;

}

<?php

######################
#
### LOCATIONS MOD
#
#####################

if(@constant('_CAL_LOCATIONS_MOD_')) {
?>

var loc_opt_vals = new Array();

loc_opt_vals[0] = new Array();
loc_opt_vals[0]['street'] = '';
loc_opt_vals[0]['phone'] = '';

<?php


   # LOCATION OPTIONS
   #####################
   foreach($_cal_locs as  $cl) {

      echo("loc_opt_vals[{$cl['id']}] = new Array();\n");
      echo("loc_opt_vals[{$cl['id']}]['street'] = '". str_replace(
        array('\\',"'","\r","\n"),
        array('\\\\',"\\'","",""),$cl['address']) ."';\n");
      echo("loc_opt_vals[{$cl['id']}]['phone'] = '". str_replace(
        array('\\',"'","\r","\n"),
        array('\\\\',"\\'","",""),$cl['phone']) ."';\n\n");

   }

   $_cal_html->js_onload[] = 'upd_loc_sel('.intval($_cal_event->location_id) .');';

?>

function upd_loc_sel(idx) {

   document.getElementById('loc_street').innerHTML = loc_opt_vals[idx]['street'];
   document.getElementById('loc_phone').innerHTML = loc_opt_vals[idx]['phone'];
}

<?php 
}

####################
#
### RECENT LOCATIONS
#
#####################

if(!@constant('_CAL_LOCATIONS_MOD_') && count($_cal_locs)) {

   echo("var cal_js_locs = new Array();\n");
   echo("cal_js_locs[0] = new Array();\n");
   echo("cal_js_locs[0]['title'] = cal_js_locs[0]['addr_st'] = cal_js_locs[0]['addr_ci'] = cal_js_locs[0]['phone'] = '';\n");

   array_push($_cal_locs, 0);

   for($i = 1; $i < count($_cal_locs); $i++) {

      echo("cal_js_locs[{$i}] = new Array();\n");
      echo("cal_js_locs[{$i}]['title'] = '". str_replace(array("'","\r","\n"),
        array("\\'","",""), $_cal_locs[($i-1)]['location']) ."';\n");
      echo("cal_js_locs[{$i}]['addr_st'] = '". str_replace(array("'","\r","\n"),
        array("\\'","",""), $_cal_locs[($i-1)]['addr_st']) ."';\n");
      echo("cal_js_locs[{$i}]['addr_ci'] = '". str_replace(array("'","\r","\n"),
        array("\\'","",""), $_cal_locs[($i-1)]['addr_ci']) ."';\n");
      echo("cal_js_locs[{$i}]['phone'] = '". str_replace(array("'","\r","\n"),
        array("\\'","",""), $_cal_locs[($i-1)]['phone']) ."';\n");
   }

   echo("\n\n");
}

?>

function add_location(lid,lname,laddr,lphone)
{


   // existing location?
   if(loc_opt_vals[lid]) {

      loc_opt_vals[lid]['street'] = laddr;
      loc_opt_vals[lid]['phone'] = lphone;

      document.forms['<?php echo($_cal_form->name) ?>'].elements['location_id'].options[document.forms['<?php echo($_cal_form->name) ?>'].elements['location_id'].selectedIndex].text = lname;

      upd_loc_sel(lid);

      return;

   }

   loc_opt_vals[lid] = new Array();
   loc_opt_vals[lid]['street'] = laddr;
   loc_opt_vals[lid]['phone'] = lphone;

   var new_opt = new Option(lname, lid);

   var optlen = document.forms['<?php echo($_cal_form->name) ?>'].elements['location_id'].options.length;

   document.forms['<?php echo($_cal_form->name) ?>'].elements['location_id'].options[optlen] = new_opt;

   document.forms['<?php echo($_cal_form->name) ?>'].elements['location_id'].selectedIndex = optlen;

   upd_loc_sel(lid);
}

function change_cal(id, title, cats)
{

   document.forms['<?php echo($_cal_form->name) ?>'].elements['ecalendar'].value = id;
   document.getElementById('cal_title_span').innerHTML = title;
   document.getElementById('category_span').innerHTML = cats;

}

function cal_set_loc(loc)
{

   if(!cal_js_locs[loc]) return;

   <?php if(@constant("_CAL_FORCE_LOCATION_") && !$_cal_user->access->can_admin($_cal_event->cal_obj)): ?>
   document.getElementById('location').innerHTML = cal_js_locs[loc]['title'];
   document.getElementById('addr_ci').innerHTML = cal_js_locs[loc]['addr_ci'];
   document.getElementById('addr_st').innerHTML = cal_js_locs[loc]['addr_st'];
   document.getElementById('phone').innerHTML = cal_js_locs[loc]['phone'];
   <?php endif ?>

   document.forms['<?php echo($_cal_form->name) ?>'].elements['location'].value = cal_js_locs[loc]['title'];
   document.forms['<?php echo($_cal_form->name) ?>'].elements['addr_ci'].value = cal_js_locs[loc]['addr_ci'];
   document.forms['<?php echo($_cal_form->name) ?>'].elements['addr_st'].value = cal_js_locs[loc]['addr_st'];
   document.forms['<?php echo($_cal_form->name) ?>'].elements['phone'].value = cal_js_locs[loc]['phone'];
}

function preview_notes()
{
<?php
      $pnurl = new _cal_url("preview_notes.php");
      $pnurl->addArg("form", $_cal_form->name); 
      $pnurl->amp = '&';
?>
       newWin('<?php echo($pnurl->toString()) ?>', 400, 400);

<?php unset($pnurl); ?>

}

function grow_textarea(tname)
{

   document.forms['<?php echo($_cal_form->name) ?>'].elements[tname].rows += 5;
   document.forms['<?php echo($_cal_form->name) ?>'].elements[tname].cols += 10;
}

function shrink_textarea(tname)
{

   if(document.forms['<?php echo($_cal_form->name) ?>'].elements[tname].rows < 10) return;

   document.forms['<?php echo($_cal_form->name) ?>'].elements[tname].rows -= 5;
   document.forms['<?php echo($_cal_form->name) ?>'].elements[tname].cols -= 10;
}

function chown_submit(id, rtype, desc, name) {

    document.forms['<?php echo($_cal_form->name) ?>'].elements['chown_user'].value = id;

    document.getElementById('chown_user_span').innerHTML = name + ' (' + desc + ')';
}

<?php if($_cal_event->id > 0 && $_cal_event->override_id == 0): ?>
   update_repeater(1);
<?php endif ?>

setWeekday('startdate');

<?php if(!$_cal_event->override_id): ?>
rep_sel("<?php echo($_cal_event->rep_sel) ?>");
<?php endif ?>

<?php if($_cal_event->override_id == 0): ?>
   setWeekday('enddate');
<?php  endif ?>
<?php require_once(@constant("_CAL_BASE_PATH_") . "include/js/checksave.php"); ?>
//-->
</script>
<?php $_cal_form->print_footer(); ?>
