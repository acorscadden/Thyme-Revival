<?php



  function export_header_html ()
  {
    global $_cal_user;
    _ex_theme_set ($_cal_user->options->theme);
    echo '<html>
<head>
<title></title>
';
    echo '<style type=\'text/css\'>
';
    foreach (file (@constant ('_CAL_BASE_PATH_') . 'themes/' . $_cal_user->options->theme . '/style/style.css') as $line)
    {
      echo str_replace ('#cal ', '', $line);
    }

    echo '</style>
';
    echo '</head>
<body class=\'' . _CAL_CSS_CAL_ . '\'>
';
    if (@constant ('_CAL_INSIDE_JOB_'))
    {
      @include _CAL_BASE_PATH_ . 'customize/email_header.php';
    }

    echo '<div id=\'cal\'>
';
  }

  function export_footer_html ()
  {
    echo '
</div>';
    if (@constant ('_CAL_INSIDE_JOB_'))
    {
      @include _CAL_BASE_PATH_ . 'customize/email_footer.php';
    }

    echo '
</body>
</html>
';
    _ex_theme_restore ();
  }

  function export_event_html ($eid, $instance = null)
  {
    global $_cal_user;
    global $_cal_html;
    global $_cal_sql;
    global $_cal_form;
    global $_cal_event;
    global $_cal_tmpl;
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
    include @constant ('_CAL_BASE_PATH_') . 'include/templates/event_view_tpl.php';
    $_cal_tmpl->print_footer ();
    echo '<br><br>';
  }

  global $_cal_user;
  global $_cal_sql;
  global $_cal_html;
  global $_cal_form;
  global $_cal_tmpl;
  $BASE_PATH = preg_replace ('' . '/modules.sync.export.html$/', '', dirname (__FILE__));
  define ('_CAL_BASE_PATH_', $BASE_PATH);
  define ('_CAL_USE_SESSION_', 1);
  define ('_CAL_DOING_EMAIL_', 1);
  define ('_CAL_BENCHMARK_', 0);
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.html.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.template.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.form.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.request.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/theme_engine.php';
  $_cal_tmpl = new _cal_template ('event_view_template');
  $_cal_form = new _cal_form ();
?>