<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
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


if(!@include_once(@constant("_CAL_BASE_PATH_") ."customize/css_defines.php"))
   require_once(@constant("_CAL_BASE_PATH_") ."css/css_defines.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.session.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.repeater.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/languages/". constant("_CAL_LANG_") .".php");
## require_once(@constant("_CAL_BASE_PATH_") . "include/languages/en_US.php");
if(!@constant("_CAL_AMP_")) {
   define("_CAL_AMP_", "&amp;");
}

if(!defined("_CAL_PAGE_LOGIN_")) @define("_CAL_PAGE_LOGIN_", "login.php");
if(!defined("_CAL_PAGE_MAIN_")) @define("_CAL_PAGE_MAIN_", "index.php");
if(!defined("_CAL_PAGE_PRINT_")) @define("_CAL_PAGE_PRINT_", "print.php");


class _cal_html
{

   var $timer;

   var $session;

   var $js_onload = array();

   var $_head = array();

##########################

function getmicrotime()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

###############

function _cal_html($skip_login = false)
{

   global $_cal_user, $_cal_theme;

   $this->session = new _cal_session();
   $this->session->start();


   # IT WILL ONLY REMOVE THE WARNING IT GIVES WHEN IT'S
   # ABOUT TO EXPIRE
   #####################################################
//   if(!_ex_valid_license_key() && _CAL_EXPIRATION_ < time()) {

//      $this->_lic_warning = "Thyme's license has expired. You may purchase Thyme at http://www.extrosoft.com";

//   } else if(_CAL_EXPIRATION_ > time() && !_ex_valid_license_key()) {

//      $d = floor(_CAL_EXPIRATION_/86400) - floor(time()/86400);

//      if($d < 7) {
//         $this->_lic_warning = sprintf(_WARNING_LICENSE_, $d);
//      }

//   }

   $_cal_user = new _cal_user($_REQUEST['userid'], $_REQUEST['pass']);

   if(!$_cal_user->login() && basename($_SERVER['PHP_SELF']) != _CAL_PAGE_LOGIN_ && (!$skip_login)) {

      require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");

      $lurl = new _cal_url(_CAL_PAGE_LOGIN_);
      if($_REQUEST['userid'] && $_REQUEST['pass']) $lurl->addArg("msg", _BAD_PASS_);

      if(!$_REQUEST['logout'] && !$_SESSION['lp'] && @constant("_CAL_USE_SESSION_")) {

         $lp = $_SERVER['PHP_SELF'] .'?';
         foreach (array_keys($_GET) as $get) {
            if($get == 'userid' || $get == 'pass') continue;
            $lp .= urlencode($get) . '='. urlencode($_GET[$get]) .'&'; 
         }
         $lp = rtrim($lp,"&?");

         $_SESSION['lp'] = $lp;
         $this->session->stop();
      }
      $this->print_header(_LOGIN_);
      $this->js_redirect($lurl->toString());
      echo("<a href='". $lurl->toString() ."'>". _LOGIN_ ."</a>");
      $this->print_footer();
      exit;
   }

   if($_SESSION['lp'] && basename($_SERVER['PHP_SELF']) != _CAL_PAGE_LOGIN_) {

      $lurl = urldecode($_SESSION['lp']);
      unset($_SESSION['lp']);

      $this->session->stop;

      $this->print_header("");
      $this->js_redirect($lurl);
      echo("<a href='". $lurl ."'>". _GO_ ."</a>");
      $this->print_footer();
      exit;
   }


   $this->session->fill_vars();

   if(@constant("_CAL_BENCHMARK_") == 1)
      $this->timer = $this->getmicrotime();

   require_once(@constant("_CAL_BASE_PATH_") ."include/theme_engine.php");
   _ex_theme_set($_cal_user->options->theme);


}


#########

function js_redirect($url)
{

   if(isset($this->pre_mod_hide_nav)) {
      $_SESSION['hide_nav'] = $this->pre_mod_hide_nav;
   }

   $this->session->stop();
   echo("<script language='JavaScript' type='text/javascript'>\ndocument.location = '");
   echo($url ."';\n</script>\n");

}


######

function print_heading($l="",$m="",$r="")
{
   
   global $_cal_user, $_cal_theme;
  

   if(function_exists("_ex_content_title")) {
      call_user_func('_ex_content_title', $l,$m,$r);
      return;
   }


   echo("<table border=0 width='100%' class='"._CAL_CSS_HEADING_."'>
             <tr valign='middle'>
             <td align='". $this->heading_align ."'><font class='"._CAL_CSS_HEADING_."'>");
   echo($l);
   echo("</font>\n</td>\n");

   if(strlen($m) > 0) {
      echo("<td align='right'><font class='"._CAL_CSS_HEADING_."'>");
      echo($l);
      echo("</font>\n</td>\n");
   }
     
   echo("</tr>\n</table>\n");

}

function print_sub_heading($text)
{

   call_user_func('_ex_section_header', $text);
}


function print_header($title = "", $strXTRA = "")
{

   global $_cal_user, $_cal_theme, $_cur_cal;

   $this->title = (defined("_CAL_SITE_NAME_") ? _CAL_SITE_NAME_ ." " : "Thyme") . " - " . $title;

   if(@constant("_CAL_EMBEDDED_")) {

      echo('<script type="text/javascript">
      <!--

      var link = document.createElement("link");

      link.setAttribute("href", "'._CAL_BASE_URL_.'css/master_css.php?theme='.$_cal_theme["name"].'&calendar='.$_cur_cal->id.'"); 
      link.setAttribute("rel", "stylesheet");
      link.setAttribute("type", "text/css");
      document.getElementsByTagName("head").item(0).appendChild(link);

      //-->
      </script>
      ');

      echo("<div id='cal'>\n");
      return;

   }

   @Header("Content-Type: text/html; charset=". _CHARSET_);

   if(strlen($strXTRA) > 0) {
      @Header($strXTRA);
   }

   echo("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" >\n");
   echo("\n<html>\n<head>\n");
   echo("<meta http-equiv=\"Content-type: text/html; charset="._CHARSET_."\" />\n");
   echo("<title>" . $this->title . "</title>\n");

   foreach($this->_head as $str) {
      echo($str ."\n");
   }

   echo("<link rel=\"stylesheet\" TYPE=\"text/css\" href=\"".
      @constant("_CAL_BASE_URL_") ."themes/".
      $_cal_theme['name'] ."/style/style.css\">\n");
  
   if(file_exists(_CAL_BASE_PATH_."customize/notes_popups.css")) {
      $notes_css = "customize/notes_popups.css";
   } else {
      $notes_css = "css/notes_popups.css";
   }

   $url = new _cal_url($notes_css);

   echo("<link rel=\"stylesheet\" TYPE=\"text/css\" href=\"".
	$url->toString() ."\">\n");

   require_once(@constant("_CAL_BASE_PATH_") . "css/calendar_css.php");

   @include(_CAL_BASE_PATH_."customize/site_head.html");

   echo("\n</head>\n");

   # body ...
   ############
   echo("<body class='"._CAL_CSS_CAL_."'>\n");

   if(@constant("_CAL_INTERFACE_MAIN_")) @include_once(_CAL_BASE_PATH_."customize/site_header.html");

   echo("<div id='cal'>\n");


   if($this->_lic_warning) {
      $this->warning($this->_lic_warning);
   }

}



###################

function apply_style($theme)
{

echo("<style type='text/css'>");
   require_once(@constant("_CAL_BASE_PATH_") . "themes/". $theme ."/style/style.css");
echo("</style>\n");

}


#################

function get_img_url($di)
{

   global $_cal_user, $_cal_theme;

   $img = preg_replace("/.*\//", "", $di);

   if(file_exists(@constant("_CAL_BASE_PATH_") . "themes/". $_cal_theme['name'] ."/images/" . $img))
      $img = new _cal_url("themes/". $_cal_theme['name'] ."/images/" . $img);
   else
      $img = new _cal_url($di);

   $img->args = array();
   return $img->toString();

}

#################
function print_footer($xtra = "")
{

   if(@constant("_CAL_BENCHMARK_") == 1) {
      $time_end = $this->getmicrotime();
      $time = substr($time_end - $this->timer, 0, 4);
   
      echo("<div align='center'>Page generated in ". $time ." seconds - {$GLOBALS['_cal_sql']->qs} SQL queries</div>");
   }

   if(count($this->js_onload)) {

      echo("<script language='JavaScript' type='text/javascript'>\n");
      echo("<!--\n");
      foreach($this->js_onload as $js) {
	   echo($js ."\n");
      }
      echo("\n// -->\n</script>\n");
   }

   echo("</div>\n");
   echo($xtra);

   if($this->_lic_warning)
   echo("<!-- CLE: ". @constant("_CAL_LIC_ERROR_") ." -->");


   if(@constant("_CAL_INTERFACE_MAIN_")) @include_once(_CAL_BASE_PATH_."customize/site_footer.html");

   if(!@constant("_CAL_EMBEDDED_")) echo("\n</body>\n</html>\n");

   $this->session->stop();

}

#################

function permission_denied($print_header = false)
{

   global $_cal_user;

   if($print_header)
      $this->print_header("Access Denied");


   echo("<h3>Access Denied</h3><br>\n");

   echo("You do not have access to perform the requested action.");


   if(!@constant("_CAL_USE_SESSION_") || @constant("_CAL_NO_PERM_REDIR_") || !$_cal_user->guest)
      return;


   $lp = $_SERVER['PHP_SELF'] .'?';
   foreach (array_keys($_GET) as $get) {
      if($get == 'userid' || $get == 'pass') continue;
      $lp .= urlencode($get) . '='. urlencode($_GET[$get]) .'&';
   }
   $lp = rtrim($lp,"&?");

   $_SESSION['lp'] = $lp;
   $_SESSION['lp_count'] = intval($_SESSION['lp_count']) + 1;


   if($_SESSION['lp_count'] > 2) {
      unset($_SESSION['lp']); 
      unset($_SESSION['lp_count']);
   }

   $this->session->stop();

   $lurl = new _cal_url(_CAL_PAGE_LOGIN_);

   ###################################
   # IF THERE WQS NO REFERER, LOGIN
   ###################################
   if(!preg_match("/"._CAL_PAGE_LOGIN_."$/",$_SERVER['HTTP_REFERER'])) {

      $this->js_redirect($lurl->toString());
      $this->print_footer();
      return;
   }

   echo("<br><br><a href='". $lurl->toString() ."'>". _LOGIN_ ."</a>\n");


}

function warning($str)
{
      echo("<div align='left'
        style='background: #ffffbb; color: #000; border: 1px solid black; font-size: 12px; padding: 2px;'>
        <img alt='warning' src='".@constant("_CAL_BASE_URL_") ."images/warning.gif'> $str</div><br>");
}

function add_head($str)
{
   $this->_head[] = $str;

}


}

?>
