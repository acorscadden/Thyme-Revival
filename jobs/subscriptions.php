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

$now = time();

define("_CAL_BASE_PATH_", preg_replace("/jobs$/","",preg_replace("/\\\/","/",dirname(__FILE__))));

define("_CAL_USE_SESSION_", 0);
define("_CAL_BENCHMARK_", 0);
define("_CAL_DOING_EMAIL_", 1);
define("_CAL_DOING_OPTS_", 1);

@define("_CAL_INSIDE_JOB_", 1);

require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.mailer.php");

global $_cal_sql, $_cal_user, $_cal_html, $_cal_tmpl, $_cal_form, $_cal_dbpref;

if(!@constant("_CAL_JOB_INTERVAL_")) define("_CAL_JOB_INTERVAL_", 5);

$_cal_html = new _cal_html(true);
$_cal_sql or $_cal_sql = new _cal_sql();

# get all subscriptions
##########################
$subs =  $_cal_sql->query("select {$_cal_dbpref}Subscriptions.*, {$_cal_dbpref}ContactOpts.email,
    {$_cal_dbpref}Calendars.title
    from {$_cal_dbpref}Subscriptions
    left join {$_cal_dbpref}ContactOpts on {$_cal_dbpref}ContactOpts.id = {$_cal_dbpref}Subscriptions.contact
    left join {$_cal_dbpref}Calendars on
    {$_cal_dbpref}Calendars.id = abs({$_cal_dbpref}Subscriptions.calendar)
    where {$_cal_dbpref}Subscriptions.calendar != 0");


# calendar module
require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.calendar.php");

$cal = new calendar();
$cal->set("static", true);
$cal->set("show_header_links", false);
$cal->set("hil_day", false);

# GET TIME
$now = time();
$now -= ($now % 60);

$modifier = 0;

foreach($subs as $s)
{

   $_cal_user = new _cal_user("","",$s['uid']);

   $curtime = $_cal_user->to_localtime($now);

   # MODIFY CURTIME
   ######################
   if(_CAL_JOB_INTERVAL_ >= 30 && _ex_date("H:i", $curtime) != "00:00") {

       # get difference between now and the next time the
       # job will run, in minutes
       list($hr,$mn) = preg_split("/:/",_ex_date("H:i", $curtime));
       $mn = intval($mn) + (intval($hr) * 60);
       $mn = (1440 - $mn);

       # if we're going to hit right at
       # midnight, just keep going
       ##################################
       if($mn % _CAL_JOB_INTERVAL_ == 0) continue;

       # is it closer to e-mail before or after
       #########################################
       $maxtime = $mn - (_CAL_JOB_INTERVAL_ * intval(floor($mn / _CAL_JOB_INTERVAL_)));
       $overtime = _CAL_JOB_INTERVAL_ - $maxtime;


       # before
       if($maxtime <= $overtime) {

          # we're there, modify curtime 
          if($maxtime == $mn) {

             $curtime += ($mn * 60);

             $modifier = ($mn * 60);

          }

       # after
       } else {

          # we're there, modify curtime
          if($overtime == (1440 - $mn)) {

             $curtime -= ($overtime * 60);

             $modifier = -($overtime * 60);

          } 

       }

   }


   # if it's not midnight for this user, continue...
   ##################################################
   if(_ex_date("H:i", $curtime) != '00:00') {
      continue;
   }

   # if we're on a weekly subcription and it's not
   # the first day of the week, continue
   if((_ex_date("w", $curtime) != $_cal_user->options->week_start) && $s['view'] == 1)
      continue;


   # SET CALENDAR OPTIONS
   #########################
   list($y,$m,$d) = explode("-",_ex_date("Y-n-j", $curtime));
   $cal->set("calendar", $s['calendar']); 
   $cal->set("time", $curtime);
   $cal->set("e_popup", false);
   $cal->set("e_n_popup", false);

   # set email address
   if(!$s['email']) $s['email'] = $_cal_user->email;

   # couldn't set e-mail address
   ###########################3
   if(!$s['email']) {
      echo("Error: No e-mail address configured for subscription id {$s['id']}.\n");
      echo("User: {$_cal_user->name} {$_cal_user->userid}\n\n");
      continue;
   }

   # view url
   $v = ($s['view'] == 0 ? 'd' : 'w');
   $vurl = new _cal_url(_CAL_PAGE_MAIN_."?v=$v&y=$y&m=$m&d=$d&calendar=".$s['calendar']);

   # compose header..
   $mime_boundary = "==multipart_boundary_x".md5(time())."x";

   $header = "From: ". _CAL_MAIL_FROM_ ."\n";
   $header .= "MIME-Version: 1.0\n";
   $header .= "Content-type: multipart/alternative" .
                ";\n charset=\""._CHARSET_."\";\n boundary=\"$mime_boundary\"\n\n";
         
   # COMPOSE BODY OF EMAIL
   ########################
   $body = "This is a multi-part message in MIME format.\n\n" .
           "--{$mime_boundary}\n" .
           "Content-Type: text/plain; charset=\""._CHARSET_."\"\n" .
           "Content-Transfer-Encoding: 7bit\n\n";

   # text part
   $body .= "\n". $vurl->toString() ."\n\n";

   $body .= "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\""._CHARSET_."\"\n" .
             "Content-Transfer-Encoding: base64\n\n";

   ob_start();

   # start html content 
   echo("<html>\n<head>
<meta http-equiv=\"Content-type: text/html; charset="._CHARSET_."\" />
<title>"._SUBSCRIPTIONS_."</title>
</head>
<body class='"._CAL_CSS_CAL_."'>\n<div id='cal'>");

   @include(_CAL_BASE_PATH_."customize/email_header.php");

   # CSS
   echo("<style type='text/css'>\n");
   foreach(file(@constant("_CAL_BASE_PATH_") . "themes/". $_cal_user->options->theme ."/style/style.css")
        as $line)
   {

      echo(str_replace('#cal ', '',$line));


   }
   echo("</style>\n");


   switch($s['view']) {
 
      case 0:
         $view = _DAILY_;
         $cal->display_day();
         break;

      case 1:
         $view = _WEEKLY_;
         $cal->display_week();
         break;

   }
   echo("<br><br><div align='center'><a href='". $vurl->toString() ."'><font color='#000000'>"._VIEW_."</font></a> :: ");

   $surl = new _cal_url(_CAL_PAGE_MAIN_);
   $surl->addArg("module", "options");
   $surl->addArg("subact", "add_view_sub");
   $surl->addArg("userid", $_cal_user->userid);
   
   echo("<a href='". $surl->toString() ."'><font color='#000000'>" ._SUBSCRIPTIONS_ ."</font></a></div>\n");

   @include(_CAL_BASE_PATH_."customize/email_footer.php");

   echo("</div>\n</body>\n</html>\n");

   $body .= chunk_split(base64_encode(ob_get_contents())) ."\n\n"; 
   $body .= "\n--{$mime_boundary}--\n";;
   ob_end_clean();


   #######################
   #
   ## SEND MAIL
   #
   #######################

   $_cal_mailer = new _cal_mailer();

        if(strpos(_CAL_MAIL_FROM_, '<')) {

           $from['name'] = preg_replace("/\s*<.*/", "", _CAL_MAIL_FROM_);
           $from['email'] = preg_replace("/.*<\s*/", "",_CAL_MAIL_FROM_);
           $from['email'] = preg_replace("/\s*>\s*/", "", $from['email']);

        } else {

           $from['email'] = _CAL_MAIL_FROM_;
        }

        $_cal_mailer->From     = $from['email'];
        $_cal_mailer->FromName = $from['name'];

        $_cal_mailer->to = array();
        $_cal_mailer->AddAddress($s['email'],$_cal_user->name);


   $_cal_mailer->Send($header,$body, $view ." ". _CALENDAR_ ." ". _SUBSCRIPTIONS_ .": ". $s['title']);

   
}



?>
