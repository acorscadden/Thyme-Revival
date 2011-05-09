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
// $Id: requests.php,v 1.36 2007/05/08 02:45:07 ian Exp $
//


global $_cal_sql, $_cal_html, $_cal_user, $_cal_dbpref, $_cal_weekdays;

$_cal_html->print_heading(_REQUESTS_);

#######################################
#
#### GET LIST OF PENDING REQUESTS
#
###########################@###########

require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.request.php");
require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.form.php");
require_once(@constant("_CAL_BASE_PATH_") ."include/js/newWin.js");
require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.mailer.php");
require_once(_CAL_BASE_PATH_."include/images.php");

# set event view url based on
# user's settings
$cal->set_event_view_url();


$_cal_form = new _cal_form("r_form");
$_cal_form->print_header();
$_cal_form->print_hidden("module");
$_cal_form->print_hidden("rid");

if(isset($_REQUEST['cal_sort'])) $_SESSION['cal_sort'] = intval($_REQUEST['cal_sort']);
if(isset($_REQUEST['ascdesc'])) $_SESSION['ascdesc'] = intval($_REQUEST['ascdesc']);

###############################
#
### CHECK FOR REQUEST ACTION
#
###############################

switch ($_REQUEST['r_action'])
{

   case _ACCEPT_:
   case 'accept':

      $r = new _cal_request($_REQUEST['rid']);

      if(!$_cal_user->access->can_admin($r->cal_obj)) {
         $_cal_html->permission_denied(); # fixed
         return;
      }

      # IF THERE WAS NO EMAIL ADDRESS, JUST APPROVE IT
      #################################################
      if(!strlen(trim($r->request_contact)) || $_REQUEST['rel']) {

         $r->mk_event();


         # SEND MAIL TO REQUESTOR?
         ############################
         if($_REQUEST['request_notify'] && $r->request_contact)
         {

            $_cal_mailer = new _cal_mailer();

            if(!$_cal_user->email) {
                $_cal_user->email = _CAL_MAIL_FROM_;
                $_cal_user->email = preg_replace("/.*</","", $_cal_user->email);
                $_cal_user->email = preg_replace("/>.*/","",$_cal_user->email);
            }

            $mail_from = "\"". $_cal_user->name ."\" <". $_cal_user->email .">";

            $header = "Return-path: $mail_from\n";
            $header .= "Sender: $mail_from\n";
            $header .= "From: $mail_from\n";
            $header .= "MIME-Version: 1.0\n";
            $header .= "Content-Type: text/plain; charset=\""._CHARSET_."\"\n\n";

           $_cal_mailer->From     = $_cal_user->email;
           $_cal_mailer->FromName = $_cal_user->name;

           $_cal_mailer->AddAddress($r->request_contact);

           $subject = $r->title .": "._REQUEST_ACCEPTED_;

           $_cal_mailer->Send($header,
                _REQUEST_ACCEPTED_."\n\n".
                    $r->title ."\n"._DATE_.": ". $_cal_weekdays[_ex_date('w',$r->starttime)] ." ".
                    _ex_date(_DATE_INT_FULL_, $r->starttime). "\n"._TIME_.": ".
                    _ex_display_time_long($r->starttime) .
                    "\n\n".$_cal_user->name .": ".
                    $_REQUEST['request_message'],
                    $subject);

         }
         break;
      }
  
      echo("<br><br>");

      $_cal_form->print_hidden("rel", 1);
      $_cal_form->defaults['request_notify'] = $r->request_notify;

      ?>
         <table cellspacing=4 align=center width='100%'>
         <tr>
            <td align=center>
            <table border=1 align=center cellpadding=4
                    class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." ". _CAL_CSS_CAL_CONTENT_) ?>'>

            <?php if($r->request_notify): ?>
            <tr> <td colspan=2><?php echo(_REQUEST_HAS_NOTIFY_) ?></td></tr>
            <?php endif ?>
            

            <tr><th><?php echo(_NOTIFY_REQUESTOR_) ?></th><td>
            <?php echo($_cal_form->checkbox("request_notify")) ?></td></tr>
            <tr><th><?php echo(_EMAIL_) ?></th><td>
                <a class='<?php echo(_CAL_CSS_ULINE_) ?>' href="mailto:<?php echo($r->request_contact) ?>"><?php echo($r->request_contact) ?></a>
            </td></tr>
            <tr><th><?php echo(_MESSAGE_) ?></th><td>
            <?php echo($_cal_form->textarea("request_message", 5,50)) ?></td></tr>
            <tr> <td colspan=2 class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
                <?php echo($_cal_form->submit("r_action",_ACCEPT_)) ?>   
                <?php echo($_cal_form->submit("r_action",_CANCEL_)) ?></td></tr>
            </table>
            </td>
         </tr>
         </table>
         <br><br>
        <?php

        $_cal_form->print_footer();

      return;


   case _REJECT_;
   case 'reject':

      $r = new _cal_request($_REQUEST['rid']);

      if(!$_cal_user->access->can_admin($r->cal_obj)) {
         $_cal_html->permission_denied(); #fixed
         return;
      }


      # IF THERE WAS NO EMAIL ADDRESS, JUST APPROVE IT
      #################################################
      if(!strlen(trim($r->request_contact)) || $_REQUEST['rel']) {

         $r->delete();


         # SEND MAIL TO REQUESTOR?
         ############################
         if($_REQUEST['request_notify'] && $r->request_contact)
         {

            $_cal_mailer = new _cal_mailer();

            if(!$_cal_user->email) {
                $_cal_user->email = _CAL_MAIL_FROM_;
                $_cal_user->email = preg_replace("/.*</","", $_cal_user->email);
                $_cal_user->email = preg_replace("/>.*/","",$_cal_user->email);
            }


            $mail_from = "\"". $_cal_user->name ."\" <". $_cal_user->email .">";

            $header = "Return-path: $mail_from\n";
            $header .= "Sender: $mail_from\n";
            $header .= "From: $mail_from\n";
            $header .= "MIME-Version: 1.0\n";
            $header .= "Content-Type: text/plain; charset=\""._CHARSET_."\"\n\n";

           $_cal_mailer->From     = $_cal_user->email;
           $_cal_mailer->FromName = $_cal_user->name;

           $_cal_mailer->AddAddress($r->request_contact);

           $subject = $r->title .": "._REQUEST_REJECTED_;

           $_cal_mailer->Send($header,
                    _REQUEST_REJECTED_."\n\n".
                   $r->title ."\n"._DATE_.": ". $_cal_weekdays[_ex_date('w', $r->starttime)]." ".
                    _ex_date(_DATE_INT_FULL_, $r->starttime). "\n"._TIME_.": ".
                    _ex_display_time_long($r->starttime) ."\n\n".
                $_cal_user->name .": ". $_REQUEST['request_message'],
                    $subject);


         }
         break;
      }

      echo("<br><br>");
      $_cal_form->print_hidden("rel", 1);
      $_cal_form->defaults['request_notify'] = $r->request_notify;

      ?>
         <table cellspacing=4 align=center width='100%'>
         <tr>
            <td align=center>
            <table border=1 align=center cellpadding=4
                class='<?php echo(_CAL_CSS_SPACED_TABLE_ ." ". _CAL_CSS_CAL_CONTENT_) ?>'>

            <?php if($r->request_notify): ?>
            <tr> <td colspan=2><?php echo(_REQUEST_HAS_NOTIFY_) ?></td></tr>
            <?php endif ?>


            <tr><th><?php echo(_NOTIFY_REQUESTOR_) ?></th><td>
            <?php echo($_cal_form->checkbox("request_notify")) ?></td></tr>
            <tr><th><?php echo(_EMAIL_) ?></th><td>
                <a class='<?php echo(_CAL_CSS_ULINE_) ?>' href="mailto:<?php echo($r->request_contact) ?>"><?php echo($r->request_contact) ?></a>
            </td></tr>
            <tr><th><?php echo(_MESSAGE_) ?></th><td>
            <?php echo($_cal_form->textarea("request_message", 5,50)) ?></td></tr>
            <tr> <td colspan=2 class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
                <?php echo($_cal_form->submit("r_action",_REJECT_)) ?>
                <?php echo($_cal_form->submit("r_action",_CANCEL_)) ?></td></tr>
            </table>
            </td>
         </tr>
         </table>
         <br><br>
        <?php

        $_cal_form->print_footer();

      #
      return;



}

