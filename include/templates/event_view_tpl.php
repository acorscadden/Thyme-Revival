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

  define("_CAL_DOING_OPTS_",1);

  require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
  require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");

  include(@constant("_CAL_BASE_PATH_") ."include/languages/"._CAL_LANG_.".php");

  global $_cal_weekdays, $_cal_user, $_cal_form, $_cal_vcal_wdays, $_cal_event, $_cur_cal, $_cal_tmpl;

   # object setup
   $_cal_tmpl = new _cal_template("event_view_template");
   $_cal_tmpl->row_header_width=90;


  if($_cal_event->not_found) {

     echo("The event you requested does not exist.");
     echo("<br><a href='javascript:history.go(-1)'>back</a>");
     return;
  }

  if(!$_cur_cal) {
     require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
     $_cur_cal = new _cal_obj($_SESSION['calendar']);
  }

  if(!$_cal_event->can_view($_cal_event->calendar)) {
     $_cal_html->permission_denied(false); # fixed
     return;
  }

  $_cal_event->set_localtime($_REQUEST['instance']);

  if($_REQUEST['instance'] && $_cal_form)
     echo($_cal_form->fromRequest('instance')); 

  if($_cal_form)
     echo($_cal_form->fromRequest('eid'));

   # SORT VCAL ITEMS
   $_cal_event->vcal_sort();     


   $start_date = $_cal_weekdays[_ex_date("w", $_cal_event->start)];
   $start_date .=" ". _ex_date(_DATE_INT_FULL_, $_cal_event->start);


   $_cal_tmpl->print_header("event");

   include(_CAL_BASE_PATH_."include/templates/event_title.php");

   $_cal_tmpl->new_section(_GENERAL_);

   if($_cur_cal->has_subcals || $_cal_event->is_request) {
      $_cal_tmpl->section_row(_CALENDAR_, $_cal_event->cal_title);
      $_cal_tmpl->section_spacer();
   }

   $_cal_tmpl->section_row(_DATE_, $start_date);

   if(($e_uptime = $_cal_event->uptime())) $_cal_tmpl->section_row("",$e_uptime);

   # time
   ##############
   if($_cal_event->allday == 0) {


      $_cal_tmpl->section_row(_TIME_, 
         _ex_display_time_long($_cal_event->start) .(
          ($_cal_event->start != $_cal_event->ends_at) ? ' - '.
         _ex_display_time_long($_cal_event->ends_at) :
        (@constant("_CAL_NO_ENDTIME_TEXT_") ? " ". _CAL_NO_ENDTIME_TEXT_ : "")));


       # timeone and DST ?
       if(@constant("_CAL_ENABLE_TZ_") && $_cal_event->use_tz == 1 && 
            ($_cal_event->timezone != $_cal_user->options->timezone || $_cal_event->dst != $_cal_user->options->dst))
       {

          $repeat_on_opts = array("no");

          for($i = 1; $i < 5; $i++) {
             $repeat_on_opts[] = @constant("_REPEAT_ON". $i ."_");
          }
          $repeat_on_opts[] = _REPEAT_ONL_;


           $_cal_tmpl->section_row(_TIMEZONE_,
                constant("_GMT_". ($_cal_event->timezone < 0 ? "MINUS" : "PLUS") . "_" .
                number_format(abs($_cal_event->timezone),1) ."_"));

           require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.dst.php");

           #################################
           # ONLY IF WE HAVE A  DST CONFIG
           #################################

           if($_cal_event->dst > 1) {

              $dst = new _cal_dst($_cal_event->dst, true);
  
              if($dst->repeat_on == 0) {
        
                 if(@constant("_CAL_EURO_DATE_")) {
                    $startstr = _ex_date("j", $dst->starttime) ." ";
                    $startstr .= $_cal_months[_ex_date("n", $dst->starttime)];
                  } else {
                    $startstr = $_cal_months[_ex_date("n", $dst->starttime)];
                    $startstr .= " ". _ex_date("j", $dst->starttime);
                  }
        
              } else {
        
                 $startstr = $repeat_on_opts[($dst->repeat_on)];
                 $startstr .= " ". $_cal_weekdays[$dst->repeat_on_wday];
                 $startstr .= " ". _IN_ ." ";
                 $startstr .= $_cal_months[_ex_date("n", $dst->starttime)];
              }
        
              if($dst->repeat_on_end == 0) {
        
                 if(@constant("_CAL_EURO_DATE_")) {
                    $endstr = _ex_date("j", $dst->endtime) ." ";
                    $endstr .= $_cal_months[_ex_date("n", $dst->endtime)];
                 } else {
                    $endstr = $_cal_months[_ex_date("n", $dst->endtime)];
                    $endstr .= " ". _ex_date("j", $dst->endtime);
                 }
        
              } else {
        
                 $endstr = $repeat_on_opts[($dst->repeat_on_end) ];
                 $endstr .= " ". $_cal_weekdays[$dst->repeat_on_wday_end];
                 $endstr .= " ". _IN_ ." ";
                 $endstr .= $_cal_months[_ex_date("n", $dst->endtime)];
        
        
               }
   
             $_cal_tmpl->section_row(_DST_, _STARTS_ .": ". $startstr ."<br>"._ENDS_.": ". $endstr);
  
          ############################
          # SIMPLE ON/OFF DST CONFIG
          ########################### 
          } else {

             $_cal_tmpl->section_row(_DST_, ($_cal_event->dst == 1 ? _ON_ : _OFF_));

          }

       }
    
    # CHECK FOR CALL_FOR_TIMES 
    } else if($_cal_event->allday == 2) {

       $_cal_tmpl->section_row(_TIME_,_CAL_CALL_FOR_TIMES_);
    }


   # organizer..
   #################
   if($_cal_event->org_name || $_cal_event->org_email)
   {
       if($_cal_event->org_email)


          # USE JAVASCRIPT WHEN NOT IN E-MAIL
          if(!@constant('_CAL_DOING_EMAIL_') && !@constant('_CAL_NO_HIDE_EMAIL_')) {

            $vs = array('A','B','C','D','E','F','G','H','I','J','K','L',
                'M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

            $v1 = $vs[rand(0,25)].rand(0,500);
            $v2 = $vs[rand(0,25)].rand(501,1000);
            $v3 = $vs[rand(0,25)].rand(1001,1500);

            list($to,$dom) = explode('@', $_cal_event->org_email);

            $name = ($_cal_event->org_name ? $_cal_event->org_name : _EMAIL_); 

            $_cal_event->org_email = "<script language='javascript'>
                <!--
                var {$v1} = '". @htmlspecialchars($to, ENT_QUOTES, _CHARSET_)."';
                var {$v2} = '". @htmlspecialchars($dom, ENT_QUOTES, _CHARSET_) ."?subject=".
                     @htmlspecialchars($_cal_event->title, ENT_QUOTES, _CHARSET_)."';
                var {$v3} = '". @htmlspecialchars($name, ENT_QUOTES, _CHARSET_)."';
                document.write('<a h' + 'ref=\"mai' + 'lto:' + {$v1} + '@' + {$v2} + '\">');
                document.write('' + {$v3} + '</a>');
            // -->
            </script>";


          } else {

             $_cal_event->org_email = "<a class='"._CAL_CSS_ULINE_."'
                href='mailto:".$_cal_event->org_email."?subject=". 
                @htmlspecialchars($_cal_event->title, ENT_QUOTES, _CHARSET_) ." (".
                @htmlspecialchars(_ex_date(_DATE_INT_FULL_, $_cal_event->start),
                    ENT_QUOTES, _CHARSET_) .") " .
                "'>".
                $_cal_event->org_email."</a>";

          }

      
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

      $_cal_tmpl->section_row(_URL_,"<a href='".$_cal_event->url.
            "' target='_blank' class='"._CAL_CSS_ULINE_."'>". $_cal_event->url ."</a>");

   }


   # notes
   ############
   if(strlen($_cal_event->notes) > 0) {
    
      $_cal_tmpl->section_spacer();

      $_cal_tmpl->section_row(_NOTES_, $_cal_event->format_notes());
   }



   if($_cal_event->flag == 1) {

      $_cal_tmpl->section_spacer();

      echo("<tr class='"._CAL_CSS_ROW_HEADER_."'>
   	<td align=middle colspan=2><font class='"._CAL_CSS_HIL_."'><b>". _IS_FLAGGED_ ."</b></font></td>
        </tr>\n");

    }


   $_cal_tmpl->section_spacer();


   # ONLY IF NOT IN EMAIL
   if(!@constant("_CAL_DOING_EMAIL_")) {

      if($_REQUEST['event_action'] != _DELETE_ && (!$_cal_event->is_request)) {

         # CHECK FOR SIMPLE MODE
         if(@constant("_CAL_EXPORT_DOWNLOAD_") && !$_cal_user->admin) {

            $exurl = new _cal_url("modules/sync/export.php");
            $exurl->addArg("export_to", "ical");
            $exurl->addArg("eid", $_cal_event->id);
            $exurl->addArg("instance", $_cal_event->instance);
            $exurl->addArg("quirks_mode", 1);

            $exp = "<input type=button value='"._DOWNLOAD_."' class='"._CAL_CSS_BUTTON_."'
                onClick='document.location=\"".$exurl->toString()."\"'>";

         } else {
            $exp = $_cal_form->submit("event_action", _EXPORT_);
         }

         if(!$_cal_user->guest && @constant("_CAL_MAIL_FROM_")) {

            $eml = " &nbsp; " . $_cal_form->submit("event_action", _EMAIL_);

         } else if($_cal_user->guest && @constant("_CAL_GUEST_EMAIL_OK_") && @constant("_CAL_MAIL_FROM_")) {

            $eml = " &nbsp; " . $_cal_form->submit("event_action", _TELL_A_FRIEND_);

         }
         $_cal_tmpl->toolbar("", $exp . $eml , " ");

      }
   }
 
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

         if($_cal_event->byday) {

            $_ex_ev_wday_sort_arr = $_cal_vcal_wdays;

            for($i = 0; $i < $_cal_user->options->week_start; $i++) {

               $tmp = $_ex_ev_wday_sort_arr[$i];
               unset($_ex_ev_wday_sort_arr[$i]);
               $_ex_ev_wday_sort_arr[] = $tmp;

            }

            $_ex_ev_wday_sort_arr = array_flip($_ex_ev_wday_sort_arr);

            $bydays = explode(",", $_cal_event->byday);

            global $_ex_ev_wday_sort_arr; 


            if(!function_exists('_ex_ev_wday_sort')) {
            function _ex_ev_wday_sort($a,$b) {

               global $_ex_ev_wday_sort_arr;

               if($_ex_ev_wday_sort_arr[$a] == $_ex_ev_wday_sort_arr[$b]) return strcmp($a,$b);

               return ($_ex_ev_wday_sort_arr[$a] > $_ex_ev_wday_sort_arr[$b] ? 1 : -1);
         

            }
            }

            usort($bydays, "_ex_ev_wday_sort");

            $_cal_event->byday = join(",",$bydays);

         }

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

    if(!@constant("_CAL_DOING_EMAIL_")) {

       $vurl = new _cal_url();
       $vurl->addArg("eid", $_cal_event->id);
   
       $_cal_tmpl->section_row(_STARTED_, "<a href='". $vurl->toString() ."'>".
               $GLOBALS['_cal_weekdays'][_ex_date("w", $_cal_event->start)] ." ".
               _ex_date(_DATE_INT_FULL_, $_cal_event->start) ."</a>");
   
   
       require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
   
       $_cal_event->start = $_cal_event->start_timestamp = $_cal_event->starttime;
   
       $r = new _cal_repeater($_cal_event);
       $n = $r->get_next_time(_ex_date("Y-n-j 0:0", _ex_localtime()));
      
       $vurl->addArg("eid", $_cal_event->id);
   
       if($n !== null) {
   
          $vurl->addArg("instance", $n);
   
          $_cal_event->set_localtime($n);
   
          $n = $_cal_event->start;
   
          $_cal_tmpl->section_row(_NEXT_, "<a href='". $vurl->toString() ."'>".
               $GLOBALS['_cal_weekdays'][_ex_date("w", $n)] ." ".
               _ex_date(_DATE_INT_FULL_, $n) ."</a>");
       }


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

      list($or) = $GLOBALS['_cal_sql']->query("select title from
                {$GLOBALS['_cal_dbpref']}Events where id = ". $_cal_event->override_id);

      $vurl = new _cal_url();
      $vurl->addArg("eid", $_cal_event->override_id);

      $rw = $_cal_tmpl->row_header_width;
      $_cal_tmpl->row_header_width = 20;

      $_cal_tmpl->new_section(_REPEATING_);
      $_cal_tmpl->section_row("",sprintf(_OVERRIDE_EVNT_ON_, 
            "<a class='"._CAL_CSS_ULINE_."' target='_blank' href='". $vurl->toString()
            ."'>". $or['title'] ."</a>",
            _ex_date(_DATE_INT_FULL_, $_cal_event->override_date)));
      $_cal_tmpl->end_section();

      $_cal_tmpl->row_header_width = $rw;

   }

   #############################
   # 
   ## LOCATION INFORMATION
   #
   #############################

   if(@constant('_CAL_LOCATIONS_MOD_')  && $_cal_event->location_id) {

      $_cal_tmpl->new_section(_LOCATION_);

      require_once(_CAL_BASE_PATH_."modules/locations/location_view_tmpl.php");

      $_cal_tmpl->end_section();

   } else if($_cal_event->addr_ci || $_cal_event->addr_st || $_cal_event->phone || $_cal_event->location) {
   
         $_cal_tmpl->new_section(_LOCATION_);
   
         if(strlen($_cal_event->location) > 0) {
   
            $_cal_tmpl->section_row(_LOCATION_, $_cal_event->location);
            $_cal_tmpl->section_spacer();
         }
   
   
         if($_cal_event->addr_st || $_cal_event->addr_ci) {
   
            # construct mapquest link...
   
            require_once(@constant("_CAL_BASE_PATH_") . "include/custom_functions.php");
   
            $_cal_tmpl->section_row(_ADDRESS_, $_cal_event->addr_st ."<BR>".
                   $_cal_event->addr_ci . 
                   ((@constant("_CAL_NOMAP_") || !function_exists("map_link")) ? "" : 
                       "<BR>[<a class='"._CAL_CSS_ULINE_."' target=_new href='".
                        map_link($_cal_event->addr_st, $_cal_event->addr_ci) ."'>". _MAP_ ."</a>]")
                   );
   
            $_cal_tmpl->section_spacer();
         }
   
         if($_cal_event->phone)
            $_cal_tmpl->section_row(_PHONE_, $_cal_event->phone);
   
         $_cal_tmpl->section_spacer();
   
         $_cal_tmpl->end_section();
   }

   ###############################
   #
   ## REMINDERS
   #
   ###############################

   if(!@constant("_CAL_DOING_EMAIL_") && $_REQUEST['event_action'] != _DELETE_ && $_cal_user->email &&
        !$_cal_event->is_request && !$_cal_user->guest && @constant("_CAL_MAIL_FROM_") && !@constant("_CAL_NO_JOBS_")) {


         # check dates...
         ####################
         if($_cal_event->override_id) {
         
            list($dates) = $_cal_sql->query("select starttime, endtime from {$GLOBALS['_cal_dbpref']}Events
                where id = ".  $_cal_event->override_id);

            $stime = $dates['starttime'];
            $etime = $dates['endtime'];
         } else {
            $stime = $_cal_event->start;
            $etime = $_cal_event->end;
         }

         if($_cal_user->to_localtime() < $stime ||
                    ($_cal_user->to_localtime() < $etime || (($_cal_event->freq || $_cal_event->override_id) && !$_cal_event->end))) {
            $_cal_tmpl->new_section(_REMINDERS_);
            require_once(@constant("_CAL_BASE_PATH_") . "include/reminders.php");
            $_cal_tmpl->end_section();
         }
   }

   #############################
   #
   ## ATTACHMENTS
   #
   #############################

   if(count($_cal_event->attachments) > 0) {


      require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.attachment.php");
      require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");

      $tmp = $_cal_tmpl->row_header_width;
      $_cal_tmpl->row_header_width = 1;

      $_cal_tmpl->new_section(_ATTACHMENTS_);

      foreach($_cal_event->attachments as $a) {

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

         $_cal_tmpl->section_row("", "<img src='". @constant("_CAL_BASE_URL_") . "mime_icons/" .
           $a->icon ."' alt='type_icon' align='middle'> ".
           "<a href='". $durl->toString() ."' ". ($a->url ? " target='_blank'" : "") .">".
            ($a->url ? $a->url_title : $a->filename) .

           ($a->url ? "" : 
           "</a> <font size=1>(". $a->size .")</font>")

            );

      }

      if($zippable > 1 && function_exists("gzdeflate")) {

         $durl = new _cal_url("download_zip.php");
         $durl->addArg("eid", $_cal_event->id);
         $_cal_tmpl->section_spacer();
         $_cal_tmpl->section_row("", "<center><a href='". $durl->toString() ."'>"._DOWNLOAD_ZIP_."</a>
        </center>");
      }

      $_cal_tmpl->end_section();

      $_cal_tmpl->row_header_width = $tmp;

   }



   ##########################
   #
   ### REQUEST NOTES
   #
   ##########################

   if($_cal_event->is_request) {

      $_cal_tmpl->row_header_width = 150;

      $_cal_tmpl->new_section(_REQUEST_);

      $u = new _cal_user("","",$_cal_event->owner);

      if($_cal_event->request_contact) {
         $_cal_event->request_contact = "( <a href='mailto:". $_cal_event->request_contact ."'
            class='"._CAL_CSS_ULINE_."'>". $_cal_event->request_contact ."</a> )";
      }

      $_cal_event->added = $GLOBALS['_cal_user']->to_localtime($_cal_event->added);

      $_cal_tmpl->section_row(_CONTACT_, $u->name ." ". $_cal_event->request_contact);

      $_cal_tmpl->section_row(_SUBMITTED_, _ex_date(_DATE_INT_FULL_,
            $_cal_event->added) ." ". _ex_display_time_med($_cal_event->added));

      $_cal_tmpl->section_row(_REQUEST_NOTES_, $_cal_event->request_notes);

      
      $_cal_tmpl->end_section();
   

   }



?>
