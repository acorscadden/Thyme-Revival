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
// $Id: add_members.php,v 1.29 2009/01/17 17:15:42 ian Exp $
//

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.common_files$/","",dirname(__FILE__));


   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);
   require_once($BASE_PATH."include/config.php");


   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

   global $_cal_sql, $_cal_html, $_cal_dbpref;
  
   $_cal_sql or $_cal_sql = new _cal_sql();
   $_cal_html or $_cal_html = new _cal_html();

   $_cal_html->print_header();

   $_cal_form = new _cal_form();

   $_REQUEST['callback'] = preg_replace('#[^A-z0-9_-]#','',$_REQUEST['callback']);

?>
<table width='100%'>
<tr>
<td>
<br><br>
<table cellpadding=8 cellspacing=0
    align='center' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' style='border: 2px solid'>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'>
<td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' style='padding: 4px'>
<?php

require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");



$_cal_form->print_header();

echo($_cal_form->textbox('name_search', 20));
echo($_cal_form->fromRequest('form'));
echo($_cal_form->fromRequest('callback'));
echo($_cal_form->fromRequest('uo'));
$_cal_form->print_hidden('noguest');

echo(" ". $_cal_form->submit('', _SEARCH_));

$_cal_form->print_footer();

#####################
#
### GET USER LIST
#
#####################

if(!@constant("_CAL_NO_LIST_ALL_") || ($_REQUEST['name_search'])) {
   # list of members..
   $_REQUEST['name_search'] = strtolower($_REQUEST['name_search']);

   $constraint = 'where (lower(name) like \'%'. $_REQUEST['name_search'] .'%\'
        or lower(description) like \'%'. $_REQUEST['name_search'] .'%\')';

   if(!$_REQUEST['uo']) {
      $groups = $_cal_sql->query("select id, name, description, 1 as rtype from {$_cal_dbpref}Groups ". $constraint);
      $groups = array_merge(
        array( 0 => array('id' => 0,'name' => _REGISTERED_USERS_,'description' => _REGISTERED_USERS_,'rtype' => 1)),$groups);
   } else {
      $groups = array();
   }

   ################################
   #
   ### CUSTOM AUTH MODULE
   #
   ################################
   if(function_exists("_ex_auth_search_users")) {

      $users = _ex_auth_search_users(false, $_REQUEST['name_search'],false);

      for($i = 0; $i < count($users); $i++)
      {
         $users[$i]['description'] = $users[$i]['name'];
         $users[$i]['name'] = $users[$i]['userid'];
         $users[$i]['rtype'] = 0;
      }

   } else {
      $users = $_cal_sql->query("select id, userid as name, name as description, 0 as rtype
        from {$_cal_dbpref}Users where (lower(name) like '%". $_REQUEST['name_search'] ."%' or
        lower(userid) like '%". $_REQUEST['name_search'] ."%') and id > 0");
   }
  
   if($_REQUEST['callback'] != 'chown_submit' && !$_REQUEST['noguest']) {
      $guest_uid = 0;
      $users[] = array("id"=>$guest_uid, "name"=>_PUBLIC_, "description"=>_PUBLIC_, "rtype"=>0);
   } 

   $members = array_merge($users,$groups);

   usort($members, "msort");

} else {
   $members = array();
}

?>

</td>
</tr>
</table>
<br><br>
<?php

require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.table.php");

$_cal_table = new _cal_table();

if($_REQUEST['uo'])
   $_cal_table->print_header(array(_NAME_,_USERNAME_,""));
else
   $_cal_table->print_header(array(_USERNAME_,_NAME_,""));

$_cal_table->align_opts[0] = $_cal_table->align_opts[1] = 'left';

     #######################
     # USER LIST
     #######################

     $uimg = $_cal_html->get_img_url("images/user.gif");
     $gimg = $_cal_html->get_img_url("images/groups.gif");

     # special case for public
 
     foreach($members as $mem)
     {

        # special case for public

        $_cal_table->print_row(
            array("<img width=16 height=16 src='".
              (($mem['rtype'] || $mem['id'] == 0 && $mem['rtype'] == 0) ? $gimg : $uimg) ."'> ".  $mem['name'],
            $mem['description'],

            "<input type=button class='button' value='".
            ($_REQUEST['uo'] ? _CHANGE_ : _ADD_)
            ."' onClick='add_member(". $mem['id'] .",". $mem['rtype'] .", \"". 
                str_replace('"','',$mem['name']) ."\",\"". str_replace('"','',$mem['description']) .
                "\", this)'>"
            ) 
        );

     }


$_cal_table->print_footer();
?>
<br><br>

   </td>
</tr>
<tr class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
   <td>
   <input type='button' class='<?php echo(_CAL_CSS_BUTTON_) ?>' onClick='self.close()' value='<?php echo(_CLOSE_) ?>'>
   </td>
</tr>
</table>
<script language='javascript' type='text/javascript'>

document.forms[0].name_search.focus();

function add_member(id, rtype, name, desc, btn)
{

   window.opener.<?php echo($_REQUEST['callback']) ?>(id, rtype, name, desc);

   <?php if($_REQUEST['uo']): ?>
   self.close();
   <?php else: ?>
   btn.disabled = true;
   <?php endif ?>
}

</script>
<?php

$_cal_html->print_footer();

# sort support function for calendar member list

function msort($a,$b)
{

  return strcasecmp($a['name'],$b['name']);


}

?>
