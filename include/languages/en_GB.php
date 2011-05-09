<?php


#
# With this set to 1, Nov 2nd 2004 would look
# like 2/11/2004 where applicable. With it
# set to 0, it would look like 11/2/2004.
#
# all date selects are also affected bu this
# as they will be day-month-year
#
###########################################
define("_CAL_EURO_DATE_", 1);


# order of adjective/nouns
#
# 0 = adjective, noun (i.e. red fox)
# 1 = noun, adjective (i.e. fox that is red)
#
# used in event_list.php for "Past Events",
# "Upcoming Events" etc..
############################################
define("_LANG_ORDER_", 0);

setlocale(LC_TIME, 'en');

define("_CHARSET_", "iso-8859-1");

define("_LANG_NAME_", "English (GB)");


define("_ADDRESS_2_", "City, Postal Code");


define("_COLOR_", "Colour");

define("_BACKGROUND_COLOR_", "Background Colour");
define("_FONT_COLOR_", "Font Colour");
define("_BORDER_COLOR_", "Border Colour");
define("_TIME_FONT_COLOR_", "Time Font Colour");
define("_TITLE_FONT_COLOR_", "Title Font Colour");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) {

define("_CENTER_", "Centre");


} # </ CALENDAR PUBLISHER SECTION >



# date formats
#
# see PHP's documentation for
# 'date' for more format options 
# some are:
# j = day of the month
# n = month number
# Y = full year number
#################################
define("_DATE_INT_FULL_", "j/n/Y");
define("_DATE_INT_NOYR_", "j/n"); # only used in Week view


require(@constant("_CAL_BASE_PATH_"). "include/languages/en_US.php");


?>
