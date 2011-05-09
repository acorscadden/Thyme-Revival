<?php

error_reporting(E_ALL ^ (E_NOTICE));

///////////
// Security fix 12-08-09
///////////
// basically if the eid is not a number set it to 0
if( isset($_GET['eid']) && !is_numeric($_GET['eid']) ) {
   $_GET['eid'] = 0;
} elseif( isset($_POST['eid']) && !is_numeric($_POST['eid']) ) {
   $_POST['eid'] = 0;
} elseif( isset($_REQUEST['eid']) && !is_numeric($_REQUEST['eid']) ) {
   $_REQUEST['eid'] = 0;
}
/////////////
// End Fix
/////////////

######################
#
### SQL
#
#####################

# current drivers are:
#
# MySQL - "mysql"
# PostgreSQL - "pgsql"
# MSSQL Server - "mssql"
#
# PostgreSQL
# ----------
# for most PostgreSQL default installations,
# running on the same host, you may have to
# comment out the DBHOST and DBPORT lines
#
######################

define("_CAL_SQL_DRIVER_", "mysql");

define("_CAL_DBHOST_", "localhost");
define("_CAL_DBPORT_", "");

define("_CAL_DBUSER_", "thyme");
define("_CAL_DBPASS_", 'thyme');
define("_CAL_DBNAME_", "examcal");

define("_CAL_DBPREFIX_", "thyme_");



##########################################
#
### PATHS AND URLS (with trailing slash)
#
#########################################
define("_CAL_BASE_PATH_", "/Applications/MAMP/htdocs/thymeRevival/");
#define("_CAL_BASE_PATH_", "/Applications/MAMP/htdocs/thymeWorking/");
#define("_CAL_BASE_URL_", "http://localhost");
define("_CAL_BASE_URL_", "");


# GLOBAL SETTINGS
####################
require_once(@constant("_CAL_BASE_PATH_") . "include/global_settings.php");



# see include/languages
# for other options
##############################
@define("_CAL_LANG_", "en_US");



##########################
#
### MAP LINK
#
#########################

# Map link for events with an Address. The default goes to mapquest.com
# with a default country of USA. You may create your own by editing
# include/custom_functions.php To disable the map link, set _CAL_NOMAP_ to 1.
#############################################################################33

@define("_CAL_NOMAP_", 0);


#######################################
#
# LEAVE THESE ALONE
#
#######################################
define("_CAL_ADMIN_USER_", "admin");
//set_magic_quotes_runtime(0);
ini_set('magic_quotes_runtime', 0);
require_once(@constant("_CAL_BASE_PATH_") ."include/php-compat.php");
?>
