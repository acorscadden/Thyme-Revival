<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['default_options']['admin_module'] = 1;

$_cal_modules['default_options']['display_name'] = _EDIT_DEFAULT_OPTS_;

$_cal_modules['default_options']['include'] = "default_options/default_options.php";

$_cal_modules['default_options']['parents'][] = "admin";

$_cal_modules['default_options']['icon'] = "default_opts.png";

$_cal_modules['default_options']['hide_nav'] = 1;

$_cal_modules['default_options']['priority'] = 15;

?>
