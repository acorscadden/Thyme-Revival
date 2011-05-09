<?php


global $_cal_modules;

# register our module name
###########################

$_cal_modules['users']['admin_module'] = 1;

$_cal_modules['users']['display_name'] = _USERS_;

$_cal_modules['users']['include'] = "users/users.php";

$_cal_modules['users']['parents'][] = "admin";

$_cal_modules['users']['hide_nav'] = true;

$_cal_modules['users']['icon'] = "users.png";

$_cal_modules['users']['priority'] = 5;

########################################
#
### INCLUDE MEMBER STYLE IN USER LIST
#
########################################

if($_REQUEST['module'] == 'users') {

   ob_start();
   require_once(@constant("_CAL_BASE_PATH_") . "css/members_css.php");
   $_cal_member_css = ob_get_contents();
   ob_end_clean();
   $GLOBALS['_cal_html']->add_head($_cal_member_css);
}


?>
