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
//


########################################
#
### EMBEDDED INCLUDE OF ALL CSS 
#
# use in <link ..> tag in head to include
#
#########################################

   Header("Content-type: text/css");

   define("_CAL_USE_SESSION_", 1);

   if(!@constant("_CAL_BASE_PATH_"))
      define("_CAL_BASE_PATH_", preg_replace("/css$/","",dirname(__FILE__)));

   require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

   global $_cal_sql, $_cur_cal, $_cal_dbpref, $_cal_user;

   $_cal_sql = new _cal_sql();

   if(!$_REQUEST['theme']) {
      $_cal_user = new _cal_user();
      $_REQUEST['theme'] = $_cal_user->options->theme;
   }

   $ccal = $_REQUEST['calendar'] or $ccal = $_SESSION['calendar'];
   
   $_cur_cal = new _cal_obj(abs($ccal));

   # COMMON STYLE
   ################
   require_once(_CAL_BASE_PATH_."css/common.css");

   # NOTES STYLE
   #################
   if(!@include_once(_CAL_BASE_PATH_."customize/notes_popups.css"))
      require_once(_CAL_BASE_PATH_."css/notes_popups.css");

   # THEME CSS
   ###################
   include_once(_CAL_BASE_PATH_."themes/". $_REQUEST['theme'] ."/style/style.css");

   # CALENDAR CSS
   ################
   if(!$_cur_cal->id) return;

   ob_start();
   require_once(_CAL_BASE_PATH_."css/calendar_css.php");
   $css = ob_get_contents();
   ob_end_clean();
   echo(preg_replace("/<.*?>\s*$/","",preg_replace("/^\s*<.*?>\s*/", "", $css)));


?>
