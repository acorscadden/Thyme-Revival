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


  $i = 0;
  define ('_APACHE_', preg_match ('/Apache/i', $_SERVER['SERVER_SOFTWARE']));
  define ('_WIN32_', substr (strtolower (PHP_OS), 0, 3) == 'win');
  $include_dir = preg_replace ('' . '/INSTALL$/', 'include', dirname (__FILE__));
  echo '<div align=\'center\'>
<div id=\'faq\' align=\'left\'>

Use the installation guide provided below if you have any problems or questions during Thyme\'s
installation. Otherwise, the installation itself will walk you through the required steps.
If you have any questions that are not answered here, please do not hesitate to contact
<a href=\'mailto:support@extrosoft.com\'>support@extrosoft.com</a>.<br>

<di';
  echo 'v id=\'faqlist\'>
<br>
<font class=\'heading\'>Index</font>
<ul>
   <li>';
  echo ++$i;
  echo ' - <a href=\'#config\'><b>config.php not writable</b></a></li>
   <li>';
  echo ++$i;
  echo ' - <b>Installation Steps</b></li>
      <ul>
         <li>';
  echo $i;
  echo '.1 <a href=\'#step1\'>Step 1 - Database Configuration</a></li>
         <li>';
  echo $i;
  echo '.2 <a href=\'#step2\'>Step 2 - Database Table Install</a></li>
         <li>';
  echo $i;
  echo '.3 <a href=\'#step3\'>Step 3 - Config Options</a></li>
         <li>';
  echo $i;
  echo '.4 <a href=\'#step4\'>Step 4 - Adding the Thyme scheduled job</a></li>
      </ul>
   <li>';
  echo ++$i;
  echo ' - <a href=\'#ssv1.1.2\'><b>PHP Settings</b></a></li>
';
  if (!@constant ('_APACHE_'))
  {
    echo '   <li>';
    echo ++$i;
    echo ' - <a href=\'#iis\'><b>IIS Settings</b></a></li>
';
  }

  echo '</ul>
</div>
<br><br>
';
  $i = 0;
  echo '<a name="config"> </a>
<hr>
<font class=\'heading\'>- ';
  echo ++$i;
  echo '.0 config.php not writable</font>
<hr>
<br>

If you receive this message, it means that PHP can not write to config.php. Thyme needs to
write to this file in order to store it\'s configuration.<br><br>

If you are using a hosting provider (if you pay someone to host your web site), you can probably
do this using a file manager provided in the control panel for your site. Make the permissions 666';
  echo '
(or 0666 if asked for 4 digits)
for config.php<br><br><img src=\'INSTALL/images/chmod.jpg\'><br><br>

