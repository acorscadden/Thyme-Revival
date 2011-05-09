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
// $Id: duplicates.php,v 1.15 2007/12/12 14:05:35 ian Exp $
//


   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_minimal.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");

   global $_cal_user, $_cal_sql;


function check_duplicates(&$events)
{

   global $_cal_sql;

   $count = count($events);

   if(!$count)
      return;

   for($i = 0; $i < $count; $i++)
   {

      $q = "select id from {$GLOBALS['_cal_dbpref']}Events
         where calendar = ". $events[$i]->calendar ." and title = '".
         $_cal_sql->escape_string($events[$i]->title) . "' and starttime ".
         (strlen($events[$i]->starttime) ? (' = '. $events[$i]->starttime) :
            ' is null');

      list($elist) = $_cal_sql->query($q);


      if($elist['id'] > 0)
         unset($events[$i]);

   }


}


   ########################################
   #
   ### CHECK FOR DUPLICATES WHEN IMPORTING
   ### FROM A FORMAT THAT HAS DATE RANGES
   #
   ########################################


function check_duplicates_ranged($start,$end, &$events)
{

   global $_cal_user;

   if(!count($events))
      return;

   $em = new _cal_event_matrix("1970-12-1", "day", 0, $_SESSION['calendar']);

   $em->matrix = array();

   $em->view = "year";


   $em->fill_matrix($start,$end,_ex_localtime(),0, $_SESSION['calendar']);

   # step through each event to see if
   # we already have one for that day
   $count = count($events);
   for($i = 0; $i < $count; $i++)
   {

      # get offset for matrix
      #######################
      $e = &$events[$i];
      $offset = floor($e->starttime/86400) - floor($start/ 86400);


      if(!is_array($em->matrix[$offset])) continue;

      # step through all events for this day
      foreach($em->matrix[$offset] as $eid)
      {
         $ne = new _cal_event_minimal($eid);

         $ne_time = $ne->allday ? "allday" : _ex_date("G:i", $ne->start);
         $e_time = $e->allday ? "allday" : _ex_date("G:i", $e->starttime);

         # if we already have an event with the same title
         # that starts at the same time, remove it
         if($ne->title == $e->title && $ne_time == $e_time) {


            # check for a duplicates setting
            if($_REQUEST['duplicates'] == 1) {
               _cal_event::delete($eid['id']);
            } else {
               unset($events[$i]);
            }

            break;



         }

         
      }

   }


}
?>
