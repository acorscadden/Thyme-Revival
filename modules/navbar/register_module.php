<?php


global $_cal_sql, $_cal_modules, $_cal_user, $_cal_orientation, $_cal_nav_umods;

# register our module name
###########################

$_cal_modules['navbar']['no_guest'] = 1;

$_cal_modules['navbar']['configure'] = "navbar/modules.php";

$_cal_modules['navbar']['display_name'] = _NAVBAR_;

$_cal_modules['navbar']['parents'][] = 'modules';

$_cal_modules['navbar']['priority'] = -100;

$_cal_modules['navbar']['force_enable'] = 1;


$_cal_nav_umods or $_cal_nav_umods = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}NavModules
	where uid = ". (@constant("_CAL_FORCE_DEFAULT_OPTS_") ? "0" : $_cal_user->id ) ." order by leftright, mod_order");

if(!count($_cal_nav_umods) && !@constant("_CAL_FORCE_DEFAULT_OPTS_")) {
   $_cal_nav_umods = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}NavModules
	where uid = 0 order by leftright, mod_order");
}

if($_cal_nav_umods[0]['leftright'] == 1) {
   $_cal_modules['navbar']['modules_right'] = 1;
} else if(count($_cal_nav_umods) && $_cal_nav_umods[count($_cal_nav_umods) - 1]['leftright'] == 0) {
   $_cal_modules['navbar']['modules_left'] = 1;
} else if(count($_cal_nav_umods)) {
   $_cal_modules['navbar']['modules_right'] = $_cal_modules['navbar']['modules_left'] = 1;
}
?>
