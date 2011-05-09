<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['calendar_links']['display_name'] = _CALENDAR_LINKS_;

$_cal_modules['calendar_links']['parents'][] = 'navbar';
$_cal_modules['calendar_links']['navbar'] = "calendar_links/calendar_links.php";

$_cal_modules['calendar_links']['priority'] = 100;

?>
