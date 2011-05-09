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
//


   global $_cal_user;

   define("_CAL_BENCHMARK_", 0);
   define("_CAL_USE_SESSION_", 1);

   define("_CAL_BASE_PATH_", dirname(__FILE__) ."/");

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.form.php");

   $_cal_html = new _cal_html();

   $_cal_html->print_header(_NOTES_);


?>
<script language="javascript" type="text/javascript">

var notes = window.opener.document.forms['<?php echo($_REQUEST['form']) ?>'].notes.value;

if(notes.indexOf('</') < 0) {

   var n1 = notes.pregsplit("/\n/");

  notes = '';

  for(i = 0; i < n1.length; i++) {
     notes = notes + n1[i] + '<br>';
  }

}

</script>
<?php

   $_cal_html->js_onload[] = "document.getElementById('notesspan').innerHTML = notes;";
 

?>
<table border=0 width=100% cellpadding=4>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'>
<td>
<span id='notesspan'> </span>
</td>
</tr>
</table>
<br>
<table border=0 align='center'>
<tr>
<td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' style='text-align: center; padding: 4px;'>
<?php
   $_cal_form = new _cal_form();
   $_cal_form->print_header();
   echo("<input type=button class='"._CAL_CSS_BUTTON_."' value='"._CLOSE_."'
        onClick='self.close()'>\n"); 
   $_cal_form->print_footer();
?>
</td>
</tr>
</table>
<?php
   $_cal_html->print_footer();
?>
