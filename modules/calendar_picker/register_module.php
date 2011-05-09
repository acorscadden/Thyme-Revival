<?php


if(@constant("_CAL_HIDE_CAL_PICKER_")) return;

global $_cal_modules;

# register our module name
###########################

$_cal_modules['calendar_picker']['display_name'] = _CALENDARS_;

$_cal_modules['calendar_picker']['parents'][] = 'navbar';
$_cal_modules['calendar_picker']['navbar'] = "calendar_picker/calendar_picker.php";

$_cal_modules['calendar_picker']['priority'] = 4;
?>
