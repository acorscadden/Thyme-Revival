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
// $Id: users.php,v 1.73 2008/01/20 21:13:16 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");

   global $_cal_sql, $_cal_user, $_cal_dbpref;
  
   $_cal_sql or $_cal_sql = new _cal_sql();

   # MAKE SURE WE'RE THE ADMIN USER..
   if(!$_cal_user->admin) {

      $_cal_html->permission_denied(); # fixed
      return;
   }


   $_cal_html->print_heading(_USERS_);


   ############################
   # GUEST ACCOUNT / DEFAULT USER
   ###############################

   if($_REQUEST['user'] == -1) {

      $_cal_sql->query("update {$_cal_dbpref}Users set id = 0
        where userid = '_cal_default_' or pass = 'ENABLED' or pass = 'DISABLED'");


      $duser = new _cal_user("", "", 0);

      $duser->access_lvl = intval($_REQUEST['access_lvl']);

      if(strtolower($_REQUEST['user_action']) != strtolower(_UPDATE_))
         $duser->pass = ($_REQUEST['user_action'] == _ENABLE_ ? "ENABLED" : "DISABLED");

      $duser->save();

      unset($_REQUEST['user_action']);



   ##########################
   # ADMIN ACCOUNT
   ##########################
   } else if($_REQUEST['user'] == _CAL_ADMIN_USER_ && !function_exists("_ex_auth_login") && $_REQUEST['user_action'] == _UPDATE_) {

      $auser = new _cal_user(null,null, 1);
      $auser->name = $_REQUEST['name'];
      $auser->email = $_REQUEST['email'];
 
      if($_REQUEST['pw']) {
         $auser->pass = md5($_REQUEST['pw']);
         $auser->fields[] = 'pass';
      }

      $auser->save();

      unset($_REQUEST['user_action']);


   }


########################
#
## COLORS
#
########################
if($_REQUEST['colors_action'] == _SAVE_ && $_REQUEST['uid']) {


   # see if it exists
   $uid = $_cal_sql->escape_string($_REQUEST['uid']);

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_type.php");


   # CHECK IF IT ALREADY EXISTS
   list($ex) = $_cal_sql->query("select id from {$_cal_dbpref}EventTypes where id = {$uid}
        and calendar = 0");

   if($ex['id']) {
      $et = new _cal_event_type(array("id" => $uid, "calendar" => 0));
   } else {
      $et = new _cal_event_type();
      $et->id = $uid;
      $et->calendar = 0;
   }


   $et->name = $uid;

   $et->background = $_REQUEST['background_color'];
   $et->border = $_REQUEST['border_color'];
   $et->timecolor = $_REQUEST['font_color'];
   $et->titlecolor = $_REQUEST['title_font_color'];

   $et->fontweight = ($_REQUEST['weight'] ? "bold" : "");
   $et->fontstyle = ($_REQUEST['italics'] ? "italic" : "");
   $et->textdecoration = ($_REQUEST['uline'] ? "underline" : "");

   $et->save();


}

switch(strtolower($_REQUEST['user_action'])) 
{

   case strtolower(_ADD_):
      if(strlen($_REQUEST['new_user']) < 1) { break; }
      if(strlen($_REQUEST['new_pass']) < 1) { break; }


      if(array_search(strtoupper(substr($_REQUEST['new_user'], 0, 1)), $GLOBALS['_cal_alphabet']) === false) {
         echo("<h4 align=center>"._USERNAME_." "._MUST_BEGIN_WITH_CHAR_."</h4><br>\n");
         break;
      } 


      $nuser = new _cal_user($_REQUEST['new_user'],$_REQUEST['new_pass']);

      $nuser->userid = strtolower($_REQUEST['new_user']);

      # yes, save the password
      $nuser->fields[] = 'pass';

      $nuser->pass = md5($_REQUEST['new_pass']);
      $nuser->access_lvl = intval($_REQUEST['new_access_lvl']);
      $nuser->name = $_REQUEST['new_name'];
      $nuser->email = $_REQUEST['new_email'];

      $nuser->save();

      # get default options from default user
      ########################################

      $duser = new _cal_user(""," ",0);

      $nuser->options = $duser->options;

      $nuser->options->keyval = $nuser->options->id = $nuser->id;
      $nuser->options->save(true);

      $_SESSION['cal_char'] = strtoupper(substr(($_SESSION['cal_sort'] ? $nuser->name : $nuser->userid), 0, 1));

      break;

   case strtolower(_UPDATE_):

      $nuser = new _cal_user("","", $_REQUEST['uid']);
      $nuser->id = $_REQUEST['uid'];

      #################################
      #
      ### CHECK FOR CUSTOM AUTH MODULE
      #
      ##################################
      if(function_exists("_ex_auth_login")) {

         $nuser->access_lvl = intval($_REQUEST['access_lvl']);

         # check if user exists..
         #########################
         if($nuser->not_found) {
            $nuser->save(true);
         } else {
            $nuser->save();
         }

         break;

      }
      $nuser->userid = strtolower($_REQUEST['user']);

      # yes, save the password
      if(strlen($_REQUEST['pw']) > 0) {
         $nuser->fields[] = 'pass';
      }

      $nuser->pass = md5($_REQUEST['pw']);
      $nuser->access_lvl = intval($_REQUEST['access_lvl']);
      $nuser->name = $_REQUEST['name'];
      $nuser->email = $_REQUEST['email'];

      $nuser->save();


      echo("<h4 align='center'>". _UPDATED_ ."</h4>\n");
      break;


   case strtolower(_COLORS_):

      # list colors
      include_once(@constant("_CAL_BASE_PATH_") . "modules/users/member_colors.php");

      return;
  
   case strtolower(_DELETE_):
      
      if($_REQUEST['user'] == _CAL_ADMIN_USER_) { break; }

      if($_REQUEST['uid']) $duser = new _cal_user(" "," ", $_REQUEST['uid']);
      else $duser = new _cal_user($_REQUEST['user'], " ");

      if(!$duser->id) $duser->id = $_REQUEST['uid'];
     
      # really delete?
      #####################3 
      if($_REQUEST['really_delete']) {

         require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
         require_once(@constant("_CAL_BASE_PATH_") . "modules/calendars/delete.php");

         # delete events owned by this user:
         ##################################
         if($_REQUEST['del_events']) {

            $events = $_cal_sql->query("select id from {$_cal_dbpref}Events where owner = ". $duser->id);

            foreach($events as $e) {
               _cal_event::delete($e['id']);
            }

         }

         # delete calendars owned by this user
         ######################################
         if($_REQUEST['cal_ids']) {
            $cal_ids = explode(",", $_REQUEST['cal_ids']);

            foreach($cal_ids as $cid) {

               if($_REQUEST['delete_cal_' . $cid]) delete_cal($cid);
            }
         }

         $_cal_sql->query("delete from {$_cal_dbpref}Users where id = " . $duser->id);
         $_cal_sql->quiet=true;
         $_cal_sql->query("delete from {$_cal_dbpref}UserOptions where id = ". $duser->id);
         $_cal_sql->quiet=false;

         $duser->delete();

         break;

      }

      require_once(_CAL_BASE_PATH_."include/ask_delete.php");

      $form = new _cal_form();
      $form->print_header();

      ob_start();
      #echo("<table border=0 align=center><tr><td>\n");
      echo("<div align='center'>\n");
      echo($form->checkbox("del_events") ." ". _DELETE_USERS_EVENTS_);
      echo("</div><br>\n");
     # echo("<br></td></tr></table><br>");


      $cals = $_cal_sql->query("select id, title, description from {$_cal_dbpref}Calendars
            where type = 0 and owner = ". $duser->id);


      $cal_ids = array();

      if(count($cals)) {

         echo("<div align='center'><b>"._CALENDARS_OWNED_."</b></div>\n");

         require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.table.php");

         $_cal_table = new _cal_table();

         $_cal_table->print_header(array(_TITLE_,_DESCRIPTION_,_DELETE_));

            foreach($cals as $c)
            {

               $_cal_table->print_row(array($c['title'],$c['description'],
                  $form->checkbox("delete_cal_". $c['id'])));

               $cal_ids[] = $c['id'];
            }
      
         $_cal_table->print_footer();   
      }

      echo("<br>");
      $xtra = ob_get_contents();
      ob_end_clean();

      _ex_ask_delete(_ARE_YOU_SURE_DELETE_USER_, $_REQUEST['user'], $form, 'user_action', $xtra);

      $form->print_hidden("cal_ids", join(",",$cal_ids));

      echo($form->fromRequest('user'));
      echo($form->fromRequest('uid'));
      echo($form->fromRequest("module"));
      $form->print_hidden('really_delete', 1);

       
      $form->print_footer();

      return;


}


# generate list of users..
require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");


$constraint = ' where ';
$orderby = ' order by ';

###################
#
### SORT BY OPTIONS
#
#####################

$url = new _cal_url();
$url->fromRequest("module");

require_once(_CAL_BASE_PATH_."include/classes/class.sort_table.php");

if(isset($_REQUEST['cal_sort'])) $_SESSION['cal_sort'] = intval($_REQUEST['cal_sort']);


$_cal_sort = new _cal_sort_table();

$_cal_sort->all = true;

$_cal_sort->add_section(array(_USERNAME_,_NAME_));
$_cal_sort->persistent['module'] = 'users';

if(!function_exists("_ex_auth_login")) {
      $_cal_sort->add_section(array(_PUBLIC_ACCESS_,_SUPER_USER_));
} else {
      $_cal_sort->add_section(array(_PUBLIC_ACCESS_,_AUDIT_USERS_));
}



if($_SESSION['cal_sort'] == 0)
{

   $constraint .= 'lower(userid) like \'';
   $orderby .= 'userid';

} else if ($_SESSION['cal_sort'] == 1) {

   $constraint .= 'lower(name) like \'';
   $orderby .= 'name';

} else if ($_SESSION['cal_sort'] == 2) {

   $constraint .= ' 0 = 1 ';
   $orderby .= 'id';

} else {

   if(!function_exists("_ex_auth_login")) {

      $constraint .= ' userid = \''. _CAL_ADMIN_USER_ .'\'';
      $orderby .= 'name';

   } else {

      $constraint .= ' id < 0';
      $orderby = '';

   }


}



#######################
#
### CHARACTER OPTIONS
#
#######################
if($_SESSION['cal_sort'] < 2) {

   if(function_exists("_ex_auth_login")) {

      $unames = _ex_auth_list_chars(($_SESSION['cal_sort'] == 1 ? "name" : "userid"));

   } else {

      $unames = $_cal_sql->query("select distinct lower(".$_cal_sql->functions['substr']."(".
        ($_SESSION['cal_sort'] == 1 ? "name" : "userid") .", 1,1)) as u, '1'
        from {$_cal_dbpref}Users where id > 1",1);

   } 

} else {
   $unames = array();
}

foreach($unames as $u) {
   $_cal_sort->chars = $unames;
}


##############################
#
### PRINT SORT TABLE
#
##############################
$_cal_sort->print_table();

# finish constraint
if($_SESSION['cal_sort'] < 2 && strlen($_SESSION['cal_char'])) {
   $constraint .= ($_SESSION['cal_char'] == _ALL_ ? "" : strtolower($_SESSION['cal_char'])) ."%'";
} else if($_SESSION['cal_sort'] < 2) {
   $constraint .= '\'';
}

#####################
#
### GET USER LIST
#
#####################
if($_SESSION['cal_sort'] < 2 && $_SESSION['cal_char']) {

   # list of users..
   if(function_exists("_ex_auth_login")) {

      if($_SESSION['cal_char'] == _ALL_) {

         $users = _ex_auth_search_users("userid", "");
  
      } else {
         $users = _ex_auth_search_users(($_SESSION['cal_sort'] == 1 ? "name" : "userid"), $_SESSION['cal_char'], true);
      }

      # sort users..
      usort($users, "_ex_sort_users");

      # get access levels
      if(count($users) > 0) {

         # get all ids
         foreach($users as $u) $ids[] = $u['id'];

         $cal_acls = $_cal_sql->query("select id, access_lvl from {$_cal_dbpref}Users where
            id in (". join(",",$ids) .")", true);

         # set access level
         for($i = 0; $i < count($users); $i++) {

            $users[$i]['access_lvl'] = $cal_acls[$users[$i]['id']]['access_lvl'];
         }

      }

   } else {
      $users = $_cal_sql->query("select * from {$_cal_dbpref}Users ". $constraint . $orderby);
      $editable = 1;
   }
} else {

   $users = array();
   $editable = (!function_exists("_ex_auth_login"));
}
?>
<br><br>
<?php


#########################
#
### AUDIT USERS HEADER
#
#########################

if($_SESSION['cal_sort'] == 3 && function_exists("_ex_auth_login")) {
   echo("<div align='center'>"._AUDIT_USERS_DESC_ ."</div><br>");
}

$form = new _cal_form("users");

if($_SESSION['cal_sort'] < 2 || ($_SESSION['cal_sort'] == 3 && !function_exists("_ex_auth_login"))) {
   $form->name = 'frmusers';
   $form->print_header();
}


require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.table.php");

$_cal_table = new _cal_table();

$cols = array(_USERNAME_,_NAME_,_EMAIL_);

if($editable)
   $cols[] = _RESET_PASS_;

$cols[] = _ROLE_;
$cols[] = "";


$_cal_table->print_header($cols);
        
     ###################
     # ADD USER
     ###################

     if($_SESSION['cal_sort'] < 2 && !function_exists("_ex_auth_login")) {

     unset($_REQUEST['new_user']);
     unset($_REQUEST['new_pass']);

     $_cal_table->print_row(
         array(
            $form->textbox('new_user', 20, " maxlength=32"),
            $form->textbox('new_name', 20, " maxlength=128"),
            $form->textbox('new_email', 20, " maxlength=128"),
            $form->textbox('new_pass', 8),
            $form->select('new_access_lvl', array(_NORMAL_,_SUPER_USER_)),
            "<input type='button' class='button' value='"._ADD_."' onClick='add_user()'>"
            ));



     ######################
     # GUEST ACCOUNT
     ######################

     } elseif($_SESSION['cal_sort'] == 2) {

        $duser = new _cal_user("", "  ", 0);
        $duser->login();



         $row = array( 

         "<font class='"._CAL_CSS_HIL_."'>".
          (!$duser->logged_in ? "<strike>"._CAL_USER_GUEST_."</strike>" : _CAL_USER_GUEST_) .
          "</font>",


           " *** ",
           " *** ");

        if($editable) 
           $row[] = " *** ";

        $row[] = " *** ";

        ob_start();
        $form->print_header();
        echo($form->fromRequest("module"));
        $form->print_hidden('user', -1);

           # DISABLE OR ENABLE
           ###################

           if(!$duser->logged_in) {
              echo($form->submit('user_action', _ENABLE_));
           } else {
              echo($form->submit('user_action', _DISABLE_));
           }
        $form->print_footer();

        $row[] = ob_get_contents();
        ob_end_clean();

        $_cal_table->print_row($row);

     


     ######################
     # ADMIN ACCOUNT
     ######################

     } elseif($_SESSION['cal_sort'] == 3 && !function_exists("_ex_auth_login")) {

        $auser = new _cal_user(_CAL_ADMIN_USER_, " ");

        $form->defaults['name'] = $auser->name;
        $form->defaults['email'] = $auser->email;

        unset($_REQUEST['pw']);
 
        $row = array(
           "<font class='cal_member_owner_1'>". _CAL_ADMIN_USER_ ."</font>",
           $form->textbox('name', 20, " maxlength=128"),
           $form->textbox('email', 20, " maxlength=128"),
           $form->textbox('pw',8),
           _SUPER_USER_,

           $form->fromRequest("module") .
           $form->hidden("user", _CAL_ADMIN_USER_) .
           $form->hidden("uid", 1) .

           $form->submit('user_action', _UPDATE_) .

           " ". $form->submit('user_action', _COLORS_));


        $_cal_table->class_opts[0] = 'cal_member_owner_1';

        $_cal_table->print_row($row);


     #######################
     # AUDIT USERS
     #######################
     } else if ($_SESSION['cal_sort'] == 3 && function_exists("_ex_auth_login")) {


        include(@constant("_CAL_BASE_PATH_") . "modules/users/audit.php");

     }


     #######################
     # USER LIST
     #######################
     
     ####################################
     #
     ## CHECK FOR CUSTOM AUTH MODULE TO GET ACCESS 
     #
     #############################################
     if(!$editable) {
        foreach($users as $u) $ids[] = $u['id'];
        if(!count($ids)) $ids = array(0);
        $cal_acl = $_cal_sql->query("select id, access_lvl from {$_cal_dbpref}Users
                        where id in (". join(",",$ids) .")", true);
     }

     $form->name = 'frmusers';

     unset($_REQUEST['pw']);

     foreach($users as $user)
     {

        if($user['id'] == 0) continue; # skip guest
        if($user['id'] == 1 && $editable) continue;

        # set defaults
        $form->defaults = array();

        while(list($k,$v) = each($user)) {
          $form->defaults[$k.'_'.$user['id']] = $v;
        }

        # for custom auth module
        if(!$editable) $form->defaults['access_lvl'] = $cal_acl[$user['id']];


        $_cal_table->class_opts[0] = 'cal_member_owner_' . $user['id'];

        $row = array(

           "<font class='cal_member_owner_". $user['id'] ."'>".$user['userid'] ."</font>",

            ($editable ? $form->textbox('name_'.$user['id'], 20, " maxlength=128") :
                        ($form->hidden('name_'.$user['id'],$user['name']) . $user['name'])),

            ($editable ? $form->textbox('email_'.$user['id'], 20," maxlength=128") :
                $form->hidden('email_'.$user['id']) .
                '<a class="'._CAL_CSS_ULINE_.'" href="mailto:'.$user['email'].'">'.$user['email'] ."</a>"),
            

         );

         if($editable)
           $row[] = $form->textbox('pw_'.$user['id'],8);

        $row[] = ($editable ? "" : $form->hidden('pw_'.$user['id'])) .$form->select('access_lvl_'.$user['id'], array(_NORMAL_,_SUPER_USER_));



        $row[] = 

           $form->hidden("user_".$user['id'], $user['userid']) .

           "<input type=button class=button value='"._UPDATE_."'
                                    onClick='upd_user(\"{$user['id']}\")'> " .

           ($editable ?  "<input type=button class=button value='"._DELETE_."'
                                    onClick='del_user(\"{$user['id']}\")'> " : "") .

           "<input type=button class=button value='"._COLORS_."'
                                    onClick='upd_colors(\"{$user['id']}\")'> ";


        $_cal_table->print_row($row);

     }


$_cal_table->print_footer();

if($_SESSION['cal_sort'] < 2 || ($_SESSION['cal_sort'] == 3 && !function_exists("_ex_auth_login"))) {
   $form->print_footer();
}
?>
<br><br>
<script language='javascript' type='text/javascript'>
<!--

if(document.forms['frmusers']) {
   var elms = document.forms['frmusers'].elements;
}

<?php 

   require_once(_CAL_BASE_PATH_."include/classes/class.url.php");
   $jurl = new _cal_url();
   $jurl->amp = '&';

   $jurl->addArg("module","users");

?>
function upd_user(uid) {


   var user = elms['user_' + uid].value;
   var name = elms['name_' + uid].value;
   var email = elms['email_' + uid].value;
   var pw = elms['pw_' + uid].value;
   var access_lvl = elms['access_lvl_' + uid].selectedIndex;

   document.location = '<?php echo($jurl->toString()) ?>&user_action=<?php echo(_UPDATE_) ?>&user=' + user + '&uid=' + uid + '&name=' + name + '&email=' + email + '&pw=' + pw + '&access_lvl=' + access_lvl;

}

function add_user()
{

   var user = elms['new_user'].value;
   var name = elms['new_name'].value;
   var email = elms['new_email'].value;
   var pw = elms['new_pass'].value;
   var access_lvl = elms['new_access_lvl'].selectedIndex;

   if(!check_name("<?php echo(_USERNAME_) ?>", elms['new_user']))
      return;

   document.location = '<?php echo($jurl->toString()) ?>&user_action=<?php echo(_ADD_) ?>&new_user=' + user + '&new_name=' + name + '&new_email=' + email + '&new_pass=' + pw + '&new_access_lvl=' + access_lvl;



}

function del_user(uid)
{

   var user = elms['user_' + uid].value;

   document.location = '<?php echo($jurl->toString()) ?>&user_action=<?php echo(_DELETE_) ?>&user=' + user + '&uid=' + uid;

}

function upd_colors(uid)
{

   var user = elms['user_' + uid].value;

   document.location = '<?php echo($jurl->toString()) ?>&user_action=<?php echo(_COLORS_) ?>&user=' + user + '&uid=' + uid;

}

-->
</script>
<?php require_once(@constant("_CAL_BASE_PATH_") . "include/js/check_name.php"); ?>
<?php


function _ex_sort_users($a,$b) { 

   if($_SESSION['cal_sort'] == 1) 
      return strcasecmp($a['name'],$b['name']);

   return strcasecmp($a['userid'], $b['userid']);
}
   
