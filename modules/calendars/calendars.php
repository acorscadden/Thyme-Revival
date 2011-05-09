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
// $Id: calendars.php,v 1.117 2007/01/25 23:00:13 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.table.php");

   global $_cal_sql, $_cal_user, $_cal_form, $_cal_owners, $_cal_cal_type, $_cal_dbpref, $_cal_obj;
  
   $_cal_sql or $_cal_sql = new _cal_sql();


   $_cal_cal_type = array(_CALENDAR_,_VIEW_NOUN_);


   if($_REQUEST['cid']) {
      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
      $_cal_obj = new _cal_obj(abs($_REQUEST['cid']));
   }

   $_cal_html->print_heading(_CALENDARS_);

   if(isset($_REQUEST['cal_char'])) { $_SESSION['cal_char'] = $_REQUEST['cal_char']; }
   else if(!$_SESSION['cal_char']) {
      $_SESSION['cal_char'] = substr($_cur_cal->title, 0, 1);
   }

   if(!$_cal_user->admin) $_SESSION['cal_sort'] = 0;

#   echo("<pre>\n"); print_r($_REQUEST); echo("</pre>\n");
#   exit;

##########################
#
## CHECK USER ACTION
#
##########################


if($_REQUEST['u_action']) {

   $_REQUEST['cals_action'] = _EDIT_;

   $where = " where cid = ". $_cal_sql->escape_string($_REQUEST['cid']) ." and rid = ".
        $_cal_sql->escape_string($_REQUEST['rid']) ."
        and rtype = ". $_cal_sql->escape_string($_REQUEST['rtype']);

} else if($_REQUEST['etype_action']) {

   $_REQUEST['cals_action'] = _EDIT_;


}


switch ($_REQUEST['u_action']) {


   #######################
   #
   ### UPDATE A MEMBER
   #
   #######################
   case _UPDATE_:

      $_cal_sql->query("update {$_cal_dbpref}CalendarMembers set access_lvl = ".
            intval($_REQUEST['access_lvl']) . $where);

      break;



   ########################
   #
   ### REMOVE A MEMBER
   #
   ########################

   case _REMOVE_:

     $_cal_sql->query("delete from {$_cal_dbpref}CalendarMembers ".$where);

     # delete any style info if it's a view
     if($_cal_obj->type == 1) {
        $_cal_sql->query("delete from {$_cal_dbpref}EventTypes where id = ".
                    $_cal_sql->escape_string($_REQUEST['rid']) ." and calendar = ". $_cal_obj->id);
     }

     break;

   case _ADD_:



     # ADD GROUP OR USER
     ######################
     $members = _cal_obj::get_members($_cal_obj);

      # make sure we don't already have this members
       foreach($members as $mem) {

          if($mem['id'] == $_REQUEST['rid'] && $_REQUEST['rtype'] == $mem['rtype']) {
             $found = 1;
             break;
          }
       }

       if($found)
          break;

        $mem = _ex_cal_add_member();

        array_push($members, $mem);
        usort($members, array('_cal_obj','_member_sort'));

     break;


   case "chown":

      if(!$_cal_user->admin) { 
         $_cal_html->permission_denied(); # fixed
         return;
      }

      $_cal_sql->query("update {$_cal_dbpref}Calendars set owner = ". $_cal_sql->escape_string($_REQUEST['rid'])
        .", request_contact = 0 where id = ". $_cal_sql->escape_string($_REQUEST['cid']));

      $_cal_obj->owner = $_REQUEST['rid'];
      
      break;

}


