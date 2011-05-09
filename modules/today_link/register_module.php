<?php

global $_cal_modules;

# register our module name
###########################

$_cal_modules['today_link']['display_name'] = _TODAY_LINK_;
$_cal_modules['today_link']['priority'] = 0;

$_cal_modules['today_link']['parents'][] = 'navbar';
$_cal_modules['today_link']['navbar'] = "today_link/today_link.php";
?>
