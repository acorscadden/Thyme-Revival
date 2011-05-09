<?php


require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.rss.php");


if(!function_exists("_ex_rss_block")) {

function _ex_rss_block($t,$fname,$style,$scrolling)
{

   $rss = new _cal_rss();
   $content = $rss->parse(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/repository/".$fname); 


   $rssnotes = array();

   echo("
<table width='100%' style='border-collapse: collapse' class='"._CAL_CSS_BOUNDING_TABLE_."'>
<tr class='"._CAL_CSS_BOUNDING_TABLE_."'>
   <td class='"._CAL_CSS_BOUNDING_TABLE_."'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='"._CAL_CSS_HEADING_."'>" . $t ."</th> </tr>
      <tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_."'> </td></tr>
      <tr class='"._CAL_CSS_CAL_CONTENT_."' valign='middle'>
         <td align='left' style='padding: 4px;'><div align='center' style='padding: 2px'>");


#########################
#
### SCROLLING STYLE
#
#########################
switch($scrolling)
{

   case 1:
      echo("<div align='left' style='height: 100px; overflow:-moz-scrollbars-vertical;overflow-x:hidden;overflow-y:scroll;'>");
      break;

   case 2:
      echo("<MARQUEE width='135' dataformats='html' behavior='scroll' hspace=0 vspace=0 align='left' direction='up' height='100' scrollamount='2' scrolldelay='110' onmouseover='this.stop()' onmouseout='this.start()'>");
      break;


   default:
      echo("<div align='left'>\n");

}
     $items = $content['items'];

     @include(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/styles/". $style ."/header.php");

      @include(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/styles/". $style ."/items.php");

     @include(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/styles/". $style ."/header.php");


#########################
#
### SCROLLING STYLE
#
#########################
switch($scrolling)
{

   case 1:
      echo("</div>");
      break;

   case 2:
      echo("</MARQUEE>");
      break;

   default:
      echo("</div>");

}

         echo("
         </div>
         </td>
      </tr>
   </table>
   </td>
</tr>
</table>
");

$GLOBALS['_cal_notes'] = array_merge($GLOBALS['_cal_notes'], $rssnotes);


}
}

?>
