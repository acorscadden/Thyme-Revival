<?php

global $_cal_modules;

# register our module name
###########################

$_cal_modules['color_legend']['display_name'] = _COLOR_LEGEND_;
$_cal_modules['color_legend']['priority'] = 100000;

$_cal_modules['color_legend']['parents'][] = 'navbar';
$_cal_modules['color_legend']['navbar'] = "color_legend/color_legend.php";

if($_REQUEST['et_flag']) {

   if($_REQUEST['et_on']) $_SESSION['evnt_type'] += $_REQUEST['lcat'];
   else $_SESSION['evnt_type'] -= $_REQUEST['lcat'];
}

?>
