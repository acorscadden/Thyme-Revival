<?php

require_once(_CAL_BASE_PATH_."include/images.php");

function _ex_ask_delete($msg,$item,&$form,$action,$xtra="")
{

   echo("<table border=1 align='center' cellpadding=8
                    class='"._CAL_CSS_SPACED_TABLE_."'>
	<tr><td><div style='margin: 20px'>\n");


   echo("<h3 align='center'><img src='"._CAL_BASE_URL_."images/error.gif' align='middle'> ". $msg .
		"<br><br><font class='"._CAL_CSS_HIL_."'><b>

      $item</b></font></h3><br>

   	$xtra</div>"); 

   echo("</td></tr><tr><td align='center' class='"._CAL_CSS_TOOLBAR_."'>");

   echo($form->submit($action,_DELETE_) ." ". $form->submit($action,_CANCEL_));

   echo("</td></tr></table>");
}

?>
