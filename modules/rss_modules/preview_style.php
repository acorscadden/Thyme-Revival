<?php

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.rss_modules$/","",dirname(__FILE__));

   define("_CAL_BASE_PATH_", $BASE_PATH);
   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");

   global $_cal_sql, $_cal_user, $_cal_html;

   $_cal_sql or $_cal_sql = new _cal_sql();
   $_cal_html = new _cal_html();

   $_cal_html->print_header(_PREVIEW_ ." : ". _STYLE_);


   $item = array('title' => _TITLE_, 'description' => _DESCRIPTION_, 'author' => _AUTHOR_,
	'pubDate' => _ex_date("D, d M Y G:i:00"));

   $items = array();

   for($i = 0; $i < 5; $i++ ) {
      $items[] = $item;
   }   

   $style = $_REQUEST['style'];

   echo("
<div class='"._CAL_CSS_CALNAV_."'>
<table width='150' style='border-collapse: collapse' class='"._CAL_CSS_BOUNDING_TABLE_."'>
<tr class='"._CAL_CSS_BOUNDING_TABLE_."'>
   <td class='"._CAL_CSS_BOUNDING_TABLE_."'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='"._CAL_CSS_HEADING_."'>" . _TITLE_ ."</th> </tr>
      <tr class='"._CAL_CSS_SPACER_TINY_."'><td class='"._CAL_CSS_SPACER_TINY_."'> </td></tr>
      <tr class='"._CAL_CSS_CAL_CONTENT_."' valign='middle'>
         <td align='left' style='padding: 4px;'><div align='center'>");


      echo("<div align='left'>\n");



     @include(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/styles/". $style ."/header.php");

      @include(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/styles/". $style ."/items.php");

     @include(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/styles/". $style ."/header.php");


      echo("</div>");



         echo("
         </div>
         </td>
      </tr>
   </table>
   </td>
</tr>
</table>
</div>
");

$GLOBALS['_cal_notes'] = $rssnotes;
require_once(@constant("_CAL_BASE_PATH_") . "include/js/notes_popups.js");

# print remaining notes popups
if(is_array($GLOBALS['_cal_notes'])) {
foreach($GLOBALS['_cal_notes'] as $n) {
   print $n;
}
}

$_cal_html->print_footer();

?>
