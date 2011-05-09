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


  class _cal_repeater
  {
    var $overrides = null;
    var $last = null;
    var $par = 0;
    var $wkst_d = 1;
    var $pos = 1;
    var $wkst_manual = false;
    function _cal_repeater ($e = NULL)
    {
      require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/helpers/tie_to.php';
      _ex_tie_to ($this, $e);
      if (!strpos ($this->start, '-'))
      {
        $this->start = _ex_date ('Y-n-j G:i', $this->start);
      }

      if ($this->freq == 0)
      {
        return null;
      }

      if (strpos ($this->end, '-'))
      {
        $this->end = _ex_strtotime ($this->end);
      }

      if (!strlen ($this->end))
      {
        $this->end = null;
      }

      if (($this->wkst == 0 AND $this->wkst !== 0))
      {
        $this->wkst_manual = true;
      }

      $this->byday = trim (str_replace (' ', '', $this->byday), ',');
      $this->bymonthday = trim (str_replace (' ', '', $this->bymonthday), ',');
      $this->bymonth = trim (str_replace (' ', '', $this->bymonth), ',');
      $this->bysetpos = trim (str_replace (' ', '', $this->bysetpos), ',');
      if (strlen ($this->bymonth))
      {
        $this->bymonth = explode (',', $this->bymonth);
      }
      else
      {
        $this->bymonth = array ();
      }

      sort ($this->bymonth);
      $this->bymonth_rev = array_flip ($this->bymonth);
      if (strlen ($this->bymonthday))
      {
        $this->bymonthday = explode (',', $this->bymonthday);
        $this->bymonthday_rev = array_flip ($this->bymonthday);
      }
      else
      {
        $this->bymonthday = array ();
      }

      asort ($this->bymonthday);
      if (strlen ($this->byday))
      {
        $this->byday = explode (',', str_replace ($GLOBALS['_cal_vcal_wdays'], range (0, 6), $this->byday));
        $this->byday_rev = array_flip ($this->byday);
      }
      else
      {
        $this->byday = array ();
      }

      sort ($this->byday);
      if (strlen ($this->bysetpos))
      {
        $this->bysetpos = explode (',', $this->bysetpos);
        $this->bysetpos_lookahead = (0 < min ($this->bysetpos) AND 1 < count ($this->bysetpos));
      }
      else
      {
        $this->bysetpos = array ();
      }

      sort ($this->bysetpos);
      list ($this->s_yr, $this->s_mo, $this->s_da, $this->s_hr, $this->s_mn) = preg_split ('/-| |:/', $this->start);
      if ($this->freq == 1)
      {
        if (!count ($this->bymonth))
        {
          $this->bymonth[] = $this->s_mo;
        }

        if ((!count ($this->bymonthday) AND !count ($this->byday)))
        {
          $this->bymonthday[] = $this->s_da;
        }

        $this->bymonth_rev = array_flip ($this->bymonth);
        $this->bymonthday_rev = array_flip ($this->bymonthday);
      }

      $this->mo_ptr = $this->da_ptr = null;
      $this->wday_started = _ex_date ('w', $this->start_timestamp);
      if ((($this->wday_started != $this->wkst AND 1 < count ($this->byday)) AND !$this->wkst_manual))
      {
        $this->start_timestamp += (0 - (7 + ($this->wday_started - $this->wkst)) % 7) * 86400;
      }
      else
      {
        if ($this->wkst_manual)
        {
          $this->wkst = $this->wday_started;
        }
      }

      $this->wday_started = _ex_date ('w', $this->start_timestamp);
      if ($this->freq != 5)
      {
        $this->finterval = max (1, $this->finterval);
      }

      if (((($this->freq == 4 AND $this->finterval % 7 == 0) AND count ($this->byday)) AND !isset ($this->byday_rev[_ex_date ('w', $this->start_timestamp)])))
      {
        $this->invalid = true;
      }

      if ((($this->freq == 3 AND $this->wday_started == $this->byday[0]) AND count ($this->byday) == 1))
      {
        $this->byday = array ();
      }

      if ($this->freq == 5)
      {
        $this->bymonth = array ();
      }

      if ((count ($this->byday) AND count ($this->bymonthday)))
      {
        foreach ($this->byday as $wd)
        {
          if (strlen ($wd) == 1)
          {
            return null;
          }

          $wk = substr ($wd, 0, 1);
          $i = ($wk - 1) * 7 + 1;
          while ($i <= $wk * 7)
          {
            if ($this->bymonthday_rev[$i])
            {
              return null;
            }

            ++$i;
          }
        }

        $this->invalid = true;
      }

    }

    function _calc_offset ($offset, $mask, $index_one = false)
    {
      if ($mask == 1)
      {
        return 0;
      }

      if ($index_one)
      {
        if (($offset < 0 AND abs ($offset) < $mask))
        {
          return abs ($offset);
        }

        $offset = abs ($offset);
      }

      if (($offset < 0 AND !$index_one))
      {
        $offset = abs ($offset);
        return $offset;
      }

      if (($offset < $mask AND $offset != 0))
      {
        $offset = $mask - $offset;
      }
      else
      {
        if ($offset % $mask == 0)
        {
          $offset = 0;
        }
        else
        {
          $offset = $mask - $offset % $mask;
        }
      }

      return $offset;
    }

    function _set_month ()
    {
      list ($this->c_mo, $this->c_yr) = explode ('-', _ex_date ('n-Y', $this->c_ts));
      if ((($this->mo_ptr === null OR $this->bymonth[$this->mo_ptr] != $this->c_mo) AND count ($this->bymonth)))
      {
        $i = 0;
        while ($i <= count ($this->bymonth))
        {
          if ($this->c_mo <= $this->bymonth[$i])
          {
            $this->mo_ptr = $i;
            break;
          }

          ++$i;
        }

        if ($this->mo_ptr === null)
        {
          $this->mo_ptr = 0;
        }

        $last = $this->c_mo;
        $this->c_mo = $this->bymonth[$this->mo_ptr];
        if ($this->c_mo < $last)
        {
          ++$this->c_yr;
        }

        $this->c_ts = _ex_mktime (0, 0, 0, $this->c_mo, 1, $this->c_yr);
        $this->c_da = 1;
      }
      else
      {
        if (!count ($this->bymonth))
        {
          return null;
        }

        if (!isset ($this->bymonth[$this->mo_ptr + 1]))
        {
          $this->c_mo = $this->bymonth[0];
          $this->mo_ptr = 0;
          ++$this->c_yr;
        }
        else
        {
          $this->c_mo = $this->bymonth[++$this->mo_ptr];
        }
      }

      $this->c_ts = _ex_mktime (0, 0, 0, $this->c_mo, 1, $this->c_yr);
      $this->c_da = 1;
    }

    function _freq_easter ()
    {
      $e = _ex_easter ($this->c_yr);
      if (_ex_toint (($e + $this->finterval * 86400) / 86400) == _ex_toint ($this->c_ts / 86400))
      {
        return _ex_date ('Y-n-j', $e + $this->finterval * 86400);
      }

      while ($e + $this->finterval * 86400 < $this->c_ts)
      {
        $e = _ex_easter (++$this->c_yr);
      }

      return _ex_date ('Y-n-j', $e + $this->finterval * 86400);
    }

    function _freq_yearly ()
    {
      if (!$this->y_finterval)
      {
        $this->y_finterval = $this->finterval;
        $this->finterval = 1;
      }

      $offset = $this->_calc_offset ($this->c_yr - $this->s_yr, $this->y_finterval);
      if (0 < $offset)
      {
        $this->c_yr += $offset;
        $this->c_mo = $this->bymonth[0];
        $this->c_da = 1;
      }

      return $this->_freq_monthly (true);
    }

    function _freq_monthly ()
    {
      if ($this->first_time)
      {
        $this->c_ts = $this->start_timestamp;
        list ($this->c_yr, $this->c_mo, $this->c_da) = array ($this->s_yr, $this->s_mo, $this->s_da);
        $this->first_time = false;
      }

      $this->offset = $this->_calc_offset ($this->c_mo % $this->finterval - $this->s_mo % $this->finterval, $this->finterval, true);
      if ((!count ($this->byday) AND !count ($this->bymonthday)))
      {
        if ($this->s_da < $this->c_da)
        {
          $this->offset += $this->finterval;
        }

        return $this->c_yr . '-' . ($this->c_mo + $this->offset) . '-' . $this->s_da;
      }

      if (0 < $this->offset)
      {
        $this->c_mo += $this->offset;
        $this->c_da = 1;
        $this->offset = 0;
      }

      $this->c_mo += $this->offset;
      if (12 < $this->c_mo)
      {
        list ($this->c_yr, $this->c_mo, $this->c_da) = explode ('-', _ex_date ('Y-n-j', _ex_mktime (0, 0, 0, $this->c_mo, $this->c_da, $this->c_yr)));
      }

      $mo_days = _ex_date ('t', _ex_mktime (0, 0, 0, $this->c_mo, 1, $this->c_yr));
      $this->positions[$this->c_yr][$this->c_mo][0] = 1;
      if ((count ($this->bymonthday) AND !$this->positions[$this->c_yr][$this->c_mo][1]))
      {
        $bmds = $this->_bymonth_day_for_month ($this->bymonthday, $mo_days);
        if (count ($this->byday))
        {
          $mo_wk_st = _ex_mo_wdst ($this->c_mo, $this->c_yr);
          $wd = _cal_repeater::_to_wkday (($mo_wk_st + $this->c_da - 1) % 7, $mo_wk_st);
          $cw = intval (ceil ($this->c_da / 7));
          $bds = $this->_byday_for_month ($this->byday, $mo_wk_st, $mo_days);
          $this->byday_rev = array_flip ($bds);
        }

        foreach ($bmds as $da)
        {
          if (($this->c_da <= $da OR count ($this->bysetpos)))
          {
            if (!count ($this->byday))
            {
              if (count ($this->bysetpos))
              {
                $this->positions[$this->c_yr][$this->c_mo][] = $da;
              }
              else
              {
                return $this->c_yr . '-' . $this->c_mo . '-' . $da;
              }
            }

            $wd = _cal_repeater::_to_wkday (($mo_wk_st + $da - 1) % 7, $mo_wk_st);
            if ((isset ($this->byday_rev[$wd]) OR isset ($this->byday_rev[intval (ceil ($da / 7)) . $wd])))
            {
              if (!count ($this->bysetpos))
              {
                return $this->c_yr . '-' . $this->c_mo . '-' . $da;
              }

              $this->positions[$this->c_yr][$this->c_mo][] = $da;
              continue;
            }

            continue;
          }
        }
      }
      else
      {
        if (!$this->positions[$this->c_yr][$this->c_mo][1])
        {
          $mo_wk_st = _ex_mo_wdst ($this->c_mo, $this->c_yr);
          $wd = _cal_repeater::_to_wkday (($mo_wk_st + $this->c_da - 1) % 7, $mo_wk_st);
          $cw = intval (ceil ($this->c_da / 7));
          $bds = $this->_byday_for_month ($this->byday, $mo_wk_st, $mo_days);
          if ($bds[count ($bds) - 1] < intval ($cw . $wd))
          {
            ++$this->c_mo;
            $this->c_da = 1;
            return $this->_freq_monthly ();
          }

          $i = 1;
          foreach ($bds as $bd)
          {
            if (10 <= $bd)
            {
              $wk = substr ($bd, 0, 1);
            }
            else
            {
              $bd = $cw . $bd;
            }

            if (intval ($cw . $wd) <= $bd)
            {
              if ($mo_days < $this->c_da + ($wk - $cw) * 7 + (substr ($bd, 1, 1) - $wd))
              {
                break;
              }

              if (!count ($this->bysetpos))
              {
                return $this->c_yr . '-' . $this->c_mo . '-' . ($this->c_da + ($wk - $cw) * 7 + (substr ($bd, 1, 1) - $wd));
              }

              $this->positions[$this->c_yr][$this->c_mo][$i] = $this->c_da + ($wk - $cw) * 7 + (substr ($bd, 1, 1) - $wd);
            }
            else
            {
              if (count ($this->bysetpos))
              {
                $this->positions[$this->c_yr][$this->c_mo][$i] = 0;
              }
            }

            ++$i;
          }
        }
      }

      if (count ($this->bysetpos))
      {
        foreach ($this->bysetpos as $bsp)
        {
          $index = ($bsp < 0 ? count ($this->positions[$this->c_yr][$this->c_mo]) + $bsp : $bsp);
          $checks[] = $index;
        }

        sort ($checks);
        $i = 0;
        while ($i < count ($checks))
        {
          if ($this->c_da <= $this->positions[$this->c_yr][$this->c_mo][$checks[$i]])
          {
            return $this->c_yr . '-' . $this->c_mo . '-' . $this->positions[$this->c_yr][$this->c_mo][$checks[$i]];
          }

          ++$i;
        }
      }

      $this->c_da = 1;
      $this->c_mo += $this->finterval;
      return $this->_freq_monthly ();
    }

    function _freq_weekly ()
    {
      if ($this->first_time)
      {
        $this->c_ts = _ex_strtotime ($this->start, true);
        $this->first_time = false;
      }
      else
      {
        $this->offset = $this->_calc_offset (_ex_date_diff ($this->c_ts, $this->start_timestamp - _ex_toint ($this->start_timestamp % 86400)), $this->finterval * 7);
        $wday_offset = $this->offset - $this->finterval * 7;
        if ((count ($this->byday) <= 1 OR !($wday_offset < 0 AND 0 - 7 < $wday_offset)))
        {
          $this->c_ts += 86400 * $this->offset;
        }
      }

      if (count ($this->byday))
      {
        $wd = _ex_date ('w', $this->c_ts);
        while (!isset ($this->byday_rev[$wd]))
        {
          $this->c_ts += 86400;
          $wd = ($wd + 1) % 7;
          --$wday_offset;
        }

        if (($wday_offset == 0 - 7 AND $this->finterval != 1))
        {
          return $this->_freq_weekly ();
        }
      }

      return _ex_date ('Y-n-j', $this->c_ts);
    }

    function _freq_daily ()
    {
      if (!$this->offset)
      {
        $offset = $this->_calc_offset (_ex_date_diff ($this->c_ts, $this->start_timestamp - _ex_toint ($this->start_timestamp % 86400)), $this->finterval);
      }

      $this->c_ts += 86400 * $offset;
      if ((count ($this->byday) AND !isset ($this->byday_rev[_ex_date ('w', $this->c_ts)])))
      {
        $this->offset = null;
        $this->c_ts += 86400 * $this->finterval;
        list ($this->c_yr, $this->c_mo, $this->c_da) = explode ('-', _ex_date ('Y-n-j', $this->c_ts));
        return $this->_freq_daily ();
      }

      return _ex_date ('Y-n-j', $this->c_ts);
    }

    function _get_next_time ()
    {
      switch ($this->freq)
      {
        case 2:
        {
          $next = $this->_freq_monthly ();
          break;
        }

        case 3:
        {
          $next = $this->_freq_weekly ();
          break;
        }

        case 4:
        {
          $next = $this->_freq_daily ();
          break;
        }

        case 5:
        {
          $next = $this->_freq_easter ();
          break;
        }

        default:
        {
          $next = $this->_freq_yearly ();
          break;
        }
      }

      $this->c_ts = _ex_strtotime ($next, true);
      if ((!isset ($this->bymonth_rev[_ex_date ('n', $this->c_ts)]) AND count ($this->bymonth)))
      {
        $this->offset = null;
        $this->_set_month ();
        return $this->_get_next_time ();
      }

      return $next;
    }

    function get_next_time ($now, $ts = false, $cts = null)
    {
      if ($this->invalid)
      {
        return null;
      }

      if ($cts !== null)
      {
        $this->c_ts = $cts;
      }
      else
      {
        $this->c_ts = _ex_strtotime ($now, true);
      }

      if (($this->freq == 0 OR $this->override_id))
      {
        return ($this->start_timestamp < $this->c_ts ? null : $this->start);
      }

      $this->first_time = $this->c_ts <= $this->start_timestamp;
      if ($this->c_ts < $this->start_timestamp)
      {
        $now = $this->start;
        $this->c_ts = $this->start_timestamp;
      }

      list ($this->c_yr, $this->c_mo, $this->c_da, $this->c_hr, $this->c_mn) = preg_split ('/-| |:/', $now);
      $this->now = $now;
      if (((0 < $this->id AND $this->overrides === null) AND 0 < $this->freq))
      {
        global $_cal_sql;
        $oes = array ();
        $query = '' . 'select override_date from ' . $GLOBALS['_cal_dbpref'] . 'Events where override_id = ' . $this->id . ' and override_date >= ' . ($this->c_ts - $this->c_ts % 86400);
        $eos = $_cal_sql->query ($query, 1);
        $eos += $_cal_sql->query ('' . 'select exdate from ' . $GLOBALS['_cal_dbpref'] . 'Exceptions
            where eid = ' . $this->id . ' and exdate >= ' . ($this->c_ts - $this->c_ts % 86400), true);
        $this->overrides = array ();
        foreach (array_keys ($eos) as $override)
        {
          $override -= $override % 86400;
          $this->overrides[$override] = 1;
        }
      }

      $next = $this->_get_next_time ();
      ++$this->par;
      $this->c_ts = _ex_toint ($this->c_ts / 86400) * 86400;
      if (($this->overrides AND $this->overrides[$this->c_ts] == 1))
      {
        $this->next = $next;
        $next = _ex_date ('Y-n-j', _ex_strtotime ($next . ' 0:0:0', true) + 86400);
        $next = $this->get_next_time ($next);
        if ($next === null)
        {
          return null;
        }
      }

      if ($this->end == '')
      {
        return ($ts ? $this->c_ts : $next);
      }

      if ($this->end < $this->c_ts)
      {
        return NULL;
      }

      if ($ts)
      {
        return $this->c_ts;
      }

      return $next;
    }

    function _bymonth_day_for_month (&$mdays, $mo_days)
    {
      if ($this->bmd_cache[$mo_days])
      {
        return $this->bmd_cache[$mo_days];
      }

      $ret = array ();
      foreach ($mdays as $da)
      {
        if ($mo_days < $da)
        {
          continue;
        }

        if ($da < 0)
        {
          $da = $mo_days + 1 + $da;
        }

        $ret[] = $da;
      }

      sort ($ret);
      $this->bmd_cache[$mo_days] = $ret;
      return $ret;
    }

    function _byday_for_month (&$bdays, $mo_st, $mo_days)
    {
      if ($this->_cal_repeater_bd_cache[$mo_st][$mo_days])
      {
        return $this->_cal_repeater_bd_cache[$mo_st][$mo_days];
      }

      $ret = array ();
      $wk_off = $mo_days % 7;
      $mo_end = ($mo_st + $wk_off - 1) % 7;
      foreach ($bdays as $bd)
      {
        if (56 < $bd)
        {
          $bd = '-1' . substr ($bd, 0 - 1, 1);
        }

        if (($bd < 10 AND 0 <= $bd))
        {
          $i = 1;
          while ($i < 6)
          {
            $ret[] = $i . _cal_repeater::_to_wkday ($bd, $mo_st);
            ++$i;
          }

          continue;
        }

        if ($bd < 0)
        {
          $bd = _cal_repeater::_to_wkday (substr (abs ($bd), 0 - 1, 1), $mo_st);
          $ret[] = ($wk_off <= $bd ? 4 : 5) . $bd;
          continue;
        }

        $ret[] = substr ($bd, 0, 1) . _cal_repeater::_to_wkday (substr ($bd, 1, 1), $mo_st);
      }

      sort ($ret);
      $this->_cal_repeater_bd_cache[$mo_st][$mo_days] = $ret;
      return $ret;
    }

    function _to_wkday ($wd, $st)
    {
      $wd -= $st;
      if ($wd < 0)
      {
        $wd += 7;
      }

      return $wd;
    }

    function get_last_time ()
    {
      if ((!$this->end_after OR $this->end_after == 1))
      {
        return $this->starttime;
      }

      $this->c_ts = $this->start_timestamp;
      $i = 0;
      while ($i++ < $this->end_after)
      {
        list ($this->c_yr, $this->c_mo, $this->c_da) = explode ('-', _ex_date ('Y-n-j', $this->c_ts));
        $this->c_ts = _ex_strtotime ($this->_get_next_time () . ' 0:0:0', true);
        $this->c_ts += 86400;
      }

      return $this->c_ts - 86400;
    }
  }

  function _ex_server_key ()
  {
    return strtoupper (md5 (strtoupper (php_uname ('s')) . strtoupper (php_uname ('m')) . strtoupper (php_uname ('n'))));
  }

  function _ex_valid_license_key ($k = null)
  {
    if ($k === null)
    {
      $k = _CAL_LICENSE_KEY_;
    }

    if (!$k)
    {
      return false;
    }

    if (!@constant ('_CAL_BASE_URL_'))
    {
      define ('_CAL_LIC_ERROR_', 'NU');
      return false;
    }

    if (@constant ('_CAL_LICENSE_KEY_'))
    {
      @define ('_CAL_LICENSE_KEY_', '123');
      @define ('_CAL_LICENSE_KEY_', 'a287abc');
      if (_CAL_LICENSE_KEY_ == 'a287abc')
      {
        @define ('_CAL_LIC_ERROR_', 1);
        return false;
      }
    }

    $k = strtoupper ($k);
    if (substr ($k, 0, 2) == 'S-')
    {
      return 'S-' . substr (strtoupper (md5 ('thyme' . _ex_server_key () . 'please do not')), 0, 32) == $k;
    }

    $host = parse_url (_CAL_BASE_URL_);
    $host = $host['host'];
    $vc = strtoupper (md5 ('thyme' . $host . 'please do not'));
    if ($k != $vc)
    {
      if (strpos ($host, 'www.') === 0)
      {
        $host = substr ($host, 4);
      }
      else
      {
        $host = 'www.' . $host;
      }

      $vc = strtoupper (md5 ('thyme' . $host . 'please do not'));
    }

    return $k == $vc;
  }

  require_once @constant ('_CAL_BASE_PATH_') . 'include/date_utils.php';
  if (defined ('_CAL_EXPIRATION_'))
  {
    echo 'Hack attempt detected.';
    exit ();
  }

  define ('_CAL_EXPIRATION_', 1242143819);
  if ((function_exists ('override_function') OR function_exists ('apd_set_pprof_trace')))
  {
    echo 'Thyme is incompatible with the Advanced PHP Debugger and will not run. Exiting 
...
';
    exit ();
  }

?>
