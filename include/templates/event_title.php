<?php

require_once(_CAL_BASE_PATH_."include/images.php");


if(@include(_CAL_BASE_PATH_."customize/event_title.php")) return;

########################
#
### PRINT EVENT TITLE
#
########################

#
# Used in event view, send e-mail, export events
#

require_once(_CAL_BASE_PATH_."include/classes/class.url.php");

   echo("<tr>\n<td align='center'><h3>\n");

   if($_cal_event->icon) {

      echo(_ex_img_str(_CAL_BASE_URL_ . $_cal_event->icon, $_cal_event->title) ." ");

   }
   echo($_cal_event->title . "</h3>\n");

   if($_cal_event->category) echo("(". $_cal_event->category.")");

   echo("</td>\n</tr>\n");



?>
