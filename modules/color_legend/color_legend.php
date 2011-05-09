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

   global $_cal_sql, $_cur_cal, $_cal_dbpref;



   require_once(_CAL_BASE_PATH_."include/classes/class.url.php");




   # GET OWNERS
   ######################
   if($_cur_cal->options & 16) {

      $csss = $_cal_sql->query("select distinct owner, {$_cal_dbpref}Users.name from {$_cal_dbpref}Events
        left join {$_cal_dbpref}Users on {$_cal_dbpref}Users.id = owner
        where calendar ". $_cur_cal->get_constraint() ."order by {$_cal_dbpref}Users.name", true);


      if(function_exists("_ex_auth_login")) {

         $ids = array_keys($csss);

         $csss = _ex_auth_get_users_by_id($ids, true);

         uasort($csss, "_ex_style_owner_sort");

      } 


   # GET CALENDARS OR CATEGORIES
   ##################################
   } else {

      # CALENDARS
      if($_cur_cal->type == 1 || $_cur_cal->type == 2) {

         $csss = $_cal_sql->query("select {$_cal_dbpref}Calendars.id, {$_cal_dbpref}Calendars.title from
            {$_cal_dbpref}EventTypes
            left join {$_cal_dbpref}Calendars on {$_cal_dbpref}Calendars.id = {$_cal_dbpref}EventTypes.id
            where {$_cal_dbpref}EventTypes.calendar = ". $_cur_cal->id ."
            and {$_cal_dbpref}Calendars.id ". $_cur_cal->get_constraint() ."
            order by lower({$_cal_dbpref}Calendars.title)", true);


      # CATEGORIES
      } else {


         if(!$_cur_cal->has_css) return;

         $csss = $_cur_cal->get_categories();


      }

   }

   if(!count($csss)) return;

   if(!$_cal_user->admin) {

      $viewable = $_cal_user->access->get_cals_sel(0);
   }


?>
<table width='100%' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_)?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr> <th class='<?php echo(_CAL_CSS_HEADING_) ?>'><?php echo(_COLOR_LEGEND_) ?></th> </tr>
      <tr class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"><td class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"> </td></tr>
<?php

$_cal_url = new _cal_url();
$_cal_url->addArg("et_flag",1);

if($_cur_cal->type != 1 && $_cur_cal->type != 2) {

   $_cur_cal->get_category_icons();

   include_once(_CAL_BASE_PATH_."include/images.php");
}

foreach(array_keys($csss) as $k)
{

   echo("<tr class='"._CAL_CSS_CAL_CONTENT_."' valign='middle'>");

   if($_cur_cal->options & 16) {

      if(!is_array($csss[$k])) $csss[$k] = array('name' => $csss[$k]);

      echo("<td align='left' style='border-left: 1px solid; border-bottom: 1px solid'
            class='"._CAL_CSS_CAL_CONTENT_ ." cal_event_owner_". $k ."'>\n");
      echo("<font class='"._CAL_CSS_CAL_EVENT_." cal_event_owner_". $k ."'>".$csss[$k]['name']."</font>");

   } else {

      echo("<td align='left' style='border-left: 1px solid; border-bottom: 1px solid'
            class='"._CAL_CSS_CAL_EVENT_." cal_event_type_". $k ."_". $_cur_cal->id ."'>\n");

      if(($_cur_cal->type != 1 && $_cur_cal->type != 2) && (intval($_SESSION['evnt_type']) & intval($k))) {
         echo(" <b> <font size=1>&middot;</font> </b> ");
         $et_on = 0;
      } else {
         $et_on = 1;
      }

        $class = _CAL_CSS_CAL_EVENT_ ." cal_event_type_". $k ."_". $_cur_cal->id;

        if($_cur_cal->type != 1 && $_cur_cal->type != 2) {

           if(($_cal_icon = $_cur_cal->cat_icons[$k])) {

              echo(_ex_img_str(_CAL_BASE_URL_.$_cal_icon, _ICON_, 12, 12) ." ");

           }

           $_cal_url->addArg("et_on", $et_on);
           $_cal_url->addArg("lcat", $k);

       } else { 
           $check_access = 1;
           $_cal_url->addArg('et_flag',null);
           $_cal_url->addArg("calendar", $k);
       }


      
       if($check_access && !$_cal_user->admin & !$viewable[$k]) {
           echo("<font class='{$class}'>{$csss[$k]}</font>");
       } else {
           echo("<a href='". $_cal_url->toString() ."' class='{$class}'>{$csss[$k]}</a>");
       }


   }

   echo("</td>\n</tr>\n");
}
?>
   </table>
   </td>
</tr>
</table>
<br>
<?php
if(function_exists("_ex_style_owner_sort")) return;
function _ex_style_owner_sort($a,$b) { return strcasecmp($a['name'],$b['name']); }
?>
