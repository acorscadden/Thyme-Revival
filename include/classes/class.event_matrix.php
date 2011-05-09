<?php

//
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 eXtrovert Software and Thymenews                  |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@thymenews.com.                                               |
// +----------------------------------------------------------------------+
//


  class _cal_event_matrix
  {
    var $matrix = array ();
    var $invalids = array ();
    function _cal_event_matrix ($time, $view = null, $etypes = 0, $cal = 0, $filter = '')
    {
      global $_cal_user;
      global $_cur_cal;
      require_once @constant ('_CAL_BASE_PATH_') . 'include/date_utils.php';
      if ($view == null)
      {
        $view = 'month';
      }

      $this->view = $view;
      $this->etypes = $etypes;
      $this->filter = $filter;
      list ($yr, $mo, $da) = explode ('-', _ex_date ('Y-n-j', $time));
      $this->minimal = (($this->view == 'year' OR $this->view == 'minimonth') AND @constant ('_CAL_INTERFACE_MAIN_'));
      if ($view == 'year')
      {
        $wdayone = _ex_date ('w', _ex_mktime (0, 0, 0, 1, 1, $yr)) - $_cal_user->options->week_start;
        if ($wdayone < 0)
        {
          $wdayone = 7 + $wdayone;
        }

        --$wdayone;
        $start = _ex_mktime (0, 0, 0, 1, 0 - $wdayone, $yr);
        $last = _ex_mktime (23, 59, 59, 12, 31, $yr);
        $wday = _ex_date ('w', $last) - $_cal_user->options->week_start;
        $end = $last + (6 - $wday) * 86400;
      }
      else
      {
        if (($view == 'month' OR $view == 'minimonth'))
        {
          $wdayone = _ex_date ('w', _ex_mktime (0, 0, 0, $mo, 1, $yr)) - $_cal_user->options->week_start;
          if ($wdayone < 0)
          {
            $wdayone = 7 + $wdayone;
          }

          --$wdayone;
          $start = _ex_mktime (0, 0, 0, $mo, 0 - $wdayone, $yr);
          $last = _ex_mktime (23, 59, 59, $mo, _ex_date ('t', $time), $yr);
          $wday = _ex_date ('w', $last) - $_cal_user->options->week_start;
          $end = $last + (6 - $wday) * 86400;
          $this->month_range = array (_ex_date ('n', $start), $mo, _ex_date ('n', $end));
        }
        else
        {
          if ($view == 'week')
          {
            $wday = _ex_date ('w', $time);
            if ($_cal_user->options->week_start <= $wday)
            {
              $offset = 0 - $wday + $_cal_user->options->week_start;
            }
            else
            {
              $offset = $_cal_user->options->week_start - $wday - 7;
            }

            $start = _ex_mktime (0, 0, 0, $mo, $da + $offset, $yr);
            $end = _ex_mktime (23, 59, 59, $mo, $da + $offset + 6, $yr);
            $this->month_range = array (_ex_date ('n', $start), $mo, _ex_date ('n', $end));
          }
          else
          {
            if ($view == 'day')
            {
              $start = $time;
              $end = _ex_mktime (23, 59, 59, $mo, $da, $yr);
              $this->month_range = array (_ex_date ('n', $start), $mo, _ex_date ('n', $end));
            }
            else
            {
              if ($view == 'upcoming')
              {
                $start = $end = time ();
              }
              else
              {
                if (strpos ($view, '-'))
                {
                  if (!strpos ($time, '-'))
                  {
                    $time = _ex_date ('Y-n-j', $time);
                  }

                  list ($yr, $mo, $da) = explode ('-', $time);
                  $start = _ex_mktime (0, 0, 0, $mo, $da, $yr);
                  list ($yr, $mo, $da) = explode ('-', $view);
                  $end = _ex_mktime (0, 0, 0, $mo, $da, $yr);
                  $view = 'ranged';
                  if ($end <= $start)
                  {
                    $this->matrix = array ();
                    return null;
                  }
                }
                else
                {
                  return null;
                }
              }
            }
          }
        }
      }

      if ($_cur_cal->view_filter)
      {
        $this->filter = $_cur_cal->view_filter;
      }

      $this->view = $view;
      $this->fill_matrix ($start, $end, $time, $etypes, $cal);
    }

    function fill_matrix ($start, $end, $now, $etypes, $cal)
    {
      global $_cal_sql;
      global $_cal_user;
      global $_cur_cal;
      global $_cal_dbpref;
      if ($this->view == 'upcoming')
      {
        $pad_arr = 0;
      }
      else
      {
        $pad_arr = _ex_date_diff ($end, $start);
        $start = _ex_toint ($start / 86400) * 86400;
        $end += 18 * 3600 + 1;
      }

      $this->start = $start;
      $this->end = $end;
      $this->now = $now;
      $this->ptr = 0;
      ($_cal_sql OR $_cal_sql = new _cal_sql ());
      if ($_cur_cal->has_subcals)
      {
        $_cal_names = $_cur_cal->get_calendars ();
      }
      else
      {
        $_cal_names = array ($_cur_cal->id, $_cur_cal->title);
      }

//      if ((!_ex_valid_license_key () AND _CAL_EXPIRATION_ < time ()))
//      {
//        $this->events = array ('lic_err');
//      }

      $fields = array ();
      @include _CAL_BASE_PATH_ . 'customize/event_fields.php';
      if (@constant ('_CAL_LOCATIONS_MOD_'))
      {
        $loc_id_filter = max (intval ($_SESSION['location']), intval ($_REQUEST['location']));
        if ($loc_id_filter)
        {
          $loc_id_filter = '' . ' location_id = ' . $loc_id_filter . ' and ';
        }
        else
        {
          $loc_id_filter = '';
        }
      }
      else
      {
        $loc_id_filter = '';
      }

      if (!$this->events)
      {
        $query = 'select id, ' . $_cal_sql->sql_alias ('starttime', 'start') . ', ' . $_cal_sql->sql_alias ('endtime', 'end') . ',
         freq, finterval, byday, bymonthday, bymonth, bysetpos, wkst, owner,
         added, updated,
         allday, timezone, dst, override_id, title, use_tz, ' . join (',', $fields) . ('' . '
         title, icon, duration, flag, etype as type, calendar 
         from ' . $_cal_dbpref . 'Events
         where ' . $loc_id_filter . '
         ') . (($_cal_user AND $_cal_user->filter) ? '' . ' (' . $_cal_user->filter . ') and ' : '') . '
         ' . ($this->filter ? '' . ' (' . $this->filter . ') and ' : '') . '
         calendar ' . $_cur_cal->get_constraint () . ' and

         ' . (0 < $this->etypes ? '(' . $_cal_sql->sql_binary_and ('etype', $this->etypes) . ' >= 1) and ' : '') . '
      ';
        if ($this->view == 'upcoming')
        {
          $query .= '
         (
            (
                (endtime >= ' . $start . '
                or
                endtime is NULL)
                and freq > 0
            )
            or
            (starttime >= ' . $start . ' and (freq = 0 or freq is null))
         )';
        }
        else
        {
          $query .= '
         starttime < ' . $end . ' and
         (
            (
                (endtime >= ' . ($start - 18 * 3600) . '
                or
                endtime is NULL)
                and freq > 0
            )
            or
            (starttime >= ' . ($start - 18 * 3600) . ' and (freq = 0 or freq is null))
         )';
        }

        $events = $_cal_sql->query ($query);
      }
      else
      {
        $events = &$this->events;
      }

      $tzconfig = new _cal_event_minimal ();
      $etcache = $_cur_cal->get_categories_for_view ();
      $ids = join (',', array_map (array (&$this, '_ex_excl_list'), $events));
      if (is_array ($events[0]))
      {
        $excludes = $_cal_sql->query ('' . 'select eid, exdate from ' . $_cal_dbpref . 'Exceptions where eid in (' . $ids . ')
             and exdate >= ' . ($start - 18 * 3600));
        $excludes = array_merge ($excludes, $_cal_sql->query ('' . 'select override_id as eid,
               override_date as exdate from
               ' . $_cal_dbpref . 'Events where override_id in (' . $ids . ') and
               override_date >= ' . ($start - 18 * 3600)));
        foreach ($excludes as $ex)
        {
          $exes[$ex['eid']][$ex['exdate'] - $ex['exdate'] % 86400] = 1;
        }

        $excludes = $exes;
      }
      else
      {
        $excludes = array ();
      }

//      if (_ex_valid_license_key ())
//      {
        $max_added = 0;
//      }
//      else
//      {
//        $max_added = _CAL_EXPIRATION_ - 65 * 86400;
//      }

//      if (((@constant ('_CAL_ADD_MOD_') AND @constant ('_CAL_ADD_MOD_') < 30) AND $max_added))
//      {
//        $max_added -= @constant ('_CAL_ADD_MOD_') * 86400;
//      }

      foreach ($events as $e)
      {
        if ($e['added'] < $max_added)
        {
          continue;
        }

        $e['type_name'] = $etcache[$e['calendar']][$e['type']]['name'];
        $e['type_icon'] = $etcache[$e['calendar']][$e['type']]['icon'];
        if (!$e['type_icon'])
        {
          $e['type_icon'] = '';
        }

        if ((!$e['type_name'] AND $e['type']))
        {
          $e['type_icons'] = array ();
          $e['type_names'] = array ();
          foreach (array_keys ($etcache[$e['calendar']]) as $etid)
          {
            if (0 < ($etid * 1 & $e['type'] * 1))
            {
              if ($etcache[$e['calendar']][$etid]['icon'])
              {
                $e['type_icons'][] = $etcache[$e['calendar']][$etid]['icon'];
              }

              $e['type_names'][] = $etcache[$e['calendar']][$etid]['name'];
              continue;
            }
          }

          $e['type_name'] = join (_LIST_SEP_, $e['type_names']);
        }

        if (is_array ($_cal_names))
        {
          $e['cal_title'] = $_cal_names[$e['calendar']];
        }

        $tzconfig->allday = $e['allday'];
        $tzconfig->timezone = $e['timezone'];
        $tzconfig->use_tz = $e['use_tz'];
        $tzconfig->dst_obj = new _cal_dst ($e['dst']);
        $e['endtime'] = $e['end_timestamp'] = $e['end'];
        $e['starttime'] = $e['start'];
        if ($e['end'])
        {
          $e['end'] = _ex_date ('Y-n-j', $e['end']);
        }

        if ($e['freq'] == 0)
        {
          $tzconfig->start = $e['start'];
          $tzconfig->set_localtime ();
          $e['instance'] = $e['next'] = $e['start'] = $tzconfig->start;
          if ($this->view == 'upcoming')
          {
            $dayoffset = 0;
          }
          else
          {
            $dayoffset = _ex_toint ($e['start'] / 86400) - _ex_toint ($start / 86400);
          }

          if ($start < 0)
          {
            --$dayoffset;
          }

          if (($dayoffset <= $pad_arr AND 0 <= $dayoffset))
          {
            $this->matrix[$dayoffset][] = $e;
          }

          continue;
        }

        $e['start_timestamp'] = $e['start'];
        $e['start'] = _ex_date ('Y-n-j 0:0', $e['start']);
        if ($e['start'] == '')
        {
          continue;
        }

        if ($this->view == 'upcoming')
        {
          $s = $next = $start;
        }
        else
        {
          $s = $next = $start - 18 * 3600;
        }

        $r = new _cal_repeater ($e);
        if (is_array ($excludes[$e['id']]))
        {
          $r->overrides = $excludes[$e['id']];
        }
        else
        {
          $r->overrides = array ();
        }

        if ($r->invalid)
        {
          $this->invalids[] = $e;
          continue;
        }

        $lastnext = null;
        while ($next <= $end)
        {
          if (($e['end_timestamp'] < $s AND $e['end_teimstamp'] !== null))
          {
            break;
          }

          $next = $r->get_next_time (_ex_date ('Y-n-j H:i', $s));
          if ($next === null)
          {
            break;
          }

          $next = _ex_strtotime ($next . _ex_date (' H:i:0', $e['start_timestamp']), true);
          if (($next <= $lastnext AND $lastnext !== null))
          {
            require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event.php';
            $e = new _cal_event ($e['id']);
            echo 'Error: Sanity check failed<br>';
            echo 'event ' . $e->id . '<br>';
            echo 'start is ' . _ex_date ('Y-n-j H:i', $s) . '<br>';
            echo 'next is ' . _ex_date ('Y-n-j H:i', $next) . '<br>';
            echo 'last next was ' . _ex_date ('Y-n-j H:i', $lastnext) . '<br>';
            if ($next < $s)
            {
              echo 'The next time this event will happen is before it even started.';
            }
            else
            {
              echo 'This event apears to repeat twice in the same day.';
            }

            echo 'Please report this bug.<br>';
            echo 'If this event continues to cause a problem, you may have to delete
                   it (' . $e->title . ') from the events list tab.<br>';
            echo 'DEBUG:<br>';
            echo 'Current date: ' . _ex_date ('Y-n-j H:i', time ()) . '<br>';
            echo '<pre>
';
            print_r ($e);
            echo '</pre>
';
            break;
          }

          $lastnext = $next;
          $tzconfig->start = $next;
          if (!$e['allday'])
          {
            $tzconfig->set_localtime ();
          }

          if ($this->view == 'upcoming')
          {
            $dayoffset = 0;
          }
          else
          {
            $dayoffset = _ex_toint ($tzconfig->start / 86400) - _ex_toint ($start / 86400);
          }

          if ($start < 0)
          {
            --$dayoffset;
          }

          if (($dayoffset <= $pad_arr AND 0 <= $dayoffset))
          {
            $e['start'] = $e['next'] = $tzconfig->start;
            $e['instance'] = $next;
            if (!($this->minimal AND count ($this->matrix[$dayoffset])))
            {
              $this->matrix[$dayoffset][] = $e;
            }
          }

          $s = $next + 86400;
        }
      }

      $m_keys = array_keys ($this->matrix);
      $max_key = 0;
      foreach ($m_keys as $m_key)
      {
        $tmparr = $this->matrix[$m_key];
        if (function_exists ('custom_event_sort'))
        {
          usort ($tmparr, 'custom_event_sort');
        }
        else
        {
          usort ($tmparr, array (&$this, 'cmp'));
        }

        $this->matrix[$m_key] = $tmparr;
      }

      if ($this->view == 'upcoming')
      {
        $this->matrix = $this->matrix[0];
//RGH        unset ($this[events]);
        return null;
      }

      $pad_arr = array_pad (array (), $pad_arr, array ());
      $this->matrix = $this->matrix + $pad_arr;
      ksort ($this->matrix);
//RGH      unset ($this[events]);
    }

    function cmp ($a, $b)
    {
      if ($this->view != 'upcoming')
      {
        if (($a['allday'] AND $b['allday']))
        {
          return strcasecmp ($a['type_name'], $b['type_name']);
        }

        if (0 < $b['allday'])
        {
          return 1;
        }

        if (0 < $a['allday'])
        {
          return 0 - 1;
        }
      }

      if ($a['next'] == $b['next'])
      {
        return strcasecmp ($a['type_name'], $b['type_name']);
      }

      return ($a['next'] < $b['next'] ? 0 - 1 : 1);
    }

    function etype_filter ($var)
    {
      return bindec (decbin ((double)$this->etypes & (double)$var['type']));
    }

    function _ex_excl_list ($a)
    {
      return $a['id'];
    }
  }

  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.repeater.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event_minimal.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/date_utils.php';
  @include_once _CAL_BASE_PATH_ . 'customize/event_sort.php';
?>