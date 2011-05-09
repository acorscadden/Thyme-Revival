<table class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' style='border-collapse: collapse;' cellpadding=4>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='middle'>
<td>
<?php

      $_cal_form->defaults['repeat_every'] = abs($_cal_form->defaults['repeat_every']);

      echo("<input type=radio ".
         ($_cal_event->repeat_every_mask > 0 ? "checked" : "") .
         " name='repeat' value='repeat'> ". _REPEATING_REPEAT_ ." ". _REPEATING_EVERY1_ ." ".
         $_cal_form->textbox("repeat_every", 2, " maxlength=2") ." ".
         $_cal_form->select("repeat_every_val", $_cal_event->repeat_every_val_opts,
		"onChange='repeat_every_val_weekdays_show(this.selectedIndex)'"));

        echo("<br>");

      # weekday checkboxes
      #####################

      echo("<div id='repeat_every_val_weekdays' style='display: none;'>\n");

         $row = "";
         $a = $i = 1;

         foreach($_cal_weekdays as $wday)
         {

             $row .= $_cal_form->checkbox("repeat_selected_". $i) ." $wday ";

             if($i++ % 4 == 0) {
                    echo(' &nbsp; &nbsp; &nbsp; ' . $row ."<br>");
                $row = "";
             }

             $a*=2;

         }
         echo(' &nbsp; &nbsp; &nbsp; ' . $row ."<br><br>");
     echo("</div>\n");
?>
</td>
</tr>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='bottom'>
<td>
<?php

      echo("<input type=radio name='repeat' ".
         ($_cal_event->repeat_on > 0 ? "checked" : "") ."
         value='repeat_on'> ". _REPEAT_ON_ . " ".
         $_cal_form->select("repeat_on", $_cal_event->repeat_on_opts) . " ".
         $_cal_form->select("repeat_on_wday", $_cal_weekdays) ." ".
         _REPEAT_ON_OF_ ." ".
       $_cal_form->textbox("repeat_on_months", 2, " maxlength=2") .
	" ". _MONTHS_);

      echo(" &nbsp; ");

?>
</td>
</tr>
</table>
<script language="javascript" type="text/javascript">

function repeat_every_val_weekdays_show(ind)
{

   if(ind == 4) {
      document.getElementById('repeat_every_val_weekdays').style.display = 'inline';
   } else {
      document.getElementById('repeat_every_val_weekdays').style.display = 'none';
   }
}

repeat_every_val_weekdays_show(document.forms['<?php echo($_cal_form->name) ?>'].elements['repeat_every_val'].selectedIndex);

</script>
