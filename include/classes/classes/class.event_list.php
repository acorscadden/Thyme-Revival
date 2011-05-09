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


  class _cal_event_list
  {
    var $per_page = 10;
    var $evnt_views = array (0 => _ALL_, 1 => _UPCOMING_, 2 => _PAST_);
    var $sort_opts = array ('_DATE_' => , '_EVENT_' => , '_EVENT_TYPE_' => );
    var $usort_functions = array ('_DATE_' => , '_EVENT_' => , '_EVENT_TYPE_' => );
    var $searchstr = '';
    var $editable = 0;
    var $calendar = null;
    function _cal_event_list ($searchstr = '')
    {
      global $_cal_user;
      global $_cal_sql;
      global $_cal_dbpref;
      global $_cur_cal;
      $this->searchstr = $searchstr;
      $this->editable = ($_cal_user->access->can_admin ($_cur_cal) AND $_SESSION['calendar']);
      if ($_cur_cal->has_subcals)
      {
        $this->viewable_calendars = $_cal_user->access->get_cals_sel (0, '' . '
          ' . $_cal_dbpref . 'Calendars.id ' . $_cur_cal->get_constraint ());
      }

      if (!@constant ('_CAL_DEFAULT_EVENT_COUNT_'))
      {
        define ('_CAL_DEFAULT_EVENT_COUNT_', 10);
      }

      $this->per_page = (10 < $_SESSION['evnt_count'] ? $_SESSION['evnt_count'] : @constant ('_CAL_DEFAULT_EVENT_COUNT_'));
      if ($_cal_user->access->can_view ($_cur_cal))
      {
        require_once @constant ('_CAL_BASE_PATH_') . 'include/js/newWin.js';
      }

      if (!$_cur_cal)
      {
        require_once _CAL_BASE_PATH_ . 'include/classes/class.cal_obj.php';
        $_cur_cal = new _cal_obj ($_SESSION['calendar']);
      }

      if ($_cal_user->options->e_popup == 1)
      {
        require_once @constant ('_CAL_BASE_PATH_') . 'include/js/newWin.js';
        $this->event_view_url = 'javascript:newWin("' . @constant ('_CAL_BASE_URL_') . 'event_view.php?eid=%eid&instance=%inst", ' . intval (@constant ('_CAL_EVENT_POPUP_H_')) . ', ' . intval (@constant ('_CAL_EVENT_POPUP_W_')) . ' )';
      }
      else
      {
        $this->event_view_url = @constant ('_CAL_BASE_URL_') . _CAL_PAGE_MAIN_ . '?event_action=view&eid=%eid&instance=%inst';
      }

      $this->categories = $_cur_cal->get_categories ();
      $this->cat_icons = $_cur_cal->cat_icons;
    }

    function display_delete_multi ()
    {
      global $_cal_html;
      global $_cal_form;
      $_cal_form = new _cal_form ();
      echo '<div class="' . _CAL_CSS_EVENTLIST_ . '">
';
      require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event.php';
      $keys = array_keys ($_REQUEST);
      foreach ($keys as $key)
      {
        if (substr ($key, 0, 7) != 'delete_')
        {
          continue;
        }

        $events[] = ereg_replace ('delete_', '', $key);
      }

      if (count ($events) == 0)
      {
        $url = new _cal_url ();
        $_cal_html->js_redirect ($url->toString ());
        echo '<a href=\'' . $url->toString () . '\'>' . _RETURN_ . '</a><br>
';
        echo '</div>
';
        return null;
      }

      $_cal_html->print_heading (_DELETE_ . ' ' . _EVENTS_);
      $_cal_form->print_header ();
      echo '<table width=\'100%\'>';
      echo '<tr>
         <th align=left>
             <b>' . _ARE_YOU_SURE_DELETE_EVENTS_ . '</b>
             <br><br>
              ' . _UNCHECK_NO_DELETE_ . '<br>
         </th>
       </tr>
      <tr>
         <td>
   ';
      echo '<table border=0 width=\'100%\' cellpadding=2
           style=\'border-collapse: collapse\'>
      <tr class=\'' . _CAL_CSS_LIST_HEADER_ . '\'>
          <td><b>' . _DATE_ . '</b></td>
          <td align=center><b>' . _TIME_ . '</b></td>
          <td width=50%><b>' . _EVENT_ . '</b></td>
          <td> </td>
          <td><b>' . ($_cur_cal->has_subcals ? _CALENDAR_ : _EVENT_TYPE_) . '</b></td>
      </tr>
    ';
      $repeats = 0;
      foreach ($events as $eid)
      {
        $class = ($i++ % 2 ? 'class=\'' . _CAL_CSS_HIL_ . '\'' : 'class=\'' . _CAL_CSS_ROW_HEADER_ . '\'');
        $event = new _cal_event ($eid);
        $event->set_localtime ();
        $repeats = ($repeats ? $repeats : 0 < $event->freq);
        echo '<tr>
';
        echo '<td ' . $class . '>';
        if ($event->can_edit ())
        {
          echo $_cal_form->checkbox ('delete_' . $event->id, 'checked');
        }
        else
        {
          echo 'X';
        }

        echo ' ' . _ex_date (_DATE_INT_FULL_, $event->start) . '</td>
';
        echo '<td align=center ' . $class . '>' . ($event->allday == 1 ? _ALLDAY_ : ($event->allday == 2 ? _CAL_CALL_FOR_TIMES_MIN_ : _ex_display_time_long ($event->start))) . '</td>
';
        echo '<td ' . $class . '>' . $event->title . '</td>
';
        echo '<td  align=\'right\' ' . $class . '>' . $this->get_icons ($event) . '</td>
';
        echo '<td ' . $class . '>' . ($_cur_cal->has_subcals ? $event->cal_title : $event->type_name) . '</td>
';
        echo '</tr>
';
      }

      if ($repeats)
      {
        echo '<tr class=\'' . _CAL_CSS_HIL_ . '\'><td align=\'center\' colspan=5>
		<hr align=center width=\'100%\' /><br/>

                <table border=0 cellpadding=4 cellspacing=0>
                <tr class=\'' . _CAL_CSS_HIL_ . '\'>
                  <td class=\'' . _CAL_CSS_HIL_ . '\'>
		     <img src=\'' . $_cal_html->get_img_url ('images/error.gif') . '\' alt=\'warning\' align=\'center\'> 
                   </td>
                  <td class=\'' . _CAL_CSS_HIL_ . '\'>
                      <font class=\'' . _CAL_CSS_HIL_ . '\'><b>' . _DELETE_REPEATING_WARNING_ . '</b></font>
                  </td>
                 </tr>
                 </table>
             </td></tr>
';
      }

      echo '
</table>
';
      echo '</td>
</tr>
';
      echo '<tr><th colspan=2>';
      echo '<table class=\'' . _CAL_CSS_TOOLBAR_ . '\' border=0 width=\'100%\'><tr>
        <td class=\'' . _CAL_CSS_TOOLBAR_ . '\'
        align=left>';
      echo $_cal_form->submit ('event_action', _DELETE_CHECKED_);
      echo '</td>';
      $_cal_form->print_footer ();
      $_cal_form->print_header ();
      echo '<td class=\'' . _CAL_CSS_TOOLBAR_ . '\' width=\'100%\' align=left> ';
      echo $_cal_form->submit ('', _CANCEL_);
      echo '</td></tr></table>
';
      $_cal_form->print_footer ();
      echo '</th></tr>
';
      echo '</table>
';
      echo '
</div>
';
    }

    function display_delete_event ($eid)
    {
      global $_cal_html;
      global $_cal_form;
      require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.form.php';
      $_cal_form = new _cal_form ();
      $event = new _cal_event ($eid);
      $event->set_localtime ();
      if (0 < $event->freq)
      {
        switch ($_REQUEST['apply_to1'])
        {
          case 'future':
          {
            $seldates = _FUTURE_DATES_;
            break;
          }

          case 'this':
          {
            $seldates = _THIS_DATE_;
            break;
          }

          default:
          {
            $seldates = _ALL_DATES_;
          }
        }

        $seldates = ' (' . $seldates . ') ';
      }

      $_cal_html->print_heading (_DELETE_ . ' ' . $event->type_name . $seldates);
      require_once @constant ('_CAL_BASE_PATH_') . 'include/templates/event_view_tpl.php';
      $_cal_form->print_header ();
      echo $_cal_form->fromRequest (array ('apply_to1' => 1, 'instance' => 1, 'eid' => 1));
      $_cal_form->print_hidden ('really_delete', '1');
      echo '<table width=\'100%\'>
';
      echo '<tr><th colspan=2>';
      echo '<table class=\'' . _CAL_CSS_TOOLBAR_ . '\' border=0 width=\'100%\'><tr>
        <td class=\'' . _CAL_CSS_TOOLBAR_ . '\'
        align=left>';
      echo $_cal_form->submit ('event_action', _DELETE_) . '</td>';
      echo '<td class=\'' . _CAL_CSS_TOOLBAR_ . '\' width=\'100%\' align=left>';
      echo $_cal_form->submit ('', _CANCEL_);
      echo '</td></tr></table>
';
      echo '</th></tr>
';
      echo '</table>
';
      $_cal_form->print_footer ();
    }

    function display_events ($page = 0)
    {
      global $_cal_sql;
      global $_cal_html;
      global $_cal_user;
      global $_cal_form;
      global $_cal_dbpref;
      global $_cur_cal;
      require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.form.php';
      $_cal_form = new _cal_form ('event_form');
      require_once @constant ('_CAL_BASE_PATH_') . 'include/js/event_list.js';
      $page = max (1, $page);
      $this->page = $page;
      (strlen ($this->sort_opts[$_SESSION['evnt_order_by']]) OR $_SESSION['evnt_order_by'] = _DATE_);
      if (NULL == $_SESSION['evnt_view'])
      {
        $_SESSION['evnt_view'] = 1;
      }

      ($_cal_sql OR $_cal_sql = new _cal_sql ());
      $query = 'select id, ' . $_cal_sql->sql_alias ('starttime', 'start') . ', ' . $_cal_sql->sql_alias ('endtime', 'end') . ('' . ', duration, allday, next,
         freq, finterval, byday, bymonthday, bymonth , override_date, title
         from ' . $_cal_dbpref . 'Events
         where calendar ') . $_cur_cal->get_constraint () . ' and 
         starttime is not null
         and freq > 0
         and (next < ' . time () . ' and next is not null)';
      $events = $_cal_sql->query ($query);
      require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.repeater.php';
      foreach ($events as $event)
      {
        $st = $event['start'];
        $event['starttime'] = $event['start_timestamp'] = $event['start'];
        $r = new _cal_repeater ($event);
        if ($event['allday'])
        {
          $now = _ex_date ('Y-n-j 0:0:0');
        }
        else
        {
          $now = _ex_date ('Y-n-j H:i:0');
        }

        $next = $r->get_next_time ($now);
        if ($next !== null)
        {
          $next = _ex_strtotime ($next . _ex_date (' H:i', $st) . ':0', true);
          $_cal_sql->query ('' . 'update ' . $_cal_dbpref . 'Events set next = \'' . $next . '\' where id = ' . $event['id']);
          continue;
        }
        else
        {
          $_cal_sql->query ('' . 'update ' . $_cal_dbpref . 'Events set next = null where id = ' . $event['id']);
          continue;
        }
      }

      if (0 < strlen ($this->searchstr))
      {
        $_SESSION['evnt_view'] = 0;
        $_SESSION['evnt_type'] = 0;
      }

      if ((!_ex_valid_license_key () AND _CAL_EXPIRATION_ < time ()))
      {
        $events = array ();
      }
      else
      {
        $events = $_cal_sql->query ($this->get_query ());
      }

      list ($count) = $_cal_sql->query ($this->get_query (1));
      $this->count = $count['count'];
      echo '<div class=\'' . _CAL_CSS_EVENTLIST_ . '\'>
';
      $_cal_form->print_header ();
      if (0 < $_SESSION['evnt_type'])
      {
        $type_str = '<font size=-1>(' . _SHOW_TYPE_ . ': <font class=\'' . _CAL_CSS_HIL_ . '\'>' . $_cur_cal->get_category_name ($_SESSION['evnt_type']) . '</font>)</font>';
      }

      if (0 < strlen ($this->searchstr))
      {
        $_cal_html->print_heading (_SEARCH_EVENTS_, ' &nbsp; ', '<font size=-1><b>' . _SEARCH_ . ':</b></font> ' . $_cal_form->textbox ('searchfor', 15));
      }
      else
      {
        $evnt_str = $this->evnt_views[$_SESSION['evnt_view']];
        if (_LANG_ORDER_ == 0)
        {
          $_cal_html->print_heading ($evnt_str . ' ' . _EVENTS_ . ' ' . $type_str, ' &nbsp; ', '<font size=-1><b>' . _SEARCH_ . ':</b></font> ' . $_cal_form->textbox ('searchfor', 15));
        }
        else
        {
          $_cal_html->print_heading (_EVENTS_ . ' ' . $evnt_str . ' ' . $type_str, ' &nbsp; ', '<font size=-1><b>' . _SEARCH_ . ':</b></font> ' . $_cal_form->textbox ('searchfor', 15));
        }
      }

      echo '<table width=\'100%\' border=0>';
      echo '<tr><td colspan=2 class="' . _CAL_CSS_SPACER_TINY_ . '"> </td></tr>
';
      echo '<tr><td colspan=2>
';
      $this->viewbar ();
      echo '</td>
</tr>
';
      echo '<tr><th colspan=2>';
      $this->toolbar ('1');
      echo '</th>
</tr>
';
      echo '<tr>
<td colspan=2>
';
      if (0 < $this->count)
      {
        $url = new _cal_url ();
        echo '<table width=\'100%\' style=\'border-collapse: collapse\' ' . ($this->editable ? '' : ' cellpadding=3') . '>
';
        echo '<tr class=\'' . _CAL_CSS_LIST_HEADER_ . '\' valign=\'middle\'>
         <td width=\'105\' ';
        echo ($_SESSION['evnt_order_by'] == _DATE_ ? 'class=\'' . _CAL_CSS_LIST_HEADER_HIL_ . '\'' : 'class=\'' . _CAL_CSS_LIST_HEADER_ . '\'');
        if ($this->editable)
        {
          echo ' align=\'left\'>';
          echo $_cal_form->checkbox ('deletecheckall', 'onClick=\'javascript:updateDelete()\'');
        }
        else
        {
          echo ' align=\'left\'> &nbsp; ';
        }

        if ($_SESSION['evnt_order_desc'] == 1)
        {
          $url->addArg ('evnt_order_desc', '0');
          $order_link = '<a href=\'' . $url->toString () . '\'><img
         src=\'' . $_cal_html->get_img_url ('images/up.gif') . '\'
         border=0 alt=\'up\'></a>';
        }
        else
        {
          $url->addArg ('evnt_order_desc', '1');
          $order_link = '<a href=\'' . $url->toString () . '\'><img
         src=\'' . $_cal_html->get_img_url ('images/down.gif') . '\'
         border=0 alt=\'down\'></a>';
        }

        $url->addArg ('evnt_order_desc', '0');
        $url->addArg ('evnt_order_by', _DATE_);
        if ($_SESSION['evnt_order_by'] == _DATE_)
        {
          echo ' <b>' . _DATE_ . '</b> ';
          echo $order_link;
          echo '</td>';
        }
        else
        {
          echo ' <a class=\'' . _CAL_CSS_ULINE_ . '\'
          href="' . $url->toString () . '"><b>' . _DATE_ . '</b></a></td>';
        }

        echo '<td align=center width=\'' . (@constant ('_CAL_EVENTS_SHOW_END_TIME_') ? '140' : '80') . '\' class=\'' . _CAL_CSS_LIST_HEADER_ . '\'><b>' . _TIME_ . '</b></td>';
        $url->addArg ('evnt_order_by', _EVENT_);
        echo '<td width=\'50%\' colspan=2';
        if ($_SESSION['evnt_order_by'] == _EVENT_)
        {
          echo ' class=\'' . _CAL_CSS_LIST_HEADER_HIL_ . '\'>';
          echo '&nbsp;<b>' . _EVENT_ . '</b> ';
          echo $order_link;
          echo '</td>
';
        }
        else
        {
          echo ' class=\'' . _CAL_CSS_LIST_HEADER_ . '\'>';
          echo '&nbsp;<a class=\'' . _CAL_CSS_ULINE_ . '\'
            href="' . $url->toString () . '"><b>' . _EVENT_ . '</b></a></td>';
        }

        if ($_cur_cal->type == 3)
        {
          echo '<td width=\'120\' class=\'' . _CAL_CSS_LIST_HEADER_ . '\'>';
          echo ' &nbsp<b>' . _CALENDAR_ . '</b> </td>
';
        }

        $url->addArg ('evnt_order_by', _EVENT_TYPE_);
        echo '<td width=\'120\' colspan=2';
        if ((!$_cur_cal->has_subcals OR $_cur_cal->type == 3))
        {
          if ($_SESSION['evnt_order_by'] == _EVENT_TYPE_)
          {
            echo ' class=\'' . _CAL_CSS_LIST_HEADER_HIL_ . '\'>';
            echo '&nbsp;<b>' . _EVENT_TYPE_ . '</b> ';
            echo $order_link;
            echo '</td>
';
          }
          else
          {
            echo ' class=\'' . _CAL_CSS_LIST_HEADER_ . '\'>';
            echo '&nbsp;<a class=\'' . _CAL_CSS_ULINE_ . '\'
               href="' . $url->toString () . '"><b>' . _EVENT_TYPE_ . '</b></a></td>';
          }
        }
        else
        {
          echo ' class=\'' . _CAL_CSS_LIST_HEADER_ . '\'>';
          echo ' &nbsp<b>' . _CALENDAR_ . '</b> </td>
';
        }

        echo '</tr>
';
        $url = new _cal_url ();
        $url->addArg ('v', 'd');
        $eurl = new _cal_url ();
        $i = 1;
      }

      if (@constant ('_CAL_ENABLE_TZ_'))
      {
        $this->set_localtime ($events);
      }

      usort ($events, array ('_cal_event_list', $this->usort_functions[$_SESSION['evnt_order_by']]));
      if ($_SESSION['evnt_order_desc'])
      {
        $events = array_reverse ($events);
      }

      $_cal_url = new _cal_url ();
      $i = 0;
      foreach ($events as $event)
      {
        list ($date, $time) = explode (' ', _ex_date ('Y-n-j H:i', $event['start']));
        list ($yr, $mo, $da) = explode ('-', $date);
        list ($hr, $min) = explode (':', $time);
        $da = intval ($da);
        $mo = intval ($mo);
        $datedisp = _ex_date (_DATE_INT_FULL_, $event['start']);
        $timedisp = _ex_display_time_long (_ex_mktime ($hr, $min, 0, 1, 1, 1));
        if (@constant ('_CAL_EVENTS_SHOW_END_TIME_'))
        {
          list ($dhr, $dmin, $sec) = explode (':', $event['duration']);
          $timedisp .= ' - ' . _ex_display_time_long ($event['start'] + $dhr * 3600 + $dmin * 60);
        }

        $cats = array ();
        if (((!$_cur_cal->has_subcals OR $_cur_cal->type == 3) AND $event['etype']))
        {
          if ($this->categories[$event['etype']])
          {
            $_cal_url->addArg ('evnt_type', $event['etype']);
            $cats[] = '<a href=\'' . $_cal_url->toString () . '\'>' . $this->categories[$event['etype']] . '</a>';
          }
          else
          {
            $cats = array ();
            foreach (array_keys ($this->categories) as $_c_id)
            {
              $_c_id = intval ($_c_id);
              if (($_c_id & $event['etype']) != 0)
              {
                $_cal_url->addArg ('evnt_type', $_c_id);
                $cats[] = '<a href=\'' . $_cal_url->toString () . '\'>' . $this->categories[$_c_id] . '</a>';
                continue;
              }
            }
          }

          $event['type'] = join (_LIST_SEP_, $cats);
        }
        else
        {
          if ($_cur_cal->has_subcals)
          {
            $event['type'] = $_cur_cal->get_calendar_name ($event['calendar']);
            if ($this->viewable_calendars[$event['calendar']])
            {
              $_cal_url->addArg ('calendar', $event['calendar']);
              $event['type'] = '<a href=\'' . $_cal_url->toString () . ('' . '\'>' . $event['type'] . '</a>');
            }
          }
        }

        if ($_cur_cal->type == 3)
        {
          $event['cal'] = $_cur_cal->get_calendar_name ($event['calendar']);
          if ($this->viewable_calendars[$event['calendar']])
          {
            $_cal_url->addArg ('calendar', $event['calendar']);
            $event['cal'] = '<a href=\'' . $_cal_url->toString () . ('' . '\'>' . $event['cal'] . '</a>');
          }

          $_cal_url->addArg ('calendar', '');
        }

        $url->addArg ('d', $da);
        $url->addArg ('m', $mo);
        $url->addArg ('y', $yr);
        echo '<tr>
';
        $class = ($i % 2 ? 'class=\'' . _CAL_CSS_HIL_ . '\'' : 'class=\'' . _CAL_CSS_ROW_HEADER_ . '\'');
        echo '	<td ' . $class;
        if ($this->editable)
        {
          echo ' align=\'left\'>';
          echo $_cal_form->checkbox ('delete_' . $event[id]);
        }
        else
        {
          echo ' align=\'left\'> &nbsp; ';
        }

        echo ' <a ' . $class . ' href="' . $url->toString () . '">' . $datedisp . '</a></td>
';
        echo '	<td align=\'center\' ' . $class . '>' . ($event['allday'] == 1 ? _ALLDAY_ : ($event['allday'] == 2 ? _CAL_CALL_FOR_TIMES_MIN_ : $timedisp)) . '</td>
';
        $eurl->addArg ('eid', $event['id']);
        $eurl->addArg ('instance', $date);
        $eurl->addArg ('doall', '1');
        $eurl->addArg ('event_action', _VIEW_);
        echo '	<td ' . $class . '> &nbsp;';
        $vurl = $this->event_view_url;
        $vurl = str_replace (array ('%eid', '%inst'), array ($event['id'], $date), $vurl);
        echo '<a ' . $class . ' href=\'' . $vurl . '\'>' . $event['title'] . '</a>';
        echo '</td>
';
        echo '	<td ' . $class . ' align=right>' . $this->get_icons ($event) . ' </td>
';
        $eurl->addArg ('event_action', _DELETE_);
        if ($_cur_cal->type == 3)
        {
          echo '	<td ' . $class . '> &nbsp;' . $event['cal'] . '</td>
';
        }

        echo '	<td ' . $class . '> &nbsp;' . $event['type'] . '</td>
';
        echo '	<td align=right ' . $class . '>';
        if ($this->editable)
        {
          echo '<a ' . $class . ' href="' . $eurl->toString () . '">' . _DELETE_ . '</a>';
        }

        echo '</td>
';
        echo '</tr>
';
        ++$i;
      }

      if (0 < $this->count)
      {
        if ($_cur_cal->type == 3)
        {
          $colspan = 7;
        }
        else
        {
          $colspan = 6;
        }

        echo '<tr>
            <td class=\'' . _CAL_CSS_TOOLBAR_ . ('' . '\' colspan=\'' . $colspan . '\'>');
        if ($this->editable)
        {
          echo ' [
         <a class=\'' . _CAL_CSS_ULINE_ . '\' href=\'javascript:check_all(true)\'>' . _CHECK_ALL_ . '</a> |
         <a class=\'' . _CAL_CSS_ULINE_ . '\' href=\'javascript:check_all(false)\'>' . _CLEAR_ALL_ . '</a>
         ] ';
        }

        echo '</td>
</tr>
';
        echo '</table>
';
      }
      else
      {
        echo '<table border=1 align=center width=\'75%\'
         style=\'border-collapse: collapse\'>
         <tr valign=middle class=\'' . _CAL_CSS_ROW_HEADER_ . '\'>
            <td align=center><h3 class=\'' . _CAL_CSS_HIL_ . '\'><i>' . _ARE_NO_EVENTS_;
        echo '</i></h3></td>
         </tr>
         </table>
       ';
      }

      echo '<tr><th colspan=2>';
      $this->toolbar ('2');
      echo '</th>
</tr>
';
      echo '<tr><td class="' . _CAL_CSS_NAV_ . '">
';
      $this->viewbar ();
      echo '
</td>
</tr>
</table>
';
      $_cal_form->print_footer ();
      echo '</div>
';
    }

    function viewbar ()
    {
      $url = new _cal_url ();
      echo '<table class=\'' . _CAL_CSS_VIEWBAR_ . '\' width=\'100%\'>
';
      echo '<tr><td align=left class=\'' . _CAL_CSS_VIEWBAR_ . '\'>' . _VIEW_ . ': [ ';
      if (0 < strlen ($this->searchstr))
      {
        echo ' ' . _EVENTS_CONTAINING_ . ': <font class=\'' . _CAL_CSS_HIL_ . '\'>"' . htmlentities ($this->searchstr) . '"</font> ';
      }
      else
      {
        $i = 0;
        while ($i < count ($this->evnt_views))
        {
          $url->addArg ('evnt_view', $i);
          if ($_SESSION['evnt_view'] == $i)
          {
            echo '<b>' . $this->evnt_views[$i] . '</b>';
          }
          else
          {
            echo '<a class=\'' . _CAL_CSS_VIEWBAR_ . '\' href="' . $url->toString () . '"><font size=-1>' . $this->evnt_views[$i] . '</font></a>';
          }

          echo ($this->evnt_views[$i + 1] ? ' | ' : '');
          ++$i;
        }
      }

      echo ' ]</td>';
      echo '<td align=right class=\'' . _CAL_CSS_VIEWBAR_ . '\'> ' . _SHOWING_ . ' ';
      echo $this->per_page * $this->page - $this->per_page + ($this->count == 0 ? 0 : 1) . ' - ';
      echo ($this->count < $this->page * $this->per_page ? $this->count : $this->page * $this->per_page);
      echo ' ' . _OF_ . ' ' . $this->count;
      $url = new _cal_url ();
      if (1 < $this->page)
      {
        $url->addArg ('page', '1');
        $first = '<a class=\'' . _CAL_CSS_VIEWBAR_ . '\' href="' . $url->toString () . '">' . _FIRST_ . '</a>';
        $url->addArg ('page', $this->page - 1);
        $prev = '<a class=\'' . _CAL_CSS_VIEWBAR_ . '\' href="' . $url->toString () . '">' . _PREV_ . '</a>';
      }
      else
      {
        $first = _FIRST_;
        $prev = _PREV_;
      }

      if ($this->page * $this->per_page < $this->count)
      {
        $url->addArg ('page', $this->page + 1);
        $next = '<a class=\'' . _CAL_CSS_VIEWBAR_ . '\' href="' . $url->toString () . '">' . _NEXT_ . '</a>';
        $url->addArg ('page', ($this->count % $this->per_page == 0 ? $this->count / $this->per_page : intval ($this->count / $this->per_page) + 1));
        $last = '<a clas=\'viewbar\' href="' . $url->toString () . '">' . _LAST_ . '</a>';
      }
      else
      {
        $next = _NEXT_;
        $last = _LAST_;
      }

      echo ' | ' . $first;
      echo ' | ' . $prev;
      echo ' | ' . $next;
      echo ' | ' . $last;
      echo '</tr>
';
      echo '</table>
';
    }

    function toolbar ($which)
    {
      global $_cal_form;
      global $_cal_user;
      global $_cur_cal;
      global $_cal_sql;
      global $_cal_dbpref;
      echo '<table class=\'' . _CAL_CSS_TOOLBAR_ . '\' border=0 width=\'100%\'>
        <tr><td class=\'' . _CAL_CSS_TOOLBAR_ . '\'
        align=left>';
      if ($this->editable)
      {
        $_cal_form->print_hidden ('event_action', 'delete_multi');
        echo $_cal_form->submit ('', _DELETE_);
      }

      echo '</td><td class=\'' . _CAL_CSS_TOOLBAR_ . '\' align=right>';
      if (strlen ($this->searchstr) == 0)
      {
        if (!@constant ('_CAL_HIDE_CAL_PICKER_'))
        {
          $cals = $_cal_user->access->get_cals_sel ();
          if (count ($cals))
          {
            echo '<b>' . _CALENDAR_ . ': </b>';
            if ((!$_SESSION['calendar'] OR ($_SESSION['calendar'] AND !$cals[$_SESSION['calendar']])))
            {
              if (!$cals[0])
              {
                $cals[0] = '  ';
              }

              $_cal_form->defaults['calendar_' . $which] = '0';
            }
            else
            {
              if ($cals[0])
              {
                unset ($cals[0]);
              }

              $_cal_form->defaults['calendar_' . $which] = $_SESSION['calendar'];
            }

            $_cal_form->print_select ('calendar_' . $which, $cals, 'onChange=\'javascript:viewcal(' . $which . ')\'');
          }
        }

        if (count ($_cur_cal->get_categories ()))
        {
          echo ' <b>' . _SHOW_TYPE_ . ': </b>';
          $_cal_form->defaults['event_type' . $which] = $_SESSION['evnt_type'];
          $_cal_form->print_select ('event_type' . $which, array (0 => _ALL_) + $_cur_cal->get_categories (), 'onChange=\'javascript:viewtype("event_type' . $which . '")\'');
        }
        else
        {
          if ($_cur_cal->has_subcals)
          {
            $vcats = $_cal_sql->query ('' . 'select distinct name, name
            from ' . $_cal_dbpref . 'EventTypes where calendar
            ' . $_cur_cal->get_constraint (), true);
            uasort ($vcats, 'strnatcasecmp');
            echo ' <b>' . _SHOW_TYPE_ . ': </b>';
            $_cal_form->defaults['vcat' . $which] = $_SESSION['vcat'];
            $_cal_form->print_select ('vcat' . $which, array (0 => _ALL_) + $vcats, 'onChange=\'javascript:viewvcat("vcat' . $which . '")\'');
          }
        }
      }

      $ar_step = array (10, 20, 30, 40, 50);
      if (@constant ('_CAL_ELIST_MAX_'))
      {
        $i = 50;
        while ($i <= @constant ('_CAL_ELIST_MAX_'))
        {
          $ar_step[] = $i;
          $i += 50;
        }
      }

      $_cal_form->defaults['evnt_count_' . $which] = $this->per_page;
      echo ' <b>' . _LIST_SIZE_ . ':</b> ' . $_cal_form->select ('evnt_count_' . $which, array_combine ($ar_step, $ar_step), 'onChange=\'view_count(this.value)\'');
      echo '</td></tr>
</table>
';
    }

    function get_query ($count = 0)
    {
      global $_cal_sql;
      global $_cal_dbpref;
      global $_cur_cal;
      if (($_SESSION['evnt_view'] == 1 OR strlen ($this->searchstr)))
      {
        $query_cols .= ' ' . $_cal_sql->sql_alias ('next', 'start') . ', ';
      }
      else
      {
        $query_cols .= ' ' . $_cal_sql->sql_alias ('starttime', 'start') . ', ';
      }

      $query_cols .= $_cal_sql->sql_alias ('' . $_cal_dbpref . 'Events.id', 'id') . ('' . ', title, allday,
        ' . $_cal_dbpref . 'Events.calendar, duration, etype') . ', freq, finterval, byday, bymonthday, bymonth, timezone, dst, use_tz,
' . $_cal_sql->sql_alias ('' . $_cal_dbpref . 'Events.icon', 'icon') . ' ';
      $query_tables = '' . ' ' . $_cal_dbpref . 'Events ';
      if ($_SESSION['evnt_order_by'] == _EVENT_TYPE_)
      {
        $query_cols .= ', ' . $_cal_sql->sql_alias ('' . $_cal_dbpref . 'EventTypes.name', 'type_name');
        $query_tables .= '' . '
left join ' . $_cal_dbpref . 'EventTypes on
    ' . $_cal_dbpref . 'EventTypes.calendar = ' . $_cur_cal->etypes_cal . '
        and ' . $_cal_dbpref . 'EventTypes.id = etype
';
      }

      $query_where = '' . ' ' . $_cal_dbpref . 'Events.calendar ' . $_cur_cal->get_constraint ();
      if ($_cur_cal->view_filter)
      {
        $query_where .= ' and (' . $_cur_cal->view_filter . ')';
      }

      if (0 < strlen ($this->searchstr))
      {
        $str = strtolower ($_cal_sql->escape_string ($this->searchstr));
        $query_where .= ' and (lower(notes) like \'%' . $str . '%\'
         or lower(title) like \'%' . $str . '%\'
         or lower(location) like \'%' . $str . '%\'
         or lower(addr_st) like \'%' . $str . '%\'
         or lower(addr_ci) like \'%' . $str . '%\'
         or lower(phone) like \'%' . $str . '%\' ';
        if (!@constant ('_CAL_SEARCH_OLD_EVENTS_'))
        {
          $_SESSION['evnt_view'] = 1;
        }

        if (@constant ('_CAL_LOCATIONS_MOD_'))
        {
          $lmatch = $_cal_sql->query ('' . 'select id, name from ' . $_cal_dbpref . 'Locations where
           lower(name) like \'%' . $str . '%\' or lower(addr_st) like \'%' . $str . '%\' or
           lower(addr_st2) like \'%' . $str . '%\' or lower(addr_ci) like \'%' . $str . '%\'
          or lower(state) like \'%' . $str . '%\' or zip like \'%' . $str . '%\'', true);
          if (count ($lmatch))
          {
            $query_where .= ' or location_id in (' . join (',', array_keys ($lmatch)) . ')';
          }
        }

        $query_where .= ')';
      }
      else
      {
        if ((($_cur_cal->type != 1 AND $_cur_cal->type != 2) AND 0 < $_SESSION['evnt_type']))
        {
          $query_where .= ' and (' . $_cal_sql->sql_binary_and ('' . $_cal_dbpref . 'Events.etype', $_SESSION['evnt_type']) . ' > 0) ';
        }
      }

      if ($_SESSION['evnt_view'] == 1)
      {
        $query_where .= ' and ';
        $query_where .= '((
                        (
                          freq > 0
                        )
                        and
                        (
                           next > ' . (time () - 13 * 3600) . '
                           or
                           endtime is NULL
                        )
                      )';
        $query_where .= ' or ';
        $query_where .= '(
                        (
                           freq = 0
                        )
                        and
                        (
                           (
                              allday = 0
                              and
                              starttime > ' . (time () - 13 * 3600) . '
                           )
                           or
                           (
                              allday > 0
                              and
                              (starttime + 86400) > ' . (time () - 13 * 3600) . '
                           )
                        )
                      ))';
      }
      else
      {
        if ($_SESSION['evnt_view'] == 2)
        {
          $query_where .= ' and (';
          $query_where .= '(
                        (
                           freq > 0
                        )
                        and
                        ( 
                           next > endtime
                           or
                           endtime < ' . (time () + 13 * 3600) . '
                           or next is null
                        )
                        and
                        endtime is not NULL
                      )';
          $query_where .= ' or ';
          $query_where .= '(
                        (
                           freq = 0
                        )
                        and
                        (
                           (
                              starttime < ' . (time () - 13 * 3600) . '
                              and
                              allday = 0
                           )
                           or
                           (
                              allday > 0
                              and
                              (starttime + 86400) < ' . (time () - 13 * 3600) . '
                           )
                        )
                      )';
          $query_where .= ')';
        }
      }

      $query_where = (1 < strlen ($query_where) ? ' where ' . $query_where : '');
      if ($count == 1)
      {
        return 'select COUNT(*) as count from ' . $query_tables . $query_where;
      }

      $query_order = ' ' . $this->sort_opts[$_SESSION['evnt_order_by']] . ' ';
      $query_order .= ($_SESSION['evnt_order_desc'] == 1 ? ' desc ' : '');
      $select = 'select ' . $query_cols . ' from ' . $query_tables . ' ' . $query_where . ' order by ' . $query_order;
      $sql = $_cal_sql->sql_limit ($select, $this->per_page, $this->per_page * ($this->page - 1));
      return $sql;
    }

    function set_localtime (&$events)
    {
      if (!@constant ('_CAL_ENABLE_TZ_'))
      {
        return null;
      }

      $e = new _cal_event ();
      $i = 0;
      while ($i < count ($events))
      {
        if ($events[$i]['allday'])
        {
          continue;
        }

        $e->start = $events[$i]['start'];
        $e->timezone = $events[$i]['timezone'];
        $e->dst = $events[$i]['dst'];
        $e->use_tz = $events[$i]['use_tz'];
        $e->allday = $events[$i]['allday'];
        $e->dst_obj = new _cal_dst ($events[$i]['dst']);
        $e->set_localtime ();
        $events[$i]['start'] = $e->start;
        ++$i;
      }

    }

    function get_icons (&$event)
    {
      global $_cal_user;
      global $_cal_html;
      global $_cal_sql;
      global $_cal_dbpref;
      $icons_str;
      if (is_array ($event))
      {
        $repeats = 0 < $event['freq'];
        $type = $event['etype'];
        if ($event['icon'])
        {
          $icons_str = _ex_img_str (_CAL_BASE_URL_ . $event['icon'], 'icon', 16, 16);
        }

        list ($attch) = $_cal_sql->query ('select ' . $_cal_sql->sql_alias ('MIN(id)', 'attch') . ('' . ' from ' . $_cal_dbpref . 'Attachments
            where eid = ' . $event['id']));
        $attachments = 1 <= $attch['attch'];
      }
      else
      {
        if (is_object ($event))
        {
          $repeats = 0 < $event->freq;
          $type = $event->type_name;
          if ($event->icon)
          {
            $icons_str = _ex_img_str (_CAL_BASE_URL_ . $event->icon, 'icon', 16, 16);
          }

          $attachments = count ($event->attachments);
        }
      }

      $cat_icons = array ();
      $type = intval ($type);
      foreach (array_keys ($this->categories) as $cid)
      {
        if ((1 <= ($cid & $type) AND $this->cat_icons[$cid]))
        {
          $cat_icons[] = _ex_img_str (_CAL_BASE_URL_ . $this->cat_icons[$cid], 'icon', 16, 16);
          continue;
        }
      }

      $icons_str .= join (' ', $cat_icons);
      if (0 < $attachments)
      {
        $icons_str .= ' <img src=\'' . $_cal_html->get_img_url ('images/attachment.gif') . '\' alt=\'attachment\'> ';
      }

      if (0 < $repeats)
      {
        $icons_str .= ' <img src=\'' . $_cal_html->get_img_url ('images/repeat.gif') . '\' alt=\'repeating icon\'> ';
      }

      return $icons_str . ' &nbsp; ';
    }

    function sort_starttime ($a, $b)
    {
      if ($a['start'] == $b['start'])
      {
        return null;
      }

      return ($b['start'] < $a['start'] ? 1 : 0 - 1);
    }

    function sort_title ($a, $b)
    {
      return strcasecmp ($a['title'], $b['title']);
    }

    function sort_category ($a, $b)
    {
      return strcasecmp ($a['type_name'], $b['type_name']);
    }
  }

  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.form.php';
  require_once _CAL_BASE_PATH_ . 'include/images.php';
?>