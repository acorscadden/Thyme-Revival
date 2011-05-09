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
// $Id: default_options.php,v 1.13 2006/03/13 00:28:29 ian Exp $
//

   global $_cal_user, $_cal_html, $_cal_sql;

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");

   if(!$_cal_user->admin) {
         $_cal_html->permission_denied(false); # fixed;
         return;
   }



switch($_REQUEST['option_action'])
{

   case _SAVE_:

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.user.php");

      $duser = new _cal_user("", "", 0);
     
      $duser->options->tie_to($_REQUEST);

      if(!$duser->options->save(true)) {
         echo("<br>". _ERROR_ .": options.php :: \$_cal_user->options->save()<br>\n");
         break;
      }

      $url = new _cal_url();
      $url->addArg("module", "default_options");

      $_cal_html->js_redirect($url->toString());
      break;

   case _CANCEL_:
   case _CLOSE_:
      $url = new _cal_url();
      $url->addArg("module", "admin");
      $_cal_html->js_redirect($url->toString());
      break;


   default:
      $_REQUEST['option_action'] = _EDIT_DEFAULT_OPTS_;
      require_once(@constant("_CAL_BASE_PATH_") . "modules/options/options_edit_tpl.php");
}

?>
