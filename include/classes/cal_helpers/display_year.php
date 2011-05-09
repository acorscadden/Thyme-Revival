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
// $Id: display_year.php,v 1.14 2006/03/17 19:58:29 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");

   global $_cal_weekdays_abbr, $_cal_months, $_cal_user;


   if($this->show_events) {
      $em = new _cal_event_matrix($this->time, "year", $this->event_types, $this->calendar, $this->filter);
      $this->em = &$em;
   }

   $eo = $this->exclude_outside;

   $this->exclude_outside = 1;

   $url = new _cal_url();

   echo("<div class=\""._CAL_CSS_YEAR_."\">\n");

  echo("<table width='100%' class='"._CAL_CSS_CAL_DISABLED_."' cellpadding=0>\n");
     echo("<tr class='"._CAL_CSS_SPACER_."'>\n<td colspan=7></td>\n</tr>\n");
     echo("<tr><td class='"._CAL_CSS_SPACER_."'> </td>\n");


   $this->selday = null;
   $this->editable = 0;
   $this->show_weeks = 0;
   $this->is_mini_cal = 1;

   for($i = 0; $i < 12; $i++) {

      $this->time = _ex_mktime(0,0,0,$i+1,1,$this->year);
      $this->fill_date_vars();


      if($i % 3 == 0 && $i > 0) {
         echo("\n</tr>");
	 echo("<tr class='"._CAL_CSS_SPACER_."'>\n<td class='"._CAL_CSS_SPACER_."' colspan=7> </td>\n</tr>\n");
	 echo("<tr valign='top'>\n<td class='"._CAL_CSS_SPACER_."'> </td>\n");
      }

      echo("<td valign='top' align=center class='"._CAL_CSS_CAL_DISABLED_."'>\n");


      #################
      # PRINT A MONTH
      ################

      echo("<table cellpadding=3 ". ($this->printing ? "border=1" : "border=0") .
             " width=180 style='border-collapse: collapse' align=center>\n");

      # month name
      #############
      echo("<tr>
         <th class='"._CAL_CSS_ROW_HEADER_."' colspan=7>\n");

      if($this->printing || $this->static) {
         echo($this->month);
      } else { 

         $url->addArg($this->listeners['year'], $this->year);
         $url->addArg($this->listeners['month'], $this->mon);
         $url->addArg($this->listeners['view'], "m");

         echo("<a href=\"".$url->toString()."\">");
         echo($this->month);
         echo("</a>");
      }

      echo("</th>\n</tr>\n");

      # spacer
      echo("<tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_."' colspan=7></td></tr>\n");

      # wekday names
      echo("<tr>\n");
      for($x = 0; $x < 7; $x++)
      {
         echo("\t<th class='"._CAL_CSS_ROW_HEADER_."' style='font-size: 75%'>".
              $_cal_weekdays_abbr[($_cal_user->options->week_start + $x) % 7] . 
            "</th>\n");
      }
      echo("</tr>\n");

      # spacer
      echo("<tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_."' colspan=7></td></tr>\n");
      

      $this->_fill_month();

      # fill_month prints the </table tag

      # end year td
      echo("</td>\n");

      # create year spacer td
      echo("<td class='"._CAL_CSS_SPACER_."'> </td>\n");
   }

   # end current row
   echo("</tr>");

   echo("<tr class='"._CAL_CSS_SPACER_."'>\n<td colspan=7 class='"._CAL_CSS_SPACER_."'> </td>\n</tr>\n");

   echo("\n</table>\n");

   #echo("</div>\n");
   echo("</div>\n");

   $this->exclude_outside = $eo;

?>
