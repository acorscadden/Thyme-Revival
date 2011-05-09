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
// $Id: class.table.php,v 1.11 2006/03/10 17:36:34 ian Exp ian $
//


class _cal_table
{

var $align_opts = array();
var $class_opts = array();

var $col_count = 0;

var $class = _CAL_CSS_CAL_CONTENT_;

var $vertical = false;

var $width;

var $align = 'center';

function print_header($cols, $last_is_toolbar = false)
{

   if(!$this->col_count) $this->col_count = count($cols);

   if($this->width) $this->width = "width='{$this->width}'";

?>
   <table border=1 align='<?php echo($this->align) ?>' cellpadding=4
                    class='<?php echo(_CAL_CSS_SPACED_TABLE_." {$this->class}")?>'
    <?php echo($this->width) ?>>
<?php

   if(count($cols)) {

      echo("<tr>\n");

      for($i = 0; $i < count($cols); $i++) {

         if(!trim($cols[$i])) $cols[$i] = "&nbsp;";

         if($last_is_toolbar && $i == (count($cols) - 1))
            $class = " class='"._CAL_CSS_TOOLBAR_."'";
         else
            $class = "";

         if($i == (count($cols) -1) && count($cols) < $this->col_count)
            $colspan = " colspan=2 ";
         else 
            $colspan = "";

         echo("<th $class $colspan>{$cols[$i]}</th>\n");
      }

      echo("</tr>\n");

   }
?>
<?php


}

function print_row($cols, $last_is_toolbar = true)
{

   echo("<tr>\n");

   for($i = 0; $i < count($cols); $i++) {

      if(!trim($cols[$i])) $cols[$i] = "&nbsp;";

      if(count($cols) != $this->col_count && ($this->col_count > 0)) $colspan = " colspan={$this->col_count}";
      else $colspan = "";

      if($this->align_opts[$i]) $align = $this->align_opts[$i];
      else $align = 'center';

      if($this->class_opts[$i]) $class = "class='{$this->class_opts[$i]}'";
      else $class = "";

      if($this->vertical && $i == 0) $td = 'th';
      else $td = 'td';

      if($last_is_toolbar && $i == (count($cols) - 1)) {
         echo("<{$td} align='{$align}' {$colspan} class='"._CAL_CSS_TOOLBAR_."'>");
      } else {
         echo("<{$td} align='{$align}' {$colspan} {$class}>\n");
      }
      echo($cols[$i] ."</{$td}>\n");


   }
   echo("</tr>\n");

}

function print_footer()
{

   echo("</table>\n\n");

}



}

?>
