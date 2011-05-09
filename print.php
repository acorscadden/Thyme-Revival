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
//

if(!@constant("_DEBUG_"))
   error_reporting(E_ALL ^ (E_NOTICE));

   define("_CAL_BENCHMARK_", 0);
   define("_CAL_USE_SESSION_", 1);

   define("_CAL_NO_PERM_REDIR_", 1);

   require_once(dirname(__FILE__) . "/include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.calendar_real.php");

   global $_cal_user, $_cur_cal, $_cal_html;


   $_cal_html = new _cal_html();

   # get current calendar
   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

   $_cur_cal = new _cal_obj($_SESSION['calendar']);

   # Create calendar object.
   $cal = new _cal_calendar_real();

   @Header("Content-Type: text/html; charset=". _CHARSET_);

   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0", true);
   header("Pragma: no-cache");


   if(!$_cal_user->access->can_view($_cur_cal)) {
      $_cal_html->permission_denied(true);
      return;
   }

   # this isn't printable, we're already printing
   $cal->printable = 0;

   # not editable (no [+] links)
   $cal->editable = 0;
  
   # don't show weeks in month view
   $cal->show_weeks = 0;

   # tell the calendar to display as if we're printing
   $cal->printing = 1;

   # Tell the calendar not to make day numbers links
   $cal->static = 1;

   # Exclude days outside of current month (month views)
   $cal->exclude_outside = 1;

   # Set the event size to Smallest
   $_cal_user->options->e_size = 2;

   # set category
   $cal->event_types = ($_GET['evnt_type'] ? $_GET['evnt_type'] : $_SESSION['evnt_type']);

   # don't hilight day
   unset($cal->selday);
   # don't highlight week
   unset($cal->selweek);
   # don't show header links
   unset($cal->show_header_links);
   # don't show footer links
   unset($cal->show_footer);

?>
<html>
<head>
<title><?php echo($_cur_cal->title) ?></title>
<meta http-equiv="Content-type: text/html; charset=<?php echo(_CHARSET_) ?>" />
<link rel="stylesheet" TYPE="text/css" href="css/print.css">
<?php
if(@constant("_CAL_PRINT_VIEW_COLORS_")) {
   include(_CAL_BASE_PATH_."css/calendar_css.php");
}
?>
</head>
<body>
<div id='cal'>
<?php


   switch($_REQUEST['v'])
   {
      case "y":
      $cal->display_year();
      break;

      case "m":
      $cal->display_month();
      break;

      case "d":
      $cal->display_day();
      break;

      case "w":
      $cal->display_week();
      break;

   }


?>
</div>
</body>
</html>
