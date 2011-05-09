<?php



  function _ex_wday_offset ($wday, $date)
  {
    if (!is_numeric ($date))
    {
      $date = _ex_strtotime ($date);
    }

    $cwday = _ex_date ('w', $date);
    if ($wday < $cwday)
    {
      $da = 7 - $cwday + $wday;
    }
    else
    {
      if ($cwday < $wday)
      {
        $da = $wday - $cwday;
      }
    }

    return $da;
  }

  function _ex_display_time_long ($time)
  {
    global $_cal_user;
    if ($_cal_user->options->hour_format == 12)
    {
      $ap = (12 <= _ex_date ('G', $time) ? _PM_ : _AM_);
      $time_long = _ex_date ('g:i', $time);
      $time_long .= ' ' . $ap;
    }
    else
    {
      $time_long = _ex_date ('H:i', $time);
    }

    return $time_long;
  }

  function _ex_display_time_med ($time)
  {
    global $_cal_user;
    if ($_cal_user->options->hour_format == 12)
    {
      $ap = (12 <= _ex_date ('G', $time) ? _PM_ : _AM_);
      $time_short = _ex_date ('g', $time);
      if (0 < _ex_date ('i', $time))
      {
        $time_short .= ':' . _ex_date ('i', $time);
      }

      $time_short .= ' ' . $ap;
    }
    else
    {
      $time_short = _ex_date ('H', $time);
      $time_short .= ':' . _ex_date ('i', $time);
    }

    return $time_short;
  }

  function _ex_display_time_short ($time)
  {
    global $_cal_user;
    if (@defined ('_CAL_TIME_SMALL_FORMAT_'))
    {
      return _ex_date (_CAL_TIME_SMALL_FORMAT_, $time);
    }

    if ($_cal_user->options->hour_format == 12)
    {
      $ap = (12 <= _ex_date ('G', $time) ? _PM_SHORT_ : _AM_SHORT_);
      $time_short = _ex_date ('g', $time);
      if (0 < _ex_date ('i', $time))
      {
        $time_short .= ':' . _ex_date ('i', $time);
      }

      $time_short .= $ap;
    }
    else
    {
      $time_short = _ex_date ('H', $time);
      if (0 < _ex_date ('i', $time))
      {
        $time_short .= ':' . _ex_date ('i', $time);
      }
    }

    return $time_short;
  }

  function _ex_array_search2 ($n, $arr1, $arr2)
  {
    $i = count ($arr1);
    while (0 <= $i)
    {
      if (strtolower ($n) == strtolower ($arr1[$i]))
      {
        return $i;
      }

      --$i;
    }

    $i = count ($arr2);
    while (0 <= $i)
    {
      if (strtolower ($n) == strtolower ($arr2[$i]))
      {
        return $i;
      }

      --$i;
    }

    return FALSE;
  }

  function _ex_date_diff ($d1, $d2)
  {
    if (!is_numeric ($d1))
    {
      list ($d1) = explode (' ', $d1);
      list ($d2) = explode (' ', $d2);
      $d1 = _ex_strtotime ($d1 . ' 0:0:0');
      $d2 = _ex_strtotime ($d2 . ' 0:0:0');
    }

    return _ex_toint (($d1 - $d2) / 86400);
  }

  function _ex_date_calc ($d, $strfunc)
  {
    return _ex_date ('Y-n-j H:i', _ex_strtotime ($d . ' ' . $strfunc));
  }

  function getlocaltime ($d = null)
  {
    return _ex_localtime ($d);
  }

  function _ex_localtime ($d = null)
  {
    global $_cal_user;
    if ($d === null)
    {
      global $_cal_cached_time;
      if ($_cal_cached_time)
      {
        $gmt_time = $_cal_cached_time;
      }
      else
      {
        $_cal_cached_time = $gmt_time = time ();
      }
    }
    else
    {
      if (strchr ($d, '-'))
      {
        $gmt_time = _ex_strtotime ($d);
      }
      else
      {
        if (is_numeric ($d))
        {
          $gmt_time = $d;
        }
        else
        {
          $gmt_time = time ();
        }
      }
    }

    return $_cal_user->to_localtime ($gmt_time);
  }

  function _ex_get_dst ($d)
  {
    global $_cal_user;
    global $_cal_dst;
    if ($_cal_user->options->dst == 0 - 1)
    {
      return 0;
    }

    if ($_cal_user->options->dst == 0)
    {
      return 1;
    }

    require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.dst.php';
    if ($d === null)
    {
      ($dst OR $dst = new _cal_dst ());
      return $dst->is_dst ($d);
    }

    $ndst = new _cal_dst ();
    return $ndst->is_dst ($t);
  }

  function gmtstrtotime ($str = null, $fast = false)
  {
    return _ex_strtotime ($str, $fast);
  }

  function _ex_strtotime ($str = null, $fast = false)
  {
    global $_cal_months;
    global $_cal_html;
    global $_cal_months_abbr;
    global $_cal_weekdays;
    global $_cal_weekdays_abbr;
    if (($fast OR preg_match ('/^\\d{4}-\\d{1,2}-\\d{1,2}( \\d+:\\d+)?/', $str)))
    {
      list ($d, $t) = preg_split ('/ /', $str);
      list ($yr, $mo, $da) = preg_split ('/-/', $d);
      list ($hr, $mn, $sc) = preg_split ('/:/', $t);
      return _ex_mktime ($hr, $mn, 0, $mo, $da, $yr);
    }

    if (($str == '' AND $str !== 0))
    {
      return time ();
    }

    if (((!preg_match('/[^0-9]/', $str) OR (substr ($str, 0, 1) == '-' AND !preg_match ('/[^0-9]/', substr ($str, 1)))) AND 4 < strlen ($str)))
    {
      return $str;
    }

    list ($yr, $mo, $da) = explode ('-', _ex_date ('Y-n-j'));
    list ($hr, $mn, $sc) = explode (':', _ex_date ('H:i:s'));
    $str_items = explode (' ', $str);
    preg_match ('/[^a-z]/i', _DATE_INT_FULL_, $matches);
    $date_delim = $matches[0];
    $i = 0;
    while ($i < count ($str_items))
    {
      $d = $str_items[$i];
      if (0 < strpos ($d, ':'))
      {
        list ($hr, $mn, $sc) = explode (':', $d);
      }
      else
      {
        if (strpos ($d, $date_delim))
        {
          if (@constant ('_CAL_EURO_DATE_') == 1)
          {
            list ($da, $mo, $yr) = explode ($date_delim, $d);
          }
          else
          {
            list ($mo, $da, $yr) = explode ($date_delim, $d);
          }

          if (strlen ($yr) == 2)
          {
            if (50 < $yr)
            {
              $yr += 1900;
            }
            else
            {
              $yr += 2000;
            }
          }
          else
          {
            if (!$yr)
            {
              $yr = _ex_date ('Y');
            }
          }
        }
        else
        {
          if ((ctype_digit ($d) AND strlen ($d) == 4))
          {
            $yr = $d;
          }
          else
          {
            if (ctype_digit ($d))
            {
              $da = $d;
            }
            else
            {
              if (strpos ($d, '+') === 0)
              {
                $val = substr ($d, 1);
                $str = $str_items[++$i];
                switch (strtolower ($str))
                {
                  case 'days':
                  {
                  }

                  case strtolower (_DAYS_):
                  {
                    $da += $val;
                    break;
                  }

                  case 'weeks':
                  {
                  }

                  case strtolower (_WEEKS_):
                  {
                    $da += $val * 7;
                    break;
                  }

                  case 'months':
                  {
                  }

                  case strtolower (_MONTHS_):
                  {
                    $mo += $val;
                    break;
                  }

                  case 'years':
                  {
                  }

                  case strtolower (_YEARS_):
                  {
                    $yr += $val;
                    break;
                  }

                  case 'hours':
                  {
                  }

                  case strtolower (_HOURS_):
                  {
                    $hr += $val;
                    break;
                  }

                  case 'minutes':
                  {
                  }

                  case strtolower (_MINUTES_):
                  {
                    $mn += $val;
                    break;
                  }

                  case 'seconds':
                  {
                  }

                  case strtolower (_SECONDS_):
                  {
                    $sc += $val;
                  }
                }
              }
              else
              {
                if (strpos ($d, '-') === 0)
                {
                  $val = substr ($d, 1);
                  $str = $str_items[++$i];
                  switch (strtolower ($str))
                  {
                    case 'days':
                    {
                    }

                    case strtolower (_DAYS_):
                    {
                      $da -= $val;
                      break;
                    }

                    case 'months':
                    {
                    }

                    case strtolower (_MONTHS_):
                    {
                      $mo -= $val;
                      break;
                    }

                    case 'weeks':
                    {
                    }

                    case strtolower (_WEEKS_):
                    {
                      $da += $val * 7;
                      break;
                    }

                    case 'years':
                    {
                    }

                    case strtolower (_YEARS_):
                    {
                      $yr -= $val;
                      break;
                    }

                    case 'hours':
                    {
                    }

                    case strtolower (_HOURS_):
                    {
                      $hr -= $val;
                      break;
                    }

                    case 'minutes':
                    {
                    }

                    case strtolower (_MINUTES_):
                    {
                      $mn -= $val;
                      break;
                    }

                    case 'seconds':
                    {
                    }

                    case strtolower (_SECONDS_):
                    {
                      $sc -= $val;
                    }
                  }
                }
                else
                {
                  if ((strtolower ($d) == strtolower (_NEXT_) OR strtolower ($d) == 'next'))
                  {
                    $str = $str_items[++$i];
                    switch (strtolower ($str))
                    {
                      case 'week':
                      {
                      }

                      case strtolower (_WEEK_):
                      {
                        $da += 7;
                        break;
                      }

                      case 'month':
                      {
                      }

                      case strtolower (_MONTH_):
                      {
                        ++$mo;
                        break;
                      }

                      case 'year':
                      {
                      }

                      case strtolower (_YEAR_):
                      {
                        ++$yr;
                        break;
                      }

                      default:
                      {
                        if ($a = _ex_array_search2 ($str, $_cal_months, $_cal_months_abbr) !== false)
                        {
                          $mo = $a;
                          ++$yr;
                          break;
                        }
                        else
                        {
                          if ($a = _ex_array_search2 ($str, $_cal_weekdays, $_cal_weekdays_abbr) !== false)
                          {
                            $da += _ex_wday_offset ($a, _ex_mktime (0, 0, 0, $mo, $da, $yr));
                            $da += 7;
                          }
                        }
                      }
                    }
                  }
                  else
                  {
                    if ((strtolower ($d) == strtolower (_LAST_) OR strtolower ($d) == 'last'))
                    {
                      $str = $str_items[++$i];
                      switch (strtolower ($str))
                      {
                        case 'week':
                        {
                        }

                        case strtolower (_WEEK_):
                        {
                          $da -= 7;
                          break;
                        }

                        case 'month':
                        {
                        }

                        case strtolower (_MONTH_):
                        {
                          --$mo;
                          break;
                        }

                        case 'year':
                        {
                        }

                        case strtolower (_YEAR_):
                        {
                          --$yr;
                          break;
                        }

                        default:
                        {
                          if ($a = _ex_array_search2 ($str, $_cal_months, $_cal_months_abbr) !== false)
                          {
                            $mo = $a;
                            --$yr;
                            break;
                          }
                          else
                          {
                            if ($a = _ex_array_search2 ($str, $_cal_weekdays, $_cal_weekdays_abbr) !== false)
                            {
                              $da += _ex_wday_offset ($a, _ex_mktime (0, 0, 0, $mo, $da, $yr));
                              $da -= 7;
                            }
                          }
                        }
                      }
                    }
                    else
                    {
                      if ($a = _ex_array_search2 ($d, $_cal_months, $_cal_months_abbr) !== false)
                      {
                        $mo = $a;
                      }
                      else
                      {
                        if ($a = _ex_array_search2 ($d, $_cal_weekdays, $_cal_weekdays_abbr) !== false)
                        {
                          $da += _ex_wday_offset ($a, _ex_mktime (0, 0, 0, $mo, $da, $yr));
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }

      ++$i;
    }

    return _ex_mktime ($hr, $mn, $sc, $mo, $da, $yr);
  }

  function _ex_date ($fmt, $secs = null)
  {
    if (($secs === null OR (0 - 1 < $secs AND $secs < 2145916800)))
    {
      if ((substr (_CAL_LANG_, 0, 2) != 'en' AND preg_match ('/[l|D|F|M]/', $fmt)))
      {
        $mnum = ($secs === null ? gmdate ('n') : gmdate ('n', $secs));
        $dotw = ($secs === null ? gmdate ('w') : gmdate ('w', $secs));
        $tday = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_weekdays'][$dotw]);
        $tday_abbr = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_weekdays_abbr'][$dotw]);
        $tmonth = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_months'][$mnum]);
        $tmonth_abbr = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_months_abbr'][$mnum]);
        $fmt = preg_replace ('/(?<!\\\\)l/', $tday, $fmt);
        $fmt = preg_replace ('/(?<!\\\\)D/', $tday_abbr, $fmt);
        $fmt = preg_replace ('/(?<!\\\\)F/', $tmonth, $fmt);
        $fmt = preg_replace ('/(?<!\\\\)M/', $tmonth_abbr, $fmt);
      }

      return ($secs === null ? gmdate ($fmt) : gmdate ($fmt, $secs));
    }

    $mos = array (0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
    $yr_tbl = array (4 => array (0 => 1970, 1 => 1976), 5 => array (0 => 1971, 1 => 1988), 6 => array (1 => 1972, 0 => 1977), 1 => array (0 => 1973, 1 => 1996), 2 => array (0 => 1974, 1 => 1980), 3 => array (0 => 1975, 1 => 1992), 0 => array (0 => 1978, 1 => 1984));
    $days = _ex_toint ($secs / 86400);
    $secs = _ex_toint ($secs - 86400 * $days);
    if ($secs < 0)
    {
      --$days;
      $secs += 86400;
    }

    $dotw = $days + 4;
    $j = _ex_toint ($days / 146097);
    $i = _ex_toint ($days - 146097 * $j);
    $a = _ex_toint (_ex_toint ($days - 146097 * $j) + 719468);
    $b = _ex_toint (_ex_toint (4 * $a + 3) / 146097);
    $c = _ex_toint ($a - _ex_toint (_ex_toint (146097 * $b) / 4));
    $d = _ex_toint (_ex_toint (4 * $c + 3) / 1461);
    $e = _ex_toint ($c - _ex_toint (_ex_toint (1461 * $d) / 4));
    $m = _ex_toint ((5 * $e + 2) / 153);
    $year = _ex_toint (400 * $j + 100 * $b + $d + _ex_toint ($m / 10));
    $mon = _ex_toint ($m + 3 - 12 * _ex_toint ($m / 10));
    $day = _ex_toint ($e - _ex_toint ((153 * $m + 2) / 5) + 1);
    $hour = _ex_toint ($secs / 3600);
    $secs = _ex_toint ($secs - 3600 * $hour);
    $min = _ex_toint ($secs / 60);
    $sec = _ex_toint ($secs - 60 * $min);
    $fmt = preg_replace ('/(?<!\\\\)Y/', $year, $fmt);
    $fmt = preg_replace ('/(?<!\\\\)y/', floor ($year / 100), $fmt);
    $fmt = preg_replace ('/(?<!\\\\)U/', $epoch, $fmt);
    $fmt = preg_replace ('/(?<!\\\\)r/', 'D, ' . ($day < 10 ? ' ' . $day : $day) . ' M ' . $year . ' H:i:s O', $fmt);
    if (4 < substr (phpversion (), 0, 1))
    {
      $fmt = preg_replace ('/(?<!\\\\)c/', $year . '-m-d\\TH:i:s+00:00', $fmt);
    }

    $dotw -= $mos[$mon - 1];
    $dotw -= $day - 1;
    if ((_ex_is_leap_year ($year) AND 3 <= $mon))
    {
      --$dotw;
    }

    $dotw = $dotw % 7;
    if ($dotw < 0)
    {
      $dotw += 7;
    }

    $yr = $yr_tbl[$dotw][_ex_is_leap_year ($year)];
    if ((substr (_CAL_LANG_, 0, 2) != 'en' AND preg_match ('/[l|D|F|M]/', $fmt)))
    {
      $mnum = gmdate ('n', gmmktime ($hour, $min, 0, $mon, $day, $yr));
      $tday = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_weekdays'][$dotw]);
      $tday_abbr = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_weekdays_abbr'][$dotw]);
      $tmonth = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_months'][$mnum]);
      $tmonth_abbr = preg_replace ('/(.)/', '\\\\\\1', $GLOBALS['_cal_months_abbr'][$mnum]);
      $fmt = preg_replace ('/(?<!\\\\)l/', $tday, $fmt);
      $fmt = preg_replace ('/(?<!\\\\)D/', $tday_abbr, $fmt);
      $fmt = preg_replace ('/(?<!\\\\)F/', $tmonth, $fmt);
      $fmt = preg_replace ('/(?<!\\\\)M/', $tmonth_abbr, $fmt);
    }

    return gmdate ($fmt, gmmktime ($hour, $min, 0, $mon, $day, $yr));
  }

  function _ex_mktime ($hr = 0, $min = 0, $sec = 0, $mon = 0, $day = 0, $yr = 0, $isdst = 0)
  {
    if ((1972 < $yr AND $yr < 2028))
    {
      return gmmktime (intval ($hr), intval ($min), intval ($sec), intval ($mon), intval ($day), intval ($yr));
    }

    $mos = array (0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
    $mt = array (0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $mtl = array (0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    if ((59 < $sec OR $sec < 0))
    {
      $min += _ex_toint ($sec / 60);
      $sec = (59 < $sec ? $sec % 60 : 60 + $sec);
    }

    if ((59 < $min OR $min < 0))
    {
      $hr += _ex_toint ($min / 60);
      $min = (59 < $min ? $min % 60 : 60 + $min);
    }

    if ((23 < $hr OR $hr < 0))
    {
      $day += _ex_toint ($hr / 24);
      $hr = (23 < $hr ? $hr % 24 : 24 + $hr);
    }

    $time = $hr * 3600;
    $time += $min * 60;
    $time += $sec;
    if (12 < $mon)
    {
      $y = _ex_toint ($mon / 12);
      $yr += $y;
      $mon -= $y * 12;
    }

    while ($mon < 1)
    {
      $y = max (_ex_toint ($mon / 12), 1);
      $yr -= $y;
      $mon += 12 * $y;
    }

    while ((_ex_is_leap_year ($yr) ? $mtl[$mon] : $mt[$mon]) < $day)
    {
      $day -= (_ex_is_leap_year ($yr) ? $mtl[$mon] : $mt[$mon]);
      ++$mon;
      if (12 < $mon)
      {
        $mon = 1;
        ++$yr;
        continue;
      }
    }

    while ($day < 1)
    {
      --$mon;
      if ($mon == 0)
      {
        $mon = 12;
        --$yr;
        $day += 31;
        if ($day == 0)
        {
          $day == 1;
          continue;
        }

        continue;
      }
      else
      {
        $day += (_ex_is_leap_year ($yr) ? $mtl[$mon] : $mt[$mon]);
        continue;
      }
    }

    $time += $mos[$mon - 1] * 86400;
    $time += ($day - 1) * 86400;
    $time += (_ex_toint ($yr / 4) - _ex_toint ($yr / 100) + _ex_toint ($yr / 400) - 477) * 86400;
    if ((_ex_is_leap_year ($yr) AND (($mon == 2 AND $day <= 29) OR $mon < 2)))
    {
      $time -= 86400;
    }

    $time += ($yr - 1970) * (365 * 86400);
    return $time;
  }

  function _ex_mo_wdst ($m, $y, $t = null)
  {
    global $_cal_mo_wdst_cache;
    if ($t !== null)
    {
      list ($y, $m) = explode ('-', _ex_date ('Y-m', $t));
    }

    if ($_cal_mo_wdst_cache[$y][$m])
    {
      return $_cal_mo_wdst_cache[$y][$m];
    }

    $_cal_mo_wdst_cache[$y][$m] = _ex_date ('w', _ex_mktime (0, 0, 0, $m, 1, $y));
    return $_cal_mo_wdst_cache[$y][$m];
  }

  function _ex_sort_vcal ($a, $b)
  {
    $a = intval (preg_replace ('/.*?(\\-?\\d*).*/', '\\1', $a));
    $b = intval (preg_replace ('/.*?(\\-?\\d*).*/', '\\1', $b));
    if ($a == $b)
    {
      return 0;
    }

    if (($a < 0 AND $b < 0))
    {
      if ($a < $b)
      {
        return 0 - 1;
      }

      return 1;
    }

    if ((0 <= $a AND 0 <= $b))
    {
      if ($b < $a)
      {
        return 1;
      }

      return 0 - 1;
    }

    if (($a < 0 AND 0 <= $b))
    {
      return 1;
    }

    return 0 - 1;
  }

  function _ex_easter ($Year)
  {
    $G = $Year % 19;
    $C = (int)$Year / 100;
    $H = (int)$C - (int)$C / 4 - (int)(8 * $C + 13) / 25 + 19 * $G + 15 % 30;
    $I = (int)$H - (int)$H / 28 * (1 - (int)$H / 28 * (int)29 / ($H + 1) * ((int)21 - $G / 11));
    $J = ($Year + (int)$Year / 4 + $I + 2 - $C + (int)$C / 4) % 7;
    $L = $I - $J;
    $m = 3 + (int)($L + 40) / 44;
    $d = $L + 28 - 31 * (int)$m / 4;
    return _ex_mktime (0, 0, 0, $m, $d, $Year);
  }

  function _ex_idate ($fmt, $t = null)
  {
    return intval (_ex_date ($fmt, $t));
  }

  function _ex_getdate ($t = null)
  {
    if ($t == 0)
    {
      return getdate ($t);
    }

    list ($a['month'], $a['weekday'], $a['yday'], $a['year'], $a['mon'], $a['wday'], $a['mday'], $a['hours'], $a['minutes'], $a['seconds']) = explode ('-', _ex_date ('F-l-z-Y-j-w-n-G-i-s', $t));
    $a[0] = $t;
    $a['seconds'] = intval ($a['seconds']);
    $a['minutes'] = intval ($a['minutes']);
    return $a;
  }

  function _ex_is_leap_year ($yr)
  {
    if ($yr % 4 != 0)
    {
      return false;
    }

    if ($yr % 400 == 0)
    {
      return true;
    }

    if ($yr % 100 == 0)
    {
      return false;
    }

    return true;
  }

  function _ex_toint ($n)
  {
    if ($n < 0)
    {
      return 0 - floor (abs ($n));
    }

    return floor ($n);
  }

  global $_cal_weekdays;
  global $_cal_weekdays_abbr;
  global $_cal_months;
  global $_cal_months_abbr;
  global $_cal_month_days;
  global $_cal_month_ldays;
  global $_cal_vcal_wdays;
  $_cal_month_days = array (1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  $_cal_month_ldays = array (1 => 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  $_cal_vcal_wdays = array ('SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA');
?>
