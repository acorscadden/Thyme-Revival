<?php

require_once(_CAL_BASE_PATH_."include/classes/class.form.php");

if(!defined("_THYME_VER_")) define("_THYME_VER_", "1.3");

require_once(_CAL_BASE_PATH_."modules/installer/install_functions.php");

global $_cal_user, $_cal_html;


$_cal_html->print_heading(_INSTALLER_);

echo("<br>");

$rand = rand(1,32768);

###############
#
### CHECK THAT REPOSITORY IS WRITABLE
#
#######################################
if(!_ex_is_writable(_CAL_BASE_PATH_."modules/installer/repository", true)) {

  $_cal_html->warning(sprintf(_WARNING_DIR_NOT_WRITABLE_,_CAL_BASE_PATH_."modules/installer/repository"));

}


$_cal_form = new _cal_form('instform');
$_cal_form->method = 'POST';
$_cal_form->print_header("enctype='multipart/form-data'");
$_cal_form->print_hidden("module");

# check for a writable modules dir and repository dir

require_once(_CAL_BASE_PATH_."include/classes/class.template_tabbed.php");

require_once(_CAL_BASE_PATH_."include/classes/class.table.php");

$_cal_tmpl = new _cal_template();

$_cal_tmpl->print_header();


##############################
#
### UPDATES
#
##############################
require_once(_CAL_BASE_PATH_."include/http_get.php");

