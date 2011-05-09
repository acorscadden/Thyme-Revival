<?php

   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.rss_modules$/","",dirname(__FILE__));

   define("_CAL_BASE_PATH_", $BASE_PATH);
   define("_CAL_USE_SESSION_", 1);
   define("_CAL_BENCHMARK_", 0);

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.rss.php");

   global $_cal_sql, $_cal_user, $_cal_html;

   $_cal_html = new _cal_html();

   $_cal_html->print_header(_TEST_);


   $f['title'] = _TEST_;
   $f['urls'] = array($_REQUEST['url']);
   $f['username'] = $_REQUEST['fu'];
   $f['password'] = $_REQUEST['fp'];
   $f['repository'] = 'modules/rss_modules/repository/thyme_rss_'.md5($_REQUEST['url']);


   echo("<h4 align='center'>". _TEST_."</h4>\n");  

   $rss = new _cal_rss();

   if($rss->get($f)) {

      echo("<center><br><b><font color=green>"._OK_."</font></b><hr>");

   } else {

       echo("<center><br><b><font color=red>"._FAILED_."</font></b><hr>");
   }

?>
<input type=button onClick='self.close()' value='<?php echo(_CLOSE_) ?>'>
<?php

$_cal_html->print_footer();

?>
