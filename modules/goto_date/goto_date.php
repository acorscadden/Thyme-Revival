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

   $form = new _cal_form("cal_goto_date");

   $form->print_header();
   $form->print_hidden("goto_date", "goto_date");

?>
<table width='100%' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>
   <tr> <th class='<?php echo(_CAL_CSS_HEADING_) ?>'><?php echo(_GOTO_DATE_) ?></th> </tr>
   <tr class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"><td  class="<?php echo(_CAL_CSS_SPACER_TINY_)?>"> </td></tr>
   <tr class="<?php echo(_CAL_CSS_CAL_CONTENT_)?>" valign="middle">
      <td align="center" style='padding: 4px;'>
          <input type=text class='<?php echo(_CAL_CSS_TEXTBOX_) ?>' size=15 name="date">
      </td>
   </tr>
   </table>
   </td>
</tr>
</table>
<?php $form->print_footer(); ?>
