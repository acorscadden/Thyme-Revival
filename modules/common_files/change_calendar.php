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
// $Id: change_calendar.php,v 1.8 2008/12/18 19:46:20 ian Exp $
//

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.common_files$/","",dirname(__FILE__));


   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);
   require_once($BASE_PATH."include/config.php");

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

   global $_cal_sql, $_cal_html;
  
   $_cal_sql or $_cal_sql = new _cal_sql();
   $_cal_html or $_cal_html = new _cal_html();

   $_cal_html->print_header();

   $_cal_form = new _cal_form();

   $guest_uid = 0;

   if($_SESSION['uname_sort'] == 2)
      $acc = new _cal_access($guest_uid);
   else
      $acc = &$_cal_user->access;

   $_REQUEST['callback'] = preg_replace('#[^A-z0-9_-]#','',$_REQUEST['callback']);

############################
#
### SEE IF WE WANT TO CHANGE THE CALENDAR
#
############################################
   if($_REQUEST['cid']) {

      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

      $_cal_obj = new _cal_obj(abs($_REQUEST['cid']));

      # multiple categories
      if($_cal_obj->options & 32) {
   
         # COMPILE LIST OF CHECKBOXES
         ##############################
         $et_sel = "<table border=0 class='"._CAL_CSS_BOUNDING_TABLE_."' cellpadding=2 cellspacing=0 align=left>
           <tr class='"._CAL_CSS_ROW_HEADER_."' valign='top'>";
   
         $i = 0;
         foreach(array_keys($_cal_obj->get_categories()) as $et) {
            if(!(($i++) % 3)) $et_sel .= "</tr><tr class='"._CAL_CSS_ROW_HEADER_."' valign='top'>";
            $et_sel .= "<td class='"._CAL_CSS_ROW_HEADER_."' align='left'>";
            $et_sel .= $_cal_form->checkbox("et_".$et) .$_cal_obj->categories[$et] ." &nbsp; ";
            $et_sel .= "</td>";
         }
         while((($i++) % 3)) $et_sel .= "<td class='"._CAL_CSS_ROW_HEADER_."'> &nbsp; </td>";
         $et_sel .= "</tr></table>";
   
      } else {
  
         $_cal_obj->get_categories(); 
         $et_sel = $_cal_form->select("type", array('('._NONE_.')') + $_cal_obj->categories);
      }

      $et_sel = preg_replace("/\r|\n/"," ", $et_sel);

      echo("<script language='javascript' type='text/javascript'>
      window.opener.".$_REQUEST['callback'] ."({$_cal_obj->id}, '".
        str_replace("'","\\'",$_cal_obj->title) ."', '".
        str_replace("'","\\'",$et_sel) ."');

      self.close();
      </script>
      ");
 
       $_cal_html->print_footer();

      exit;
   }
?>
<table width='100%'>
<tr>
<td>
<br><br>
<table cellpadding=8 cellspacing=0
    align='center' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' style='border: 2px solid'>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'>
<td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' style='padding: 4px'>
<?php

require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");



$_cal_form->print_header();

echo($_cal_form->textbox('cal_search', 20));
echo($_cal_form->fromRequest('callback'));
echo($_cal_form->fromRequest('access_lvl'));

$_cal_form->print_hidden('cid');

echo(" ". $_cal_form->submit('',_SEARCH_));

$_cal_form->print_footer();

#####################
#
### GET USER LIST
#
#####################

if(strlen($_REQUEST['cal_search'])) {

  $cals = $acc->get_cals($_REQUEST['access_lvl'],"type = 0 and lower(title) like '%".
      strtolower($_cal_sql->escape_string($_REQUEST['cal_search'])) ."%'");

} 

if(!is_array($cals)) $cals = array();


?>
</td>
</tr>
</table>

<br><br>

<?php


require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.table.php");

$_cal_table = new _cal_table();

$_cal_table->print_header(array(_TITLE_,_DESCRIPTION_,""));

$_cal_table->align_opts = array('left','left');

uasort($cals, array($_cal_user->access,"csort"));

     #######################
     # USER LIST
     #######################

     foreach($cals as $mem)
     {


        $_cal_table->print_row(
            array($mem['title'],$mem['description'],
            "<input type='button' class='"._CAL_CSS_BUTTON_."' value='". _CHANGE_."'
            onClick='add_cal(". $mem['id'] .", this)'>"
            )
        );

     }


$_cal_table->print_footer();

?>
<br><br>

   </td>
</tr>
<tr class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
   <td>
   <input type='button' class='<?php echo(_CAL_CSS_BUTTON_) ?>' onClick='self.close()' value='<?php echo(_CLOSE_) ?>'>
   </td>
</tr>
</table>
<script language='javascript' type='text/javascript'>

document.forms[0].cal_search.focus();

function add_cal(id, btn)
{
   document.forms[0].cid.value = id;
   document.forms[0].submit();   
}

</script>
<?php

# sort support function for calendar member list

function msort($a,$b)
{

  return strcasecmp($a['name'],$b['name']);


}

$_cal_html->print_footer();

?>
