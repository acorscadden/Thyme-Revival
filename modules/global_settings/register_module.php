<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['global_settings']['admin_module'] = 1;

$_cal_modules['global_settings']['display_name'] = _GLOBAL_SETTINGS_;

$_cal_modules['global_settings']['include'] = "global_settings/global_settings.php";

$_cal_modules['global_settings']['parents'][] = "admin";

$_cal_modules['global_settings']['hide_nav'] = true;

$_cal_modules['global_settings']['icon'] = "global_settings.png";

$_cal_modules['global_settings']['priority'] = -10;
?>
