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
// $Id: day_conflicts.php,v 1.17 2008/12/18 19:45:11 ian Exp $
//

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.common_files$/","",dirname(__FILE__));

   define("_CAL_BASE_PATH_", $BASE_PATH);
   define("_CAL_BENCHMARK_", 0);
   define("_CAL_URL_PERSISTENT_", 1);

   global $_cal_user, $_cal_months, $_cal_sql, $_cal_theme;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.calendar.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");


   # grab user's theme..
   ####################
   $s = new _cal_session();
   $s->start(true);
   $u = new _cal_user("","",$_SESSION['uid']);
   $_cal_user->logged_in = true;
   $theme = $u->options->theme;
   $calendar = $_SESSION['calendar'];
   $s->stop();

   unset($_SESSION['v']);


   $_cal_html = new _cal_html(true);
   $_cal_user = &$u;
   _ex_theme_set($theme);
   $_cal_html->print_header();

   $_REQUEST['callback'] = preg_replace('#[^A-z0-9_-]#','',$_REQUEST['callback']);

   echo("<div align='center'>\n");

   $form = new _cal_form("date_picker");
   $form->print_header();

   $cal = new calendar($_REQUEST['y'],$_REQUEST['m'],$_REQUEST['d']);

   $_cal_user = &$u;

   $cal->set("show_events", (!isset($_REQUEST['h'])));
   $cal->set("hil_day", 0);
   $cal->set("hil_week", false);
   $cal->set("theme", $theme);
   $cal->set("show_header_links", true);

   $cal->set("event_view_url","");
   $cal->set("event_add_url", "javascript:return_date(%d,%m,%y,%h,'".
          $_REQUEST['form'] ."','". $_REQUEST['elm'] ."', '". $_REQUEST['wday_lbl'] ."')");

   $cal->set("calendar", $calendar);

   $cal->set("editable", true);

   $cal->set("static", false);

   $cal->set("event_links", false);

   $cal->register_persistent("conflicts", 1);
   $cal->register_persistent("form", $_REQUEST['form']);
   $cal->register_persistent("elm", $_REQUEST['elm']);
   $cal->register_persistent("wday_lbl", $_REQUEST['wday_lbl']);
 
   echo("<style type='text/css'>
        #custom td.heading { height: 24px; font-size: 12px; }
        #custom font.heading { font-size: 12px; }
        #custom a:link, #custom a:visited { text-decoration: underline; font-weight: bold; }
        #custom .cal_event_type_add_ { background: #f00; color: #fff; }
   </style>\n");


   echo("<div id='custom'>\n");
   $cal->display_day();
   echo("</div>");


   echo("<div align='center'>\n");

   #################
   # date select boxes
   #################

   $url = new _cal_url("modules/common_files/date_picker.php");
   $url->addArg("y", $cal->year);


   $form->defaults["m"] = $cal->mon;
   $form->defaults["y"] = $cal->year;

   # month 
   echo("<br>");
   echo($form->select("m", $_cal_months, "
	onChange=\"document.location.href = '".
	$url->toString() .
	'&m=\' + this.options[this.selectedIndex].value"')); 
   echo(" ");


   # years

   for($i = $cal->year -1; $i < $cal->year + 3; $i++)
   {
      $tmparr[$i] = $i;
   }

   $url->addArg("y","");
   $url->addArg("m", $cal->mon);
 
   echo($form->select("y", $tmparr, "
        onChange=\"document.location.href = '".
        $url->toString() .
        '&y=\' + this.options[this.selectedIndex].value"'));



   $form->print_footer(); 

?>
</div>
<script language='JavaScrypt' type='text/javascript'>


function return_date(d,m,y,h,form,elm,wda_lbl)
{

   window.opener.document.forms['<?php echo($_REQUEST['form']) ?>'].elements['starttime_hr'].value = h;

   return_date_real(d,m,y,form,elm,wda_lbl);

}

<?php if($_REQUEST['callback']): ?>

function return_date_real(d,m,y,no,not,none)
{

   window.opener.<?php echo($_REQUEST['callback']) ?>(y,m,d);


<?php else: ?>

function return_date_real(d,m,y,form,elm,wda_lbl)
{

   <?php if($_REQUEST['conflicts']): ?>


   <?php endif ?>

   window.opener.document.forms[form].elements[elm + '_da'].value = d;
   window.opener.document.forms[form].elements[elm + '_mo'].value = m;

   // if the year doesn't exist we're going to have to add it..
   var opts = window.opener.document.forms[form].elements[elm + '_yr'].options;
   var found = false;

   for(i = 0; i < opts.length; i++)
   {
     if(opts[i].value == y) {
        found = true;
        break;
     }
   }

   if(!found)
   { 
      window.opener.add_yr(elm, y);
   }

   window.opener.document.forms[form].elements[elm + '_yr'].value = y;
   window.opener.setWeekday(elm);

<?php endif ?>

   self.close();
}
</script>
</div>
<?php
   $_cal_html->print_footer();
?>
