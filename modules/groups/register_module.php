<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['groups']['admin_module'] = 1;

$_cal_modules['groups']['display_name'] = _GROUPS_;

$_cal_modules['groups']['include'] = "groups/groups.php";

$_cal_modules['groups']['parents'][] = "admin";

$_cal_modules['groups']['hide_nav'] = true;

$_cal_modules['groups']['icon'] = "groups.png";

$_cal_modules['groups']['priority'] = 10;
?>
