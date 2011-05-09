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
// $Id: pick_users.php,v 1.32 2008/12/18 19:48:04 ian Exp $
//

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.groups$/","",dirname(__FILE__));

   define("_CAL_BASE_PATH_", $BASE_PATH);
   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");

   global $_cal_sql, $_cal_user, $_cal_html;
  
   $_cal_sql or $_cal_sql = new _cal_sql();
   $_cal_html or $_cal_html = new _cal_html();

   $_cal_html->print_header();

   $form = new _cal_form();

   $_REQUEST['uname_search'] = $_cal_sql->escape_string($_REQUEST['uname_search']);

   $_REQUEST['callback'] = preg_replace('#[^A-z0-9_-]#','',$_REQUEST['callback']);

?>
<table width='100%'>
<tr>
<td>
<br><br>
<table cellpadding=8 cellspacing=0
    align='center' class='<?php echo(_CAL_CSS_SPACED_TABLE_) ?>' style='border: 2px solid'>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'>
<td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' style='padding: 4px'>
<?php

# generate list of users..
require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");


# start sql constraint and order for query below
#$constraint = ' where ';


$form->print_header();

echo($form->textbox('uname_search', 20));
echo($form->fromRequest('form'));
echo($form->fromRequest('selname'));
echo($form->fromRequest('callback'));

echo(" ". $form->submit('',_SEARCH_));



#####################
#
### GET USER LIST
#
#####################

if(!@constant("_CAL_NO_LIST_ALL_") || strlen($_REQUEST['uname_search'])) {


   ##########################
   #
   ### CUSTOM AUTH MODULE
   #
   ###########################
   # list of users..
   $_REQUEST['uname_search'] = strtolower($_REQUEST['uname_search']);

   if(function_exists("_ex_auth_login")) {

      $users = _ex_auth_search_users(false, $_REQUEST['uname_search']);

   } else {

      $constraint = 'where lower(name) like \'%'. $_REQUEST['uname_search'] .'%\'
           or lower(userid) like \'%'. $_REQUEST['uname_search'] .'%\'';

      $users = $_cal_sql->query("select id, userid, name from {$GLOBALS['_cal_dbpref']}Users ".
        $constraint . $orderby);
   }


} else {
   $users = array();
}

?>

</td>
</tr>
</table>
<br><br>
<table cellspacing=4 align=center width='100%'>
<tr>
   <td align=center>
   <table border=1 align=center cellpadding=4 class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." ".
    _CAL_CSS_CAL_CONTENT_) ?>'>
   <tr>
      <th><?php echo(_USERNAME_) ?></th>
      <th><?php echo(_NAME_) ?></th>
      <th> </th>
   </tr>
<?php

     #######################
     # USER LIST
     #######################
 
     foreach($users as $user)
     {

        if($user['id'] == 0) continue;
        if($user['id'] == 1 && !function_exists("_ex_auth_login")) continue;

        echo("<tr id='row". $user['id'] ."'>\n");

        echo("<td align='center'>". $user['userid'] ."</td>");

        echo("<td align='center'>". $user['name'] ."</td>");

        echo("<td align='center' class='"._CAL_CSS_TOOLBAR_."'>");

        echo("<input type='button' class='"._CAL_CSS_BUTTON_."' value='". _ADD_."'
            name='button_{$user['id']}' onClick='add_user(\"". str_replace('"','\"',$user['name']) ."\",". $user['id'] .")'>"); 

        echo("
              </td>");
        echo("</tr>");

     }


?>
   </table>
   </td>
</tr>
</table>
<br><br>

   </td>
</tr>
<tr class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
   <td>
   <input type='button' class='<?php echo(_CAL_CSS_BUTTON_) ?>' onClick='self.close()' value='<?php echo(_CLOSE_) ?>'>
   </td>
</tr>
</table>
<?php $form->print_footer(); ?>
<script language='javascript' type='text/javascript'>

document.forms[0].uname_search.focus();


function add_user(name, uid)
{

   <?php if($_REQUEST['callback']): ?>
   window.opener.<?php echo($_REQUEST['callback']) ?>(uid, name);
   <?php else: ?>
   window.opener.add_user_to_select(name, uid, "<?php echo($_REQUEST['selname']) ?>");
   <?php endif ?>
   document.getElementById('row' + uid).style.textDecoration = 'line-through';
   document.forms[0].elements['button_' + uid].disabled = true;


}

</script>
<?php

$_cal_html->print_footer();
?>
