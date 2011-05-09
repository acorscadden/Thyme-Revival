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


  class _cal_vcal
  {
    var $file = null;
    var $events = array ();
    var $timezones = array ();
    var $settings = null;
    var $decoder_functions = array ('quoted-printable' => 'quoted_printable_decode', 'base64' => 'base64_decode', '8bit' => 'utf8_decode');
    var $str_match = array (0 => '/(?<!\\\\)\\\\n/i', 1 => '/(?<!\\\\)\\\\/', 2 => '/(?<!\\\\)\'\'/');
    var $str_replace = array (0 => '
', 1 => '', 2 => '\'');
    function vdate_to_ts ($vdate, $plus_d = '0', $plus_m = '0', $plus_y = '0')
    {
      while (strpos ($vdate, ':') !== false)
      {
        $vdate = substr ($vdate, strpos ($vdate, ':') + 1);
      }

      $y = substr ($vdate, 0, 4) + $plus_y;
      $m = substr ($vdate, 4, 2) + $plus_m;
      $d = substr ($vdate, 6, 2) + $plus_d;
      $H = substr ($vdate, 9, 2);
      $M = substr ($vdate, 11, 2);
      $Z = substr ($vdate, 15, 1);
      $TS = _ex_mktime ($H, $M, $S, $m, $d, $y);
      return $TS;
    }

    function unescape (&$line)
    {
      $charat = 0;
      while ($pos = strpos ($line, '\\', $charat) !== false)
      {
        $next = substr ($line, $pos + 1, 1);
        switch ($next)
        {
          case 'N':
          {
          }

          case 'n':
          {
            $line = substr ($line, 0, $pos) . '
' . substr ($line, $pos + 2);
            $charat = $pos;
            break;
          }

          default:
          {
            $line = substr ($line, 0, $pos) . $next . substr ($line, $pos + 2);
            $charat = $pos + 2;
          }
        }
      }

      return str_replace ('\'\'', '\'', $line);
    }

    function read_vcal ($filename)
    {
      @ini_set ('memory_limit', '15M');
      $this->events = array ();
      $file = file_get_contents ($filename);
      if (preg_match ('/\\sVERSION:(.*?)\\s/m', $file, $v))
      {
        $this->version = intval ($v[1]);
      }
      else
      {
        $this->version = null;
      }

      if ($this->version != 1)
      {
        $file = str_replace (array ('
', '
'), '
', $file);
        $file = str_replace (array ('
 ', '
	'), '', $file);
      }

      $this->objects = array ();
      $order = 1;
      $pos = 0;
      $file = $this->parse_lines ($file);
      foreach ($file as $line)
      {
        if (!strlen ($line))
        {
          continue;
        }

        @set_time_limit (30);
        $elms = array ();
        preg_match ('/^\\s*(.+?)(?<!\\\\)([:|;])(.+)/ms', $line, $elms);
        $k = &$elms[1];
        $v = &$elms[3];
        switch (strtolower ($k))
        {
          case 'begin':
          {
            $objs[++$pos]['_type'] = $v;
            $objs[$pos]['_order'] = $order++;
            $objs[$pos]['_parent'] = $parent;
            $parent = array ($v, intval ($$v));
            ++$$v;
            break;
          }

          case 'end':
          {
            $parent = $objs[$pos]['_parent'];
            $this->objects[$objs[$pos]['_order']] = $objs[$pos];
            $parents[$objs[$pos]['_type']][] = $objs[$pos]['_order'];
            unset ($objs[$pos--]);
            break;
          }

          default:
          {
            if (($elms[2] == ';' OR $elms[1] == 'RRULE'))
            {
              $v = $this->param_split ($v, $k);
            }

            $v = preg_replace ($this->str_match, $this->str_replace, $v);
            if ((is_array ($objs[$pos][$k]) AND $objs[$pos][$k][0]))
            {
              $objs[$pos][$k][] = $v;
              break;
            }
            else
            {
              if ((isset ($objs[$pos][$k]) AND !$objs[$pos][$i][0]))
              {
                $oldv = $objs[$pos][$k];
                $objs[$pos][$k] = array ($oldv, $v);
                break;
              }
              else
              {
                $objs[$pos][$k] = $v;
              }
            }
          }
        }
      }

      $i = $order - 1;
      while (0 < $i)
      {
        $obj = &$this->objects[$i];
        if (!is_array ($obj['_parent']))
        {
          $this->objects[$obj['_type'] . 'S'][] = $obj;
        }
        else
        {
          $parent = $parents[$obj['_parent'][0]][$obj['_parent'][1]];
          $type = strtoupper ($obj['_type'] . 'S');
          $this->objects[$parent][$type][] = $obj;
        }

        unset ($this->objects[$obj['_order']]);
        --$i;
      }

    }

    function param_split ($v, $k = '')
    {
      $ret = array ();
      $params = array ();
      $offset = 0;
      if (preg_match ('/^VALUE(?<!\\\\)[:|;|=]/', $v, $params))
      {
        return array ('VALUE' => substr ($v, 6));
      }

      if (preg_match ('/^(.*?)=("?)(.*?)\\2:(.+)/s', $v, $params))
      {
        if (($params[1] == 'ENCODING' AND $this->decoder_functions[strtolower ($params[3])]))
        {
          $params[4] = call_user_func ($this->decoder_functions[strtolower ($params[3])], $params[4]);
          return $params[4];
        }

        return array ($params[1] => $params[3], 'VALUE' => $params[4]);
      }

      while ((preg_match ('' . '/(.+?)(?<!\\\\)([:|;|\\=])("?)(.+?)\\3(?:(?<!\\\\)[:|;|\\=].+?(?<!\\\\)[:|;|\\=]|$)/', $v, $params) AND ($v = substr ($v, strlen ($params[1]) + strlen ($params[3]) * 2 + strlen ($params[4]) + 2) OR true)))
      {
        $ret[$params[1]] = preg_replace ($this->str_match, $this->str_replace, $params[4]);
      }

      return $ret;
    }

    function parse_rrule ($rr)
    {
      switch (strtolower ($rr['FREQ']))
      {
        case 'yearly':
        {
        }

        case 'monthly':
        {
        }

        case 'weekly':
        {
        }

        default:
        {
        }
      }

      while (true)
      {
        if (!strlen ($rr['FREQ']))
        {
          break;
        }

        if ()
        {
          $interval = intval ($rr['INTERVAL']);
          return null;
        }
      }
    }

    function parse_list ($str)
    {
      if (substr (strtolower (rtrim ($str)), 0, 6) == 'value=')
      {
        return array ('VALUE' => substr ($str, 6));
      }

      if (preg_match ('/(?<!\\\\)"/', $str))
      {
        $items = preg_split ('/(?<!\\\\)(")/', $str, 0 - 1, PREG_SPLIT_DELIM_CAPTURE);
      }

      $props = preg_split ('/(?<!\\\\):/', $str);
      $ret[$props[count ($props) - 1]] = $props[count ($props) - 1];
      unset ($props[count ($props) - 1]);
      $ret[$props[count ($props) - 1]] = $props[count ($props) - 1];
      unset ($props[count ($props) - 1]);
      $props = explode (';', $props);
      foreach ($props as $p)
      {
        list ($k, $v) = explode ('=', $p);
        $ret[strtoupper ($k)] = $v;
      }

      $ret['VALUE'] = $val;
      return $ret;
    }

    function parse_lines (&$file)
    {
      if ($this->version == 1)
      {
        return $this->v1_lines ($file);
      }

      return $this->v2_lines ($file);
    }

    function v2_lines (&$file)
    {
      return explode ('
', $file);
    }

    function v1_lines (&$file)
    {
      $lines = array ();
      $qp = 0;
      foreach (preg_split ('/(
|
)/', $file) as $l)
      {
        if (trim ($l) === '')
        {
          continue;
        }

        if (preg_match ('/^[A-Za-z|\\-]+[:|;]/', $l))
        {
          if (preg_match ('/^[A-Za-z|\\-]+;ENCODING=QUOTED-PRINTABLE:/', $l))
          {
            $qp = 1;
          }
          else
          {
            $qp = 0;
          }

          $lines[] = $l;
          continue;
        }
        else
        {
          if (($qp AND substr ($lines[count ($lines) - 1], 0 - 1) == '='))
          {
            $lines[count ($lines) - 1] = rtrim ($lines[count ($lines) - 1], '=');
          }
          else
          {
            if ((!$qp AND substr ($l, 0, 1) == ' '))
            {
              $l = ltrim ($l, ' ');
            }
          }

          $lines[count ($lines) - 1] .= $l;
          continue;
        }
      }

      return $lines;
    }
  }

  error_reporting (E_ALL & ~E_NOTICE);
?>