<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['calendars']['no_admin'] = $_cal_modules['calendars']['no_guest'] = 1;

$_cal_modules['calendars']['display_name'] = _CALENDARS_;

$_cal_modules['calendars']['include'] = "calendars/calendars.php";

$_cal_modules['calendars']['parents'][] = "admin";
$_cal_modules['calendars']['parents'][] = "footer";

$_cal_modules['calendars']['hide_nav'] = true;

$_cal_modules['calendars']['icon'] = "calendars.png";

if($_REQUEST['module'] == 'admin') $_cal_modules['calendars']['priority'] = 30;
else $_cal_modules['calendars']['priority'] = -70;

?>
