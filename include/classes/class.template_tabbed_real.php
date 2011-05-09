<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 eXtrovert Software and Thymenews                  |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@thymenews.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: class.template_tabbed_real.php,v 1.27 2007/08/29 17:00:32 ian Exp $
//


list($ua,$ver) = @explode('AppleWebKit/', $_SERVER['HTTP_USER_AGENT']);

if($ua && $ver && intval(substr($ver, 0, 1)) < 5) {
   define("_SAFARI_HACK_", 1);
} else {
   define("_SAFARI_HACK_", 0);
}

class _cal_template
{


var $row_header_width = 250;
var $row_valign = 'top';

var $hidden_printed = false;

var $header_printed = false;

var $tabs = array();

var $section_tracker = array();

var $default_tab = 1;

######################

function _cal_template($name = "")
{

   if(!$GLOBALS['_cal_tmpl_section_id']) $GLOBALS['_cal_tmpl_section_id'] = 1;

   $this->name = $name;

  
}

function print_header_real($div = "", $subsection = false)
{

   global $_cal_form;

   require_once(@constant("_CAL_BASE_PATH_") . "include/js/show_hide.js");

   if($_cal_form) $_cal_form->print_hidden("show_hide");

   echo("<table width='100%'>
    <tr>
        <td ". ($subsection ? "" : "style='border-bottom: 1px; border-top: 0px; border-right: 0px;'") .">
        ". ($subsection ? "" : "<br><div id='template_tabs_place_holder' style='width: 100%;'></div>") ."
        \n");

    $this->header_printed = true;        


    $this->subsection = $subsection;

}

function print_header($div = "") { if($div) { $this->name = $div; } return; }

function print_footer() {

   echo("\n</td>\n</tr>\n");
   echo("\n</table>\n");

  if($this->subsection) return;

   echo("<div id='template_tabs' style='display: none'>");
   echo("<table style='padding: 0px; border-collapse: collapse;'>
    <tr>\n");

   for($i = 0; $i < count($this->tabs); $i++)
   {
      echo("<td nowrap class='"._CAL_CSS_CAL_DISABLED_."' ");

      if(!@constant("_SAFARI_HACK_"))
         echo(" id='template_tab_" . ($i + 1) ."' ");

      echo("
            style='padding: 5px; padding-left: 10px; padding-right: 10px;
            border-width: 1px;'><a
            href='javascript:t_show_tab(". ($i + 1) .")'>".$this->tabs[$i] ."</a>
        </td><td style='border-bottom-width: 1px;'> &nbsp; </td>");
   }

   echo("<td style='border-bottom-width: 1px; width: 100%'> &nbsp; </td>");
   echo("</tr>\n</table></div>");

   # place tabs

   if(@constant("_SAFARI_HACK_")) {

   echo("<script language='javascript' type='text/javascript'>
<!--
    t = document.getElementById('template_tabs');
    tp = document.getElementById('template_tabs_place_holder');

    // Safari
    if(tp && t) {
       tp.innerHTML = t.innerHTML;

       var tab_id = 1;

       for(var i = 0; i < tp.children.length; i++)
       {
          if(tp.children[i].tagName = 'TD' && tp.children[i].className) {
             tp.children[i].id = 'template_tab_' + (tab_id++);
          }
       }
    }

    t_show_tab(". $this->default_tab .");

//-->
   </script>\n");

   } else {

      echo("<script language='javascript' type='text/javascript'>
<!--
    t = document.getElementById('template_tabs');
    tp = document.getElementById('template_tabs_place_holder');


    if(tp && t) tp.innerHTML = t.innerHTML;

    t.innerHTML = '';

    t_show_tab(". $this->default_tab .");

//-->
      </script>\n");


   }

}


function new_row() { echo("\n\t<tr class='"._CAL_CSS_ROW_HEADER_."'>\n\t\t<td colspan=2>\n"); }

function end_row() { echo("\n\t\t</td>\n\t</tr>\n"); }

#########################

function section_row($heading = "", $text = "")
{

   if(strlen($heading)) { $heading .= ":"; }

   echo("
   <tr valign='". $this->row_valign ."' class='"._CAL_CSS_ROW_HEADER_."'>
      <td align=right width='". $this->row_header_width ."'><b>". $heading ."</b></td>
      <td align=left> ". $text ." </td>
   </tr>\n\n");



}


#########################

function section_row_indented($heading = "", $text = "")
{

   if(strlen($heading)) { $heading .= ":"; }

   echo("
   <tr valign='". $this->row_valign ."' class='"._CAL_CSS_ROW_HEADER_."'>
      <td align=right width='". $this->row_header_width ."'><b>". $heading ."</b></td>
      <td align=left> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ". $text ."
      </td>

   </tr>\n\n");



}



###################

function new_section($heading, $hideable = null, $subsection = false)
{

   if(!$this->header_printed) $this->print_header_real($this->name, $subsection);

   if($subsection) {

      echo("<table width='100%'>\n"); 
      $this->section_spacer();
       
      echo("\n\t<tr>\n\t\t<td colspan=2>");

      if($hideable) {
          $this->hideable_section = 1;
          $GLOBALS['_cal_tmpl_section_id'] *= 2;

        if($_REQUEST['show_hide'] & $GLOBALS['_cal_tmpl_section_id']) {

           $heading .= " <font size=1>[<a class='"._CAL_CSS_MAIN_HEADER_."' href='javascript:show_hide(".
              $GLOBALS['_cal_tmpl_section_id'] .");'><span id='show_hide_lbl". $GLOBALS['_cal_tmpl_section_id'] .
              "'>". _SHOW_ ."</span></a>]</font>";

           if(($_REQUEST['show_hide'] & $GLOBALS['_cal_tmpl_section_id']) > 0)
              $hidden_tag = " style='display: none;' ";

        } else {

          $heading .= " <font size=1>[<a class='"._CAL_CSS_MAIN_HEADER_."' href='javascript:show_hide(".
             $GLOBALS['_cal_tmpl_section_id'] .");'><span id='show_hide_lbl". $GLOBALS['_cal_tmpl_section_id'].
             "'>". _HIDE_ ."</span></a>]</font>";
        }

        $id = "show_hide". $GLOBALS['_cal_tmpl_section_id'];

      } else {
        $this->hideable_section = 0;
        srand();
        $id = 'section_' . $this->divid . rand(0,200);
      }


      $GLOBALS['_cal_html']->print_sub_heading($heading);
      echo("<div id='". $id ."' $hidden_tag>");
      echo("<table border=0 cellspacing=0 cellpadding=4 width='100%'>\n");

      $this->section_tracker[] = "subsection";
      return;
   }


   $this->section_tracker[] = "section";
 
   $this->tabs[] = $heading;

   echo("<div id='tab_content_". count($this->tabs)."' style='display: none;'>\n");
   echo("<table border=0 cellspacing=0 cellpadding=4 width='100%'
        style='border: 1px solid; border-top: 0px;'>\n");
   $this->new_row();
   echo("&nbsp;");
   $this->end_row();
 

}


#######################

function end_section()
{


   if(array_pop($this->section_tracker) == "subsection") {

      echo("\t\t</table>\n</div>");
      echo("\n\t\t</td>\n\t</tr>\n</table>");

   } else {
 
      
      echo("\n</table>\n");
      echo("<br>\n");
      echo("</div>");
   }

   #echo("</div>\n");

}


####################

function toolbar($l=null,$c=null,$r=null)
{


   if(!$this->header_printed)
      echo("<table width='100%'>\n<tr>\n<td>\n");
   else if(count($this->section_tracker) && $this->subsection)
      echo("<tr><td colspan=2>");

   echo("<table class='"._CAL_CSS_TOOLBAR_."' border=0 width='100%'>
	<tr valign='middle' class='"._CAL_CSS_TOOLBAR_."'>");


      if($l || ($c && $r)) {

         if($c) $width = 33;
         else if($r) $width = 50;
         else $width = 100;

         echo("\n\t\t<td align=left width='{$width}%' class='"._CAL_CSS_TOOLBAR_."'>\n");
         echo($l);
         echo("\n\t\t</td>\n");
      }

      if($c) {

         $width = (($l || $r) ? 33 : 100);

         echo("\n\t\t<td align=center width='{$width}%' class='"._CAL_CSS_TOOLBAR_."'>\n");
         echo($c);
         echo("\n\t\t</td>\n");
      }

      if($r || ($c && $l)) {

         if($c) $width = 33;
         else if($l) $width = 50;
         else $width = 100;

         echo("\n\t\t<td align=right width='{$width}%' class='"._CAL_CSS_TOOLBAR_."'>\n");
         echo($r);
         echo("\n\t\t</td>\n");

      }

   echo("\n\t</tr>\n</table>\n");

   if(!$this->header_printed)
      echo("\n</td>\n</tr>\n</table>\n");
   else if(count($this->section_tracker) && $this->subsection)
      echo("</td></tr>\n");

}

#################

function section_spacer()
{
   echo("\n\t<tr class='"._CAL_CSS_SPACER_TINY_."'>\n\t\t<td class='"._CAL_CSS_SPACER_TINY_."'
        colspan=2> </td></tr>\n\n");

}


}


?>
<script language='javascript' type='text/javascript'>

var template_last_tab = 0;

function t_show_tab(id)
{

   if(!document.getElementById('tab_content_' + id) || !document.getElementById('template_tab_' + id))
      return;

   document.getElementById('tab_content_' + id).style.display = 'inline';
   document.getElementById('template_tab_' + id).className = 'row_header';
   document.getElementById('template_tab_' + id).style.borderBottomWidth = '0px';
   
   if(template_last_tab && template_last_tab != id) {
      document.getElementById('tab_content_' + template_last_tab).style.display = 'none';
      document.getElementById('template_tab_' + template_last_tab).style.borderWidth = '1px';
      document.getElementById('template_tab_' + template_last_tab).style.borderBottomWidth = '1px';
      document.getElementById('template_tab_' + template_last_tab).className = 'cal_disabled';
   }

   template_last_tab = id;

}

</script>
