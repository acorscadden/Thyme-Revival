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
// $Id: cal_publisher.php,v 1.20 2006/03/10 17:37:20 ian Exp $
//


   define("_CAL_BENCHMARK_", 0);

   define("_CAL_USE_SESSION_", 1);


   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");

   global $_cal_tmpl, $_cal_form, $_cal_html, $_cal_user, $_cur_cal;

   $_cal_html = new _cal_html();
   $_cal_form = new _cal_form();

  
   $_cur_cal = new _cal_obj($_SESSION['calendar']);

   $_cal_html->print_header(_CALENDAR_ ." - ". $_cur_cal->title);

   if(!$_cal_user->access->can_view($_cur_cal)) {
      $_cal_html->permission_denied(); # fixed
      return;
   }


   if($_cur_cal->type == 1) $_SESSION['calendar'] = -(abs($_SESSION['calendar']));

echo("<div id='pubid'>\n");

###################################
#
### PUBLISH CALENDAR
#
###################################

if($_REQUEST['publish_to']) {

   #######################
   # GET CALENDAR
   #######################
   require_once(@constant("_CAL_BASE_PATH_") . "modules/sync/export/ical/export_ical.php");
   ob_start();
   ical_export_calendar($_SESSION['calendar']);
   $ical_file = ob_get_contents();
   ob_end_clean();

   # PUT CALENDAR IN TMP
   $tmp = tmpfile();
   $size = fwrite($tmp, $ical_file);
   unset($ical_file);
   fseek($tmp, 0);
   

   $ch = curl_init();

   // set URL and other appropriate options
   curl_setopt($ch, CURLOPT_URL, $_REQUEST['publish_to'] .'/'.rawurlencode($_cur_cal->title).".ics");
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_PUT, 1);
   curl_setopt($ch, CURLOPT_INFILE, $tmp);
   curl_setopt($ch, CURLOPT_INFILESIZE, $size);
   
   if($_REQUEST['pub_u'])
      curl_setopt($ch, CURLOPT_USERPWD, $_REQUEST['pub_u'] .":". $_REQUEST['pub_p']);


   echo("<b>"._SERVER_RESPONSE_."</b>: ");
   // grab URL and pass it to the browser
   curl_exec($ch);

   if(curl_errno($ch))
      echo("<b>"._ERROR_."</b>: ". curl_error($ch) ."<br><br>");

   // close curl resource, and free up system resources
   curl_close($ch);

   echo("<br><br>");

} else {

   echo(_PUBLISH_DESC_ ."<br><br>");

}

######################################

   $_cal_form->print_header();

   $_cal_form->onSubmit[] = 'publish_cal();';

   $_cal_form->defaults = $_REQUEST;

?>

           <table border=1 align=center cellpadding=4 class='<?php echo(_CAL_CSS_CAL_CONTENT_ ." ". _CAL_CSS_SPACED_TABLE_)?>'>
           <tr>
           <th><?php echo(_TITLE_) ?></th><td><?php echo($_cur_cal->title) ?></td>
           </tr>
           <tr>
           <th><?php echo(_DESCRIPTION_) ?></th>
                <td colspan=1><?php echo($_cur_cal->description) ?></td>
           </tr>
              <tr>
              <th><?php echo(_URL_) ?></th>
              <td><?php
                echo($_cal_form->textbox('publish_to', 75));
               ?></td>
              </tr>


              <tr> <th><?php echo(_USERNAME_) ?></th>
                 <td>
                 <?php
                     echo($_cal_form->textbox('pub_u', 32));
                 ?>
           </tr>


           <tr> <th><?php echo(_PASSWORD_) ?></th>
                 <td>
                 <?php
                     echo($_cal_form->password('pub_p', 32));
                 ?>
           </tr>

 
          <tr> <td colspan=2 class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
                 <?php
                     echo($_cal_form->submit('pact', _PUBLISH_));
                 ?>

              <input type='button' class='<?php echo(_CAL_CSS_BUTTON_)?>' value='<?php echo(_CLOSE_) ?>'
                onClick='self.close()'>
           </td>
           </tr>


      </table>
<?php $_cal_form->print_footer(); ?>
</div>

<div id='progress' align='center'
        style='display: none; width: 100%; '>
        <br><br><br><img name='pbar' alt='progress bar' src='images/progress_bar.gif'><br><br><br></div>

<script language='javascript' type='text/javascript'>

function publish_cal()
{

   document.getElementById('pubid').style.display = 'none';
   document.getElementById('progress').style.display = 'inline';

   // IE animated gif bug
   setTimeout('document.images["pbar"].src = "<?php echo($_cal_html->get_img_url("images/progress_bar.gif")) ?>"', 100);

   return true;

}

</script>
<?php
   $_cal_html->print_footer();
?>
