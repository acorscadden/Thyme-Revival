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
// $Id: class.session.php,v 1.59 2008/07/31 14:30:50 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

class _cal_session
{

var $max_life = 86400; # 1 day

var $cookie = null;

var $session_id = null;

var $exists = 0;

var $gc_interval = 20; # 1 in X number of hits to do gc
                       # must be an even number

function _cal_session()
{

   $this->cookie = md5(_CAL_BASE_PATH_);

}

function start($ignore_define = 0) {

   require_once(_CAL_BASE_PATH_."include/classes/class.sql.php");

   if(@constant("_CAL_USE_SESSION_") == 0 && !$ignore_define) return;

   if(@constant("_CAL_REUSE_SESSION_")) $this->_ses_pre = $_SESSION; 
   else $this->_ses_pre = array();

   if(!@defined("_CAL_COOKIE_NAME_")) @define("_CAL_COOKIE_NAME_", "THYMESES");

   if(@constant("_CAL_SES_TIMEOUT_")) $this->max_life = constant("_CAL_SES_TIMEOUT_");
    
   if($_COOKIE[$this->cookie]) {
      $this->session_id = $_COOKIE[$this->cookie];
      $this->_c_ses_read();
   } else {
      $this->session_id = md5(microtime().$_SERVER['REMOTE_ADDR'].time());
   }

   setcookie($this->cookie, $this->session_id, null,
        (@constant("_CAL_COOKIE_PATH_") ? _CAL_COOKIE_PATH_ : '/'));

   if(rand(1,max($this->gc_interval,10)) == floor($this->gc_interval / 2))
      $this->_c_ses_gc();
}

##################################
#
### FILL SESSION VARS FROM REQUEST
### IF NEEDED
#
##################################


function fill_vars()
{

   global $_cal_sql, $_cal_dbpref, $_cur_cal;

   if(@constant("_CAL_USE_SESSION_") == 0) return;

   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");

   $this->sess_vars_global = array("y","m","d","v",'hide_nav','evnt_type','calendar',
        'vcat','location','event_action','evnt_view','elist_custom_filter',
    'searchfor','evnt_order_by','evnt_order_desc','evnt_count');

   @include_once(_CAL_BASE_PATH_."customize/session.php");
  
   # reset event type if we've changed calendars
   ###########################################
   if($_REQUEST['calendar'] && ($_REQUEST['calendar'] != $_SESSION['calendar'])) {

      unset($_SESSION['evnt_type']); unset($_REQUEST['evnt_type']);
      unset($_SESSION['vcat']); unset($_REQUEST['vcat']);

      if(preg_match("/[^\d]/",$_REQUEST['calendar'])) {

         require_once(_CAL_BASE_PATH_."include/classes/class.sql.php");
         $_cal_sql or $_cal_sql = new _cal_sql();

         list($_cal_id) = $_cal_sql->query("select id, id from {$_cal_dbpref}Calendars
            where lower(title)  = '". strtolower($_cal_sql->escape_string($_REQUEST['calendar'])) ."'");

         $_REQUEST['calendar'] = $_SESSION['calendar'] = $_cal_id['id'];
         $_cur_cal = new _cal_obj($_cal_id['id']);
      }

   }

   # globals..
   #############
   foreach ($this->sess_vars_global as $var)
   {
      if(isset($_REQUEST[$var]) && !is_array($_REQUEST[$var])) {
         $_SESSION[$var] = $_REQUEST[$var];
      }

   }

   # change category by name
   if($_REQUEST['category'] && $_SESSION['calendar']) {

      $_REQUEST['category'] = strtolower($_REQUEST['category']);

      $_cur_cal or $_cur_cal = new _cal_obj($_SESSION['calendar']);

      $cats = $_cur_cal->get_categories();

      foreach($cats as $k => $v) {
         if(strtolower($v) == $_REQUEST['category']) {
            $_SESSION['evnt_type'] = $k;
            break;
         }
      }

   }


   # We doing an event search?
   ############################
   if($_REQUEST['searchfor']) {
      $_SESSION["v"] = "events";
      $_SESSION['searchfor'] = $_REQUEST['searchfor'];

   # the default view..
   ####################
   } else if(!isset($_SESSION["v"])) {

      global $_cal_user;

      if($_cal_user->options->default_view) {
         $_SESSION["v"] = $_cal_user->options->default_view;
      } 


   # view was already set to events..
   ################################
   } else if($_SESSION["v"] == "events") {

      # whenever we're in event list view
      # we reset all date data
      ##############################

      unset($_SESSION["y"]);
      unset($_SESSION["m"]);
      unset($_SESSION["d"]);

   } else if($_SESSION['searchfor']) {
      unset($_SESSION['searchfor']);
   }


   ##############################
   # if we want to goto a date..
   #############################

   if(isset($_REQUEST['goto_date'])) {

      $time = _ex_strtotime($_REQUEST['date'], false);

      list($_SESSION["m"],$_SESSION["d"],$_SESSION["y"])
            = explode("-", _ex_date("n-j-Y", $time));

   } else {

      # default date..
      ##################
      isset($_SESSION["y"]) or $_SESSION["y"] = _ex_date("Y", _ex_localtime());

      isset($_SESSION["m"]) or $_SESSION["m"] = _ex_date("n", _ex_localtime());

      isset($_SESSION["d"]) or $_SESSION["d"] = _ex_date("j", _ex_localtime());

                  
      # if we did get dates, translate things
      # like apr -2 2004 to mar 28 2004  .etc
      if(!$_REQUEST['d'])
      $_SESSION['d'] = min($_SESSION["d"], _ex_date("t",_ex_mktime(0,0,0,$_SESSION['m'],1,$_SESSION['y'])));

      $time = _ex_mktime(0,0,0,$_SESSION["m"],$_SESSION["d"],
          $_SESSION["y"]);
    
      list($_SESSION["m"],$_SESSION["d"],$_SESSION["y"]) =
          explode("-", _ex_date("n-j-Y", $time)); 


   }

   $_SESSION["time"] = $time;


}


###########################
# WRITE OUT THE SESSION DATA
##############################

function stop()
{

   if(@constant("_CAL_USE_SESSION_") == 0 || $this->stopped) return;

   $this->_c_ses_write();

   $this->stopped = true;
}


function _c_ses_read()
{

   global $_cal_sql;
   $_cal_sql or $_cal_sql = new _cal_sql();

   list($ses) = $_cal_sql->query("select session_data from {$GLOBALS['_cal_dbpref']}Sessions where
        session_id = '". md5($this->session_id .".".$_SERVER['REMOTE_ADDR']) ."'");

   if(count($ses)) {
      $this->exists = 1;
      $_SESSION = @array_merge(unserialize($ses['session_data']), $this->_ses_pre);
      return 1;
   } else {
      $this->exists = 0;
   }

   return 0;

}

function _c_ses_write()
{

   global $_cal_dbpref;


   global $_cal_sql;
   $_cal_sql or $_cal_sql = new _cal_sql();

   $v = $_cal_sql->escape_string(serialize($_SESSION));

   if(!$this->exists) {

        $_cal_sql->query("insert into {$_cal_dbpref}Sessions (session_id, session_data, session_expiration)
           values ('". md5($this->session_id .".". $_SERVER['REMOTE_ADDR']) .
            "', '". $v ."', '". (time() + $this->max_life) ."')");

       $this->exists = 1;

   } else {

      $_cal_sql->query("update {$_cal_dbpref}Sessions set session_data = '". $v ."', session_expiration = ".
        (time() + $this->max_life) ." where session_id = '".
        md5($this->session_id .".".$_SERVER['REMOTE_ADDR'])."'"); 

   }

}

function destroy()
{

   global $_cal_sql;
   $_cal_sql or $_cal_sql = new _cal_sql();

   $_cal_sql->query("delete from {$GLOBALS['_cal_dbpref']}Sessions where
         session_id = '". md5($this->session_id .".".$_SERVER['REMOTE_ADDR']) ."'");

}

function _c_ses_gc()
{

   global $_cal_sql;
   $_cal_sql or $_cal_sql = new _cal_sql();

   $_cal_sql->query("delete from {$GLOBALS['_cal_dbpref']}Sessions where
        session_expiration < ". time());


}

}
?>
