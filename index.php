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

/*/ debugging
$encoded = '';
// include GET as well as POST variables; your needs may vary.
foreach($_GET as $name => $value) {
  $encoded .= urlencode($name).'='.urlencode($value).'&';
}
foreach($_POST as $name => $value) {
  $encoded .= urlencode($name).'='.urlencode($value).'&';
}
// chop off last ampersand
$encoded = substr($encoded, 0, strlen($encoded)-1);

echo "<P>Return response => ".$encoded."<P>";

//------- end of debug code  ------------- */


$_cal_orig_mqr = get_magic_quotes_runtime();
ini_set('magic_quotes_runtime', 0);
   # initial install?
   @include_once(dirname(__FILE__) . "/include/config.php");

   if(!@defined("_CAL_SQL_DRIVER_") && file_exists("install.php")) {
      header("Location: install.php");
      exit;
   }

   # holds notes for events
   $GLOBALS['_cal_notes'] = array();

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.calendar_real.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");


   define("_CAL_USE_SESSION_", 1);
   define("_CAL_INTERFACE_MAIN_", 1);

   # LOGOUT USERR
   ######################333
   if($_REQUEST['logout']) {
      $_REQUEST['userid'] = $_REQUEST['pass'] = "";
      $s = new _cal_session();
      $s->start();
      $s->destroy();

      if(!is_array($_SESSION)) $_SESSION = array();

      foreach(array_keys($_SESSION) as $k) {
         unset($_SESSION[$k]);
      }

      unset($s);
   }

   global $_cal_html, $_cal_user, $_cal_views, $_cal_modules, $_cur_cal;

   $_cal_html = new _cal_html();

   ###############################
   #
   ### Apple Safari fix
   #
   ###############################
   if(!@constant("_CAL_EMBEDDED_") && strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "safari") !== false) {
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0", true);
      header("Pragma: no-cache");
   }

   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
   
   # GET USER'S DEFAULT CALENDAR
   if($_GET['calendar'] == 'USERDEFAULT') {
      $_cur_cal = new _cal_obj($_cal_user->options->default_cal);
      $_SESSION['calendar'] = $_cal_user->options->default_cal;
   }
  
   ($_cur_cal && $_cur_cal->id == $_SESSION['calendar']) or $_cur_cal = new _cal_obj(abs($_SESSION['calendar']));

   # check for calendar access
   ###########################
   if(($_SESSION['calendar'] && !$_cal_user->access->can_view($_cur_cal)) || !$_SESSION['calendar']) {
      $_SESSION['calendar'] = 0;
      $_cur_cal = new _cal_obj(0);
   }



   # include our modules definitions
   ###################################
   require_once(@constant("_CAL_BASE_PATH_") ."include/modules.php");  


   #############################
   #
   ### DECIDE WHAT TO DISPLAY
   #
   #############################


   # events ?
   #################### 
   if(isset($_REQUEST['event_action'])) {

      $_cal_view = "events";

   # modules ?
   ##################
   } else if($_cal_modules[$_REQUEST['module']]) {

      $mod = $_cal_modules[$_REQUEST['module']];

      # is the default user allowed?
      ##############################
      if($mod['no_guest'] && $_cal_user->guest) {
         $_cal_html->permission_denied(true); # fixed
         return;
      } 

      # is it an admin module
      #############################
      if($mod['admin_module'] && !$_cal_user->admin) {
         $_cal_html->permission_denied(true); # fixed
         return;
      }

      $_cal_view = "module";

      $_cal_view_url = "module=". $_REQUEST['module'];


   # default to this session's
   # last known view
   #################
   } else {

      $_cal_view = $_SESSION["v"];
      $_cal_view_url = "v=". $_cal_view;

   }



   # figure out our title and set persistent
   # url to go to
   switch($_cal_view)
   {  
      case "y":
      $t = _YEAR_;
      $_cal_tmp1 = 'year';
      break;
      
      case "m":
      $t = _MONTH_;
      $_cal_tmp1 = 'month';
      break;
      
      case "d":
      $t = _DAY_;
      $_cal_tmp1 = 'day';
      break;
      
      case "w":
      $t = _WEEK_;
      $_cal_tmp1 = 'week';
      break;
      
      case "module":
         $t = $_cal_modules[$_REQUEST['module']]['display_name'];
         break;
      
      case "events";
        $t = _EVENTS_;

        if($_REQUEST['event_action'] && $_REQUEST['eid']) {
           list($e) = $_cal_sql->query("select title from {$_cal_dbpref}Events where id = ".
                intval($_REQUEST['eid']));

           if($e['title']) $t = $e['title'];
        }
        break;
   }


