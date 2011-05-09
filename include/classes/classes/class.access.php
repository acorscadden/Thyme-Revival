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


  class _cal_access
  {
    var $uid = null;
    var $cache = array ();
    var $user = null;
    function _cal_access ($uid)
    {
      $this->uid = $uid;
    }

    function get_cals ($access_lvl = 0, $query = '', $internal = false)
    {
      global $_cal_sql;
      global $_cal_user;
      global $_cal_dbpref;
      if (strlen ($query))
      {
        $q = '' . 'and (' . $query . ')';
      }
      else
      {
        $q = '';
      }

      $fields = array ('' . $_cal_dbpref . 'Calendars.id', '' . $_cal_dbpref . 'Calendars.title', '' . $_cal_dbpref . 'Calendars.description', '' . $_cal_dbpref . 'Calendars.owner', '' . $_cal_dbpref . 'Calendars.type');
      $fields = join (',', $fields);
      if ($this->user->admin)
      {
        $clist = $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'Calendars where type = 0 ' . $q);
        if ($access_lvl != 1)
        {
          $clist = array_merge ($clist, $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'Calendars where
            (owner = 0 or owner = ' . $this->uid . ') and (type = 1 or (type = 2 and ' . $_cal_sql->sql_binary_and ('options', 1) . ('' . ' = 1)) ' . $q)));
        }
      }
      else
      {
        if (!$this->user->guest)
        {
          $cals_e = $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'Calendars
           left join ' . $_cal_dbpref . 'CalendarMembers on
           (' . $_cal_dbpref . 'CalendarMembers.cid = ' . $_cal_dbpref . 'Calendars.id
           and ' . $_cal_dbpref . 'CalendarMembers.rid = 0)
           where ' . $_cal_dbpref . 'Calendars.type in (0,3,4) and
               ' . $_cal_dbpref . 'CalendarMembers.access_lvl >= ' . $access_lvl . ' ' . $q);
          $cals_g = $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'CalendarMembers
         left join ' . $_cal_dbpref . 'GroupMembers on ' . $_cal_dbpref . 'CalendarMembers.rid = ' . $_cal_dbpref . 'GroupMembers.gid
           and ' . $_cal_dbpref . 'CalendarMembers.rtype = 1 and ' . $_cal_dbpref . 'CalendarMembers.access_lvl >= ' . $access_lvl . ('' . ' 
         left join ' . $_cal_dbpref . 'Calendars on ' . $_cal_dbpref . 'Calendars.id = ' . $_cal_dbpref . 'CalendarMembers.cid
         where (' . $_cal_dbpref . 'Calendars.Type = 0 and ' . $_cal_dbpref . 'GroupMembers.uid = ') . $this->uid . ') ' . $q);
        }
        else
        {
          $cals_g = $cals_e = array ();
        }

        $cals_u = $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'CalendarMembers
         left join ' . $_cal_dbpref . 'Calendars on ' . $_cal_dbpref . 'Calendars.id = ' . $_cal_dbpref . 'CalendarMembers.cid
         where (rid = ' . $this->uid . ' and rtype = 0 and access_lvl >= ' . $access_lvl . ') ' . $q);
        if (!$this->user->guest)
        {
          if ($access_lvl != 1)
          {
            $cals_o = $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'Calendars where
              owner = ' . $this->uid . ' ' . $q);
          }
          else
          {
            $cals_o = $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'Calendars where
              type = 0 and owner = ' . $this->uid . ' ' . $q);
          }
        }
        else
        {
          if (($access_lvl == 0 AND $this->user->guest))
          {
            $cals_o = $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'Calendars where (
              (owner = 0 and type = 1  and (' . $_cal_sql->sql_binary_and ('options', 2) . ' < 2)) 
                or (type = 2 and (' . $_cal_sql->sql_binary_and ('options', 3) . ' = 1))) ' . $q);
          }
          else
          {
            $cals_o = array ();
          }
        }

        if (($access_lvl == 0 AND !$this->user->guest))
        {
          $cals_o = array_merge ($cals_o, $_cal_sql->query ('' . 'select ' . $fields . ' from ' . $_cal_dbpref . 'Calendars where
           ((owner = 0 and type = 1) or (type = 2 and ' . $_cal_sql->sql_binary_and ('options', '1') . ('' . ' >= 1)) ' . $q)));
        }

        $clist = array_merge ($cals_e, $cals_g, $cals_u, $cals_o);
      }

      foreach ($clist as $c)
      {
        $cals[$c['id']] = $c;
      }

      return $cals;
    }

    function csort ($a, $b)
    {
      return strnatcasecmp ($a['title'], $b['title']);
    }

    function get_cals_sel ($access_lvl = 0, $query = '')
    {
      $cals = $this->get_cals ($access_lvl, $query);
      if (!count ($cals))
      {
        return array ();
      }

      $rcals = array ();
      foreach ($cals as $c)
      {
        $rcals[$c['id']] = $c['title'];
      }

      natcasesort ($rcals);
      return $rcals;
    }

    function add_any ()
    {
    }

    function check_access (&$cal_obj, $access_lvl, $from_event = false)
    {
      global $_cal_sql;
      global $_cal_dbpref;
      global $_cur_cal;
      $cal_id = abs ($cal_obj->id);
      if ($cal_id == 0)
      {
        return false;
      }

      if (isset ($this->cache[$cal_id][$access_lvl]))
      {
        return $this->cache[$cal_id][$access_lvl];
      }

      if ($cal_obj->type == 0)
      {
        $constraint = ' = ' . $cal_id;
      }
      else
      {
        if ($cal_obj->type == 1)
        {
          if ($access_lvl == 1)
          {
            return false;
          }

          if ((($this->user->guest AND $cal_obj->owner == 0) AND $cal_obj->options & 2))
          {
            return false;
          }

          if (($this->user->admin AND $cal_obj->owner == 0))
          {
            return true;
          }

          if (($cal_obj->owner == 0 AND $access_lvl == 0))
          {
            return true;
          }

          if ((!$this->user->guest AND $cal_obj->owner == $this->uid))
          {
            return true;
          }

          return false;
        }

        if ($cal_obj->type == 2)
        {
          if ($access_lvl == 1)
          {
            return false;
          }

          if (($this->user->guest AND $cal_obj->options & 2))
          {
            return false;
          }

          if (($access_lvl == 0 AND !($cal_obj->options & 1)))
          {
            return false;
          }

          if ($access_lvl == 0)
          {
            return true;
          }

          if (($access_lvl == 2 AND $this->user->admin))
          {
            return true;
          }

          return false;
        }
      }

      $cal = $this->get_cals ($access_lvl, '' . ' ' . $_cal_dbpref . 'Calendars.id ' . $constraint . ' ', true);
      if ((($from_event AND $access_lvl == 0) AND !count ($cal)))
      {
        $cal = $this->global_view_explicit ($constraint);
      }

      if (!isset ($this->cache[$cal_id]))
      {
        $this->cache[$cal_id] = array ();
      }

      if ((($cal_obj->type == 0 AND $access_lvl < 2) AND !count ($cal)))
      {
        list ($poster) = $_cal_sql->query ('' . 'select id from ' . $_cal_dbpref . 'Groups
       left join ' . $_cal_dbpref . 'GroupMembers on
            ' . $_cal_dbpref . 'Groups.id = ' . $_cal_dbpref . 'GroupMembers.gid
        where name like \'posters\' and uid = ' . $this->uid);
        if ($poster['id'])
        {
          list ($poster) = $_cal_sql->query ('' . 'select access_lvl from ' . $_cal_dbpref . 'CalendarMembers
            where cid = ' . $cal_obj->id . ' and rid = ' . $poster['id'] . ' and rtype = 1');
          if (0 < $poster['access_lvl'])
          {
            $cal = array ('1');
          }
        }
      }

      $this->cache[$cal_id][$access_lvl] = count ($cal);
      return $this->cache[$cal_id][$access_lvl];
    }

    function global_view_explicit ($constraint)
    {
      global $_cal_sql;
      global $_cal_dbpref;
      $cals = $_cal_sql->query ('' . 'select id from ' . $_cal_dbpref . 'Calendars 
        left join ' . $_cal_dbpref . 'CalendarMembers on ' . $_cal_dbpref . 'Calendars.id = ' . $_cal_dbpref . 'CalendarMembers.cid
        where (' . $_cal_dbpref . 'Calendars.type = 1 and ' . $_cal_dbpref . 'Calendars.owner = 0 
        and ' . $_cal_sql->sql_binary_and ('' . $_cal_dbpref . 'Calendars.options', '1') . ('' . ' >= 1)
        and ' . $_cal_dbpref . 'CalendarMembers.rid ' . $constraint));
      return $cals;
    }

    function can_view_from_event (&$cal)
    {
      return $this->check_access ($cal, 0, true);
    }

    function can_view (&$cal, $ignore_cur_cal = false)
    {
      return $this->check_access ($cal, 0);
    }

    function can_add (&$cal)
    {
      return $this->check_access ($cal, 1);
    }

    function can_admin (&$cal)
    {
      return $this->check_access ($cal, 2);
    }
  }

?>