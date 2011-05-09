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
// $Id: contact.php,v 1.25 2006/06/19 14:45:03 ian Exp $
//



require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");


$prime = $_cal_user->email;

if(!$emails)
   $emails = $_cal_sql->query("select id, email from {$GLOBALS['_cal_dbpref']}ContactOpts
    where uid = ". $_cal_user->id);

$_cal_tmpl->new_row();

$_cal_form->print_hidden("cact", "");
$_cal_form->print_hidden("c_addr");
$_cal_form->print_hidden('cid');

$_cal_form->defaults['prime_email'] = $_cal_user->email;

if($_REQUEST['cact']) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

?>
<script language="javascript" type="text/javascript">

function add_email()
{

   document.forms['<?php echo($_cal_form->name) ?>'].elements['cact'].value = 'add'; 
   document.forms['<?php echo($_cal_form->name) ?>'].submit();
}

function rem_email(id)
{

   document.forms['<?php echo($_cal_form->name) ?>'].elements['cact'].value = 'remove';
   document.forms['<?php echo($_cal_form->name) ?>'].elements['cid'].value = id;
   document.forms['<?php echo($_cal_form->name) ?>'].submit();
}

function primary_email()
{

   document.forms['<?php echo($_cal_form->name) ?>'].elements['cact'].value = 'primary';
   document.forms['<?php echo($_cal_form->name) ?>'].submit();


}

function upd_email(id)
{

   var cfrm = document.forms['<?php echo($_cal_form->name) ?>'];

   cfrm.elements['cact'].value = 'update';
   cfrm.elements['cid'].value = id;
   cfrm.elements['c_addr'].value = cfrm.elements['email_' + id].value;
   cfrm.submit();


}

</script>
<?php
   
   require_once(_CAL_BASE_PATH_."include/classes/class.table.php");

   $_cal_table = new _cal_table();

   $_cal_table->class = _CAL_CSS_ROW_HEADER_;

   $_cal_table->print_header(array(_EMAIL_,""));

   $_cal_table->align_opts[0] = 'left';

   # add
   #######
   $_cal_table->print_row(array(
        $_cal_form->textbox('email_add', 32, "maxlength=128"),
        "<input type=button class='"._CAL_CSS_BUTTON_."' onClick='add_email()'
        value='"._ADD_."'>"
        ), true
   );

       # CAN"T CHANGE PRIMARY EMAIL IF WE HAVE A CUSTOM AUTH MODULE
       if(function_exists("_ex_auth_login")) {
          $row = array($_cal_user->email);
       } else {
          $row = array($_cal_form->textbox("prime_email", 32, "maxlength=128"));
       }
            
       
        $row[0] .= "(<font class='"._CAL_CSS_HIL_."'>"._PRIMARY_."</font>)";

        $row[] = "<input type=button class='"._CAL_CSS_BUTTON_."'
            onClick='primary_email()' value='"._UPDATE_."'>";

   $_cal_table->print_row($row, true);


   foreach ($emails as $e)
   {
      $_cal_form->defaults['email_'. $e['id']] = $e['email'];

      $_cal_table->print_row(
         array(

            $_cal_form->textbox('email_'. $e['id'], 32, "maxlenth=128"),


            "<input type=button class='"._CAL_CSS_BUTTON_."'
                onClick='upd_email(". $e['id'] .")' value='". _UPDATE_ ."'>
            <input type=button class='"._CAL_CSS_BUTTON_."'
                onClick='rem_email(". $e['id'] .")' value='". _REMOVE_ ."'>"
        ), true
      );

   }

   $_cal_table->print_footer(); 

?>
<br><br>
<?php
$_cal_tmpl->end_row();

?>
