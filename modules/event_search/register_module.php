<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['event_search']['display_name'] = _SEARCH_EVENTS_;

$_cal_modules['event_search']['navbar'] = "event_search/event_search.php";
$_cal_modules['event_search']['parents'][] = 'navbar';

$_cal_modules['event_search']['priority'] = 3;
?>
