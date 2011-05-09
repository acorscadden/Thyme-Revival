<?php


if(@constant("_CAL_NO_JOBS_")) return;

require_once(_CAL_BASE_PATH_."include/http_get.php");

if(!_ex_http_get(-1)) return;

global $_cal_modules, $_cal_sql, $_cal_user;

# register our module name
###########################
$_cal_modules['rss_modules']['no_guest'] = 1;

$_cal_modules['rss_modules']['include'] = "rss_modules/rss_admin.php";

$_cal_modules['rss_modules']['display_name'] = _RSS_FEED_MODULES_;

$_cal_modules['rss_modules']['parents'] = array('admin');

$_cal_modules['rss_modules']['priority'] = 1000;

$_cal_modules['rss_modules']['hide_nav'] = 1;

$_cal_modules['rss_modules']['icon'] = 'rssmodules.png';

$_cal_modules['rss_modules']['thyme_only'] = 1;

# get configured RSS feeds
##########################

$rssfeeds = $_cal_sql->query("select * from {$GLOBALS['_cal_dbpref']}RSSModule");

foreach($rssfeeds as $r)
{

   $fname = preg_replace("/[^A-Za-z0-9]/","",$r['title']);
   $filename = preg_replace("/.*\//", "", $r['url']);
   if(!$filename) $filename = 'default.xml';
   else $filename = preg_replace("/[^A-Za-z0-9\.]/", "_", $filename);


   $_cal_modules[$fname]['navbar'] = 'rss_modules/navbar.php';
   $_cal_modules[$fname]['callback'] = '_ex_rss_block("'.$r['title'] .'","'.$fname.'/'.$filename .'","'.
		$r['style'] .'",'.intval($r['scrolling']).');'; #/'.$fname.'/'.$filename;
   $_cal_modules[$fname]['display_name'] = $r['title'];
   $_cal_modules[$fname]['parents'] = array('navbar');
   $_cal_modules[$fname]['description'] = $r['description'];
   $_cal_modules['navbar']['sub_modules'][] = $fname;

}


?>
