<?php

   $BASE_PATH = preg_replace("modules.rss_modules$/","",dirname(__FILE__));

   define("_CAL_BASE_PATH_", $BASE_PATH);

   require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");

   global $_cal_feeds, $_cal_sql;


   $_cal_sql or $_cal_sql = new _cal_sql();

   # GET LIST OF RSS MODULES
   ##############################
   $rssmods = $_cal_sql->query("select title, url, upd_interval,
	username, password from {$GLOBALS['_cal_dbpref']}RSSModule");

   foreach($rssmods as $rsm)
   {

      if(!trim($rsm['url'])) continue;
   
      $_cal_feeds[$rsm['title']]['urls'] = array($rsm['url']);
      $_cal_feeds[$rsm['title']]['title'] = $rsm['title'];
      $_cal_feeds[$rsm['title']]['username'] = $rsm['username'];
      $_cal_feeds[$rsm['title']]['password'] = $rsm['password'];
      $_cal_feeds[$rsm['title']]['interval'] = max($rsm['upd_interval'], 20);
      $_cal_feeds[$rsm['title']]['repository'] = 'modules/rss_modules/repository/'. preg_replace("/[^A-za-z0-9]/","",$rsm['title']);


   }


?>
