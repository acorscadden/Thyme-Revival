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


  class _cal_sql_based
  {
    var $key = null;
    var $keyval = null;
    var $table = null;
    var $fields = null;
    var $joins = array ();
    var $translations = array ();
    var $excludes = array ();
    function _cal_sql_based ($table, $key = null, $keyval = null)
    {
      $this->table = $table;
      $this->key = $key;
      $this->keyval = $keyval;
    }

    function save ($create_first = FALSE)
    {
      global $_cal_sql;
      global $_cal_dbpref;
      ($_cal_sql OR $_cal_sql = new _cal_sql ());
      (count ($this->fields) OR $this->fields = $this->getFields ($this->table));
      @include _CAL_BASE_PATH_ . 'customize/pre_save_' . @preg_replace ('' . '/^' . $_cal_dbpref . '/', '', $this->table) . '.php';
      if ($create_first)
      {
        $k = $this->key;
        unset ($this[key]);
        $_cal_sql->quiet = true;
        $_cal_sql->query ($this->mk_insert_q ());
        $_cal_sql->quiet = false;
        $this->key = $k;
      }

      if (($this->key AND isset ($this->keyval)))
      {
        $query = $this->mk_update_q ();
      }
      else
      {
        $query = $this->mk_insert_q ();
        if ($this->sequence)
        {
          $this->$this->key = $this->seq_id;
        }
      }

      if (($this->sequence AND $this->seq_id == 'auto'))
      {
        $this->$this->key = $_cal_sql->query ($query);
        return $this->$this->key;
      }

      return $_cal_sql->query ($query);
    }

    function mk_update_q ()
    {
      global $_cal_sql;
      $query = 'update ' . $this->table . ' set ';
      foreach ($this->fields as $val)
      {
        if ($this->excludes[$val] == 1)
        {
          continue;
        }

        if ($val == $this->key)
        {
          continue;
        }

        if (isset ($this->$val))
        {
          $query .= $val . ' = \'' . $_cal_sql->escape_string ($this->$val) . '\',';
          continue;
        }
        else
        {
          $query .= $val . ' = null,';
          continue;
        }
      }

      $query = rtrim ($query, ',');
      reset ($this->fields);
      $query .= ' where ' . $this->key . ' = \'' . $this->keyval . '\'';
      return $query;
    }

    function mk_insert_q ()
    {
      global $_cal_sql;
      $query = 'insert into ' . $this->table . ' (';
      foreach ($this->fields as $val)
      {
        if ($this->excludes[$val] == 1)
        {
          continue;
        }

        if (($val == $this->key AND (!$this->sequence OR $_cal_sql->auto_inc)))
        {
          continue;
        }

        $query .= $val . ',';
      }

      $query = rtrim ($query, ',');
      $query .= ') values (';
      reset ($this->fields);
      foreach ($this->fields as $val)
      {
        if ($this->excludes[$val] == 1)
        {
          continue;
        }

        if ($val == $this->key)
        {
          if (!$this->sequence)
          {
            continue;
          }

          $this->seq_id = $_cal_sql->next_sequence ($this->sequence);
          if ($this->seq_id == 'auto')
          {
            continue;
          }

          $this->$val = $this->seq_id;
        }

        if (isset ($this->$val))
        {
          $query .= '\'' . $_cal_sql->escape_string ($this->$val) . '\',';
          continue;
        }
        else
        {
          $query .= 'null,';
          continue;
        }
      }

      $query = rtrim ($query, ',');
      $query .= ')';
      return $query;
    }

    function fill_vars ()
    {
      global $_cal_sql;
      global $_cal_dbpref;
      ($_cal_sql OR $_cal_sql = new _cal_sql ());
      (count ($this->fields) OR $this->fields = $this->getFields ($this->table));
      @include _CAL_BASE_PATH_ . 'customize/pre_get_' . @preg_replace ('' . '/^' . $_cal_dbpref . '/', '', $this->table) . '.php';
      $query = 'select ';
      foreach ($this->fields as $fld)
      {
        if ($this->excludes[$fld] == 1)
        {
          continue;
        }

        $col = $this->table . '.' . $fld;
        if ($this->translations[$fld])
        {
          $query .= $_cal_sql->sql_alias ($col, $this->translations[$fld]);
          unset ($this->translations[$fid]);
        }
        else
        {
          $query .= $_cal_sql->sql_alias ($col, $fld);
        }

        $query .= ',
';
      }

      reset ($this->translations);
      if (0 < count ($this->translations))
      {
        while (list ($key, $val) = each ($this->translations))
        {
          $query .= $_cal_sql->sql_alias ($key, $val) . ',
';
        }

        $query .= '
';
      }

      $query = rtrim ($query, ',
');
      $query .= ' from ' . $this->table;
      if (0 < count ($this->joins))
      {
        foreach ($this->joins as $join)
        {
          $query .= ' ' . $join;
        }

        $query .= '
';
      }

      $query .= ' where ' . $this->table . '.' . $this->key . ' = \'' . $this->keyval . '\'';
      list ($tmparr) = $_cal_sql->query ($query);
      if ($tmparr)
      {
        _ex_tie_to ($this, $tmparr);
      }
      else
      {
        $this->not_found = 1;
      }

      @include _CAL_BASE_PATH_ . 'customize/post_get_' . @preg_replace ('' . '/^' . $_cal_dbpref . '/', '', $this->table) . '.php';
    }

    function getfields ($table)
    {
      $flds = $GLOBALS['_cal_sql']->getFields ($table);
      return $flds;
    }

    function exclude ($str)
    {
      $this->excludes[$str] = 1;
    }

    function add_translation ($f1, $f2)
    {
      $this->translations[$f1] = $f2;
    }

    function add_join ($str)
    {
      $this->joins[] = $str;
    }
  }

  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/helpers/tie_to.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql.php';
?>