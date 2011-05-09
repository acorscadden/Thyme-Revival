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
// $Id: admin.php,v 1.19 2006/03/13 00:28:28 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(_CAL_BASE_PATH_."include/images.php");
  
   $_cal_html->print_heading(_ADMIN_);

   global $_cal_user;

   if(!$_cal_user->admin) {
         $_cal_html->permission_denied(false); # fixed
         return;
   }



   $url = new _cal_url();

   $row_length = 4;

?>
   <br><br><br>
   <table border=0 align=center width='<?php echo($row_length * 100) ?>'
    class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>' cellpadding=15 cellspacing=0 style='border: 2px solid'>
<?php


   ## admin modules
   ###################

   global $_cal_modules;

   $count = count($_cal_modules['admin']['sub_modules']);

   echo("<tr class='"._CAL_CSS_ROW_HEADER_."' valign=top>\n");

   for($i = 0; $mod_name = $_cal_modules['admin']['sub_modules'][$i], $i < $count; $i++)
   {

      $mod = $_cal_modules[$mod_name];

      if($i % $row_length == 0 && $i > 0)
      {
         echo("\n</tr>\n<tr class='"._CAL_CSS_ROW_HEADER_."' valign=top>\n");
      } 
   

      echo("\n<td width='25%' align=center>
	<table class='"._CAL_CSS_BOUNDING_TABLE_."' border=0 cellspacing=0 cellpadding=0>
		<tr class='"._CAL_CSS_ROW_HEADER_."'>
		<td align=center>\n");


      $url = new _cal_url();
      $url->addArg("module", $mod_name);

      $img_src = $_cal_html->get_img_url("modules/". $mod_name ."/" . $mod['icon']);

      echo("<a href='". $url->toString() ."'>");

      echo(_ex_img_str($img_src, $mod['display_name']));

      echo("</a>");

      echo("</td>\n</tr>\n<tr class='"._CAL_CSS_ROW_HEADER_."'>\n<td align=center>\n");

      echo("<a href='". $url->toString() ."'>". $mod['display_name'] ."</a>");

      echo("\n</td>\n</tr>\n</table>\n</td>\n");

   }

   # fill in the rest if need be
   for($i = 0; ($i + $count) % $row_length; $i++)
   {
      echo("\n<td width='100' align=center> &nbsp; </td>\n");
   }


   echo("\n</tr>\n</table>\n");


?>
<br><br><br>
