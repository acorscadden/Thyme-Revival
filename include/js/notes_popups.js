<?php require_once(@constant("_CAL_BASE_PATH_") . "include/js/track_mouse.js"); ?>
<script language='JavaScript' type='text/javascript'>
<!--
//
// $Id: notes_popups.js,v 1.7 2006/03/18 18:17:30 root Exp $
//

currNote = null;

timer = null;


function show_notes(divid)
{

   if(currNote == document.getElementById(divid)) return;

   timer = window.setTimeout("show_notes_real('" + divid +"')", 500);
}

function hide_notes(divid)
{

   if(timer) 
      window.clearTimeout(timer);

   timer = window.setTimeout("hide_notes_real('" + divid + "')", 300);
}

function show_notes_real(divid)
{

   var X = cal_xMousePos;
   var Y = cal_yMousePos;

   var Xmax = cal_xMousePosMax;
   var Ymax = cal_yMousePosMax;

   var obj = document.getElementById(divid);

   clearTimeout(timer);

   if(!obj) return;

   if(currNote == obj) return;

   if(currNote) {
      currNote.style.visibility = "hidden";
      currNote = null;
   }

   var orig_width = obj.offsetWidth;

   if(cal_xMousePos > (Xmax / 2))
      obj.style.left = (X - obj.offsetWidth) - 10 + 'px';
   else
      obj.style.left = X + 10 + 'px';

   if(document.compatMode == "CSS1Compat") obj.style.width = orig_width + 'px';

   if(cal_yMousePos > (Ymax / 2))
      obj.style.top = (Y - obj.offsetHeight) + 'px';
   else
      obj.style.top = Y + 10 + 'px';

   obj.style.visibility = "visible";

   currNote = obj;

}

function hide_notes_real(divid)
{

   var obj = document.getElementById(divid);

   if(!obj)
      return;

   obj.style.visibility = "hidden";

   currNote = null;
}

function maxwidthiehack(divobj)
{

   var w = divobj.offsetWidth;
   var maxw = (document.body.clientWidth / 2);

   if(document.compatMode == "CSS1Compat") {
      return w > maxw ? maxw + 'px' : 'auto';
   } else {
      return (w > maxw ? maxw : w) + 'px';
   }

}

// -->
</script>
