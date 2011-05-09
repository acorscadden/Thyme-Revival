<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 eXtrovert Software                           |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@extrosoft.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: preview_scrolling.php,v 1.9 2006/03/10 17:37:05 ian Exp $
//


   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.rss_modules$/","",dirname(__FILE__));

   define("_CAL_BASE_PATH_", $BASE_PATH);
   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");

   global $_cal_sql, $_cal_user, $_cal_html;

   $_cal_sql or $_cal_sql = new _cal_sql();
   $_cal_html = new _cal_html();

   $scrollbars = array(_OVERFLOW_,_SCROLLBAR_,_AUTOSCROLL_);

   $_cal_html->print_header(_SCROLLING_);
?>
<div class='<?php echo(_CAL_CSS_CALNAV_) ?>'>
<table width='150' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>"'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='<?php echo(_CAL_CSS_HEADING_) ?>'><?php echo(_OVERFLOW_) ?></th> </tr>
      <tr class='<?php echo(_CAL_CSS_SPACER_TINY_) ?>'><td class='<?php echo(_CAL_CSS_SPACER_TINY_) ?>'> </td></tr>
      <tr class='<?php echo(_CAL_CSS_CAL_CONTENT_) ?>' valign='middle'>
         <td align='left' style='padding: 4px;'><div align='center' style='padding: 2px'>
<div style='text-align: left'>
<ul> 

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

</ul>
</div>
         </td>
      </tr>
   </table>
   </td>
  </tr>
</table>
<br><br>

<table width='150' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='<?php echo(_CAL_CSS_HEADING_) ?>'><?php echo(_SCROLLBAR_) ?></th> </tr>
      <tr class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"><td class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"> </td></tr>
      <tr class="<?php echo(_CAL_CSS_CAL_CONTENT_) ?>" valign="middle">
         <td align="left" style='padding: 4px;'>
<div style='height: 100px; overflow:-moz-scrollbars-vertical;overflow-x:hidden;overflow-y:scroll; font-size: 10px;'>
<ul>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

</ul>
</div>
         </td>
      </tr>
   </table>
   </td>
</tr>
</table>


<br><br>


<table width='150' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='<?php echo(_CAL_CSS_HEADING_) ?>'><?php echo(_AUTOSCROLL_) ?></th> </tr>
      <tr class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"><td class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"> </td></tr>
      <tr class="<?php echo(_CAL_CSS_CAL_CONTENT_) ?>" valign="middle">
         <td align="left" style='padding: 4px;'>
<MARQUEE behavior="scroll" align="left" direction="up" height="100" vspace=0
	scrollamount="2" scrolldelay="90" onmouseover='this.stop()' onmouseout='this.start()'>
<div style='font-size: 10px'>
<ul>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?><br><br></li>

<li><?php echo(_TITLE_) ?><br>
<?php echo(_DESCRIPTION_) ?></li>
</ul> </marquee>
</div>
         </td>
      </tr>
   </table>
   </td>
</tr>
</table>

</div>
<?php
   $_cal_html->print_footer();
?>
