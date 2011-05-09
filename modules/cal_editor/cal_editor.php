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
// $Id: cal_editor.php,v 1.50 2007/03/22 21:14:14 ian Exp ian $
//

global $_cal_user, $_cal_weekdays, $_cal_months, $_cal_dbpref, $_cal_html,$_cal_sql,$_cal_form;


   define("_CAL_DOING_OPTS_", 1);
   define("_CAL_DOING_PUBLISHER_", 1);


   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template_tabbed.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");


   $_cal_sql or $_cal_sql = new _cal_sql();


   # GET ALL CALENDARS/VIEWS THE GUEST ACCOUNT HAS ACCESS TO
   ######################################################
   $duser = new _cal_user("","",0);

   # set default calendar
   $cals = $duser->access->get_cals_sel(0);

   unset($duser);

   $_cal_editor_settings = $_cal_sql->query("select variable, setting from
        {$_cal_dbpref}ModuleSettings where module = 'cal_editor'", true);  

   # set the defaults for the request
   ###################################
   if($_REQUEST['caledit_action'] != _UPDATE_) {

      if(count($_cal_editor_settings)) {

         foreach($_cal_editor_settings as $k => $v) {
            if(isset($_REQUEST[$k])) continue;
            $_REQUEST[$k] = $_cal_editor_settings[$k];
         }

      } else {

         $_REQUEST["v"] = "m";
         $_REQUEST['current_date'] = 1;
         $_REQUEST['static'] = 1;
         $_REQUEST['event_links'] = 0;
         $_REQUEST['show_events'] = 1;
         $_REQUEST['show_header'] = 1;
         $_REQUEST['header_text'] = "Events in %month";
         $_REQUEST['header_align'] = "m";
         $_REQUEST['show_hide'] = 16380;
         $_REQUEST['apply_css_from'] = 1;
         $_REQUEST['font_size'] = 12;
         $_REQUEST['header_font_size'] = 12;
         $_REQUEST['row_header_font_size'] = 12;
         $_REQUEST['hour_format'] = 12;
         list($_REQUEST['ecalendar']) = array_keys($cals);

         $vars = get_object_vars($_cal_user->options);

         while(list($key, $val) = each($vars)) {

            if($key == 'admin' || $key == 'user' || $key == 'pass')
               continue;

            $_REQUEST[$key] = $val;
         }

         $_REQUEST['theme'] = "default";
      }

   } else {

      $_REQUEST['e_popup'] = intval($_REQUEST['e_popup']);
      $_REQUEST['e_n_popup'] = intval($_REQUEST['e_n_popup']);

      # POPULATE MODULE SETTINGS
      foreach($_POST as $k => $v) {
         if(isset($_cal_editor_settings[$k])) {
            $_cal_sql->query("update {$_cal_dbpref}ModuleSettings
                set setting = '". $_cal_sql->escape_string($v) ."'
                where variable = '". $_cal_sql->escape_string($k) ."'
                and module = 'cal_editor'");
         } else {

            $_cal_sql->query("insert into {$_cal_dbpref}ModuleSettings
            (setting,variable,module) values ('". $_cal_sql->escape_string($v) ."','".
            $_cal_sql->escape_string($k) ."','cal_editor')");
            

         }
      }

   }



   if($_REQUEST['show_header_links'] == 0) {
      unset($_REQUEST['show_footer']);
   }


   if(is_array($_REQUEST['event_types'])) {
      foreach($_REQUEST['event_types'] as $et) {
         $seltypes += $et;
      }
   }


   # get language file again ...
   require(@constant("_CAL_BASE_PATH_") . "include/languages/". _CAL_LANG_ .".php");

   if(!$_cal_user->admin) {
         $_cal_html->permission_denied(false); # fixed
         return;
   }


   $_cal_form = new _cal_form("frmCalEditor");

   require_once(@constant("_CAL_BASE_PATH_") . "modules/common_files/css_edit.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js");


   $views = array("d" => _DAY_, "w" => _WEEK_, "m" => _MONTH_,
	"mm" => _MINI_MONTH_);

   $view = $_REQUEST["v"];

   
   # $_cal_html->print_header("Calendar Editor");
   $_cal_form->print_header();
   echo($_cal_form->fromRequest("module"));

   ## TIME INTERVALS
   #####################
   $timeinterval_options = array(4 => "15 ". _MINUTES_, 2 => "30 ". _MINUTES_,
        1 => "1 ". _HOUR_);

   # DEFAULT VARS..
   #############################

   if($_REQUEST['current_date']) {
      $_REQUEST['caldate_yr'] = gmdate("Y", _ex_localtime());
      $_REQUEST['caldate_mo'] = gmdate("n", _ex_localtime());
      $_REQUEST['caldate_da'] = gmdate("j", _ex_localtime());
   }


   while(list($key, $val) = each($_REQUEST)) {
      $_cal_form->defaults[$key] = $val;
   }

   if(strpos($_cal_form->defaults["timezone"], '.') === false)
      $_cal_form->defaults["timezone"] .= ".0";


   $_cal_form->defaults["v"] = $_REQUEST["v"];

   ################################
   # DATE..
   ################################

   if(!$_cal_form->defaults['caldate_yr']) {
      $_cal_form->defaults['caldate_yr'] = _ex_date("Y");
      $_cal_form->defaults['caldate_mo'] = _ex_date("n");
      $_cal_form->defaults['caldate_da'] = _ex_date("j");
   }



   $_cal_html->print_heading(_CALENDAR_PUBLISHER_);

$guser = new _cal_user("","",0);
if(!$guser->login()) {

   echo("Public Access to Thyme is disabled. In order to use this module
    you must <a href='"._CAL_BASE_URL_._CAL_PAGE_MAIN_."?module=users&cal_sort=2'
    class='hil uline' target=_blank>enable public access</a> in Admin -&gt; Users -&gt; Public Access.");

   return;

}


  $_cal_tmpl = new _cal_template();
  $_cal_tmpl->row_header_width = 200;
  $_cal_tmpl->print_header("cal_editor");

  if($_REQUEST['caledit_action'] == _UPDATE_)
     $_cal_tmpl->default_tab = 8;

  $_cal_tmpl->toolbar($_cal_form->submit('caledit_action', _UPDATE_)); 
   
   #############################
   # VIEW OPTIONS
   ##############################

   $_cal_tmpl->new_section(_GENERAL_, true);

   $_cal_tmpl->section_row(_CALENDAR_, $_cal_form->select("ecalendar", $cals));

   $_cal_tmpl->section_row(_VIEW_ , $_cal_form->select("v", $views));


   $_cal_tmpl->section_row(_DATE_ , $_cal_form->dateselect("caldate"));

   $_cal_tmpl->section_row("", $_cal_form->checkbox('current_date') .
	" ". _SET_DATE_CURRENT_);

   $_cal_tmpl->section_row(_WEEK_START_, $_cal_form->select('week_start', $_cal_weekdays));

   $_cal_tmpl->section_row(_HOUR_FORMAT_, $_cal_form->select('hour_format',
        array("12" => _HOUR_FORMAT_12_, "24" => _HOUR_FORMAT_24_)));


   $_cal_tmpl->section_spacer();



   $_cal_tmpl->section_row(_STATIC_, $_cal_form->checkbox('static') . " ".
	_STATIC_DESC_);

   $_cal_tmpl->section_row(_HIL_DAY_, $_cal_form->checkbox('hil_day'));

   $_cal_tmpl->section_row(_HIL_WEEK_, $_cal_form->checkbox('hil_week'));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_WIDTH_, $_cal_form->textbox("cal_width", 4));

   $_cal_tmpl->end_section();


   ############################
   # CSS EDITOR
   ############################

   # number of preview elements
   $GLOBALS['gids'] = 7;

   $_cal_tmpl->new_section(_CSS_EDITOR_, true);

   #####################
   $dh = dir(@constant("_CAL_BASE_PATH_") ."/themes");
   while (false !== ($entry = $dh->read())) {
      if($entry == '.' || $entry == '..') {
         continue;
      }
      $theme_options[$entry] = $entry;
   }
   $dh->close();

   $_cal_tmpl->new_row();
   echo("<table width='100%' cellpadding=4 style='border-collapse: collapse;'>");

   $_cal_tmpl->section_row(_THEME_, $_cal_form->select('theme', $theme_options));
   $_cal_tmpl->section_row(_APPLY_CSS_FROM_, $_cal_form->select('apply_css_from',
    array(_NO_CSS_, _THEME_, _CSS_EDITOR_), "onChange='show_css_editor(this)'"));
  
   echo("</table>\n");
   $_cal_tmpl->end_row();

   $_cal_tmpl->new_row();
   
   echo("<div id='cssedit' style='display: none'>\n");
   echo("<table width='100%'><tr><td>\n");

      $_cal_tmpl->new_section(_CSS_EDITOR_ ." :: ". _GENERAL_, true, true);

      $_cal_tmpl->section_row(_PREVIEW_ , "<table border=0 cellpadding=0 cellspacing=0 width='200'
	    id='global_ids_0'><tr>\n<td align=center height='50'> ". _SAMPLE_ ."</td></tr>\n</table>");

      $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('table_bgcolor', 'globals'));

      $_cal_tmpl->section_row(_FONT_COLOR_, color_picker('font_color','globals',true));

      $_cal_tmpl->section_row(_FONT_FAMILY_, $_cal_form->textbox('font_family', 15, 
	      " onBlur='update_globals_font_family(this.value)' ") .  " " . _FONT_FAMILY_DESC_);

      $_cal_html->js_onload[] = 'update_globals_font_family(document.forms["'.
	       $_cal_form->name .'"].elements["font_family"].value)';

      $_cal_tmpl->section_row(_FONT_SIZE_, font_size_picker('font_size', 'globals'));
 
      $_cal_tmpl->section_row(_UNDERLINE_LINKS_, $_cal_form->select('underline_links',
	      array(_NEVER_, _ALWAYS_, _HOVER_)));	

      $_cal_tmpl->end_section();


   # CSS Editor Header
   ###################

   $_cal_tmpl->new_section(_CSS_EDITOR_ ." :: ". _HEADER_, true, true);


   # prev
   ##########
   if($_REQUEST['show_header_links']) {
   if($_REQUEST['txt_prev']) {

      if($_REQUEST['prev_img_url'])
         $txt_prev = "<img src='". $_REQUEST['txt_prev'] ."' border=0 alt='". _PREV_ ."'>";
      else
         $txt_prev = @htmlspecialchars($_REQUEST['txt_prev'], ENT_QUOTES, _CHARSET_);

   } else if ($_REQUEST['v'] == "mm") {

        $url = new _cal_url("themes/". $_REQUEST['theme'] ."/images/prev_sm.gif");
        $txt_prev = "<img src='". $url->toString() ."' border=0 alt='". _PREV_ ."'>";

   } else {

       $url = new _cal_url("themes/". $_REQUEST['theme'] ."/images/prev.gif");
        $txt_prev = "<img src='". $url->toString() ."' border=0 alt='". _PREV_ ."'>";
   }


   # next
   #########
   if($_REQUEST['txt_next']) {

      if($_REQUEST['next_img_url'])
         $txt_next = "<img src='". $_REQUEST['txt_next'] ."' border=0 alt='". _NEXT_ ."'>";
      else
         $txt_next = @htmlspecialchars($_REQUEST['txt_next'], ENT_QUOTES, _CHARSET_);

   } else if ($_REQUEST['v'] == "mm") {

        $url = new _cal_url("themes/". $_REQUEST['theme'] ."/images/next_sm.gif");
        $txt_next = "<img src='". $url->toString() ."' border=0 alt='". _NEXT_ ."'>";

   } else {

        $url = new _cal_url("themes/". $_REQUEST['theme'] ."/images/next.gif");
        $txt_next = "<img src='". $url->toString() ."' border=0 alt='". _NEXT_ ."'>";
   }

   } # / if show_header_links


   if($_REQUEST['header_align'] == 'm')
   {
     $h_prev = "<span id='header_link_prev' style='width: 100%'>". $txt_prev .
        " <span id='header_preview'>".
        _SAMPLE_ ."</span> ". $txt_next ."</span>";

     $h_prev_align = 'center';


   } elseif($_REQUEST['header_align'] == 'l') {

     $h_prev = "<span id='header_link_prev' style='width: 100%'>". $txt_prev .
        " ". $txt_next ." ".
        " <span id='header_preview'>".
        _SAMPLE_ ."</span></span>";

     $h_prev_align = 'left';

   } elseif($_REQUEST['header_align'] == 'r') {

     $h_prev = "<span id='header_link_prev' style='width: 100%'>".
        " <span id='header_preview'>".
        _SAMPLE_ ."</span> ". $txt_prev ." ". $txt_next ."</span>";

     $h_prev_align='right';

   }


   $_cal_tmpl->section_row(_PREVIEW_, "<table id='global_ids_1' border=0
    cellpadding=0 cellspacing=0 width=300>
    <tr><td align=". $h_prev_align .">". $h_prev ."</td></tr>\n</table>\n");

   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('header_color', 'header_link_prev'));

   $_cal_tmpl->section_row(_FONT_COLOR_, color_picker('header_font_color', 'header_preview', true));

   $_cal_tmpl->section_row(_FONT_SIZE_, font_size_picker('header_font_size',
	'header_preview'));

   $_cal_tmpl->section_row(_FONT_STYLE_, font_weight_picker('header_bold','header_preview').
	"<br>" . font_italics_picker('header_italics', 'header_preview').
	"<br>". font_uline_picker('header_uline', 'header_preview'));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_HEADER_LINKS_);

   $_cal_tmpl->section_row(_FONT_COLOR_, color_picker('header_link_color', 'header_link_prev', true));

   $_cal_tmpl->section_row(_FONT_SIZE_, font_size_picker('header_link_size', 'header_link_prev'));

   $_cal_tmpl->section_row(_FONT_STYLE_, font_weight_picker('header_link_bold','header_link_prev').
    "<br>" . font_italics_picker('header_link_italics', 'header_link_prev').
    "<br>". font_uline_picker('header_link_uline', 'header_link_prev'));



   $_cal_tmpl->end_section();


   # CSS weekday names
   ####################

   $_cal_tmpl->new_section( _CSS_EDITOR_ ." :: ". _WEEKDAY_HEADER_, true, true);

   $_cal_tmpl->section_row(_PREVIEW_, "<table id='global_ids_2' cellpadding=0 cellspacing=0
	width=100>
	<tr><td align='center' id='weekday_header_preview'> ". $GLOBALS['_cal_weekdays'][0] ." </td> </tr>\n</table>");

   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('row_header_color',
	'weekday_header_preview'));

   $_cal_tmpl->section_row(_FONT_COLOR_, color_picker('row_header_font_color',
	'weekday_header_preview', true));

   $_cal_tmpl->section_row(_FONT_SIZE_, font_size_picker('row_header_font_size',
	'weekday_header_preview'));

   $_cal_tmpl->section_row(_FONT_STYLE_,
	font_weight_picker('row_header_bold','weekday_header_preview').
        "<br>" . font_italics_picker('row_header_italics', 'weekday_header_preview').
        "<br>". font_uline_picker('row_header_uline', 'weekday_header_preview'));


   $_cal_tmpl->end_section();

   # CSS Editor Days
   ####################

   $_cal_tmpl->new_section(_CSS_EDITOR_ ." :: ". _DAYS_, true, true);

   $_cal_tmpl->section_row("", "<table border=0 cellpadding=0 cellspacing=0
	width=100 id='global_ids_3'><tr><td height=40 align=center id='days_prev'> ".
	_NORMAL_DAYS_ ."
	</td>\n</tr>\n</table>");

   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('content_color', 'days_prev'));

   $_cal_tmpl->section_row(_FONT_COLOR_, color_picker('content_font_color', 'days_prev', true));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row("","<table border=0 cellpadding=0 cellspacing=0
	width=100 id='global_ids_4'><tr><td height=40 align=center id='days_not_prev'>
	". _DAYS_NOT_IN_MONTH_ ." </td>\n</tr>\n</table>");

   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('disabled_content_color',
	'days_not_prev'));

   $_cal_tmpl->section_row(_FONT_COLOR_, color_picker('disabled_content_font_color',
	'days_not_prev', true));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row("", "<table border=0 cellpadding=0 cellspacing=0
	width=100 id='global_ids_5'><tr><td height=40 align=center id='days_hil_prev'>
	". _HIGHLIGHTED_DAYS_ ." </td></tr></table>");

   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('selected_content_color',
	'days_hil_prev'));

   $_cal_tmpl->section_row(_FONT_COLOR_, color_picker('selected_content_font_color',
	'days_hil_prev', true));


   $_cal_tmpl->end_section();


   # CSS Events
   #############

   $_cal_tmpl->new_section(_CSS_EDITOR_ ." :: ". _EVENTS_ , true, true);

   # normal

   $_cal_tmpl->section_row("", "<br>". _NORMAL_EVENTS_ ."<br><br>");

   $_cal_tmpl->section_row(_PREVIEW_,
	"<table  border=0 cellpadding=4 style='border-collapse: collapse' 
		width=110 id='global_ids_6'>
	  <tr>
	    <td class='"._CAL_CSS_SPACER_SMALL_."' id='event_prev_border1'> </td>
	    <td id='event_prev'>
		<span id='event_prev_time'>10". _PM_ ."</span>
		<span id='event_prev_title'>". _SAMPLE_ ."</span>
            </td>
          </tr>
          <tr class='"._CAL_CSS_SPACER_SMALL_."'>
	     <td class='"._CAL_CSS_SPACER_SMALL_."' id='event_prev_border2' colspan=2> </td>
          </tr>
          </table>\n");

   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('cal_event_color', 'event_prev'));

   $_cal_tmpl->section_row(_BORDER_COLOR_, border_color_picker('cal_event_border_color',
	'event_prev'));

   $_cal_tmpl->section_row(_TIME_FONT_COLOR_, color_picker('cal_event_font_color',
	'event_prev_time', true));

   $_cal_tmpl->section_row(_TITLE_FONT_COLOR_, color_picker('cal_event_title_font_color',
	'event_prev_title', true));

   $_cal_tmpl->section_spacer();


   # flagged

   $_cal_tmpl->section_row("", "<br>". _FLAGGED_EVENTS_ ."<br><br>");

   $_cal_tmpl->section_row(_PREVIEW_,
        "<table  border=0 cellpadding=4 style='border-collapse: collapse'
		width=110 id='global_ids_7'>
          <tr>
            <td class='"._CAL_CSS_SPACER_SMALL_."' id='flag_event_prev_border1'> </td>
            <td id='flag_event_prev'>
                <span id='flag_event_prev_time'>10". _PM_ ."</span>
                <span id='flag_event_prev_title'>". _SAMPLE_ ."</span>
            </td>
          </tr>
          <tr class='"._CAL_CSS_SPACER_SMALL_."'>
             <td class='"._CAL_CSS_SPACER_SMALL_."' id='flag_event_prev_border2' colspan=2> </td>
          </tr>
          </table>\n");


   $_cal_tmpl->section_row(_BACKGROUND_COLOR_, color_picker('flag_event_color',
	'flag_event_prev'));

   $_cal_tmpl->section_row(_BORDER_COLOR_, border_color_picker('flag_event_border_color',
	'flag_event_prev'));

   $_cal_tmpl->section_row(_TIME_FONT_COLOR_, color_picker('flag_event_font_color',
	'flag_event_prev_time', true));

   $_cal_tmpl->section_row(_TITLE_FONT_COLOR_, color_picker('flag_event_title_font_color',
	'flag_event_prev_title', true));

   $_cal_tmpl->section_row(_TITLE_FONT_STYLE_, font_weight_picker('flag_event_title_font_weight',
	'flag_event_prev_title') .
	"<br>" . font_italics_picker('flag_event_title_font_italics', 'flag_event_prev_title').
	"<BR>" . font_uline_picker('flag_event_title_font_uline', 'flag_event_prev_title'));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->end_section();

   echo("</td</tr></table></div>\n");

   $_cal_tmpl->end_row();   

   $_cal_tmpl->end_section();

  
   ############################
   # EVENTS 
   ############################


   $_cal_tmpl->new_section(_EVENTS_, true);
   $_cal_tmpl->row_header_width = 200;


   $_cal_tmpl->section_row(_SHOW_EVENTS_, $_cal_form->checkbox('show_events'));


   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

   $_et_cal = new _cal_obj(intval($_REQUEST['ecalendar']));

   $etypes = $_et_cal->get_categories();
   
   if(count($etypes)) {

      $_cal_tmpl->section_row(_EVENT_TYPES_, $_cal_form->mselect('event_types[]', $etypes, 10));

      $_cal_tmpl->section_row("", "<font size=1><i>". _EVENT_TYPES_DESC_ .
        (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "windows") ? _MULTI_SELECT_WIN_ : "") ."</i></font>");

   }

   $_cal_tmpl->section_spacer();


   $_cal_tmpl->section_row(_EVNT_NOTES_POPUP_, $_cal_form->checkbox("e_n_popup") ." ".
        _EVNT_NOTES_POPUP_DESC_);

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_EVENT_LINKS_, $_cal_form->checkbox('event_links'));

   $_cal_tmpl->section_row(_EVNT_TYPE_NAME_, $_cal_form->checkbox("e_typename"));

   $_cal_tmpl->section_row(_EVNT_POPUP_, $_cal_form->checkbox("e_popup") ." ".
        _EVNT_POPUP_DESC_);

   $_cal_tmpl->section_row(_EVENT_LINK_URL_, "<input type=text name='event_view_url'
	size=45 value='". @htmlspecialchars($_REQUEST['event_view_url'], ENT_QUOTES, _CHARSET_) ."'>");

   $_cal_tmpl->section_row("", "<font size=1>". str_replace('&','&amp;',_EVENT_LINK_URL_DESC_) ."</font>");


   $_cal_tmpl->end_section();


   ############################
   #
   ### TIEMZONE
   #
   ############################

   $_cal_tmpl->new_section(_TIMEZONE_, true);

   require_once(@constant("_CAL_BASE_PATH_"). "modules/options/locale.php");
 
   $_cal_tmpl->end_section();


   ########################
   # HEADER OPTIONS
   #########################

   $_cal_tmpl->new_section(_HEADER_, true);


   $_cal_tmpl->section_spacer();


   $_cal_tmpl->section_row(_SHOW_HEADER_, $_cal_form->checkbox('show_header'));

   $_cal_tmpl->section_row(_ALIGN_HEADER_TEXT_, $_cal_form->select("header_align", 
	array("m" => _CENTER_, "l" => _LEFT_, "r" => _RIGHT_)));
	

   $_cal_tmpl->section_row(_HEADER_TEXT_, "<input type=text name='header_text' size=40
        value=\"". @htmlspecialchars($_REQUEST['header_text'], ENT_QUOTES, _CHARSET_) ."\">");

   $_cal_tmpl->section_row("", _HEADER_TEXT_DESC_);


   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_SHOW_HEADER_LINKS_, $_cal_form->checkbox("show_header_links"));

   $_cal_tmpl->section_row(_PREV_LINK_, $_cal_form->textbox('txt_prev',50)." ".
        $_cal_form->checkbox("prev_img_url") . " " ._IMG_URL_);

   $_cal_tmpl->section_row(_NEXT_LINK_, $_cal_form->textbox('txt_next',50) ." ".
        $_cal_form->checkbox("next_img_url") ." ". _IMG_URL_);


   $_cal_tmpl->section_row("",_IMG_URL_DESC_);

   $_cal_tmpl->end_section();


   #########################
   # DAY VIEW
   #########################

   $_cal_tmpl->new_section(_DAY_VIEW_, true);

   $_cal_tmpl->section_row(_TIME_INTERVALS_ ,
        $_cal_form->select('time_interval',$timeinterval_options));

   $_cal_tmpl->section_row(_WORK_HOURS_, "
         <table border=0 cellspacing=0 cellpadding=2>
         <tr class='"._CAL_CSS_ROW_HEADER_."'>
            <td align='right'> ". _WORK_HOURS_START_ ."</td>
            <td align='left'> ". $_cal_form->hourselect('workday_start') ."</td>
         </tr>
         <tr class='"._CAL_CSS_ROW_HEADER_."'>
            <td align='right'>". _WORK_HOURS_END_ ."</td>
            <td align='left'>". $_cal_form->hourselect('workday_end') ."</td>
         </tr>
         </table>
         ");


   $_cal_tmpl->end_section();



   ##########################
   # MONTH VIEW
   ##########################

   $_cal_tmpl->new_section(_MONTH_VIEWS_, true);

   $_cal_tmpl->section_row(_SHOW_WEEKS_, $_cal_form->checkbox('show_weeks') ." <i>"._SHOW_WEEKS_DESC_."</i>");

   $_cal_tmpl->section_row(_ROW_HEIGHT_,"<input type=text name='row_height' size=3 maxlength=3
        value='". $_REQUEST['row_height'] ."'> <i>"._ROW_HEIGHT_DESC_ ."</i>");

   $_cal_tmpl->section_row(_LIMIT_WEEKDAY_NAMES_, "<input type=text name='abbr_weekdays'
	size=2 maxlength=2 value='". $_REQUEST['abbr_weekdays'] ."'> ". _CHARS_);

   $_cal_tmpl->section_row(_EXCLUDE_MONTH_DAYS_, $_cal_form->checkbox("exclude_outside"));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_EVNT_SIZE_, $_cal_form->select("e_size", array(_NORMAL_,_SMALLER_,_SMALLEST_)));
   $_cal_tmpl->section_row(_EVNT_COLLAPSE_, $_cal_form->checkbox("e_collapse") ." ". _EVNT_COLLAPSE_DESC_);

   $_cal_tmpl->section_spacer();


   $_cal_tmpl->section_row(_MINI_MONTH_DATE_URL_, "<input type=text size=40
	name='minical_date_url' value='". @htmlspecialchars($_REQUEST['minical_date_url'], ENT_QUOTES, _CHARSET_) .
	"'>");

   $_cal_tmpl->section_row("", "<font size=1>". str_replace('&','&amp;',_MINI_MONTH_DATE_URL_DESC_) ."</font>");

   $_cal_tmpl->end_section();


   ############################
   # GENERATED CODE
   ############################

   $codestr = "<?php\n";


   $codestr .= '

############################################################

# '. _BASE_PATH_DESC_ .'
define("_CAL_BASE_PATH_", "'. str_replace("\\","\\\\",_CAL_BASE_PATH_) .'");

require_once(_CAL_BASE_PATH_ . "include/classes/class.calendar.php");

############################################################


';

   if($_REQUEST['current_date']) {
      $codestr .= '$cal = new calendar();';
   } else {
      $codestr .= '$cal = new calendar('. $_REQUEST['caldate_yr'] .','. $_REQUEST['caldate_mo'].
        ','.$_REQUEST['caldate_da'].');';
   }

   $codestr .= '

# '. _GENERAL_ .'
#############
';


   # general
   #############

   $codestr .= "\$cal->set(\"calendar\", ". intval($_REQUEST['ecalendar']) ."); # ". $cals[$_REQUEST['ecalendar']] ."\n";

   $codestr .= "\$cal->set(\"week_start\", ". intval($_REQUEST['week_start']) .");\n";
   $codestr .= "\$cal->set(\"hour_format\", ". intval($_REQUEST['hour_format']) .");\n";

   $codestr .= "\$cal->set(\"static\", ". intval($_REQUEST['static']) .");\n";

   $codestr .= "\$cal->set(\"hil_day\", ". intval($_REQUEST['hil_day']) .");\n";

   $codestr .= "\$cal->set(\"hil_week\", ". intval($_REQUEST['hil_week']) .");\n";

   $codestr .= "\$cal->set(\"theme\", \"". $_REQUEST['theme'] ."\");\n";

   if($_REQUEST['cal_width'])
      $codestr .= "\$cal->set(\"width\", \"". $_REQUEST['cal_width'] ."\");\n";


   # events
   #############

   $codestr .="\n# ". _EVENTS_ ."\n####################\n";

   $codestr .= "\$cal->set(\"event_links\", ". intval($_REQUEST['event_links']) .");\n";
   $codestr .= "\$cal->set(\"e_typename\", ". intval($_REQUEST['e_typename']) .");\n";
   $codestr .= "\$cal->set(\"e_popup\", ". intval($_REQUEST['e_popup']) .");\n";
   $codestr .= "\$cal->set(\"e_n_popup\", ". intval($_REQUEST['e_n_popup']) .");\n";
   $codestr .= '$cal->set("e_size", '. intval($_REQUEST['e_size']) .");\n";

   if(strlen($_REQUEST['event_view_url']))
      $codestr .= "\$cal->set(\"event_view_url\", \"". $_REQUEST['event_view_url'] ."\");\n";

   $codestr .= "\$cal->set(\"show_events\", ". intval($_REQUEST['show_events']) .");\n";

   if($seltypes > 0)
      $codestr .= "\$cal->set(\"event_types\", ". $seltypes .");\n";

   # locale
   #########
   $codestr .= "\n# ". _TIMEZONE_ ."\n###################\n";
   $codestr .= '$cal->set("timezone", '. $_REQUEST['timezone'] .");\n";
   $codestr .= '$cal->set("dst", '. $_REQUEST['dst'] .");\n\n";
  
   # header
   #############

   $codestr .= "# ". _HEADER_ ."\n##############\n";

   $codestr .= '$cal->set("show_header", '. intval($_REQUEST['show_header']) . ");\n";
   $codestr .= '$cal->set("show_header_links", '. intval($_REQUEST['show_header_links']) . ");\n";
   $codestr .= '$cal->set("header_align", "'. $_REQUEST['header_align'] ."\");\n";
  
   if(strlen($_REQUEST['header_text'])) 
      $codestr .= '$cal->set("header", "'. str_replace('"','\"',$_REQUEST['header_text']) ."\");\n";
   

   if(strlen($_REQUEST['txt_next'])) {

      if($_REQUEST['next_img_url'])
         $codestr .= '$cal->set("img_next", "'. $_REQUEST['txt_next'] ."\");\n";
      else
         $codestr .= '$cal->set("txt_next", "'. @htmlspecialchars($_REQUEST['txt_next'], ENT_QUOTES, _CHARSET_) ."\");\n";
   }

   if(strlen($_REQUEST['txt_prev'])) {

      if($_REQUEST['prev_img_url'])
         $codestr .= '$cal->set("img_prev", "'. $_REQUEST['txt_prev'] ."\");\n";
      else
         $codestr .= '$cal->set("txt_prev", "'. @htmlspecialchars($_REQUEST['txt_prev'], ENT_QUOTES, _CHARSET_) ."\");\n";

   }


   # day view
   #############

   if($view == 'd') {
      $codestr .= "\n# ". _DAY_VIEW_ ."\n###############\n";
      $codestr .= '$cal->set("time_interval", '. intval($_REQUEST['time_interval']) .");\n";
      $codestr .= '$cal->set("workday_start_hr", '. intval($_REQUEST['workday_start_hr']) .");\n";
      $codestr .= '$cal->set("workday_end_hr", '. intval($_REQUEST['workday_end_hr']) .");\n";
   }

   # month view
   ##############

   if($view == 'm' || $view == 'mm') {

      $codestr .="\n# ". _MONTH_VIEWS_ ."\n###############\n";

      $codestr .= '$cal->set("show_weeks", '. intval($_REQUEST['show_weeks']) .");\n";

      if(intval($_REQUEST['row_height']) > 0)
         $codestr .= '$cal->set("row_height", '. intval($_REQUEST['row_height']) .");\n";

      if(intval($_REQUEST["exclude_outside"]))
         $codestr .= '$cal->set("exclude_outside", 1);' ."\n";

      if(intval($_REQUEST['abbr_weekdays']) > 0)
         $codestr .= '$cal->set("abbr_weekdays", '. intval($_REQUEST['abbr_weekdays']) .");\n";

      if(strlen($_REQUEST['minical_date_url']))
         $codestr .= '$cal->set("minical_date_url", "'. str_replace('"','\"',$_REQUEST['minical_date_url']) ."\");\n"; 

       $codestr .= '$cal->set("e_collapse", '. intval($_REQUEST['e_collapse']) .");\n";

   }

   switch($view)
   {
      case "y":
         $display_str = '$cal->display_year();';
         break;

      case "m":
         $display_str = '$cal->display_month();';
         break;

      case "d":
         $display_str = '$cal->display_day();';
         break;

      case "w":
         $display_str = '$cal->display_week();';
         break;

      case "mm":
         $display_str = '$cal->display_month_mini();';
         break;


   }



   #########################
   #
   # PREVIEW
   #
   #########################

   $_cal_tmpl->new_section(_PREVIEW_, true);

   $url = new _cal_url("modules/cal_editor/preview.php");
   $url->addArgs($_REQUEST);
   $url->addArg("preview", 1);
   $url->addArg("seltypes", $seltypes);

?>
   <tr><td colspan=2>
	<iframe src="<?php echo($url->toString()) ?>" name="main" width="100%" height="502"
	marginwidth=0 marginheight=0 frameborder="0"></iframe>
      
   </td></tr>
<?php

   $_cal_tmpl->end_section();


   ##########################
   # GENERATED CODE
   ##########################


   $_cal_tmpl->new_section(_GENERATED_CODE_, true);

   echo("<tr class='"._CAL_CSS_ROW_HEADER_."'>\n<td style='background: #fff' colspan=2>");

   ob_start();

      echo($codestr);
      echo("\n?>\n<!--\n<html>\n<head>\n-->\n");

      echo("<?php \$cal->apply_style(". ($_REQUEST['apply_css_from'] == 1 ? "\"{$_REQUEST['theme']}\"" : "") ."); ?>\n");

      if($_REQUEST['apply_css_from'] == 2) require(_CAL_BASE_PATH_ ."modules/cal_editor/gen_css.php");
      echo("<!--\n</head>\n<body>\n-->\n");
      echo("<?php\n\n");

      echo($display_str);
   
      echo("\n\n?>\n<!--\n</body>\n</html>\n-->\n");

   $csstr = ob_get_contents();
   ob_end_clean();

   highlight_string($csstr);

   echo("\n\n</td>\n</tr>\n");
   
   $_cal_tmpl->section_spacer();
   $_cal_tmpl->end_section();


$_cal_tmpl->print_footer();
$_cal_form->print_footer();

?>
<script language='javascript' type='text/javascript'>

function show_css_editor(sel)
{

   document.getElementById('cssedit').style.display = (sel.selectedIndex == 2 ? 'inline' : 'none');

}

show_css_editor(document.forms['<?php echo($_cal_form->name) ?>'].elements['apply_css_from']);

</script>

