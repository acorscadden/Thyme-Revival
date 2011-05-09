<?php 

foreach($items as $item)
{

   echo(" <b>&middot;</b> <a class='"._CAL_CSS_ULINE_."' target=_blank href='{$item['link']}'>{$item['title']}</a>
	<b>&middot;</b>
	<br><div align='justify'>{$item['description']}</div>
	<center><hr width=75%>{$item['author']} : {$item['pubDate']}</center><br>");

}

?>
