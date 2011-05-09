<?php



  class _cal_sql
  {
    var $_connected = false;
    var $quiet = false;
    var $die_on_error = false;
    var $functions = array ('substr' => 'substring');
    var $auto_inc = true;
    var $subselects = false;
    var $qs = 0;
    function _cal_sql ($user = null, $pass = null, $db = null, $host = null, $port = null)
    {
      if ((!isset ($this->_connected) OR $this->_connected == FALSE))
      {
        $this->_connect ($user, $pass, $db, $host, $port);
      }

    }

    function query ($strQuery, $numbered = 0)
    {
      ++$this->qs;
      $strQuery = trim ($strQuery);
      if (strncasecmp ($strQuery, 'select ', 7) != 0)
      {
        ob_start ();
        if (!$result = mssql_query ($strQuery, $this->dbHandle))
        {
          $err_msg = ob_get_contents ();
          ob_end_clean ();
          $this->error_out ('' . 'query() ' . $result, $err_msg . ' ' . mssql_get_last_message (), '<pre>' . $strQuery . '</pre>
');
          return null;
        }

        ob_end_clean ();
        if (strncasecmp ($strQuery, 'insert ', 7) === 0)
        {
          list ($res) = $this->query ('SELECT SCOPE_IDENTITY() as lastid');
          if ((is_array ($res) AND $res['lastid']))
          {
            return $res['lastid'];
          }

          return true;
        }

        return $result;
      }

      $return_arr = array ();
      ob_start ();
      if (!$result = mssql_query ($strQuery, $this->dbHandle))
      {
        $err_msg = ob_get_contents ();
        ob_end_clean ();
        $this->error_out ('query()', $err_msg, '<pre>' . $strQuery . '</pre>
');
        return $return_arr;
      }

      ob_end_clean ();
      if ($numbered)
      {
        while ($tmparr = mssql_fetch_row ($result))
        {
          $return_arr[$tmparr[0]] = rtrim ($tmparr[1]);
        }
      }
      else
      {
        while ($tmparr = mssql_fetch_assoc ($result))
        {
          $return_arr[] = array_map ('rtrim', $tmparr);
        }
      }

      mssql_free_result ($result);
      return $return_arr;
    }

    function getfields ($table)
    {
      $fields = array ();
      $result = mssql_query ('' . 'SELECT c.name FROM syscolumns c, systypes t, sysobjects o WHERE o.name = \'' . $table . '\' AND o.id = c.id AND c.xtype = t.xtype', $this->dbHandle);
      if (!$result)
      {
        $this->error_out ('getFields()', mssql_get_last_message ());
        return $fields;
      }

      while ($row = mssql_fetch_row ($result))
      {
        array_push ($fields, $row[0]);
      }

      mssql_free_result ($result);
      return $fields;
    }

    function _connect ($user, $pass, $db, $host, $port)
    {
      if (!(((($user OR $pass) OR $db) OR $host) OR $port))
      {
        $user = @constant ('_CAL_DBUSER_');
        $pass = @constant ('_CAL_DBPASS_');
        $db = @constant ('_CAL_DBNAME_');
        $host = @constant ('_CAL_DBHOST_');
        $port = @constant ('_CAL_DBPORT_');
      }

      if (strlen ($port))
      {
        $host .= ':' . $port;
      }

      if (@constant ('_CAL_PERSISTENT_SQL_CONN_'))
      {
        $this->dbHandle = mssql_pconnect ($host, $user, $pass);
      }
      else
      {
        $this->dbHandle = mssql_connect ($host, $user, $pass);
      }

      if (!$this->dbHandle)
      {
        $this->error_out ('_connect()', mssql_get_last_message ());
        return null;
      }

      if ((strlen ($db) AND !mssql_select_db ($db)))
      {
        $this->error_out ('mssql_select_db()', mssql_get_last_message (), '<pre>' . $strQuery . '</pre>
');
        return null;
      }

      $this->_connected = true;
    }

    function sql_alias ($col, $as)
    {
      return $col . ' as \'' . $as . '\' ';
    }

    function sql_binary_and ($v1, $v2)
    {
      return ' ' . $v1 . ' & ' . $v2 . ' ';
    }

    function sql_limit ($select, $limit, $offset)
    {
      if ($offset == 0)
      {
        return preg_replace ('/select /i', '' . 'select top ' . $limit . ' ', $select);
      }

      preg_match ('' . '/order by\\s+(.*)$/i', $select, $matches);
      $orderby = preg_replace ('/\\s+/', ' ', $matches[1]);
      list ($col, $ord) = explode (' ', $orderby);
      if (!$ord)
      {
        $ord = 'asc';
      }

      $inner_ord = ($ord == 'asc' ? 'desc' : 'asc');
      $select = preg_replace ('/select /i', 'select top ' . ($limit + $offset), $select);
      $select = '' . 'select top ' . $limit . ' * from (' . $select . ') as t1 order by ' . $col . ' ' . $inner_ord;
      return '' . 'select * from (' . $select . ') as t2 order by ' . $col . ' ' . $ord;
    }

    function escape_string ($str)
    {
      return str_replace ('\'', '\'\'', $str);
    }

    function next_sequence ()
    {
      return 'auto';
    }

    function insert ($tbl, $flds)
    {
      $this->query ('' . 'insert into ' . $GLOBALS['_cal_dbpref'] . $tbl . ' ("' . join ('","', array_keys ($flds)) . '")
        values (' . join (',', $flds) . ')');
    }

    function update ($tbl, $flds, $cnd = '')
    {
      $query = '' . 'update ' . $GLOBALS['_cal_dbpref'] . $tbl . ' set ';
      $upd = array ();
      while (list ($k, $v) = each ($flds))
      {
        $upd[] = ('' . '"') . $k . '" = ' . $v . ' ';
      }

      $query .= join (',', $upd);
      $upd = array ();
      if ((is_array ($cnd) AND count ($cnd)))
      {
        while (list ($k, $v) = each ($cnd))
        {
          $upd[] = ('' . '"') . $k . '" = ' . $v;
        }

        $query .= ' where ' . join (' and ', $upd);
      }

      $this->query ($query);
    }

    function error_out ($func, $msg, $xtra = '')
    {
      if (!$this->quiet)
      {
        echo '<BR>' . _ERROR_ . ': class.mssql.php :: ' . $func . ' :: ' . $msg . '<br>';
        echo $xtra;
      }

      if ($this->die_on_error)
      {
        exit ();
      }

    }
  }

?>