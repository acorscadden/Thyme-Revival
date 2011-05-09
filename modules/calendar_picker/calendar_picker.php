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
// $Id: calendar_picker.php,v 1.19 2007/09/24 00:34:57 root Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

   $c_pick_form = new _cal_form("calendar_picker");

    $c_pick_form->print_header();


   global $_cal_sql;


   if($_REQUEST['module']) $c_pick_form->print_hidden("module");

   
  $calendars_r = $_cal_user->access->get_cals_sel(0,
       (@constant('_CAL_VIEW_PICKER_EXISTS_') ?  "type = 0" : ""));


   if(!$_SESSION['calendar'] || ($_SESSION['calendar'] && !$calendars_r[$_SESSION['calendar']])) {

      if(!$calendars_r[0]) $calendars_r[0] = "  ";
      $c_pick_form->defaults['calendar'] = "0";

   } else {

      if($calendars_r[0]) unset($calendars_r[0]);

      $c_pick_form->defaults['calendar'] = $_SESSION['calendar'];

   }
   



?>
<table width='100%' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='<?php echo(_CAL_CSS_HEADING_) ?>'><?php echo(_CALENDARS_) ?></th> </tr>
      <tr class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"><td class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"> </td></tr>
      <tr class="<?php echo(_CAL_CSS_CAL_CONTENT_) ?>" valign="middle">
         <td align="center" style='padding: 4px;'>

         <?php echo($c_pick_form->select("calendar", $calendars_r,
		"onChange=\"document.forms['calendar_picker'].submit()\" style='width: 134'")) ?>

         </td>
      </tr>
   </table>
   </td>
</tr>
</table>
<?php $c_pick_form->print_footer(); ?>
