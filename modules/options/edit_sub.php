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
// $Id: edit_sub.php,v 1.18 2008/12/18 19:50:56 ian Exp $
//

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.options$/","",dirname(__FILE__));
   
   require_once($BASE_PATH.'include/config.php');

   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);
   define("_CAL_DOING_OPTS_", 1);

   global $_cal_sql, $_cal_user, $_cal_html, $_cal_form, $_cal_dbpref, $_cur_cal;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");


   $_REQUEST['callback'] = preg_replace('#[^A-z0-9_-]#','',$_REQUEST['callback']);

   $_cal_sql or $_cal_sql = new _cal_sql();
   $_cal_html or $_cal_html = new _cal_html();

   $_cal_form = new _cal_form("subform");
 
   $_cal_html->print_header(_SUBSCRIPTIONS_);

   $_cal_form->print_header();

   list($s) = $_cal_sql->query("select * from {$_cal_dbpref}Notifications
	left join {$_cal_dbpref}Calendars on {$_cal_dbpref}Calendars.id = {$_cal_dbpref}Notifications.cid
	where {$_cal_dbpref}Notifications.id = ". $_REQUEST['sid']);


   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
   $_cur_cal or $_cur_cal = new _cal_obj(abs($s['cid']));

   $etypes = $_cur_cal->get_categories();

   $emails = array(0=>$_cal_user->email) +  $_cal_sql->query("select id, email from {$_cal_dbpref}ContactOpts where uid = ". $_cal_user->id, true);

?>
<script language="javascript" type="text/javascript">


function sub_form (act)
{

   var frm = document.forms['<?php echo($_cal_form->name) ?>'];

   window.opener.<?php echo($_REQUEST['callback'] ."(" .$_REQUEST['sid']) ?>, act, frm.elements['name'].value, frm.elements['etype'].value, frm.elements['titlecontains'].value, frm.elements['contact'].value);

   self.close();


}

</script>
<table cellspacing=4 align=center width='100%'>
<tr>
   <td align=center>
   <table border=1 align=center cellpadding=4 class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." ".
        _CAL_CSS_CAL_CONTENT_) ?>'>
   <tr>
    <th><?php echo(_NAME_) ?></th>
    <th><?php echo(_CALENDAR_) ?></th>
    <th><?php echo(_EVENT_TYPE_) ?></th>
    <th><?php echo(_TITLE_CONTAINS_) ?></th>
    <th><?php echo(_CONTACT_) ?></th>
   </tr>
<?php

      $_cal_form->defaults = $s;

      echo("<tr>\n");

         echo("<td>". $_cal_form->textbox('name', 32, "maxlength=32") ."</td>\n");
         echo("<td>". $s['title'] . "</td>\n");
         echo("<td>". $_cal_form->select("etype", array(_ALL_) + $etypes) ."</td>\n");
         echo("<td>". $_cal_form->textbox('titlecontains', 32, "maxlength=32") ."</td>\n");
         echo("<td>". $_cal_form->select("contact", $emails) ."</td>\n");

      echo("</tr>\n");


      echo("<tr><td colspan=5 class='"._CAL_CSS_TOOLBAR_."' align='center'>\n");
      echo("<input type=button value='". _SAVE_ ."' onClick=\"sub_form('save')\" class='"._CAL_CSS_BUTTON_."'> &nbsp; &nbsp; &nbsp; 
		<input type=button class='"._CAL_CSS_BUTTON_."' onClick=\"sub_form('delete')\" value='". _DELETE_ ."'> &nbsp; &nbsp; &nbsp;
        <input type=button class='"._CAL_CSS_BUTTON_."' onClick=\"self.close()\" value='"._CANCEL_."'>");

      echo("</td></tr>\n"); 


?>
   </table>
  </td>
</tr>
</table>
<?php
   $_cal_form->print_footer();
   $_cal_html->print_footer();
?>
