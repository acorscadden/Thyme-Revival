<script language='javascript' type='text/javascript'>
<!--

// must be @included from php 

var cal_ect = 0; // e_collapse_timeout
var curdiv;

function uncollapse_event(divobj)
{

   if(curdiv) {
      curdiv.style.overflow = "hidden"; curdiv.style.height = "<?php echo($dsize) ?>px";
   }

   divobj.style.overflow = "visible";
   divobj.style.height = "auto";

   curdiv = divobj;

   if(cal_ect) window.clearTimeout(cal_ect);
}

function collapse_event(divobj)
{

   cal_ect = window.setTimeout('curdiv.style.overflow = "hidden"; curdiv.style.height = "<?php echo($dsize) ?>px"; curdiv = null;', 300);

}

-->
</script>
