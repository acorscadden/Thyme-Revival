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
// $Id: notifications.php,v 1.21 2006/08/22 23:15:15 ian Exp $
//

   global $_cal_dbpref;

   # get current subscriptions
   ############################
   $sub_list = $_cal_sql->query("select * from {$_cal_dbpref}Notifications where uid = ". $_cal_user->id); 

   $cals = array();

   # get calendar info for each calendar subscribed
   ################################################
   $i = 0;
   foreach($sub_list as $c) { $cals[$c['cid']] = ($i++); }

   if(!count($cals)) $cals = array(0 => "0");

   # get event types for each calendar subscribed
   ##############################################
   foreach(array_keys($cals) as $c) {

      $_et_cal = new _cal_obj($c);

      $sub_etypes = $_et_cal->get_categories();

      foreach(array_keys($sub_etypes) as $e) {

         $ets[$c][$e] = $sub_etypes[$e];
      }
   }

   unset($sub_etypes); 

   $cals = $_cal_sql->query("select id, title from {$_cal_dbpref}Calendars where id in (".
        join(",", array_unique(array_keys($cals))) .")", true);

   
   $_cal_tmpl->new_row();

   $_cal_form->print_hidden('notact', "");
   $_cal_form->print_hidden('s_name');
   $_cal_form->print_hidden('s_et');
   $_cal_form->print_hidden('s_titlelike');
   $_cal_form->print_hidden('s_contact');

   if($_REQUEST['notact']) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

   # should be previously defined by contact options
   if(!$emails)
      $emails = $_cal_sql->query("select id, email from {$_cal_dbpref}ContactOpts
            where uid = ". $_cal_user->id);

   # should be previously defined by subscriptions
   if(!$c_email) {
      foreach($emails as $e)
      {
         $c_email[$e['id']] = $e['email'];
      }
      $c_email[0] = $_cal_user->email;
   }

?>
<?php require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js"); ?>
<script language="JavaScript" type="text/javascript">

       function add_sub_submit(cid)
       {

          document.forms['<?php echo($_cal_form->name) ?>'].elements['cid'].value = cid;
          document.forms['<?php echo($_cal_form->name) ?>'].elements['notact'].value = 'subscribe';
          document.forms['<?php echo($_cal_form->name) ?>'].submit();


       }

       function add_sub()
       {
          <?php
          $url = new _cal_url("modules/common_files/add_calendars.php");
          $url->addArg("callback", "add_sub_submit");
          echo("var url = '". $url->toString() ."';\n");
          ?>
          newWin(url, 500, 400);

       }

       function edit_sub_submit(id, act, name, et, titlelike, contact)
       {

          document.forms['<?php echo($_cal_form->name) ?>'].elements['cid'].value = id;
          document.forms['<?php echo($_cal_form->name) ?>'].elements['notact'].value = act;
          document.forms['<?php echo($_cal_form->name) ?>'].elements['s_name'].value = name;
          document.forms['<?php echo($_cal_form->name) ?>'].elements['s_et'].value = et;
          document.forms['<?php echo($_cal_form->name) ?>'].elements['s_titlelike'].value = titlelike;
          document.forms['<?php echo($_cal_form->name) ?>'].elements['s_contact'].value = contact;
          document.forms['<?php echo($_cal_form->name) ?>'].submit();


       }

       function edit_sub(id)
       {
          <?php
          $url = new _cal_url("modules/options/edit_sub.php");
          $url->addArg("callback", "edit_sub_submit");
          echo("var url = '". $url->toString() ."&sid=' + id;\n");
          ?>
          newWin(url, 130, 750);

       }

</script>
<h4 align='center'><?php echo(_NOTIFICATIONS_DESC_) ?></h4>
<?php

   require_once(_CAL_BASE_PATH_."include/classes/class.table.php");

   $_cal_table = new _cal_table();

   $_cal_table->print_header(
        array(_NAME_,_CALENDAR_,_EVENT_TYPE_,_TITLE_CONTAINS_,_CONTACT_,
            "<input type=button class='"._CAL_CSS_BUTTON_."' onClick='add_sub()'
                    value='"._ADD_."'>"
        ), true
   );



   foreach($sub_list as $s)
   {

      $_cal_table->print_row(
        array($s['name'], $cals[$s['cid']], ($s['etype'] > 0 ? $ets[$s['cid']][$s['etype']] : _ALL_),
            $s['titlecontains'], $c_email[$s['contact']],
         "<input type=button class='"._CAL_CSS_BUTTON_."' onClick='edit_sub(". $s['id'] .")'
                value='". _EDIT_ ."'>"
        ), true
      );


   }

   $_cal_table->print_footer();
?>
<br><Br>
<?php

   $_cal_tmpl->end_row();

?>