If you\'ve used an FTP program to transfer Thyme, you should be able to change file permissions through it
by navigating to the location of config.php (';
  echo $include_dir;
  echo '), right clicking on config.php
and selecting \'Change  permissions\', \'chmod\', or \'Properties\'. The permissions on this file should
be set to 666 (or 0666 if asked for 4 digits).<br><br>

';
  if (@constant ('_WIN32_'))
  {
    echo 'In some rare cases, you may need to contact your hosting provider to have them make this change.
Please
instruct them to make ';
    echo $include_dir;
    echo '\\config.php writable by the web server.
<br><br>
';
  }

  echo '<hr>
<br>
If you or someone at your organization has direct access to this web server, you (or they) can follow
the instructions below to change the permissions of config.php.<br><br>
';
  if (@constant ('_WIN32_'))
  {
    echo '
   ';
    if (!@constant ('_APACHE_'))
    {
      echo 'The installation guide has detected that your web server is running IIS. To make config.php writable,
you will need to make sure the file is not set to read-only, as well as give the
Internet Guest Account full access to this file. To do this, in Windows explorer, navigate to the folder 
<b>';
      echo $include_dir;
      echo '</b>, right click on config.php
and select Properties from the drop down menu. This will present you with a window similar to this:
<br><br><img src=\'INSTALL/images/win_ro.jpg\'><br><br>
In this window, make sure that the \'Read-only\' checkbox is not checked. Next, click on the Security tab.
This will present you with a window similar to this:<br><br>
<img src=\'INSTALL/images/win_iusr.jpg\'><br><br>
In th';
      echo 'is window, select the \'Internet Guest Account\', and make sure that the \'Full Control\' check box is
checked. Once this is done, click on OK. config.php should now be writable by your web server.
   

   ';
    }
    else
    {
      echo 'The installation guide has detected that your web server is running Apache in Windows.
To make config.php writable, you will need to make sure the file is not set to read-only.
To do this, in Windows explorer, navigate to the folder
<b>';
      echo $include_dir;
      echo '</b>, right click on config.php
and select Properties from the drop down menu. This will present you with a window similar to this:
<br><br><img src=\'INSTALL/images/win_ro.jpg\'><br><br>
In this window, make sure that the \'Read-only\' checkbox is not checked. Once this is done,
click on OK. config.php should now be writable by your web server. 
   ';
    }

    echo '
';
  }
  else
  {
    echo 'The installation guide has detected that your web server is running on Unix (Linux, FreeBSD, etc..) or
MacOSX. To make config.php writable by your web server, execute the following from a command prompt
on the server:<br>
<pre style=\'background: #000000; color: #ffffff; padding: 4px;\'>
chmod 0666 ';
    echo $include_dir;
    echo '/config.php
</pre>
<i>If you receive a \'permission denied\' error, you will have to \'su\' to root. For more information
on how to do this, please consult your operating system\'s manual.</i>
<br><br>
config.php should now be writable by your web server and you may continue with the installation.
';
  }

  echo '
<br><br>
<div align=\'center\' style=\'font-size: 10px\'><a name="step1">(<a href=\'#top\'>top</a>)</a></div>
<hr>
<font class=\'heading\'>- ';
  echo ++$i;
  echo '.1 Step 1 - Database Configuration</font>
<hr>
This is where you configure Thyme to connect to your database.<br><br>

If you do not know what to enter here, you will need to contact your web hosting
provider for instructions on how to create a database. Most web hosting providers
provide a database section in your hosting control panel. If you have this section in
your hosting control panel, y';
  echo 'ou may create a database and database username/password there.

<br><br>

As an <b>advanced</b> configuration option, 
Thyme may even create a user
and database for you if you do not already have those configured.
Please do not use this unless you know what you are doing.<br><br>

If you wish for Thyme to create a database for you, the user entered in the "Database Configuration"
section must ';
  echo 'have access to do so. If this user not have access to create a database, you may
enter an alternate user/password pair under "Advanced Install Options",
and Thyme will connect and create a database
as that user. If you do not know a username/password
that has access to create a database, you will have to use an existing database. Thyme will
also attempt to grant all access to the database for';
  echo ' the user entered under
"Database Configuration" if this option is selected.<br><br>

Thyme may create the user entered under "Database Configuration" if you wish it to do so. The
username/password under "Advanced Install Options" must have access to create users.<br><br>
<b>Errors:</b><br><br>
   <ul>
      <li>_connect() :: Unknown MySQL Server Host \'<font color=\'red\'>host</font>\'</li>
      <li>_conn';
  echo 'ect() :: pg_connect(): Unable to connect to PostgreSQL server: unknown host name: <font color=\'red\'>host</font></li>
      <li>_connect() :: mssql_connect(): Unable to connect to server <font color=\'red\'>host</font>
      <br><br>
         The name you\'ve entered for <b>Host</b> under "Database Configuration" can not be found.
	 Check the spelling of the host you\'ve entered.<br><br></li>

      <li>_conne';
  echo 'ct() :: Access denied for user
	\'<font color=\'red\'>user</font>@<font color=\'red\'>host</font>\' to database
		\'<font color=\'red\'>database</font>\'</li>
      <li>_connect() :: pg_connect(): PostgreSQL server: FATAL 1: Password authentication failed for user "<font color=\'red\'>user</font>"</li>
      <li>_connect() :: pg_connect(): PostgreSQL server: FATAL 1: IDENT authentication failed for user "<font color=\'';
  echo 'red\'>user</font>"</li>
      <li>_connect() :: mssql_connect(): Login failed for user \'<font color=\'red\'>user</font>\'</li>
      <br><br>
      <li>
 	 The username you\'ve entered is unable to connect to the database. This can happen if:<br><br>
		<ul>
		   <li>The username you\'ve entered does not have access to connect to the database</li>
		   <li>The username you\'ve entered does not exist</li>
		   <li>';
  echo 'The password you\'ve entered for the user is not correct</li>
		   <li>The database you\'ve entered does not exist</li>
		</ul><br>
 		If you are using MySQL, you may select the \'Create User\' option
		under "Install Options" and Thyme
		will create this user for you. If the user already exists, this will reset
		their password to the password you\'ve entered and grant them all permissions
		for the';
  echo ' database. Also check that the database exists.<br><br>

		In some <b>PostgreSQL</b> configurations this may happen if you\'ve set up your database
		for password authentication, the PostgreSQL database is running on the same host,
		and you\'ve entered a hostname in the "Host" field. Leave "Host" blank under
		"Database Configuration" and try again. 

         <br><br>
      </li>
      <li>query(';
  echo ') :: Access denied for user:
		\'<font color=\'red\'>user</font>@<font color=\'red\'>host</font>\' to database
		\'<font color=\'red\'>database</font>\'</li>
      <li>User \'<font color=\'red\'>user</font>\' can not <font color=\'red\'>perform action on</font>
	tables in the \'<font color=\'red\'>database</font>\' database.<br><br>

	The username you\'ve entered does not have access to perform the query or SQL command.
	The q';
  echo 'uery should appear below this message. You will have to choose a different user,
	that has a higher level of access.<br><br></li>

   </ul>
 
<br><br>
If the above did not help, you will have to manually set up your database. See the
Database Setup section of the FAQ on Thyme\'s web site.

<br><br>
<div align=\'center\' style=\'font-size: 10px\'><a name="step2">(<a href=\'#top\'>top</a>)</a></div>
<hr>
<font';
  echo ' class=\'heading\'>- ';
  echo $i;
  echo '.2 Step 2 - Database Table Install</font>
<hr>
Thyme will detect which version you have installed (if any) and upgrade or install the 
tables in your database.<br><br>

<b>Errors:</b>
<ul>
   <li>Specified key was too long<br><br>
   This error is related to the MySQL bug noted at <a href=\'http://bugs.mysql.com/bug.php?id=4541\'>http://bugs.mysql.com/bug.php?id=4541</a>. To fix this, run the following ';
  echo 'query using phpMyAdmin or a similar tool:<br><br>
<pre>
ALTER DATABASE <font style=\'color: #f00\'>db_name</font> CHARACTER SET latin1;
</pre>
Where <font style=\'color: #f00\'>db_name</font> is the name of the database where you are installing Thyme.
   </li>
</uL>
<br>
Note: when going back to Step 2 either by pressing the back button on a browser, or by clicking
\'Previous\' from within the installatio';
  echo 'n, it will tell you that the current database scheme is up
to date. This is because it had already performed the necessary steps to update or install
tables when you went on to Step 3.<br><br>

<br><br>
<div align=\'center\' style=\'font-size: 10px\'><a name="step3">(<a href=\'#top\'>top</a>)</a></div>
<hr>
<font class=\'heading\'>- ';
  echo $i;
  echo '.3 Step 3 - Config Options</font>
<hr>
This step of the installation sets configurable options. It is well documented and
should not fail or give any errors.
<div align=\'center\' style=\'font-size: 10px\'><a name="step4">(<a href=\'#top\'>top</a>)</a></div>
<hr>
<font class=\'heading\'>- ';
  echo $i;
  echo '.4 Step 4 - Adding the Thyme scheduled job</font>
<hr>
The Thyme scheduled job is a PHP script which needs to run in order to; send out event reminders, send event
subscriptions, send notifications of updated or added events, and update remote RSS feeds (don\'t worry if
you don\'t know what RSS feeds are). Something needs to be told to run this script every 5 minutes.
Why so often? Events can hap';
  echo 'pen in 5 minute intervals. Running this job
is no more intensive than visiting any database driven web-page.
<br><br>
Instructions for scheduling this job appear during Thyme\'s installation. If you need assistance, please
do not hesitate to contact <a href=\'mailto:support@extrosoft.com\'>support@extrosoft.com</a><br><br>

<div align=\'center\' style=\'font-size: 10px\'><a name="ssv1.1.2">(<a href=\'#top\'>t';
  echo 'op</a>)</a></div>

<hr>
<font class=\'heading\'>- ';
  echo ++$i;
  echo '.0 -  PHP Settings</font>
<hr>
Thyme requires the following PHP settings:
<ul>
<!--
   <li>register_globals  "0"<br><br>

Not only will Thyme not work
with this turned on, but it is also a security hazard. Please turn this
off in php.ini or an .htaccess file by setting it\'s value to \'0\'.<br><br>
-->
   <li>magic_quotes_sybase "off"<br><br>
   This is off by default, however, some sites may have it';
  echo ' turned on.</li>
</ul>
<br>
Thyme recommends the following PHP settings:
<ul>
   <li>magic_quotes_gpc "0"</li>
</ul>
<br>
If using attachments, Thyme requires the following settings:<br>
<font size=\'-2\'>(<i>assuming you want an 8M limit on event attachments</i>)</font>
<ul>
   <li>file_uploads "1"</li>
   <li>upload_max_filesize "8M"</li>
   <li>post_max_size "9M" <font size=\'-2\'>(<i>NOTE: upload_max_file';
  echo 'size + (at least) 1M</i>)</font></li>
   <li>max_input_time 120</li>
</ul>
<br>
<hr width=\'80%\' align=\'center\'>
If using apache, we recommend you set this in httpd.conf or an .htaccess file. See the file <font
color=\'red\'>htaccess-example</font> in Thyme\'s base directory. The configuration settings are
in the format of:<br>
<pre>

   # required
   ###########
   php_value magic_quotes_gpc "0"
   ';
  echo 'php_flag magic_quotes_sybase Off

   # dependent on event attachment size
   #
   # Set post_max_size to at least 1M
   # over your upload_max_filesize
   ####################################
   php_value post_max_size "11M"
   php_value upload_max_filesize "10M"
   php_value max_input_time "120"

</pre>
<font size=-2><i>NOTE: <font color=\'red\'>file_uploads</font> can not be set in an .htac';
  echo 'cess file
and must be set in php.ini.</i></font><br><br>
If your apache configuration supports this, you may simply create a copy of that file in the
same directory named <font color=\'red\'>.htaccess</font> and edit it to suite your needs. Most
web hosting providers\' configurations will allow for this.<br><br>
<hr width=\'80%\' align=\'center\'>
If you are not using apache or your configuration does not a';
  echo 'llow for an .htaccess file that
can change php settings, you will have to set these in php.ini. You may use the phpinfo.php
script distributed with Thyme to obtain the location of your php.ini file
(located here: <a href=\'phpinfo.php\'>phpinfo.php</a>). It is in the first section and named
\'<font color=\'red\'>Configuration
File (php.ini) Path</font>\'.

<br><br>Simply find and change the values. Not';
  echo 'e that in some
cases you may have to set a value to "Off" instead of "0" or "On" instead of "1". Use
the setting\'s current value to determine this.<br><br>

If php.ini does not exist in the location specified by phpinfo.php, you may have to
create it by copying \'php.ini-recommended\' from PHP\'s base dir to the location specified by
phpinfo.php and renaming it to \'php.ini\'. Then you may edit the';
  echo ' appropriate values.<br><br>

<div align=\'center\' style=\'font-size: 10px\'><a name="iis">(<a href=\'#top\'>top</a>)</a></div>

';
  if (!@constant ('_APACHE_'))
  {
    echo '
<hr>
<font class=\'heading\'>- ';
    echo ++$i;
    echo '.0 -  IIS Settings</font>
<hr>


Some versions of IIS may require modifications to get authentication to work correctly with PHP.
To configure IIS authentication with PHP follow these steps:<br /><br />
<ul>
<li>In Web Site Properties -&gt; File/Directory Security -&gt; Anonymous Access dialog box, check the "Anonymous access" checkbox and uncheck any other checkboxes (i.e. uncheck "Basic authent';
    echo 'ication," "Integrated Windows authentication," and "Digest" if it\'s enabled.) Click OK.<br /><br />
<img src=\'INSTALL/images/iis_auth1.jpg\'><br><br>
</li>
 
<li>In Web Site Properties -&gt; Custom Errors, select the range of "401;1" through "401;5" and click the "Set to Default" button. Then click OK.
<br><br>
<img src=\'INSTALL/images/iis_auth2.jpg\'><br>
</li>
</ul>
PHP authentication should now work ';
    echo 'in IIS.
<br /><br />
<div align=\'center\' style=\'font-size: 10px\'>(<a href=\'#top\'>top</a>)</div>
';
  }

  echo '</div>
</div>
';
?>