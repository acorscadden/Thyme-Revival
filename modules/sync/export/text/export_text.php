<?php



  function export_header_text ()
  {
  }

  function export_footer_text ()
  {
  }

  function export_event_text ($eid, $instance = null)
  {
    global $_cal_user;
    global $_cal_html;
    global $_cal_sql;
    global $_cal_form;
    global $_cal_event;
    if ($eid < 0)
    {
      $_cal_event = new _cal_request (abs ($eid));
    }
    else
    {
      $_cal_event = new _cal_event ($eid);
    }

    $_REQUEST['eid'] = $eid;
    $_REQUEST['instance'] = $instance;
    include @constant ('_CAL_BASE_PATH_') . 'include/templates/event_view_text_tpl.php';
    echo '
';
  }

  $BASE_PATH = preg_replace ('' . '/modules.sync.export.text$/', '', dirname (__FILE__));
  define ('_CAL_BASE_PATH_', $BASE_PATH);
  define ('_CAL_USE_SESSION_', 1);
  define ('_CAL_DOING_EMAIL_', 1);
  define ('_CAL_BENCHMARK_', 0);
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.html.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.template.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.form.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.request.php';
?>