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
// $Id: delete.php,v 1.10 2006/03/10 17:36:45 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");


#######################
#
### DELETE A CALNEDAR
#
#######################

function delete_cal($id)
{

   global $_cal_sql, $_cal_dbpref;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   /*

| calCalendarMembers  |
| calCalendars        |
| calContactOpts      |
| calDST              |
| calEventTypes       |
| calEvents           |
| calGroupMembers     |
| calGroups           |
| calModuleSettings   |
| calNavModules       |
| calNotifications    |
| calReminders        |
| calRequests         |
| calSessions         |
| calSubscriptions    |
| calUserOptions      |
| calUsers            |

*/


   # DELETE MEMBERS FROM CALENDAR
   ###############################
   $_cal_sql->query("delete from {$_cal_dbpref}CalendarMembers where cid = ". $id);

   # DELETE FROM ANY VIEWS
   #########################
   
   # get any views first
   $views = $_cal_sql->query("select cid from {$_cal_dbpref}CalendarMembers where rid = {$id}
    and rtype = 2");

   $_cal_sql->query("delete from {$_cal_dbpref}CalendarMembers where rid = ". $id ."
    and rtype = 2");

   # DELETE ANY STYLE INFO
   #######################
   $vids = array();
   foreach($views as $v) { $vids[] = $v['cid']; }
   if(!count($vids)) $vids = array('-1');
   $_cal_sql->query("delete from {$_cal_dbpref}EventTypes where id = {$id} and
        calendar in (". join(",",$vids) .")");

   # DELETE EVENT TYPES
   #####################
   $_cal_sql->query("delete from {$_cal_dbpref}EventTypes where calendar = ". $id);

   # DELETE NOTIFICATIONS
   #######################
   $_cal_sql->query("delete from {$_cal_dbpref}Notifications where cid = ". $id);

   # DELETE ANY REQUESTS
   ######################
   $_cal_sql->query("delete from {$_cal_dbpref}Requests where calendar = ". $id);

   # DELETE ANY SUBSCRIPTIONS
   ##########################
   $_cal_sql->query("delete from {$_cal_dbpref}Subscriptions where calendar = ". $id);

   # DELETE EVENTS
   ##########################
   $events = $_cal_sql->query("select id from {$_cal_dbpref}Events where calendar = ". $id);

   foreach($events as $e)
   {

      # deletes attachments, reminders, overrides
      # exclusions
      _cal_event::delete($e['id']);
   }

   # DELETE CALENDAR
   ########################
   $_cal_sql->query("delete from {$_cal_dbpref}Calendars where id = ". $id);


}

   
  
?>
