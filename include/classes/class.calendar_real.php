<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 eXtrovert Software and Thymenews                  |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@thymenews.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: class.calendar_real.php,v 1.125 2008/07/24 19:30:23 ian Exp $
//

if(!@constant("_DEBUG_"))
   error_reporting(E_ALL ^ (E_NOTICE));

   require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");

class _cal_calendar_real {

var $time;

var $mday;        # day of the month 1 to 31
var $wday;        # day of the week 0 (for Sunday) through 6 (for Saturday)
var $mon;         # Numeric representation of a month 1 through 12
var $year;        # year, 4 digits Examples: 1999 or 2003

var $selday;
var $selweek = false;

var $txt_next;
var $txt_prev;
var $img_next;
var $img_prev;

var $printable = false;
var $editable = false;
var $static = false;

var $printing = false;

var $header = null;

var $base_str;
var $base_int;
var $base_increment = 1; # how much to increment next/prev

var $show_weeks = true;

var $is_mini_cal = false;

var $em = null;
var $gday = null;

var $row_height = null;

var $show_header = true;
var $show_header_links = true;

var $show_footer = 0;

var $header_align = null;

var $hil_day = true;
var $hil_week = false;

var $exclude_outside = false;

var $show_events = true;
var $event_links = true;

var $event_types = 0;
var $abbr_weekdays;

var $event_view_url = null;
var $minical_date_url = null;

var $set_curtime = false;

var $calendar;

var $divid = 'cal';

var $e_css = true;

var $minical_target;

var $width = null;

var $listeners = array(
            'day' => 'd',
            'month' => 'm',
            'year' => 'y',
            'cal' => 'cal',
            'cat' => 'cat',
            'view' => 'v'
        );

##################################
#
# constructor function
#
##################################
#
# optional date params default to 
# current date...
#
##################################
function _cal_calendar_real ($yr = null, $mo = null, $da = null)
{

    global $_cal_user, $_cal_months, $_cal_weekdays, $_cal_html, $_cur_cal;

    $set_curtime = ($yr === null && $mo === null && $da === null);

    require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
    require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
    require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");


    if(defined("_CAL_OUTOFMONTH_OPACITY_")) $this->op = _CAL_OUTOFMONTH_OPACITY_;
    else $this->op = 40;


    $_cal_html or $_cal_html = new _cal_html();

    if(!@constant("_CAL_USE_SESSION_")) {

       # try request first...

       $this->set_curtime = $set_curtime && !($_REQUEST[$this->listeners['day']] ||
            $_REQUEST[$this->listeners['month']] || $_REQUEST[$this->listeners['year']]);

       isset($yr) or $yr = $_REQUEST[$this->listeners['year']];
       isset($mo) or $mo = $_REQUEST[$this->listeners['month']];
       isset($da) or $da = $_REQUEST[$this->listeners['day']];

       isset($yr) or $yr = _ex_date("Y",_ex_localtime());
       isset($mo) or $mo = _ex_date("n",_ex_localtime());
       isset($da) or $da = 1; // _ex_date("j",_ex_localtime());

    } else {

       $this->calendar = $_cur_cal->id;

       $this->editable = ($_cal_user->access->can_add($_cur_cal) ||
            (($_cur_cal->type != 1 && $_cur_cal->type != 2) && ($_cur_cal->options & 2 && !($_cur_cal->options & 128))));

       $this->hil_day = true;

       if(!$this->editable) $this->editable = $_cur_cal->show_add;


       $yr or $yr = $_SESSION["y"];
       $mo or $mo = $_SESSION["m"];
       $da or $da = $_SESSION["d"];

       $this->display_invalids = (!$_cal_user->guest);;
    }


    $this->selday = _ex_date("Y-n-j", _ex_localtime());

    $this->show_weeks = $_cal_user->options->show_weeks;


    #######################
    #
    ### SET UP DATE VARS
    #
    #######################

    $this->time = _ex_mktime(0, 0, 0, $mo, $da, $yr);

    $this->fill_date_vars();

    $this->week_start = $_cal_user->options->week_start;

    $this->multibyte = function_exists('mb_substr');

}



#####################
#
#####################

function display_day()
{

   global $_cal_weekdays, $_cal_months;

   $this->set_event_view_url();

   $this->is_mini_cal = false;

   if($this->width) {
      echo("<table border='0' cellpadding='0' cellspacing='0' style='padding: 0px' width='".
	$this->width ."'><tr><td>");
   }


   $this->selday = $this->year.'-'.$this->mon.'-'.$this->mday;

   if($this->header == null) {

      $this->header = $_cal_weekdays[$this->wday] . " ";

      if(@constant("_CAL_EURO_DATE_")) {
         $this->header .= $this->mday ." ";
         $this->header .= $_cal_months[$this->mon] . " ";
         $this->header .= $this->year;
      } else {
         $this->header .= $_cal_months[$this->mon] . " ";
         $this->header .= $this->mday .", ". $this->year;
      }

      if(function_exists('_ex_lang_date_header_full_date')) {
        $this->header = _ex_lang_date_header_full_date($this->wday,$this->mday,$this->mon,$this->year);
      }
      $this->header_rset = 1;
   }

   $this->base_int = $this->mday;
   $this->base_str = $this->listeners['day'];

   require(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");

   $this->wk_number = 1;
   $this->print_header();
   $This->wk_number = 0;

   if($GLOBALS['_cal_user']->options->e_n_popup == 1)
      $this->notable_events = array();

   # main include for this...
   ###########################
   require(@constant("_CAL_BASE_PATH_") . "include/classes/cal_helpers/display_day.php");

   $this->print_footing();

   if($this->width)
      echo("</td></tr></table>");



} # </ display_day() >




######################
#
#####################

function display_week()
{

   global $_cal_months, $_cal_weekdays, $_cal_user;

   $this->set_event_view_url();

   $this->is_mini_cal = false;

   $wday = _ex_date("w", $this->time);

   if($wday >= $_cal_user->options->week_start) {
      $offset = -$wday + $_cal_user->options->week_start;
   } else {
      $offset = ($_cal_user->options->week_start - $wday) - 7;
   }

   $tmptime = _ex_mktime(0,0,0,$this->mon,($this->mday+$offset), $this->year);

   list($mo,$da,$yr) = explode("-", _ex_date("n-j-Y", $tmptime));


   if($this->header == null) {

      $endweek = $tmptime + (86400 * 6);

      #########
      if(@constant("_CAL_EURO_DATE_")) {

         # STARTS WITH DAY
         $this->header = $da;
        
         # IN THE SAME MONTH
         ###################### 
         if($mo == _ex_date("n", $endweek)) {

            $this->header .= " - ". _ex_date("j", $endweek);
            $this->header .= " " . $_cal_months[_ex_date("n", $tmptime)];
            $this->header .= " ". $yr;

            if(function_exists('_ex_lang_date_header_same_month')) {

                $this->header = _ex_lang_date_header_same_month($da,
                     _ex_date("j", $endweek), _ex_date("n", $tmptime), $yr);

            }

         # DIFFERENT MONTH
         #################### 
         } else {

            $this->header .= " ". $_cal_months[_ex_date("n", $tmptime)];

            # SAME YEAR
            ###############
            if($yr == _ex_date("Y",$endweek))
            {

               $this->header .= " - " . _ex_date("j", $endweek);
               $this->header .= " ". $_cal_months[_ex_date("n", $endweek)];
               $this->header .= " ". $yr;

                if(function_exists('_ex_lang_date_header_same_year')) {

                    $this->header = _ex_lang_date_header_same_year($da,
                        _ex_date("j", $endweek), _ex_date("n", $tmptime),
                        _ex_date("n", $endweek),$yr);

                }


            # DIFFERENT YEAR
            ##################
            } else {

               $this->header .= " ". _ex_date("Y", $tmptime);
               $this->header .= " - " . _ex_date("j", $endweek);
               $this->header .= " ". $_cal_months[_ex_date("n", $endweek)];
               $this->header .= " ". _ex_date("Y", $endweek);

                if(function_exists('_ex_lang_date_header_next_year')) {
                    $this->header = _ex_lang_date_header_next_year($da,
                        _ex_date("j", $endweek), _ex_date("n", $tmptime),
                        _ex_date("n", $endweek),$yr);
                }


            }

         }

      } else {

         $this->header = $_cal_months[$mo] . " ";
         $this->header .= $da;

         if($yr != _ex_date("Y", $tmptime + (86400*6))) {
            $this->header .= ", ". $yr;
         }

         $this->header .= " - ";

         if($mo != _ex_date("n", $tmptime + (86400*6))) {
            $this->header .= $_cal_months[_ex_date("n", $tmptime + (86400*6))];
         }
         $this->header .= _ex_date(" j, Y", $tmptime + (86400 * 6));

      } 

      $this->header_rset = 1;
 
   }

   $this->base_str = $this->listeners['day'];
   $this->base_int = $this->mday; #$da;
   $this->base_increment = 7;


   require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");

   if($this->width) {
      echo("<table border='0' cellpadding='0' cellspacing='0' style='padding: 0px' width='".
        $this->width ."'><tr><td>");
   }

   $this->wk_number = 1;
   $this->print_header();
   $this->wk_number = 0;

   if($GLOBALS['_cal_user']->options->e_n_popup == 1)
      $this->notable_events = array();

   # main include for this..
   require(@constant("_CAL_BASE_PATH_") . "include/classes/cal_helpers/display_week.php");

   $this->print_footing();

   if($this->width)
      echo("</td></tr></table>");


} # </ display_week >



###########################
#
###########################

function display_month()
{  

   $this->set_event_view_url();

   $this->is_mini_cal = false;

   if($this->hil_day && !$this->selday) {
      $this->selday = _ex_date("Y-n-j", $this->time);
   }

   if($this->hil_week) {
      $this->selweek = $this->w_starttime;
   }

   if($this->header == null) {
      $this->header = $this->month." ".$this->year;
      if(function_exists('_ex_lang_date_header_month')) {
         $this->header = _ex_lang_date_header_month($this->mon,$this->year);
      }
      $this->header_rset = 1;
   }

   $this->base_str = $this->listeners['month'];
   $this->base_int = $this->mon;

   require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");
  
   if($this->width) {
      echo("<table border='0' cellpadding='0' cellspacing='0' style='padding: 0px' width='".
        $this->width ."'><tr><td>");
   }
 
   $this->print_header();

   if($GLOBALS['_cal_user']->options->e_n_popup == 1)
      $this->notable_events = array();
 
   require(@constant("_CAL_BASE_PATH_") . "include/classes/cal_helpers/display_month.php");
   
   $this->print_footing();

   if($this->width)
      echo("</td></tr></table>");

}




#########################
#
#########################
function display_year()
{

   $this->is_mini_cal = false;
 
   $this->header = $this->year;
   $this->base_str = $this->listeners['year'];
   $this->base_int = $this->year;

   require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");

   if($this->width) {
      echo("<table border='0' cellpadding='0' cellspacing='0' style='padding: 0px' width='".
        $this->width ."'><tr><td>");
   }

   $this->print_header();

   require(@constant("_CAL_BASE_PATH_") . "include/classes/cal_helpers/display_year.php");

   $this->print_footing();

   if($this->width)
      echo("</td></tr></table>");
}




#######################
#
########################

function display_years_mini()
{

   $this->is_mini_cal = true;

   echo("<div class=\""._CAL_CSS_YEARS_MINI_."\">\n");

   echo("<table align=center width='100%' border=0
	style='border-collapse: collapse'>\n");

   echo("<tr valign=middle>
	<td colspan=3 class='"._CAL_CSS_HEADING_."'>");

   $this->header = $this->year;
   $this->base_str = $this->listeners['year'];
   $this->base_int = $this->year;

   $this->print_header();

   echo("</td></tr>\n");

  echo("<tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_.
    "' colspan=3></td></tr>\n");

   echo("<tr>\n");

   $url = new _cal_url();
   $url->addArg($this->listeners['year'], $this->year-1);
   $url->addArg($this->listeners['month'], $this->mon);
   $url->fromRequest($this->listeners['day'], $this->mday);
   $url->fromRequest($this->listeners['view']);

   for($i = ($this->year-4), $a=0; $i <= $this->year+4; $i++,$a++) {
   
      if($a % 3 == 0 && $a > 0) {
         echo("</tr>\n<tr>\n");
      }

      echo("<td align='center' style='padding: 4px' ");

      if($i != $this->year) {
        
         echo("class='"._CAL_CSS_CAL_CONTENT_."'>"); 
         $url->addArg($this->listeners['year'], $i);
         $url->addArg($this->listeners['month'], $this->mon);
         $url->fromRequest($this->listeners['view']);
         
         echo("<a href=\"". $url->toString() ."\">". $i ."</a>");

      } else {
        
         echo("class='"._CAL_CSS_CAL_SELECTED_."'>"); 
         echo($i);
      }
      
      echo("</td>\n");
   }
   echo("\n</tr>\n");

   echo("</table>\n");

   echo("</div>\n");
}


#######################
#
#######################

function display_year_mini()
{

   global $_cal_months_abbr;

   $this->is_mini_cal = true;

   echo("<div  class='"._CAL_CSS_MONTH_MINI_."'>\n");

   echo("<table align=center width='100%' border=0 cellpadding=0>\n");

   if($this->show_header) {

      echo("<tr>
    <td colspan=3 class='"._CAL_CSS_HEADING_."'>");

      $this->base_str = $this->listeners['year'];
      $this->base_int = $this->year;

      if($this->header == null) {
         $this->header = $this->year;
         $this->header_rset = 1;
      }

      $this->print_header();


      echo("</td></tr>\n");

   }


   echo("<tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_."' colspan=3></td></tr>\n");

   echo("<tr>\n");

   $url = new _cal_url();
   $url->addArg($this->listeners['year'], $this->year-1);
   $url->addArg($this->listeners['month'], $this->mon);
   $url->fromRequest($this->listeners['view']);
   
   unset($url->args[$this->listeners['day']]);

   for($i = 1; $i < 13; $i++) {


      $mon = $_cal_months_abbr[$i];

      if($i % 3 == 1 && $i != 1) {
         echo("</tr>\n<tr>\n");
      }

      echo("\t<td width='33%' style='padding: 4px' align=center\n");
      if($this->mon == $i) {

         echo(" class='"._CAL_CSS_CAL_SELECTED_."'>". $mon);

      } else {

         echo(" class='"._CAL_CSS_CAL_CONTENT_."'>");
         $url->addArg($this->listeners['year'], $this->year);
         $url->addArg($this->listeners['month'], $i);
         $url->fromRequest($this->listeners['view']);

         echo("<a href=\"". $url->toString() . "\">". $mon ."</a>");
      }

      echo("\t</td>\n");
   }

   echo("</tr>\n");

   echo("</table>\n");

   echo("</div>\n");
}

#######################
#
########################

function display_month_mini()
{

   global $_cal_weekdays, $_cal_user;

   $this->show_weeks = 0;
   $this->is_mini_cal = true;

   # SET DAYS TO HIGHLIGHT..
   ############################
   if($_SESSION["v"] == "d" || $this->hil_day) {

      $this->selday = $this->year.'-'.$this->mon.'-'.$this->mday;

   } 

   if($_SESSION["v"] == "w" || $this->hil_week) {

      $wday = _ex_date("w", $this->time);

      if($wday >= $_cal_user->options->week_start) {
         $offset = -$wday + $_cal_user->options->week_start;
      } else {
         $offset = ($_cal_user->options->week_start - $wday) - 7;
      }
      $this->selweek = _ex_mktime(0,0,0,$this->mon,$this->mday + $offset, $this->year);

   }


   if($this->width) {
      echo("<table border='0' cellpadding='0' cellspacing='0' style='padding: 0px;' width='".
        $this->width ."'><tr><td>");
   }

   echo("<div class=\""._CAL_CSS_MONTH_MINI_."\">\n");

   echo("<table width='100%' border=0 
      cellpadding=2>\n");


   if($this->show_header) {

      echo("<tr>
	<td colspan=7 class='"._CAL_CSS_HEADING_."'>");

      if($this->header == null) {
         $this->header = $this->month." ".$this->year;
         $this->header_rset = 1;
      }

      $this->base_str = $this->listeners['month'];
      $this->base_int = $this->mon;

      $this->base_increment = 1;

      $this->print_header();

      echo("</td></tr>\n");

      echo("<tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_."' colspan=7> </td></tr>\n");
   }


   echo("<tr>\n");

   for($i = 0, $a = $_cal_user->options->week_start; $i < 7; $i++, $a++)
   {
      echo("\t<th class='"._CAL_CSS_ROW_HEADER_."' align=center>");

      if(isset($this->abbr_weekdays) && $this->abbr_weekdays > 0) {

         echo($this->multibyte ? mb_substr($_cal_weekdays[$a], 0, $this->abbr_weekdays)
            : substr($_cal_weekdays[$a], 0, $this->abbr_weekdays));

       } elseif (isset($this->abbr_weekdays) && $this->abbr_weekdays == 0) {

          echo($_cal_weekdays[$a]);

       } else {

         echo($this->multibyte ? mb_substr($_cal_weekdays[$a], 0, 1)
            : substr($_cal_weekdays[$a], 0, 1));

       }

        echo("</th>\n");
      if($a == 6) { $a = -1; }
   }

   echo("</tr>\n");

   echo("<tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_."' colspan=7></td></tr>\n");

   $this->_fill_month();


   echo("</div>\n");

   if($this->width)
      echo("</td></tr></table>");



}

######################
#
######################

function _fill_month() {

   include(@constant("_CAL_BASE_PATH_") ."include/classes/cal_helpers/fill_month.php");

}

##########################
#
###########################

function fill_date_vars()
{

   global $_cal_months, $_cal_weekdays, $_cal_user;

   if($this->set_curtime)
      $this->time = _ex_localtime();

   list($this->mday,$this->wday,$this->mon,$this->year) = explode("-",
      _ex_date("j-w-n-Y", $this->time));

   $this->month = $_cal_months[_ex_date("n",$this->time)];
   $this->weekday = $_cal_weekdays[_ex_date("w", $this->time)];

   # set week_starttime
   ######################

   $wday = _ex_date("w", $this->time);

   if($wday >= $_cal_user->options->week_start) {
      $offset = -$wday + $_cal_user->options->week_start;
   } else {
      $offset = ($_cal_user->options->week_start - $wday) - 7;
   }

   $this->w_starttime = $this->time + (86400 * $offset);;


   # get month starttime
   #####################
   $wday = _ex_date("w", _ex_mktime(0,0,0,$this->mon,1,$this->year));

   if($wday >= $_cal_user->options->week_start) {
      $offset = -$wday + $_cal_user->options->week_start;
   } else {
      $offset = ($_cal_user->options->week_start - $wday) - 7;
   }

   $this->m_starttime = _ex_mktime(0,0,0,$this->mon,1,$this->year) + (86400 * $offset);;


}

##########################
#
##########################

function print_header()
{

   global $_cal_html, $_cal_user;

    require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");

   if(!$this->show_header) return;

   #####################
   #
   ## SET DEFAULTS
   #
   #####################
   if(@constant("_CAL_INTERFACE_MAIN_")) {

      $this->header_align = ($this->is_mini_cal ? 'm' : 'l');
      $this->show_header_links = true;
      $this->img_next = $this->get_img_nav("next");
      $this->img_prev = $this->get_img_nav("prev");

   }

   if(!$this->img_next) $this->img_next = $this->get_img_nav("next");
   if(!$this->img_prev) $this->img_prev = $this->get_img_nav("prev");


   # translate some header text.. 
   ############################
   if(strpos($this->header,'%') !== false)
   {

      $h_orig = $this->header;

      $t = array('%mday','%wday','%month','%year','%weekday','%mon');
      $r = array($this->mday,$this->wday,$this->month,$this->year,$this->weekday,
            $this->mon);

      $this->header = str_replace($t,$r,$this->header);

   }


   $header = "";

   # print next/prev
   ####################
   if($this->show_header_links && (isset($this->base_int) && isset($this->base_str))) {

       # next
       ########
       if($this->txt_next) {
          $img_next = $this->txt_next;
       } elseif($this->img_next) {
          $img_next = "<img src='".$this->img_next."' border=0 alt='"._NEXT_."'>";
       }


       # prev
       ########
       if($this->txt_prev) {
          $img_prev = $this->txt_prev;
       } elseif($this->img_prev) {
          $img_prev = "<img src='".$this->img_prev."' border=0 alt='"._PREV_."'>";
       }

      $url = new _cal_url();

      $url->addArg($this->listeners['month'], $this->mon);
      $url->addArg($this->listeners['year'], $this->year);
      $url->fromRequest($this->listeners['view']);

      if($this->base_str == $this->listeners["day"]) {

         list($by,$bm,$bd) = explode("-", _ex_date("Y-n-j", _ex_mktime(0,0,0,$this->mon,
            $this->base_int - $this->base_increment, $this->year)));

         $url->addArg($this->listeners['month'], $bm);
         $url->addArg($this->listeners['year'], $by);
         $url->addArg($this->listeners['day'], $bd);

         $back_link = $url->toString();
            
         list($by,$bm,$bd) = explode("-", _ex_date("Y-n-j", _ex_mktime(0,0,0,$this->mon,
            $this->base_int + $this->base_increment, $this->year)));

         $url->addArg($this->listeners['month'], $bm);
         $url->addArg($this->listeners['year'], $by);
         $url->addArg($this->listeners['day'], $bd);

         $fwd_link = $url->toString();


      } else {
 
         unset($url->args[$this->listeners["day"]]);

         $url->addArg($this->base_str, ($this->base_int - $this->base_increment));
         $back_link = $url->toString();
      
         $url->addArg($this->base_str, ($this->base_int + $this->base_increment));
         $fwd_link = $url->toString(); 


      }

      $img_prev = "<a class='"._CAL_CSS_HEADING_."' href='". $back_link ."'>".$img_prev."</a> ";
      
      
      $img_next = " <a class='"._CAL_CSS_HEADING_."' href='". $fwd_link . "'>".$img_next."</a> ";
   }

   $header .= $this->header;

   if(@constant("_CAL_WEEK_NUMBERS_") && $this->wk_number) {
      if(!@constant("_CAL_WK_FONT_STYLE")) define("_CAL_WK_FONT_STYLE_",
            "font-size: 11; font-weight: normal; color: #fff; margin-left: 8px;");

      $header .= " <font style='"._CAL_WK_FONT_STYLE_."'>".
        _WEEK_ABBR_." ". _ex_date("W", $this->w_starttime).  "</font>";
   }

   if($this->printable > 0 && !$this->is_mini_cal) {

      $printstr ="<img src='". $_cal_html->get_img_url("images/printer.gif") ."' alt='printer'>";

      $url = new _cal_url(_CAL_PAGE_PRINT_);
      $url->addArg($this->listeners['month'], $this->mon);
      $url->addArg($this->listeners['day'], $this->mday);
      $url->addArg($this->listeners['year'], $this->year);
      $url->addArg($this->listeners['view'], $_SESSION['v']);
      $url->addArg("calendar",$this->calendar);
      $url->addArg("evnt_type", $this->event_types);

      $printstr .= " <a href='". $url->toString() ."' target='_new'
        class='printview ". _CAL_CSS_HEADING_ ." ". _CAL_CSS_ULINE_."'>".  _PRINTABLE_VIEW_ ."</a>";

      $_cal_html->print_heading($img_prev ." ". $img_next ." ".$header, "", $printstr);

      if($this->header_rset) $this->header = null;

      return;
   }


   switch($this->header_align)
   {
      case "m":
	$_cal_html->print_heading($img_prev,$header,$img_next);
        break;

      case "r":
	$_cal_html->print_heading("","",$header ." ".$img_prev." ".$img_next);
        break;

      case "l":
      default:
	$_cal_html->print_heading($img_prev." ".$img_next." ".$header, "", "");
        break;


   }

   if($h_orig) $this->header = $h_orig;
 
   if($this->header_rset) $this->header = null; 
      
}


#########################
#
#########################

function print_footing()
{

   if(!isset($this->base_int) || !$this->show_footer) {
      return;
   }


   if($this->display_invalids && count($this->invalids)) {

      $eurl = $this->event_view_url;
      $eurl = preg_replace("/%inst/", "", $eurl);

      foreach($this->invalids as $e)
      {
         $eurl = preg_replace("/%eid/", $e['id'], $eurl);

         $GLOBALS['_cal_html']->warning(sprintf(_INVALID_RRULE_,
            "<a class='"._CAL_CSS_ULINE_."' href='". $eurl ."'><font color='red'>". $e['title'] ."</font></a>"
            ));
      }

   }

   echo("<table align=center class='"._CAL_CSS_FOOTING_."' width='100%'>\n<tr>\n<td align=right>\n");
   $url = new _cal_url();
   $url->addArg($this->listeners['month'], $this->mon);
   $url->addArg($this->listeners['year'], $this->year);
   $url->addArg($this->base_str, $this->base_int - $this->base_increment);
   $url->fromRequest($this->listeners['view']);
   echo("<a href='". $url->toString() ."'>". _PREV_ ."</a> || ");
   $url->addArg($this->base_str, $this->base_int + $this->base_increment);
   echo("<a href='". $url->toString() ."'>". _NEXT_ ."</a>");
   echo("</td>\n</tr>\n</table>");


}

###########################
#
##########################

function set_event_view_url()
{

   if(strlen($this->event_view_url)) return;

   if($GLOBALS['_cal_user']->options->e_popup == 1) {

       if(@constant('_CAL_SEF_URLS_')) {

        $this->event_view_url = "javascript:newWin(\"". @constant("_CAL_BASE_URL_") .
            "event_view.php"._CAL_REQ_START_."%title"._CAL_REQ_AMP_.
                "eid"._CAL_REQ_EQ_."%eid". _CAL_REQ_AMP_ .
                "instance". _CAL_REQ_EQ_."%inst\", ".
                intval(@constant("_CAL_EVENT_POPUP_H_")) .", ".
            intval(@constant("_CAL_EVENT_POPUP_W_")) ." )";


       } else {
        
        $this->event_view_url = "javascript:newWin(\"". @constant("_CAL_BASE_URL_") .
		    "event_view.php?eid=%eid". _CAL_AMP_ ."instance=%inst\", ".
                intval(@constant("_CAL_EVENT_POPUP_H_")) .", ".
		    intval(@constant("_CAL_EVENT_POPUP_W_")) ." )";

       }

   } else {


     if(@constant('_CAL_SEF_URLS_')) {

       $this->event_view_url = @constant("_CAL_BASE_URL_") . 
        "%title". _CAL_REQ_AMP_.
        "event_action"._CAL_REQ_EQ_."view"._CAL_REQ_AMP_ ."eid".
            _CAL_REQ_EQ_."%eid". _CAL_REQ_AMP_ ."instance"._CAL_REQ_EQ_."%inst";

     } else {

       $this->event_view_url = @constant("_CAL_BASE_URL_") . _CAL_PAGE_MAIN_ .
		"?event_action=view"._CAL_AMP_ ."eid=%eid". _CAL_AMP_ ."instance=%inst";

     }
   }


}

############################
#
############################

function apply_style($theme = null)
{

   echo("<style type='text/css'>\n");

   if($theme)
      echo(str_replace('#cal ','#'.$this->divid." ", file_get_contents(@constant("_CAL_BASE_PATH_") ."themes/". $theme ."/style/style.css")));

   if(!@include(_CAL_BASE_PATH_."customize/notes_popups.css"))
      require_once(@constant("_CAL_BASE_PATH_") . "css/notes_popups.css");

   echo("</style>\n");

   if($this->e_css) require_once(@constant("_CAL_BASE_PATH_") . "css/calendar_css.php");
}


######################################
#
### Return the url of the next/prev images
### for a mini cal
#
#####################################

function get_img_nav($np)
{

   return _CAL_BASE_URL_ ."themes/".$GLOBALS['_cal_user']->options->theme ."/images/".$np . ($this->is_mini_cal ? "_sm" : "") .".gif";

}

} 
?>
