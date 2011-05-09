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

$_cal_html->print_heading(_REQUESTS_ ." - ". $_cur_cal->title);

?>
<br><br>
<h4 style='padding: 8px'><?php echo(nl2br($_cur_cal->request_pre)) ?></h4>
<?php


$form = new _cal_form();
$form->print_header();

$form->print_hidden("event_action");
$form->print_hidden("v");
$form->print_hidden("y");
$form->print_hidden("m");
$form->print_hidden("d");
$form->print_hidden("h");

?>
<table class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." "._CAL_CSS_CAL_CONTENT_)?>' width=300 align='center' cellpadding=8>
<tr>
<td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
<?php
echo($form->submit("header_displayed", _NEXT_, " style='width: 100px' "));
?>
</td></tr></table>

<br><br>


<?php $form->print_footer(); ?>
