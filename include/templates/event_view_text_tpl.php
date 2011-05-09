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
// $Id: event_view_text_tpl.php,v 1.21 2006/03/10 17:36:38 ian Exp $
//

define("_CAL_DOING_OPTS_",1);

define("_CAL_BASE_PATH_", preg_replace("/include\/templates$/","",preg_replace("/\\\/","/",dirname(__FILE__))));

require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");

include(@constant("_CAL_BASE_PATH_") ."include/languages/"._CAL_LANG_.".php");

global $_cal_weekdays, $_cal_user, $_cal_sep, $_cal_vcal_wdays, $_cal_dbpref;

# SPECIAL TEMPLATE OBJECT FOR TEXT
####################################
if(!@constant("_CAL_TEXT_TEMPLATE_")) {

   class text_template
   {


   function section_row($heading, $rowdata = "") 
   {
      if($heading) { echo("$heading: "); }
      if($rowdata) { echo("$rowdata\r\n"); }
   }

   function section_spacer() { }

   function new_section($title) {
      global $_cal_sep;
      echo($_cal_sep);
      echo("== ". $title ."\r\n");
      echo($_cal_sep);
   }

   function end_section() { echo("\r\n"); }


   }

define("_CAL_TEXT_TEMPLATE_", 1);

}
  # only select this instance if we're doing a
  # repeating event...
  #############################################
  if($_cal_event->freq > 0)
  {

     if($_REQUEST['instance']) {
        $_cal_event->start = _ex_strtotime($_REQUEST['instance'] ." ". _ex_date("H:i:00", $_cal_event->start));
     }

    
     
  }

   $_cal_tmpl = new text_template();

   $start_date = $_cal_weekdays[_ex_date("w", $_cal_event->start)];
   $start_date .=" ". _ex_date(_DATE_INT_FULL_, $_cal_event->start);


   $_cal_sep = "##########################################\r\n";

   # EVENT TITLE
   ##############
   echo($_cal_sep);
   echo("#\r\n");
   echo("### ". $_cal_event->title ."\r\n");
   echo("#\r\n");
   echo($_cal_sep ."\r\n");

   $_cal_sep = substr(preg_replace("/\#/", "=",$_cal_sep), 0, 20) ."\r\n";

   echo("=== ". _GENERAL_ ."\r\n");
   echo($_cal_sep);


   $_cal_tmpl->section_row(_CALENDAR_, $_cal_event->cal_title);
   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_DATE_, $start_date);

   # time
   ##############
   if($_cal_event->allday == 0) {


      $_cal_tmpl->section_row(_TIME_, 
         _ex_display_time_long($_cal_event->start) .' - '.
         _ex_display_time_long($_cal_event->ends_at));


    } else if ($_cal_event->allday == 2) {

      $_cal_tmpl->section_row(_TIME_, _CAL_CALL_FOR_TIMES_);

    }


   $_cal_tmpl->section_spacer();

   # organizer..
   #################
   if($_cal_event->org_name || $_cal_event->org_email)
   {
      
       if($_cal_event->org_name) {
          $org = $_cal_event->org_name;
          if($_cal_event->org_email)
             $org = $org ." ( ". $_cal_event->org_email ." )";
       } else {
          $org = $_cal_event->org_email;
       }

       $_cal_tmpl->section_row(_ORGANIZER_, $org);

   }


   # url.. 
   #############
   if($_cal_event->url) {

      $_cal_tmpl->section_row(_URL_,$_cal_event->url);

   }


   # notes
   ############
   if(strlen($_cal_event->notes) > 0) {
    
      $_cal_tmpl->section_spacer();

      $_cal_tmpl->section_row(_NOTES_, $_cal_event->notes);
   }



   if($_cal_event->flag == 1) {

      $_cal_tmpl->section_spacer();

   	  $_cal_tmpl->section_row(_FLAG_,_IS_FLAGGED_);

    }


   $_cal_tmpl->section_spacer();


   $_cal_tmpl->end_section();


   #########################
   #
   ### REPEATING
   #
   #########################

   if($_cal_event->freq > 0) {

      $_cal_tmpl->new_section(_REPEATING_);


      switch($_cal_event->freq)
      {


        case 2:
           $_cal_event->repeat_every_val = 2;
           break;

        case 3:
           $_cal_event->r_weeks = $_cal_event->finterval;

           if(strlen($_cal_event->byday))
              $_cal_event->repeat_every_val = 6;
           else
              $_cal_event->repeat_every_val = 1;

           break;

        case 4:
           $_cal_event->repeat_every_val = 0;
           break;

        case 5:
           $_cal_event->repeat_every_val = 5;
           $_cal_event->r_easter = abs($_cal_event->finterval);
           $_cal_event->r_easter_when = $_cal_event->finterval < 0 ? _BEFORE_ : _AFTER_;
           break;

      }
       if(!isset($_cal_event->repeat_every_val)) $_cal_event->repeat_every_val = 3;



      # set an interval if we don't have one
      if($_cal_event->freq != 5) $_cal_event->finterval = max(1,$_cal_event->finterval);

      # check for a simple repeating event
      ###################################3
      if($_cal_event->freq == 0) {

      # CHECK FOR SIMPLE REPEATING EVENT
      ##################################
      } else if(
         # general stuff
         (!(strlen($_cal_event->bysetpos) || $_cal_event->freq > 4 || strlen($_cal_event->bymonth)))
           &&
         ($_cal_event->timezone == $_cal_user->options->timezone && $_cal_event->dst == $_cal_user->options->dst)
           &&

        (strpos($_cal_event->bymonthday, ",") === false) &&
        (strpos($_cal_event->bymonth, ",") === false) &&

        !$_cal_event->bysetpos &&

         # check for repeat every
         ########################
         (
          (
            # repeating weekly with some things are ok
            (($_cal_event->freq == 3 && !preg_match("/[0-9]/",$_cal_event->byday) &&
                        $_cal_event->wkst == $_cal_user->options->week_start)
                ||
            # if we don't have a byday we can do simple mode
            (!$_cal_event->byday))
                &&
            # set simple repeat rule
            $_cal_event->repeat_every_mask = 1
                &&
            # bymonthday is only 1
            (strpos($_cal_event->bymonthday,",") === false && $_cal_event->bymonthday > 0)
          ) || (

          # check for repeat on the X wday every X months
          ################################################

            $_cal_event->freq == 2 && strpos($_cal_event->byday,",") === false && preg_match("/[0-9]/",$_cal_event->byday)
                &&
           # set simple repeat rule
           $_cal_event->repeat_on_months = $_cal_event->finterval

          # </ finterval && .. check for repeat every or repeat on
         ) || (

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
        )

      ) {

         $_cal_event->rep_sel = _SIMPLE_;

         # set up first, second, last etc..
         preg_match("/(\-?[0-9])/", $_cal_event->byday, $foo);
         $_cal_event->repeat_on = intval($foo[0]);
         if(intval($foo[0]) < 0) $_cal_event->repeat_on = 6;

         $_cal_event->repeat_on_wday = array_search(substr($_cal_event->byday,-2,2), $GLOBALS['_cal_vcal_wdays']);



      ######################################
      # ADVANCED REPEATING RULES IN AFFECT
      ######################################
      } else {
         $_cal_event->rep_sel = _ADVANCED_;

         if($_cal_event->repeat_every_val == 6) $_cal_event->repeat_every_val = 1;

         $repeatstr = _REPEATING_EVERY1_ ." ".$_cal_event->finterval . " ".
            $_cal_event->repeat_every_val_opts[$_cal_event->repeat_every_val];

          $temp_width = $_cal_tmpl->row_header_width;
          $_cal_tmpl->row_header_width = 150;

         if($_cal_event->repeat_every_val == 5) {

            if($_cal_event->finterval != 0)
               $repeatstr = abs($_cal_event->finterval)." ". _DAYS_ ." ". $_cal_event->r_easter_when ." ";
            else
               $repeatstr = "";


            $repeatstr .= _EASTER_YEARLY_;
         }

         ######################
         # SET/FIX BYDAY
         ######################
         $_cal_event->byday = str_replace(" ", "", $_cal_event->byday);
         # grab values for checkboxes
         $vals = array_flip(explode(",", str_replace($_cal_vcal_wdays,range(0,6),$_cal_event->byday)));
         $keys = explode(",", $_cal_event->byday);

         $byday = preg_replace("/(\-?\d)?([A-Z]{2})/", "\\1 \\2", $_cal_event->byday);
         $byday = str_replace(array("-1 ","1 "), array(_LAST_." ",_REPEAT_ON1_." "),
            strtoupper($byday));

         for($i = 2; $i < 6; $i++)
         {
            $byday = str_replace($i." ", $_cal_event->repeat_on_opts[$i] ." ",
                $byday);
         }
         $byday = str_replace($_cal_vcal_wdays, $_cal_weekdays, $byday);

         if($_cal_event->freq == 2)
            $byday = preg_replace("/(^|,) /", "\\1 "._REPEATING_EVERY1_." ", $byday);

         $byday = preg_replace("/(, *)/", ", ", $byday);

         #########################
         # SET/FIX BYMONTHDAYS
         ########################
         $_cal_event->bymonthday = str_replace(" ","",$_cal_event->bymonthday);
         $bymonthday = preg_replace("/\-1([^0-9]|$)/", _LAST_."\\1", $_cal_event->bymonthday);
         $bymonthday = preg_replace("/\-(\d+)/", "\\1 "._FROM_LAST_, $bymonthday);
         $bymonthday = preg_replace("/(, *)/", ", ", $bymonthday);

        ####################
        # SET/FIX BYMONTH
        ####################
        $bymonth = str_replace(" ", "", $_cal_event->bymonth);
        $bymonth = str_replace(range(12,1),array_reverse($_cal_months),$bymonth);
        $bymonth = str_replace(",",", ",$bymonth);

        #######################
        # SET/FIX BYSETPOS
        ######################
        $bysetpos = str_replace(" ","",$_cal_event->bysetpos);
        $bysetpos = preg_replace("/\-1([^0-9]|$)/", _LAST_."\\1", $_cal_event->bysetpos);
        $bysetpos = preg_replace("/\-(\d+)/", "\\1 "._FROM_LAST_, $bysetpos);
        $bysetpos = str_replace(",",", ", $bysetpos);

        if($_cal_event->freq == 3 && $_cal_event->finterval > 1 && $_cal_event->wkst != $_cal_user->options->week_start)
           $wkst = $_cal_weekdays[$_cal_event->wkst];


      }

      # header for repeating row
      $repeathdr = _REPEATING_REPEAT_ ;

      # for simple
      $_cal_event->repeat_every = $_cal_event->finterval;

      ##########################
      # REPEAT EVERY X X's
      ##########################
      if($_cal_event->repeat_every_mask > 0) {

         $repeatstr = _REPEATING_EVERY1_ ." ".$_cal_event->repeat_every . " ";

         # selected days?
         if($_cal_event->repeat_every_val == 6) {

             $wdays = str_replace($GLOBALS['_cal_vcal_wdays'], $_cal_weekdays, $_cal_event->byday);
             $wdays = str_replace(",",", ", $wdays);

             $repeatstr .= $wdays;

         } else {
            $repeatstr .= " ".  $_cal_event->repeat_every_val_opts[$_cal_event->repeat_every_val];
            $repeatstr = $repeatstr;
         }

      } else if($_cal_event->repeat_on) {

         $repeatstr = _REPEAT_ON_." ".$_cal_event->repeat_on_opts[$_cal_event->repeat_on];
         $repeatstr .= " ". $_cal_weekdays[$_cal_event->repeat_on_wday];
         $repeatstr .= " ". _REPEAT_ON_OF_ ." ";
         $repeatstr .= ($_cal_event->repeat_on_months > 1 ? $_cal_event->repeat_on_months : "") ." ". _MONTHS_;
      }



    # set to user's time
    ######################
    $_cal_event->start = $_cal_event->starttime;
    $_cal_event->set_localtime();

    $_cal_tmpl->section_row(_STARTED_, $GLOBALS['_cal_weekdays'][_ex_date("w", $_cal_event->start)] ." ". 
            _ex_date(_DATE_INT_FULL_, $_cal_event->start));


    require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");

    $_cal_event->start = $_cal_event->start_timestamp = $_cal_event->starttime;

    $r = new _cal_repeater($_cal_event);
    $n = $r->get_next_time(_ex_date("Y-n-j 0:0", _ex_localtime()));

    if($n !== null) {

       $_cal_event->set_localtime($n);

       $n = $_cal_event->start;

       $_cal_tmpl->section_row(_NEXT_, $GLOBALS['_cal_weekdays'][_ex_date("w", $n)] ." ".
            _ex_date(_DATE_INT_FULL_, $n));
    }



     $_cal_tmpl->section_row($repeathdr,$repeatstr);

    if($bymonth) $_cal_tmpl->section_row(_MONTHS_,$bymonth);
    if($bymonthday) $_cal_tmpl->section_row(_MONTH_DAYS_, $bymonthday);
    if($byday) $_cal_tmpl->section_row(_WEEKDAYS_, $byday);
    if($wkst) $_cal_tmpl->section_row(_STARTING_ON_, $wkst);
    if($bysetpos) $_cal_tmpl->section_row(_SPECIFIC_OCCURRENCES_,$bysetpos);

    if($_cal_event->end_after) {
        $_cal_tmpl->section_row(_END_DATE_AFTER_, $_cal_event->end_after ." ". _OCCURRENCES_);
    }

    if($_cal_event->end != "") {

      $eweekday = $GLOBALS['_cal_weekdays'][_ex_date("w", $_cal_event->end)];
      $_cal_tmpl->section_row(_END_DATE_, $eweekday ." ". _ex_date(_DATE_INT_FULL_, $_cal_event->end));

    }

    $_cal_tmpl->section_spacer();
    $_cal_tmpl->end_section();
    if($temp_width) $_cal_tmpl->row_header_width = $temp_width;

   # </ if repeating >
   } else if($_cal_event->override_id) {

      list($or) = $GLOBALS['_cal_sql']->query("select title from {$_cal_dbpref}Events
        where id = ". $_cal_event->override_id);

      $vurl = new _cal_url();
      $vurl->addArg("eid", $_cal_event->override_id);

      $rw = $_cal_tmpl->row_header_width;
      $_cal_tmpl->row_header_width = 20;

      $_cal_tmpl->new_section(_REPEATING_);
      $_cal_tmpl->section_row("",sprintf(_OVERRIDE_EVNT_ON_,
            "<a class='"._CAL_CSS_ULINE_."' target='_blank' href='". $vurl->toString() ."'>". $or['title'] ."</a>",
            _ex_date(_DATE_INT_FULL_, $_cal_event->override_date)));
      $_cal_tmpl->end_section();

      $_cal_tmpl->row_header_width = $rw;

   }


   #############################
   # 
   ## LOCATION INFORMATION
   #
   #############################

   if($_cal_event->addr_ci || $_cal_event->addr_st || $_cal_event->phone || $_cal_event->location) {

      $_cal_tmpl->new_section(_LOCATION_);

      if(strlen($_cal_event->location) > 0) {

         $_cal_tmpl->section_row(_LOCATION_, $_cal_event->location);
         $_cal_tmpl->section_spacer();
      }


      if($_cal_event->addr_st || $_cal_event->addr_ci) {

         $_cal_tmpl->section_row(_ADDRESS_, $_cal_event->addr_st ."\r\n\t ".
                $_cal_event->addr_ci);

         $_cal_tmpl->section_spacer();
      }



      if($_cal_event->phone) {

         $_cal_tmpl->section_row(_PHONE_, $_cal_event->phone);

      }

      $_cal_tmpl->section_spacer();
      $_cal_tmpl->end_section();
   }



?>
