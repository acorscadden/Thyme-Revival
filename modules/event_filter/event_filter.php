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

   global $_cur_cal, $_cal_sql;

   if(!count($_cur_cal->get_categories()) && !$_cur_cal->has_subcals) return;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

   $evnt_form = new _cal_form("event_types");

   $evnt_form->print_header();



   if($_SESSION['evnt_type'] > 0) {
      $evnt_form->defaults['evnt_type'] = intval($_SESSION['evnt_type']);
   }

   if($_cur_cal->has_subcals) {
      $evnt_form->defaults['vcat'] = $_SESSION['vcat'];
   }

?>
<table width='100%' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='<?php echo(_CAL_CSS_HEADING_) ?>'><?php echo(_EVENT_FILTER_) ?></th> </tr>
      <tr class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"><td class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"> </td></tr>
      <tr class="<?php echo(_CAL_CSS_CAL_CONTENT_) ?>" valign="middle">
         <td align="center" style='padding: 4px;'>

<?php

   if(!$_cur_cal->has_subcals) {

        echo($evnt_form->select("evnt_type", array( 0 => _ALL_) + $_cur_cal->get_categories() ,
		   "onChange=\"document.forms['event_types'].submit()\" style='width: 134'"));


   } else {

      # get categories
      $vcats = $_cal_sql->query("select distinct name, name
        from {$_cal_dbpref}EventTypes where calendar
        ". $_cur_cal->get_constraint(), true);

      uasort($vcats,'strnatcasecmp');

        echo($evnt_form->select("vcat", array( "" => _ALL_) + $vcats ,
           "onChange=\"document.forms['event_types'].submit()\" style='width: 134'"));

      

   }




?>
         </td>
      </tr>
   </table>
   </td>
</tr>
</table>
<?php $evnt_form->print_footer(); ?>
