<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['cal_editor']['admin_module'] = true;

$_cal_modules['cal_editor']['display_name'] = _CALENDAR_PUBLISHER_;

$_cal_modules['cal_editor']['include'] = "cal_editor/cal_editor.php";

$_cal_modules['cal_editor']['parents'][] = "admin";

$_cal_modules['cal_editor']['hide_nav'] = 1;

$_cal_modules['cal_editor']['icon'] = "cal_editor.png";

$_cal_modules['cal_editor']['priority'] = 20;
?>
