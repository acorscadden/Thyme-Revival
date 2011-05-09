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
// $Id: locale.php,v 1.17 2007/03/02 00:59:25 ian Exp $
//


   $_cal_tmpl->new_row();

   ## DAYLIGHT SAVINGS
   ######################
   $tmparr = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}DST");

   # CHECK FOR NEW DST
   #####################
   if(count($tmparr) < 18) {
 
      # ADD OLD DST
      $_cal_sql->query("insert into {$GLOBALS['_cal_dbpref']}DST values (18,
        'North America / United States, Canada, Mexico (OLD)', 39312000,
        55123200, 1, 0, 5, 0, 'FREQ=1;INTERVAL=1;BYMONTH=4;BYDAY=10',
        'FREQ=1;INTERVAL=1;BYMONTH=10;BYDAY=-10')");

     # UPDATE EXISTING TO REFLECT CHANGE
     $_cal_sql->query("update {$GLOBALS['_cal_dbpref']}DST set starttime = 36633600,
        endtime = 57801600,
        repeat_on = 2, repeat_on_wday = 0,
        repeat_on_end = 1, repeat_on_wday_end = 0,
        rrule_st = 'FREQ=1;INTERVAL=1;BYMONTH=3;BYDAY=20',
        rrule_end = 'FREQ=1;INTERVAL=1;BYMONTH=11;BYDAY=10'
        where id = 13;"); 

    $tmparr = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}DST");

   }

   # NEW DST
   @define('_DST_OPTS18_', constant('_DST_OPTS13_') .' (OLD)');

   usort($tmparr, "dst_sort");

   $repeat_on_opts = array("no");
   
   for($i = 1; $i < 5; $i++) {
      $repeat_on_opts[] = @constant("_REPEAT_ON". $i ."_");
   }
   $repeat_on_opts[] = _REPEAT_ONL_;
   
   $daylightsavings_options["0"] = _ON_;
   $daylightsavings_options["-1"] = _OFF_;
   $daylightsavings_options["-"] = '        ---------';
   
   echo("<script language='JavaScript' type='text/javascript'>\n<!--\n\nvar dst_opts = new Array();\n");
   
   foreach($tmparr as $dsts)
   {  
      
      $daylightsavings_options[$dsts['id']] = @constant("_DST_OPTS". $dsts['id'] ."_"); 

      $date = $dsts['starttime'];
    
      if($dsts['repeat_on'] == 0) {

         if(@constant("_CAL_EURO_DATE_")) {         
            $startstr = _ex_date("j", $date) ." ";
            $startstr .= $_cal_months[_ex_date("n", $date)];
          } else {
            $startstr = $_cal_months[_ex_date("n", $date)];
            $startstr .= " ". _ex_date("j", $date);
          }

      } else {
         
         $startstr = $repeat_on_opts[($dsts['repeat_on'])];
         $startstr .= " ". $_cal_weekdays[$dsts['repeat_on_wday']];
         $startstr .= " ". _IN_ ." ";
         $startstr .= $_cal_months[_ex_date("n", $date)];
      }
      
      $date = $dsts['endtime'];

      if($dsts['repeat_on_end'] == 0) {

         if(@constant("_CAL_EURO_DATE_")) {
            $endstr = _ex_date("j", $date) ." ";
            $endstr .= $_cal_months[_ex_date("n", $date)];
         } else {
            $endstr = $_cal_months[_ex_date("n", $date)];
            $endstr .= " ". _ex_date("j", $date);
         }

      } else {
         
         $endstr = $repeat_on_opts[($dsts['repeat_on_end'])];
         $endstr .= " ". $_cal_weekdays[$dsts['repeat_on_wday_end']];
         $endstr .= " ". _IN_ ." ";
         $endstr .= $_cal_months[_ex_date("n", $date)];
      }
      
      echo("\tdst_opts[". $dsts['id'] ."] = new Array();\n");
      echo("\tdst_opts[". $dsts['id'] ."]['start'] = \"". $startstr ."\";\n");
      echo("\tdst_opts[". $dsts['id'] ."]['end'] = \"". $endstr ."\";\n\n");
   
   
   }



?>

function setDST()
{

   var dst_selected = document.forms['<?php echo($_cal_form->name) ?>'].elements['dst'].options[document.forms['<?php echo($_cal_form->name) ?>'].elements['dst'].selectedIndex].value;


   if(dst_opts[dst_selected]) {

      document.getElementById("dststart_lbl").innerHTML = dst_opts[dst_selected]['start'];
   
      document.getElementById("dstend_lbl").innerHTML = dst_opts[dst_selected]['end'];

   } else {

      document.getElementById("dststart_lbl").innerHTML = '';
      document.getElementById("dstend_lbl").innerHTML = '';

   }
}

-->
</script>
<?php $GLOBALS['_cal_html']->js_onload[] = "setDST();"; ?>
<?php

   $_cal_tmpl->end_row();

   ## TIMEZONES
   ##################
   for($i = 0; $i <=12; $i += .5) {

      $str = "_GMT_PLUS_". number_format($i, 1) ."_";
      $timezone_options[number_format($i, 1)] = @constant($str);
   }
   
   for($i = 12; $i > 0; $i -= .5) {

      $str = "_GMT_MINUS_". number_format($i, 1) ."_";
      $timezone_options["-".number_format($i, 1)] = @constant($str);
   }

   ksort($timezone_options);
 
/* 
   ## LANGUAGES 
   ###################
   $dh = dir("./include/languages");
   while (false !== ($entry = $dh->read())) {
      if(substr($entry, 0,1) == ".") {
         continue;
      }
      
      if(!($fh = fopen("./include/languages/".$entry, "r", TRUE)) 
	say we failed;

      
      while(!feof($fh)) {
         $lang = fgets($fh, 1024);
         ltrim($lang);
#         if(strncasecmp($lang, "define(", 6) == 0 && strpos($lang, "_LANG_NAME_") !== false) {
#            $lang = preg_replace("/.*_LANG_NAME_.*\, *\"(.*)\"./", "$1", $lang);
            $language_options[$entry] = $lang;
            break;
      }
      fclose($fh);
   
   }
   $dh->close();
*/

   $_cal_tmpl->section_row(_TIMEZONE_, $_cal_form->select('timezone', $timezone_options));
   
   $_cal_tmpl->section_row(_DST_, $_cal_form->select('dst', $daylightsavings_options,
        'onChange="javascript:setDST();"'));
   
   $_cal_tmpl->section_row("", " 

         <table border=0 cellspacing=0 cellpadding=2>
         <tr class='"._CAL_CSS_ROW_HEADER_."'>
            <td align='right'> ". _STARTS_ ." : </td>
            <td align='left'> <b><span id='dststart_lbl'></span></b></td>
         </tr>
         <tr class='"._CAL_CSS_ROW_HEADER_."'>
            <td align='right'> ". _ENDS_ ." : </td>
            <td align='left'> <b><span id='dstend_lbl'></span></b></td>
         </tr>
         </table>
        ");

   #$_cal_tmpl->section_spacer();


#   $_cal_tmpl->section_row(_LANGUAGE_, $_cal_form->select('language', $language_options));


function dst_sort($a, $b)
{

   return strcasecmp(constant("_DST_OPTS". $a['id'] ."_"), constant("_DST_OPTS". $b['id'] ."_"));
}
?>
