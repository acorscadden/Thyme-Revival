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
// $Id: calendar_colors_tpl.php,v 1.11 2007/01/10 05:12:49 ian Exp $
//


   global $_cal_user, $_cal_sql, $_cal_form, $_cal_obj;

   $_cal_tmpl->new_section(_COLORS_);


###########################
#
### UPDATE CALENDAR COLORS
#
###########################

function update_cstyle($add = false)
{

   global $_cal_obj, $_cal_sql, $_cal_dbpref;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event_type.php");



   if(!$_REQUEST['event_types']) return;
   # CHECK IF IT ALREADY EXISTS
   list($ex) = $_cal_sql->query("select id from {$GLOBALS['_cal_dbpref']}EventTypes
        where id = ". $_REQUEST['event_types'] ." and calendar = ". $_cal_obj->id);

   if($ex['id']) {
      $et = new _cal_event_type(array("id" => $_REQUEST['event_types'], "calendar" => abs($_cal_obj->id)));
   } else {
      $et = new _cal_event_type();
      $et->id = $_REQUEST['event_types'];
      $et->calendar = abs($_cal_obj->id);
   }


   $et->name = $_REQUEST['event_types'];

   $et->background = $_REQUEST['background_color'];
   $et->border = $_REQUEST['border_color'];
   $et->timecolor = $_REQUEST['font_color'];
   $et->titlecolor = $_REQUEST['title_font_color'];

   $et->fontweight = ($_REQUEST['weight'] ? "bold" : "");
   $et->fontstyle = ($_REQUEST['italics'] ? "italic" : "");
   $et->textdecoration = ($_REQUEST['uline'] ? "underline" : "");

   # All calendars view with no style set.
   if($_cal_obj->type == 2 && $ex['id'] && (
    trim($et->background.$et->border.$et->timecolor.$et->titlecolor.$et->fontweight.
      $et->fontstyle.$et->textdecoration) == '')) {

      # remove it from the a

      $_cal_sql->query("delete from {$_cal_dbpref}EventTypes where id = {$ex['id']}
        and calendar = {$_cal_obj->id}");

      return;

   }
   $et->save();

}



#######################
#
### DECIDE WHAT THO DO
#
#######################

if($_REQUEST['etype_action']) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

if(strtolower($_REQUEST['etype_action']) == strtolower(_UPDATE_))
{

      update_cstyle();

}

require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");

###########################
#
### CALENDARS
#
###########################
 
   $cstyle = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}EventTypes where calendar = ".$_cal_obj->id);

   foreach($cstyle as $c)
   {

      $styles[$c['id']]['background'] = $c['background'];
      $styles[$c['id']]['border'] = $c['border'];
      $styles[$c['id']]['timecolor'] = $c['timecolor'];
      $styles[$c['id']]['titlecolor'] = $c['titlecolor'];
      $styles[$c['id']]['fontweight'] = $c['fontweight'];
      $styles[$c['id']]['fontstyle'] = $c['fontstyle'];
      $styles[$c['id']]['textdecoration'] = $c['textdecoration'];

   }

   unset($cstyle);

   ob_start();
?>

   var calendars = new Array();
<?php

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/helpers/tie_to.php");

   if($_cal_obj->type == 2) {
      $members = $_cal_sql->query("select * from {$_cal_dbpref}Calendars where type not in (1,2) order by lower(title)");
   }

   foreach($members as $mem)
   {

      _ex_tie_to($mem, $styles[$mem['id']]);
      
      echo("\tcalendars[". $mem['id'] ."] = new Array();\n");
      echo("\tcalendars[". $mem['id'] ."]['background'] = '". $mem['background'] ."';\n");
      echo("\tcalendars[". $mem['id'] ."]['border'] = '". $mem['border'] ."';\n");
      echo("\tcalendars[". $mem['id'] ."]['timecolor'] = '". $mem['timecolor'] ."';\n");
      echo("\tcalendars[". $mem['id'] ."]['titlecolor'] = '". $mem['titlecolor'] ."';\n");
      echo("\tcalendars[". $mem['id'] ."]['fontweight'] = '". $mem['fontweight'] ."';\n");
      echo("\tcalendars[". $mem['id'] ."]['fontstyle'] = '". $mem['fontstyle'] ."';\n");
      echo("\tcalendars[". $mem['id'] ."]['textdecoration'] = '". $mem['textdecoration'] ."';\n");

      echo("\n\n");

      unset($styles[$mem['id']]);

   }


   $js = ob_get_contents();
   ob_end_clean();

   $_cal_html->js_onload[] = $js;

   $_cal_tmpl->row_header_width = 200;

   ###############################
   #
   ### COLOR LEGEND
   #
   ###############################
   global $_cur_cal;

   $_cur_cal = $_cal_obj;
   include(_CAL_BASE_PATH_."css/calendar_css.php");
ob_start();
?>
<table width='200' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_)?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <table border=0 style='border-collapse: collapse' width='100%'>

      <tr class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"><td class="<?php echo(_CAL_CSS_SPACER_TINY_) ?>"> </td></tr>
