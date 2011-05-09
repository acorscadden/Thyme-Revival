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

   global $_cal_weekdays, $_cal_months, $_cal_user, $_cal_sql, $_cal_views, $_cal_form;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template_tabbed.php");

   define("_CAL_DOING_OPTS_", 1);
   require(@constant("_CAL_BASE_PATH_") . "include/languages/". constant("_CAL_LANG_") .".php");


   $_cal_sql or $_cal_sql = new _cal_sql();

   ##########################
   #
   ## GET OPTIONS
   #
   ##########################

   if(!$_cal_views)
      $_cal_views = array("d" => _DAY_, "w" =>_WEEK_, "m" => _MONTH_ , "y" => _YEAR_, "events" => _EVENTS_);

   ## THEMES
   #####################
   if(!@constant("_CAL_FORCE_THEME_"))  {
      $dh = dir(@constant("_CAL_BASE_PATH_") . "/themes");
      while (false !== ($entry = $dh->read())) {
         if($entry == '.' || $entry == '..') {
            continue;
         }
         $theme_options[$entry] = $entry; 
      }
      $dh->close();

      ksort($theme_options);
   }

   ## TIME INTERVALS
   #####################
   $timeinterval_options = array(4 => "15 ". _MINUTES_, 2 => "30 ". _MINUTES_,
	1 => "1 ". _HOUR_);


   # list of calendars we can view
   $cals = $_cal_user->access->get_cals(0);

   $_calendars = array();

   foreach ($cals as $c)
   {

      $_calendars[$c['id']] = $c['title'] ." - ". $c['description'];

   }

   natcasesort($_calendars);

   #######################
   #
   ## </ GET OPTIONS >
   #
   #########################

   $_cal_form = new _cal_form("OptionsForm");


   ###########################
   #
   ## SET DEFAULTS
   #
   ###########################

   if($_REQUEST['option_action'] == _EDIT_DEFAULT_OPTS_) {

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");

      if(!$_cal_user->admin) {
         $_cal_html->permission_denied(false); #fixed
        return;
      }

      $duser = new _cal_user("", " ", 0);

      $options = &$duser->options;

   } else {

      $options = &$_cal_user->options;
   }

   $vars = get_object_vars($options);

   while(list($key, $val) = each($vars)) {
      $_cal_form->defaults[$key] = $val;
   }


   $_cal_form->defaults['timezone'] = number_format($options->timezone,1);
   $_cal_form->print_header();
   echo($_cal_form->fromRequest("module"));

   ########################
   # HEADER
   ########################

   if($_REQUEST['option_action'] == _EDIT_DEFAULT_OPTS_) {
      $_cal_html->print_heading(_EDIT_DEFAULT_OPTS_);
   } else {
      $_cal_html->print_heading(_OPTIONS_);
   }


   ########################
   #
   ### TEMPLATE
   #
   ########################

   global $_cal_tmpl;

   $_cal_tmpl = new _cal_template("options_edit_template");
   $_cal_tmpl->print_header("opts");


   ##########################
   # TOOLBAR
   ########################

   if($_REQUEST['option_action'] == _EDIT_DEFAULT_OPTS_) {
      $_cal_form->print_hidden('edit_default',1);
      $r = '';
   } else if(!function_exists("_ex_auth_login")) {
      $url = new _cal_url();
      $url->addArg("option_action", "pass");
      $url->addArg("module", "options");

      $r = "<a class='"._CAL_CSS_TOOLBAR_."' href='". $url->toString() ."'>". _RESET_PASS_ ."</a>\n";

   }

   $l = $_cal_form->submit('option_action', _SAVE_) ." ".
      $_cal_form->submit('option_action', _CLOSE_);

   $_cal_tmpl->toolbar($l,"",$r);


   #####################
   #
   ### GENERAL OPTIONS
   #
   #####################

