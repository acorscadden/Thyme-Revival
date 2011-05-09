<script language="JavaScript" type='text/javascript'>
<!--
//
// $Id: newWin.js,v 1.10 2005/10/07 15:22:50 ian Exp $
//


var cal_win;

function newWin(url, height, width)
{

  if(!height || height < 1)
     height = 600;

  if(!width || width < 1)
     width = 600;

<?php if(!@constant("_CAL_POPUP_SINGLE_")): ?>


   window.open(url, url.replace(/[^a-z|0-9]/g,""), "width=" + width + ",height=" + height + ",menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=yes");

<?php else: ?>

   if(cal_win) { cal_win.close(); }

   cal_win = window.open(url, "cal_win", "width=" + width + ",height=" + height + ",menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=yes");

   cal_win.focus();


<?php endif ?>

}

// -->
</script>
