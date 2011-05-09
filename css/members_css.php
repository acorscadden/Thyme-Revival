<style type="text/css">
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
//


   require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");


   if(!$csss) {

      $_cal_sql or $_cal_sql = new _cal_sql();

      $csss = $_cal_sql->query("select * from {$_cal_dbpref}EventTypes where calendar = 0");
   }

   if($_REQUEST['colors_action'] == _SAVE_) {

      $css['id'] = $_REQUEST['uid'];

      $css['background'] = $_REQUEST['background_color'];
      $css['border'] = $_REQUEST['border_color'];
      $css['timecolor'] = $_REQUEST['font_color'];
      $css['titlecolor'] = $_REQUEST['title_font_color'];
      $css['fontweight'] = ($_REQUEST['weight'] ? "bold" : "");
      $css['fontstyle'] = ($_REQUEST['italics'] ? "italic" : "");
      $css['textdecoration'] = ($_REQUEST['uline'] ? "underline" : "");

      $csss[] = $css;
   }

   foreach($csss as $css)
   {


     $class = 'cal_member_owner_' . $css['id'];

     # background and time color
     ###########################
     echo("#cal td.". $class ." { ");

     if($css['background']) echo(" background: ". $css['background'] ."; ");

     if($css['timecolor'])
        echo(" color: ". $css['timecolor'] ."; ");


     # border color
     if($css['border']) {
        echo("   border-left: 2px solid ". $css['border'] .";\n");
        echo("   border-bottom: 2px solid ". $css['border'] .";\n");
     }

     echo("}\n");

     # title font
     if($css['titlecolor'] || $css['fontweight'] || $css['fontstyle'] || $css['textdecoration'])
     {

        echo("#cal font.". $class .", #cal a.". $class .":link, #cal a.". $class .":visited\n{ ");
 
        if($css['titlecolor'])
           echo("color: ". $css['titlecolor'] ."; ");

        if($css['fontweight'])
           echo("font-weight: ". $css['fontweight'] ."; ");

        if($css['fontstyle'])
           echo("font-style: ". $css['fontstyle'] ."; ");

        if($css['textdecoration'])
           echo("text-decoration: ". $css['textdecoration'] ."; ");


         echo("\n}\n\n\n");
     }

   }
   unset($csss);

   
?>
</style>
