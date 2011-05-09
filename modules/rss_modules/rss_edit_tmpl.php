<?php

if(!@constant("_CAL_JOB_INTERVAL_")) define("_CAL_JOB_INTERVAL_", 5);

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

global $_cal_sql, $_cal_user;

$_cal_form = new _cal_form("rssform");

######################
#
### GET FEED VALUES
#
######################
list($_cal_form->defaults) = $_cal_sql->query("select id, title, url as furl, username as fuser,
	description as fdescription,
	password as fpass, upd_interval, style, scrolling from {$GLOBALS['_cal_dbpref']}RSSModule
	where id = ". $_cal_sql->escape_string($_REQUEST['rssid']));

$_cal_form->print_header();
$_cal_form->print_hidden("module");
$_cal_form->print_hidden('rssid');

###############################
#
### MINUTE OPTIONS
#
###############################
$m_interval = max(20,_CAL_JOB_INTERVAL_);
$int_m = array();
if($m_interval < 60) {
   for($i = 0; $i < 60; $i += $m_interval) {

      if($i == 0) $int_m[] = '00';
      else $int_m[$i] = $i;
   }
}

##############################
#
### HOUR OPTIONS
#
##############################
$int_h = array();
if($m_interval < 60) {
   $int_h = range(0,24);
} else {

   $h_interval = intval(floor(_CAL_JOB_INTERVAL_ / 60));

   for($i = $h_interval; $i <= 12; $i *= 2) {
      $int_h[$i] = $i;
   }
   $int_h[24] = 24;
}




$_cal_form->defaults['ui_h'] = intval($_cal_form->defaults['upd_interval'] / 60);
$_cal_form->defaults['ui_m'] = intval($_cal_form->defaults['upd_interval'] % 60);

$scrollbars = array(_OVERFLOW_,_SCROLLBAR_,_AUTOSCROLL_);

#########################
#
### GET LIST OF STYLES
#
#########################
$dh = dir(@constant("_CAL_BASE_PATH_")."modules/rss_modules/styles");
while((false !== ($entry = $dh->read()))) {

   if(substr($entry, 0,1) == ".") {
      continue;
   }

   $rss_styles[$entry] = preg_replace("/_/"," ",$entry);

}
$dh->close();


?>
<br><br>
<?php

require_once(_CAL_BASE_PATH_."include/classes/class.table.php");

$_cal_table = new _cal_table();

$_cal_table->vertical = true;

$_cal_table->align_opts[1] = 'left';

$_cal_table->print_header(array());

$_cal_table->col_count = 2;

$_cal_table->print_row(array(_TITLE_,$_cal_form->defaults['title']), false);

$_cal_table->print_row(array(_DESCRIPTION_,$_cal_form->textbox('fdescription', 64, " maxlength=255")),false);

$_cal_table->print_row(array(_URL_,$_cal_form->textbox('furl', 64)),false);

$_cal_table->print_row(array(_USERNAME_,$_cal_form->textbox('fuser', 12)),false);

$_cal_table->print_row(array(_PASSWORD_,$_cal_form->password('fpass', 12)),false);

$_cal_table->print_row(
   array(
      _UPDATE_INTERVAL_,
      $_cal_form->select("ui_h", $int_h) ." "._HRS_ ." " .
      (count($int_m) ? $_cal_form->select("ui_m", $int_m) ." "._MINS_ ." " : "") 
      .  $_cal_form->submit('rss_action', _UPDATE_NOW_)
   ),false
);

$_cal_table->print_row(array(_SCROLLING_,
   $_cal_form->select("scrolling", $scrollbars) ."
	<a href='javascript:newWin(\""._CAL_BASE_URL_."modules/rss_modules/preview_scrolling.php\")'
	class='"._CAL_CSS_ULINE_."'>". _PREVIEW_."</a>"
   ),false
);


$_cal_table->print_row(
   array(_STYLE_,
      $_cal_form->select("style", $rss_styles) ."
      <a href='javascript:preview_style()' class='"._CAL_CSS_ULINE_."'>"._PREVIEW_."</a>"
   ),false
);


$_cal_table->print_row(
   array(
	$_cal_form->submit('rss_action', _SAVE_) . " ".
        $_cal_form->submit('rss_action',_CANCEL_) . " 
        <input type='button' class='"._CAL_CSS_BUTTON_."' value='"._TEST_."' onClick='test_feed()'>"
   ), true
);

$_cal_table->print_footer();
?>
<br><br> 
<?php $_cal_form->print_footer() ?>
<script language='javascript' type='text/javascript'>
<!--

function preview_style()
{

   style = document.forms['<?php echo($_cal_form->name) ?>'].elements['style'].options[document.forms['<?php echo($_cal_form->name) ?>'].elements['style'].selectedIndex].value;

   newWin("<?php echo(@constant("_CAL_BASE_URL_")) ?>modules/rss_modules/preview_style.php?style=" + style);

}


function test_feed()
{

   var u = "<?php echo(@constant("_CAL_BASE_URL_")) ?>modules/rss_modules/test_feed.php";
   var frm = document.forms['<?php echo($_cal_form->name) ?>'].elements;

   u += '?url=' + frm['furl'].value + '<?php echo(_CAL_AMP_) ?>fu=' + frm['fuser'].value + '<?php echo(_CAL_AMP_) ?>fp=' + frm['fpass'].value;

   newWin(u);
   

}

-->
</script>
