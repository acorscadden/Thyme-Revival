<br>
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
// $Id: reset_pass.php,v 1.11 2006/03/13 00:28:31 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

   $_cal_form = new _cal_form();

   $_cal_html->print_heading(_RESET_PASS_);


switch($_REQUEST['pass_action'])
{

   case _UPDATE_:

      if($_REQUEST['p1'] != $_REQUEST['p2'])
      {
         echo("<h3>". _PASS_MUST_MATCH_ ."</h3>\n");

      } else if(strlen($_REQUEST['p1']) < 1) {

         echo("<h3>". _EMPTY_PASSWORD_ ."</h3>\n");

      } else {

         require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
         global $_cal_sql;

         $_cal_sql or $_cal_sql = new _cal_sql();

         $query = "update {$GLOBALS['_cal_dbpref']}Users set pass = '". md5($_REQUEST['p1']) ."'
            where userid = '". $GLOBALS['_cal_user']->userid ."'";

         if(!$_cal_sql->query($query)) {

            echo("<h3>". _ERROR_ .": modules/options/reset_pass.php - ". _RESET_PASS_ ."</h3>\n");

         } else {

            require_once(@constant("_CAL_BASE_PATH_"). "include/classes/class.url.php");

            $_SESSION['pass'] = md5($_REQUEST['p1']);
            echo("<h3>"._UPDATED_."</h3>\n");

            $url = new _cal_url();
            $_cal_html->js_redirect($url->toString());
            return;
         }

      }

}

?>
<br><br>
<table cellspacing=4 cellpadding=4 align=center width='100%'>
<tr>
   <?php
      $_cal_form->print_header();
      echo($_cal_form->fromRequest("module"));
      $_cal_form->print_hidden("option_action", 'pass');
    ?>
   <td align=center>
   <table border=1 align=center cellpadding=4 class='<?php echo(_CAL_CSS_SPACED_TABLE_) ?>'>
   <tr>
   <th colspan=2><?php echo(_RESET_PASS_) ?></td>
   </tr>

   <tr>
   <td align='right'><?php echo(_NEW_PASS_) ?>:</td>
   <td align='left'> <input name="p1" type=password size=32></td>
   </tr>

   <tr>
   <td align='right'><?php echo(_RETYPE_) ?>:</td>
   <td align='left'> <input name="p2" type=password size=32></td>
   </tr>

   <tr>
      <td colspan=2 class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align="center"><?php echo($_cal_form->submit("pass_action",_UPDATE_)) ?></td>
   </tr>

   </table>
   </td>
</tr>
</table>
<?php $_cal_form->print_footer() ?>
