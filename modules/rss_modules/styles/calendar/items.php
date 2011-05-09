<?php 

for($i = 0; $i < count($items); $i++)
{

   echo(" <b>&middot;</b> <a class='"._CAL_CSS_ULINE_."' target=_blank href='{$items[$i]['link']}'>{$items[$i]['title']}</a>
	<b>&middot;</b>");

   $_r_pdate = _ex_strtotime($items[$i]['pubDate']);

   # FORMAT DATE
   ##################
   $_r_date = $GLOBALS['_cal_weekdays'][_ex_date("w",$_r_pdate)] ." ".
	_ex_date(_DATE_INT_NOYR_, $_r_pdate) ." ". _ex_display_time_med($_r_pdate);

   echo("<br> <b>-</b> {$_r_date} <b>-</b>\n");

   if($items[$i]['description']) echo("<br>".$items[$i]['description']);

   if($i < (count($items) - 1)) echo("<br><br>");
   else echo("<Br>");

}

?>
