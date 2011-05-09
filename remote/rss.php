<?php

# HELPER FUNCTION
if(!function_exists('_ex_xml_encode')) {
function _ex_xml_encode($str) {
   return str_replace(
      array('&','"','\'','<','>'),
      array('&amp;','&quot;','&apos;','&lt;','&gt;'),
      $str);
}
}

  if(@$_REQUEST['localtime']) define("_CAL_RSS_LOCALTIME_", 1);
  if(@$_REQUEST['htauth']) unset($_SERVER['PHP_AUTH_USER']);

  define("_CAL_BASE_PATH_",preg_replace("/remote$/","",dirname(__FILE__)));


  require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
  require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
  require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.calendar.php");
  require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");

  global $_cal_user, $_cal_html, $_cur_cal, $_cal_sql;


  # PHP as CGI / mod_rewrite work-around
  ########################################
  if($_REQUEST['auth']) {
      $_REQUEST['auth'] = (base64_decode($_REQUEST['auth']));
      $_SERVER['PHP_AUTH_USER'] = substr($_REQUEST['auth'], 0, strpos($_REQUEST['auth'],':'));
      $_SERVER['PHP_AUTH_PW'] = substr($_REQUEST['auth'], strlen($_SERVER['PHP_AUTH_USER']) + 1);
  }


  define('_CAL_USE_SESSION_', 1);

  $_cal_html = new _cal_html(true);

  if(!$_SERVER['PHP_AUTH_USER'] || $_SESSION['uid']) {
     $_cal_user = new _cal_user();
  } else {
     $_cal_user = new _cal_user($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
  }
  $_cal_user->login();
  $_cal_html->session->stop();

  ####################
  # CURRENT CALENDAR
  ####################
  if($_REQUEST['calendar']) {
  
     require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

     $_cur_cal = new _cal_obj($_REQUEST['calendar']);
  } else {

     echo("No calendar selected.");
     exit;

  }


  if(!$_REQUEST['calendar'] || !$_cal_user->logged_in || !$_cal_user->access->can_view($_cur_cal)) {

     ###########################
     #
     ### AUTHENTICATE USER
     #
     ############################

     header('WWW-Authenticate: Basic realm="'. $_cur_cal->title .'"');
     header("Status: 401 Access Denied");
     header('HTTP/1.0 401 Unauthorized');
     echo "You must enter a valid login ID and password to access this resource.\n";
     exit;
  }


if(!$_REQUEST['view']) $_REQUEST['view'] = "day";

$cv = substr($_REQUEST['view'], 0, 1);

if($cv == 'u') $t = @constant("_UPCOMING_");
else if($cv == 'd') $t = @constant("_TODAY_");
else if($cv == 'w') $t = @constant("_THIS_WEEK_");
else $t = @constant("_THIS_MONTH_");

$_SESSION['calendar'] = $_REQUEST['calendar'];

header("Content-type: text/xml; charset="._CHARSET_, true);

print '<?xml version="1.0" encoding="'._CHARSET_.'"?>'."\n";;
print "\n<rss version=\"2.0\">\n";
print "<channel>\n";
print "<title>". _ex_xml_encode($_cur_cal->title." - ".$t)."</title>\n";
print "<link>" . @constant("_CAL_BASE_URL_") . _CAL_PAGE_MAIN_ ."?calendar={$_REQUEST['calendar']}&amp;v={$cv}</link>\n";
print "<generator>Thyme - http://www.extrosoft.com</generator>\n";
print "<description>". _ex_xml_encode($_cur_cal->description) ."</description>\n";


$cal = new calendar();
$cal->set("calendar", $_REQUEST['calendar']);

if(trim($_REQUEST['category'])) $cal->set("category", $_REQUEST['category']);
else if(trim($_REQUEST['event_types'])) $cal->set("event_types", intval($_REQUEST['event_types']));

$cal->set("time", _ex_localtime());

if($_REQUEST['view'] == 'week')
   $cal->set("week_start",_ex_date("w",_ex_localtime()));
else if($_REQUEST['view'] == 'month')
   $cal->set("exclude_outside", 1);


if($_REQUEST['view'] == 'upcoming') {
   $days = max(1,min(90, intval($_REQUEST['days'])));
   $time = _ex_localtime();
   $events = $cal->get_event_list(_ex_date("Y-n-j", ($time + (86400 * $days))),
      _ex_date("Y-n-j", $time));
} else {
   $events = $cal->get_event_list($_REQUEST['view']);
}

$custom_template = file_exists(_CAL_BASE_PATH_.'customize/rss_template.php');

$printed = array();


foreach($events as $day) {
##################################
#
## EACH EVENT
#
###################################

# FOR set_localtime from event
################################
if(@constant("_CAL_RSS_LOCALTIME_")) {
   $_cal_user->options->timezone = $_cal_user->options->dst = 0;
}


foreach($day as $e)
{


   if($_REQUEST['norepeat'] && $printed[$e['id']]) continue;
   else $printed[$e['id']] = true;

   $e = new _cal_event($e['id'], _ex_date("Y-n-j", $e['instance']));

   echo("<item>\n");

   if(!@constant("_CAL_RSS_LOCALTIME_")) {
      $e->start -= ($_cal_user->options->timezone * 3600);
      $e->start -= (_ex_get_dst($e->start) * 3600);
   }

   echo("<title>". _ex_xml_encode($e->title) ."</title>\n");
   if(@constant("_CAL_RSS_EVENT_LINK_")) {
      $elink = sprintf(_CAL_RSS_EVENT_LINK_, $e->id, $e->instance);
   } else {
      $elink = @constant("_CAL_BASE_URL_") ."event_view.php?eid={$e->id}&amp;instance={$e->instance}";
   }

   echo("<link>{$elink}</link>");


   if($e->org_email)
      echo("<author>". _ex_xml_encode($e->org_email) ."</author>\n");

   if($e->type_name)
      echo("<category>". _ex_xml_encode($e->type_name) ."</category>\n");

   echo("<pubDate>". _ex_date("D, d M Y G:i:00", $e->start) ." +0000</pubDate>\n");

   ###################
   # BUILD DESCRIPTION
   ###################
   if($custom_template) {
      echo("<description>\n");
      include(_CAL_BASE_PATH_."customize/rss_template.php");
      echo("</description>\n");
   } else if(trim($e->notes)) {
      echo("<description>\n");
      echo(_ex_xml_encode($e->format_notes()));
      echo("</description>\n");
   }

   echo("</item>\n");
}

} # </foreach day >

echo("</channel>\n</rss>\n");

