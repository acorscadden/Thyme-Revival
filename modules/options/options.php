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

   global $_cal_user, $_cal_html, $_cal_sql, $_cal_tmpl, $_cal_dbpref;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   


#########################
# check for subscriptions
#########################
switch($_REQUEST['subact'])
{

   case 'add_view_sub':
      if(!$_REQUEST['cid']) break;

      $_cal_sql->insert("Subscriptions",
        array("uid" => $_cal_user->id, "calendar" => $_cal_sql->escape_string($_REQUEST['cid']),
        "view" => intval($_REQUEST['s_et']), "contact" => $_cal_sql->escape_string($_REQUEST['s_contact'])));

      break;


   case 'remove_view_sub':
       if(!$_REQUEST['subid']) break;

       $_cal_sql->query("delete from {$_cal_dbpref}Subscriptions where id = ". $_cal_sql->escape_string($_REQUEST['subid']) ." and
            uid = ". $_cal_user->id);

       break;


   case 'update_view_sub';
       if(!$_REQUEST['subid']) break;

       $_cal_sql->update("Subscriptions",
            array("calendar" => $_cal_sql->escape_string($_REQUEST['cid']),
            "view" => $_cal_sql->escape_string($_REQUEST['s_et']),
            "contact " => $_cal_sql->escape_string($_REQUEST['s_contact'])),
            array("id" => $_cal_sql->escape_string($_REQUEST['subid']), "uid" => $_cal_user->id)
        );

       break;


}


#########################
# check for notifications
#########################
switch($_REQUEST['notact'])
{

   case 'subscribe':
      if(!$_REQUEST['cid']) break;
      list($sub_cal) = $_cal_sql->query("select title from {$_cal_dbpref}Calendars where id = ". 
            $_cal_sql->escape_string($_REQUEST['cid']));

      $_cal_sql->query("insert into {$_cal_dbpref}Notifications (uid, cid, name, contact)
        values (". $_cal_user->id .", ".
        $_cal_sql->escape_string($_REQUEST['cid']) .", '". $_cal_sql->escape_string($sub_cal['title']) ."', 0)");

      break;

   case 'save':

      $_cal_sql->query("update {$_cal_dbpref}Notifications set
            name = '". $_cal_sql->escape_string($_REQUEST['s_name']) ."',
            etype = ". ($_REQUEST['s_et'] ? $_cal_sql->escape_string($_REQUEST['s_et']) : 0) .",
            titlecontains = '". $_cal_sql->escape_string($_REQUEST['s_titlelike']) ."',
            contact = ". $_cal_sql->escape_string($_REQUEST['s_contact']) ." 
            where id = ". $_cal_sql->escape_string($_REQUEST['cid']) ." and uid = ". $_cal_user->id);

      break;


   case 'delete':

      $_cal_sql->query("delete from {$_cal_dbpref}Notifications where id = ".
        $_cal_sql->escape_string($_REQUEST['cid']) ." and uid = ". $_cal_user->id);

      break;



}

#########################
# check for contact opts
#########################
switch($_REQUEST['cact'])
{

   case 'remove':
      if(!$_REQUEST['cid']) break;

      $_cal_sql->query("delete from {$_cal_dbpref}ContactOpts where uid = ". $_cal_user->id ." and
        id = ". $_cal_sql->escape_string($_REQUEST['cid']));

      break;

   case 'add':
      if(!$_REQUEST['email_add']) break;

      # check for primary
      ########################
      if(!$_cal_user->email) {

          $_REQUEST['prime_email'] = $_REQUEST['email_add'];

      } else {

         $_cal_sql->query("insert into {$_cal_dbpref}ContactOpts (uid, email)
            values (". $_cal_user->id .
           ", '". $_cal_sql->escape_string($_REQUEST['email_add']) . "')");

         break;

      }

   case 'primary':

      if(preg_match("/^[A-Za-z0-9\.\-_]+\@[A-Za-z0-9\.\-_]+$/",$_REQUEST['prime_email'])) {

         $_cal_user->email = $_cal_sql->escape_string($_REQUEST['prime_email']);

         $_cal_sql->query("update {$_cal_dbpref}Users set email = '".
            $_cal_sql->escape_string($_REQUEST['prime_email']) ."' where id = ". $_cal_user->id);
       }


      break; 

   case 'update':
      if(!preg_match("/^[A-Za-z0-9\.\-_]+\@[A-Za-z0-9\.\-_]+$/",$_REQUEST['c_addr'])) break;
  
      $_cal_sql->query("update {$_cal_dbpref}ContactOpts set email = '".
        $_cal_sql->escape_string($_REQUEST['c_addr']) ."' where id = ".
            $_cal_sql->escape_string($_REQUEST['cid']));

      break;


}

switch($_REQUEST['option_action'])
{

   case _SAVE_:


      if(@constant("_CAL_FORCE_DEFAULT_OPTS_")) {

         $url = new _cal_url();

         $_cal_html->js_redirect($url->toString());
         break;
       }

      if($_REQUEST['edit_default']) {

         echo("Legacy default edit options.. please remove from options.php\n");
         exit;

      } else {

         $options = &$_cal_user->options;
      }
        
      $options->tie_to($_REQUEST);

      # create options if they don't exist
      #####################################
      if($options->not_found) {
         $_cal_sql->query("insert into {$_cal_dbpref}UserOptions (id) values (". $_cal_user->id .")");
      }

      if(!$options->save()) {
         echo("<br>". _ERROR_ .": options.php :: \$_cal_user->options->save()<br>\n");
         if($tmpusr) $_cal_user->userid = $tmpusr;
         break;
      }

      if($tmpusr) $_cal_user->userid = $tmpusr;

      $url = new _cal_url();

      $_cal_html->js_redirect($url->toString());
      break;

   case "pass":

      require_once(@constant("_CAL_BASE_PATH_") . "modules/options/reset_pass.php");
      break;

   case _CANCEL_:
   case _CLOSE_:
      $url = new _cal_url();
      $_cal_html->js_redirect($url->toString());
      break;


   default:
      require_once(@constant("_CAL_BASE_PATH_") . "modules/options/options_edit_tpl.php");
}

?>
