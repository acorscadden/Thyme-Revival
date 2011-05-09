<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 eXtrovert Software and Thymenews                  |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@thymenews.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: addr_book.php,v 1.7 2009/01/07 22:59:16 ian Exp $
//

   error_reporting(E_ALL ^ (E_NOTICE));

   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);

   require_once(dirname(__FILE__) ."/include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");

   $_REQUEST['callback'] = preg_replace('#[^A-z0-9_-]#','',$_REQUEST['callback']);

   global $_cal_sql, $_cal_user, $_cal_html;

   error_reporting(E_ALL ^ E_NOTICE);
  
   $_cal_sql or $_cal_sql = new _cal_sql();
   $_cal_html or $_cal_html = new _cal_html();

   $_cal_html->print_header();

   # MAKE SURE WE'RE THE ADMIN USER..
   if(!$_cal_user->admin && (@constant("_CAL_DISABLE_ADDR_BOOK_"))) {

      $_cal_html->permission_denied(false); # fixed
      return;
   }

   $form = new _cal_form();


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
echo($form->fromRequest('callback'));

echo(" ". $form->submit('',_SEARCH_));

$form->print_footer();

#####################
#
### GET USER LIST
#
#####################

if(strlen($_REQUEST['uname_search'])) {


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

      $users = $_cal_sql->query("select id, name, email from {$GLOBALS['_cal_dbpref']}Users ".
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
      <th><?php echo(_NAME_) ?></th>
      <th><?php echo(_EMAIL_) ?></th>
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

        echo("<td align='center'>". $user['name'] ."</td>");

        echo("<td align='center'>". $user['email'] ."</td>");

        echo("<td align='center' class='"._CAL_CSS_TOOLBAR_."'>");

        echo("<input type='button' class='"._CAL_CSS_BUTTON_."' value='". _ADD_."'
            onClick='add_user(\"". $user['name'] ."\",\"". $user['email'] ."\", {$user['id']}, this)'>"); 

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
<script language='javascript' type='text/javascript'>

document.forms[0].uname_search.focus();


function add_user(name, email, uid, btn)
{

   window.opener.<?php echo($_REQUEST['callback']) ?>(name, email);
   document.getElementById('row' + uid).style.textDecoration = 'line-through';
   btn.enabled = false;
   btn.disabled = true; 
}

</script>
<?php

$_cal_html->print_footer();
?>
