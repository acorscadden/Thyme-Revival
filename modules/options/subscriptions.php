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
// $Id: subscriptions.php,v 1.19 2006/03/10 17:36:53 ian Exp $
//

   global $_cal_user, $_cal_weekdays;

   $cals = $_cal_user->access->get_cals_sel();

   $views = array(_DAILY_,_WEEKLY_ . " (". $_cal_weekdays[$_cal_user->options->week_start] .")");

   # should be previously defined by contact options
   if(!$emails)
      $emails = $_cal_sql->query("select id, email from {$GLOBALS['_cal_dbpref']}ContactOpts
            where uid = ". $_cal_user->id);

   if(!$c_email) {
      foreach($emails as $e)
      {
         $c_email[$e['id']] = $e['email'];
      }
      $c_email[0] = $_cal_user->email;
   }

 
   $_cal_tmpl->new_row();

   $subs = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}Subscriptions
        where uid = ". $_cal_user->id);

  $_cal_form->print_hidden("subact", "");
  $_cal_form->print_hidden("subid", "");

  if($_REQUEST['subact']) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

?>
<script language="Javascript" type="text/javascript">

function sadd()
{

   var frm = document.forms['<?php echo($_cal_form->name) ?>'];

   frm.elements['subact'].value = 'add_view_sub';
   frm.elements['cid'].value = frm.elements['s_cal'].options[frm.elements['s_cal'].selectedIndex].value;
   frm.elements['s_et'].value = frm.elements['s_view'].selectedIndex;
   frm.elements['s_contact'].value = frm.elements['s_email'].options[frm.elements['s_email'].selectedIndex].value;
   frm.submit();

}

function s_update(sid)
{

   var frm = document.forms['<?php echo($_cal_form->name) ?>'];

   frm.elements['subid'].value = sid;

   frm.elements['subact'].value = 'update_view_sub';
   frm.elements['cid'].value = frm.elements['s_cal_' + sid].options[frm.elements['s_cal_' + sid].selectedIndex].value;
   frm.elements['s_et'].value = frm.elements['s_view_' + sid].selectedIndex;
   frm.elements['s_contact'].value = frm.elements['s_email_' + sid].options[frm.elements['s_email_' + sid].selectedIndex].value;
   frm.submit();

}

function s_remove(sid)
{

   var frm = document.forms['<?php echo($_cal_form->name) ?>'];
   
   frm.elements['subid'].value = sid;
   frm.elements['subact'].value = 'remove_view_sub';
   frm.submit();

}


</script>
<h4 align='center'><?php echo(_SUBSCRIPTIONS_DESC_) ?></h4>
<?php

   require_once(_CAL_BASE_PATH_."include/classes/class.table.php");
  
   $_cal_table = new _cal_table();

   $_cal_table->print_header(array(_CALENDAR_,_VIEW_,_CONTACT_,""));

   $_cal_table->print_row(
        array(
            $_cal_form->select("s_cal", $cals),
            $_cal_form->select("s_view", $views),
            $_cal_form->select("s_email", $c_email),
            "<input type=button value='"._ADD_."' onClick='sadd()'
            class='"._CAL_CSS_BUTTON_."'>"
        ), true
    );

  
   foreach($subs as $s)
   {
   
      $_cal_form->defaults["s_cal_". $s['id']] = $s['calendar'];
      $_cal_form->defaults["s_view_". $s['id']] = $s['view'];
      $_cal_form->defaults["s_email_". $s['id']] = $s['contact'];

      $_cal_table->print_row(
            array(
                $_cal_form->select("s_cal_". $s['id'], $cals),
                $_cal_form->select("s_view_". $s['id'], $views),
                $_cal_form->select("s_email_". $s['id'], $c_email),
                "<input type=button value='". _UPDATE_."'
                    class='"._CAL_CSS_BUTTON_."' onClick='s_update(". $s['id'] .")'>
                <input type=button value='". _REMOVE_ ."' class='"._CAL_CSS_BUTTON_."'
                    onClick='s_remove(". $s['id'] .")'>"
            ), true
      );


   }
  

  $_cal_table->print_footer();

?>
<br><br>
<?php
   $_cal_tmpl->end_row();

?>
