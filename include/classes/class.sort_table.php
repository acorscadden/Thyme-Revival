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
// $Id: class.sort_table.php,v 1.6 2006/03/10 17:36:37 ian Exp $
//


if(isset($_REQUEST['cal_char'])) $_SESSION['cal_char'] = $_REQUEST['cal_char'];
if(isset($_REQUEST['cal_sort'])) $_SESSION['cal_sort'] = $_REQUEST['cal_sort'];

class _cal_sort_table
{

var $sections = array();
var $persistent = array();
var $chars = array();
var $numbers = false;
var $all = false;

var $skip_chars = false;

function add_section($arr)
{

   $this->sections[] = $arr;
}

function print_table()
{


   require_once(_CAL_BASE_PATH_."include/classes/class.url.php");

   $_cal_url = new _cal_url();

   foreach(array_keys($this->persistent) as $k) {
      $_cal_url->addArg($k,$this->persistent[$k]);
   }

?>

<table cellpadding=8 cellspacing=0
    align='center' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' style='border: 2px solid'>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' style='text-align: center'>
<td >
<?php

#######################
#
### SORT OPTS
#
#######################

if(count($this->sections)) {

   $i = 0;

   foreach($this->sections as $s) {

      $sect = array();

      foreach($s as $so) {

         if($_SESSION['cal_sort'] == $i) {
            $sect[] = $so;
         } else {
            $_cal_url->addArg("cal_sort", $i);
            $sect[] = '<a href="'.$_cal_url->toString() .'" class="'._CAL_CSS_ULINE_.'">'.$so.'</a>';
         }
         $i++;
      }

      if(!$sort_by_printed ) {
         echo("( ". _SORT_BY_ .": ");
         $sort_by_printed = 1;
     } else {
        echo (" ( ");
     }

      $_cal_url->addArg("cal_sort", "");
      echo(join(" || ", $sect) ." )");

   }

   if(!$this->skip_chars) echo("<br><br>");
}

if(!$this->skip_chars) {

   if($this->numbers) {
   
     foreach(array_keys($this->chars) as $c) {
        if(array_search(strtoupper($c),$GLOBALS['_cal_alphabet']) === false) {
           $this->chars[_NUMBER_SYMBOL_] = 1;
           break;
        }
     }
   
     if(strtolower($_SESSION['cal_char']) == _NUMBER_SYMBOL_ || !isset($this->chars[_NUMBER_SYMBOL_]))
     {
        echo(" "._NUMBER_SYMBOL_." &nbsp; ");
     } else {
   
        $_cal_url ->addArg('cal_char', '#');
   
        echo(" <a class='"._CAL_CSS_ULINE_."' href='". $_cal_url->toString() ."'><b>"._NUMBER_SYMBOL_."</b></a> &nbsp;");
     }
   
   
   }
   
   foreach($GLOBALS['_cal_alphabet'] as $char) {
   
     if(strtolower($_SESSION['cal_char']) == strtolower($char) || !isset($this->chars[strtolower($char)]))
     {
        echo(" $char &nbsp; ");
     } else {
   
        $_cal_url ->addArg('cal_char', $char);
   
        echo(" <a class='"._CAL_CSS_ULINE_."' href='". $_cal_url->toString() ."'><b>". $char ."</b></a> &nbsp;");
     }
   
     echo(" ");
   
   
   
   }
   
   if($this->all) {
   
     if(strtolower($_SESSION['cal_char']) == strtolower(_ALL_)) {
        echo("("._ALL_.")");
     } else {
   
        $_cal_url ->addArg('cal_char', _ALL_);
   
        echo(" (<a class='"._CAL_CSS_ULINE_."' href='". $_cal_url->toString() ."'><b>"._ALL_."</b></a>)");
     }
   
   }
}

?>
</td>
</tr>
</table>
<?php

}



}

?>
