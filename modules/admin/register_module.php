<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['admin']['admin_module'] = 1;

$_cal_modules['admin']['display_name'] = _ADMIN_;

$_cal_modules['admin']['parents'][] = 'footer';
$_cal_modules['admin']['priority'] = 99;

$_cal_modules['admin']['hide_nav'] = 1;

$_cal_modules['admin']['include'] = "admin/admin.php";

?>
