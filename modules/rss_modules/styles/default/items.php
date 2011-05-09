<?php 

for($i = 0; $i < count($items); $i++)
{

   echo(" <b>&middot;</b> <a class='"._CAL_CSS_ULINE_."' target=_blank href='{$items[$i]['link']}'>{$items[$i]['title']}</a>
	<b>&middot;</b> " . ($items[$i]['description'] ? "
	<br>{$items[$i]['description']}" : "") );

   if($i < (count($items) - 1)) echo("<br><br>");
   else echo("<Br>");

}

?>
