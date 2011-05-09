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
//

   define("_CAL_BENCHMARK_", 0);

   define("_CAL_USE_SESSION_", 1);

   if(!defined('_COPY_')) define('_COPY_','Copy');

   $CAL_BASE_PATH = dirname(__FILE__);

   require_once($CAL_BASE_PATH ."/include/config.php"); 
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.request.php");


   $_cal_html = new _cal_html();

   if($_REQUEST['eid'] < 0) {
      $_cal_event = new _cal_request(abs($_REQUEST['eid']));
   } else {
      $_cal_event = new _cal_event($_REQUEST['eid']);
   }

   $_cal_html->print_header($_cal_event->title);

   global $_cal_tmpl, $_cal_form, $_cur_cal;

  if(!$_cur_cal) {
     require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
     $_cur_cal = new _cal_obj($_SESSION['calendar']);
  }


if($_REQUEST['event_action'] == _EXPORT_) {

      require_once(@constant("_CAL_BASE_PATH_") . "include/event_export.php");

###################################
#
## EMAIL EVENT
#
###################################

} else if($_REQUEST['event_action'] == _EMAIL_ || $_REQUEST['event_action'] == _TELL_A_FRIEND_) {

      require(@constant("_CAL_BASE_PATH_") . "include/event_email.php");

} else {

      $_cal_form = new _cal_form("ev");
      $_cal_form->print_header();
      $_cal_form->print_hidden("eid"); 

      global $_cal_user;

      $button = "";

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");
      $url = new _cal_url(_CAL_PAGE_MAIN_);
      $url->addArg("event_action", _COPY_);
      $url->addArg("eid", $_REQUEST['eid']);
      $url->fromRequest("instance");
      $url->amp = '&';

     if(@constant("_CAL_EVENT_COPY_") && $_cal_user->access->can_add($_cal_event->cal_obj)) {
        $button = "<input type=button value='". _COPY_ ."' class='"._CAL_CSS_BUTTON_."'
                onClick='javascript:window.opener.location = \"". $url->toString() ."\";self.close()'> &nbsp; ";
     }


      if($_cal_event->can_edit()) {

         $url->addArg('event_action', _EDIT_);

         echo("<script language='javascript' type='text/javascript'>
         <!--
         function edit_event()
         {

           if(window.opener) {
              window.opener.location = '". $url->toString() ."';
              window.close();
           } else {
              document.location = '". $url->toString() ."';
           }
         }
");

          if($_cal_event->repeat_every_mask + $_cal_event->repeat_on > 0)
             $url->addArg("apply_to1", "this");

          $url->addArg("event_action", _DELETE_);
           echo("

          function delete_event()
          {
             if(window.opener) {
                window.opener.location = '". $url->toString() ."';
                window.close();
             } else {
                document.location = '". $url->toString() ."';
             }
           }\n");

            $button .= "<input type=button value='". _EDIT_ ."' class='"._CAL_CSS_BUTTON_."'
                onClick='javascript:edit_event()'> &nbsp; ";

          if(!$_cal_event->is_request) {

             $button .= "<input type=button value='". _DELETE_ ."' class='"._CAL_CSS_BUTTON_."'
                onClick='javascript:delete_event()'> &nbsp; ";

          }

        } else {

        echo("<script language='javascript' type='text/javascript'>\n<!--\n");
     }

  echo("

      var CloseButton = (window.opener ? \"<input type=button value='"._CLOSE_.
        "' class='"._CAL_CSS_BUTTON_."' onClick='javascript:window.close()'>\" : \"\");

      // -->
      </script>\n");

      $button .= "<script language=javascript type='text/javascript'>
        document.write(CloseButton);
        </script>\n";



      require_once(@constant("_CAL_BASE_PATH_") . "include/templates/event_view_tpl.php");




   $_cal_tmpl->toolbar("",$button,"");
   $_cal_tmpl->print_footer();
   $_cal_form->print_footer();

} # </ check for event_action>

   $_cal_html->print_footer();
?>
