<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['event_filter']['display_name'] = _EVENT_FILTER_;

$_cal_modules['event_filter']['parents'][] = 'navbar';
$_cal_modules['event_filter']['navbar'] = "event_filter/event_filter.php";

$_cal_modules['event_filter']['priority'] = 5;
?>
