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
// $Id: rss_admin.php,v 1.30 2008/07/16 17:09:39 ian Exp $
//

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");

   global $_cal_sql, $_cal_user, $_cal_dbpref;
  
   $_cal_sql or $_cal_sql = new _cal_sql();

   # MAKE SURE WE'RE THE ADMIN USER..
   if(!$_cal_user->admin) {

      $_cal_html->permission_denied(); # fixed
      return;
   }

       # see if rss repository is not writable
       ############################################
       if(!_ex_is_writable(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/repository", true))
               $_cal_html->warning(sprintf(_WARNING_RSS_, @constant("_CAL_BASE_PATH_") . "modules".
        DIRECTORY_SEPARATOR ."rss_modules". DIRECTORY_SEPARATOR ."repository"));


   $_cal_html->print_heading(_RSS_FEED_MODULES_);



####################################
#
### CHECK ACTION
#
######################################
switch($_REQUEST['feed_action'])
{

   ## ADD A FEED
   case _ADD_:

      if(!strlen(trim($_REQUEST['ntitle']))) break;

      if(array_search(strtoupper(substr($_REQUEST['ntitle'], 0, 1)), $GLOBALS['_cal_alphabet']) === false) {
        echo("<h4 align=center>"._TITLE_." "._MUST_BEGIN_WITH_CHAR_."</h4><br>\n");
        break;
      }


      $_cal_sql->query("insert into {$_cal_dbpref}RSSModule (title,description, upd_interval)
        values ('". $_cal_sql->escape_string($_REQUEST['ntitle']) ."',
        '". $_cal_sql->escape_string($_REQUEST['ndescription']) ."', 720)");

      $_SESSION['cal_char'] = substr($_REQUEST['ntitle'], 0, 1);

      break;


}

switch($_REQUEST['rss_action']) {


   ### EDIT A FEED
   ##################
   case _EDIT_:
      require_once(@constant("_CAL_BASE_PATH_") . "modules/rss_modules/rss_edit_tmpl.php");
      return;

   ### SAVE AN RSS FEED
   ####################
   case _SAVE_:
 
      if(!($_REQUEST['furl'] && $_REQUEST['rssid'])) break; 

      # CHECK OLD URL
      list($url) = $_cal_sql->query("select url from {$_cal_dbpref}RSSModule where id = ".
        $_cal_sql->escape_string($_REQUEST['rssid']));

      $url = $url['url'];

      $ui = max(intval(($_REQUEST['ui_h'] * 60) + $_REQUEST['ui_m']), 20);

      $_cal_sql->query("update {$_cal_dbpref}RSSModule set url = '".
        $_cal_sql->escape_string($_REQUEST['furl']) ."', username = '".
        $_cal_sql->escape_string($_REQUEST['fuser']) ."', password = '".
        $_cal_sql->escape_string($_REQUEST['fpass']) ."', upd_interval = $ui,
        scrolling = ". intval($_REQUEST['scrolling']) .", style = '".
            $_cal_sql->escape_string($_REQUEST['style']) ."', description = '".
            $_cal_sql->escape_string($_REQUEST['fdescription']) ."'
        where id = ". $_cal_sql->escape_string($_REQUEST['rssid']));


      # UPDATE RSS FEED?
      #####################
      if($url == $_REQUEST['furl']) {
         break;
      }


   ## UPDATE FEED NOW
   ######################
   case _UPDATE_NOW_:

      list($r) = $_cal_sql->query("select * from {$_cal_dbpref}RSSModule
            where id = ". $_cal_sql->escape_string($_REQUEST['rssid']));

      $r['urls'] = array($r['url']);
      $r['repository'] = 'modules/rss_modules/repository/'. preg_replace("/[^A-za-z0-9]/","",$r['title']);

      require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.rss.php");
      $rss = new _cal_rss();
      $rss->get($r);

      echo("<div align='center'>"._UPDATED_."</div>");

      break;


   ## DELETE AN RSS FEED
   ######################
   case _DELETE_:

        if($_REQUEST['really_delete']) {

           # DELETE CALENDAR
           ###################
           $_cal_sql->query("delete from {$_cal_dbpref}RSSModule
                where id = ". $_cal_sql->escape_string($_REQUEST['rssid']));
           break;

        }

        require_once(_CAL_BASE_PATH_."include/ask_delete.php");

        # get feed title
        list($t) = $_cal_sql->query("select title from {$_cal_dbpref}RSSModule where id = ". 
            $_cal_sql->escape_string($_REQUEST['rssid']));


         $form = new _cal_form();
         $form->print_header();
         echo($form->fromRequest('rssid'));
         echo($form->fromRequest("module"));
         $form->print_hidden('really_delete', 1);

         _ex_ask_delete(_ARE_YOU_SURE_DELETE_RSSMOD_, $t['title'], $form, 'rss_action');
 
         $form->print_footer();

      return;

}

?>
<br><br>
<?php

# generate list of users..
require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.url.php");


require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.sort_table.php");

$_cal_sort = new _cal_sort_table();

$_cal_sort->all = true;
#######################
#
### CHARACTER LIST
#
#######################
$feeds = $_cal_sql->query("select distinct lower(".$_cal_sql->functions['substr']."(title, 1,1)) as u, '1'
    from {$_cal_dbpref}RSSModule",1);


$_cal_sort->chars = $feeds;
$_cal_sort->persistent['module'] = 'rss_modules';
$_cal_sort->print_table();

#####################
#
### GET FEED LIST
#
#####################
if($_SESSION['cal_char']) {

   $feeds = $_cal_sql->query("select id, title, description from {$_cal_dbpref}RSSModule where
    lower(title) like '". ($_SESSION['cal_char'] == _ALL_ ? "" : strtolower($_SESSION['cal_char']))
    ."%' order by title");
  
 
} else {

   $feeds = array();

}

?>

<br><br>
<?php

$form = new _cal_form('rssfrm');
$form->print_header();
$form->print_hidden("module");
$form->print_hidden("rssid","");
$form->print_hidden("rss_action","");

require_once(@constant("_CAL_BASE_PATH_") ."include/classes/class.table.php");

$_cal_table = new _cal_table();

$_cal_table->print_header(array(_TITLE_,_DESCRIPTION_,""));

##########
#
## NEW FEED
#
#######################
     
$_cal_table->print_row(
    array(
       $form->textbox('ntitle', 20, " maxlength=32"),
       $form->textbox('ndescription', 64, " maxlength=255"),
       $form->submit('feed_action',_ADD_)
    )
);


     #######################
     #
     ### FEED LIST
     #
     #######################
     
     foreach($feeds as $f)
     {


        $_cal_table->print_row(
           array(
              @htmlspecialchars($f['title'], ENT_QUOTES, _CHARSET_),
              @htmlspecialchars($f['description'], ENT_QUOTES, _CHARSET_),
              "<input type=button class='"._CAL_CSS_BUTTON_."' value='". _EDIT_ ."'
                    onClick='edit_feed(". $f['id'] .")'>
               <input type=button class='"._CAL_CSS_BUTTON_."' value='". _DELETE_ ."'
                onClick='delete_feed(". $f['id'] .")'>
           ")

        );

     }


$_cal_table->print_footer();

$form->print_footer();

?>
<br><br>
<script language='javascript' type='text/javascript'>
<!--

var rssfrm = document.forms['<?php echo($form->name) ?>'].elements;

function edit_feed(rid)
{

   rssfrm['rssid'].value = rid;
   rssfrm['rss_action'].value = '<?php echo(_EDIT_) ?>';
   document.forms['<?php echo($form->name) ?>'].submit();
}

function delete_feed(rid)
{

   rssfrm['rssid'].value = rid;
   rssfrm['rss_action'].value = '<?php echo(_DELETE_) ?>';
   document.forms['<?php echo($form->name) ?>'].submit();


}
-->
</script>
