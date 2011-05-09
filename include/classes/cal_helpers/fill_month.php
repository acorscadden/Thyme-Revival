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
// $Id: fill_month.php,v 1.15 2007/05/12 12:27:55 ian Exp $
//


   $ecount_limit = intval(@constant("_CAL_MONTH_EVENT_LIMIT_"));
   
   if(@constant("_CAL_MONTH_MORE_EVENTS_TEXT_")) {
      $more_events_text = @constant("_CAL_MONTH_MORE_EVENTS_TEXT_");
   } else {
      $more_events_text = "More Events &gt;&gt;";
   }

   if(!function_exists('_ex_sort_custom_start')) {

      function _ex_sort_custom_start($a,$b) {

         if($a['start'] == $b['start']) return 0;
         return ($a['start'] < $b['start']) ? -1 : 1;
      }
   
   }

   global $_cal_weekdays, $_cal_user, $_cal_month_days;

   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");

   # event event_matrix stuff
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_minimal.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");
   require_once(_CAL_BASE_PATH_."include/images.php");

   # if we have a matrix, it was set
   # by the year view in cal_helpers/display_year
   if($this->em) {
      $em = &$this->em;
      $gday = &$this->gday;
      $gday = intval($gday);
   } else if($this->show_events) {
      $em = new _cal_event_matrix(_ex_mktime(0,0,0,$this->mon,1,$this->year), ($this->is_mini_cal ? "minimonth" : "month"),
        $this->event_types, $this->calendar, $this->filter);

      $this->invalids = $em->invalids;
      $gday = 0;
   }



   if($this->show_events) {
      $event_matrix = &$em->matrix;
   } else {
      $event_matrix = array();
   }

   # CHECK FOR MINICAL TARGET FRAME
   #################################
   if($this->is_mini_cal && $this->minical_target)
      $target = ' target=' . $this->minical_target;

   # check event size config
   #########################
   if($_cal_user->options->e_size == 1) {


      $fsize = -2;
      $isize = 10;
      $padding = 2;
      $dsize = 15;

   } else if ($_cal_user->options->e_size == 2) {

      $fsize = -4;
      $isize = 8;
      $padding = 1;
      $dsize = 14;

   } else {

      $isize = 14;
      $padding = 4;
      $dsize = 16;
   }


   ###########################
   # get week 1 with values ..
   ###########################

    $wdayone = _ex_date("w",
            _ex_mktime(0,0,0,$this->mon,1,$this->year)) -
        $_cal_user->options->week_start;

   if($wdayone < 0) {
      $wdayone = (7 + $wdayone);
   }

   $lastday = $_cal_month_days[$this->mon] + ($this->mon == 2 && _ex_is_leap_year($this->year));

   # construct url for view..
   ###########################
   $url = new _cal_url();

   # adding url
   ############################
   $addurl = new _cal_url();

   if(!($this->is_mini_cal && $this->selweek))
      $url->addArg($this->listeners['view'], "d");


   ####################
   # FILL THE MONTH..
   ####################

   # we need to keep track of this
   # if we're doing a full year
   $class = "";

   for($currday = -($wdayone-1); $currday <= $lastday; $i++) {

       # get this date's values..
       $time = _ex_mktime(0,0,0,$this->mon, $currday, $this->year);
       list($yr,$mo,$da) = explode("-",_ex_date("Y-n-j", $time));

       $url->addArg($this->listeners['year'], $yr);
       $url->addArg($this->listeners['month'], $mo);
       $url->addArg($this->listeners['day'], $da);

       if($this->is_mini_cal)
          echo("<tr valign='middle'");
       else
          echo("<tr valign='top'");

        if($time >= $this->selweek && $time <= $this->selweek + (86400*6) && $this->selweek !== false)
            echo(" class='"._CAL_CSS_CAL_SELECTED_."' ");

        echo(">");

      # show week links..
      ####################
      if($this->show_weeks) {
         $week = _ex_date("W", $time);

         echo("<td height='". ($this->row_height === null ? 90 : $this->row_height)
        ."' class='"._CAL_CSS_ROW_HEADER_."'
        valign='middle' align='center'>\n");

         if($this->printing || $this->static) {

            echo(_WEEK_ABBR_ ."<br>". $week);
         } else {

            $url->addArg($this->listeners['view'], "w");
            echo("<a class='"._CAL_CSS_ROW_HEADER_."' href=\"". $url->toString()
               ."\">". _WEEK_ABBR_ ."<br>". $week ."</a>");
            $url->addArg($this->listeners['view'], "d");
         }


         echo("</td>\n");
      }


      # for each week (7 days),
      # do a row of day values..
      ##############################
      for($a = 0; $a < 7; $a++, $currday++) {


          # get this date's values..
          if($a > 0) {
             $time = _ex_mktime(0,0,0,$this->mon, $currday, $this->year);
             list($yr,$mo,$da) = explode("-",_ex_date("Y-n-j", $time));

             $url->addArg($this->listeners['year'], $yr);
             $url->addArg($this->listeners['month'], $mo);
             $url->addArg($this->listeners['day'], $da);
          }

         $xtra_style = '';

         # class will determine the color
         ################################
         if($time >= $this->selweek && $time <= $this->selweek + (86400*6) && $this->selweek !== false) {
            $class = _CAL_CSS_CAL_SELECTED_;
         } elseif($this->selday == "$yr-$mo-$da" && $this->hil_day) {
            $class = _CAL_CSS_CAL_SELECTED_;
         } else if($this->mon != $mo) {
            $class = _CAL_CSS_CAL_DISABLED_;
            $xtra_style = " filter:alpha(opacity={$this->op}); -moz-opacity:0.{$this->op};";
         } else {
            $class = _CAL_CSS_CAL_CONTENT_;
         }


         echo("<td
                  align='".($this->is_mini_cal ? "center" : "left ") ."' ".
                  "class='". ($this->is_mini_cal && $this->exclude_outside && $class == _CAL_CSS_CAL_DISABLED_ ?
                        _CAL_CSS_CAL_CONTENT_ : $class) ."'
                  height='".
                  ($this->is_mini_cal && $this->row_height === null ? "0" : ($this->row_height === null ? "90" : $this->row_height)). "'>\n");

         # Start day content
         ############################
         if(!$this->is_mini_cal)
         {
            echo("<table border=0 width='100%' class='". $class ."'
                style='border-collapse: collapse; border: 0px; border-spacing: 0px'
                >\n<tr valign='top'>\n");


            if(!($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {

              echo("<td align=left class='". $class ."' style='$xtra_style'>\n");


              if($this->static) {
                 echo($da);

              } else if(!($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {

                  if(@constant("_CAL_MONTH_LIMIT_LINK_VIEW_") == 'w') $vl = 'w';
                  else $vl = 'd';

                  $url->addArg($this->listeners['view'], $vl);

                  echo("<a class='". $class ."'
                      href=\"". $url->toString() ."\">". $da . "</a>");

                  $day_view_link = $url->toString();
              }

              echo("</td>\n");
           }


           if($this->editable && !($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {

               echo("<td align=right class='". $class ."' style='$xtra_style'>\n");

               if($this->event_add_url) {

                  $aurl = $this->event_add_url;

                  str_replace(array('%d','%m','%y'),array($da,$mo,$yr), $aurl);

               } else {

                  $addurl->args = $url->args;

                  $addurl->addArg($this->listeners['view'], "m");
                  $addurl->addArg("event_action", _ADD_);

                  $aurl = $addurl->toString();

               }

               echo("[");
               echo("<a class='". $class ."' href=\"". $aurl ."\">".
                  '+' ."</a>]");

               echo("</td>\n");

            }

            echo("</tr>\n</table>");

         } else {

            # show bold if we're doing a
            # small cal and have events .. also ..
            # no link if the selected day is today
            ############################
           if($event_matrix[$gday][0] && $this->is_mini_cal && !($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {

               if($this->printing || $this->static && !($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {
                  echo("<font class='". $class ."'><b>". $da ."</b></font>");

               } else if(!($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {


                  # do we have a custom link?

                  if($this->minical_date_url) {

                     $vurl = $this->minical_date_url;

                     $vurl = str_replace(array('%d','%m','%y'),array($da,$mo,$yr), $vurl);

                     echo("<a class='"._CAL_CSS_MINICALEVENT_."' {$target} href=\"". $vurl ."\"><b>".
                        $da .  "</b></a>");

                  } else {
                     echo("<a class='"._CAL_CSS_MINICALEVENT_."' {$target} href=\"". $url->toString() ."\"><b>".
                        $da .  "</b></a>");
                  }

               }


            # we're doing a mini calendar
            # and have no event for today
            ###############################
            } else if(!($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {

               if($this->printing || $this->static ) {
                  echo("<font class='". $class ."'>". $da ."</font>");
               } else {

                  if($this->minical_date_url) {

                     $vurl = $this->minical_date_url;
                     $vurl = str_replace(array('%d','%m','%y'),array($da,$mo,$yr), $vurl);

                     echo("<a class='". $class ."' {$target} href=\"". $vurl ."\">". $da ."</a>");

                  } else {
                     echo("<a class='". $class ."' {$target} href=\"". $url->toString() ."\">".
                         $da . "</a>");
                  }
               }
            }
         }
         # EVENT MATRIX STUFF..
         ######################
         if($event_matrix[$gday] && !$this->is_mini_cal && !($class == _CAL_CSS_CAL_DISABLED_ && $this->exclude_outside)) {

            echo("<table width='100%' ".
                  ($this->printing ? " class='printing' " : "border=0") . " $js ".
                   " cellpadding=$padding cellspacing=0 style='vertical-align: top; $xtra_style'>");


            $today_count = count($event_matrix[$gday]);

            # MORE THAN 5 ?
            ##########################
            if($ecount_limit && !$this->printing && !$this->is_minical && $today_count > $ecount_limit) {

               if(@constant("_CAL_MONTH_EVENT_SHUFFLE_"))
                  shuffle($event_matrix[$gday]);

               $event_matrix[$gday] = array_slice($event_matrix[$gday],0,$ecount_limit);
               usort($event_matrix[$gday], "_ex_sort_custom_start");

            }

            foreach ($event_matrix[$gday] as $e) {

              $id = $e['id'];
              $inst = $e['instance'];

              $e = new _cal_event_minimal($e);
              $e->instance = $inst;

              if(is_array($this->notable_events))
                 $this->notable_events[$id] = 1;


              echo("<tr valign=top>
               <td class='". $e->css_class ." ". $e->type_css_class ."'");

                if($GLOBALS['_cal_user']->options->e_n_popup == 1 && !$this->printing) {
                   echo(" onMouseOver='show_notes(\"enotes_". $id ."\")' ");
                   echo(" onMouseOut='hide_notes(\"enotes_". $id ."\")' ");
                }

              echo(">");

              if($_cal_user->options->e_collapse && !$this->printing)
                   echo("<div
                    style='height: {$dsize}px; overflow: hidden; scrolling: no; scrollbar: no'
                    onMouseOver='uncollapse_event(this);'
                    onMouseOut='collapse_event(this)'>");

              #################
              #
              ### CUSTOM TIMES
              #
              ################
              if($e->allday != 1) {

                 echo(($fsize ? "<font style='padding: 0px; margin: 0px; vertical-align: top'
                        size=$fsize>" : ""));

                 if($e->allday == 2) {
                    echo(_CAL_CALL_FOR_TIMES_MIN_ );
                 } else {
                    echo(_ex_display_time_short($e->start));

                    if(@constant("_CAL_MONTH_SHOW_END_TIME_") && $e->start != $e->ends_at) {
                       echo(" - " . _ex_display_time_short($e->ends_at));
                    }

                 }
                 echo(($fsize ? "</font>" : "") . " ");
              }


              if($e->icon) {

                 echo(_ex_img_str(_CAL_BASE_URL_ . $e->icon, $e->title ,$isize,$isize) ." ");
              }

              foreach($e->type_icons as $te) {

                 echo(_ex_img_str(_CAL_BASE_URL_ . $te, $e->type_name,$isize,$isize) ." ");
              }


              if($this->printing || !$this->event_links) {
                 echo("<font style='vertical-align: top' ". ($fsize ? "size=$fsize" : "") ." class='".
                        $e->css_class ." ". $e->type_css_class. "'>". $e->title ."</font>");
              } else {

                 # event view url
                 #########################

                 $vurl = $this->event_view_url;

                 $vurl = str_replace('%eid', $id, $vurl);
                 $vurl = str_replace('%inst', _ex_date("Y-n-j", $e->instance), $vurl);

                 echo("<a class='". $e->css_class ." ". $e->type_css_class ."'
                          href='". $vurl . "'>" . ($fsize ? "<font style='vertical-align: top'
                        size=$fsize>" : "") .$e->title .
                        ($fsize ? "</font>" : "") . "</a>");

              }

              if($e->cal_title && @constant("_CAL_SHOW_CAL_NAMES_"))
                    $e->type_name = '<u>'.$e->cal_title .'</u>'.($e->type_name ? ": " . $e->type_name : "");

              if($_cal_user->options->e_typename && $e->type_name) {

                 echo(($fsize ? "<font style='padding: 0px; margin: 0px; vertical-align: top'
                        size=$fsize>" : "") . " [". $e->type_name ."]" .
                        ($fsize ? "</font>" : "") . " ");
               }



              if($_cal_user->options->e_collapse && !$this->printing) echo("</div>\n");

              echo("</td></tr>");


            }
            echo("</table>");
         }
         $gday++;
         # </ EVENT MATRIX STUFF >
         ########################

      if(!$this->printing && $ecount_limit && $today_count > $ecount_limit) {

         echo("<a href='{$day_view_link}'>".$more_events_text."</a>");

      }
      echo("</td>\n");

      }

      echo("</tr>\n");

   }

   # for year view
   if($class == _CAL_CSS_CAL_DISABLED_) $gday -= 7;

   echo("\n</table>\n");

   ############################
   #
   ### FOR COLLAPSING EVENTS
   #
   ###########################
   if(!$this->is_mini_cal && !$this->printing && $_cal_user->options->e_collapse) {
      require_once(_CAL_BASE_PATH_."include/js/collapse.js");
   }

?>
