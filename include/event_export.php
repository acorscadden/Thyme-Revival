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
// $Id: event_export.php,v 1.31 2006/03/10 17:36:40 ian Exp $
//


   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template.php");

   global $_cal_html, $_cal_sql, $_cal_user, $_cal_event;
  

   if(!$_cal_event->can_view()) {
      $_cal_html->permission_denied(true); # fixed
      return;
   }


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

   ksort($_cal_modules['sync']['export']);

   # for javascript set_opts
   echo("<script language='javascript' type='text/javascript'>\n\nvar ex_opts = new Array();\n");

   $exp_opts = array();
   $i = 0;
   foreach(array_keys($_cal_modules['sync']['export']) as $exp)
   {
      if($_cal_modules['sync']['export'][$exp]['hide_sync']) {
         unset($_cal_modules['sync']['export'][$exp]);
         continue;
      }

      $o = $i++; 
      echo("ex_opts[". $o ."] = new Array();\n");
      echo("ex_opts[". $o ."]['format'] = '". $exp ."';\n");
      echo("ex_opts[". $o ."]['attachments'] = ". intval($_cal_modules['sync']['export'][$exp]['attachments']) .";\n");
      echo("ex_opts[". $o ."]['date_range'] = ". intval($_cal_modules['sync']['export'][$exp]['date_range']) .";\n\n");

      $exp_opts[$exp] = $_cal_modules['sync']['export'][$exp]['display_name'];

   }

   echo("</script>\n");


   $f = new _cal_form("frmExport");
   $f->print_header();

   $f->print_hidden("event_action");
   $f->print_hidden("instance");
   $f->print_hidden("eid");

   $tmpl = new _cal_template();

   $tmpl->row_header_width = 100;

   $tmpl->print_header();

   include(_CAL_BASE_PATH_."include/templates/event_title.php");


   $tmpl->new_section(_EXPORT_);

   $_cal_event->set_localtime($_REQUEST['instance']);

   # FORMAT
   $tmpl->section_row(_EXPORT_TO_, $f->select("exp", $exp_opts, "onChange='set_opts()'") .
        "<span id=quirks></span>");

   # REPEATING
   if($_cal_event->freq > 0 || $_cal_event->override_id) {
      $tmpl->section_row(_DATE_, $f->select("dates", array(_THIS_DATE_ ." (". _ex_date(_DATE_INT_FULL_,$_cal_event->start).")", _ALL_DATES_)));
        
   }

   # ATTACHMENTS
   #
   # UNIMPLEMENTED Perhaps in future versions this will be an option when exporting
   # in iCalendar format. However, most programs do not support event attachments
   # so would not be able to import them anyways

   /*
   if(is_array($_cal_event->attachments) && count($_cal_event->attachments) > 0) {
      $tmpl->section_row(_ATTACHMENTS_, $f->checkbox("attachments"));
   }
   */

   $tmpl->end_section();

   if($_cal_user->options->e_popup) {
      $onclick = 'self.close()';
   } else {
      $onclick = "document.location = '"._CAL_PAGE_MAIN_."'";
   }
   $b = ' <input type=button value="'. _CLOSE_ .'" class="'._CAL_CSS_BUTTON_.'" onClick="'.$onclick.'">';
   

   $tmpl->toolbar("", "<input type=button onClick='export_event()' class='"._CAL_CSS_BUTTON_."' value='"._EXPORT_."'>
     <input type=button onClick='history.go(-1)' class='"._CAL_CSS_BUTTON_."' value='". _CANCEL_."'>". $b, "");

   $tmpl->print_footer();

   $f->print_footer();
   
?>
<script language="javascript" type="text/javascript">

function export_event()
{

   var optsel = document.frmExport.elements['exp'].options[document.frmExport.elements['exp'].selectedIndex].value;
   

   <?php
      $exurl = new _cal_url("modules/sync/export.php");
    ?>

   var url =  '<?php echo($exurl->toString()) ?>?export_to=' + optsel + '&eid=<?php echo($_REQUEST['eid']) ?>';

   <?php if($_cal_event->freq > 0 || $_cal_event->override_id): ?>
   if(document.frmExport.elements['dates'].selectedIndex == 0)
      url += '&instance=<?php echo($_REQUEST['instance']) ?>';
   <?php endif ?>


   if(document.frmExport.qm)
      url += '&quirks_mode=' + (document.frmExport.qm.checked ? '1' : '0');

   document.location = url;

}

function set_opts()
{

  var optsel = document.frmExport.elements['exp'].selectedIndex;


  <?php if(is_array($_cal_event->attachments) && count($_cal_event->attachments) > 0): ?>

  if(ex_opts[optsel]['attachments'] == 0) {

      document.frmExport.elements['attch'].checked = false;
      document.frmExport.elements['attch'].disabled = 1;

   } else {

      document.frmExport.elements['attch'].disabled = 0;
   }

   <?php endif ?>

   <?php if($_cal_event->freq > 0 || $_cal_event->override_id): ?>

   if(ex_opts[optsel]['date_range'] == 1) {

      document.frmExport.elements['dates'].selectedIndex = 0;
      document.frmExport.elements['dates'].disabled = true;

   } else {
      document.frmExport.elements['dates'].disabled = false;
   }
   <?php endif ?>

   if(ex_opts[optsel]['format'] == 'ical') {

      document.getElementById('quirks').innerHTML = '<input type=checkbox name="qm"> <?php echo(_QUIRKS_MODE_) ?>';

   } else {

      document.getElementById('quirks').innerHTML = '';

   }

}


set_opts();

</script>
