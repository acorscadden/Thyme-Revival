<?php

##################
#
# DEFUALT THEME
#
#################

# register functions below
_ex_theme_register("_ex_content_title","_ex_default_content_title");
_ex_theme_register("_ex_section_header","_ex_default_section_header");
_ex_theme_register("_ex_tabs","_ex_default_tabs");
_ex_theme_register("_ex_content_header","_ex_default_content_header");
_ex_theme_register("_ex_content_footer","_ex_default_content_footer");
_ex_theme_register("_ex_cal_title","_ex_default_cal_title");

require_once(@constant("_CAL_BASE_PATH_") ."themes/default/functions.php");

?>
