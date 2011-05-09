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
// $Id: display_week.php,v 1.46 2007/05/12 12:27:06 ian Exp $
//

   if(@constant("_CAL_WEEK_SCHEDULE_VIEW_") && @include(_CAL_BASE_PATH_."include/classes/cal_helpers/display_week_schedule.php")) return;

   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");

   global $_cal_weekdays_abbr, $_cal_user;

   # event event_matrix stuff
   #########################
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_minimal.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");
   require_once(_CAL_BASE_PATH_."include/images.php");


   if($this->show_events) {
      $em = new _cal_event_matrix($tmptime, "week", $this->event_types, $this->calendar, $this->filter);
      $event_matrix = $em->matrix;
   } else {
      $event_matrix = array(); # to avild errors
   }

   # check event size config
   #########################
   if($_cal_user->options->e_size == 1) {


      $fsize = -2;
      $tsize = -3;
      $isize = 10;
      $padding = 2;
      $dsize = 15;

   } else if ($_cal_user->options->e_size == 2) {

      $fsize = -4;
      $tsize = -4;
      $isize = 8;
      $padding = 1;
      $dsize = 14;

   } else {

      $isize = 14;
      $tsize = -2;
      $padding = 4;
      $dsize = 16;
   }


   echo("<div class='"._CAL_CSS_WEEK_."'>\n");

   echo("<table ". ($this->printing ? "border=1 cellpadding=2 cellspacing=0 style='background: #000000; border: 2px solid black; border-collapse: collapse'" : "") ." width='100%'>\n");

   $url = new _cal_url();


   $wday = _ex_date("w", $this->time);

   # decrement this so the below works

   $tmptime -= 86400;

   $today_sel = _ex_date("Y-n-j", _ex_localtime());

   # step through 7 days..
   ###########################
   for($startday = 0; $startday < 7; $startday++)
   {
      $tmptime += 86400;

      $class=(_ex_date("Y-n-j",$tmptime) == $today_sel && $this->hil_day) ?
         _CAL_CSS_CAL_SELECTED_ : _CAL_CSS_ROW_HEADER_;

      list($yr,$mo,$da) = explode("-",_ex_date("Y-n-j", $tmptime));

      $url->addArg($this->listeners['year'], $yr);
      $url->addArg($this->listeners['day'], $da);
      $url->addArg($this->listeners['month'], $mo);
      $url->addArg($this->listeners['view'], "d");

      $wday = $_cal_weekdays_abbr[_ex_date("w", $tmptime)];

      # tell print we need to do something
      # with this text..
      #############################
      if($this->printing) {
         $wday = "<font class='print_heading'>". $wday ."</font>";
      }

      # header stuff..
      echo("<tr valign=top>\n<td class='".$class."' 
          height='60' align='center'><b>". $wday ."</b><br>");


      if($this->printing || $this->static) {

         echo("<font class='{$class}'>"._ex_date(_DATE_INT_NOYR_, $tmptime)."</font>");

      } else {

         echo("<a class='". $class ."' href=\"" . $url->toString() ."\">");
         echo(_ex_date(_DATE_INT_NOYR_, $tmptime));
         echo("</a>");
      }
    
      if($this->event_add_url) {

         $aurl = $this->event_add_url;
         $aurl = str_replace(array('%d','%m','%y'),array($da,$mo,$yr), $aurl);

      } else {
 
         $url->addArg("event_action", _ADD_);
         $url->addArg($this->listeners['view'], "w");

         $aurl = $url->toString();
      }

      echo("<br><br>");

      if($this->editable) {
         echo("[<a class='"._CAL_CSS_ROW_HEADER_."' href=\"" . $aurl .  "\">".'+'."</a>]");
      }


      # begin week cal_content..
      ##########################
      echo("</td>\n<td width='100%' class='"._CAL_CSS_CAL_CONTENT_."'> ");


      ###############################
      # EVENT MATRIX STUFF
      ###############################
      if(count($event_matrix[$startday])) {


         echo("<table width='100%' ". ($this->printing ? "border=0 class='printing'" : "") ." cellspacing=0 cellpadding=$padding>\n");
            
         foreach ($event_matrix[$startday] as $e) {

            $id = $e['id'];
            $inst = $e['instance'];

            $e = new _cal_event_minimal($e);
            $e->instance = $inst;

            if(is_array($this->notable_events))
               $this->notable_events[$id] = 1;

          
            echo("<tr valign=top>
                  <td class='". $e->css_class ." ".  $e->type_css_class ."' ");

                 if($_cal_user->options->e_n_popup == 1 && !$this->printing) {
                    echo(" onMouseOver='show_notes(\"enotes_". $id ."\");' ");
                    echo(" onMouseOut='hide_notes(\"enotes_". $id ."\");' ");
                 }

            echo(">");


            if(@constant("_CAL_WEEK_TIMES_FIRST_")) {

               # time of event..
               ################
               if(!$e->allday) {
   
   
                  echo(_ex_display_time_med($e->start));

                  if($e->start != $e->ends_at) {
                    echo(" - ");
                    echo(_ex_display_time_med($e->ends_at));
                  } else if(@constant("_CAL_NO_ENDTIME_TEXT_")) {
                    echo(" ". _CAL_NO_ENDTIME_TEXT_);
                  } 
               } else if($e->allday == 2) {
                   echo(_CAL_CALL_FOR_TIMES_);
               } else {
                  echo(_ALLDAY_);
               }
   
              echo(" ");
           }
 
           if($e->icon) {
              echo(_ex_img_str(_CAL_BASE_URL_ . $e->icon, $e->title ,$isize,$isize) ." ");
           }

           foreach($e->type_icons as $te) {
             echo(_ex_img_str(_CAL_BASE_URL_ . $te, $e->type_name,$isize,$isize) ." ");
           }


           # event name 
           #################

           if($this->printing || !$this->event_links) {
              echo($fsize ? "<font size='{$fsize}' class='". $e->css_class ." ". $e->type_css_class ."'>" : "");
              echo($e->title);
              echo($fsize ? "</font>" : "");

           # event view url
           ############################
           } else {

              $vurl = $this->event_view_url;
              $vurl = str_replace('%eid', $id, $vurl);
              $vurl = str_replace('%inst', _ex_date("Y-n-j", $e->instance), $vurl);

              echo("<a class='". $e->css_class ." ". $e->type_css_class ."' href='". $vurl ."'");
              echo(">" . ($fsize ? "<font size='{$fsize}'>" : "") .  $e->title . ($fsize ? "</font>" : "") ."</a>");
           
           } 
             
            echo(" <font size=$tsize>");

             if($e->cal_title && @constant("_CAL_SHOW_CAL_NAMES_"))
                    $e->type_name = '<u>'.$e->cal_title .'</u>'.($e->type_name ? ": " . $e->type_name : "");
 
            if($_cal_user->options->e_typename && $e->type_name)
               echo("[". $e->type_name ."] ");


           echo("</font> ");

            if(!@constant("_CAL_WEEK_TIMES_FIRST_")) {

               # time of event..
               ################
               if(!$e->allday) {
   
  
                  echo(_ex_display_time_med($e->start));

                  if($e->start != $e->ends_at) {
                    echo(" - ");
                    echo(_ex_display_time_med($e->ends_at));
                  } else if(@constant("_CAL_NO_ENDTIME_TEXT_")) {
                    echo(" ". _CAL_NO_ENDTIME_TEXT_);
                  }
                    
               } else if($e->allday == 2) { 
                   echo(_CAL_CALL_FOR_TIMES_);
               } else {
                  echo(_ALLDAY_);
               }       
   
           }

           echo("</td></tr>");

         }

         echo("</table>");


      } # </ EVENT MATRIX STUFF >
      else {
        echo(" &nbsp; ");
      }

      echo(" </td>\n</tr>\n");


      $url->addArg("event_action", "");

   }

   echo("</table>");

   echo("\n</div>\n");


?>
