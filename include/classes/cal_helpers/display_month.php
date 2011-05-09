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
// $Id: display_month.php,v 1.12 2006/03/10 17:36:31 ian Exp $
//

   global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_user;

   echo("<div class=\""._CAL_CSS_MONTH_."\">\n");


   $url = new _cal_url();
   $url->addArg($this->listeners['year'], $this->year);
   $url->addArg($this->listeners['month'], ($this->mon-1));


   echo("<table ". ($this->printing ? "border=1 cellpadding=2 cellspacing=0 style='background: #000000; border: 1px solid black;'" : "") . " width='100%'>\n<tr>\n"); 

   if($this->show_weeks) {
      echo("<td class='"._CAL_CSS_ROW_HEADER_."'> </td>\n");
   }

   for($i = 0; $i < 7; $i++) 
   {

      $wday = $_cal_weekdays[($_cal_user->options->week_start + $i) % 7];

      if($this->abbr_weekdays > 0) {
         $wday = substr($wday,0,$this->abbr_weekdays);
      }

      echo("\t<th align='center' class='"._CAL_CSS_ROW_HEADER_."'
        width='14%'>".$wday."</th>\n");
   }

   echo("</tr>\n");


   $this->_fill_month();

   echo("</div>\n");



?>