if(!@constant("_CAL_FORCE_DEFAULT_OPTS_") || $_REQUEST['option_action'] == _EDIT_DEFAULT_OPTS_)  {

   $_cal_tmpl->new_section(_GENERAL_);

   if(!@constant("_CAL_FORCE_THEME_"))
   $_cal_tmpl->section_row(_THEME_, $_cal_form->select('theme', $theme_options));

   $_cal_tmpl->section_row(_DEFAULT_VIEW_, $_cal_form->select('default_view', $_cal_views));

   $_cal_tmpl->section_row(_DEFAULT_CALENDAR_, $_cal_form->select('default_cal', $_calendars));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_SHOW_WEEKS_, $_cal_form->checkbox("show_weeks"));

   $_cal_tmpl->section_row(_EVNT_SIZE_, $_cal_form->select("e_size", array(_NORMAL_,_SMALLER_,_SMALLEST_)));
   $_cal_tmpl->section_row(_EVNT_COLLAPSE_, $_cal_form->checkbox("e_collapse") ." ". _EVNT_COLLAPSE_DESC_);
   $_cal_tmpl->section_row(_EVNT_TYPE_NAME_, $_cal_form->checkbox("e_typename"));

   $_cal_tmpl->section_spacer();

   $_cal_tmpl->section_row(_EVNT_POPUP_, $_cal_form->checkbox("e_popup") ." ".
	_EVNT_POPUP_DESC_);

   $_cal_tmpl->section_row(_EVNT_NOTES_POPUP_, $_cal_form->checkbox("e_n_popup") ." ".
	_EVNT_NOTES_POPUP_DESC_);


   $_cal_tmpl->section_spacer();


   $_cal_tmpl->section_row(_HOUR_FORMAT_, $_cal_form->select('hour_format',
	array("12" => _HOUR_FORMAT_12_, "24" => _HOUR_FORMAT_24_)));

   $_cal_tmpl->section_row(_TIME_INTERVALS_ ." (". _DAY_ .") ",
	$_cal_form->select('time_interval',$timeinterval_options));

   $_cal_tmpl->section_row(_WEEK_START_, $_cal_form->select('week_start', $_cal_weekdays));


   $_cal_tmpl->section_spacer();


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


   ###########################
   #
   ### TIMEZONE OPTIONS
   #
   ############################
   $_cal_tmpl->new_section(_TIMEZONE_);
   require_once(@constant("_CAL_BASE_PATH_") . "modules/options/locale.php");
   $_cal_tmpl->end_section();


   #############################################
   #
   ### INCLUDE NAVBAR
   #
   #############################################
   

      $_cal_tmpl->new_section(_NAVBAR_);

      if($_REQUEST['navbar_module_action']) {
         $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);
      }

      $_cal_tmpl->new_row();
      require_once(@constant("_CAL_BASE_PATH_") . "modules/navbar/modules.php");
      $_cal_tmpl->end_row();
      $_cal_tmpl->end_section();


} # check for force defatuls

   # THESE ARE NOT PART OF DEFAULT OPTIONS
   if($_REQUEST['option_action'] != _EDIT_DEFAULT_OPTS_) {


      # ONLY IF MAIL IS ENABLED
      ###########################
     
      if(@constant("_CAL_MAIL_FROM_")) {

      ###########################
      #
      ### CONTANCT OPTIONS
      #
      ###########################
      $_cal_tmpl->new_section(_CONTACT_OPTS_);
      require_once(@constant("_CAL_BASE_PATH_") . "modules/options/contact.php");
      $_cal_tmpl->end_section();

      #############################
      #
      ### SUBSCRIPTIONS
      #
      ############################
      if($_cal_user->email && !@constant("_CAL_NO_JOBS_")) {

         $_cal_tmpl->new_section(_SUBSCRIPTIONS_);
         require_once(@constant("_CAL_BASE_PATH_") ."modules/options/subscriptions.php");
         $_cal_tmpl->end_section();

         ##########################
         #
         ### NOTIFIATIONS
         #
         ##########################
         $_cal_tmpl->new_section(_NOTIFICATIONS_);
         require_once(@constant("_CAL_BASE_PATH_") . "modules/options/notifications.php");
         $_cal_tmpl->end_section();
      }

     }

   }

   ##########################
   # TOOLBAR
   ########################

   if($_REQUEST['option_action'] == _EDIT_DEFAULT_OPTS_) {
      $_cal_form->print_hidden('edit_default', 1);
      $r = "";
   } 


   $_cal_tmpl->toolbar($l,"",$r);

   $_cal_tmpl->print_footer();

   $_cal_form->print_footer();

?>
