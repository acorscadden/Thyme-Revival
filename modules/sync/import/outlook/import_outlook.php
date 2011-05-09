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
// $Id: import_outlook.php,v 1.32 2008/06/23 18:26:32 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_matrix.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.repeater.php");

   global $_cal_html, $_cal_sql, $_cal_user, $_cal_modules, $_cur_cal, $_cal_dbpref, $_cal_etypes;

   ########################
   #
   ### IMPORT
   #
   #######################

   if(!$_cal_user->access->can_add($_cur_cal)) return;

   define("_CAL_FULL_SYNC_", $_REQUEST['fullsync'] && $_cal_user->access->can_admin($_cur_cal));

   $count = 0;

   $events = array();

   # Clean up Mac line ends
   ########################
   $csv = str_replace(array("\r\n","\r"), "\n", @file_get_contents($_FILES['import_file']['tmp_name']));
   @file_put_contents($_FILES['import_file']['tmp_name'], $csv);
 
   $fh = fopen($_FILES['import_file']['tmp_name'], "rb");

   if(!$fh) {
      echo(_ERROR_ ." :: import_outlook.php :: ". $_FILES['import_file']['tmp_name'] ."<br><br>");
      return;
   }

   # MAP heading of CSV file
   #########################
   $header = array_map("trim",fgetcsv($fh, 1024, ","));
   
   $maps = array(
      "title" => "subject",
      "startdate" => "start date",
      "starttime" => "start time",
      "enddate" => "end date",
      "endtime" => "end time",
      "allday" => "all day event",
      "location" => "location",
      "notes" => "description",

      "url" => "url",
      "category" => "category",
      "org_name" => "name",
      "org_email" => "e-mail",

      "repeat_every" => "repeat every", # X days/weeks/months/years
      "repeat_on" => "repeat on", # first/second/third/fourth/fith/last weekday every X months
      "end_after" => "end after", # X
      "until" => "until", # yyyy-mm-dd

      "addr_st" => "street",
      "addr_ci" => "city/state/zip",
      "phone" => "phone"     
   );


   # Add any non-existant header items to map
   foreach($header as $h) {

     if(!$maps[$h]) $maps[$h] = $h;

   }

   $header = array_map("strtolower", $header);

   $keys = array_keys($maps);
   
   foreach($keys as $map)
   {
      $pos = array_search($maps[$map], $header);

      unset($maps[$map]);
      if($pos === false) continue;
      $maps[$pos] = $map;
   }

   # don't do it if we couldn't map
   # the header
   ###############################
   if(array_search('title', array_keys($maps)) === false ||
                array_search('startdate', array_keys($maps)) === false ||
                array_search('enddate', array_keys($maps)) === false) {

       fseek($fh,0,SEEK_END);

   } else if (@constant("_CAL_FULL_SYNC_")) {


      $es = $_cal_sql->query("select uid, id from {$_cal_dbpref}Events where calendar = {$_cur_cal->id} and
        (override_id is null or override_id = 0)", true);

      foreach($es as $eid) _cal_event::delete($eid, false);

   }


   # get categories
   ################
   $_cal_etypes or $_cal_etypes = $_cur_cal->get_categories();

   $type_map = array_flip(array_map("strtolower",$_cal_etypes));


   #########################
   #
   ## PARSE EACH LINE
   #
   #########################
   $events = array();
   while(($data = fgetcsv($fh, 1024, ",")) !== false)
   {

      $e = new _cal_event();

      for($i = 0; $i < count($data); $i++) {

         if(!$maps[$i]) continue;

         $e->$maps[$i] = trim($data[$i]);
      }



      # fix all day
      ###############
      if(strtolower($e->allday) == "true")
         $e->allday = 1;
      else
         $e->allday = 0;

      if(!$e->enddate) $e->enddate = $e->startdate;

      # SPECIAL CASE FOR THIS DATE FORMAT
      if(preg_match("/[0-9]{4}\/[0-9]/",$e->startdate)) {
         $e->startdate = str_replace('/','-',$e->startdate);
         $e->enddate = str_replace('/','-',$e->enddate);
      }

      # fix dates
      #################
      $e->startdate = _ex_strtotime($e->startdate ." 0:0:0");
      $e->enddate = _ex_strtotime($e->enddate ." 0:0:0");

      # fix times
      ###############
      if(!$e->allday) {

         # get start time
         ################
         list($time, $ap) = explode(" ", $e->starttime);
         list($hr,$mn,$sc) = explode(":",$time);

         if(strtolower($ap) == strtolower(_PM_) && $hr != 12) {
            $hr += 12;
         } else if(strtolower($ap) == strtolower(_AM_) && $hr == 12) {
            $hr = 0;
         }

         $e->startdate += ($mn * 60) + ($hr * 3600);


         # get end time
         ################
         list($time, $ap) = explode(" ", $e->endtime);
         list($hr,$mn,$sc) = explode(":",$time);

         if(strtolower($ap) == strtolower(_PM_) && $hr != 12) {
            $hr += 12;
         } else if(strtolower($ap) == strtolower(_AM_) && $hr == 12) {
            $hr = 0;
         }

         $e->enddate += ($mn * 60) + ($hr * 3600);

         # calculate duration
         ######################
         $secs = $e->enddate - $e->startdate;

         if($secs > 0) {

            $hrs = intval($secs / 3600);
            $mns = intval($secs / 60) - (intval($secs / 3600) * 60);

            # we can only last 12 hrs
            #########################
            if($hrs > 12) $hrs = 12;

            $e->duration = intval($hrs) .":". intval($mns) .":0";

         } else {

            # a non all day event with 0
            # difference in time? silly outlook
            $e->duration = "1:0:0";

         }


      } # </ if (!$e->allday)


      $maxstart = max($maxstart, $e->startdate);
      $minstart = min(($minstart == 0 ? $e->startdate : $minstart), $e->startdate);

      $e->starttime = $e->startdate;
      $e->endtime = $e->enddate;

      ##########################
      #
      ### REPEATING
      #
      ##########################
      if($e->repeat_every) {

         $e->repeat_every = str_replace("  "," ",strtolower($e->repeat_every));
         $arr = explode(" ", $e->repeat_every);

         if(strtolower($arr[0])  == 'every') array_shift($arr);

         $e->finterval = max(1,intval(array_shift($arr)));

         $e->freq = substr(array_shift($arr), 0, 1);

         switch($e->freq) {

            case 'd':
               $e->freq = 4;
               break;

            case 'w':
               $e->freq = 3;
               break;

            case 'm':
               $e->freq = 2;
               break;

            case 'y':
               $e->freq = 1;
               break;

            default:
               $e->repeat_every = null;
               $e->freq = 0;

         }
   
      } else if ($e->repeat_on) {

          $e->repeat_on = str_replace("  "," ",strtolower($e->repeat_on));
          $arr = explode(" ", $e->repeat_on);

          $x = substr(array_shift($arr), 0, 3);

          switch($x) {

             case 'sec':
                $x = 2;
                break;

             case 'thi':
                $x = 3;
                break;

             case 'fou':
                $x = 4;
                break;

             case 'fit':
                $x = 5;
                break;

             case 'las':
                $x = -1;
                break;

             default:
                $x =1;

          }

          $wd = substr(strtoupper(array_shift($arr)), 0, 2);
         
          if(array_search($wd, $GLOBALS['_cal_vcal_wdays']) === false)
             $wd = 'MO';

          $e->byday = $x . $wd;
          $e->freq = 2; # monthly

          array_shift($arr);

          $e->finterval = max(1, intval(array_shift($arr)));
      }
    
      if($e->end_after) {

         $e->start = $e->start_timestamp = $e->starttime;

         $r = new _cal_repeater($e);
         $e->endtime = $r->get_last_time();

      } else if($e->until) {


         $e->endtime = _ex_strtotime($e->until);

      } else if($e->repeat_every || $e->repeat_on) {

         $e->endtime = null;
      }

      #"repeat_every" => "repeat every", # X days/weeks/months/years
      #"repeat_on" => "repeat on", # first/second/third/fourth/fith/last weekday every X months
      #"end_after" => "end after", # X
      #"until" => "until", # yyyy-mm-dd

      $e->etype = $_REQUEST['etype'];

      if($e->category && !$_REQUEST['etype']) {

         $e->etype = intval($type_map[strtolower($e->category)]);
      }

      $e->calendar = $_SESSION['calendar'];

      $e->use_tz = 1;
      $e->timezone = $_cal_user->options->timezone;
      $e->dst = $_cal_user->options->dst;

      $e->title = trim($e->title);

      if($_REQUEST['locale'] == 0) {
        $e->use_tz = 0;
      } else if($_REQUEST['locale'] == 1) {
        $e->timezone = $_REQUEST['timezone'];
        $e->dst = intval($_REQUEST['dst']);
      }

      if(!$e->addr_st)
      _ex_import_csv_set_loc($e);

      # add it to our array or save it
      ###################################
      if($_REQUEST['duplicates'] < 2 && !@constant("_CAL_FULL_SYNC_")) {
         $events[] = $e;
      } else {
         if($e->save()) $count++;
      }


   } # / while
   fclose($fh);



   # check for dups?
   ##################
   if($_REQUEST['duplicates'] < 2) {

      require_once(@constant("_CAL_BASE_PATH_") . "modules/sync/common/duplicates.php");

      check_duplicates_ranged($minstart,$maxstart,$events);

      foreach($events as $e)
      {
         if($e->save()) $count++;
         unset($e);
      }
   }

   echo("<div align='center'><h3 align='center'>".intval($count). " " ._EVENTS_IMPORTED_."</h3></div>");


function _ex_import_csv_set_loc(&$_cal_event) {


   global $_cal_locs, $_cal_sql, $_cal_dbpref;

   if(!$_cal_event->location) return;

   ########################
   #
   ### GET UNIQUE LOCATIONS
   #
   ######################### 
   if(!$_cal_locs) {

      $_cal_locs = array();

      if(@constant("_CAL_LOCATION_IGNORE_PHONE_")) $cal_q_phone = "";
      else $cal_q_phone = ", phone ";


      
      $cal_q_cals = "";

      if($_cal_sql->subselects) {

         $q = "select distinct(location), addr_ci, addr_st, updated
             {$cal_q_phone} from {$_cal_dbpref}Events,
            (select location as maxloc, max(updated) as maxupdated from {$_cal_dbpref}Events
            where {$cal_q_cals}
            location != '' and location is not null group by location)
            as t2 where location = t2.maxloc and updated = t2.maxupdated
            order by updated desc, location desc";


         $_cal_locs_tmp = $_cal_sql->query($q);
         
         if(count($_cal_locs_tmp)) {

            foreach($_cal_locs_tmp as $_cal_l) {

               $_cal_locs[trim(strtolower($_cal_l['location']))] = $_cal_l;

            }

         }


      } else {


         $q = "select ". $_cal_sql->sql_alias("max(updated)", "updated") .",
                location from {$_cal_dbpref}Events
               where {$cal_q_cals} (location != '' and location is not null)
               group by location order by updated desc";

         $_cal_locs_tmp = $_cal_sql->query($q, true);
 
         if(count($_cal_locs_tmp)) {

            natcasesort($_cal_locs_tmp);

            $_cal_locs_sql = array();
            foreach($_cal_locs_tmp as $_cal_l) $_cal_locs_sql[] = $_cal_sql->escape_string($_cal_l);

            # get most recent locations
            ############################
            if(count($_cal_locs_sql)) {
               $_cal_locs_tmp = $_cal_sql->query("select location, updated, addr_ci,
                  addr_st {$cal_q_phone}
                  from {$_cal_dbpref}Events
                  where updated in (". join(",", array_keys($_cal_locs_tmp)) .") and
                  location in ('". join("','", $_cal_locs_sql) ."') order by lower(location),
                updated");
            } else {
               $_cal_locs_tmp = array();
            }

            # create uniqued
            foreach($_cal_locs_tmp as $loc) $_cal_locs[trim(strtolower($loc['location']))] = $loc;

         }


      }

   }


   if($_cal_locs[trim(strtolower($_cal_event->location))]) {

      $loc = &$_cal_locs[trim(strtolower($_cal_event->location))];

      $_cal_event->addr_ci = $loc['addr_ci'];
      $_cal_event->addr_st = $loc['addr_st'];

      if($loc['phone']) $_cal_event->phone = $loc['phone'];

   }

}

?>
