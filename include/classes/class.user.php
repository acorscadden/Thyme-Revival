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
// $Id: class.user.php,v 1.66 2008/03/06 23:13:47 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.options.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.access.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.dst.php");

class _cal_user extends _cal_sql_based
{
   
   var $userid;
   var $pass;
   var $admin = 0;
   var $access_lvl = 0;
   var $options;



function _cal_user($userid = null, $pass = null, $id = null)
{

   global $_cal_sql, $_cal_dbpref;

   $_cal_sql or $_cal_sql = new _cal_sql();

   if(strlen($userid) && strlen($pass)) {
      $this->userid = $userid;
      $this->pass = $pass;
      $this->login_attempt = true;

   } else if((!@constant("_CAL_USE_SESSION_") == 1 || !$_SESSION['uid']) && (!$id)) {
      $this->userid = _CAL_USER_GUEST_;
      $this->id = 0;
      $this->guest = 1;

   } else if($id === null) {
      $id = $_SESSION['uid'];
      $this->userid = $_SESSION['userid'];

   }

   ##################################
   #
   ### GET USER BY ID
   #
   ###################################

   if($id !== null) {


      $this->id = $id;
      
      if($this->id <= 0) {

         $this->name = _CAL_USER_GUEST_;
         $this->id = 0;
         $this->guest = 1;
      }


   }

   $this->userid = $_cal_sql->escape_string($this->userid);
   $this->pass = $_cal_sql->escape_string($this->pass);

   ##################################
   #
   ### CHECK FOR CUSTOM AUTH MODULE
   #
   ##################################
   if(function_exists("_ex_auth_login")) {

      _ex_auth_get_user($this);

      $this->guest = (!($this->id > 0));

   }

   $this->fields = array('id','userid','name','email','access_lvl');

   ##########################
   #
   # SET TO GUEST?
   #
   ##########################
   if($this->guest) {

      $this->fields[] = 'pass';
      $this->_cal_sql_based("{$_cal_dbpref}Users", "id", $this->id);
      $this->fill_vars();

      if(isset($_SESSION['tz']))
         $this->options->timezone = $_SESSION['tz'];

      if(isset($_SESSION['dst']))
         $this->options->dst = $_SESSION['dst'];


      $this->userid = _CAL_USER_GUEST_;
      $this->id = 0;
      $this->guest = 1;
      unset($this->email);


   } else {

      if(function_exists("_ex_auth_login")) $this->fields = array('name','email','access_lvl');

      
      if($this->id) {
         $this->_cal_sql_based("{$_cal_dbpref}Users", "id", $this->id);
      } else {
         $this->_cal_sql_based("{$_cal_dbpref}Users", "userid", $this->userid);
      }

      $this->fill_vars();

      $this->logged_in = ($this->id > 0 && $id);

   }

   ##################################
   #
   ### CHECK FOR CUSTOM AUTH MODULE
   #
   ##################################
   if(function_exists("_ex_auth_login") && !$this->guest) {
      unset($this->id);
      _ex_auth_get_user($this);
   }


   ###############################
   #
   ### SUB CLASSES
   #
   ###############################

   $this->options = new _cal_options($this->id);
   $this->access = new _cal_access($this->id);

   if(!$this->options->default_cal) $this->options->default_cal = 0;

   $this->dst = new _cal_dst($this->options->dst);

   if((@constant("_CAL_USE_SESSION_") && (!$_SESSION['calendar'] || 
        ($userid && $pass && !@constant('_CAL_NO_LOGIN_DEFAULT_CAL_'))))) {
        $_SESSION['calendar'] = $this->options->default_cal;
   }


   if(!$this->admin) { $this->admin =  (!$this->guest && $this->id && $this->access_lvl > 0); }

   $this->access->user->guest = $this->guest;
   $this->access->user->admin = $this->admin;

   if($this->options->not_found && file_exists(_CAL_BASE_PATH_."modules/user_calendars/first_login.php")) { 
        @include(_CAL_BASE_PATH_."modules/user_calendars/first_login.php");
   }


}

#######
function login()
{

   if($this->logged_in && $this->id) return true;

   # External auth user not found
   if(function_exists('_ex_auth_login') && $this->id == 0 && $this->login_attempt)
      return false;

   ###################################
   #
   ### CUSTOM LOGIN FUNCTION
   #
   ###################################
   if(function_exists("_ex_auth_login") && !$this->guest)
   {
      $this->logged_in = _ex_auth_login($this);

      # see if we found matching options,
      # if not create them
      #####################################
      if($this->options->not_found) {
         $this->options = new _cal_options(0);
         $this->options->keyval = $this->options->id = $this->id;
         $this->options->save(true);
      }

      if($this->logged_in && !$this->admin) $this->admin = ($this->access_lvl == 1);

      if($this->logged_in && @constant("_CAL_USE_SESSION_")) {
        $_SESSION['uid'] = $this->id;
        $_SESSION['userid'] = $this->userid;
      }

      # defaults..
      return $this->logged_in;   

   }


   global $_cal_sql, $_cal_dbpref;

   $_cal_sql or $_cal_sql = new _cal_sql();

   $query = "select id, userid, pass, access_lvl from {$_cal_dbpref}Users where ";

   $this->userid = $_cal_sql->escape_string($this->userid);

   if($this->guest) 
     $query .= "id = 0";
   else
     $query .= "userid like '". $this->userid ."'";

   list($res) = $_cal_sql->query($query);

   $user = $res['userid'];
   $pass = $res['pass'];


   if($this->id == 0)
   {

      $this->guest = 1;

      if($pass == "ENABLED")
      {
         $this->logged_in = true;

         $this->access->user->guest = $this->guest;
         $this->access->user->admin = $this->admin;

         return TRUE;
      } else {
         $_SESSION['calendar'] = 0;
         return FALSE;
      }

   }

   if($pass == md5($this->pass)) {

      $this->admin = ($res['access_lvl'] > 0);
      $this->access->user->guest = $this->guest;
      $this->access->user->admin = $this->admin;

      $this->logged_in = true;
      $this->id = $res['id'];

      $_SESSION['uid'] = $this->id;
      $_SESSION['userid'] = $this->userid;



      return TRUE;
   }

   $_SESSION['uid'] = $this->id = 0;

   $this->access->user->guest = $this->guest;
   $this->access->user->admin = $this->admin;

   return FALSE;

}

####################################
# RETURN LOCAL TIME FOR USER IN GMT
####################################
function to_localtime($time = null)
{

   if($time === null) $time = time();

   $time += (3600 * $this->options->timezone);
   return $time + (3600 * $this->dst->is_dst($time));

}


###################################
#
###################################

############################
# DLEETE A USER
###########################
function delete($uid = 0)
{

   global $_cal_sql, $_cal_dbpref;

   if(!($uid > 0)) $uid = $this->id;

   if(!$uid) return;  

   # delete from calendar members
   $_cal_sql->query("delete from {$_cal_dbpref}CalendarMembers where rid = ". $uid ."
        and rtype = 0");

   # get views
   ############
   $views = $_cal_sql->query("select id, 1 from {$_cal_dbpref}Calendars where type = 1 and owner = ".
        $uid, true);

   if(!count($views)) $views = array("0");

   $_cal_sql->query("delete from {$_cal_dbpref}CalendarMembers where cid in (". join(",",array_keys($views)) .")");
   $_cal_sql->query("delete from {$_cal_dbpref}Calendars where id in (". join(",",array_keys($views)) .")");

   # delete from groups
   $_cal_sql->query("delete from {$_cal_dbpref}GroupMembers where uid = ". $uid);

   # contcts
   $_cal_sql->query("delete from {$_cal_dbpref}ContactOpts where uid = ". $uid);

   # modules
   $_cal_sql->query("delete from {$_cal_dbpref}ModuleSettings where uid = ". $uid);

   # nav bar
   $_cal_sql->query("delete from {$_cal_dbpref}NavModules where uid = ". $uid);

   # delete notifications
   $_cal_sql->query("delete from {$_cal_dbpref}Notifications where uid = ". $uid);

   # delete reminders
   $_cal_sql->query("delete from {$_cal_dbpref}Reminders where uid = ". $uid);

   # delete subscriptions
   $_cal_sql->query("delete from {$_cal_dbpref}Subscriptions where uid = ". $uid);

   # delete member style information
   $_cal_sql->query("delete from {$_cal_dbpref}EventTypes where id = ". $uid ." and calendar = 0");
    

}

###################
#
###################
function save($create_first = FALSE) {

   global $_cal_sql, $_cal_dbpref;

   if($create_first && function_exists("_ex_auth_login")) {
      $_cal_sql->query("insert into {$_cal_dbpref}Users (id,userid) values ({$this->id}, '". 
        $_cal_sql->escape_string($this->userid) ."')");
        $create_first = false;
   }

   $this->key = 'id';
   $this->keyval = $this->id;

   $this->sequence = "{$GLOBALS['_cal_dbpref']}users_id_seq";

   $retval = parent::save($create_first);

   $this->key = 'userid';
   $this->keyval = $this->userid;

   return $retval;
}




}
?>
