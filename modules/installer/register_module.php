<?php


require_once(_CAL_BASE_PATH_."include/http_get.php");

if(!_ex_http_get(-1)) return;

global $_cal_modules;

# register our module name
###########################

$_cal_modules['installer']['admin_module'] = 1;

$_cal_modules['installer']['display_name'] = _UPDATES_;
$_cal_modules['installer']['priority'] = 0;

$_cal_modules['installer']['parents'][] = 'admin';
$_cal_modules['installer']['include'] = "installer/installer.php";

$_cal_modules['installer']['icon'] = 'installer.png';

$_cal_modules['installer']['hide_nav'] = 1;

$_cal_modules['installer']['priority'] = 2;
?>
