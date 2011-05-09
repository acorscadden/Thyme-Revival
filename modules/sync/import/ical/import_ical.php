<?php



  function array_to_ts (&$arr)
  {
    $i = 0;
    while ($i < count ($arr))
    {
      if (!$arr[$i])
      {
        continue;
      }

      $arr[$i] = _cal_vcal::vdate_to_ts ($arr[$i]);
      ++$i;
    }

  }

  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.request.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.vcal.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.attachment_minimal.php';
  global $_cal_html;
  global $_cal_sql;
  global $_cal_user;
  global $_cal_modules;
  global $_cal_vcal_wdays;
  global $_cal_dsts;
  global $_cur_cal;
  global $_cal_dbpref;
  define ('_CAL_FULL_SYNC_', ($_REQUEST['fullsync'] AND $_cal_user->access->can_admin ($_cur_cal)));
  $eadded = array ();
  if ((!$_cal_user->access->can_add ($_cur_cal) AND ($_cur_cal->options & 2) == 0))
  {
    return null;
  }

  if (!$vc)
  {
    $vc = new _cal_vCal ();
    $vc->read_vcal ($_FILES['import_file']['tmp_name'], 'rb');
  }

  $count = 0;
  if (!$_REQUEST['etype'])
  {
    $_e_cats = array_flip (array_map ('strtolower', $_cur_cal->get_categories ()));
  }

  if (!is_array ($vc->objects['VCALENDARS']))
  {
    echo '<div align=\'center\'><h3 align=\'center\'>' . _SYNC_IMPORT_ERROR_ . '</h3></div>';
    return null;
  }

  foreach ($vc->objects['VCALENDARS'] as $vcal)
  {
    if (!is_array ($vcal['VEVENTS']))
    {
      $vcal['VEVENTS'] = array ();
    }

    $vcal['VEVENTS'] = array_reverse ($vcal['VEVENTS']);
    $ms_quirks = intval (strpos (strtolower ($vcal['PRODID']), 'microsoft corp'));
    if ((!is_array ($vcal['VTIMEZONES']) OR ($_REQUEST['locale'] != 2 AND isset ($_REQUEST['locale']))))
    {
      $vcal['VTIMEZONES'] = array ();
    }

    foreach ($vcal['VTIMEZONES'] as $vt)
    {
      $tzid = $vt['TZID'];
      $timezones[$tzid]['offset'] = $vt['STANDARDS'][0]['TZOFFSETTO'];
      $timezones[$tzid]['dst']['end'] = $vc->vdate_to_ts ($vt['STANDARDS'][0]['DTSTART']);
      $timezones[$tzid]['dst']['start'] = $vc->vdate_to_ts ($vt['DAYLIGHTS'][0]['DTSTART']);
      $timezones[$tzid]['dst']['end_rrule'] = $vt['STANDARDS'][0]['RRULE'];
      $timezones[$tzid]['dst']['start_rrule'] = $vt['DAYLIGHTS'][0]['RRULE'];
      $dst_start_mo = _ex_date ('n', $timezones[$tzid]['dst']['start']);
      $dst_end_mo = _ex_date ('n', $timezones[$tzid]['dst']['end']);
      ($_cal_dsts OR $_cal_dsts = $_cal_sql->query ('' . 'select * from ' . $_cal_dbpref . 'DST'));
      if (!($timezones[$tzid]['dst']['end'] AND $timezones[$tzid]['dst']['start']))
      {
        continue;
      }

      foreach ($_cal_dsts as $dst)
      {
        if ((_ex_date ('n', $dst['starttime']) != $dst_start_mo OR _ex_date ('n', $dst['endtime']) != $dst_end_mo))
        {
          continue;
        }

        $dst = new _cal_dst ($dst['id'], true);
        if (!($timezones[$tzid]['dst']['end_rrule'] AND $timezones[$tzid]['dst']['start_rrule']))
        {
          $wd = substr ($dst->dst_start['byday'], 0 - 1);
          $wk = preg_replace ('/^(-*\\d).*/', '\\1', $dst->dst_start['byday']);
          if (($dst->dst_start['bymonthday'] AND _ex_date ('j', $timezones[$tzid]['dst']['start']) != _ex_date ('j', $dst->starttime)))
          {
            continue;
          }

          if (_ex_date ('w', $timezones[$tzid]['dst']['start']) != $wd)
          {
            continue;
          }

          if ((0 < $wk AND $wk != _ex_toint (_ex_date ('j', $timezones[$tzid]['dst']['start']) / 7) + 1))
          {
            continue;
          }

          if (($wk < 0 AND _ex_date ('j', $timezones[$tzid]['dst']['start']) + 7 <= _ex_date ('t', $timezones[$tzid]['dst']['start'])))
          {
            continue;
          }

          $wd = substr ($dst->dst_end['byday'], 0 - 1);
          $wk = preg_replace ('/^(-*\\d).*/', '\\1', $dst->dst_end['byday']);
          if (($dst->dst_end['bymonthday'] AND _ex_date ('j', $timezones[$tzid]['dst']['end']) != _ex_date ('j', $dst->endtime)))
          {
            continue;
          }

          if (_ex_date ('w', $timezones[$tzid]['dst']['end']) != $wd)
          {
            continue;
          }

          if ((0 < $wk AND $wk != _ex_toint (_ex_date ('j', $timezones[$tzid]['dst']['end']) / 7) + 1))
          {
            continue;
          }

          if (($wk < 0 AND _ex_date ('j', $timezones[$tzid]['dst']['end']) + 7 <= _ex_date ('t', $timezones[$tzid]['dst']['end'])))
          {
            continue;
          }

          $timezones[$tzid]['dst'] = $dst->id;
          break;
        }

        $wd = substr ($dst->dst_start['byday'], 0, strlen ($dst->dst_start['byday']) - 1) . str_replace (range (0, 6), $_cal_vcal_wdays, substr ($dst->dst_start['byday'], 0 - 1));
        if ($timezones[$tzid]['dst']['start_rrule']['BYDAY'] != $wd)
        {
          continue;
        }

        if ($timezones[$tzid]['dst']['start_rrule']['BYMONTHDAY'] != $dst->dst_start['bymonthday'])
        {
          continue;
        }

        $wd = substr ($dst->dst_end['byday'], 0, strlen ($dst->dst_end['byday']) - 1) . str_replace (range (0, 6), $_cal_vcal_wdays, substr ($dst->dst_end['byday'], 0 - 1));
        if ($timezones[$tzid]['dst']['end_rrule']['BYDAY'] != $wd)
        {
          continue;
        }

        if ($timezones[$tzid]['dst']['end_rrule']['BYMONTHDAY'] != $dst->dst_end['bymonthday'])
        {
          continue;
        }

        $timezones[$tzid]['dst'] = $dst->id;
        break;
      }
    }

    if (($vcal['X-WR-TIMEZONE'] AND is_array ($timezones)))
    {
      $tz_offset = _ex_toint ($timezones[$vcal['X-WR-TIMEZONE']]['offset'] / 100);
      $tz_id = $vcal['X-WR-TIMEZONE'];
    }
    else
    {
      if ($vcal['TZ'])
      {
        $tz_offset = intval ($vcal['TZ']);
      }
      else
      {
        $tz_offset = $_cal_user->options->timezone;
      }
    }

    if (!is_array ($vcal['VEVENTS']))
    {
      continue;
    }

    foreach ($vcal['VEVENTS'] as $ve)
    {
      @set_time_limit (30);
      if (strlen (trim ($ve['UID'])))
      {
        $id = $_cal_sql->query ('' . 'select \'1\', id from ' . $_cal_dbpref . 'Events
                    where uid = \'' . $_cal_sql->escape_string ($ve['UID']) . '\'
                    and calendar = ' . $_SESSION['calendar'] . ' and
                    (override_id < 1 or override_id is null)', true);
        if (0 < $id[1])
        {
          $le = new _cal_event ($id[1]);
        }
        else
        {
          unset ($le);
        }

        if (@constant ('_CAL_FULL_SYNC_'))
        {
          $eadded[$ve['UID']] = 1;
        }
      }

      if ((!$_cal_user->access->can_add ($_cur_cal) AND ($_cur_cal->options & 2) != 0))
      {
        $e = new _cal_request ();
        $e->request_contact = $_cal_user->email;
      }
      else
      {
        $e = new _cal_event ();
      }

      if ((is_array ($ve['SUMMARY']) AND $ve['SUMMARY']['VALUE']))
      {
        $ve['SUMMARY'] = $ve['SUMMARY']['VALUE'];
      }

      $e->uid = $ve['UID'];
      $e->title = $ve['SUMMARY'];
      $e->notes = (is_array ($ve['DESCRIPTION']) ? $ve['DESCRIPTION']['VALUE'] : $ve['DESCRIPTION']);
      $e->location = $ve['LOCATION'];
      $e->flag = ($ve['PRIORITY'] < 3 AND $ve['PRIORITY']);
      $e->url = preg_replace ('/^uri:/i', '', (is_array ($ve['URL']) ? $ve['URL']['VALUE'] : $ve['URL']));
      $e->version = $ve['SEQUENCE'];
      $e->addr_st = $ve['X-WR-ADDR-ST'];
      $e->addr_ci = $ve['X-WR-ADDR-CI'];
      $e->phone = $ve['X-WR-PHONE'];
      $e->owner = $_cal_user->id;
      if (isset ($ve['X-WR-ICON']))
      {
        $e->icon = $ve['X-WR-ICON'];
      }
      else
      {
        $e->icon = $le->icon;
      }

      $e->phone = preg_replace ('/^X-WR-PHONE:/i', '', $ve['X-WR-PHONE']);
      if ((($_REQUEST['duplicates'] < 2 AND isset ($le->id)) AND !isset ($ve['RECURRENCE-ID'])))
      {
        if (((!isset ($ve['SEQUENCE']) AND !isset ($ve['LAST-MODIFIED'])) AND $_REQUEST['duplicates'] != 1))
        {
          continue;
        }

        if (($_REQUEST['duplicates'] == 1 AND !$le->can_edit ()))
        {
          if ($_SERVER['REQUEST_METHOD'] != 'PUT')
          {
            echo '<font class=\'' . _CAL_CSS_HIL_ . ('' . '\'>' . $e->title . '</font> : ') . _PERMISSION_DENIED_ . '<br>';
          }

          continue;
        }

        if ($_REQUEST['duplicates'] == 1)
        {
        }
        else
        {
          if ((isset ($ve['SEQUENCE']) AND $ve['SEQUENCE'] <= $le->version))
          {
            continue;
          }

          if ((isset ($ve['LAST-MODIFIED']) AND _cal_vcal::vdate_to_ts ($ve['LAST-MODIFIED']) <= $le->updated))
          {
            continue;
          }
        }

        $e->id = $e->keyval = $le->id;
        $e->owner = $le->owner;
      }

      if (isset ($ve['LAST-MODIFIED']))
      {
        $e->updated = _cal_vcal::vdate_to_ts ($ve['LAST-MODIFIED']);
      }

      if ((@constant ('_CAL_FULL_SYNC_') AND $le->id))
      {
        $_cal_sql->query ('' . 'delete from ' . $_cal_dbpref . 'Exceptions
                where eid = ' . $le->id);
      }

      if ((isset ($ve['RECURRENCE-ID']) AND !is_array ($ve['RECURRENCE-ID'])))
      {
        $ve['RECURRENCE-ID'] = array ('VALUE' => $ve['RECURRENCE-ID']);
      }

      if ((((!$e->is_request AND is_array ($ve['RECURRENCE-ID'])) AND isset ($ve['RECURRENCE-ID']['VALUE'])) AND $le->id))
      {
        $ms_quirks = 0;
        $e->override_date = _cal_vcal::vdate_to_ts ($ve['RECURRENCE-ID']['VALUE']);
        $e->override_id = $le->id;
        $ors = $_cal_sql->query ('' . 'select id from
                ' . $_cal_dbpref . 'Events where override_id = ' . $le->id . '
                and override_date = ' . $e->override_date);
        foreach ($ors as $or)
        {
          _cal_event::delete ($or['id']);
        }

        $_cal_sql->query ('' . 'delete from
                ' . $_cal_dbpref . 'Exceptions where eid = ' . $le->id . ' and
                exdate = ' . $e->override_date);
      }
      else
      {
        if ((isset ($ve['RECURRENCE-ID']) AND $le->id))
        {
          echo 'Parse error on recurrence id<pre>
';
          print_r ($ve);
          echo '</pre>
';
          continue;
        }
      }

      if (!$ve['ORGANIZER'])
      {
        $ve['ORGANIZER'] = $ve['CONTACT'];
      }

      if (is_array ($ve['ORGANIZER']))
      {
        $e->org_name = $ve['ORGANIZER']['CN'];
        $e->org_email = $ve['ORGANIZER']['MAILTO'];
      }
      else
      {
        if (preg_match ('/^mailto:/i', $ve['ORGANIZER']))
        {
          $e->org_email = preg_replace ('/^mailto:/i', '', $ve['ORGANIZER']);
        }
      }

      if ((is_array ($ve['DTSTART']) AND isset ($ve['DTSTART']['VALUE'])))
      {
        $dt = $ve['DTSTART']['VALUE'];
      }
      else
      {
        if ((is_array ($ve['DTSTART']) AND isset ($ve['DTSTART']['TZID'])))
        {
          $dt = $ve['DTSTART']['VALUE'];
        }
        else
        {
          $dt = $ve['DTSTART'];
        }
      }

      if (!$dt)
      {
        continue;
      }

      $e->starttime = $vc->vdate_to_ts ($dt);
      if ((substr ($dt, 0 - 1) == 'Z' AND !@constant ('_CAL_ENABLE_TZ_')))
      {
        $e->starttime = $_cal_user->to_localtime ($e->starttime);
      }

      if (!is_array ($ve['DTEND']))
      {
        $dt = $ve['DTEND'];
      }
      else
      {
        if (isset ($ve['DTEND']['VALUE']))
        {
          $dt = $ve['DTEND']['VALUE'];
        }
        else
        {
          if (isset ($ve['DTEND']['TZID']))
          {
            $dt = $ve['DTEND']['TZID'];
          }
        }
      }

      if ((substr ($dt, 0 - 1) == 'Z' AND !@constant ('_CAL_ENABLE_TZ_')))
      {
        $dt = $_cal_user->to_localtime ($vc->vdate_to_ts ($dt));
      }
      else
      {
        $dt = $vc->vdate_to_ts ($dt);
      }

      $duration = strtoupper ($ve['DURATION']);
      $duration = preg_replace ('/^[(PT)|(P)]/', '', $duration);
      preg_match_all ('/(\\d+[A-Z])/', $duration, $d_elms, PREG_SET_ORDER);
      $duration = 0;
      foreach ($d_elms as $delm)
      {
        $i = preg_replace ('/(\\d+).*/', '\\1', $delm[1]);
        $delm = preg_replace ('/\\d+(.*)/', '\\1', $delm[1]);
        switch ($delm)
        {
          case 'H':
          {
            $duration += 3600 * $i;
            break;
          }

          case 'M':
          {
            $duration += 60 * $i;
            break;
          }

          case 'D':
          {
            if ((strtoupper ($ve['DURATION']) == 'PT1D' OR strtoupper ($ve['DURATION']) == 'P1D'))
            {
              $duration = 3600 * 24;
              $e->allday = 1;
            }
          }
        }
      }

      ($duration OR $duration = $dt - $e->starttime);
      if (86400 < $duration)
      {
        $e->allday = 1;
        if (($duration % 86400 == 0 AND 1 < $duration / 86400))
        {
          $e->freq = 4;
          $e->finterval = 1;
          $e->endtime = $dt;
        }
      }
      else
      {
        $hrs = _ex_toint ($duration / 3600);
        $duration -= $hrs * 3600;
        $mns = _ex_toint ($duration / 60);
        if ((($hrs == 0 OR $hrs == 24) AND $mns == 0))
        {
          $e->allday = 1;
        }
        else
        {
          if ($hrs < 10)
          {
            $hrs = '0' . $hrs;
          }

          if ($mns < 10)
          {
            $mns = '0' . $mns;
          }

          if (((0 < intval ($mns) OR 0 < intval ($hrs)) AND $hrs < 24))
          {
            $e->duration = '' . $hrs . ':' . $mns . ':00';
          }
        }
      }

      if ((!isset ($ve['DURATION']) AND (preg_match ('/^DATE:/', $ve['DTSTART']['VALUE']) OR (!is_array ($ve['DTSTART']) AND preg_match ('' . '/^\\d{8}$/', $ve['DTSTART'])))))
      {
        $e->allday = 1;
      }

      if (is_array ($ve['X']))
      {
        foreach ($ve['X'] as $x)
        {
          if ((strtolower ($x['MEMBER']) == 'allday' AND strtolower ($x['VALUE']) == 'true'))
          {
            $e->allday = 1;
            break;
            continue;
          }
        }
      }

      if ((!is_array ($ve['RRULE']) AND preg_match ('/^P(?>!T)/i', $ve['DURATION'])))
      {
        echo '<h3>Unhandled: no rrule, duration spans multiple days.</h3><BR>
';
        continue;
      }

      if ($ve['RRULE']['COUNT'])
      {
        $e->end_after = $ve['RRULE']['COUNT'];
      }
      else
      {
        if (is_array ($ve['RRULE']['UNTIL']))
        {
          $dt = $ve['RRULE']['UNTIL']['TZID'];
        }
        else
        {
          $dt = $ve['RRULE']['UNTIL'];
        }

        if ($dt)
        {
          $e->endtime = $vc->vdate_to_ts ($dt);
        }
      }

      $e->timezone = $tz_offset;
      $e->dst = $_cal_user->options->dst;
      if (((is_array ($ve['DTSTART']) AND $ve['DTSTART']['TZID']) OR $tz_id))
      {
        $tz = $ve['DTSTART']['TZID'];
        $tz = preg_replace ('/^([\'|"]*)(.+?)\\1[\\:\\d{8}T\\d{6}]*$/', '\\2', $tz);
        ($tz OR $tz = $tz_id);
        $tz = intval ($timezones[$tz]['offset'] / 100);
        if ($tz)
        {
          $e->timezone = $tz;
          if (is_array ($timezones[$tz_id]['dst']))
          {
            $d = $timezones[$tz_id]['dst'];
            if ($d['end'] < $d['start'])
            {
              $e->dst = $d['start'] <= $e->starttime;
            }
            else
            {
              $e->dst = $e->starttime <= $d['start'];
            }
          }
        }
      }
      else
      {
        if ((!is_array ($ve['DTSTART']) AND substr ($ve['DTSTART'], 0 - 1) == 'Z'))
        {
          $e->timezone = 0;
          $e->dst = 0 - 1;
        }
      }

      if ($ve['X-WD-RECUR-EASTER'])
      {
        $e->freq = 5;
        $e->finterval = intval ($ve['X-WD-RECUR-OFFSET']);
      }
      else
      {
        if ($r = $ve['RRULE'])
        {
          switch ($r['FREQ'])
          {
            case 'DAILY':
            {
              $freq = 4;
              break;
            }

            case 'WEEKLY':
            {
              $freq = 3;
              break;
            }

            case 'MONTHLY':
            {
              $freq = 2;
              break;
            }

            default:
            {
              $freq = 1;
            }
          }

          $e->freq = $freq;
          $e->finterval = intval ($r['INTERVAL']);
          $e->byday = str_replace (' ', '', $r['BYDAY']);
          $e->bymonthday = str_replace (' ', '', $r['BYMONTHDAY']);
          $e->bymonth = str_replace (' ', '', $r['BYMONTH']);
          $e->bysetpos = str_replace (' ', '', $r['BYSETPOS']);
          ($e->wkst = str_replace ($_cal_vcal_wdays, range (0, 6), strtoupper ($r['WKST'])) OR $e->wkst = $_cal_user->options->week_start);
        }
      }

      $exes = array ();
      if ((isset ($ve['EXDATE']) AND !is_array ($ve['EXDATE'])))
      {
        $ve['EXDATE'] = array ($ve['EXDATE']);
      }
      else
      {
        if (!isset ($ve['EXDATE']))
        {
          $ve['EXDATE'] = array ();
        }
      }

      foreach (array_keys ($ve['EXDATE']) as $ex)
      {
        if ($ex === 'TZID')
        {
          continue;
        }

        $ex = $ve['EXDATE'][$ex];
        if ((is_array ($ex) AND isset ($ex['VALUE'])))
        {
          $exes = array_merge ($exes, explode (',', preg_replace ('/^.*?:(\\d{8}T\\d{6})/', '\\1', $ex['VALUE'])));
          continue;
        }
        else
        {
          if (is_array ($ex))
          {
            $exes = array_merge ($exes, explode (',', $ex));
            continue;
          }
          else
          {
            if ((!is_array ($ex) AND isset ($ex)))
            {
              $exes = array_merge ($exes, explode (',', $ex));
              continue;
            }

            continue;
          }

          continue;
        }
      }

      $exes = array_unique ($exes);
      array_to_ts (&$exes);
      $rdates = array ();
      if ((isset ($ve['RDATE']) AND !isset ($ve['RDATE'][0])))
      {
        $ve['RDATE'] = array ($ve['RDATE']);
      }
      else
      {
        if (!isset ($ve['RDATE']))
        {
          $ve['RDATE'] = array ();
        }
      }

      foreach ($ve['RDATE'] as $rd)
      {
        if ((is_array ($rd) AND isset ($rd['VALUE'])))
        {
          $rdates = array_merge ($rdates, explode (',', preg_replace ('/^.*?:(\\d{8}T\\d{6})/', '\\1', $rd['VALUE'])));
          continue;
        }
        else
        {
          if (is_array ($rd))
          {
            $rdates = array_merge ($rdates, explode (',', $rd));
            continue;
          }
          else
          {
            if ((!is_array ($rd) AND isset ($rd)))
            {
              $rdates = array_merge ($rdates, explode (',', $rd));
              continue;
            }

            continue;
          }

          continue;
        }
      }

      $rdates = array_unique ($rdates);
      array_to_ts (&$rdates);
      $i = ($ms_quirks ? 0 : count ($rdates) + 1);
      while ($i < count ($rdates))
      {
        if ($k = array_search ($rdates[$i], $exes) !== false)
        {
          unset ($rdates[$i]);
          unset ($exes[$k]);
        }

        ++$i;
      }

      if ((((!$e->is_request AND is_object ($le)) AND $le->id == $e->id) AND ($e->freq != 0 AND $le->freq != 0)))
      {
        $rrule_diff = 1;
        if ((((((($e->freq == $le->freq AND $e->finterval == $le->finterval) AND $e->byday == $le->byday) AND $e->bymonthday == $le->bymonthday) AND $e->bymonth == $el->bymonth) AND $e->bysetpos == $le->bysetpos) AND ($e->freq == 3 AND $e->wkst == $le->wkst)))
        {
          $rrule_diff = 0;
        }

        if ((!$rrule_diff AND $e->starttime != $le->starttime))
        {
          $rrule_diff = 1;
        }

        if ($rrule_diff)
        {
          _cal_event::delete_overrides ($e->id);
          $_cal_sql->query ('' . 'delete from ' . $_cal_dbpref . 'Exceptions where eid = ' . $e->id);
        }
        else
        {
          echo '<h3>Unhandled: rdate check</h3>
';
        }
      }

      $attachments = array ();
      if (is_array ($ve['ATTACH']))
      {
        if ($ve['ATTACH']['FMTTYPE'])
        {
          $attachments[] = array ($ve['ATTACH']['VALUE'], $ve['ATTACH']['FMTTYPE']);
        }
        else
        {
          if (is_array ($ve['ATTACH'][0]))
          {
            foreach ($ve['ATTACH'] as $a)
            {
              if ($a['FMTTYPE'])
              {
                $attachments[] = array ($a['VALUE'], $a['FMTTYPE']);
                continue;
              }
            }
          }
        }
      }
      else
      {
        if ((isset ($ve['ATTACH']) AND !preg_match ('/^CID:/', $ve['ATTACH'])))
        {
          $attachments[] = array ($ve['ATTACH'], '');
        }
      }

      $e->calendar = $_SESSION['calendar'];
      if ($_REQUEST['etype'])
      {
        $e->etype = $_REQUEST['etype'];
      }
      else
      {
        if (($ve['CATEGORIES'] AND count ($_e_cats)))
        {
          $cats = strtolower (preg_replace ('/\\s*,\\s*/', ',', $ve['CATEGORIES']));
          $cats = explode (',', $cats);
          $e->etype = 0;
          foreach ($cats as $c)
          {
            $e->etype += $_e_cats[$c];
            if ((!($_cur_cal->options & 32) AND $_e_cats[$c]))
            {
              break;
              continue;
            }
          }
        }
      }

      --$e->version;
      if (str_replace ('
', '', $e->notes) === '')
      {
        $e->notes = '';
      }

      if ($_REQUEST['locale'] == 1)
      {
        $e->timezone = $_REQUEST['timezone'];
        $e->dst = $_REQUEST['dst'];
      }

      $e->use_tz = intval (0 < $_REQUEST['locale']);
      if (($le->id AND $_REQUEST['duplicates'] == 2))
      {
        unset ($e[uid]);
      }

      if ($e->endtime)
      {
        $e->endtime -= 86400;
      }

      if ((($e->override_id AND !is_array ($ve['DTSTART'])) AND substr ($ve['DTSTART'], 0 - 1) == 'Z'))
      {
        $e->starttime += 3600 * $le->timezone;
        $dst = new _cal_dst ($e->dst);
        $e->starttime += 3600 * $dst->is_dst ($e->starttime);
      }

      if ($e->save ())
      {
        ++$count;
      }
      else
      {
        continue;
      }

      if ($e->is_request)
      {
        continue;
      }

      if ($e->override_id)
      {
        --$count;
      }

      $deletes = array ();
      if (($le->id == $e->id AND count ($attachments)))
      {
        foreach ($le->attachments as $aid)
        {
          $a = new _cal_attachment_minimal ($aid['id']);
          $found = 0;
          $deletes[$a->id] = 1;
          $i = 0;
          while ($i < count ($attachments))
          {
            if ($a->filename == $attachments[$i][0])
            {
              unset ($attachments[$i]);
              unset ($deletes[$a->id]);
              continue;
            }

            if (preg_match ('/download_attachment\\.php\\?aid=' . $a->id . ('' . '[&|$]/'), $attachments[$i][0]))
            {
              unset ($attachments[$i]);
              unset ($deletes[$a->id]);
              continue;
            }

            ++$i;
          }
        }

        foreach (array_keys ($deletes) as $aid)
        {
          if ($deletes[$aid])
          {
            _cal_attachment_minimal::delete_attachment ($aid);
            continue;
          }
        }
      }

      foreach ($attachments as $attch)
      {
        continue;
      }

      if (($e->id AND count ($exes) != count ($rdates)))
      {
        $new_exes = $exes;
        $exes = $_cal_sql->query ('' . 'select exdate, id
               from ' . $_cal_dbpref . 'Exceptions where eid = ' . $e->id, true);
        $create = $delete = array ();
        foreach ($new_exes as $ex)
        {
          if ($ex === null)
          {
            continue;
          }

          if (isset ($exes[$ex]))
          {
            unset ($exes[$ex]);
            continue;
          }

          $create[] = $ex;
        }

        foreach ($exes as $ex)
        {
          $_cal_sql->query ('' . 'delete from ' . $_cal_dbpref . 'Exceptions where id = ' . $ex);
        }
      }
      else
      {
        if (count ($exes) != count ($rdates))
        {
          $create = $exes;
        }
        else
        {
          $create = array ();
        }
      }

      $exlimit = $e->starttime - $e->starttime % 86400;
      foreach ($create as $ex)
      {
        $ex -= $ex % 86400;
        if ($ex < $exlimit)
        {
          continue;
        }

        $_cal_sql->query ('' . 'insert into ' . $_cal_dbpref . 'Exceptions (eid, exdate) values (' . $e->id . ',' . $ex . ')');
      }

      $co = array ();
      if (($le->id == $e->id AND !$e->is_request))
      {
        if (!count ($rdates))
        {
          _cal_event::delete_overrides ($e->id);
        }
        else
        {
          $orrides = $_cal_sql->query ('' . 'select id, starttime from ' . $_cal_dbpref . 'Events
                    where override_id = ' . $e->id, true);
          if (!count ($orrides))
          {
            $co = $rdates;
          }
          else
          {
            foreach ($rdates as $r)
            {
              if ($k = array_search ($r, $orrides) === false)
              {
                $co[] = $r;
                continue;
              }
              else
              {
                unset ($orrides[$k]);
                continue;
              }
            }

            foreach (array_keys ($orrides) as $k)
            {
              _cal_event::delete ($k, true);
            }
          }
        }
      }
      else
      {
        $co = $rdates;
      }

      if ((count ($co) AND !$e->is_request))
      {
        $attachments = $_cal_sql->query ('' . 'select id from ' . $_cal_dbpref . 'Attachments where eid = ' . $e->id);
      }

      sort ($co);
      sort ($exes);
      $i = 0;
      while ($i < count ($co))
      {
        $ne = $e;
        unset ($ne[keyval]);
        $ne->override_id = $e->id;
        $ne->starttime = $co[$i];
        $ne->freq = 0;
        if (count ($co) == count ($exes))
        {
          $ne->override_date = _ex_toint ($exes[$i] / 86400) * 86400;
        }

        $ne->save ();
        foreach ($attachments as $na)
        {
          $a = new _cal_attachment_minimal ();
          $a->filename = $na['id'];
          $a->filetype = 'pointer';
          $a->eid = $ne->id;
          $a->save ();
        }

        ++$i;
      }
    }
  }

  if (@constant ('_CAL_FULL_SYNC_'))
  {
    $uids = $_cal_sql->query ('' . 'select uid, id from ' . $_cal_dbpref . 'Events
            where calendar = ' . $_cur_cal->id, true);
    $deletes = array ();
    foreach (array_keys ($uids) as $u)
    {
      if (!isset ($eadded[$u]))
      {
        $deletes[] = $uids[$u];
        continue;
      }
    }

    foreach ($deletes as $eid)
    {
      _cal_event::delete ($eid, false);
    }
  }

  echo '<div align=\'center\'><h3 align=\'center\'>' . intval ($count) . ' ' . _EVENTS_IMPORTED_ . '</h3></div>';
?>