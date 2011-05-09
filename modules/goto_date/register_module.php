<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['goto_date']['display_name'] = _GOTO_DATE_;

$_cal_modules['goto_date']['navbar'] = "goto_date/goto_date.php";
$_cal_modules['goto_date']['parents'][] = 'navbar';

$_cal_modules['goto_date']['priority'] = 2;
?>
