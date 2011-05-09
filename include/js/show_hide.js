<script language="javascript" type='text/javascript'>
<!-- 
//
// $Id: show_hide.js,v 1.5 2005/08/26 20:35:52 ian Exp $
//


function show_hide(divid)
{

   var section = document.getElementById("show_hide" + divid);
   var section_lbl = document.getElementById("show_hide_lbl" + divid);
   var persistent_elm = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements['show_hide'];


   var x = new Number(persistent_elm.value);
   var y = new Number(divid);

   if(section.style.display == "none")
   {
      section.style.display = "inline";
      section_lbl.innerHTML = "<?php echo(_HIDE_) ?>";
      persistent_elm.value = x - y;

   } else {
      section.style.display = "none";
      section_lbl.innerHTML = "<?php echo(_SHOW_) ?>";
      persistent_elm.value = x + y;
   }



}

function update_show_hide()
{

   var x = new Number(document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements['show_hide'].value);

   document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements['show_hide'].value = 0;

   for(var i = 2; i <= x; i *= 2) {

      if(i & x) {
         show_hide(i);
      }

   }




}
// -->
</script>
