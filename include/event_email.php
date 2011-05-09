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
// $Id: event_email.php,v 1.43 2008/02/04 21:34:12 ian Exp $
//


   define("_CAL_DOING_OPTS_", 1);
   include(@constant("_CAL_BASE_PATH_") . "include/languages/". @constant("_CAL_LANG_") .".php");

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");

   global $_cal_html, $_cal_sql, $_cal_user, $_cal_event, $_cal_modules;
  

   if(!$_cal_event->can_view()) {
      $_cal_html->permission_denied(false); # fixed
      return;
   }

   $f = new _cal_form("frmEmail");
   $f->print_header();

   $f->print_hidden("event_action");
   $f->print_hidden("instance");
   $f->print_hidden("eid");


echo("<div id='emailevent'>\n");

   $_cal_tmpl = new _cal_template();

   $_cal_tmpl->row_header_width = 100;

   $_cal_tmpl->print_header();

   include(_CAL_BASE_PATH_."include/templates/event_title.php");

   $_cal_tmpl->new_section($_REQUEST['event_action']);

   $GLOBALS['ms_quirks'] = 1;

   ############################
   #
   ### GET A LIST OF EXPORT FORMATS
   #
   ################################

   $dh = dir(@constant("_CAL_BASE_PATH_") . "/modules/sync/export");
   while (false !== ($entry = $dh->read())) {

      if(substr($entry, 0,1) == ".") {
         continue;
      }

      if(!@include(@constant("_CAL_BASE_PATH_") . "/modules/sync/export/".$entry."/register_format.php"))
         continue;

   }
   $dh->close();


if($_cal_user->guest && !@constant("_CAL_GUEST_EMAIL_OK_")) return;

