<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 eXtrovert Software                           |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@extrosoft.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: global_settings.php,v 1.21 2007/03/18 14:20:40 ian Exp $
//

###################################
#
### CHECK COOKIES FIRST
#
####################################

if($_COOKIE['_CAL_PAGE_MAIN_']) @define('_CAL_PAGE_MAIN_', $_COOKIE['_CAL_PAGE_MAIN_']);
if($_COOKIE['_CAL_LANG_']) @define('_CAL_LANG_', $_COOKIE['_CAL_LANG_']);
if($_COOKIE['_CAL_SITE_NAME_']) @define('_CAL_SITE_NAME_', $_COOKIE['_CAL_SITE_NAME_']);

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");

# check for user module..
@include_once(@constant("_CAL_BASE_PATH_") ."modules/auth/auth.php");


define("_THYME_VER_", "1.31");


global $_cal_sql, $_cal_dbpref;

#$_cal_dbpref = constant("_CAL_DBNAME_").'.'.constant("_CAL_DBPREFIX_");

$_cal_dbpref = constant("_CAL_DBPREFIX_");

$_cal_sql or $_cal_sql = new _cal_sql();

$globs = $_cal_sql->query("select variable, setting from {$_cal_dbpref}GlobalSettings", true);

foreach(array_keys($globs) as $g) {
   @define(trim($g), $globs[$g]);
}

if(!@constant("_CAL_SITE_NAME_")) @define("_CAL_SITE_NAME_", "Thyme");

if(file_exists(_CAL_BASE_PATH_.'modules/locations/class.location.php')) {

   global $_cal_loc_opts;

   $_cal_loc_opts or $_cal_loc_opts = $_cal_sql->query("select variable, setting
       from {$_cal_dbpref}ModuleSettings where module = 'locations'", true);

   @define('_CAL_LOCATIONS_MOD_', ($_cal_loc_opts['installed'] || $_cal_loc_opts['use_locations'
]));

   if($_cal_loc_opts['display_name'])
        define("_LOCATION_", $_cal_loc_opts['display_name']);

   include_once(_CAL_BASE_PATH_.'modules/locations/class.location.php');
}

