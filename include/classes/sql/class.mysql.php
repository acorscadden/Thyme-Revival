<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 eXtrovert Software                           |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@extrosoft.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: class.mysql.php,v 1.25 2008/07/22 22:38:09 ian Exp $
//

class _cal_sql
{

   var $_connected = false;
   var $quiet = false;
   var $die_on_error = false;

   var $functions = array('substr' => 'substring');

   var $auto_inc = true;

   var $subselects = false;

   var $qs = 0;

   var $qsa = array();
 
   function _cal_sql($user = null, $pass = null, $db = null, $host = null, $port = null)
   {
      global $mambo_opts, $mainframe;

      if(!isset($this->_connected) || $this->_connected == FALSE) {
         $this->_connect($user,$pass,$db,$host,$port);
      }

   }

   function query($strQuery, $numbered = 0)
   {

      $this->qs++;

      $strQuery = trim($strQuery);


      if(strncasecmp($strQuery, "select ", 7) != 0) {

         if(!($result = @mysql_query($strQuery, $this->dbHandle))) {
            $this->error_out("query()", mysql_error($this->dbHandle), "<pre>". $strQuery ."</pre>\n");
            return;
         }

         if(strncasecmp($strQuery, "insert ", 7) === 0) {

            if(($ins_id = mysql_insert_id($this->dbHandle)))
               return $ins_id;

            return true;

         }

         return $result;

      } 

      $return_arr = array();

      if(!($result = @mysql_query($strQuery, $this->dbHandle))) {
         $this->error_out("query()", mysql_error($this->dbHandle), "<pre>". $strQuery ."</pre>\n");
         return $return_arr;
       }

      if($numbered) {

          while($tmparr = mysql_fetch_row($result)) {

             $return_arr[$tmparr[0]] = $tmparr[1];

          }



       } else {
       
          while($tmparr = mysql_fetch_assoc($result)) {
             $return_arr[] = $tmparr;
          }

       }

       mysql_free_result($result);

       return $return_arr;


   }


   function getFields($table)
   {

      $fields = array();

      $result = @mysql_query("describe ".$table, $this->dbHandle);

      if(!$result) {
         $this->error_out("getFields()", mysql_error($this->dbHandle));
         return $fields;
      }
      
      while($row = mysql_fetch_row($result)) {
         array_push($fields, $row[0]);
      }
      
      mysql_free_result($result);

      return $fields;

   }


   function _connect($user,$pass,$db,$host,$port)
   {
      if(!($user || $pass || $db || $host || $port)) {
         $user = @constant("_CAL_DBUSER_");
         $pass = @constant("_CAL_DBPASS_");
         $db = @constant("_CAL_DBNAME_");
         $host = @constant("_CAL_DBHOST_");
         $port = @constant("_CAL_DBPORT_");
      }

      if(class_exists('JFactory') && class_exists('JConfig')) {

        global $jAuthConfig;

        # CREATE A NEW CONNECTION TO JOOMLA'S DB
        ##########################################
        $jAuthConfig['conn_id'] =& JFactory::getDBO();
        $jConfig = new JConfig();

        $jAuthConfig['shared_connect'] = (
            ($jConfig->user == _CAL_DBUSER_)
                 &&
            ($jConfig->db != _CAL_DBNAME_)
            );

      }

      if(strlen($port)) $host .= ":" . $port;

      if(@constant("_CAL_PERSISTENT_SQL_CONN_")) {
            $this->dbHandle = @mysql_pconnect($host, $user, $pass);
      } else {

        if(class_exists('JFactory')) {
            $this->dbHandle = @mysql_connect($host, $user, $pass,                               
             ($GLOBALS['jAuthConfig']['shared_connect']));
        } else {
            $this->dbHandle = @mysql_connect($host, $user, $pass,
             ($GLOBALS['mainframe'] && $GLOBALS['mosConfig_db'] != $db));
        }
      }

      if(!$this->dbHandle) {
         $this->error_out("_connect()", mysql_error());
      } else if(strlen($db) && !mysql_select_db($db, $this->dbHandle)) {
         $this->error_out("mysql_select_db()", mysql_error(), "<pre>". $strQuery ."</pre>\n");
      } else {
         $this->_connected = TRUE;
         $this->subselects = substr(mysql_get_server_info($this->dbHandle),0,3) >= 4.1;
      }

   }



   function sql_alias($col, $as)
   {
      return $col ." as ". $as ." ";
   }

   function sql_binary_and($v1,$v2)
   {

      return " ". $v1 ." & ". $v2 ." ";

   }

   function sql_limit($select, $limit, $offset)
   {


      return $select . " limit ". $offset .", ". $limit;
   }

   function escape_string($str)
   {

      return mysql_escape_string($str);

   }

   # mysql doesn't do sequences
   function next_sequence() { return "auto"; }

   function insert($tbl, $flds)
   {

      $this->query("insert into {$GLOBALS['_cal_dbpref']}{$tbl} (". join(",", array_keys($flds)) .")
        values (". join(",", $flds) .")");

   }

   function update($tbl, $flds, $cnd = "")
   {

      $query = "update {$GLOBALS['_cal_dbpref']}{$tbl} set ";
      $upd = array();

      while(list($k,$v) = each($flds)) {
         $upd[] = "$k = {$v} ";
      }
      $query .= join(",", $upd);
      $upd = array();

      if(is_array($cnd) && count($cnd)) {
         while(list($k,$v) = each($cnd)) {
            $upd[] = "$k = {$v}";
         }
         $query .= " where " . join(" and ", $upd);
      }

      $this->query($query);


   }



   function error_out($func, $msg, $xtra = "")
   {

      if(!$this->quiet) {
         echo("<BR>". _ERROR_ .": class.mysql.php :: ". $func ." :: ". $msg ."<br>");
         echo($xtra);
      }

      if($this->die_on_error) exit;

   }


}


?>
