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
// $Id: date_picker.php,v 1.42 2008/12/18 19:40:38 ian Exp $
//

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.common_files$/","",dirname(__FILE__));

   define("_CAL_BASE_PATH_", $BASE_PATH);
   define("_CAL_BENCHMARK_", 0);
   define("_CAL_URL_PERSISTENT_", 1);
   define("_CAL_INTERFACE_MAIN_", 0);

   global $_cal_user, $_cal_months, $_cal_sql, $_cal_theme, $_cal_html, $_cur_cal;

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


   $_cal_form = new _cal_form("date_picker");
   $_cal_form->print_header();

   $cal = new calendar($_REQUEST['y'],$_REQUEST['m'],1);

   $cal->set("width", 200);

   $cal->set("show_events", $_REQUEST['conflicts']);

   $cal->set("hil_day", false);
   $cal->set("hil_week", false);
   $cal->set("theme", $theme);
   $cal->set("show_header_links", true);


   if($_REQUEST['conflicts']) {


      $cal->set("minical_date_url", "day_conflicts.php?d=%d&m=%m&y=%y&form=". $_REQUEST['form'] ."&elm=".
        $_REQUEST['elm'] ."&wday_lbl=". $_REQUEST['wday_lbl']);


   } else {
      $cal->set("minical_date_url", "javascript:return_date(%d,%m,%y,'".
	      $_REQUEST['form'] ."','". $_REQUEST['elm'] ."', '". $_REQUEST['wday_lbl'] ."')");
   }


   $cal->register_persistent("conflicts", $_REQUEST['conflicts']);
 
   echo("<style type='text/css'>\n#custom #cal table td.heading { height: 24px; font-size: 12px; }\n#custom #cal font.heading { font-size: 12px; }\n</style>\n");

   #####################
   #
   ### FILL EVENT MATRIX
   #
   #####################

   $cal->set("calendar", $calendar);

   if($_REQUEST['eid']) {

     $cal->set("filter", "{$_cal_dbpref}Events.id = ". intval($_REQUEST['eid']) ."
        or {$_cal_dbpref}Events.override_id = ". intval($_REQUEST['eid']));
     $cal->set("show_events", 1);

   } else if($_REQUEST['conflicts']) {

      $cal->set("show_events", 1);
   } else {
      $cal->set("show_events", 1);
   }

   echo("<div id='custom'>\n");
   $cal->display_month_mini();
   echo("</div>");


   echo("<div align='center'>\n");

   #################
   # date select boxes
   #################

   $url = new _cal_url("modules/common_files/date_picker.php");
   $url->addArg("y", $cal->year);


   $_cal_form->defaults["m"] = $cal->mon;
   $_cal_form->defaults["y"] = $cal->year;

   # month 
   echo("<br>");
   echo($_cal_form->select("m", $_cal_months, "
	onChange=\"document.location.href = '".
	$url->toString() .
	'&m=\' + this.options[this.selectedIndex].value"')); 
   echo(" ");


   # years
   # years
   if(@constant("_CAL_YEAR_RANGE_")) $yr_int = _CAL_YEAR_RANGE_;
   else $yr_int = 3;

   for($i = $cal->year - $yr_int; $i <= $cal->year + $yr_int; $i++)
   {
      $tmparr[$i] = $i;
   }

   $url->addArg("y","");
   $url->addArg("m", $cal->mon);
 
   echo($_cal_form->select("y", $tmparr, "
        onChange=\"document.location.href = '".
        $url->toString() .
        '&y=\' + this.options[this.selectedIndex].value"'));



   $_cal_form->print_footer(); 

?>
</div>
<script language='JavaScrypt' type='text/javascript'>

<?php if($_REQUEST['callback']): ?>

function return_date(d,m,y,no,not,none)
{

   window.opener.<?php echo($_REQUEST['callback']) ?>(y,m,d);


<?php else: ?>

function return_date(d,m,y,form,elm,wda_lbl)
{

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
