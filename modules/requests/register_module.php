<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['requests']['no_guest'] = 1;

$_cal_modules['requests']['display_name'] = _REQUESTS_;

$_cal_modules['requests']['include'] = "requests/requests.php";

$_cal_modules['requests']['parents'][] = "footer";

$_cal_modules['requests']['hide_nav'] = true;

$_cal_modules['requests']['priority'] = -80;

?>
