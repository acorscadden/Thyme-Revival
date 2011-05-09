<?php

$_cal_form->print_hidden("r_freq");

?>

<table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' width='100%' style='border-collapse: collapse;'>
<tr><td style='padding: 10px'>

   <?php

   $freq_opts = array( _YEARLY_,_MONTHLY_,_WEEKLY_,_DAILY_, _EASTER_YEARLY_);

   # range for month days

    # day select box
    for($i = 31; $i > 1; $i--) { $mday_range[-($i)] = $i ." ". _FROM_LAST_; }
    $mday_range += array(-1 => _LAST_, 0 => '');
    for($i = 1; $i < 32; $i++) { $mday_range[$i] = $i; }


   ?>

<table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' width='100%' style='border-collapse: collapse;'>
<tr>
   <td align='center' style='border-bottom: 1px solid; padding-left: 10px; padding-right: 10px;'>
      <?php echo(_REPEATING_REPEAT_) ?>:
   </td>
   <?php

   for($i = 0; $i < count($freq_opts); $i++)
   {

      echo("<td align='center' nowrap id='freq_tab_". $i ."' class='"._CAL_CSS_CAL_DISABLED_."'
	style='border-width: 1px ; padding: 5px; padding-left: 10px; padding-right: 10px;'>
	<a href='javascript:select_r_tab(".$i.")'>". $freq_opts[$i] ."</a>
	</td>\n");
      echo("<td style='border-bottom: 1px solid'> &nbsp; </td>\n");

   }

   $a = 0; # for divs below
   ?>
   <td style='border-bottom: 1px solid' width='100%'> &nbsp; </td>
</tr>
</table>

<table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' width='100%' cellpadding=0 cellspacing=0>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='top'>
<td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'
	style='border-width: 1px ;
	border-top: 0px;
	padding: 10px'>



<!--

REPEATING YEARLY

//-->
<div id="freq_<?php echo($a++) ?>" style='display: none;'>
<?php
   echo(_REPEATING_REPEAT_ ." "._REPEATING_EVERY1_." ");
   echo($_cal_form->textbox("r_years", 2, "maxlength='2'"). " ");
   echo(_YEARS_."<br><br><i>");
   echo(_YEARLY_NOTES_);
   echo("</i><br><br>");
?>
<table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellpadding=10 cellspacing=0>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='top'>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <?php
   echo('<b>'._WEEKDAYS_.'</b><br>');
   for($i = 0; $i < 7; $i++) {
      echo($_cal_form->checkbox("r_year_wday_". $i) ." ");
      echo($_cal_weekdays[$i] ."<br>");
   }
  ?>
  </td>

 <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left' style='padding-left: 22px;'>
  <?php
   echo('<b>'._MONTHS_."</b><br>");
   for($i = 1; $i < 7; $i++) {
      echo($_cal_form->checkbox("r_year_month_". $i) ." ");
      echo($_cal_months[$i] ."<br>");
   }
  ?>
  </td>
 <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <br>
  <?Php
   for($i = 7; $i < 13; $i++) {
      echo($_cal_form->checkbox("r_year_month_". $i) ." ");
      echo($_cal_months[$i] ."<br>");
   }
  ?>
  </td>

  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='center'>
  <?php

   $_cal_form->defaults["r_yr_days"] = "0";

   echo('<b>'._MONTH_DAYS_.'</b><br><br>');
   echo($_cal_form->select("r_yr_days", $mday_range) ." ");
   ?> <input type="button" class="add_button <?php echo(_CAL_CSS_BUTTON_) ?>" onClick='add_to_sel("r_yr_days","r_years_mdays")'
	value="<?php echo(_ADD_) ?>"><br><br><?php
   echo($_cal_form->mselect_h("r_years_mdays",$_cal_event->r_years_mdays,5,'style="width: 12em"'));
  ?>
   <br>
  <input type="button" class="remove_button <?php echo(_CAL_CSS_BUTTON_) ?>" onClick='rem_sel("r_years_mdays")' value="<?php echo(_REMOVE_) ?>">
  </td>

</tr>
</table>
</div>



<!--

REPEATING MONTHLY

//-->

<div id="freq_<?php echo($a++) ?>" style='display: none;'>
<?php
   echo(_REPEATING_REPEAT_ ." "._REPEATING_EVERY1_." ");
   echo($_cal_form->textbox("r_months", 3, "maxlength='3'"). " ");
   echo(_MONTHS_);
?>
<br><br>
<table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellpadding=10 cellspacing=0>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='top'>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='center'>
  <?Php


   #####################
   # WEEKDAYS
   #####################

   echo('<b>'._WEEKDAYS_.'</b><br><br>');

   echo($_cal_form->mselect_h("r_months_wdays", $_cal_event->r_months_wdays, 7, 'style="width: 10em"'));
  ?>
   <br>
  <input type="button" onClick='rem_sel("r_months_wdays")' class="remove_button <?php echo(_CAL_CSS_BUTTON_) ?>" value="<?php echo(_REMOVE_) ?>">
  </td>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'><br><br>
   <?php
   echo($_cal_form->select("r_mo_wday_freq",array_merge(array(_REPEATING_EVERY1_),$_cal_event->repeat_on_opts))."<br><br>");
   echo($_cal_form->select("r_mo_wday_name",$_cal_weekdays) ."<br><br>");
  ?>
  <input type="button" class="add_button <?php echo(_CAL_CSS_BUTTON_) ?>" onClick='add_r_mo_wday()' value="&lt; <?php echo(_ADD_) ?>"><br><br>
  </td>



  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='center' style='border-left: 1px solid;'>
  <?Php

   ######################
   # MONTH DAYS
   ######################

   echo('<b>'._MONTH_DAYS_.'</b><br><br>');
   $_cal_form->defaults["r_mo_days"] = "0";

   echo($_cal_form->select("r_mo_days",$mday_range));
  
   ?>
   <input type="button" class="add_button <?php echo(_CAL_CSS_BUTTON_) ?>" onClick='add_to_sel("r_mo_days","r_months_mdays")'
		value="<?php echo(_ADD_) ?>"><br><br>

   <?php
   echo($_cal_form->mselect_h("r_months_mdays",$_cal_event->r_months_mdays,5,'style="width: 10em"'));
  ?>
   <br><br>
  <input type="button" onClick='rem_sel("r_months_mdays")' class="remove_button <?php echo(_CAL_CSS_BUTTON_) ?>" value="<?php echo(_REMOVE_) ?>">
  </td>


  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='center' style='border-left: 1px solid;'>
  <?Php

   ######################
   # BYSETPOS
   ######################

   echo('<b>'._SPECIFIC_OCCURRENCES_.'</b><br><br>');
   $_cal_form->defaults["r_mo_setpos"] = "0";

   echo($_cal_form->select("r_mo_setpos",$mday_range));

   ?>
   <input type="button" class="add_button <?php echo(_CAL_CSS_BUTTON_) ?>" onClick='add_to_sel("r_mo_setpos","r_months_setpos")'
	value="<?php echo(_ADD_) ?>"><br><br>

   <?php
   echo($_cal_form->mselect_h("r_months_setpos",$_cal_event->r_months_setpos,5,'style="width: 10em"'));
  ?>
   <br><br>
  <input type="button" onClick='rem_sel("r_months_setpos")' class="remove_button <?php echo(_CAL_CSS_BUTTON_) ?>"
	value="<?php echo(_REMOVE_) ?>">
  </td>

</tr>
</table>
</div>



<!---

REPEATING WEEKLY

//-->
<div id="freq_<?php echo($a++) ?>" style='display: none;'>
<?php
   echo(_REPEATING_REPEAT_ ." "._REPEATING_EVERY1_." ");
   echo($_cal_form->textbox("r_weeks", 3, "maxlength='3'"). " ");
   echo(_WEEKS_ ."<br><Br>");
?>
<table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellpadding=10 cellspacing=0>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='top'>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <?php
   echo('<b>'._WEEKDAYS_.'</b><br>');
   for($i = 0; $i < 7; $i++) {
      echo($_cal_form->checkbox("r_week_wday_". $i) ." ");
      echo($_cal_weekdays[$i] ."<br>");
   }
   echo("<br>\n");
   echo(_STARTING_ON_ ."<br>");
   echo($_cal_form->select("r_wkst", $_cal_weekdays));
   ?>
  </td>

  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'>
  &nbsp;
  </td>

  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <?Php
   echo('<b>'._MONTHS_."</b><br>");
   for($i = 1; $i < 7; $i++) {
      echo($_cal_form->checkbox("r_week_month_". $i) ." ");
      echo($_cal_months[$i] ."<br>");
   }
  ?>
  </td>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <?Php
   echo("<br>");
   for($i = 7; $i < 13; $i++) {
      echo($_cal_form->checkbox("r_week_month_". $i) ." ");
      echo($_cal_months[$i] ."<br>");
   }
  ?>
  </td>

</tr>
</table>
</div>


<!--

REPEATING DAILY


//-->
<div id="freq_<?php echo($a++) ?>" style='display: none;'>
<?php
   echo(_REPEATING_REPEAT_ ." "._REPEATING_EVERY1_." ");
   echo($_cal_form->textbox("r_days", 3, "maxlength='3'"). " ");
   echo(_DAYS_);
?>
<table border=0 class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellpadding=10 cellspacing=0>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' valign='top'>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <?php
   echo('<b>'._WEEKDAYS_.'</b><br>');
   for($i = 0; $i < 7; $i++) {
      echo($_cal_form->checkbox("r_day_wday_". $i) ." ");
      echo($_cal_weekdays[$i] ."<br>");
   }
  ?>
  </td>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'>
  &nbsp;
  </td>

  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <?Php
   echo('<b>'._MONTHS_."</b><br>");
   for($i = 1; $i < 7; $i++) {
      echo($_cal_form->checkbox("r_day_month_". $i) ." ");
      echo($_cal_months[$i] ."<br>");
   }
  ?>
  </td>
  <td class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>' align='left'>
  <?Php
   echo("<br>");
   for($i = 7; $i < 13; $i++) {
      echo($_cal_form->checkbox("r_day_month_". $i) ." ");
      echo($_cal_months[$i] ."<br>");
   }
  ?>
  </td>

</tr>
</table>
</div>



<!--

REPEATING EASTER YEARLY


//-->
<div id="freq_<?php echo($a++) ?>" style='display: none;'>
<?php
   echo($_cal_form->textbox("r_easter", 2, "maxlength='3'"). " ");
   echo(_DAYS_ ." ");
   echo($_cal_form->select("r_easter_when", array(_BEFORE_,_AFTER_)));
   echo(" ". _EASTER_);
?>
</div>

</td></tr></table>

</td>
</tr>
</table>

<script language="JavaScript" type="text/javascript">

var last_selected = 0;

function select_r_tab(tab)
{

   document.<?php echo($_cal_form->name) ?>.elements['r_freq'].value = tab;

   t = document.getElementById('freq_tab_' + tab);

   t.className = 'row_header';
   t.style.borderBottomWidth = '0px';

   document.getElementById("freq_" + tab ).style.display = 'inline';

   if(last_selected != tab) {

	lt = document.getElementById('freq_tab_' + last_selected);
        lt.style.borderBottomWidth = '1px';

        lt.className = 'cal_disabled';

        document.getElementById("freq_" + last_selected).style.display = 'none'; 
        
   }

   last_selected = tab;

   <?php if(!preg_match("/compatible; MSIE/", $_SERVER['HTTP_USER_AGENT'])): ?>

   // avoid Mozilla Bug by 
   // causing it to refresh this div

   if(document.getElementById('advanced_repeat')) {
      r = document.getElementById('advanced_repeat').style
      r.display = 'none';
      r.display = 'inline';
   }

   <?php endif ?>

}

select_r_tab(<?php echo($_cal_event->freq > 0 ? $_cal_event->freq - 1 : 0) ?>);

var wday_list = new Array('SU','MO','TU','WE','TH','FR','SA');


function add_r_mo_wday()
{


   var freq = document.<?php echo($_cal_form->name) ?>.elements['r_mo_wday_freq'].selectedIndex;

   var opt_name = document.<?php echo($_cal_form->name) ?>.elements['r_mo_wday_freq'].options[freq].text;

   var wday = document.<?php echo($_cal_form->name) ?>.elements['r_mo_wday_name'].selectedIndex;

   opt_name += ' ' + document.<?php echo($_cal_form->name) ?>.elements['r_mo_wday_name'].options[wday].text;

   if(freq == 6) {
      freq = -1;
   } else if (freq == 0) {
      freq = '';
   }

   opt_val = freq + '' + wday_list[wday];

    var optlen = document.<?php echo($_cal_form->name) ?>.elements['r_months_wdays'].options.length;

    for(i = 0; i < optlen; i++)
    {

       if(document.<?php echo($_cal_form->name) ?>.elements['r_months_wdays'].options[i].value == opt_val) {
          return;
       }

    }

    document.<?php echo($_cal_form->name) ?>.elements['r_months_wdays'].options[optlen++] = new Option(opt_name, opt_val);


}

function add_to_sel(sel1,sel2)
{

    var index = document.<?php echo($_cal_form->name) ?>.elements[sel1].selectedIndex;

    var name = document.<?php echo($_cal_form->name) ?>.elements[sel1].options[index].text;
    var val = document.<?php echo($_cal_form->name) ?>.elements[sel1].options[index].value;

    if(val == 0) {
       return;
    }

    var optlen = document.<?php echo($_cal_form->name) ?>.elements[sel2].options.length;

    for(i = 0; i < optlen; i++)
    {

       if(document.<?php echo($_cal_form->name) ?>.elements[sel2].options[i].value == val) {
          return;
       }

    }

    document.<?php echo($_cal_form->name) ?>.elements[sel2].options[optlen++] = new Option(name, val);



}


</script>
<?php require_once(@constant("_CAL_BASE_PATH_") ."include/js/msel.js"); ?>

