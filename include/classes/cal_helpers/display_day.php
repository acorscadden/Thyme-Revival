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
// $Id: display_day.php,v 1.54 2008/12/06 17:31:17 ian Exp $
//

   global $_cal_user;

   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");

   echo("<div class='"._CAL_CSS_DAY_."'>\n");


   $url = new _cal_url();
   $url->addArg("event_action", _ADD_);

   # event event_matrix stuff
   #########################
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_minimal.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");
   require_once(_CAL_BASE_PATH_ ."include/images.php");


   list($mo,$da,$yr) = explode("-",_ex_date("n-j-Y", $this->time));

   if(!$this->em) {

      $em = new _cal_event_matrix($this->time, "day", $this->event_types, $this->calendar, $this->filter);
      $event_matrix = &$em->matrix[0];

   } else {

      $event_matrix = &$this->em;
   }
   
   $events = array();

   $max_end_h = $_cal_user->options->workday_end_hr;
   $min_start_h = $_cal_user->options->workday_start_hr;


   ######################
   # get event from id
   # and set end time
   ######################

   if(count($event_matrix) > 0) {

      for($i = 0; $i < count($event_matrix); $i++)
      {

         $events[$i] = new _cal_event_minimal($event_matrix[$i]);
 
         $events[$i]->instance = $event_matrix[$i]['instance'];

         if(is_array($this->notable_events))
            $this->notable_events[$event_matrix[$i]['id']] = 1;


         if(!$events[$i]->allday) {

            list($st_h,$st_m) = explode(":", _ex_date("H:i", $events[$i]->start));
            list($dr_h,$dr_m) = explode(":", $events[$i]->duration);

            $st_m -= ($st_m % 15);


            while($st_m % (60 / $_cal_user->options->time_interval) != 0 && ($st_m > 0)) {
               $st_m -= 15;
            }


           if(strlen($st_h) < 2) { $st_h = '0' . intval($st_h); }
           if(strlen($st_m) < 2) { $st_m = '0' . intval($st_m); }


            $events[$i]->starttime = $st_h .':'. $st_m;

            $events[$i]->start_h = $st_h;
            $events[$i]->start_m = $st_m;

            $min_start_h = min($st_h,$min_start_h);

            list($st_h,$st_m) = preg_split("/:/", _ex_date("H:i", $events[$i]->ends_at));
 
            if($st_h == 0) $st_h = 24;

            $st_m -= ($st_m % 15);

            while($st_m % (60 / $_cal_user->options->time_interval) != 0 && ($st_m > 0)) {
               $st_m -= 15;
            }

            if($st_m >= 60) {
               $st_h += floor($st_m/60);
               $st_m = $st_m % 60;
            }

            if(strlen($st_h) < 2) { $st_h = '0' . intval($st_h); }
            if(strlen($st_m) < 2) { $st_m = '0' . intval($st_m); }

            $events[$i]->end_h = $st_h;
            $events[$i]->end_m = $st_m;
            $events[$i]->endtime = $st_h.':'.$st_m;

            # rowspan duration
            $events[$i]->rowspan_dur = _ex_date("H:i",  _ex_mktime($events[$i]->end_h, $events[$i]->end_m, 0, 1, 1,1990) - _ex_mktime($events[$i]->start_h, $events[$i]->start_m, 0, 1, 1,1990));
 
            $max_end_h = max($st_h,$max_end_h);

         

         }

      }

      $_cal_user->options->workday_start_hr = min($min_start_h,$_cal_user->options->workday_start_hr);
      $_cal_user->options->workday_end_hr = max($max_end_h,$_cal_user->options->workday_end_hr);

   }

   if($_cal_user->options->workday_end_hr >=24) {
      $_cal_user->options->workday_end_hr = 23;
   }


   #############################
   # STEP THROUGH EACH EVENT...
   #############################

   if($events[0]->allday > 0) {

      # we know we have all day events if there's 
      # one at the begining. Those get printed first..
      ###############################################
      echo("<table width='100%' cellpadding=4>
        <tr><td class='"._CAL_CSS_CAL_CONTENT_."'>");

   }

   $day_matrix = array();
   $max_overlaps = 0;

   # print the all day events and create
   # a matrix for remaining events..
   #####################################
   for($y =0; $y < count($events); $y++) 
   {

      # ALL DAY EVENTS
      ################## 

      if($events[$y]->allday > 0) {

         $url->addArg("eid", $events[$y]->id);

         echo("<table class='". $events[$y]->css_class ." ". $event[$y]->type_css_class ." ". 
            ($this->printing ? "printing" : "") ."' ".
			($this->printing ? "border=0" : "") .
               " cellpadding=4 cellspacing=0 align=center width='75%'>\n");
         echo("<tr>
               <td class='". $events[$y]->css_class ." ". $events[$y]->type_css_class ."' ");


                 if($GLOBALS['_cal_user']->options->e_n_popup == 1) {
                    echo(" onMouseOver='show_notes(\"enotes_". $events[$y]->id ."\");' ");                   
                    echo(" onMouseOut='hide_notes(\"enotes_". $events[$y]->id ."\");' ");                    
                 }

         echo(">");

         if($events[$y]->icon) {

            echo(_ex_img_str(_CAL_BASE_URL_ . $events[$y]->icon, $events[$y]->title ,14,14)." ");
         }

         foreach($events[$y]->type_icons as $te) {
             echo(_ex_img_str(_CAL_BASE_URL_ . $te, $events[$y]->category ,14,14) ." ");
         }


         if($this->printing) {
            echo("<font class='". $events[$y]->css_class ." ". $events[$y]->type_css_class ."'>". $events[$y]->title ."</font>");

         } else if (!$this->event_links) {

            echo("<font class='". $events[$y]->css_class ." ". $events[$y]->type_css_class ."'>");
            echo($events[$y]->title);
            echo("</font> ");

         } else {

            # event view url?
            ###########################

            $vurl = $this->event_view_url;
            $vurl = str_replace('%eid', $events[$y]->id, $vurl);
            $vurl = str_replace('%inst', _ex_date("Y-n-j", $events[$y]->instance), $vurl);
            $vurl = str_replace('%title', $events[$y]->title, $vurl);

            echo("<a class='". $events[$y]->css_class ." ". $events[$y]->type_css_class .
			"' href='". $vurl ."'");
            echo(">". $events[$y]->title);
            echo("</a> ");


         }

        if($events[$y]->allday == 2) echo(" <font size=-2>". _CAL_CALL_FOR_TIMES_."</font>");

        if($events[$y]->cal_title && @constant("_CAL_SHOW_CAL_NAMES_"))
                    $events[$y]->type_name = '<u>'.$events[$y]->cal_title .'</u>'.($events[$y]->type_name ? ": " . $events[$y]->type_name : "");

        if($_cal_user->options->e_typename && $events[$y]->type_name)
               echo(" <font size=-2>[". $events[$y]->type_name ."]</font>");

         echo("</td></tr>\n");
         echo("</table>\n");


         $url->addArg("event_action", _ADD_);

     # REST OF THE EVENTS>.
     ################################ 

     } else {

        # close all day table..
        if($events[$y-1]->allday > 0) {
           echo("</td>\n</tr>\n</table>");
        }

        $url->addArg("eid", "");

        $row = 0;

        while(isset($day_matrix[$events[$y]->starttime][$row]) &&
                      $day_matrix[$events[$y]->starttime][$row] != "o") { 
           $row++;
        }


        $day_matrix[$events[$y]->starttime][$row] = $events[$y];

        $curtime = $events[$y]->starttime;
        list($h,$m) = explode(":",$curtime);
        $tmpdate = ($h * 3600) + ($m * 60);
        $first = 1;

        # fill up till the end of this event..
        ##########################################
        while($curtime != $events[$y]->endtime && ($curtime != '00:00' ||
                                         $first)) {
           $tmpdate += (15 * 60);
           $curtime = _ex_date("H:i", $tmpdate);
           if($curtime == '00:00' && !$first) continue;

           if($curtime != $events[$y]->endtime) {
              $day_matrix[$curtime][$row] = "x";
           } else {
              $day_matrix[$curtime][$row] = "o";
           }

           $first = 0;

        }


        # fill up the rest with "o"'s for "open"
        # counting ahead..
        #######################################
        while($curtime != '00:00') {
           $tmpdate += (15 * 60);
           $curtime = _ex_date("H:i", $tmpdate);

           if($curtime != '00:00') {
              $day_matrix[$curtime][$row] = "o";
           }

        }
   

        $curtime = $events[$y]->starttime;
        list($h,$m) = explode(":",$curtime);
        $tmpdate = ($h * 3600) + ($m * 60);


        # fill up the rest with "o"'s for "open"
        # counting back....
        #######################################
        while($curtime != '00:00') {
           $tmpdate -= (15 * 60);
           $curtime = _ex_date("H:i", $tmpdate);

           if($day_matrix[$curtime][$row] != "o" && isset($day_matrix[$curtime][$row])) { 
              continue;
           }
           $day_matrix[$curtime][$row] = "o";
        
        }


     } # </ check for allday event >

   } # </ foreach event >

   # if we only had all day events, we need to close the table..
   if($events[count($events)-1]->allday > 0) {
      echo("</td>\n</tr>\n</table>");
      $url->addArg("eid", "");
   }


   echo("<table width='100%'>\n<tr>\n<td>\n");

   echo("<table width='100%' ". ($this->printing ? "" : "") .
           " style='border-collapse: collapse;'>\n");

   echo("\n<tr class='"._CAL_CSS_SPACER_SMALL_."'><td class='"._CAL_CSS_SPACER_SMALL_."'></td></tr>\n");

   $url->addArg($this->listeners['month'], $this->mon);
   $url->addArg($this->listeners['day'], $this->mday);
   $url->addArg($this->listeners['year'], $this->year);

   for ($i = $_cal_user->options->workday_start_hr; $i <= $_cal_user->options->workday_end_hr; $i++) {

      $tmptime = ($i * 3600);

      $hr = $i;
 
      $url->addArg("h", $i);

      $i = (($i < 10) ? '0' : '') . intval($i);


      # step through each minute option..
      ##################################
      for($x = 0; $x < $_cal_user->options->time_interval; $x++) {

         echo("\n<tr>\t<td class='"._CAL_CSS_CAL_CONTENT_."' align='left' width='45' height=20>  ");

         if($x == 0) {

            if($this->editable) {

               if($this->event_add_url) {

                  
                  $aurl = $this->event_add_url;
                  $aurl = str_replace(array('%d','%m','%y','%h'),array($da,$mo,$yr,$hr),$aurl);

               } else {
                  $aurl = $url->toString();
               }


               echo("<a href=\"". $aurl ."\">". _ex_display_time_med($tmptime) ."</a>");


            } else {
               if($this->printing) {
                  echo("<font class='print_heading'>". _ex_display_time_med($tmptime) ."</font>");
               } else {
                  echo("<font class='"._CAL_CSS_CAL_CONTENT_."'>"._ex_display_time_med($tmptime) ."</font>");
               }
            }
         }

         echo("</td>\n");

        $min = $x * floor(60/$_cal_user->options->time_interval);

        if($min == 0) {
           $min = '00';
        }

        if(is_array($day_matrix[$i.':'.$min])) {

           foreach($day_matrix[$i.':'.$min] as $item) {

              # HAVE EVENT STARTING AT THIS TIME
              #########################################
              if(is_object($item)) {

                 $url->addArg("eid", $item->id);

                 list($d_h, $d_m) = explode(":", $item->rowspan_dur);

                 if($_cal_user->options->time_interval == 1)
                    $d_h = $item->end_h - $item->start_h;

                 $rowspan = ($d_h * $_cal_user->options->time_interval);

                 $rowspan += floor($d_m / (60 / $_cal_user->options->time_interval));
                 $rowspan *= 2; # to account for the spacer rows..

                 $rowspan--; # lte the spacer be the bottom row

                 echo("\t<td valign=top style='padding: 4' class='".

                    ($this->printing ? "printing" : $item->css_class." ".$item->type_css_class) 
                    ."' rowspan='". $rowspan ."' ");

                    if($GLOBALS['_cal_user']->options->e_n_popup == 1 && !$this->printing) {
                       echo(" onMouseOver='show_notes(\"enotes_". $item->id ."\");' ");
                       echo(" onMouseOut='hide_notes(\"enotes_". $item->id ."\");' ");
                    }


                 echo(">");

                 if($item->icon) {
                     echo(_ex_img_str(_CAL_BASE_URL_ . $item->icon, $item->title ,14,14) ." ");

                 }

                 foreach($item->type_icons as $te) {
                     echo(_ex_img_str(_CAL_BASE_URL_ . $te, $item->type_name,14,14) ." ");
                 }


                 if($this->printing || !$this->event_links) {
                    echo("<font class='". $item->css_class ." ". $item->type_css_class
			."'>". $item->title ."</font>");
                 } else {


                    # event view url
                    ##########################
 
                    $vurl = $this->event_view_url;
                    $vurl = str_replace('%eid', $item->id, $vurl);
                    $vurl = str_replace('%inst', _ex_date("Y-n-j", $item->instance), $vurl);
                    $vurl = str_replace('%title', $item->title, $vurl);

                    echo("<a class='". $item->css_class ." ". $item->type_css_class .
			"' href='". $vurl ."'");

                    echo(">".  $item->title ."</a>");


                 }

                 list($e_h,$e_m) = explode(":",$item->endtime);
                 if($e_h >=24) {
                    $e_h = ($e_h % 24);
                    $item->endtime = $e_h.':'.$e_m;
                 }
                 echo(" <font size=-2>");
        
                if($item->cal_title && @constant("_CAL_SHOW_CAL_NAMES_"))
                    $item->type_name = '<u>'.$item->cal_title .'</u>'.($item->type_name ? ": " . $item->type_name : "");

 
                 if($_cal_user->options->e_typename && $item->type_name)
                   echo("[". $item->type_name ."] ");
 
                    echo(_ex_display_time_long($item->start));

                    if($item->ends_at != $item->start) {
                       echo(" - ");
                       echo(_ex_display_time_long($item->ends_at));
                    } else if(@constant("_CAL_NO_ENDTIME_TEXT_")) {
                       echo(" ". _CAL_NO_ENDTIME_TEXT_);
                    }

                 echo("</font>");
                 echo("</td>\n");
                
                 $url->addArg("eid", "");


              # is not an event...
              ####################
              } else if($item == "o") {
                 echo("\t<td class='"._CAL_CSS_CAL_CONTENT_."'></td>");
              }
 
           }

        # no event ...
        }  else {
        }

        echo("\n</tr>");
        echo("\n<tr class='"._CAL_CSS_SPACER_SMALL_."'><td class='"._CAL_CSS_SPACER_SMALL_."'></td></tr>\n");
     }

   }
   
   echo("</table>\n");

   echo("</td>\n</tr>\n</table>\n");

   echo("</div>\n");


?>

