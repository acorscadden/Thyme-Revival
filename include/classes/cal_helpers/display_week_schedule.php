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
// $Id: display_week_schedule.php,v 1.9 2008/12/04 18:55:43 ian Exp $
//

   global $_cal_user, $_cal_weekdays_abbr;

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

      $em = new _cal_event_matrix($this->time, "week", $this->event_types, $this->calendar, $this->filter);
      $em = $em->matrix;

   } else {

      $em = &$this->em;
   }
   
   $events = array();

   $max_end_h = $_cal_user->options->workday_end_hr;
   $min_start_h = $_cal_user->options->workday_start_hr;


   ######################
   # get event from id
   # and set end time
   ######################

   for($a = 0; $a < 7; $a++) {

      $event_matrix = $em[$a];

      for($i = 0; $i < count($event_matrix); $i++)
      {

         $events[$a][$i] = new _cal_event_minimal($event_matrix[$i]);
 
         $events[$a][$i]->instance = $event_matrix[$i]['instance'];

         if(is_array($this->notable_events))
            $this->notable_events[$event_matrix[$i]['id']] = 1;


         if(!$events[$a][$i]->allday) {

            list($st_h,$st_m) = explode(":", _ex_date("H:i", $events[$a][$i]->start));
            list($dr_h,$dr_m) = explode(":", $events[$a][$i]->duration);

            $st_m -= ($st_m % 15);

            while($st_m % (60 / $_cal_user->options->time_interval) != 0 && ($st_m > 0)) {
               $st_m -= 15;
            }

           if(strlen($st_h) < 2) { $st_h = '0' . intval($st_h); }
           if(strlen($st_m) < 2) { $st_m = '0' . intval($st_m); }


            $events[$a][$i]->starttime = $st_h .':'. $st_m;

            $events[$a][$i]->start_h = $st_h;
            $events[$a][$i]->start_m = $st_m;

            $min_start_h = min($st_h,$min_start_h);

            list($st_h,$st_m) = preg_split("/:/", _ex_date("H:i", $events[$a][$i]->ends_at));

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

            $events[$a][$i]->end_h = $st_h;
            $events[$a][$i]->end_m = $st_m;
            $events[$a][$i]->endtime = $st_h.':'.$st_m;

            # rowspan duration
            $events[$a][$i]->rowspan_dur = _ex_date("H:i",  _ex_mktime($events[$a][$i]->end_h, $events[$a][$i]->end_m, 0, 1, 1,1990) - _ex_mktime($events[$a][$i]->start_h, $events[$a][$i]->start_m, 0, 1, 1,1990));

            $max_end_h = max($st_h,$max_end_h);

         }

      }

      $_cal_user->options->workday_start_hr = min($min_start_h,$_cal_user->options->workday_start_hr);
      $_cal_user->options->workday_end_hr = max($max_end_h,$_cal_user->options->workday_end_hr);

   }

   if($_cal_user->options->workday_end_hr >=24) {
      $_cal_user->options->workday_end_hr = 23;
   }



   $week_matrix = array();
   $max_overlaps = 0;


