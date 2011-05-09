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
// $Id: event_types_tpl.php,v 1.7 2006/03/10 17:36:45 ian Exp $
//


   global $_cal_user, $_cal_sql, $_cal_form, $_cal_obj;

   $_cal_tmpl->new_section(_EVENT_TYPES_);


###########################
#
### ADD AN EVENT TYPE
#
###########################

function update_etype($add = false)
{

   global $cal;

   $name = $_REQUEST['ename'];
   $icon = $_REQUEST['icon'];

   require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.event_type.php");



   if(!strlen($_REQUEST['ename']) > 0) { 
	return;
   }

   $new_id = 0;

   global $_cal_sql, $_cal_html, $_cal_obj;

   if($add) { 

      $et = new _cal_event_type();

      # get a list of current ids in use..
      ###################################

      $ids = $_cal_sql->query("select id from {$GLOBALS['_cal_dbpref']}EventTypes
            where calendar = {$_cal_obj->id} order by id", true);

      for($i = 1; array_key_exists($i, $ids); $i *=2) {}

      $et->id = $i;
      $et->calendar = $_cal_obj->id;


   } else {

      if($_REQUEST['event_types'] == "") return;

      $et = new _cal_event_type(array("id" => $_REQUEST['event_types'], "calendar" => $_cal_obj->id));
   }

   $et->name = $name;
   $et->icon = $icon;
   $et->background = $_REQUEST['background_color'];
   $et->border = $_REQUEST['border_color'];
   $et->timecolor = $_REQUEST['font_color'];
   $et->titlecolor = $_REQUEST['title_font_color'];

   $et->fontweight = ($_REQUEST['weight'] ? "bold" : "");
   $et->fontstyle = ($_REQUEST['italics'] ? "italic" : "");
   $et->textdecoration = ($_REQUEST['uline'] ? "underline" : "");

   $et->save();


}



######################
#
### 
#
######################

function really_delete()
{

   global $_cal_sql, $_cal_form, $_cal_html, $_cal_obj, $_cur_cal;

   if($_REQUEST['event_types'] == "") return 1;

      # delete all events in this category
      ###################################
      if($_REQUEST['delete_all']) {

         require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.event.php");

         # get events..
         $eids = $_cal_sql->query("select id, id from {$GLOBALS['_cal_dbpref']}Events where
            calendar = {$_cal_obj->id} and etype = ". $_REQUEST['event_types'], 1);

         foreach($eids as $eid) {
            _cal_event::delete($eid);
         }

         # remaining events are overrides
         # in other categories
         ##################################
         $_cal_sql->query("update {$GLOBALS['_cal_dbpref']}Events set etype = 0,
            override_id = 0, override_date = 0 where
            calendar = {$_cal_obj->id} and etype = ". $_REQUEST['event_types']); 

      } else {

         # set categories to 0
         #######################3
         $_cal_sql->query("update {$GLOBALS['_cal_dbpref']}Events set etype = 0 where
            calendar = {$_cal_obj->id} and etype = ". $_REQUEST['event_types']);

      }

      $_cal_sql->query("delete from {$GLOBALS['_cal_dbpref']}EventTypes where calendar = {$_cal_obj->id} and
            id = ". $_REQUEST['event_types']);


      # reset current category filter?
      ###############################
      if($_cal_obj->id == $_cur_cal->id && $_REQUEST['event_types'] == $_SESSION['evnt_type']) {
         $_SESSION['evnt_type'] = 0;
      }


}

function confirm_delete()
{

   global $_cal_sql, $_cal_form, $_cal_html, $_cal_obj, $_cal_tmpl;

   if($_REQUEST['event_types'] == "") return 0;

   $_cal_tmpl->new_row();

   # confirm deletion..
   $query = "select * from {$GLOBALS['_cal_dbpref']}EventTypes where
            calendar = {$_cal_obj->id} and id = ". $_REQUEST['event_types'];

   list($et) = $_cal_sql->query($query);

      echo("<h4 align='center'>". _REALLY_DELETE_EVENT_TYPE_ ."<br><font class='"._CAL_CSS_HIL_."'><b>");
      echo($et['name']);
      echo("</b></font></h4><div align='center'>");

      echo($_cal_form->checkbox('delete_all'). " ". _DELETE_ALL_IN_CATEGORY_);

      echo("</div><br>");

   echo($_cal_form->fromRequest('event_types'));
   $_cal_form->print_hidden('etype_action', 'really_delete');


   $_cal_tmpl->toolbar("",
   $_cal_form->submit('',_DELETE_) . " ".
   $_cal_form->submit('etype_action', _CANCEL_ ),"");

   $_cal_tmpl->end_row();

   return 1;
}


#######################
#
### DECIDE WHAT THO DO
#
#######################

if($_REQUEST['etype_action']) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

switch(strtolower($_REQUEST['etype_action']))
{

   case strtolower(_DELETE_);
      $cd = confirm_delete();
      if($cd) { $_cal_tmpl->end_section(); return; }

   case strtolower(_UPDATE_):
      update_etype();
      break;

   case strtolower(_ADD_):
      update_etype(true);
      break;

   case "really_delete":
      really_delete();
      break;

}

require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");

###########################
#
### EVENT TYPES
#
###########################
 
   $etypes = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}EventTypes where calendar = {$_cal_obj->id}
       order by lower(name)");

ob_start();
?>

   var etypes = new Array();
<?php

   $etypes[] = array('id' => '0');

   foreach($etypes as $et)
   {

      echo("\tetypes[". $et['id'] ."] = new Array();\n");
      echo("\tetypes[". $et['id'] ."]['name'] = '". str_replace("'","\\'",$et['name']) ."';\n");
      echo("\tetypes[". $et['id'] ."]['icon'] = '". $et['icon'] ."';\n");
      echo("\tetypes[". $et['id'] ."]['background'] = '". $et['background'] ."';\n");
      echo("\tetypes[". $et['id'] ."]['border'] = '". $et['border'] ."';\n");
      echo("\tetypes[". $et['id'] ."]['timecolor'] = '". $et['timecolor'] ."';\n");
      echo("\tetypes[". $et['id'] ."]['titlecolor'] = '". $et['titlecolor'] ."';\n");
      echo("\tetypes[". $et['id'] ."]['fontweight'] = '". $et['fontweight'] ."';\n");
      echo("\tetypes[". $et['id'] ."]['fontstyle'] = '". $et['fontstyle'] ."';\n");
      echo("\tetypes[". $et['id'] ."]['textdecoration'] = '". $et['textdecoration'] ."';\n");

      echo("\n\n");

   }

   reset($etypes);

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


   $csss = $_cal_obj->get_category_css();

   include_once(_CAL_BASE_PATH_."include/images.php");

foreach($csss as $css)
{

   $k = $css['id'];

   echo("<tr class='"._CAL_CSS_CAL_CONTENT_."' valign='middle'>");

      echo("<td nowrap align='left' style='border-left: 1px solid; border-bottom: 1px solid; padding: 2px;'
            class='"._CAL_CSS_CAL_EVENT_." cal_event_type_". $k ."_". $_cal_obj->id ."'>\n");

        $class = _CAL_CSS_CAL_EVENT_ ." cal_event_type_". $k ."_". $_cal_obj->id;

           if(($_cal_icon = $_cal_obj->cat_icons[$k])) {

              echo(_ex_img_str(_CAL_BASE_URL_.$_cal_icon, _ICON_, 16, 16) ." ");

           }

           echo("10"._PM_." <a class='{$class}' href='javascript:updateEtype({$css['id']})'>{$css['name']}</a>");


   echo("</td>\n</tr>\n");
}

   echo("<tr class='"._CAL_CSS_CAL_CONTENT_."' valign='middle'>");

      echo("<td nowrap align='center' style='border-left: 1px solid; border-bottom: 1px solid; padding: 2px;'>");

        echo("<a href='javascript:updateEtype(0)' class='"._CAL_CSS_ULINE_."'>"._NEW_."</a>");


   echo("</td>\n</tr>\n");

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



   $_cal_tmpl->section_row(_EVENT_TYPES_, $legend);

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_TITLE_, "<input type=text maxlength=28 name='ename'>");
   $_cal_tmpl->section_row(_ICON_, "<img src='"._CAL_BASE_URL_."images/spacer.png' height='16' width='16' alt='icon' name='icon'> ".
	$_cal_form->hidden("icon") ."
        [<a class='"._CAL_CSS_ROW_HEADER_."'
        href='javascript:newWin(\""._CAL_BASE_URL_."image_browser.php?image=icon"._CAL_AMP_."form=". $_cal_form->name ."\")'>".
        _BROWSE_ ."</a>]
        [<a class='"._CAL_CSS_ROW_HEADER_."'
        href='javascript:noIcon(\"icon\")'>". _NONE_ ."</a>]\n");


   $_cal_tmpl->section_spacer();


   #####################
   #
   ## COLOR
   #
   ####################


   $_cal_tmpl->section_row("", "<b>". _COLOR_ ."</b>");

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
        $_cal_form->submit('etype_action', _UPDATE_) ." ".
        $_cal_form->submit('etype_action', _ADD_) ." ".
        $_cal_form->submit('etype_action', _DELETE_),

        $_cal_form->submit("cals_action", _CLOSE_).$_cal_form->print_hidden('event_types','')
    );

   $_cal_tmpl->end_row();




ob_start();   
?>
function updateEtype(et_selected)
{

    var frm = document.forms['<?php echo($_cal_form->name) ?>'];

    frm.elements['ename'].value = etypes[et_selected]['name'];

      if(etypes[et_selected]['icon'].length > 0) {
         document.images['icon'].src = etypes[et_selected]['icon'];
         frm.elements['icon'].value = etypes[et_selected]['icon'];
      } else {
         noIcon('icon');
      }

   frm.elements['background_color'].value = etypes[et_selected]['background'];
   frm.elements['border_color'].value = etypes[et_selected]['border'];
   frm.elements['font_color'].value = etypes[et_selected]['timecolor'];
   frm.elements['title_font_color'].value = etypes[et_selected]['titlecolor'];

   updateBgColor("background_color","background_color_prev"); 
   updateBorder('border_color','border_color_prev');
   updateFgColor('font_color','font_color_prev');
   updateFgColor('title_font_color','title_font_color_prev');


   frm.elements['weight'].checked = (etypes[et_selected]['fontweight'].length > 0);
   frm.elements['italics'].checked = (etypes[et_selected]['fontstyle'].length > 0);
   frm.elements['uline'].checked = (etypes[et_selected]['textdecoration'].length > 0);

   checkBold('weight', 'title_font_color_prev');
   checkItalics('italics', 'title_font_color_prev');
   checkUline('uline', 'title_font_color_prev');

   document.getElementById('title_font_color_prev').innerHTML = et_selected ? etypes[et_selected]['name'] : '<?php echo(str_replace("'","\\'",_SAMPLE_)) ?>';

   frm.elements['event_types'].value = et_selected;

}


function noIcon(imgName)
{

   document.images[imgName].src = '<?php echo(_CAL_BASE_URL_) ?>images/spacer.png';
   document.<?php echo($_cal_form->name) ?>.elements[imgName].value = "";
}

<?php
  $js = ob_get_contents();
  ob_end_clean();

  $_cal_html->js_onload[] = $js;

  $_cal_tmpl->end_section();
?>
