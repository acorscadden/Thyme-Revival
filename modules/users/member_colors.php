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
// $Id: member_colors.php,v 1.11 2006/03/13 00:28:33 ian Exp $
//


global $_cal_form;

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

$_cal_form = new _cal_form();
$_cal_tmpl  = new _cal_template();

require(@constant("_CAL_BASE_PATH_") ."modules/common_files/css_edit.php");

$_cal_form->print_header();

$_cal_form->print_hidden("module");

$_cal_form->print_hidden("uid");

$_cal_tmpl->print_header();

   #####################
   #
   ## COLOR
   #
   ####################


list($colors) = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}EventTypes
    where id = ". $_cal_sql->escape_string($_REQUEST['uid']) ." and calendar = 0");


$_REQUEST['background_color'] = $colors['background'];
$_REQUEST['border_color'] = $colors['border'];
$_REQUEST['font_color'] = $colors['timecolor'];
$_REQUEST['title_font_color'] = $colors['titlecolor'];

$_cal_form->defaults['weight'] = ($colors['fontweight'] ? "checked" : "");
$_cal_form->defaults['italics'] = ($colors['fontstyle'] ? "checked" : "");
$_cal_form->defaults['uline'] = ($colors['textdecoration'] ? "checked" : "");


$_cal_tmpl->new_section(_COLORS_ ." - ". $_REQUEST['name']);

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

   $_cal_tmpl->end_section();

   $_cal_tmpl->toolbar(
        $_cal_form->submit('colors_action', _SAVE_) ." ".
        $_cal_form->submit('colors_action', _CANCEL_));

$_cal_tmpl->print_footer();
$_cal_form->print_footer();
?>
