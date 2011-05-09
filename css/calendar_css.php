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


   if(!@constant("_CAL_BASE_PATH_"))
      define("_CAL_BASE_PATH_", preg_replace("/css$/","",dirname(__FILE__)));

   require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

   global $_cal_sql, $_cur_cal, $_cal_dbpref;

   # included by class.html.php?      # included by class.calendar_real.php
   $ccal = $_cur_cal->id or $ccal = $_REQUEST['calendar'];

   if(!$ccal) {
      echo("</style>\n");
      return;
   }

   $_cal_sql or $_cal_sql = new _cal_sql();

   $_cur_cal or $_cur_cal = new _cal_obj(abs($ccal));

   #########################
   #
   ### BASED ON OPTIONS
   #
   ########################

   # by event type or calendar
   if(!($_cur_cal->options & 16)) {

      $csss = $_cur_cal->get_category_css();

   # by owner
   } else {

      $csss = $_cal_sql->query("select * from {$_cal_dbpref}EventTypes where calendar = 0");
   }

   if(!is_array($csss)) $csss = array();
   
   foreach($csss as $css)
   {

     # SEE IF WE HAVE ANY CSS AT ALL
     #################################
     if(!($_cur_cal->_has_css)) {

        $_cur_cal->_has_css = strlen($css['background'].$css['timecolor'].$css['border']);

     }


     if(!($_cur_cal->options & 16)) {
        $class = 'cal_event_type_' . $css['id'] ."_". $css['calendar'];
     } else {
        $class = 'cal_event_owner_' . $css['id'];
     }

     # background and time color
     ###########################
     echo("#cal td.". $class ." { ");

     if($css['background']) echo(" background: ". $css['background'] ." ! important; ");

     if($css['timecolor'])
        echo(" color: ". $css['timecolor'] ." ! important; ");


     # border color
     if($css['border']) {
        echo("   border-left: 2px solid ". $css['border'] ." ! important;\n");
        echo("   border-bottom: 2px solid ". $css['border'] ." ! important;\n");
        echo("   border-top: 0px ! important;   border-right: 0px ! important;\n");
     }

     echo("}\n");

     # title font
     if($css['titlecolor'] || $css['fontweight'] || $css['fontstyle'] || $css['textdecoration'])
     {

        $_cur_cal->_has_css = 1;

        echo("#cal font.". $class .", #cal a.". $class .":link, #cal a.". $class .":visited\n{ ");
 
        if($css['titlecolor'])
           echo("color: ". $css['titlecolor'] ." ! important; ");

        if($css['fontweight'])
           echo("font-weight: ". $css['fontweight'] ." ! important; ");

        if($css['fontstyle'])
           echo("font-style: ". $css['fontstyle'] ."; ! important");

        if($css['textdecoration'])
           echo("text-decoration: ". $css['textdecoration'] ." ! important; ");


         echo("\n}\n\n\n");
     }

   }

   unset($csss);   
?>
</style>
