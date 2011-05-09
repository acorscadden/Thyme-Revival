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
// $Id: add_calendars.php,v 1.26 2008/12/18 19:43:07 ian Exp $
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

$_REQUEST['callback'] = preg_replace('#[^A-z0-9_-]#','',$_REQUEST['callback']);

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
echo($_cal_form->fromRequest('form'));
echo($_cal_form->fromRequest('callback'));
echo($_cal_form->fromRequest('uo'));
echo($_cal_form->fromRequest('multi'));
echo($_cal_form->fromRequest('access_lvl'));

echo(" ". $_cal_form->submit('',_SEARCH_));

$_cal_form->print_footer();

#####################
#
### GET USER LIST
#
#####################

if(!@constant("_CAL_NO_LIST_ALL_") || strlen($_REQUEST['cal_search'])) {

  # trick access into thinking we're guest?
  if($_SESSION['uname_sort'] == 2) {

     $guser = new _cal_user("","",0);
     $cals = $guser->access->get_cals(0,"type in (0,3,4) and lower(title) like '%".
         strtolower($_cal_sql->escape_string($_REQUEST['cal_search'])) ."%'");

  } else {

     $cals = $_cal_user->access->get_cals(intval($_REQUEST['access_lvl']),
        "type in (0,3,4) and lower(title) like '%".
         strtolower($_cal_sql->escape_string($_REQUEST['cal_search'])) ."%'");
  }
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

$_cal_table->align_opts = array('left','left','center');

uasort($cals, array($_cal_user->access,"csort"));

     #######################
     # USER LIST
     #######################

     foreach($cals as $mem)
     {


        $_cal_table->print_row(
            array($mem['title'],$mem['description'],
            "<input type='button' class='"._CAL_CSS_BUTTON_."' value='". _ADD_."'
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

   window.opener.<?php echo($_REQUEST['callback']) ?>(id);

   <?php if(!$_REQUEST['multi']): ?>
   self.close();
   <?php else: ?>
   btn.disabled = true;
   <?php endif ?>

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