#############################
#
### FOR EACH DAY
#
#############################
for($i = 0; $i < 7; $i++) {

   $week_matrix[$i]['col_count'] = 1;

    $week_matrix[$i]['alldays'] = '';

   # print the all day events and create
   # a matrix for remaining events..
   #####################################
   for($y =0; $y < count($events[$i]); $y++) 
   {

      # ALL DAY EVENTS
      ################## 

      if($events[$i][$y]->allday > 0) {

         ob_start();
         $url->addArg("eid", $events[$i][$y]->id);

         echo("<table class='". $events[$i][$y]->css_class ." ". $event[$y]->type_css_class ." ". 
            ($this->printing ? "printing" : "") ."' ".
			($this->printing ? "border=0" : "") .
               " cellpadding=4 cellspacing=0 align=center width='75%'>\n");
         echo("<tr>
               <td class='". $events[$i][$y]->css_class ." ". $events[$i][$y]->type_css_class ."' ");


                 if($GLOBALS['_cal_user']->options->e_n_popup == 1) {
                    echo(" onMouseOver='show_notes(\"enotes_". $events[$i][$y]->id ."\");' ");                   
                    echo(" onMouseOut='hide_notes(\"enotes_". $events[$i][$y]->id ."\");' ");                    
                 }

         echo(">");

         if($events[$i][$y]->icon) {

            echo(_ex_img_str(_CAL_BASE_URL_ . $events[$i][$y]->icon, $events[$i][$y]->title ,14,14)." ");
         }

         foreach($events[$i][$y]->type_icons as $te) {
             echo(_ex_img_str(_CAL_BASE_URL_ . $te, $events[$i][$y]->category ,14,14) ." ");
         }


         if($this->printing) {
            echo("<font class='". $events[$i][$y]->css_class ." ". $events[$i][$y]->type_css_class ."'>". $events[$i][$y]->title ."</font>");

         } else if (!$this->event_links) {

            echo("<font class='". $events[$i][$y]->css_class ." ". $events[$i][$y]->type_css_class ."'>");
            echo($events[$i][$y]->title);
            echo("</font> ");

         } else {

            # event view url?
            ###########################

            $vurl = $this->event_view_url;
            $vurl = str_replace('%eid', $events[$i][$y]->id, $vurl);
            $vurl = str_replace('%inst', _ex_date("Y-n-j", $events[$i][$y]->instance), $vurl);

            echo("<a class='". $events[$i][$y]->css_class ." ". $events[$i][$y]->type_css_class .
			"' href='". $vurl ."'");
            echo(">". $events[$i][$y]->title);
            echo("</a> ");


         }

        if($events[$i][$y]->allday == 2) echo(" <font size=-2>". _CAL_CALL_FOR_TIMES_."</font>");

        if($events[$i][$y]->cal_title && @constant("_CAL_SHOW_CAL_NAMES_"))
                    $events[$i][$y]->type_name = '<u>'.$events[$i][$y]->cal_title .'</u>'.($events[$i][$y]->type_name ? ": " . $events[$i][$y]->type_name : "");

        if($_cal_user->options->e_typename && $events[$i][$y]->type_name)
               echo(" <font size=-2>[". $events[$i][$y]->type_name ."]</font>");

         echo("</td></tr>\n");
         echo("</table>\n");


         $url->addArg("event_action", _ADD_);

         $week_matrix[$i]['alldays'] .= ob_get_contents();
         ob_end_clean();

     # REST OF THE EVENTS>.
     ################################ 

     } else {

        $url->addArg("eid", "");

        $row = 0;

        while(isset($week_matrix[$i][$events[$i][$y]->starttime][$row]) &&
                      $week_matrix[$i][$events[$i][$y]->starttime][$row] != "o") { 

           $row++;
        }

        $week_matrix[$i]['col_count'] = max($week_matrix[$i]['col_count'], ($row > 0 ? ($row + 1) : 0));

        $week_matrix[$i][$events[$i][$y]->starttime][$row] = $events[$i][$y];

        $curtime = $events[$i][$y]->starttime;
        list($h,$m) = explode(":",$curtime);
        $tmpdate = ($h * 3600) + ($m * 60);
        $first = 1;



        # fill up till the end of this event..
        ##########################################
        while($curtime != $events[$i][$y]->endtime && ($curtime != '00:00' ||
                                         $first)) {
           $tmpdate += (15 * 60);
           $curtime = _ex_date("H:i", $tmpdate);

            if($curtime == '00:00' && !$first) continue;

           if($curtime != $events[$i][$y]->endtime) {
              $week_matrix[$i][$curtime][$row] = "x";
           } else {
              $week_matrix[$i][$curtime][$row] = "o";
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
              $week_matrix[$i][$curtime][$row] = "o";
           }

        }
   

        $curtime = $events[$i][$y]->starttime;
        list($h,$m) = explode(":",$curtime);
        $tmpdate = ($h * 3600) + ($m * 60);

        # fill up the rest with "o"'s for "open"
        # counting back....
        #######################################
        while($curtime != '00:00') {
           $tmpdate -= (15 * 60);
           $curtime = _ex_date("H:i", $tmpdate);

           if($week_matrix[$i][$curtime][$row] != "o" && isset($week_matrix[$i][$curtime][$row])) { 
              continue;
           }
           $week_matrix[$i][$curtime][$row] = "o";
        
        }


     } # </ check for allday event >

   } # </ foreach event >


} # </ for each day>



   echo("<table width='100%'>\n<tr>\n<td>\n");

   echo("<table width='100%' ". ($this->printing ? "" : "") .
           " style='border-collapse: collapse;'>\n");


################################
#
### DAY HEADER
#
################################
echo("<tr>\n<td> </td>");
list($yr,$mo,$da,$dbase) = preg_split("/-/", _ex_date("Y-n-j-w", $this->w_starttime));

$url->addArg($this->listeners['month'], $mo);
$url->addArg($this->listeners['day'], $da);
$url->addArg($this->listeners['year'], $yr);

$vurl = new _cal_url();
$vurl->addArg($this->listeners['month'], $mo);
$vurl->addArg($this->listeners['day'], $da);
$vurl->addArg($this->listeners['year'], $yr);
$vurl->addArg($this->listeners['view'], 'd');

for($i = 0; $i < 7; $i++) {

   $dtime = _ex_mktime(0,0,0,$mo, ($da + $i), $yr);

   $vurl->addArg($this->listeners['day'], ($da + $i));
   
   echo("<td class='"._CAL_CSS_SPACER_TINY_."' style='width: 2px'> </td>");
   echo("<th colspan='". $week_matrix[$i]['col_count'] ."' class='"._CAL_CSS_ROW_HEADER_."'>");
   echo("<a href='".
    $vurl->toString() ."'>".$_cal_weekdays_abbr[($dbase++) % 7]." ".
    _ex_date(_DATE_INT_NOYR_, $dtime)."</a>");
   echo("</th>");

}
echo("</tr>");


################################
#
### ALL DAY EVENTS
#
##################################
echo("<tr>\n<td> </td>");
for($i = 0; $i < 7; $i++) {

   echo("<td class='"._CAL_CSS_SPACER_TINY_."' style='width: 2px'> </td>");
   echo("<td colspan='". $week_matrix[$i]['col_count'] ."' class='"._CAL_CSS_ROW_HEADER_."'>");
   echo($week_matrix[$i]['alldays']);
   echo("</td>");

}
echo("</tr>");



echo("\n<tr class='"._CAL_CSS_SPACER_SMALL_."'><td class='"._CAL_CSS_SPACER_SMALL_."'></td></tr>\n");



################################
#
### BEGIN FOR EACH HOUR
#
################################

   for ($i = $_cal_user->options->workday_start_hr; $i <= $_cal_user->options->workday_end_hr; $i++) {

      $tmptime = ($i * 3600);

      $hr = $i;
 
      $url->addArg("h", $i);

      $i = (($i < 10) ? '0' : '') . intval($i);


      ###################################
      #
      ### ROW HEADER
      #
      ##################################
      for($x = 0; $x < $_cal_user->options->time_interval; $x++) {

         echo("\n<tr>\t<td class='"._CAL_CSS_CAL_CONTENT_."' align='left' width='45' height=30>  ");

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
       ########################################


        $min = $x * floor(60/$_cal_user->options->time_interval);

        if($min == 0) {
           $min = '00';
        }


     #################################
     #
     ### FOR EACH DAY THIS WEEK
     #
     ####################################
     for($y = 0; $y < 7; $y++) {
     
        echo("<td class='"._CAL_CSS_SPACER_TINY_."' style='width: 2px'> </td>");
 
        $day_matrix = &$week_matrix[$y];
 
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
                    echo("<font class='". $item->css_class ." ". $item->type_css_class ."'>".
                        $item->title ."</font>");
                 } else {


                    # event view url
                    ##########################
 
                    $vurl = $this->event_view_url;
                    $vurl = str_replace('%eid', $item->id, $vurl);
                    $vurl = str_replace('%inst', _ex_date("Y-n-j", $item->instance), $vurl);

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
        
                if($item->cal_title && @constant("_CAL_SHOW_CAL_NAMES_")) {

                    $item->type_name = '<u>'.$item->cal_title .'</u>'.
                    ($item->type_name ? ": " . $item->type_name : "");

                }

 
                 if($_cal_user->options->e_typename && $item->type_name)
                   echo("[". $item->type_name ."] ");
 
                    echo(_ex_display_time_med($item->start));
                    echo(" - ");
                    echo(_ex_display_time_med($item->ends_at));

                 echo("</font>");
                 echo("</td>\n");
                
                 $url->addArg("eid", "");


              # is not an event...
              ####################
              } else if($item == "o") {
                 echo("\t<td class='"._CAL_CSS_CAL_CONTENT_."'> </td>");
              }

           # END FOR EACH ITEM THIS HOUR
           ##############################
           }

        # no event ...
        # NO ITEMS THIS HOUR
        ####################
        }  else {

           echo("<td class='"._CAL_CSS_CAL_CONTENT_."' width=12%> </td>");
        }

     ########################
     #
     ### END FOR EACH DAY
     #
     #######################
     }

     # END ROW, PRINT SPACER
     ###########################3
     echo("\n</tr>");
     echo("\n<tr class='"._CAL_CSS_SPACER_SMALL_."'><td class='"._CAL_CSS_SPACER_SMALL_."'></td></tr>\n");

   }


################################
#
### END FOR EACH HOUR
#
################################
}

   
   echo("</table>\n");

   echo("</td>\n</tr>\n</table>\n");

   echo("</div>\n");


?>
