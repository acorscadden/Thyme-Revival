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
// $Id: groups.php,v 1.38 2006/09/03 15:00:03 root Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.group.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.table.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sort_table.php");

   global $_cal_sql, $_cal_user, $_cal_dbpref;
  
   $_cal_sql or $_cal_sql = new _cal_sql();

   # MAKE SURE WE'RE THE ADMIN USER..
   if(!$_cal_user->admin) {

      $_cal_html->permission_denied(); #fixed
      return;
   }


   $_cal_html->print_heading(_GROUPS_);

   # sort function for users
   function msort($a,$b)
   {
      $a['name'] .= " (". $a['userid'] .")";
      return strcasecmp($a['name'],$b['name']);
   } 


   #########################
   #
   ### FORM ACTIONS
   #
   #########################

   switch ($_REQUEST['group_action'])
   {

      # ADD/UPDATE GROUP
      ##############
      case _ADD_:
      case _UPDATE_:
        
         if(!$_REQUEST['name']) break;

         if(array_search(strtoupper(substr($_REQUEST['name'], 0, 1)), $GLOBALS['_cal_alphabet']) === false) {
            echo("<h4 align=center>"._NAME_." "._MUST_BEGIN_WITH_CHAR_."</h4><br>\n");
            break;
         }
 
         $g = new _cal_group($_REQUEST['gid']);
         $g->name = $_REQUEST['name'];
         $g->description = $_REQUEST['description'];
         if(!$g->save())
             echo("Error saving group!\n");


         $_SESSION['cal_char'] = strtoupper(substr($g->name, 0, 1));
         
         break;



      # SAVE MEMBERS
      ################
      case _SAVE_:

        $ulist = rtrim($_cal_sql->escape_string($_REQUEST['users_hidden']), ',');

        # make sure we have some members..
        if(strlen($ulist) == 0) {

           echo("<h4 align='center'>". _GROUPS_SAVE_ATLEAST_1_MEMBER_ ."</h4><br>");

           break;
        }

        # DELETE FROM CURRENT LIST
        ##########################
        $_cal_sql->query("delete from {$_cal_dbpref}GroupMembers
                where gid = ". $_cal_sql->escape_string($_REQUEST['gid']) .' and uid not in ('. $ulist .')');


        # GET CURRENT LIST
        ###################
        $cur_users = $_cal_sql->query("select uid, 1 from {$_cal_dbpref}GroupMembers where gid = ".
             $_cal_sql->escape_string($_REQUEST['gid']), 1);

 
        # USERS..
        #############
        foreach(explode(',',$ulist) as $u)
        {
           if(!$u || isset($cur_users[$u])) continue;

           $_cal_sql->query("insert into {$_cal_dbpref}GroupMembers (gid, uid)
                values (". $_cal_sql->escape_string($_REQUEST['gid']) .",". $u .")");
        }

        break;


     # DELETE GROUP
     ##############
    case _DELETE_:

       if($_REQUEST['really_delete']) {

          $_cal_sql->query("delete from {$_cal_dbpref}Groups where id = ". $_cal_sql->escape_string($_REQUEST['gid']));
          $_cal_sql->query("delete from {$_cal_dbpref}GroupMembers where gid = ". $_cal_sql->escape_string($_REQUEST['gid']));

          # delete from calendar member list
          $_cal_sql->query("delete from {$_cal_dbpref}CalendarMembers where rid = ".
                $_cal_sql->escape_string($_REQUEST['gid']) ." and rtype = 1");

          break;

       } else {

         require_once(_CAL_BASE_PATH_."include/ask_delete.php");

         

         $form = new _cal_form();
         $form->print_header();
         echo($form->fromRequest('gid'));
         echo($form->fromRequest("module"));
         $form->print_hidden('really_delete', 1);

         _ex_ask_delete(_ARE_YOU_SURE_DELETE_GROUP_, $_REQUEST['name'], $form, 'group_action');

         $form->print_footer();

         return;

       }


}
   # create form object..
   $form = new _cal_form('groupsform');


$_cal_sort = new _cal_sort_table();

# generate list of users..
require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");


$_cal_sort->persistent["module"] = 'groups';
$_cal_sort->all = true;

?>
<?php

#######################
#
### CHARACTER OPTIONS
#
#######################
$gnames = $_cal_sql->query("select distinct lower(".$_cal_sql->functions['substr']."(".
    "name,1,1)) as g, '1' from {$_cal_dbpref}Groups", 1);

if(isset($_REQUEST['cal_char'])) $_SESSION['cal_char'] = $_REQUEST['cal_char'];

$_cal_sort->chars = $gnames;

$_cal_sort->print_table();

if(strlen($_SESSION['cal_char'])) {
   $constraint = 'where lower(name) like \''.
    ($_SESSION['cal_char'] == _ALL_ ? "" : strtolower($_SESSION['cal_char'])) ."%'";
} else  {
   $constraint .= 'where lower(name) = \'\'';
}

?>
<br>
<?php 

###################################
#
### GROUP MEMBER MANIPULATION
#
###################################

?>
<?php if($_REQUEST['group_action'] == _MEMBERS_): ?>
<?php
   list($group) = $_cal_sql->query("select * from {$_cal_dbpref}Groups where id = ".
    $_REQUEST['gid']);

   $form->print_header();

   echo($form->fromRequest('module'));
   echo($form->fromRequest('gid'));


   ###########################
   #
   ### EXTERNAL AUTH MODULE
   #
   ###########################
   $ulist = $_cal_sql->query("select uid, {$_cal_dbpref}Users.name, {$_cal_dbpref}Users.userid
        from {$_cal_dbpref}GroupMembers
        left join {$_cal_dbpref}Users on {$_cal_dbpref}Users.id  = {$_cal_dbpref}GroupMembers.uid
        where {$_cal_dbpref}GroupMembers.uid > 0 and {$_cal_dbpref}GroupMembers.gid = ". $_REQUEST['gid']);

   #####################################
   #
   ### CUSTOM AUTH MODULE
   #
   #######################################
   if(function_exists("_ex_auth_get_user")) {

      # get list of ids
      #################
      foreach($ulist as $u) $ids[] = $u['uid'];

      $info = _ex_auth_get_users_by_id($ids, true);

      for($i = 0; $i < count($ulist); $i++) {

         if(!is_array($info[$ulist[$i]['uid']])) continue;

            $ulist[$i]['name'] = $info[$ulist[$i]['uid']]['name'];
            $ulist[$i]['userid'] = $info[$ulist[$i]['uid']]['userid'];

      }


  }


?>
<div align='center'><?php echo(_MEMBERS_OF_ ." ". $group['name']) ?></div>
<table cellspacing=4 align=center width='100%'>
<tr>
   <td>
   <table border=1 align=center cellpadding=4 class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." ".
    _CAL_CSS_CAL_CONTENT_)?>'>
   <tr>
   <th align=center>
<?php


   echo(_USERS_."<br>");

   if(is_array($ulist)) usort($ulist, "msort");
 
   $tmparr = $ulist;
   unset($ulist);

   foreach($tmparr as $u)
   {
      $ulist[$u['uid']] = $u['name'] ." (". $u['userid'] .")";
   }
   unset($tmparr);
?>
   </th>

   </tr>
   <tr>
   <td align='center'>
      <?php echo($form->mselect_h('users', $ulist,12,'style="width: 20em"')); ?>
   </td>

   </tr>

   <tr>
    <td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
    <input type="button" class="<?php echo(_CAL_CSS_BUTTON_) ?>" value="<?php echo(_ADD_) ?>" onClick="add_user('users')">
    <input type="button" class="<?php echo(_CAL_CSS_BUTTON_) ?>" value="<?php echo(_REMOVE_) ?>" onClick="remove_user('users')">
    </td>

   </tr>

<tr class='<?php echo(_CAL_CSS_TOOLBAR_) ?>'>
   <td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center' colspan=1>
   <?php echo($form->submit('group_action', _SAVE_)); ?>
   </td>
</tr>

   </table>
   </td>
</tr>
</table>
<?php
   $form->print_footer();
?>
<?php require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js"); ?>
<script language='javascript' type='text/javascript'>

// User Functions
function add_user(selname)
{
   <?php 
      $url = new _cal_url("modules/groups/pick_users.php");
      $url->addArg('form', $form->name);
      echo('var url = \''. $url->toString() ."&selname=' + selname;\n");
   ?>
   newWin(url, 500, 300);

}

function remove_user(selname)
{

   var optlen = document.<?php echo($form->name) ?>.elements[selname].options.length;


   for(i = 0; i < document.<?php echo($form->name) ?>.elements[selname].options.length; i++)
   {

      if(document.<?php echo($form->name) ?>.elements[selname].options[i].selected)
      {
         document.<?php echo($form->name) ?>.elements[selname].options[i] = null;
      }
   }


}

function add_user_to_select(name, uid, selname)
{

   var optlen = document.<?php echo($form->name) ?>.elements[selname].options.length;


   for(i = 0; i < document.<?php echo($form->name) ?>.elements[selname].options.length; i++)
   {

      if(document.<?php echo($form->name) ?>.elements[selname].options[i].value == uid)
         return;
   }

   document.<?php echo($form->name) ?>.elements[selname].options[optlen++] = new Option(name, uid);


}


</script>
<?php else: ?>
<?php

###########################
#
### LIST GROUPS
#
##########################

# list of groups..
$groups = $_cal_sql->query("select * from {$_cal_dbpref}Groups ". $constraint . ' order by name');
$counts = $_cal_sql->query("select gid, count(*) from {$_cal_dbpref}GroupMembers group by gid", true);

$form = new _cal_form("groupfrm");
$form->print_header();
echo($form->fromRequest("module"));

$_cal_table = new _cal_table();

$_cal_table->print_header(array(_NAME_,_DESCRIPTION_,_MEMBERS_, ""));

     ###################
     # ADD GROUP
     ###################


     $_cal_table->print_row(array(
           $form->textbox('name', 20, " maxlength=128"),
            $form->textbox('description', 40, " maxlength=255"),
           " &nbsp; ",
           "<input type=button class='button' value='"._ADD_."' onClick='add_group()'>"
           )
     );


     #######################
     # USER LIST
     #######################
 
     foreach($groups as $group)
     {


        # set defaults

        $form->defaults = array();
     
        $form->defaults['name_'.$group['id']] = $group['name'];
        $form->defaults['description_'.$group['id']] = $group['description'];

        $_cal_table->print_row(
           array(
              $form->textbox('name_'.$group['id'], 20, " maxlength=128"),
              $form->textbox('description_'.$group['id'], 40, " maxlength=255"),
              intval($counts[$group['id']]),

              "<input type=button class='button' value='"._UPDATE_."'
                    onClick='upd_grp(\"".$group['id']."\")'> " .
              "<input type=button class='button' value='"._MEMBERS_."'
                    onClick='mem_grp(\"".$group['id']."\")'> " .
              "<input type=button class='button' value='"._DELETE_."'
                    onClick='del_grp(\"".$group['id']."\")'>" 
           )

        );


     }


   $_cal_table->print_footer();

?>
<?php $form->print_footer(); ?>
<?php endif ?>
<script language='javascript' type='text/javascript'>

if(document.forms['groupfrm']) {
   var elms = document.forms['groupfrm'].elements;
}

<?php

   require_once(_CAL_BASE_PATH_."include/classes/class.url.php");

   $jurl = new _cal_url();
   $jurl->amp = '&';
   $jurl->addArg("module","groups");

?>
function upd_grp(gid)
{

   var elms = document.forms['groupfrm'].elements;

   if(!check_name("<?php echo(_NAME_) ?>", elms['name_' + gid])) return;

   var name = elms['name_' + gid].value;
   var description = elms['description_' + gid].value;

   document.location = '<?php echo($jurl->toString()) ?>&name=' + name + '&description=' + description + '&group_action=<?php echo(_UPDATE_) ?>&gid=' + gid;

}

function mem_grp(gid)
{

   var elms = document.forms['groupfrm'].elements;

   var name = elms['name_' + gid].value;
   var description = elms['description_' + gid].value;

   document.location = '<?php echo($jurl->toString()) ?>&name=' + name + '&description=' + description + '&group_action=<?php echo(_MEMBERS_) ?>&gid=' + gid;

}


function del_grp(gid)
{

   var elms = document.forms['groupfrm'].elements;

   var name = elms['name_' + gid].value;
   var description = elms['description_' + gid].value;

   document.location = '<?php echo($jurl->toString()) ?>&name=' + name + '&description=' + description + '&group_action=<?php echo(_DELETE_) ?>&gid=' + gid;
}

function add_group()
{

   var elms = document.forms['groupfrm'].elements;

   if(!check_name("<?php echo(_NAME_) ?>", elms['name'])) return;

   var name = elms['name'].value;
   var description = elms['description'].value;

   document.location = '<?php echo($jurl->toString()) ?>&name=' + name + '&description=' + description + '&group_action=<?php echo(_ADD_) ?>';
}

</script>
<br><br>
<?php require_once(@constant("_CAL_BASE_PATH_") ."include/js/check_name.php") ?>