if(_ex_http_get(-1)) {


   # GET ENCODING TYPE
   ########################
   // check for optimizer string in phpinfo();
   if(!@constant("_THYME_ENC_")) {
      ob_start();
      @phpinfo(INFO_GENERAL);
      $out = ob_get_contents();
      ob_end_clean();
      $out = str_replace("&nbsp;", " ", $out);
     }

   ########################################

   $uname = _CAL_BASE_PATH_."modules/installer/repository/filelist.xml";
   $ubase = "http://www.extrosoft.com/products/thyme/updates/"._THYME_VER_."/";


   $_cal_tmpl->new_section(_UPDATES_);

   if($_REQUEST['inst_act'] == _REFRESH_) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

   if($_REQUEST['inst_act'] == _CHECK_FOR_UPDATES_) {

      $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

      $updates = _ex_http_get($ubase."filelist.xml?rand=".$rand);

      file_put_contents($uname, $updates);

      $updates = _ex_parse_xml($uname);

      $fp = fopen($uname, "r");

      $fstat = array_slice(fstat($fp), 13);

      fclose($fp);

      $lc = $fstat['mtime'];


   } else if(file_exists($uname)) {

      $fp = fopen($uname, "r");

      $fstat = array_slice(fstat($fp), 13);

      fclose($fp);

      $lc = $fstat['mtime'];

      $updates = _ex_parse_xml($uname);

   } else {

      $lc = 0;

      $updates['files'] = array();
   }

   #############################
   # CLEAN UP UPDATES
   #############################
   foreach(array_keys($updates['files']) as $uk) {
      if($updates['files'][$uk]['enc'] != 'none' && $updates['files'][$uk]['enc'] != _THYME_ENC_) {
         unset($updates['files'][$uk]);
      }
   }


   $mcr = get_magic_quotes_runtime();
   set_magic_quotes_runtime(0);

   $_cal_tmpl->new_row();


   #########################################
   #
   ### UPDATE A FILE
   #
   ##########################################
   if($_REQUEST['inst_act'] == 'update_file') {

      $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

      $ufile = _ex_http_get($ubase.$updates['files'][$_REQUEST['uk']]['src'].'?rand='.$rand);

      if(md5($ufile) != $updates['files'][$_REQUEST['uk']]['key'] || !strlen($ufile)) {

         echo("<h4 align='center'>"._INVALID_DOWNLOAD_."</h4>");
      

      } else {

         @mkdir(_CAL_BASE_PATH_."modules/installer/repository/backups");

         if(!(file_exists(_CAL_BASE_PATH_.$updates['files'][$_REQUEST['uk']]['dst']) &&
		file_put_contents(_CAL_BASE_PATH_."modules/installer/repository/backups/".
		basename($updates['files'][$_REQUEST['uk']]['dst']) .".". date("YmdHis"),
		@file_get_contents(_CAL_BASE_PATH_.$updates['files'][$_REQUEST['uk']]['dst'])))) {

           echo("<h4 align='center'>"._UNABLE_TO_BACKUP_."</h4>\n");

         } else {

            file_put_contents(_CAL_BASE_PATH_.$updates['files'][$_REQUEST['uk']]['dst'],
		$ufile);

            # CHMOD FILE?
            if(substr(strtolower(PHP_OS), 0, 3) != 'win') {
               @chmod(_CAL_BASE_PATH_.$updates['files'][$_REQUEST['uk']]['dst'],0755);
            }

            echo("<h4 align='center'>"._UPDATED_."</h4>");

         }

      }

 

   }


###################################
#
### IF UPDATES ARE AVAILABLE
#
###################################

   $_cal_table = new _cal_table();

   $_cal_table->print_header(array(_FILE_,_DATE_,_WRITABLE_,_UPDATE_));

   $_cal_table->align_opts = array('left', 'center','center');

/*

Array
(
    [0] => Array
        (
            [type] => file
            [src] => something.txt
            [enc] => none
            [key] => xxx
            [dst] => include/classes/class.event_matrix.php
        )

    [1] => Array
        (
            [type] => file
            [src] => my.txt
            [enc] => zend
            [key] => xxx
            [dst] => include/classes/class.event.php
        )

)

*/

   $upd_count = 0;

   $dl_url = new _cal_url();
   $dl_url->base = 'http://www.extrosoft.com/products/thyme/updates/updates.php';
   $dl_url->args = array();

   $dl_url->addArg('ver', _THYME_VER_);
   $dl_url->addArg('enc', _THYME_ENC_);

   if(!is_array($updates['files'])) $updates['files'] = array();
   foreach(array_keys($updates['files']) as $uk) {

      $upd = $updates['files'][$uk];

      $up2date = (!file_exists(_CAL_BASE_PATH_.$upd['dst']) && $upd['force'] != 'true');

      if(!$up2date && @constant("_CAL_UPDATES_USE_MTIME_")) {

         if(file_exists(_CAL_BASE_PATH_.$upd['dst'])) {

            $fp = fopen(_CAL_BASE_PATH_.$upd['dst'],"r");
            $fstat = fstat($fp);
            fclose($fp);
 
            $up2date = ($fstat['mtime'] >= $upd['mtime']);

         }            
 
      } else if(!$up2date) {


         $up2date = md5(@file_get_contents(_CAL_BASE_PATH_.$upd['dst'])) == $upd['key'];

      }

      if(!$up2date) {

         if(!file_exists(_CAL_BASE_PATH_.$upd['dst'])) {
            @file_put_contents(_CAL_BASE_PATH_.$upd['dst'], '<?php ?>');
         }

         $writable = _ex_is_writable(_CAL_BASE_PATH_.$upd['dst']);

         $dl_url->addArg('file', $upd['dst']);

         $_cal_table->print_row(array(

	   "<a href='".$dl_url->toString()."' class='"._CAL_CSS_ULINE_."'>{$upd['dst']}</a>",

      _ex_date(_DATE_INT_FULL_, $upd['mtime']),

		"<b>".
	   ($writable ? '<font color="green">'._YES_.'</font>' : '<font color="red">'._NO_.'</font>')
		."</b>",

	   ($writable ? "<input type=button class='"._CAL_CSS_BUTTON_."' value='"._UPDATE_."'
		onClick='update_file({$uk});'>" : " &nbsp; ")
           )
           );

         $upd_count++;

      }

   }

   $_cal_table->align_opts = array('center');

   $_cal_table->print_row(array($_cal_form->submit('inst_act', _CHECK_FOR_UPDATES_) ." &nbsp; &nbsp; ".
	$_cal_form->submit('inst_act', _REFRESH_)));

   $_cal_table->print_footer();



   set_magic_quotes_runtime($mcr);

   echo("<h4 align='center'>". sprintf(_UPDATES_AVAIL_, $upd_count) ." - "._LAST_CHECKED_ON_." ". ($lc ? _ex_date(_DATE_INT_FULL_." H:i", $lc) : _NEVER_)."</h4><br>");

   $_cal_tmpl->end_row();


   $_cal_tmpl->end_section();





}


$_cal_tmpl->print_footer();

$_cal_form->print_footer();


require_once(_CAL_BASE_PATH_."include/classes/class.url.php");

$_cal_url = new _cal_url();
$_cal_url->amp = '&';
$_cal_url->fromRequest("module");
$_cal_url->addArg("inst_act", _DELETE_);

?>
<script language='javascript' type='text/javascript'>

function delmod(mod)
{

   document.location = '<?php echo($_cal_url->toString()) ?>&mod2del=' + mod;
}

<?php $_cal_url->addArg("inst_act", "update_file"); ?>
function update_file(index)
{

   document.location = '<?php echo($_cal_url->toString()) ?>&uk=' + index;

}

</script>