###############################
#
### ACTIONS PERFORMED ON CALS
#
###############################
switch(strtolower($_REQUEST['cals_action'])) 
{


   # ADD A CLANEDAR
   ###############
   case strtolower(_ADD_):



      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

      $_save_cal = new _cal_obj();

      $_save_cal->title = $_REQUEST['cal_name'];
      $_save_cal->description = $_REQUEST['cal_desc'];
      $_save_cal->type = intval($_REQUEST['ctype']);

      if($_save_cal->type == 0 && !$_cal_user->admin) {
         $_save_cal->type = 1;
      }

      if($_SESSION['cal_sort'] == 2 && $_cal_user->admin) {
         $_save_cal->owner = 0;
         $_save_cal->type = 1;
      } else {
         $_save_cal->owner = $_cal_user->id;
      }

      if(!@defined("_CAL_NEW_DEFAULT_OPTS_"))
         define("_CAL_NEW_DEFAULT_OPTS_", 77);

      if($_save_cal->type == 0) $_save_cal->options = _CAL_NEW_DEFAULT_OPTS_;

      @include(_CAL_BASE_PATH_."customize/cal_defaults_pre_save.php");

      $_save_cal->id = $_save_cal->save();

      @include(_CAL_BASE_PATH_."customize/cal_defaults_post_save.php");

      $_SESSION['cal_char'] = $_REQUEST['cal_char'] = substr($_save_cal->title,0,1);

      # Add public group by default
      ###############################
      if($_save_cal->type == 0 && $_save_cal->id) {

         $_cal_sql->query("insert into {$_cal_dbpref}CalendarMembers (cid,rid,rtype,access_lvl)
            values ({$_save_cal->id}, 0, 0, 0)");
      }

      break;


   # SAVE A CALENDAR
   ####################
   case strtolower(_SAVE_):



      require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

      $_save_cal = new _cal_obj(intval($_cal_sql->escape_string($_REQUEST['cid'])));


      # SPECIAL CASE FOR ALL CALENDARS VIEW
      #######################################
      if($_SESSION['cal_sort'] == 3 && $_cal_user->admin) {
    
         $_save_cal->type = 2;
         $_save_cal->owner = 0;

      } else if($_save_cal->not_found) {
         return;
      }

      # REGULAR CALENDARS
      ######################

      $opts = intval($_REQUEST['cal_opts_attch']);
   
      $opts += intval($_REQUEST['cal_opts_request']) * 2;

      $opts += intval($_REQUEST['cal_opts_pub']) * 4;

      $opts += intval($_REQUEST['cal_opts_sec']) * 8;

      $opts += intval(!$_REQUEST['color_by']) * 16; 

      $opts += intval($_REQUEST['cal_opts_multicat']) * 32;

      $opts += intval($_REQUEST['cal_opts_locations']) * 64;

      $opts += intval($_REQUEST['e_req_mode']) * 128;


      # SITE VIEWS
      ################
    
      $opts += intval($_REQUEST["cal_opts_allow_all_view"]);

      $opts += intval($_REQUEST["cal_opts_hide_guests"]) * 2;

      # ALL CALNEDARS VIEW
      #####################
      $opts += intval($_REQUEST['cal_all_view_enabled']);


      if(trim($_REQUEST['title']) == '') $_REQUEST['title'] = _CALENDAR_;


      # ONLY SET IF REQUESTS ARE ENABLED
      ####################################
      if($_save_cal->type == 0 && $opts & 2) {

         $msg_pre = $_REQUEST['request_pre'];
         $msg_post = $_REQUEST['request_post'];

         if($_cal_obj->owner == $_cal_user->id) {

            $notify = abs($_REQUEST['request_notify']);
            $contact = abs($_REQUEST['request_contact']); 

         } else if($_cal_user->admin) {

            $notify = abs($_REQUEST['request_notify']);
            $contact = abs($_cal_obj->request_contact);

         } else {

            $notify = abs($_cal_obj->request_notify);
            $contact = abs($_cal_obj->request_contact);
         }

      } else {
         $contact = 0;
         $notify = 0;
         $msg_pre = $msg_post = "";
      }

      $_save_cal->title = $_REQUEST['title'];
      $_save_cal->description = $_REQUEST['description'];
      $_save_cal->options = $opts;

      $_save_cal->request_pre = $msg_pre;
      $_save_cal->request_post = $msg_post;
      $_save_cal->request_notify = $notify;
      $_save_cal->request_contact = $contact;

      $_save_cal->save();


           if($_REQUEST['mc'] && $_REQUEST['cid'] != $_REQUEST['mc']) {
              $_REQUEST['cals_action']  = _EDIT_;
              $_REQUEST['cid'] = $_REQUEST['mc'];

              $_cal_obj = new _cal_obj($_save_cal->id);

              $_REQUEST['sc_action'] = 1;
           }
 
      break;


   case strtolower(_DELETE_):

        # should never get here
        if($_cal_obj->owner != $_cal_user->id && !($_cal_user->admin)) {
           $_cal_html->permission_denied(); # fixed
           return;
         }


        if($_REQUEST['really_delete']) {

           if($_cal_obj->owner != $_cal_user->id && !($_cal_user->admin)) {
              $_cal_html->permission_denied(); # fixed
              return;
           }


           # DELETE CALENDAR
           ###################
           require_once(@constant("_CAL_BASE_PATH_") . "modules/calendars/delete.php");
           delete_cal(abs($_REQUEST['cid']));

           if($_REQUEST['mc'] && $_REQUEST['cid'] != $_REQUEST['mc']) {
              $_REQUEST['cals_action']  = _EDIT_;
              $_REQUEST['cid'] = $_REQUEST['mc'];

              $_cal_obj = new _cal_obj($_REUQEST['cid']);

              $_REQUEST['sc_action'] = 1;
           }

           break;

        }

        require_once(_CAL_BASE_PATH_."include/ask_delete.php");

         $_cal_form = new _cal_form();
         $_cal_form->print_header();
         echo($_cal_form->fromRequest('cid'));
         echo($_cal_form->fromRequest("module"));
         $_cal_form->print_hidden('really_delete', 1);
         $_cal_form->print_hidden('mc');

         _ex_ask_delete(_ARE_YOU_SURE_DELETE_CALENDAR_, $_cal_obj->title, $_cal_form, 'cals_action');

         $_cal_form->print_footer();
 
      return;

   case strtolower(_CANCEL_):
   case strtolower(_CLOSE_):

      if(($_REQUEST['mc'] && $_REQUEST['cid']) && $_REQUEST['cid'] != $_REQUEST['mc']) {
         $_REQUEST['cals_action']  = _EDIT_;
         $_REQUEST['cid'] = $_REQUEST['mc'];

         $_REQUEST['sc_action'] = 1;

         $_cal_obj = new _cal_obj($_REQUEST['mc']);

      }
      break;


}


?>
<br>
<?php 

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");

   # ONLY IF WE'RE NOT EDITING
   #############################
?>
<?php if($_REQUEST['cals_action'] != _EDIT_): ?>
<?php
      require_once(_CAL_BASE_PATH_."include/classes/class.sort_table.php");

      $_cal_sort = new _cal_sort_table();
      $_cal_sort->persistent['module'] = 'calendars';
      $_cal_sort->numbers = true;
 
      #######################
      #
      ### SORT OPTIONS IF ADMIN
      #
      #######################
      if($_cal_user->admin)
      {
      
         if(isset($_REQUEST['cal_sort'])) $_SESSION['cal_sort'] = intval($_REQUEST['cal_sort']);
      

         $_cal_sort->add_section(array(_TITLE_,_OWNER_));
         $_cal_sort->add_section(array(_GLOBAL_VIEWS_, _ALL_CALENDARS_));

         ###########################
         #
         ### CUSTOM AUTH MODULES
         #
         ###########################
         $_cal_owners = $_cal_sql->query("select distinct(owner), {$_cal_dbpref}Users.name from
              {$_cal_dbpref}Calendars left join {$_cal_dbpref}Users on
                {$_cal_dbpref}Calendars.owner = {$_cal_dbpref}Users.id
              where {$_cal_dbpref}Users.id > 0 or {$_cal_dbpref}Users.id is null
                order by {$_cal_dbpref}Users.name", true);

            #####################################
            #
            ### CUSTOM AUTH MODULE
            #
            #######################################
            if(function_exists("_ex_auth_get_user")) {

               # get list of ids
               #################
               $info = _ex_auth_get_users_by_id(array_keys($_cal_owners), true);

               foreach(array_keys($_cal_owners) as $i) {

                  $_cal_owners[$i] = $info[$i]['name'];

               }


            }

      
      }
      
      #######################
      #
      ### GET CALENDAR LIST
      #
      #######################
     
      # get calendars we can admin
      if($_SESSION['cal_sort'] < 2) {

         $cals = $_cal_user->access->get_cals(2, " {$_cal_dbpref}Calendars.owner != 0 ");

      } else if($_SESSION['cal_sort'] == 2) {

         $cals = $_cal_sql->query("select * from {$_cal_dbpref}Calendars
            where type = 1 and owner = 0 order by title");
      }
    
      if(!is_array($cals)) $cals = array();

      uasort($cals,array($_cal_user->access, "csort"));
      

      ############################
      # generate charters
      ############################


      $cal_chars = array();
 
      # BY OWNER
      if($_SESSION['cal_sort'] == 1) {
      
         foreach($_cal_owners as $o)
         {
            if(!strlen($o))
               $cal_chars['_'] = 1;
            else
               $cal_chars[strtolower(substr($o,0,1))] = 1;
         }
      
      # BY CALENDAR
      } else if($_SESSION['cal_sort'] == 0) {
      
         foreach($cals as $c)
         {
            $cal_chars[strtolower(substr($c['title'],0,1))] = 1;
         }

      }

      $_cal_sort->all = true;
    
      if($_SESSION['cal_sort'] < 2) $_cal_sort->chars = $cal_chars;
      else $_cal_sort->skip_chars = true;
 
      $_cal_sort->print_table();
      
      ?>
      <br><br>

<?php endif ?>
<?php

###########################
#
### SPECIAL CASE FOR ALL CALNEDARS VIEW
#
##########################################
if($_cal_user->admin && $_SESSION['cal_sort'] == 3) {


   list($cal) = $_cal_sql->query("select id from {$_cal_dbpref}Calendars where owner = 0 and type = 2");

   $_cal_obj = new _cal_obj($cal['id']);

   if(!$_cal_obj->title) $_cal_obj->title = _ALL_CALENDARS_;

   if(!$_cal_obj->id) $_cal_obj->id = 0;
   $_cal_obj->type = 2;
   $_cal_obj->owner = 0;

   $_REQUEST['cid'] = $_cal_obj->id;
   $_REQUEST['cals_action'] = _EDIT_;
   $members = $_cal_sql->query("select * from {$_cal_dbpref}Calendars where type not in (1,2) order by lower(title)");

}


##########################
#
## EDIT CALNEDARS
#
##########################

switch ($_REQUEST['cals_action'])
{


   case _EDIT_:

       echo("<div align='center'><h3 class='"._CAL_CSS_HIL_."' style='display: inline; padding: 2px'>". $_cal_obj->title . "</h3>\n");


       if($_cal_obj->type == 3) echo("<br><br>("._MASTER_CALENDAR_.")");

       echo("</div>");
       require_once(@constant("_CAL_BASE_PATH_") . "modules/calendars/calendar_edit_tpl.php");

       return;


}


###########################
#
### LIST CALENDARS
#
###########################

$_cal_form = new _cal_form('cals');
$_cal_form->print_header();


$_cal_table = new _cal_table();

$_cal_table->align_opts = array('0' => 'left', '2' => 'left');

$cols = array(_TITLE_,_TYPE_,_DESCRIPTION_,_OWNER_);

if($_cal_user->admin && $_SESSION['cal_sort'] > 1) {
    $cols = array(_TITLE_,_DESCRIPTION_);
    $_cal_table->align_opts = array('0' => 'left', '1' => 'left');
}

$cols[] = " ";

# GLOBAL VIEW HIDDEN SPAN
##############################
if($_SESSION['cal_sort'] == 2) {
   $_cal_form->defaults['ctype'] = 1;
   echo("<span style='display: none'>".$_cal_form->select('ctype',$_cal_cal_type)."</span>");
}
 
$_cal_table->print_header($cols);


   # allow admins to add calendars...
   #######################################

   if($_cal_user->admin && $_SESSION['cal_sort'] < 2)
   {
      $ctypes = $_cal_cal_type;
   } else {
      $ctypes = array(1 => _VIEW_NOUN_);
   }

   if($_SESSION['cal_sort'] < 2) {

      $row = array(
         $_cal_form->textbox('cal_name',32,'maxlength=64'),
         $_cal_form->select("ctype", $ctypes),
         $_cal_form->textbox('cal_desc', 65, 'maxlength=255'),
      );

         $row[] =  $_cal_user->name;

   } else if($_SESSION['cal_sort'] > 1) {

      $row = array(
         $_cal_form->textbox('cal_name',32,'maxlength=64'),
         $_cal_form->textbox('cal_desc', 65, 'maxlength=255')
      );

   }

   $row[] = "<input type=button class='button' value='"._ADD_."' onClick='add_cal()'>";

   $_cal_table->print_row($row);


   # ADD OUR SUB-CALENDAR TYPE
   ############################
   $_cal_cal_type[4] = _SUB_CALENDAR_;

   # SORT BY OWNERS
   ######################3
   if($_SESSION['cal_sort'] == 1) {

      foreach(array_keys($_cal_owners) as $oid)
      {

         if($_SESSION['cal_char'] != _ALL_) {
            if($_SESSION['cal_char'] != '_') {
               if(strtolower(substr($_cal_owners[$oid],0,1)) != strtolower($_SESSION['cal_char']))
                  continue;
            } else {
               if(strlen($_cal_owners[$oid]))
                  continue;
            }
         }

         foreach($cals as $c)
         {

            if($c['owner'] != $oid) continue;

            print_cal_row($c, $_cal_table);
         }

      }

   # SORT BY CALENDAR TITLE OR GUEST CALENDARS
   ############################################
   } else {

      foreach($cals as $c)
      {

         if($_SESSION['cal_char'] == _NUMBER_SYMBOL_ && $_SESSION['cal_sort'] < 2) {

           if(array_search(strtoupper(substr($c['title'],0,1)),$GLOBALS['_cal_alphabet']) !== false)
              continue;

         } else if($_SESSION['cal_char'] != _ALL_ && $_SESSION['cal_char'] != _NUMBER_SYMBOL_) {

            if(strtolower(substr($c['title'],0,1)) != strtolower($_SESSION['cal_char']) && ($_SESSION['cal_sort'] < 2)) {
               continue;
            }

         } 


         print_cal_row($c, $_cal_table);

      }

   }

   function print_cal_row(&$c, &$t)
   {

      global $_cal_form, $_cal_owners, $_cal_user, $_cal_cal_type, $_cal_sql, $_cal_dbpref, $_cal_mc_cache;


      if(!is_array($_cal_owners)) $_cal_owners = array();

      if(!$_cal_owners[$c['owner']] && $_SESSION['cal_sort'] < 2) {

         $_cal_owners += $_cal_sql->query("select id, name from {$_cal_dbpref}Users where id = ".
            intval($c['owner']), true);


      }

      # SUB CALENDARS
      if($c['type'] == 4) {

         # get parent calendar
         list($parent_cal) = $_cal_sql->query("select name from {$_cal_dbpref}EventTypes
            where id = 0 and calendar = {$c['id']}");

         if(!$_cal_mc_cache[$parent_cal['name']]) {
            list($_cal_mc_cache[$parent_cal['name']]) = $_cal_sql->query("select title from
                {$_cal_dbpref}Calendars where id = ".intval($parent_cal['name']));
            $_cal_mc_cache[$parent_cal['name']] = $_cal_mc_cache[$parent_cal['name']]['title'];
         }

         $parent_cal = " - " . $_cal_mc_cache[$parent_cal['name']];

      } else {

         $parent_cal = "";
      }

      if($_SESSION['cal_sort'] < 2) {

         $row = array(
            $c['title'],
            $_cal_cal_type[$c['type']] . $parent_cal,
            $c['description']
         );
      
         $row[] = $_cal_owners[$c['owner']];

      } else if($_SESSION['cal_sort'] > 1) {

        $row = array(
            $c['title'],
            $c['description']);

      }

      $row[] = "<input type=button class='button' value='"._EDIT_."' onClick='edit_cal(\"".
        $c['id'] ."\")'>" .

        ($_cal_user->admin || ($_cal_user->id == $c['owner']) ?
            " <input type=button class='button' value='"._DELETE_."'
           onClick='del_cal(\"". $c['id'] ."\")'>" : "");


      $t->print_row($row);
   }


   $_cal_table->print_footer();


#####################
#
### ADD REQUESTED MEMBER
### TO REQUEST CALENDAR
#
##########################
function _ex_cal_add_member()
{

   global $_cal_sql, $_cal_dbpref;

        # add member
        ##############
        $_cal_sql->query("insert into {$_cal_dbpref}CalendarMembers values(".
           $_cal_sql->escape_string($_REQUEST['cid']) .",". $_cal_sql->escape_string($_REQUEST['rid'])
            .",". $_cal_sql->escape_string($_REQUEST['rtype']) . ",".intval($_REQUEST['access_lvl']).")");

        # add member to list..
        ########################
        if($_REQUEST['rtype'] == 0) {

           if(function_exists("_ex_auth_get_user")) {

              unset($tmp);

              $tmp->id = $_cal_sql->escape_string($_REQUEST['rid']);
              _ex_auth_get_user($tmp);

              $mem['rid'] = $tmp->id;
              $mem['name'] = $tmp->userid;
              $mem['description'] = $tmp->name;


           } else {
              list($mem) = $_cal_sql->query("select id as rid, name as description, userid as name
                    from {$_cal_dbpref}Users
                   where id = ". $_cal_sql->escape_string($_REQUEST['rid']));
           }
           unset($tmp);

        # group
        #####################
        } else if($_REQUEST['rtype'] == 1) {

           list($mem) = $_cal_sql->query("select id as rid, name , description from
                    {$_cal_dbpref}Groups where id = ". $_cal_sql->escape_string($_REQUEST['rid']));

        # add calendar
        ###################
        } else {


           list($mem) = $_cal_sql->query("select id, title, description from {$_cal_dbpref}Calendars
                where id = ". $_cal_sql->escape_string($_REQUEST['rid']));


        }

        $mem['rtype'] = $_REQUEST['rtype'];
        $mem['access_lvl'] = intval($_REQUEST['access_lvl']);

   return $mem;
}

?>
<?php $_cal_form->print_footer(); ?>
<br><br>
<script language='javascript' type='text/javascript'>

var elms = document.forms['cals'].elements;

<?php 

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");

   $jsurl = new _cal_url();
   $jsurl->amp = '&';
   $jsurl->addArg("module", "calendars");

?>
function add_cal()
{

   name = elms['cal_name'].value;
   type = elms['ctype'].options[elms['ctype'].selectedIndex].value;
   desc = elms['cal_desc'].value;

   document.location = '<?php echo($jsurl->toString()) ?>&cals_action=<?php echo(_ADD_) ?>&cal_name=' + encodeURI(name) + '&cal_desc=' + encodeURI(desc) + '&ctype=' + type;

}

function edit_cal(cid)
{

   document.location = '<?php echo($jsurl->toString()) ?>&cals_action=<?php echo(_EDIT_) ?>&cid=' + cid;
}

function del_cal(cid)
{

   document.location = '<?php echo($jsurl->toString()) ?>&cals_action=<?php echo(_DELETE_) ?>&cid=' + cid;

}

</script>
<?php require_once(@constant("_CAL_BASE_PATH_") ."include/js/check_name.php"); ?>
<?php 

# sort support function for calendar member list


function csort($a,$b)
{

   return strcasecmp($a['title'],$b['title']);
}
?>
