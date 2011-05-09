<?php

if(@constant("_CAL_FORCE_DEFAULT_OPTS_") &&
	!(@constant("_CAL_ADMIN_OPTS_ENABLE_") && $_cal_user->admin) && !@constant("_CAL_MAIL_FROM_")) return;

global $_cal_modules;

# register our module name
###########################

$_cal_modules['options']['no_guest'] = 1;

$_cal_modules['options']['include'] = "options/options.php";

$_cal_modules['options']['display_name'] = _OPTIONS_;

$_cal_modules['options']['parents'][] = 'footer';

$_cal_modules['options']['hide_nav'] = 1;

$_cal_modules['options']['priority'] = -99;
?>
