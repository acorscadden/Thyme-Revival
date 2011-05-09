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


   # MANUALLY SET SOME OPTIONS
   ################################
   $_REQUEST['attch_zip'] = function_exists("gzdeflate");
   $_REQUEST['attch_max'] = $_REQUEST['attch_hide'] = 0;

   if(substr($_REQUEST['base_path'], -1) != _PATHSEP_) $_REQUEST['base_path'] .= _PATHSEP_;
   if(substr($_REQUEST['base_url'], -1) != '/') $_REQUEST['base_url'] .= '/';

   global $_cal_html, $_cal_form, $_cal_config, $_cal_tmpl;

   $_cal_html->print_heading('Step 4 :: Finish Setup');


#################################
#
### CONFIGURE FOR NO JOBS
#
################################
if($_REQUEST['finish'] == "nojob") {

   require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   $s = new _cal_sql();

   $s->quiet = true;
   $s->query("insert into "._CAL_DBPREFIX_ ."GlobalSettings 
	values('_CAL_NO_JOBS_', 1)");
   $s->quiet = false;

   $s->query("update "._CAL_DBPREFIX_."GlobalSettings set setting = 1
	where variable = '_CAL_NO_JOBS_'");

   echo("You have chosen to disable Thyme's scheduled job. If you have done this because you
are not sure how to set this up or the instructions are not clear, please do not hesitate
to <a href='mailto:support@extrosoft.com'>contact us</a> and we'll be happy to assist you. If
you don't need any of the features that rely on the scheduled task, that's fine too. Thyme
will still function perfectly fine without this.<br><br>");

   echo("Setup is now complete and you should
   remove this file: <font class='hil'>"._CAL_BASE_PATH_."install.php</font>
   then navigate <a href='index.php'>to Thyme</a>. User: admin, password: the password you chose in the previous step.
   <br><br>");
   
   return;
}



   if(!($fh = fopen("include/config.php", "wb"))) {
     echo("Error Opening config file include/config.php for writing!<br>");
     failed("open");
   }


   # header
   #########
   fwrite($fh, "<?php

error_reporting(E_ALL ^ (E_NOTICE));
") or failed();


   # database 
   ###########
   fwrite($fh, '
######################
#
### SQL
#
#####################

# current drivers are:
#
# MySQL - "mysql"
# PostgreSQL - "pgsql"
# MSSQL Server - "mssql"
#
# PostgreSQL
# ----------
# for most PostgreSQL default installations,
# running on the same host, you may have to
# comment out the DBHOST and DBPORT lines
#
######################

define("_CAL_SQL_DRIVER_", "'. $_REQUEST['db_driver'] .'");

define("_CAL_DBHOST_", "'. $_REQUEST['db_host'] .'");
define("_CAL_DBPORT_", "'. $_REQUEST['db_port'] .'");

define("_CAL_DBUSER_", "'. $_REQUEST['db_user'] .'");
define("_CAL_DBPASS_", \''. str_replace("'","\\'",$_REQUEST['db_pass']) .'\');
define("_CAL_DBNAME_", "'. $_REQUEST['db_name'] .'");

define("_CAL_DBPREFIX_", "'. $_REQUEST['db_pref'] .'");

') or failed();


# PATHS AND EMAIL
####################
fwrite($fh, '

##########################################
#
### PATHS AND URLS (with trailing slash)
#
#########################################
define("_CAL_BASE_PATH_", "'. (@constant("_WIN32_") ? preg_replace("/\\\/", '\\\\\\', $_REQUEST['base_path']) : $_REQUEST['base_path']) .'");
define("_CAL_BASE_URL_", "'. $_REQUEST['base_url'] .'");


# GLOBAL SETTINGS
####################
require_once(@constant("_CAL_BASE_PATH_") . "include/global_settings.php");


') or failed();


   # language
   ##########
   fwrite($fh, '
# see include/languages
# for other options
##############################
@define("_CAL_LANG_", "'. $_REQUEST['language'] .'");


') or failed();


  # MAP LINK
  ###########
  fwrite($fh, '
##########################
#
### MAP LINK
#
#########################

# Map link for events with an Address. The default goes to mapquest.com
# with a default country of USA. You may create your own by editing
# include/custom_functions.php To disable the map link, set _CAL_NOMAP_ to 1.
#############################################################################33

@define("_CAL_NOMAP_", '. intval($_REQUEST['map_link'] != 1) .');
') or failed();


   # FOOTER
   ##########
   fwrite($fh,'

#######################################
#
# LEAVE THESE ALONE
#
#######################################
define("_CAL_ADMIN_USER_", "admin");
set_magic_quotes_runtime(0);
require_once(@constant("_CAL_BASE_PATH_") ."include/php-compat.php");

') or failed();

   fclose($fh);


################################
#
### SET ADMIN PW & EMAIL
#
################################
require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
$s = new _cal_sql();

if($_REQUEST['admin_pw']) {

   $s->query("update "._CAL_DBPREFIX_ ."Users set
	pass = '". $s->escape_string(md5($_REQUEST['admin_pw'])) ."',
	email = '". $s->escape_string($_REQUEST["admin_mail"]) ."'
	where id = 1");
}


# update scheduled task
#############################
$s->query("update "._CAL_DBPREFIX_."GlobalSettings set setting = 1
        where variable = '_CAL_NO_JOBS_'");

###################################
#
### SET default tz and dst
#
##################################

$s->query("update "._CAL_DBPREFIX_ ."UserOptions set dst = ". $_REQUEST['dst'] .",
	timezone = ". $_REQUEST['timezone']);

####################################
#
### SET SITE E-MAIL ADDR
#
####################################
$s->quiet = true;
$s->query("insert into ". _CAL_DBPREFIX_."GlobalSettings values ('_CAL_MAIL_FROM_', '')");
$s->quiet = false;

$s->query("update ". _CAL_DBPREFIX_."GlobalSettings set setting = '". $s->escape_string($_REQUEST['site_email']) ."'
	where variable = '_CAL_MAIL_FROM_'");


##################################
# CHECK FOR LANGUAGE UPDATE
##################################
if($contents = @file_get_contents(_CAL_BASE_PATH_."INSTALL/sql/language/"._CAL_LANG_.".sql")) {

   $contents = str_replace('_db_pref_',_CAL_DBPREFIX_, $contents);
   $cmds = preg_split("/;[\n|\r]+/", $contents);
   $cmds = array_map("trim", $cmds);
   
   foreach($cmds as $cmd) {
      if(!strlen($cmd)) continue;
      $s->query($cmd);
   }

}

echo("<br>");
echo("Setup is almost complete. If you wish to change any configure options later,
you may edit include/config.php.<br><br><hr align='center'>");

require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.template.php");

$_cal_tmpl = new _cal_template("finish");
$_cal_tmpl->print_header();
$_cal_tmpl->new_section("Scheduled Task");

$_cal_tmpl->new_row();

#######################################
#
# COMMAND SCHEDULER INSTRUCTIONS
#
#######################################

# try to find PHP for windows
if(file_exists(PHP_BINDIR)) $php_path = PHP_BINDIR;
else if (file_exists('C:\php')) $php_path = 'C:\php';

$php_bin_found = (file_exists($php_path . (@constant("_WIN32_") ? '\\php.exe' : '/php')));

$file_names = array('php','php-cgi','php5','php5-cgi','php4','php4-cgi');

foreach($file_names as $f) {

   if(file_exists(PHP_BINDIR ."/".$f)) {
      $php_cli = PHP_BINDIR ."/".$f;
      break;
   }
}

?>
<img src='images/error.gif' align='middle'> <font class='heading'>Stop!</font><br><br>
You should now add the Thyme scheduled job to a command scheduler on your web server. The Thyme scheduled job is a PHP script which needs to run in order to;
<ul>
<li>send <b>event reminders</b><br>
- Event reminders is a feature that allows users to be reminded of an event via e-mail.<br><br></li>

<li>send <b>calendar subscriptions</b><br>
- Calendar subscriptions is a feature in Thyme that allows users to receive daily or weekly calendar
views via e-mail. This is not the same as subscribing to a calendar from a 3rd party application (such as Apple iCal or Mozilla Sunbird), which will work perfectly fine without the Thyme scheduled task.<br><br></li>

<li>send <b>notifications</b> of updated or added events<br>
- Event notifications is a feature that allows users to receive an e-mail notification when an event
is added or updated to a particular calendar or category.<br><br></li>

<li>update <b>remote RSS feeds</b><br>
- Remote RSS feeds allows an administrator to add an RSS feed to Thyme's navigation bar. For instance, you
may choose to add Yahoo!'s top news stories. Many news sites (among others) offer RSS feeds to their
stories or content. This is not the same as allowing other people to subscribe to Thyme's calendar RSS
feeds, which will work perfectly fine without the Thyme scheduled task.</li>
</ul>
Don't worry if you don't know what RSS feeds are or if you 
just read a bunch of words that sound like gibberish.
Basically, something needs to be told to run this script. Please select the scenario which best
describes your setup:<br><br>

<ul>
<li><a href='javascript:show_sched(0)'>My web site is hosted by someone else</a> - Select this if you use a web
hosting provider. Most people will need to choose this option.</li><br>
<li><a href='javascript:show_sched(1)'>I host my own web site</a> - Select this if you or someone at your company
has complete control over your web server. Dreamhost users should click here as well.</li><br>
<li><a href='install.php?action=Finish&step=4&finish=nojob'>I don't feel like doing this right now</a> - 
Some features will be disabled, but can easily be re-enabled later.</li><br>
<li><a href='install.php?action=Finish&step=4&finish=nojob'>I don't need any of the features listed above</a>
- Some features will be disabled, but can easily be re-enabled later.</li><br>


</ul>
<a name='sched'> &nbsp; </a>
<hr>
<div id='sched_0' style='display: none'>
<h4 align='center'>My web site is hosted by someone else</h4>
Most hosting providers have a control panel that allows you to configure your web site.
The URL of the control panel will differ from one hosting provider
to the next, so the installation script can not tell you where this is. Please
navigate to your web site's control panel in a separate window now. These
typically have a section that allow you to schedule jobs to run. The icon may look
like this (<i><b>Note: some web hosting control
panels have job scheduling located in the FTP configuration section</b></i>):<br><br>
<div align='center'><img src='INSTALL/images/cron-icon.jpg'></div><br><br>

Clicking this icon will either bring you to cron setup or allow you to choose standard
or advanced mode.<br><br><div align='center'><img src='INSTALL/images/cron-1.jpg'></div><br><br>

Standard mode will be fine, so click Standard if given the option. This job will need to run
every 5 minutes. Why so often? Events can happen in 5 minute intervals. Running this job
is no more intensive than visiting any database driven web-page. To set this to run every 5 minutes,
enter the configuration as displayed below. Note that "Command to run" will be different
for you, we'll get to that next.<br><br>
<div align='center'><img src='INSTALL/images/cron-2.jpg'></div><br><br>
Note that some hosting providers may have a configuration that looks similar
to this instead:<br><br>
<div align='center'><img src='INSTALL/images/cronv2.jpg'><br>In this case, enter <font class='hil'>*/5</font>
for Minute, and <font class='hil'>*</font> for the rest of the fields.</div><br><br>

Now all we have left is the command to run. PHP seems to think that this is located in
<b><?php echo(PHP_BINDIR) ?></b> so the install script is now going to check
for PHP in that location:<br>
<ul>
<?php

   $file_names = array('php','php-cgi','php5','php5-cgi','php4','php4-cgi');

   $php_cli = "";

   foreach($file_names as $f) {

      if(@constant("_WIN32_")) $f .= ".exe";

      echo("<li>checking ".PHP_BINDIR. (@constant("_WIN32_") ? "\\" : "/") ."$f ... ");

      if(file_exists(PHP_BINDIR ."/".$f)) {
         echo("<font color='green'><b>found!</b></font></li>");

         $php_cli = PHP_BINDIR .(@constant("_WIN32_") ? "\\" : "/").$f;

         break;
      }
      echo("<font color='red'>not found</font></li>");

      # check both `which` and `type`
      #################################
      if(!@constant("_WIN32_")) {

         # type
         ##################
         $php = `type $f`;
         if(preg_match("/^$f is/", $php)) {
            $php_cli = substr($php, strlen($f) + 4, -1);
            echo("<li>checking $php_cli ... <font color='green'><b>found!</b></font>");
            break;
         }
         # which
         ####################
         $php = `which $f`;
         if($php) {
            $php = chop($php);
            echo("<li>checking $php ... <font color='green'><b>found!</b></font>");
            $php_cli = $php;
            break;
         }

      }
   }

   if(!$php_cli) {

      if(!preg_match("/install.php$/",$_SERVER['SCRIPT_NAME']) && file_exists($_SERVER['SCRIPT_NAME'])) {

         echo("<li>checking {$_SERVER['SCRIPT_NAME']} ... <font color='green'><b>found!</b></font>");
         $php_cli = $_SERVER['SCRIPT_NAME'];

      }
   }
?>
</ul>

<?php if($php_cli): ?>

Great! The installation script found PHP at: <?php echo($php_cli) ?> . The command to run should be set to:<br>
<pre>
<?php echo($php_cli) ?> -f <?php echo(_CAL_BASE_PATH_ . "jobs.php")?>
</pre>

Please enter this in your cron configuration and save the entry. Once this is done,
setup is complete and you should
remove this file: <font class='hil'><?php echo(_CAL_BASE_PATH_) ?>install.php</font>
then navigate <a href='index.php'>to Thyme</a>. User: admin, password: the password you chose in the previous step.
<?php else: ?>

The installation script could not find PHP. For now, you should <a href='install.php?action=Finish&step=4&finish=nojob'>click here</a> to
let Thyme know that you are not going to schedule the job to run. This will disable some features, but
they can easily be enabled later.<br>

<?php endif ?>
<br><br>
</div>
<div id='sched_1' style='display: none'>
<h4 align='center'>I host my own website</h4>
<?php

$php_cli_inst = ($php_cli ? $php_cli : PHP_BINDIR .'\php.exe');



###################################
#
### WINDOWS
#
####################################

if(@constant("_WIN32_"))  {
?>
The installation script has detected that this web server is running on <b>Windows</b>.<br><br>

<?php if(!$php_cli): ?>
<b>Warning:</b> the installation script could not find PHP. This could mean that you do not
have the command line version of PHP installed, or it is in a non-standard location. If 
you know where the command line version of PHP is, please modify the command below and change
<?php echo($php_cli_inst) ?> to the exact location of php. Otherwise, you should
<a href='install.php?action=Finish&step=4&finish=nojob'>click here</a> to
let Thyme know that you are not going to schedule the job to run. This will disable some features, but
they can easily be enabled later.<br><br>
<?php endif ?>

To add this job to the Windows job scheduler, execute the following command from a command prompt on your web server (XP Pro and higher):<br>

<pre style='background: #000; color: #fff; padding: 4px;'>
schtasks /create /RU <font>SYSTEM</font> /SC MINUTE /MO 5 /TN "Thyme scheduled job" /TR "<font><?php echo($php_cli_inst) ?></font> -f """<?php echo(_CAL_BASE_PATH_) ?>jobs.php"""" /ST 00:00:00
</pre>


<i>Note: the extra quotes are not a typo, they are required.</i><br><br>

This schedules the job to run every 5 minutes. Why so often? Events can happen in 5 minute intervals. Running this job
is no more intensive than visiting any database driven web-page.<br><br>

Alternatively, you may add the job from Windows by navigating to Start -&gt; All Programs -&gt; Accessories -&gt; System Tools -&gt; Scheduled Tasks. Schedule it to run every 5 minutes starting at 00:00:00.<br><br>

Once this is done, setup is complete. You should
remove this file: <font class='hil'><?php echo(_CAL_BASE_PATH_) ?>install.php</font>
then navigate <a href='index.php'>to Thyme</a>. User: admin, password: the password you chose in the previous step.

<?php

} else {

#############################
#
# UNIX, LINUX, MAC OSX
#
#############################

$php_cli_inst = ($php_cli ? $php_cli : PHP_BINDIR .'/php');

?>
The installation script has detected that this web server is running on <b>Unix (Linix, FreeBSD, etc..) or Mac OSX</b>.<br><br>

<?php if(!$php_cli): ?>
<b>Warning:</b> the installation script could not find PHP. This could mean that you do not
have the command line version of PHP installed, or it is in a non-standard location. If
you know where the command line version of PHP is, please modify the instructions below and change
<?php echo($php_cli_inst) ?> to the exact location of php. Otherwise, you should
<a href='install.php?action=Finish'>click here</a> to
let Thyme know that you are not going to schedule the job to run. This will disable some features, but
they can easily be enabled later.<br><br>
<?php endif ?>

Some computers may have a graphical application that will allow you to schedule jobs. Given the many different variants, the process of scheduling
a job through a graphical application is beyond the scope of this document.
If you wish to do so, add the afore mentioned job, scheduled to
run every 5 minutes. Why so often? Events can happen in 5 minute intervals. Running this job
is no more intensive than visiting any database driven web-page.<br><br>

We're going to add the scheduled job to cron. What is cron? cron (named from the word chronos, which is greek for 'time') is a command scheduler
that comes with all versions of unix.
To add this job to cron, log into your web server, then execute the following command from the command line:<br>
<pre style='background: #000; padding: 4px; color: #fff;'>
crontab -e
</pre>
This should open up an editor with your cron configuration. To schedule the job, append the following line:
<pre style='background: #000; padding: 4px; color: #fff;'>
*/5  *   *   *   *  <font>/usr/local/bin/php</font> -f <?php echo(_CAL_BASE_PATH_) ?>jobs.php
</pre>
This tells cron to run this job every 5 minutes, every hour, every day of the month, every month, every weekday. Why so often? Events can happen in 5 minute intervals. Running this job
is no more intensive than visiting any database driven web-page.<br><br>

Save and close the cron configuration file. cron will automatically re-read it and update it's configuration accordingly. 
Once this is done, setup is complete. You should
remove this file: <font class='hil'><?php echo(_CAL_BASE_PATH_) ?>install.php</font>
then navigate <a href='index.php'>to Thyme</a>. User: admin, password: the password you chose in the previous step.
<br><br>
<?php

}

	# DON"T HAVE ACCESS
?>
</div>

<?php

$_cal_tmpl->end_row();
$_cal_tmpl->end_section();
$_cal_tmpl->print_footer();


function failed($op = "")
{

   global $_cal_form;

   if($op == "open")
      echo("Failed opening include/config.php for writing!<br><br>");
   else
      echo("Failed writing to include/config.php!<br><br>");
 
   echo("Please check permissions on this file if it exists to ensure that it is
	writeable by your web server as well as available disk space.<br><br>");

   $_cal_form->print_hidden("db_driver");
   $_cal_form->print_hidden("db_host");
   $_cal_form->print_hidden("db_port");
   $_cal_form->print_hidden("db_user");
   $_cal_form->print_hidden("db_pass");
   $_cal_form->print_hidden("db_name");
   $_cal_form->print_hidden("attachments");
   $_cal_form->print_hidden("attch_size");
   $_cal_form->print_hidden("attch_max");
   $_cal_form->print_hidden("attch_zip");
   $_cal_form->print_hidden("attch_path");
   $_cal_form->print_hidden("attch_hide");
   $_cal_form->print_hidden("map_link");
   $_cal_form->print_hidden("language");
   $_cal_form->print_hidden("base_path");
   $_cal_form->print_hidden("base_url");
   $_cal_form->print_hidden("email_addr");

   $_cal_form->print_hidden("action", "Finish");
   echo($_cal_form->submit("finish", 'Retry'));

}

?>
<script language='javascript' type='text/javascript'>
<!--

function show_sched(divid)
{


   document.getElementById('sched_0').style.display = (divid == 0 ? 'block' : 'none');
   document.getElementById('sched_1').style.display = (divid == 1 ? 'block' : 'none');

   document.location = '#sched';
}

-->
</script>
