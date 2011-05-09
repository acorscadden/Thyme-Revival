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
//

   global $cal, $_cal_sql, $_cal_user;

   if($_cal_user->guest && @constant('_CAL_GUEST_NO_EVENT_DETAILS_')) return;


   # if we shouldn't do notes popups..
   #####################################3
   if($GLOBALS['_cal_user']->options->e_n_popup != 1 || count($cal->notable_events) < 1) {
      return;

   }

   $notes = $_cal_sql->query("select id, notes from {$GLOBALS['_cal_dbpref']}Events where id
                in (". join(",",array_keys($cal->notable_events)) .")", true);

   if(!@constant("_CAL_THEME_POPUPS_")) $note_class = _CAL_CSS_CAL_NOTE_POPUP_;
   else $note_class = "cal_note_width ". _CAL_CSS_ROW_HEADER_;

   foreach(array_keys($notes) as $eid) {

      if(!strlen($notes[$eid]))
         continue;

      echo("<div id='enotes_". $eid ."'
	style='position: absolute; left: 0px; top: 0px; ");

      $notes[$eid] = _cal_event::format_notes($notes[$eid]);


     echo("visibility: hidden; padding: 4px; border: 1px solid black;' class='{$note_class}'");

      echo(" onMouseOver='window.clearTimeout(timer)' ");
      echo(" onMouseOut='hide_notes(\"enotes_". $eid ."\")' >");

      echo($notes[$eid]);
      echo("</div>\n");

   }

?>
