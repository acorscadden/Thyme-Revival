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
// $Id: export.php,v 1.30 2009/02/12 19:34:28 ian Exp $
//


$BASE_PATH = preg_replace("/.modules.sync$/","",dirname(__FILE__)) . '/';

define("_CAL_USE_SESSION_", 1);
define("_CAL_BENCHMARK_", 0);

$_REQUEST['export_to'] = str_replace(array('/','\\','.'),"", $_REQUEST['export_to']);


require_once($BASE_PATH . "include/config.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_minimal.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");
if(!@include_once(@constant("_CAL_BASE_PATH_") . "modules/sync/export/". $_REQUEST['export_to'] ."/register_format.php")) return;


global $_cal_user, $_cal_sql, $_cal_html, $_cal_dbpref, $_cur_cal;

$_cal_html = new _cal_html();

if(!$_cur_cal) {
   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
   $_cur_cal = new _cal_obj($_SESSION['calendar']);
}


if($_REQUEST['quirks_mode'] || $_REQUEST['qm']) $GLOBALS['ms_quirks'] = 1;

# check for access and set vars
###################################
if($_REQUEST['eid']) {

   require_once(_CAL_BASE_PATH_."include/classes/class.event.php");

   $event = new _cal_event($_REQUEST['eid']);

   $acal = $event->cal_title;
   $filename = $event->title;

   if(!$event->can_view()) {
      $_cal_html->permission_denied(true);
      return;
   }

} else {

   $acal = $_SESSION['calendar'];
   list($filename) = $_cal_sql->query("select title from {$_cal_dbpref}Calendars where id = ". abs($_SESSION['calendar']));

   $filename = $filename['title'];

   if(!$_cal_user->access->can_view($_cur_cal)) {
      $_cal_html->permission_denied(true); # fixed
      return;
   }
}

$filename = str_replace(array('/','\\','?','*',':',';','<','>','"','|'), "", $filename);

##################
# populate etypes
####################
if($_REQUEST['event_types'])
{
   foreach($_REQUEST['event_types'] as $et)
   {
      $et_restrict += $et;
   }

}



###################################
# INCLUDE MODULE
###################################
$mod = &$_cal_modules['sync']['export'][$_REQUEST['export_to']];

include_once(@constant("_CAL_BASE_PATH_") ."modules/sync/export/". $mod['include']);

header("Content-Type: ". $mod['content_type'], true);
header("Content-Disposition: attachment; filename=\"". $filename . $mod['ext'] ."\"");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0", true);


########################
#
# SPECIAL CASE FOR ICAL
#
#########################
if($_REQUEST['export_to'] == 'ical' && !$_REQUEST['eid']) {

  # export calendar
  ical_export_calendar($_SESSION['calendar'], $et_restrict);
   return;

}

# PRINT MODULE'S HEADER
call_user_func($mod['header']);

######################
# JUST EXPORT ONE EVENT
########################
if($_REQUEST['eid']) {

   call_user_func($mod['export'], $_REQUEST['eid'], $_REQUEST['instance']);
   call_user_func($mod['footer']);
   exit;
}


# we're going to have to trick
# event_matrix
###############################

$em = new _cal_event_matrix("1970-12-1", "day", $et_restrict, $acal);

$em->matrix = array();

$em->view = "year";

$start = _ex_mktime(0,0,0,$_REQUEST['startdate_mo'],$_REQUEST['startdate_da'],
   $_REQUEST['startdate_yr']);

$end = _ex_mktime(23,59,59,$_REQUEST['enddate_mo'],$_REQUEST['enddate_da'],
   $_REQUEST['enddate_yr']);


$em->fill_matrix($start,$end,_ex_localtime(),$et_restrict, $acal);

if(!count($em->matrix)) { 
  call_user_func($mod['footer']);
  exit;
}

# step through each day of the
# event matrix
################################
for($i = 0; $i <= max(array_keys($em->matrix)); $i++)
{
   if(@constant("_CAL_EURO_DATE_") == 1)
      $date = _ex_date("j/n/Y", $start + ($i * 86400));
   else
      $date = _ex_date("n/j/Y", $start + ($i * 86400));


   # step through each event
   foreach($em->matrix[$i] as $eids)
   {
      call_user_func($mod['export'], $eids['id'], _ex_date("Y-n-j",$eids['next']));
      
   }
}


call_user_func($mod['footer']);

?>
