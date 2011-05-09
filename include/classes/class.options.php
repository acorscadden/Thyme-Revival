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
// $Id: class.options.php,v 1.23 2006/03/10 17:36:30 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");

class _cal_options extends _cal_sql_based
{


var $week_start = 1;

var $default_view = "m";

var $hour_format = 12;

var $e_popup = 1;
var $e_n_popup = 1;

var $workday_start_hr = 9;
var $workday_end_hr = 18;
var $time_interval = 2;

var $theme = "default";

var $timezone = "-5.0";

var $dst = "-1";

var $e_size = 0;
var $e_typename = 0;
var $e_collapse = 0;
var $show_weeks = 1;

function _cal_options($uid = null)
{


   if($uid === null) { // or null or '' etc..
      $uid = $GLOBALS['_cal_user']->id;
   }

   # still none?
   if(!$uid || @constant("_CAL_FORCE_DEFAULT_OPTS_")) $uid = 0;

   $this->id = $uid;

   $this->_cal_sql_based("{$GLOBALS['_cal_dbpref']}UserOptions", "id", $uid);

   $this->fields = array("e_popup", "e_n_popup", "default_view", "theme", "hour_format", "week_start",
        "workday_start_hr", "workday_end_hr", "time_interval", "timezone", "dst", "default_cal", "e_size",
        "e_collapse", "e_typename", "show_weeks");

   $this->fill_vars();

   # not found? set to default options
   if($this->not_found) {
      $this->id = $this->keyval = 0;
      $this->fill_vars();
   
      $this->id = $this->keyval = $uid;
   }

   if(@constant("_CAL_FORCE_THEME_")) $this->theme = _CAL_FORCE_THEME_;

}


#############################
#
### tie vars into this object
#
##############################

function tie_to($arr)
{

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/helpers/tie_to.php");

   # fix checkboxes..
   $arr['e_popup'] = $arr['e_popup'] ? 1 : 0;
   $arr['e_n_popup'] = $arr['e_n_popup'] ? 1 : 0;
   $arr['e_collapse'] = $arr['e_collapse'] ? 1 : 0;
   $arr['e_typename'] = $arr['e_typename'] ? 1 : 0;
   $arr['show_weeks'] = $arr['show_weeks'] ? 1 : 0;

   _ex_tie_to($this,$arr);


}


}

?>