#######################
#
### GET CURRENT CALENDAR
#
#########################

if($_SESSION['calendar']) {

      ########################
      #
      # ADD RSS FEED LINK
      #
      #########################
      if(strlen($_cal_view) == 1 && $_cal_view != 'y') {

         $_cal_html->add_head("<link rel=\"alternate\" type=\"application/rss+xml\"
            title=\"{$_cur_cal->description}\" href=\"".@constant("_CAL_BASE_URL_") .
            "remote/rss.php?calendar={$_cur_cal->id}"._CAL_AMP_."view={$_cal_tmp1}\" >");

      }



}

   ##################################
   #
   ### SET PAGE TITLE
   #
   ##################################
   if(($_cal_view == "module" && $_cal_modules[$_REQUEST['module']]['keep_cal_title']) || $_cal_view != "module")
      $t = ($_cur_cal->title ? $_cur_cal->title ." - " : "") . $t;
     
   $_cal_html->print_header($t);

   # check if admin 
   #################################################
   if($GLOBALS['_cal_user']->logged_in && $GLOBALS['_cal_user']->admin) {

      # check if install.php still exists
      ###################################
      if(file_exists(@constant("_CAL_BASE_PATH_") . "install.php"))
           $_cal_html->warning(sprintf(_WARNING_INSTALL_, constant("_CAL_BASE_PATH_") .  "install.php"));

   }

   # require newWin
   require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");


# header start
################

##################################
#
### CALNEDAR SETUP AND INFO
#
###################################
if(!$_cur_cal->not_found) {

   # NOTIFY OF INVALID CALENDARS
   #################################
   $_cur_cal->get_constraint();
   if(count($_cur_cal->invalids)) {


         $titles = $_cal_sql->query("select id, title from {$_cal_dbpref}Calendars where id in (".
            join(",",$_cur_cal->invalids) .")", true);

         foreach($titles as $t)
            $_cal_html->warning(_VIEW_INVALID_CAL_." - <u>". $t."</u>");


   }

   $links = array();

   $durl = new _cal_url("cal_details.php");

   $durl->addArg("calendar", $_SESSION['calendar']);

   $links[] = "<a class='"._CAL_CSS_BODY_." "._CAL_CSS_ULINE_."'
        href=\"javascript:newWin('". $durl->toString() ."', 500, 700)\">".  _DETAILS_ ."</a>";

   $durl = new _cal_url("cal_publisher.php");
   $durl->addArg("calendar", $_SESSION['calendar']);


   if(function_exists("curl_init")) {

      $links[] = "<a class='"._CAL_CSS_BODY_." "._CAL_CSS_ULINE_."'
        href=\"javascript:newWin('". $durl->toString() . "', 300, 500)\">".  _PUBLISH_ ."</a>";

   }
 
   $_cal_info['title'] = $_cur_cal->title;
   $_cal_info['description'] = $_cur_cal->description; 

   # PRINT CALENDAR TITLE
   ###########################
   if(($_cal_view == "module" && $_cal_modules[$_REQUEST['module']]['keep_cal_title']) || ($_cal_view != "module" && $_cal_view != "events"))
      _ex_cal_title($_cal_info, $links);

   $links = array();

} 


