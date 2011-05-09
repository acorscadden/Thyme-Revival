<?php 

$popup_name = preg_replace("/[^A-Za-z0-9]/","_",$t.$fname);

for($i = 0; $i < count($items); $i++)
{


   echo("<b>&middot;</b> <a class='"._CAL_CSS_ULINE_."'
	onMouseOver='show_notes(\"rssitem_{$popup_name}". $i ."\");'
        onMouseOut='hide_notes(\"rssitem_{$popup_name}". $i ."\")'
	target=_blank href='{$items[$i]['link']}'>{$items[$i]['title']}</a><br><br>");

   $rssnotes[] = "<div id='rssitem_{$popup_name}". $i ."' class='"._CAL_CSS_CAL_NOTE_POPUP_."'
        onMouseOver='clearTimeout(timer)'
        onMouseOut='hide_notes(\"rssitem_{$popup_name}". $i ."\")'
        style='position: absolute; left: 0px; top: 0px;
                visibility: hidden; padding: 4px; border: 1px solid black;'>".
        $items[$i]['description'] ."</div>";

}

?>
