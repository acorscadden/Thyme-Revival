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
// $Id: class.dst.php,v 1.23 2007/10/29 00:50:43 ian Exp $
//

global $_cal_dst_config_cache;

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");

class _cal_dst extends _cal_sql_based
{


function _cal_dst($did = null, $internal = false)
{

   global $_cal_vcal_wdays, $_cal_dst_config_cache, $_cal_dbpref;

   if($did === null) $did = $GLOBALS['_cal_user']->options->dst;
   $this->id = $did;

   # simple on/off setting
   #######################
   if($did < 1) { return; }


   if(!$internal && is_object($_cal_dst_config_cache[$did])) {
      return;
   }

   if(!$internal) {
      $_cal_dst_config_cache[$did] = new _cal_dst($did, true);
      return;
   }

   $this->_cal_sql_based("{$_cal_dbpref}DST", "id", $did);
   $this->add_translation("{$_cal_dbpref}DST.starttime", "start");
   $this->add_translation("{$_cal_dbpref}DST.endtime", "end");

   $this->fields = array("title","starttime","endtime","repeat_on","repeat_on_wday","repeat_on_end",
    "repeat_on_wday_end", "rrule_st", "rrule_end");



   $this->fill_vars();

   if($this->id == 13) {
      $this->start = 1173571200;
      $this->end = 1194134400;;
   }

   foreach(explode(";",$this->rrule_st) as $kv)
   {
      list($k,$v) = explode("=",$kv);
      $this->dst_start[strtolower($k)] = $v;
   }
   foreach(explode(";",$this->rrule_end) as $kv)
   {
      list($k,$v) = explode("=",$kv);
      $this->dst_end[strtolower($k)] = $v;
   }

}



##########################
#
### set cached dst
### and return it
#
#########################

function is_dst($t = null)
{

   # cached result
   if($this->id == 0) return 1;
   if($this->id == -1) return 0;

   if($t === null) $t = time();

   return $this->_is_dst($t);
   

}


#######################
#
### is time $t dst?
#
#######################
function _is_dst($t)
{

   global $_cal_vcal_wdays;

   $dst = &$GLOBALS['_cal_dst_config_cache'][$this->id];

   list($y,$m,$d,$w,$h) = preg_split("/-/",_ex_date("Y-n-j-w-h", $t));

   ################################
   #
   ## DST IS AT THE END OF THE YEAR
   #
   ################################
   if($dst->dst_start['bymonth'] > $dst->dst_end['bymonth']) {

      if($m > $dst->dst_start['bymonth'] || $m < $dst->dst_end['bymonth'])
         return 1;

      if($m < $dst->dst_start['bymonth']) return 0;

      if($m > $dst->dst_end['bymonth']) return 0;

   ###################################
   #
   ## DST IS AT THE START OF THE YEAR
   #
   ###################################
   } else {

      if($m > $dst->dst_start['bymonth'] && $m < $dst->dst_end['bymonth'])
         return 1;

      if($m > $dst->dst_end['bymonth']) return 0;

      if($m < $dst->dst_start['bymonth']) return 0;

   }

      # in the starting month
      ########################
      if($m == $dst->dst_start['bymonth']) {

         # repeating byday
         ##################
         if(isset($dst->dst_start['byday'])) {

            $wd = substr($dst->dst_start['byday'], -1, 1);
            $wk = substr($dst->dst_start['byday'], 0, strlen($dst->dst_start['byday']) -1);

            # if week is > 0, this will be simple
            ######################################
            if($wk > 0) {
            
               if((_ex_toint($d/7) + 1) < $wk) return 0;
               if((_ex_toint($d/7) + 1) > $wk) return 1;

               $mo_wd_st = _ex_mo_wdst($m,$y);

               # we're on the week, get the value
               $wd_now = _cal_repeater::_to_wkday($w,$mo_wd_st);
               $wd_dst = _cal_repeater::_to_wkday($wd,$mo_wd_st);


               if($wd_now < $wd_dst) return 0;
               if($wd_now > $wd_dst) return 1;

               # if we're on the same day, the hours will be checked below
            # check that we're in the last week
            ####################################
            } else {

               $mo_end = _ex_date("t",$t);

               # before the last week w're not in dst
               #####################################
               if($d + 7 < $mo_end) return 0;

               # how far away is the next weekday that dst
               # is set to from today
               $wd_dst = _cal_repeater::_to_wkday($wd,$w);

               # if it's past the endo f the month,
               if($d + $wd_dst > $mo_end) return 1;

               # if it's before the end of the month
               if($d + $wd_dst < $mo_end) return 0;


               # if we're on the same day, the hours will be checked below


            }

         # repeating bymonthday
         #########################
         } else if(isset($dst->dst_start['bymonthday'])) {

        
            if($d < $dst->dst_start['bymonthday']) return 1; 
            if($d > $dst->dst_start['bymonthday']) return 0;

            # if we're on the same day, hours will be checked below
         }

         # we're on the same weekday, check hrs and minutes
         $dst_h  = _ex_toint(($dst->start % 86400) / 3600);

         if($h >= $dst_h) return 1;

      ##############################
      #
      # IN THE ENDING MONTH
      #
      ##############################
      } else {

         # repeating byday
         ##################
         if(isset($dst->dst_end['byday'])) {

            $wd = substr($dst->dst_end['byday'], -1, 1);
            $wk = substr($dst->dst_end['byday'], 0, strlen($dst->dst_end['byday']) -1);
            # if week is > 0, this will be simple
            ######################################
            if($wk > 0) {

               if((_ex_toint($d/7) + 1) > $wk) return 0;
               if((_ex_toint($d/7) + 1) < $wk) return 1;

               $mo_wd_st = _ex_mo_wdst($m,$y);

               # we're on the week, get the value
               $wd_now = _cal_repeater::_to_wkday($w,$mo_wd_st);
               $wd_dst = _cal_repeater::_to_wkday($wd,$mo_wd_st);

               if($wd_now > $wd_dst) return 0;
               if($wd_now < $wd_dst) return 1;

               # if we're on the same day, the hours will be checked below

            # check that we're in the last week
            ####################################
            } else {

               $mo_end = _ex_date("t",$t);

               # before the last week, we're in dst
               ####################################
               if($d + 7 < $mo_end) return 1;


               # At this point, we are in the last week
               # of the month

               # how far away is the next weekday that dst
               # is set to from today
               $wd_dst = _cal_repeater::_to_wkday($wd,$w);

               # If this is a value, we are not on the
               # day that DST occurs
               if($wd_dst) {
            
                  # if it's past the endo f the month, 
                  if(($d + $wd_dst) > $mo_end) return 0;

                  # if it's before the end of the month
                  if(($d + $wd_dst) < $mo_end) return 1;

              }


            }


         # repeating bymonthday
         #########################
         } else if(isset($dst->dst_end['bymonthday'])) {


            if($d < $dst->dst_end['bymonthday']) return 1;
            if($d > $dst->dst_end['bymonthday']) return 0;

            # if we're on the same day, hours will be checked below

         }

         # we're on the same kday, check hrs and minutes
         $dst_h  = _ex_toint(($dst->end % 86400) / 3600);

         if($h <= $dst_h) return 1;


      }


      return 0;


}


# we never want to be able
# to save this object..
function save() { return false; }


}


?>
