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
// $Id: guest_options.php,v 1.14 2006/03/30 16:31:15 ian Exp $
//


   global $_cal_user, $_cal_html, $_cal_sql, $_cal_tmpl, $_cal_form;

   define("_CAL_DOING_OPTS_", 1);

   require(@constant("_CAL_BASE_PATH_") . "include/languages/". constant("_CAL_LANG_") .".php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php"); 
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");


switch($_REQUEST['option_action'])
{

   case _SAVE_:

      $_SESSION['tz'] = $_REQUEST['timezone'];
      $_SESSION['dst'] = $_REQUEST['dst'];

      session_write_close();

      $url = new _cal_url();
      $_cal_html->js_redirect($url->toString());
      break;


   case _CANCEL_:

      $url = new _cal_url();

      $_cal_html->js_redirect($url->toString());
      break;


   default:

      $_cal_html->print_heading(_OPTIONS_);

      $options = $_cal_user->options;

      $_cal_form = new _cal_form();
      $_cal_form->print_header();
      $_cal_form->print_hidden("module");

      $_cal_form->defaults['timezone'] = $options->timezone;
      $_cal_form->defaults['dst'] = $options->dst;


      $_cal_tmpl = new _cal_template('guest_options_template');
      $_cal_tmpl->print_header();

      $_cal_tmpl->new_section(_TIMEZONE_);
      require_once(@constant("_CAL_BASE_PATH_") . "modules/options/locale.php");
      $_cal_tmpl->end_section();

      $_cal_tmpl->toolbar("", $_cal_form->submit('option_action', _SAVE_) ." ".
      $_cal_form->submit('option_action', _CANCEL_), "");


      $_cal_tmpl->print_footer();

      $_cal_form->print_footer();
}

?>
