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
//

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

global $_cur_cal;

$_cal_form = new _cal_form("quickadd");

########################
# get the current type...
#######################

if($_SESSION['evnt_type'] > 0) {
   $_cal_form->defaults['type'] = $_SESSION['evnt_type'];
} 


#######################
# get tde current date
# and tell tde form what we got
###############################
$_cal_form->defaults['startdate_yr'] = $_SESSION["y"];
$_cal_form->defaults['startdate_mo'] = $_SESSION["m"];
$_cal_form->defaults['startdate_da'] = $_SESSION["d"];

$_cal_form->defaults['starttime_hr'] = _ex_date("H",_ex_localtime());


$_cal_form->print_header();

$_cal_form->print_hidden('event_action', _SAVE_);
$_cal_form->print_hidden('duration_hr', 1);
$_cal_form->print_hidden('duration_min', 0);

# CHECK FOR MULTIPLE TYPES
#############################
if($_cur_cal->options & 32) {

   foreach(array_keys($_cur_cal->get_categories()) as $cat_id) {
      $_cal_form->print_hidden("et_{$cat_id}", (($_SESSION['evnt_type'] == $cat_id) ? "1" : "0"));
   }
}

?>

<div id='quickadd' align=center>
<?php echo(_QUICK_ADD_EVNT_) ?><br>

<table cellpadding=2 cellspacing=0 border=0>
<tr><td>
<table cellpadding=8 cellspacing=0>
<tr>

<?php if(count($_cur_cal->get_categories()) > 0): ?>
   <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'><?php echo(_TYPE_) ?><br>
   <?php echo($_cal_form->select("type", array(0=>"("._NONE_.")") + $_cur_cal->get_categories(),
    (($_cur_cal->options & 32) ? "onChange='upd_et_sel(this.value)'" : ""))) ?>
   </td>
<?php endif ?>
   <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'><?php echo(_TITLE_) ?><br>
   <?php echo($_cal_form->textbox('title', 15)) ?>
   </td>

   <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'><?php echo(_DATE_) ?><br>
   <?php echo($_cal_form->dateselect("startdate")); ?>
    </td>

    <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'><?php echo(_TIME_) ?><br>
    <?php echo($_cal_form->timeselect("starttime")); ?>
    </td>

    <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'><?php echo($_cal_form->submit('',_ADD_)) ?></td>
</tr>
</table>
</td></tr>
</table>
</div>
<?php
$_cal_form->print_footer();

# CHECK FOR MULTIPLE TYPES
#############################
if($_cur_cal->options & 32) {
?>
<script language='javascript' type='text/javascript'>

var et_sel_cur = '<?php echo($_SESSION['evnt_type']) ?>';

function upd_et_sel(val) {

   if(document.forms["quickadd"].elements['et_' + et_sel_cur]) {
      document.forms["quickadd"].elements['et_' + et_sel_cur].value = '0';
   }

   document.forms["quickadd"].elements['et_' + val].value = 1;
}

</script>
<?php 

}

?>
