<?php



  function ical_print_us_tz ($std_offset, $id, $dst = true)
  {
    $std_offset_to = $std_offset;
    list ($hr, $min) = explode ('.', number_format ($std_offset_to, 1));
    $min = ($min == 5 ? '30' : '00');
    if (intval ($hr) < 0)
    {
      $hr = abs ($hr);
      if ($hr < 10)
      {
        $hr = '0' . $hr;
      }

      $hr = '-' . $hr;
    }
    else
    {
      $hr = abs ($hr);
      if ($hr < 10)
      {
        $hr = '0' . $hr;
      }

      $hr = '+' . $hr;
    }

    $std_offset_to = $hr . $min;
    $hr = intval ($hr) + 1;
    if (intval ($hr) < 0)
    {
      $hr = abs ($hr);
      if ($hr < 10)
      {
        $hr = '0' . $hr;
      }

      $hr = '-' . $hr;
    }
    else
    {
      $hr = abs ($hr);
      if ($hr < 10)
      {
        $hr = '0' . $hr;
      }

      $hr = '+' . $hr;
    }

    $std_offset_from = $hr . $min;
    echo '' . 'BEGIN:VTIMEZONE
TZID:' . $id . '
BEGIN:STANDARD
DTSTART:20001029T020000
RRULE:FREQ=YEARLY;UNTIL=20061029T070000Z;BYDAY=-1SU;BYMONTH=10
TZNAME:' . $id . ' Standard
TZOFFSETFROM:' . $std_offset_from . '
TZOFFSETTO:' . $std_offset_to . '
END:STANDARD
BEGIN:STANDARD
DTSTART:20071104T020000
RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11
TZNAME:' . $id . ' Standard
TZOFFSETFROM:' . $std_offset_from . '
TZOFFSETTO:' . $std_offset_to . '
END:STANDARD
' . ($dst ? '' . 'BEGIN:DAYLIGHT
DTSTART:20000402T020000
RRULE:FREQ=YEARLY;UNTIL=20060402T070000Z;BYDAY=1SU;BYMONTH=4
TZNAME:' . $id . ' Daylight
TZOFFSETFROM:' . $std_offset_to . '
TZOFFSETTO:' . $std_offset_from . '
END:DAYLIGHT
BEGIN:DAYLIGHT
DTSTART:20070311T020000
RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3
TZNAME:' . $id . ' Daylight
TZOFFSETFROM:' . $std_offset_to . '
TZOFFSETTO:' . $std_offset_from . '
END:DAYLIGHT
' : '') . 'END:VTIMEZONE
';
  }

  function ical_print_uk_tz ()
  {
    echo 'BEGIN:VTIMEZONE
TZID:Europe/London
BEGIN:STANDARD
DTSTART:20001029T020000
RRULE:FREQ=YEARLY;BYDAY=-1SU;BYMONTH=10
TZNAME:GMT Standard Time
TZOFFSETFROM:+0100
TZOFFSETTO:+0000
END:STANDARD
BEGIN:DAYLIGHT
DTSTART:20000326T010000
RRULE:FREQ=YEARLY;BYDAY=-1SU;BYMONTH=3
TZNAME:GMT Daylight Time
TZOFFSETFROM:+0000
TZOFFSETTO:+0100
END:DAYLIGHT
END:VTIMEZONE
';
  }

  function ical_print_eu_tz ()
  {
    echo 'BEGIN:VTIMEZONE
TZID:Europe/Amsterdam
BEGIN:STANDARD
DTSTART:16011028T030000
RRULE:FREQ=YEARLY;BYDAY=-1SU;BYMONTH=10
TZOFFSETFROM:+0200
TZOFFSETTO:+0100
END:STANDARD
BEGIN:DAYLIGHT
DTSTART:16010325T020000
RRULE:FREQ=YEARLY;BYDAY=-1SU;BYMONTH=3
TZOFFSETFROM:+0100
TZOFFSETTO:+0200
END:DAYLIGHT
END:VTIMEZONE
';
  }

  function ical_escape ($str)
  {
    $find = array (',', ';', ':', '=');
    $rep = array ('\\,', '\\;', '\\:', '\\=');
    return str_replace ($find, $rep, $str);
  }

  function ical_format_notes ($str)
  {
    $find = array (',', ';', '\'', '
', '
', '
');
    $rep = array ('\\,', '\\;', '\'\'', '\\n', '\\n', '\\n');
    if (@constant ('_CAL_NO_ICAL_HTML_'))
    {
      $str = @html_entity_decode (@strip_tags (@preg_replace ('/<br ?\\/?>\\n?/i', '
', $str)), ENT_QUOTES, _CHARSET_);
    }

    return str_replace ($find, $rep, $str);
  }

  function ical_fold ($str)
  {
    if (strlen ($str) < 75)
    {
      return $str . CRLF;
    }

    return rtrim (chunk_split ($str, 75, CRLF . chr (32))) . CRLF;
  }

  function export_header_ical ()
  {
    global $_cal_sql;
    global $_cal_timezone_options;
    global $_cal_dbpref;
    global $_cur_cal;
    global $_cal_tzids;
    global $_cal_user;
    if (!$_cur_cal)
    {
      require_once _CAL_BASE_PATH_ . 'include/classes/class.cal_obj.php';
      $_cur_cal = new _cal_obj ($_SESSION['calendar']);
    }

    define ('_CAL_DOING_OPTS_', 1);
    include @constant ('_CAL_BASE_PATH_') . 'include/languages/' . constant ('_CAL_LANG_') . '.php';
    $i = 0;
    while ($i <= 12)
    {
      $_cal_timezone_options[number_format ($i, 1)] = ($_cal_tzids[number_format ($i, 1)] ? $_cal_tzids[number_format ($i, 1)] : 'GMT +' . number_format ($i, 1));
      $i += 0.5;
    }

    $i = 12;
    while (0 < $i)
    {
      $_cal_timezone_options['-' . number_format ($i, 1)] = ($_cal_tzids['-' . number_format ($i, 1)] ? $_cal_tzids['-' . number_format ($i, 1)] : 'GMT +' . number_format ($i, 1));
      $i -= 0.5;
    }

    echo 'BEGIN:VCALENDAR' . CRLF;
    echo 'VERSION:2.0' . CRLF;
    echo ical_fold ('PRODID:-//eXtrovert Software (www.extrosoft.com)//Thyme//' . strtoupper (_CAL_LANG_));
    if (!$_REQUEST['eid'])
    {
      echo 'X-WR-CALNAME:' . ical_escape ($_cur_cal->title) . CRLF;
      if ($_cur_cal->description)
      {
        echo ical_fold ('X-WR-CALDESC:' . ical_escape ($_cur_cal->description));
      }
    }

    echo 'METHOD:PUBLISH' . CRLF;
    echo 'CALSCALE:GREGORIAN' . CRLF;
    if (@constant ('_CAL_ENABLE_TZ_'))
    {
      $tzs = $_cal_sql->query ('' . 'select distinct timezone, dst from ' . $_cal_dbpref . 'Events
              where (calendar ' . $_cur_cal->get_constraint () . '
              or (timezone = ' . $_cal_user->options->timezone . '
                and dst = ' . $_cal_user->options->dst . '))
              and starttime is not null', true);
    }
    else
    {
      $tzs = array ($_cal_user->options->timezone => $_cal_user->options->dst);
    }

    foreach (array_keys ($tzs) as $tz)
    {
      if ((($tzs[$tz] == 13 OR $tzs[$tz] == 18) OR ($tz < 0 - 5.5 AND 0 - 9 < $tz)))
      {
        ical_print_us_tz ($tz, $_cal_timezone_options[number_format ($tz, 1)], 0 - 1 < $tzs[$tz]);
        continue;
      }
      else
      {
        if (($tzs[$tz] == 11 AND intval ($tz == 1)))
        {
          ical_print_eu_tz ();
          continue;
        }
        else
        {
          if (($tzs[$tz] == 11 OR (intval ($tz) == 0 AND $tzs[$tz] == 0)))
          {
            ical_print_uk_tz ();
            continue;
          }
          else
          {
            $e->dst = $tzs[$tz];
            $e->timezone = number_format ($tz - ($e->dst == 0), 1);
            $e->dst_obj = new _cal_dst ($e->dst, true);
            echo 'BEGIN:VTIMEZONE' . CRLF;
            echo 'TZID:' . ical_escape ($_cal_timezone_options[$e->timezone]) . CRLF;
            echo 'BEGIN:STANDARD' . CRLF;
            if (0 < $e->dst)
            {
              echo 'DTSTART:' . _ex_date ('Ymd', $e->dst_obj->endtime) . 'T000000' . CRLF;
            }

            if (($e->timezone + 0 == 0 OR $e->timezone == '00'))
            {
              echo 'TZOFFSETTO:+0000' . CRLF;
            }
            else
            {
              echo 'TZOFFSETTO:' . ($e->timezone <= 0 ? '-' : '+') . (abs ($e->timezone) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone)) * 100 . CRLF;
            }

            echo 'TZOFFSETFROM:+0000' . CRLF;
            if ((0 < $e->dst AND false))
            {
              if (isset ($e->dst_obj->dst_end['byday']))
              {
                $bd = 'BYDAY=' . export_ical_bydayconv ($e->dst_obj->dst_end['byday']);
              }
              else
              {
                $bd = 'BYMONTHDAY=' . $e->dst_obj->dst_end['bymonthday'];
              }

              echo '' . 'RRULE:FREQ=YEARLY;INTERVAL=1;' . $bd . ';BYMONTH=' . $e->dst_obj->dst_end['bymonth'] . CRLF;
            }

            echo 'END:STANDARD' . CRLF;
            if (0 < $e->dst)
            {
              echo 'BEGIN:DAYLIGHT' . CRLF;
              if (count ($e->dst_obj->dst_start['byday']))
              {
                $bd = 'BYDAY=' . export_ical_bydayconv ($e->dst_obj->dst_start['byday']);
              }
              else
              {
                $bd = 'BYMONTHDAY=' . $e->dst_obj->dst_start['bymonthday'];
              }

              echo 'DTSTART:' . _ex_date ('Ymd', $e->dst_obj->starttime) . 'T000000' . CRLF;
              echo 'TZOFFSETTO:' . ($e->timezone + 1 < 0 ? '-' : '+') . (abs ($e->timezone + 1) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone + 1)) * 100 . CRLF;
              echo 'TZOFFSETFROM:' . ($e->timezone < 0 ? '-' : '+') . (abs ($e->timezone) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone)) * 100 . CRLF;
              echo '' . 'RRULE:FREQ=YEARLY;INTERVAL=1;' . $bd . ';BYMONTH=' . $e->dst_obj->dst_start['bymonth'] . CRLF;
              echo 'END:DAYLIGHT' . CRLF;
            }

            echo 'END:VTIMEZONE' . CRLF;
            continue;
          }

          continue;
        }

        continue;
      }
    }

  }

  function export_ical_bydayconv ($bd)
  {
    global $_cal_vcal_wdays;
    if (1 < strlen ($bd))
    {
      $d = preg_replace ('' . '/^(\\-*\\d)(\\d)$/', '\\2', $bd);
      $b = substr ($bd, 0, strlen ($bd) - 1);
    }
    else
    {
      $d = $bd;
    }

    $d = $_cal_vcal_wdays[$d];
    return $b . $d;
  }

  function export_footer_ical ()
  {
    echo 'END:VCALENDAR' . CRLF;
  }

  function export_event_ical ($eid, $instance = null, $orride = false, $method = null, $parent_start = null)
  {
    global $_cal_user;
    global $_cal_timezone_options;
    global $_cal_sql;
    global $_cal_dst_config_cache;
    global $_cal_vcal_wdays;
    global $_cal_dbpref;
    if ($eid < 0)
    {
      $e = new _cal_request (abs ($eid));
    }
    else
    {
      $e = new _cal_event ($eid, $instance);
    }

    if (((!$instance AND !$orride) AND 0 < $e->override_id))
    {
      $e = new _cal_event ($e->override_id);
    }

    $e->parent_start = $parent_start;
    if (!@constant ('_CAL_ENABLE_TZ_'))
    {
      $e->timezone = $_cal_user->options->timezone;
      $e->dst = $_cal_user->options->dst;
      $e->use_tz = true;
    }
    else
    {
      $e->timezone = number_format ($e->timezone - ($e->dst == 0), 1);
    }

    if ((!$GLOBALS['_ical_header'] AND false))
    {
      if ((!$e->allday AND $e->use_tz))
      {
        $tzs = $_cal_sql->query ('' . 'select distinct timezone, dst from ' . $_cal_dbpref . 'Events
              where (id = ' . $e->id . ' or override_id = ' . $e->id . ')
              and starttime is not null', true);
        foreach (array_keys ($tzs) as $tz)
        {
          $e->dst = $tzs[$tz];
          $e->timezone = number_format ($tz, 1);
          $e->dst_obj = new _cal_dst ($e->dst, true);
          echo 'BEGIN:VTIMEZONE' . CRLF;
          echo 'TZID:' . ical_escape ($_cal_timezone_options[$e->timezone]) . CRLF;
          echo 'BEGIN:STANDARD' . CRLF;
          if (0 < $e->dst)
          {
            echo 'DTSTART:1971' . _ex_date ('md', $e->dst_obj->endtime) . 'T000000' . CRLF;
          }

          if (($e->timezone + 0 == 0 OR $e->timezone == '00'))
          {
            echo 'TZOFFSETTO:+0000' . CRLF;
          }
          else
          {
            echo 'TZOFFSETTO:' . ($e->timezone <= 0 ? '-' : '+') . (abs ($e->timezone) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone)) * 100 . CRLF;
          }

          echo 'TZOFFSETFROM:+0000' . CRLF;
          if (0 < $e->dst)
          {
            if (isset ($e->dst_obj->dst_end['byday']))
            {
              $bd = 'BYDAY=' . export_ical_bydayconv ($e->dst_obj->dst_end['byday']);
            }
            else
            {
              $bd = 'BYMONTHDAY=' . $e->dst_obj->dst_end['bymonthday'];
            }

            echo '' . 'RRULE:FREQ=YEARLY;INTERVAL=1;' . $bd . ';BYMONTH=' . $e->dst_obj->dst_end['bymonth'] . CRLF;
          }

          echo 'END:STANDARD' . CRLF;
          if (0 < $e->dst)
          {
            echo 'BEGIN:DAYLIGHT' . CRLF;
            if (count ($e->dst_obj->dst_start['byday']))
            {
              $bd = 'BYDAY=' . export_ical_bydayconv ($e->dst_obj->dst_start['byday']);
            }
            else
            {
              $bd = 'BYMONTHDAY=' . $e->dst_obj->dst_start['bymonthday'];
            }

            echo 'DTSTART:1971' . _ex_date ('md', $e->dst_obj->starttime) . 'T000000' . CRLF;
            echo 'TZOFFSETTO:' . ($e->timezone + 1 < 0 ? '-' : '+') . (abs ($e->timezone + 1) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone + 1)) * 100 . CRLF;
            echo 'TZOFFSETFROM:' . ($e->timezone < 0 ? '-' : '+') . (abs ($e->timezone) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone)) * 100 . CRLF;
            echo '' . 'RRULE:FREQ=YEARLY;INTERVAL=1;' . $bd . ';BYMONTH=' . $e->dst_obj->dst_start['bymonth'] . CRLF;
            echo 'END:DAYLIGHT' . CRLF;
          }

          echo 'END:VTIMEZONE' . CRLF;
        }
      }

      $GLOBALS['_ical_header'] = 1;
    }

    if ((!$instance AND !$e->override_id))
    {
      $exes = $_cal_sql->query ('' . 'select id, exdate from
           ' . $_cal_dbpref . 'Exceptions where eid = ' . $e->id, true);
      $exes2 = array ();
      foreach ($exes as $ex)
      {
        $ex = $ex - $ex % 86400 + $e->starttime % 86400;
        $exes2[] = _ex_ical_tzid_date ('EXDATE', $ex, ical_escape ($_cal_timezone_options[$e->timezone]));
      }

      $exes = $exes2;
      unset ($exes2);
    }

    if (!$or_starttime)
    {
      $or_starttime = _ex_date ('Hi00', $e->start);
    }

    $e->timezone = number_format ($e->timezone, 1);
    echo 'BEGIN:VEVENT' . CRLF;
    echo 'SUMMARY:' . $e->title . CRLF;
    echo 'X-TH-EID:' . $e->id . CRLF;
    if ((0 < $e->freq AND !$instance))
    {
      $rrule = 'RRULE:FREQ=';
      switch ($e->freq)
      {
        case 2:
        {
          $rrule .= 'MONTHLY';
          break;
        }

        case 3:
        {
          $rrule .= 'WEEKLY';
          break;
        }

        case 4:
        {
          $rrule .= 'DAILY';
          break;
        }

        default:
        {
          $rrule .= 'YEARLY';
          break;
        }
      }

      $rrule .= ';INTERVAL=' . ($e->freq != 5 ? $e->finterval : '1');
      if (((((((@constant ('_CAL_OUTLOOK_ICAL_FIX_') AND $e->freq == 2) AND !$e->bymonthday) AND !strpos ($e->byday, ',')) AND !$e->bymonth) AND preg_match ('/\\d/', $e->byday)) AND !$e->setpos))
      {
        $spos = preg_replace ('' . '/^(\\-*\\d+)[A-Z]+$/', '\\1', $e->byday);
        $byday = substr ($e->byday, strlen ($spos), strlen ($e->byday));
        $rrule .= '' . ';BYDAY=' . $byday . ';BYSETPOS=' . $spos;
      }
      else
      {
        if ($e->byday)
        {
          $rrule .= ';BYDAY=' . $e->byday;
        }

        if ($e->bymonthday)
        {
          $rrule .= ';BYMONTHDAY=' . $e->bymonthday;
        }

        if ($e->bymonth)
        {
          $rrule .= ';BYMONTH=' . $e->bymonth;
        }

        if ($e->bysetpos)
        {
          $rrule .= ';BYSETPOS=' . $e->bysetpos;
        }

        if ($e->freq == 1)
        {
          $rrule .= ';WKST=' . $_cal_vcal_wdays[intval ($e->wkst)];
        }
      }

      if (!$e->allday)
      {
        $end_date_time = $e->end + $e->ends_at % 86400 - $e->timezone * 3600;
      }
      else
      {
        $end_date_time = $e->end;
      }

      if ($e->end_after)
      {
        $rrule .= ';COUNT=' . $e->end_after;
      }
      else
      {
        if ($e->end)
        {
          $rrule .= ';UNTIL=' . _ex_date ('Ymd\\THis\\Z', $end_date_time);
        }
      }

      echo ical_fold ($rrule);
    }

    if (($e->freq == 5 AND !$instance))
    {
      echo 'X-WD-RECUR-EASTER:TRUE' . CRLF;
      echo 'X-WD-RECUR-OFFSET:' . $e->finterval . CRLF;
    }

    if ((($GLOBALS['ms_quirks'] AND !$instance) AND !$e->override_id))
    {
      $orrides = $_cal_sql->query ('' . 'select starttime as start, override_date as ostart
            from ' . $_cal_dbpref . 'Events where override_id = ' . $e->id . ' order by start');
      if (count ($orrides))
      {
        $rdates = 'RDATE:';
        $odates = array ();
        foreach ($orrides as $oid)
        {
          $odates[] = _ex_date ('Ymd\\THi00\\Z', $oid['start']);
          if ($oid['ostart'])
          {
            $exes[] = _ex_date ('Ymd\\T000000\\Z', $oid['ostart']);
            continue;
          }
        }

        $rdates .= join (',', $odates);
        echo ical_fold ($rdates);
      }
    }

    if ((count ($exes) AND !$instance))
    {
      echo join ('', $exes);
    }

    if (count ($e->attachments))
    {
      $url = new _cal_url ('download_attachment.php');
      require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.attachment_minimal.php';
      foreach ($e->attachments as $aid)
      {
        $a = new _cal_attachment_minimal ($aid['id']);
        $url->addArg ('aid', $aid['id']);
        $url->addArg ('f', $a->filename);
        if (strpos ($a->filename, '/') !== false)
        {
          $aurl = trim ($a->filename);
          $a->isurl;
          if (trim ($a->filetype) == '')
          {
            $a->filetype = 'link/url';
          }
        }

        echo ical_fold ('ATTACH;FMTTYPE=' . $a->filetype . ':' . ($a->isurl ? $aurl : $url->toString ()));
      }
    }

    echo 'SEQUENCE:' . $e->version . CRLF;
    if ($e->allday)
    {
      echo ical_fold ('DTSTART;VALUE=DATE:' . _ex_date ('Ymd', $e->start));
    }
    else
    {
      echo _ex_ical_tzid_date ('DTSTART', $e->start, $_cal_timezone_options[$e->timezone]);
    }

    if (!$e->allday)
    {
      echo _ex_ical_tzid_date ('DTEND', $e->ends_at, $_cal_timezone_options[$e->timezone]);
    }

    if ($e->type_name)
    {
      echo 'CATEGORIES:' . ical_fold (strtoupper (preg_replace ('/\\s*,\\s*/', ',', $e->type_name)));
    }

    if ($e->notes)
    {
      echo ical_fold ('DESCRIPTION:' . ical_format_notes ($e->notes));
    }

    if ($e->uid)
    {
      echo ical_fold ('UID:' . $e->uid);
    }
    else
    {
      echo 'UID:' . md5 ($uid) . '@thyme-' . $_SERVER['SERVER_NAME'] . CRLF;
    }

    if ((($e->override_id AND !$instance) AND !$GLOBALS['ms_quirks']))
    {
      $ord = $e->override_date - $e->override_date % 86400 + $e->parent_start % 86400;
      echo _ex_ical_tzid_date ('RECURRENCE-ID', $ord, $_cal_timezone_options[$e->timezone]);
    }

    echo 'DTSTAMP:' . _ex_date ('Ymd\\THis\\Z') . CRLF;
    echo 'CREATED:' . _ex_date ('Ymd\\THis\\Z', $e->added) . CRLF;
    echo 'LAST-MODIFIED:' . _ex_date ('Ymd\\THis\\Z', $e->updated) . CRLF;
    if ($e->org_email)
    {
      echo 'ORGANIZER;CN="' . str_replace ('"', '', $e->org_name) . '"';
      echo ':MAILTO:' . $e->org_email;
      echo CRLF;
      echo 'CONTACT;CN="' . str_replace ('"', '', $e->org_name) . '"';
      echo ':MAILTO:' . $e->org_email;
      echo CRLF;
    }

    if ($e->url)
    {
      echo ical_fold ('URL;VALUE=URI:' . $e->url);
    }

    if ($e->flag)
    {
      echo 'PRIORITY:4' . CRLF;
    }

    if ($e->icon)
    {
      echo ical_fold ('X-WR-ICON:' . $e->icon);
    }

    if (@constant ('_CAL_LOCATIONS_MOD_'))
    {
      if ($e->location_name)
      {
        echo ical_fold ('LOCATION:' . ical_escape ($e->location_name));
      }
    }
    else
    {
      if ($e->location)
      {
        echo ical_fold ('LOCATION:' . ical_escape ($e->location));
      }
    }

    if ($e->addr_st)
    {
      echo ical_fold ('X-WR-ADDR-ST:' . ical_escape ($e->addr_st));
    }

    if ($e->addr_ci)
    {
      echo ical_fold ('X-WR-ADDR-CI:' . ical_escape ($e->addr_ci));
    }

    if ($e->phone)
    {
      echo ical_fold ('X-WR-PHONE:' . ical_escape ($e->phone));
    }

    echo 'END:VEVENT' . CRLF;
    if (((!$e->override_id AND !$instance) AND !$GLOBALS['ms_quirks']))
    {
      $ors = $_cal_sql->query ('' . 'select id from ' . $_cal_dbpref . 'Events where override_id = ' . $e->id);
      foreach ($ors as $or)
      {
        export_event_ical ($or['id'], false, true, null, $e->starttime);
      }
    }

  }

  function ical_export_calendar ($cal, $event_types = null)
  {
    global $_cal_user;
    global $_cal_timezone_options;
    global $_cal_sql;
    global $_cal_dst_config_cache;
    global $_cal_vcal_wdays;
    global $_cur_cal;
    global $_cal_dbpref;
    global $_cal_tzids;
    if (!$_cur_cal)
    {
      require_once _CAL_BASE_PATH_ . 'include/classes/class.cal_obj.php';
      $_cur_cal = new _cal_obj ($cal);
    }

    export_header_ical ();
    $constraint = $_cur_cal->get_constraint ();
    $constraint .= (0 < $event_types ? 'and (' . $_cal_sql->sql_binary_and ('etype', $event_types) . ' >= 1)' : '');
    $events = $_cal_sql->query ('' . 'select id from ' . $_cal_dbpref . 'Events where calendar ' . $constraint . ' and
    (override_id = 0 or override_id is null)');
    $tzs = array ();
    foreach (array_keys ($tzs) as $tz)
    {
      $e->dst = $tzs[$tz];
      $e->timezone = number_format ($tz - ($e->dst == 0), 1);
      $e->dst_obj = new _cal_dst ($e->dst, true);
      echo 'BEGIN:VTIMEZONE' . CRLF;
      echo 'TZID:' . ical_escape ($_cal_timezone_options[$e->timezone]) . CRLF;
      echo 'BEGIN:STANDARD' . CRLF;
      if (0 < $e->dst)
      {
        echo 'DTSTART:1971' . _ex_date ('md', $e->dst_obj->endtime) . 'T000000' . CRLF;
      }

      if (($e->timezone + 0 == 0 OR $e->timezone == '00'))
      {
        echo 'TZOFFSETTO:+0000' . CRLF;
      }
      else
      {
        echo 'TZOFFSETTO:' . ($e->timezone <= 0 ? '-' : '+') . (abs ($e->timezone) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone)) * 100 . CRLF;
      }

      echo 'TZOFFSETFROM:+0000' . CRLF;
      if (0 < $e->dst)
      {
        if (isset ($e->dst_obj->dst_end['byday']))
        {
          $bd = 'BYDAY=' . export_ical_bydayconv ($e->dst_obj->dst_end['byday']);
        }
        else
        {
          $bd = 'BYMONTHDAY=' . $e->dst_obj->dst_end['bymonthday'];
        }

        echo '' . 'RRULE:FREQ=YEARLY;INTERVAL=1;' . $bd . ';BYMONTH=' . $e->dst_obj->dst_end['bymonth'] . CRLF;
      }

      echo 'END:STANDARD' . CRLF;
      if (0 < $e->dst)
      {
        echo 'BEGIN:DAYLIGHT' . CRLF;
        if (count ($e->dst_obj->dst_start['byday']))
        {
          $bd = 'BYDAY=' . export_ical_bydayconv ($e->dst_obj->dst_start['byday']);
        }
        else
        {
          $bd = 'BYMONTHDAY=' . $e->dst_obj->dst_start['bymonthday'];
        }

        echo 'DTSTART:1971' . _ex_date ('md', $e->dst_obj->starttime) . 'T000000' . CRLF;
        echo 'TZOFFSETTO:' . ($e->timezone + 1 < 0 ? '-' : '+') . (abs ($e->timezone + 1) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone + 1)) * 100 . CRLF;
        echo 'TZOFFSETFROM:' . ($e->timezone < 0 ? '-' : '+') . (abs ($e->timezone) < 10 ? '0' : '') . str_replace ('.5', '.3', abs ($e->timezone)) * 100 . CRLF;
        echo '' . 'RRULE:FREQ=YEARLY;INTERVAL=1;' . $bd . ';BYMONTH=' . $e->dst_obj->dst_start['bymonth'] . CRLF;
        echo 'END:DAYLIGHT' . CRLF;
      }

      echo 'END:VTIMEZONE' . CRLF;
    }

    $GLOBALS['_ical_header'] = 1;
    foreach ($events as $e)
    {
      export_event_ical ($e['id']);
    }

    export_footer_ical ();
  }

  if ((function_exists ('ob_iconv_handler') AND strtolower (_CHARSET_) != 'utf-8'))
  {
    iconv_set_encoding ('internal_encoding', _CHARSET_);
    iconv_set_encoding ('output_encoding', 'UTF-8');
    ob_start ('ob_iconv_handler');
  }

  if (!function_exists ('_ex_ical_tzid_date'))
  {
    function _ex_ical_tzid_date ($head, $time, $tz = null)
    {
      if ($tz)
      {
        $head .= ';TZID=' . $tz . ':';
      }
      else
      {
        $head .= ':';
      }

      return ical_fold ($head . _ex_date ('Ymd\\THi00', $time) . ($tz ? '' : 'Z'));
    }
  }

  $BASE_PATH = preg_replace ('' . '/.modules.sync.export.ical$/', '', dirname (__FILE__)) . '/';
  define ('_CAL_BASE_PATH_', $BASE_PATH);
  define ('_CAL_USE_SESSION_', 1);
  define ('_CAL_DOING_EMAIL_', 1);
  define ('_CAL_BENCHMARK_', 0);
  define ('CRLF', chr (13) . chr (10));
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.request.php';
  global $_cal_tzids;
  $_cal_tzids = array ('-1.0' => 'Atlantic/Cape_Verde', '-10.0' => 'Pacific/Honolulu', '-11.0' => 'Pacific/Niue', '-2.5' => 'America/St_Johns', '-2.0' => 'Atlantic/South_Georgia', '-3.0' => 'Antarctica/Rothera', '-4.0' => 'Antarctica/Palmer', '-5.0' => 'US/Eastern', '-6.0' => 'US/Central', '-7.0' => 'US/Mountain', '-8.0' => 'US/Pacific', '-9.5' => 'Pacific/Marquesas', '-9.0' => 'Pacific/Gambier', '0.0' => 'Europe/London', '1.0' => 'Europe/Amsterdam', '10.0' => 'Australia/Melbourne', '10.5' => 'Australia/Lord_Howe', '11.0' => 'Pacific/Guadalcanal', '11.5' => 'Pacific/Norfolk', '12.0' => 'Antarctica/McMurdo', '13.0' => 'Pacific/Enderbury', '14.0' => 'Pacific/Kiritimati', '2.0' => 'Europe/Copenhagen', '3.0' => 'Antarctica/Syowa', '3.5' => 'Asia/Tehran', '4.0' => 'Europe/Moscow', '4.5' => 'Asia/Kabul', '5.0' => 'Europe/Samara', '5.5' => 'Asia/Calcutta', '6.0' => 'Antarctica/Vostok', '6.5' => 'Indian/Cocos', '7.0' => 'Antarctica/Davis', '8.0' => 'Australia/Perth', '9.0' => 'Pacific/Palau', '9.5' => 'Australia/Adelaide');
  @include _CAL_BASE_PATH_ . 'customize/tzids.php';
?>