<?php

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

#jobs.php

require_once(dirname(__FILE__) . "/include/config.php");

@include_once(_CAL_BASE_PATH_."customize/run_job.php");

error_reporting(E_ALL ^ (E_NOTICE));

#########################
#
### GET OS
#
#########################

if (strtolower(substr(PHP_OS, 0, 3)) == 'win') {
   define("_WIN32_", 1);
} else {
   define("_WIN32_", 0);
}

# GET TIME
$now = time();
$now -= ($now % 60);

# DEFAULT JOBS:
#
# subscriptions.php 	every 30 minutes
# rss.php		every 20 minutes
# notifications.php	every 5 minutes
# reminders.php		every 5 minutes
###########################################

if(!@constant("_CAL_JOB_INTERVAL_")) define("_CAL_JOB_INTERVAL_", 5);

$jobs = array (
	'jobs/subscriptions.php' => 30,
	'jobs/rss.php' => 5,
	'jobs/notifications.php' => 5,
	'jobs/reminders.php' => 5
	);

# CHECK FOR OTHER JOBS
##########################
$dh = dir(@constant("_CAL_BASE_PATH_")."modules");
while (false !== ($entry = $dh->read())) {

   if(substr($entry, 0,1) == ".") {
      continue;
   }

   @include(@constant("_CAL_BASE_PATH_"). "modules/".$entry."/register_job.php");

}

# PHP CLI
###########
if(@constant("_CAL_PHP_CLI_")) $php = _CAL_PHP_CLI_;
else $php = PHP_BINDIR . DIRECTORY_SEPARATOR . 'php' . (@constant("_WIN32_") ? ".exe" : "");

# NO PHP CLI?
##############
if(!file_exists($php)) {
  define("_NO_CLI_", 1);
  require_once(_CAL_BASE_PATH_."include/http_get.php");
}


if(@constant("_CAL_JOB_DEBUG_")) {
	date_default_timezone_set('America/Vancouver');
   echo("jobs.php: running batch jobs at ". date("Y-n-j H:i:s", $now) ."\n");
}
# RUN JOBS
#
#############
foreach(array_keys($jobs) as $j)
{

   if(@constant("_CAL_JOB_DEBUG_")) {

      echo("checking job $j .. every {$jobs[$j]} minutes ..\n");

     if ((_CAL_JOB_INTERVAL_ > $jobs[$j]) || ((_CAL_JOB_INTERVAL_ < $jobs[$j]) && ($jobs[$j] % _CAL_JOB_INTERVAL_)) 
	|| ($now % ($jobs[$j] * 60) == 0)) {

        echo(".. running this job..\n");

     } else {

        echo(".. skipping this job ..\n");

     }

   }

   if(!((_CAL_JOB_INTERVAL_ > $jobs[$j]) || ((_CAL_JOB_INTERVAL_ < $jobs[$j]) && ($jobs[$j] % _CAL_JOB_INTERVAL_))
        || ($now % ($jobs[$j] * 60) == 0))) continue;



   if(function_exists("run_job")) {
      run_job($j);
      continue;
   }

   if(@constant("_NO_CLI_")) {
      if(@constant("_CAL_JOB_DEBUG_")) echo("going to ". @constant("_CAL_BASE_URL_") . $j ."\n");

      _ex_http_get(@constant("_CAL_BASE_URL_") . $j);

   } else {
      if(@constant("_CAL_JOB_DEBUG_")) echo("running ". mk_cmd_str("\"$php\" \"". @constant("_CAL_BASE_PATH_") . $j ."\"") ."\n");
      echo(exec(mk_cmd_str("\"$php\" \"". @constant("_CAL_BASE_PATH_") . $j ."\"")));
   }

}



##########################
#
### CREATE COMMAND STRING
#
##########################
function mk_cmd_str($cmd)
{


   if(@constant("_WIN32_"))
      return "start \"thyme task\" ". $cmd;

 
   return $cmd ." &";
 

}

?>
