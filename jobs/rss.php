<?php



  $now = time ();
  $now -= $now % 60;
  define ('_CAL_BASE_PATH_', preg_replace ('' . '/jobs$/', '', preg_replace ('/\\\\/', '/', dirname (__FILE__))));
  define ('_CAL_USE_SESSION_', 0);
  define ('_CAL_BENCHMARK_', 0);
  global $_cal_sql;
  require_once _CAL_BASE_PATH_ . 'include/config.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.rss.php';
  if (!@constant ('_CAL_JOB_INTERVAL_'))
  {
    define ('_CAL_JOB_INTERVAL_', 5);
  }

  $r = new _cal_rss ();
  $r->get_all ();
?>
