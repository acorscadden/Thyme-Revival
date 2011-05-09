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
// $Id: export_generic.php,v 1.16 2007/03/18 15:09:38 ian Exp $
//

   global $_cal_user, $_cal_sql, $_cal_html;

   $BASE_PATH = preg_replace("/.modules.sync.export.generic$/","",dirname(__FILE__)) .'/';

   define("_CAL_BASE_PATH_", $BASE_PATH);

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.event_minimal.php");
   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.request.php");
   require_once(@constant("_CAL_BASE_PATH_") ."modules/sync/common/csv.php");

# HEADER
##########
function export_header_csv()
{
   echo('"Subject","Start Date","Start Time","End Date","End Time","All day event",'.
	   '"Location","Description"'."\r\n");
}


# EXPORT EVENT
################
function export_event_csv($eid, $instance = null)
{

   global $_cal_user;

      if($eid > 0) {
         $e = new _cal_event($eid);
      } else if($eid < 0) {
         $e = new _cal_request(abs($eid));
      }

      $e->startdate = $instance or $e->startdate = _ex_date("Y-n-j", $e->start);

      if(isset($e->endtime))
         $e->enddate = $date;
      else
         $e->enddate = "";

      $e->notes = strip_tags($e->notes);

      if($e->allday) {

         $e->starttime = "";
         $e->endtime = "";
         $e->allday = "True";

      } else {
         $e->starttime = _ex_date("g:i:00 A", _ex_strtotime($e->start));
         $e->endtime = _ex_date("g:i:00 A", _ex_strtotime($e->ends_at));
         $e->allday = "False";
      }


      $csv = array($e->title, $e->startdate, $e->starttime, $e->enddate, $e->endtime,
                $e->allday, $e->location, $e->notes);

      echo(strcsv($csv));


}

# FOOTER
###########
function export_footer_csv() { }

?>