<?php


   if($_cal_obj->type == 1) {
      $csss = $_cal_sql->query("select id, title from {$_cal_dbpref}CalendarMembers
        left join {$_cal_dbpref}Calendars on rid = id where
        cid = {$_cal_obj->id} order by lower(title)");
   } else {
     $csss = $_cal_sql->query("select id, title from {$_cal_dbpref}Calendars
        where type in (0,3,4) order by lower(title)");


   }


   include_once(_CAL_BASE_PATH_."include/images.php");

foreach($csss as $css)
{

   $k = $css['id'];

   echo("<tr class='"._CAL_CSS_CAL_CONTENT_."' valign='middle'>");

      echo("<td nowrap align='left' style='border-left: 1px solid; border-bottom: 1px solid; padding: 2px;'
            class='"._CAL_CSS_CAL_EVENT_." cal_event_type_". $k ."_". $_cal_obj->id ."'>\n");

        $class = _CAL_CSS_CAL_EVENT_ ." cal_event_type_". $k ."_". $_cal_obj->id;

           echo("10"._PM_." <a class='{$class}' href=\"javascript:updateEtype({$css['id']},'".
                str_replace("'","\\'",$css['title']) ."')\">{$css['title']}</a>");


   echo("</td>\n</tr>\n");
}

?>
   </table>
   </td>
</tr>
</table>
<?php
echo(_CATEGORY_EDIT_DESC_);

   $legend = ob_get_contents();
   ob_end_clean();

   # END COLOR LEGEND
   #########################


   
   $_cal_tmpl->section_row(_CALENDARS_, $legend);

   $_cal_tmpl->section_spacer();


   #####################
   #
   ## COLOR
   #
   ####################


   $_cal_tmpl->section_row(_PREVIEW_,
        "<table border=0 cellpadding=4 style='border-collapse: collapse' width=110 id='background_color_prev'>
          <tr>
            <td class='"._CAL_CSS_SPACER_SMALL_."' id='border_color_prev_border1'> </td>
            <td>
                <span id='font_color_prev'>10". _PM_ ."</span>
                <span id='title_font_color_prev'>". _SAMPLE_ ."</span>
            </td>
          </tr>
          <tr class='"._CAL_CSS_SPACER_SMALL_."'>
             <td class='"._CAL_CSS_SPACER_SMALL_."' id='border_color_prev_border2' colspan=2> </td>
          </tr>
          </table>\n");

   # need to clear these from $_REQUEST so there's nothing
   # in the text boxes. css_edit.php will put it there otherwise
   #############################################################

   $_REQUEST['background_color'] = $_REQUEST['border_color'] = $_REQUEST['font_color'] = "";
   $_REQUEST['title_font_color'] = $_REQUEST['weight'] = $_REQUEST['italics'] = $_REQUEST['uline'] = "";
  

   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('background_color',
        'background_color_prev'));

   $_cal_tmpl->section_row(_BORDER_COLOR_, border_color_picker('border_color',
        'border_color_prev'));

   $_cal_tmpl->section_row(_TIME_FONT_COLOR_, color_picker('font_color',
        'font_color_prev', true));

   $_cal_tmpl->section_row(_TITLE_FONT_COLOR_, color_picker('title_font_color',
        'title_font_color_prev', true));

   $_cal_tmpl->section_row(_TITLE_FONT_STYLE_, font_weight_picker('weight',
        'title_font_color_prev') .
        "<br>" . font_italics_picker('italics', 'title_font_color_prev').
        "<BR>" . font_uline_picker('uline', 'title_font_color_prev'));

   $_cal_tmpl->new_row();

   $_cal_tmpl->toolbar(
        $_cal_form->submit('etype_action', _UPDATE_),$_cal_form->submit("cals_action", _CLOSE_),
        $_cal_form->print_hidden('event_types',''));

   $_cal_tmpl->end_row();




   ob_start();   
?>
function updateEtype(et_selected, title)
{

    var frm = document.forms['<?php echo($_cal_form->name) ?>'];

   frm.elements['background_color'].value = calendars[et_selected]['background'];
   frm.elements['border_color'].value = calendars[et_selected]['border'];
   frm.elements['font_color'].value = calendars[et_selected]['timecolor'];
   frm.elements['title_font_color'].value = calendars[et_selected]['titlecolor'];

   updateBgColor("background_color","background_color_prev"); 
   updateBorder('border_color','border_color_prev');
   updateFgColor('font_color','font_color_prev');
   updateFgColor('title_font_color','title_font_color_prev');


   frm.elements['weight'].checked = (calendars[et_selected]['fontweight'].length > 0);
   frm.elements['italics'].checked = (calendars[et_selected]['fontstyle'].length > 0);
   frm.elements['uline'].checked = (calendars[et_selected]['textdecoration'].length > 0);

   checkBold('weight', 'title_font_color_prev');
   checkItalics('italics', 'title_font_color_prev');
   checkUline('uline', 'title_font_color_prev');

   document.getElementById('title_font_color_prev').innerHTML = title;

   frm.elements['event_types'].value = et_selected;


}
<?php

   $js = ob_get_contents();
    ob_end_clean();

   $_cal_html->js_onload[] = $js;

   $_cal_tmpl->end_section();
?>
