<?php


if(@constant("_CAL_NO_GUEST_TIMEZONE_")) return;

global $_cal_modules;

# register our module name
###########################

$_cal_modules['guest_options']['guest_only'] = 1;

$_cal_modules['guest_options']['include'] = "guest_options/guest_options.php";

$_cal_modules['guest_options']['display_name'] = _OPTIONS_;

$_cal_modules['guest_options']['hide_nav'] = 1;

$_cal_modules['guest_options']['parents'][] = 'footer';


?>