$_cal_form->print_hidden("r_action","");

$acals = array_flip($_cal_user->access->get_cals_sel(2, "type in (0,3,4)"));

if(!count($acals)) $acals = array("0");

###################
#
### CHECK ORDER BY
#
###################
switch(intval($_SESSION['cal_sort'])) {

  case 1:
    $orderby = "{$_cal_dbpref}Requests.title";
    break;

  case 2:
    $orderby = "lower({$_cal_dbpref}Requests.org_name)";
    break;

  case 3:
    $orderby = "{$_cal_dbpref}Requests.added";
    break;

  case 4:
    $orderby = "{$_cal_dbpref}Requests.starttime";
    break;

  default:
    $orderby = "{$_cal_dbpref}Calendars.title";

}

$orderby .= " ". ($_SESSION['ascdesc'] ? " desc" : " asc");

$reqs = array_flip($_cal_sql->query("select {$_cal_dbpref}Requests.id,
    {$_cal_dbpref}Requests.id as id2
    from {$GLOBALS['_cal_dbpref']}Requests
    left join {$_cal_dbpref}Calendars on
        {$_cal_dbpref}Calendars.id = calendar
    where calendar in (". join(",",$acals) .") order by $orderby",true));

#######################
# NO PENDING REQUESTS
#######################
if(!count($reqs)) {

   echo("<h4 align='center'>"._REQUESTS_NO_PENDING_."</h4>\n");
   echo("<br><br>\n");
   return;
}

require_once(_CAL_BASE_PATH_."include/classes/class.table.php");

$_cal_table = new _cal_table();

#########################
#
### COMPOSE SORT HEADER
#
##########################
$url = new _cal_url();
$url->fromRequest('module');
$url->addArg('ascdesc', intval(!(intval($_SESSION['ascdesc']))));
$adurl = $url->toString();

$adimg = _ex_img_str("images/". (intval($_SESSION['ascdesc']) ? 'up' : 'down') .".gif");

$url->addArg('ascdesc','');

$thead = array(

    ($_SESSION['cal_sort'] == 0 || ($url->addArg('cal_sort','0') && 0) ?
        _CALENDAR_." <a href='{$adurl}'>{$adimg}</a>" :
        "<a href='". $url->toString() ."'>"._CALENDAR_."</a>"),

    ($_SESSION['cal_sort'] == 1 || ($url->addArg('cal_sort','1') && 0) ?
        _TITLE_." <a href='{$adurl}'>{$adimg}</a>" : 
        "<a href='". $url->toString() ."'>"._TITLE_."</a>"),

    ($_SESSION['cal_sort'] == 2 || ($url->addArg('cal_sort','2') && 0) ?
        _CONTACT_." <a href='{$adurl}'>{$adimg}</a>": 
        "<a href='". $url->toString() ."'>"._CONTACT_."</a>"),

    ($_SESSION['cal_sort'] == 3 || ($url->addArg('cal_sort','3') && 0) ?
        _SUBMITTED_." <a href='{$adurl}'>{$adimg}</a>" : 
        "<a href='". $url->toString() ."'>"._SUBMITTED_."</a>"),

    ($_SESSION['cal_sort'] == 4 || ($url->addArg('cal_sort','4') && 0) ?
        _STARTS_AT_." <a href='{$adurl}'>{$adimg}</a>" :
        "<a href='". $url->toString() ."'>"._STARTS_AT_."</a>"),

    "");


$_cal_table->print_header($thead
    #array(_CALENDAR_,_TITLE_,_CONTACT_,_SUBMITTED_,_STARTS_AT_,"")
);

foreach ($reqs as $r)
{

   $r = new _cal_request($r);

   $u = new _cal_user("","",$r->owner);
   
   if($u->guest)
      $u->name = _CAL_USER_GUEST_;

   if($r->org_name && $u->guest) $u->name = $r->org_name;
   $org = $u->name;

   if($r->request_contact) {
      $org .=" ( <a href='mailto:". $r->request_contact."' class='"._CAL_CSS_ULINE_."'
        >". $r->request_contact ."</a> )";
   } 


   $r->added = $GLOBALS['_cal_user']->to_localtime($r->added);

   $url = str_replace(array("%eid","%inst"), array("-".$r->id, _ex_date("Y-n-j", $r->starttime)),
        $cal->event_view_url);


   $_cal_table->print_row(
    array(
      $r->cal_title,"<a href='". $url ."' class='"._CAL_CSS_ULINE_."'>".$r->title ."</a>",
      $org, _ex_date(_DATE_INT_FULL_, $r->added) ." ". _ex_display_time_med($r->added),
      _ex_date(_DATE_INT_FULL_, $r->starttime) ." ".  _ex_display_time_med($r->starttime),

      "<input onClick='req_action(". $r->id .", \"accept\")' type=button
                class='"._CAL_CSS_BUTTON_."' value='". _ACCEPT_."'> ".
      "<input onClick='req_action(". $r->id .", \"reject\")' type=button
                class='"._CAL_CSS_BUTTON_."' value='". _REJECT_ ."'>"
    ), true
   );

}

$_cal_table->print_footer();
?>
<?php $_cal_form->print_footer(); ?>
<Br><br>
<script language="javascript" type="text/javascript">
<!--

function req_action(id, action)
{

   document.forms['r_form'].elements['rid'].value = id;
   document.forms['r_form'].elements['r_action'].value = action;
   document.forms['r_form'].submit();


}


// -->
</script>