# main table start..
####################
echo("<table border='0' cellpadding=0 cellspacing=0 width='100%' style='border-collapse: collapse;'>
<tr valign=top>
   <td class='"._CAL_CSS_BODY_."'>");

##################################
#
### TABS
#
###################################  


   $_cal_views = array("d" => _DAY_, "w" =>_WEEK_, "m" => _MONTH_ , "y" => _YEAR_,
	"events" => _EVENTS_);

   $url = new _cal_url();

   $url->addArg("v","d");
   $_cal_modules['daytab'] = array('display_name' => _DAY_,'url' => $url->toString(),
        'selected' => ($_cal_view == "d"), 'priority' => 5);

   $url->addArg("v","w");
   $_cal_modules['weektab'] = array('display_name' => _WEEK_,'url' => $url->toString(),
        'selected' => ($_cal_view == "w"), 'priority' => 10);

   $url->addArg("v","m");
   $_cal_modules['monthtab'] = array('display_name' => _MONTH_,'url' => $url->toString(),
        'selected' => ($_cal_view == "m"), 'priority' => 15);

   $url->addArg("v","y");
   $_cal_modules['yeartab'] = array('display_name' => _YEAR_,'url' => $url->toString(),
        'selected' => ($_cal_view == "y"), 'priority' => 20);

   $url->addArg("v", "events");
   $_cal_modules['eventstab'] = array('display_name' => _EVENTS_,'url' => $url->toString(),
        'selected' => ($_cal_view == "events"), 'priority' => 25); 

   $url->addArg("v","");

   $tabs_int = array('daytab','weektab','monthtab','yeartab','eventstab');

   ##########################
   # GET TAB MODULES IF ANY
   ###########################
   if(!is_array($_cal_modules['tab']['sub_modules'])) $_cal_modules['tab']['sub_modules'] = array();

   $_cal_modules['tab']['sub_modules'] = array_merge($tabs_int, $_cal_modules['tab']['sub_modules']);

   usort($_cal_modules['tab']['sub_modules'], "_ex_mod_cmp");

   foreach($_cal_modules['tab']['sub_modules'] as $mn)
   {

      $url->addArg("module", $mn);

      $name = $_cal_modules[$mn]['display_name']; 
      $selected = $_cal_modules[$mn]['selected'] || ($_cal_view == "module" && $_REQUEST['module'] == $mn);
      $tabs[] = array('name' => $name, 
        'url' => ($_cal_modules[$mn]['url'] ? $_cal_modules[$mn]['url'] : $url->toString()),
        'selected' => $selected); 
   }


   echo("<div class='"._CAL_CSS_CALTABS_."'>\n");

   if(function_exists("_ex_tabs")) {
      _ex_tabs($tabs);
   }

   echo('</div>');


# CHECK THAT OUR VIEW IS VALID
###############################
if(!$_cal_views[$_cal_view] && $_cal_view != "module")
   $_SESSION["v"] = $_cal_view = "m";



# end main table row
echo("</td>\n</tr>\n");

# start a new one..
echo("<tr class='"._CAL_CSS_MAIN_HEADER_."'>\n<td class='"._CAL_CSS_MAIN_HEADER_."'>\n");

# header row for main table..
###########################

if(function_exists("_ex_content_header"))
   _ex_content_header();

# end main table row
echo("</td>\n</tr>\n");
                              
# start a new one..
echo("<tr valign='top'>\n<td>\n");


# new table for content
echo("<table width='100%' style='border-collapse: collapse' class='"._CAL_CSS_BOUNDING_TABLE_."'>
<tr valign='top'>\n");

usort($_cal_modules['navbar']['sub_modules'], "_ex_mod_cmp");

# ARE WE HIDING THE NAV BAR?
##############################
if($_SESSION['hide_nav'] || $_REQUEST['event_action'] || $_cal_view == 'events' || 
	($_cal_view == "module" && $_cal_modules[$_REQUEST['module']]['hide_nav'])) {

   echo("<td class='"._CAL_CSS_BOUNDING_TABLE_."' style='padding-left: 20px; padding-right: 20px; padding-bottom: 20px;'>\n");
   main_cal();
   echo("</td>\n");


# PRINT NAV BAR
###################################
} else {

  
   if($_cal_modules['navbar']['modules_left']) {
      # spacer
      echo("<td class='"._CAL_CSS_MAIN_HEADER_."' width=5></td>");
      echo("<td class='"._CAL_CSS_MAIN_HEADER_."' style='vertical-align: top' align=center width='150'>\n");
      require(@constant("_CAL_BASE_PATH_") ."modules/navbar/navbar.php");
      echo("</td>");

      # spacer
      echo("<td class='"._CAL_CSS_MAIN_HEADER_."' width=5> </td>");

   }
 
   echo("<td class='"._CAL_CSS_BOUNDING_TABLE_."'>");
   main_cal();
   echo("</td>");

   if($_cal_modules['navbar']['modules_right']) {

      # spacer 
      echo("<td class='"._CAL_CSS_MAIN_HEADER_."' width=5> </td>");

      echo("<td class='"._CAL_CSS_MAIN_HEADER_."' style='vertical-align: top' align=center width=150>");
      require(@constant("_CAL_BASE_PATH_") . "modules/navbar/navbar.php");
      echo("</td>");

      # spacer 
      echo("<td class='"._CAL_CSS_MAIN_HEADER_."' width=5> </td>");
   }

} 


echo("\n</tr>\n</table>\n");

echo("\n</td>\n</tr>\n<tr valign='middle'>\n<td>\n");

$url = new _cal_url();
$url->addArg("module", $_REQUEST['module']);

# footer row for main table..
###########################

if($_SESSION['hide_nav'] != 1) {

   $url->addArg("hide_nav", "1");

   $link = "<a href='". $url->toString() ."'><img
      src='". $_cal_html->get_img_url("images/view_remove.gif") ."' alt='hide nav'
      align='middle' width='12' height='12' style='vertical-align: middle;'
      border=0></a>";


} else {
  
   $url->addArg("hide_nav", "0");

   $link = "<a href='". $url->toString() ."'><img
      src='". $_cal_html->get_img_url("images/view_left_right.gif") ."' alt='show nav'
      width='12' height='12' style='vertical-align: middle; text-align: middle;'
      align='middle'
      border=0></a>";

}


if(!$_REQUEST['event_action']) {

   global $_cal_modules;

   $links = array();

   if(
        ($_cal_modules['navbar']['modules_left'] || $_cal_modules['navbar']['modules_right'])
        &&
       !($_REQUEST['event_action'] || $_cal_view == 'events' ||
        ($_cal_view == "module" && $_cal_modules[$_REQUEST['module']]['hide_nav']))) {
      $links[] = _VIEW_NOUN_ .": ". $link;
   } else {
      $links = array();
   }

   # sort footer modules..
   usort($_cal_modules['footer']['sub_modules'], "_ex_mod_cmp");

   foreach($_cal_modules['footer']['sub_modules'] as $mn)
   {

      $mod = $_cal_modules[$mn];

      if($_cal_user->guest && $mod['no_guest'])
         continue;

      if(!$_cal_user->guest && $mod['guest_only'])
         continue;

      if(!$_cal_user->admin && $mod['admin_module'])
         continue;

      if($_cal_user->admin && $mod['no_admin'])
         continue;

      $url = new _cal_url();
      $url->addArg("module", $mn);
     
      $links[] = "<a class='"._CAL_CSS_MAIN_HEADER_."' href='". $url->toString() ."'>".
	$mod['display_name'] ."</a>";


   }


   $url = new _cal_url();
 
   if(!$_cal_user->guest) {


      $url->addArg("logout", "1");
      $links[] = "<a class='"._CAL_CSS_MAIN_HEADER_."' href='". $url->toString() ."'>". _LOGOUT_ .
        (!@constant("_CAL_HIDE_USER_LOGOUT_") ? " - ". $_cal_user->userid : "")
        ."</a>";

      $url->addArg("logout", "");



   } else {

         $url = new _cal_url(_CAL_PAGE_LOGIN_);
         $links[] = "<a href='". $url->toString() ."' class='"._CAL_CSS_MAIN_HEADER_."'>". 
		_LOGIN_ ."</a>";

   } 


}

if(function_exists("_ex_content_footer")) {
   _ex_content_footer($links);
} else {
   foreach($links as $link) {
      echo($link . " ");
   }

}
echo("\n</td>\n</tr>\n</table>\n");

#######################
#
#### QUICK ADD BOX
#
#######################
if(!($_cal_view == "module") && !isset($_REQUEST['event_action']) && $_cal_user->access->can_add($_cur_cal) && !@constant("_CAL_HIDE_QUICK_ADD_")) {
   echo("<br>");
   require_once(@constant("_CAL_BASE_PATH_") . 'include/quick_add_event.php');
}



#
#
#######################

if(!@constant("_CAL_NO_ADV_")) {


   echo("<br>");
   echo("<div align='left' style='font-size: 9px;'>
   <style='color: #000; font-weight: 400;'>
   <b>Thyme " . _THYME_VER_  ."</b>");
}


##############################
#
### NOTE POPUPS
#
##############################
require_once(@constant("_CAL_BASE_PATH_") . "include/js/notes_popups.js");

$_cal_popups = "";

if(!@constant("_CAL_THEME_POPUPS_")) {
   ob_start();
   require_once(@constant("_CAL_BASE_PATH_") . "include/event_notes_popup.php");
   $_cal_popups = ob_get_contents();
   ob_end_clean();
} else {
   require_once(_CAL_BASE_PATH_."include/event_notes_popup.php");
}

ob_start();
# print remaining notes popups
foreach($GLOBALS['_cal_notes'] as $n) {
   print $n;
}
$_cal_popups .= ob_get_contents();
ob_end_clean();

$_cal_html->print_footer($_cal_popups);


############################
#
### MAIN CALENDAR OR EVENT
#
############################

function main_cal()
{

   global $_cal_view, $_cal_html, $cal, $_cal_modules;

   $cal or $cal = new _cal_calendar_real();

   if($_SESSION['evnt_type'] > 0) $cal->event_types = $_SESSION['evnt_type'];

   $cal->show_footer = 1;
   $cal->printable = 1;

   switch($_cal_view)
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

      case "module":
         require_once(@constant("_CAL_BASE_PATH_") ."modules/" .$_cal_modules[$_REQUEST['module']]['include']);
         break;

      case "events";
      require_once(@constant("_CAL_BASE_PATH_") . "include/events.php");
      break;

   }

}

function _ex_is_writable($f, $mkdir = false)
{

   # NOT WINDOWS?
   if(strtolower(substr(PHP_OS,0,3)) != 'win') {

      if($mkdir || is_dir($f)) @chmod($f,0777);
      else @chmod($f, 0666);

      return is_writable($f);
   }

   @chmod($f,0666);

   # dir?
   if(is_dir($f)) {

      if($mkdir) {
         if(is_dir($f .'\\t_ex_is_writable')) return true;

         return @mkdir($f.'\\t_ex_is_writable');
      }

      if(is_file($f .'\\t_ex_is_writable.tmp')) return true;

      $ret = @fopen($f .'\\t_ex_is_writable.tmp',"w");

      if(!$ret) return false;

      fclose($ret);
      return true;

   }

   # file
   $ret = @fopen($f, "a");
   if(!$ret) return false;
   fclose($ret);

   return true;
   
}