##################################
#
### SEND EMAIL
#
############################3333
if($_REQUEST['subact'] == _SEND_EMAIL_) {


   if($_REQUEST['dates']) unset($_REQUEST['instance']);

   $s = null;

   #
   $s['email'] = $_REQUEST['email_to'];
   $s['format'] = $_REQUEST['exp'];

   if($_REQUEST['event_action'] == _TELL_A_FRIEND_) {
      $s['format'] = 'html';
      $_REQUEST['email_to'] = $s['email'] = $_REQUEST['friend_email'];
      $s['name'] = $_REQUEST['friend_name'];
   }

   # check for custom email function
   #
   ##################################
   if(isset($_cal_modules['sync']['export'][$s['format']]['email_func'])) {

      require_once(@constant("_CAL_BASE_PATH_") . "modules/sync/export/" . $_cal_modules['sync']['export'][$s['format']]['include']);

      $res = call_user_func($_cal_modules['sync']['export'][$s['format']]['email_func'],
                $s['email'], $_cal_event, $_REQUEST['subject'], $_REQUEST['message']);

   } else {


      # SET MAIL FROM FORM
      if($_REQUEST['event_action'] == _TELL_A_FRIEND_) {
         $_cal_user->name = $_REQUEST['your_name'];
         $_cal_user->email = $_REQUEST['your_email'];
      }


      if($_cal_user->name) $from = '"'.$_cal_user->name .'" <'. $_cal_user->email .">";
      else $from = $_cal_user->email;

      if(!$_cal_user->email) $GLOBALS['_MAIL_FROM_'] = @constant("_CAL_MAIL_FROM_");
      else $GLOBALS['_MAIL_FROM_'] = $from;

      require_once(@constant("_CAL_BASE_PATH_") . "include/send_event.php");

      # MULTIPLE E-MAIL ADDRS?
      #########################
      $emails = explode(',',$s['email']);
    
      foreach($emails as $e) {

        $s['email'] = trim($e);
   
        $res = send_event($s, $_cal_event, $_REQUEST['subject'], $_REQUEST['message'], $_REQUEST['message'], true);

      }

   } 

   if($res) {


     $_cal_tmpl->section_row("", _EMAIL_SENT_TO_ ." ".$_REQUEST['email_to']);
   } else {

     $_cal_tmpl->section_row("",_ERROR_);

   }


   $_cal_tmpl->end_section();

   if($_cal_user->options->e_popup) {
      $onclick = 'self.close()';
   } else {
      $onclick = "document.location = '"._CAL_PAGE_MAIN_."'";
   }
   $b = ' <input type=button value="'. _CLOSE_ .'" class="'. _CAL_CSS_BUTTON_.'" onClick="'.$onclick.'">';


   $_cal_tmpl->toolbar("",$b,"");

   $_cal_tmpl->print_footer();

   $f->print_footer();


   return;

}


   ksort($_cal_modules['sync']['export']);


   # for javascript set_opts
   echo("<script language='javascript' type='text/javascript'>\n\nvar ex_opts = new Array();\n");

   $exp_opts = array();
   $i = 0;
   foreach(array_keys($_cal_modules['sync']['export']) as $exp)
   {
      $o = $i++; 
      echo("ex_opts[". $o ."] = new Array();\n");
      echo("ex_opts[". $o ."]['attachments'] = ". intval($_cal_modules['sync']['export'][$exp]['attachments']) .";\n");
      echo("ex_opts[". $o ."]['date_range'] = ". intval($_cal_modules['sync']['export'][$exp]['date_range']) .";\n\n");
      echo("ex_opts[". $o ."]['email_no_msg'] = ". intval($_cal_modules['sync']['export'][$exp]['email_no_msg']) .";\n");


      $exp_opts[$exp] = $_cal_modules['sync']['export'][$exp]['display_name'];

   }

   echo("</script>\n");


   # default format is HTML
   $f->defaults['exp'] = 'html';

   $hidden = "";

   # FORMAT
   if($_REQUEST['event_action'] == _TELL_A_FRIEND_) {
      $hidden = $f->hidden('exp', 'html');
   } else {
      $_cal_tmpl->section_row(_FORMAT_, $f->select("exp", $exp_opts, "onChange='set_opts()'"));
   }

   # REPEATING
   if(($_cal_event->freq > 0 || $_cal_event->override_id ) && $_REQUEST['event_action'] != _TELL_A_FRIEND_) {
      $_cal_tmpl->section_row(_DATE_, $f->select("dates", array(_THIS_DATE_ ." (". $_REQUEST['instance'].")", _ALL_DATES_)));
        
   } else {
      $hidden .= $f->hidden("dates",_THIS_DATE_);
   }     


   $f->defaults['subject'] = $_cal_event->title;

   $_cal_tmpl->section_spacer();

   if($_REQUEST['event_action'] == _TELL_A_FRIEND_) {
      $_cal_tmpl->row_header_width = 200;
      $_cal_tmpl->section_row(_YOUR_NAME_, $f->textbox('your_name',32));
      $_cal_tmpl->section_row(_YOUR_EMAIL_, $f->textbox('your_email', 32));
      $_cal_tmpl->section_row(_YOUR_FRIENDS_NAME_, $f->textbox('friend_name', 32));
      $_cal_tmpl->section_row(_YOUR_FRIENDS_EMAIL_, $f->textbox('friend_email', 32));

      $_cal_tmpl->section_spacer();

   } else {

      if($_cal_user->admin || !@constant("_CAL_DISABLE_ADDR_BOOK_")) {
         $addr_book = " <span id='addr_book'><input type=button value='"._ADD_."' class='"._CAL_CSS_BUTTON_."'
            onClick='newWin(\"". _CAL_BASE_URL_."addr_book.php?callback=add_email\",500,500);ch_to_span(\"+\")'><br></span>";
      } else {
         $addr_book = "";
      }
      $_cal_tmpl->section_row(_EMAIL_TO_, "<span id='email_to_span'>".$f->textbox('email_to', 32)."</span>".
        " $addr_book <input type=button name='ch_to' class='"._CAL_CSS_BUTTON_."'
            onClick='ch_to_span(this.value)' value='+'>");
      $_cal_tmpl->section_row("",_EMAIL_TO_MULTIPLE_);
   }
   $_cal_tmpl->section_row(_SUBJECT_, $f->textbox('subject', 50));
   $_cal_tmpl->section_row(_MESSAGE_, '<div id="msg">'. $f->textarea('message', 7,70) ."</div>");

   if($_REQUEST['event_action'] == _TELL_A_FRIEND_) {
      $_cal_tmpl->section_row("",_EMAIL_EVENT_DISPLAYED_);
   }

   $_cal_tmpl->end_section();

   if($_cal_user->options->e_popup) {
      $onclick = 'self.close()';
   } else {
      $onclick = "document.location = '"._CAL_PAGE_MAIN_."'";
   }
   $b = ' <input type=button value="'. _CLOSE_ .'" class="'. _CAL_CSS_BUTTON_ .'" onClick="'.$onclick.'">';
   

   $_cal_tmpl->toolbar("", $f->submit('subact', _SEND_EMAIL_) ." 
     <input type=button onClick='history.go(-1)' class='"._CAL_CSS_BUTTON_."' value='". _CANCEL_."'>". $b, "");

   $_cal_tmpl->print_footer();

   $f->onSubmit[] = 'show_progress()';

   $f->print_footer();
echo("</div>\n");
 
  # progress bar
  #################
  echo("<div id='progress' align='center'
        style='display: none; width: 100%; '>
        <br><br><br><img name='pbar' src='images/progress_bar.gif'><br><br><br></div>\n");

require_once(_CAL_BASE_PATH_."include/js/newWin.js");

?>
<script language="javascript" type="text/javascript">

<?php if((!$_cal_user->email && !$_cal_user->guest)): ?>

alert('<?php echo(str_replace("'","\\'", str_replace("\n"," ",@constant("_EMAIL_NO_ADDR_WARNING_")))) ?>');

<?php endif ?>


function add_email(name, email)
{

   var add_to_elm = document.forms['frmEmail'].elements['email_to'];

   if(add_to_elm.value.length)
      add_to_elm.value = add_to_elm.value + ', ';

   add_to_elm.value = add_to_elm.value + '"' + name + '" <' + email + '>';

}

var ch_to_txtbox = '<?php echo(str_replace(array("'","\n"),array("\\'"," "),$f->textbox('email_to',32))) ?>';
var ch_to_txtarea = '<?php echo(str_replace(array("'","\n"),array("\\'"," "),$f->textarea('email_to',5,40))) ?>';

function ch_to_span(pm)
{
   var btn = document.forms['frmEmail'].elements['ch_to'];
   var addrs = document.forms['frmEmail'].elements['email_to'].value;

   if(pm == '+') {
      document.getElementById('email_to_span').innerHTML = ch_to_txtarea;
      btn.value = '-';
   } else {
      document.getElementById('email_to_span').innerHTML = ch_to_txtbox;
      btn.value = '+';
   }

   document.forms['frmEmail'].elements['email_to'].value = addrs;
}

function show_progress()
{

   var dv = document.getElementById('emailevent');
   var pg = document.getElementById('progress');

   if(dv && pg) {
      dv.style.display = 'none';
      pg.style.display = 'block';
   }

   setTimeout('document.images["pbar"].src = "<?php echo($_cal_html->get_img_url("images/progress_bar.gif")) ?>"', 100);

   return true;
}

function export_event()
{

   var optsel = document.frmEmail.elements['exp'].options[document.frmEmail.elements['exp'].selectedIndex].value;
   

   <?php
      $exurl = new _cal_url("modules/sync/export.php");
    ?>
   document.location = '<?php echo($exurl->toString()) ?>?export_to=' + optsel + '&eid=<?php echo($_REQUEST['eid']) ?>';

}

function set_opts()
{

  var optsel = document.frmEmail.elements['exp'].selectedIndex;


  <?php if(is_array($_cal_event->attachments) && count($_cal_event->attachments) > 0 && false): ?>

  if(ex_opts[optsel]['attachments'] == 0) {

      document.frmEmail.elements['attch'].checked = false;
      document.frmEmail.elements['attch'].disabled = 1;

   } else {

      document.frmEmail.elements['attch'].disabled = 0;
   }

   <?php endif ?>

   if(ex_opts[optsel]['email_no_msg'])
      document.getElementById('msg').style.display = 'none';
   else
      document.getElementById('msg').style.display = 'inline';


   <?php if($_cal_event->freq > 0 || $_cal_event->override_id): ?>

   if(ex_opts[optsel]['date_range'] == 1) {

      document.frmEmail.elements['dates'].selectedIndex = 0;
      document.frmEmail.elements['dates'].disabled = true;

   } else {
      document.frmEmail.elements['dates'].disabled = false;
   }
   <?php endif ?>

}

set_opts();

</script>
