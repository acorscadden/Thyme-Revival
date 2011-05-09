<?php



  function import_cal ()
  {
    global $_cur_cal;
    global $_cal_user;
    global $_cal_html;
    global $_cal_sql;
    $_SESSION['calendar'] = $_REQUEST['calendar'];
    $putdata = fopen ('php://input', 'r');
    $fn = tempnam ('/tmp', 'thyme-');
    $fp = fopen ($fn, 'w');
    while ($data = fread ($putdata, 1024))
    {
      fwrite ($fp, $data);
    }

    fclose ($putdata);
    require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.vcal.php';
    $vc = new _cal_vCal ();
    $vc->read_vcal ($fn);
    if (!$_REQUEST['duplicates'])
    {
      $_REQUEST['duplicates'] = 1;
    }

    if (!$_REQUEST['locale'])
    {
      $_REQUEST['locale'] = 2;
    }

    require_once @constant ('_CAL_BASE_PATH_') . 'modules/sync/import/ical/import_ical.php';
    if (!_WINDATES_)
    {
      header ('HTTP/1.1 201 Created');
    }

    header ('Connection: close');
  }

  function export_cal ()
  {
    global $_cur_cal;
    global $_cal_user;
    global $_cal_html;
    global $_cal_sql;
    global $_cal_dbpref;
    $_SESSION['calendar'] = $_REQUEST['calendar'];
    require_once @constant ('_CAL_BASE_PATH_') . 'modules/sync/export/ical/export_ical.php';
    header ('Content-Type: text/calendar');
    header ('Content-Disposition: attachment; filename="' . $_cur_cal->title . '.ics"');
    header ('Last-Modified: ' . gmdate ('D, d M Y H:i:s') . ' GMT');
    header ('Cache-Control: must-revalidate, post-check=0, pre-check=0', true);
    header ('Pragma: no-cache');
    $etypes = 0;
    if ($_REQUEST['event_types'])
    {
      $etypes = intval ($_REQUEST['event_types']);
    }
    else
    {
      if ($_REQUEST['category'])
      {
        $cat = $_cal_sql->query ('' . 'select name, id from ' . $_cal_dbpref . 'EventTypes
		where calendar = ' . $_cur_cal->id . '
		and lower(name)
		 like \'' . strtolower ($_cal_sql->escape_string ($_REQUEST['category'])) . '\'');
        $etypes = intval ($cat[0]['id']);
      }
    }

    ical_export_calendar ($_REQUEST['calendar'], $etypes);
  }

  function dav_props ($url)
  {
    header ('HTTP/1.1 207 Multi-Status');
    header ('Content-Type: text/xml');
    echo '
<?xml version="1.0"?>
<a:multistatus xmlns:a="DAV:">
 <a:response>
   <a:href>' . $url . '</a:href>
   <a:propstat>
    <a:prop>
       <a:supportedlock>
          <a:lockentry>
             <a:lockscope><a:local/></a:lockscope>
             <a:locktype>
                <a:transaction><a:local/></a:transaction>
             </a:locktype>
          </a:lockentry>
          <a:lockentry>
             <a:lockscope><a:shared/></a:lockscope>
             <a:locktype><a:write/></a:locktype>
          </a:lockentry>
       </a:supportedlock>
    </a:prop>
    <a:status>HTTP/1.1 200 OK</a:status>
   </a:propstat>
 </a:response>
</a:multistatus>

';
  }

  error_reporting (E_ALL & ~E_NOTICE);
  if ($_REQUEST['auth'])
  {
    $_REQUEST['auth'] = base64_decode ($_REQUEST['auth']);
    $_SERVER['PHP_AUTH_USER'] = substr ($_REQUEST['auth'], 0, strpos ($_REQUEST['auth'], ':'));
    $_SERVER['PHP_AUTH_PW'] = substr ($_REQUEST['auth'], strlen ($_SERVER['PHP_AUTH_USER']) + 1);
  }

  define ('_WINDATES_', ($_SERVER['HTTP_USER_AGENT'] == 'WinDates' OR preg_match ('/DAVKit\\/2.0/', $_SERVER['HTTP_USER_AGENT'])));
  if ($_SERVER['REQUEST_METHOD'] == 'PROPFIND')
  {
    dav_props ($_SERVER['REQUEST_URI']);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
  {
    header ('HTTP/1.1 200 OK');
    header ('Allow: GET, HEAD, POST, PUT');
    exit ();
  }

  define ('_CAL_USE_SESSION_', 0);
  $BASE_PATH = preg_replace ('/remote/', '', preg_replace ('/\\\\/', '/', dirname (__FILE__)));
  define ('_CAL_BASE_PATH_', $BASE_PATH);
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.html.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql.php';
  global $_cal_user;
  global $_cal_html;
  global $_cur_cal;
  global $_cal_sql;
  if (!$_REQUEST['calendar'])
  {
    if (!$_SERVER['QUERY_STRING'])
    {
      $_REQUEST['calendar'] = preg_replace ('/.*remote\\/ical.php\\/(\\d+)\\/.*/', '\\1', $_SERVER['REQUEST_URI']);
    }
    else
    {
      $_REQUEST['calendar'] = preg_replace ('/^\\/(\\d+)\\/.*/', '\\1', $_SERVER['QUERY_STRING']);
    }
  }

  $h = new _cal_html (true);
  if (!$_SERVER['PHP_AUTH_USER'])
  {
    $_cal_user = new _cal_user ();
  }
  else
  {
    $_cal_user = new _cal_user ($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
  }

  if ($_REQUEST['calendar'])
  {
    require_once _CAL_BASE_PATH_ . 'include/classes/class.cal_obj.php';
    $_cur_cal = new _cal_obj ($_REQUEST['calendar']);
  }
  else
  {
    header ('HTTP/1.1 500');
    echo 'No calendar selected.';
    exit ();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'PUT')
  {
    if (($_cur_cal->id < 1 OR !($_cur_cal->options & 4)))
    {
      $ua = false;
    }
    else
    {
      $ua = $_cal_user->access->can_add ($_cur_cal);
    }
  }
  else
  {
    $ua = $_cal_user->access->can_view ($_cur_cal);
  }

  if (((!$_REQUEST['calendar'] OR !$ua) OR !$_cal_user->login ()))
  {
    header ('WWW-Authenticate: Basic realm="' . $_cur_cal->title . ' ' . $_cal_user->login () . '"');
    header ('Status: 401 Access Denied');
    header ('HTTP/1.0 401 Unauthorized');
    echo 'You must enter a valid login ID and password to access this resource.
';
    exit ();
  }

  define ('_CAL_FULL_SYNC_', $_cal_user->access->can_admin ($_cur_cal));
  if ($_SERVER['REQUEST_METHOD'] == 'PUT')
  {
    import_cal ();
    return 1;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    export_cal ();
  }

?>