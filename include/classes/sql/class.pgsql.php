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
// $Id: class.pgsql.php,v 1.16 2006/07/11 22:34:10 ian Exp $
//


class _cal_sql
{

   var $_connected;
   var $dbHandle;
   var $quiet = false;
   var $die_on_error = false;

   var $functions = array('substr' => 'substr');

   var $subselects = true;

   var $qs = 0;

   function _connect_error($errno, $errstr, $errfile, $errline, $errcontext)
   {
      if(substr($errstr,0,10) == 'constant()') return;

      $this->error_out("_connect()" , $errstr);
      return true;

   }


   function _cal_sql($user = null,$pass = null,$db = null, $host = null, $port = null)
   {
     
      if(!isset($this->_connected) || $this->_connected == FALSE) {
         $this->_connect($user,$pass,$db,$host,$port);
      }

   }

   function next_sequence($seq)
   {

      list($seqval) = $this->query("select NEXTVAL('". $seq ."') as nextval");

      print_r($seqval);

     return $seqval['nextval'];


   }


   function query($strQuery, $numbered = 0)
   {

      $this->qs++;

      if(strncasecmp($strQuery, "select", 5) != 0) {

         if(!$result = @pg_query($this->dbHandle, $strQuery)) {
            $this->error_out("query()", pg_last_error(), "<pre>".$strQuery."</pre>");
            return 0;
         }

         return $result;

      } 

      $return_arr = array();

      if(!$result = @pg_query($this->dbHandle, $strQuery)) {
         $this->error_out("query()", pg_last_error(), "<pre>".$strQuery."</pre>");
         return $return_arr;
        
      }

      if($numbered) {

          while($tmparr = pg_fetch_row($result, $i)) {

             $return_arr[$tmparr[0]] = $tmparr[1];

          }



       } else {
       
          while($tmparr = pg_fetch_assoc($result)) {
             $return_arr[] = $tmparr;
          }

       }


       return $return_arr;


   }


   function getFields($table)
   {

      $fields = array();

      $table = strtolower($table);

      $result = @pg_query($this->dbHandle, "
	select a.attname as field
		from pg_attribute a, pg_class c, pg_type t
		where c.relname = '". $table ."' and a.attnum > 0
		and a.attrelid = c.oid and a.atttypid = t.oid");


      if(!$result) {
         $this->error_out("getFields()", pg_last_error() ."<br>");
         return $fields;
      }
     
      while($row = pg_fetch_row($result)) {
         array_push($fields, $row[0]);
      }
      

      return $fields;

   }



   function _connect($user,$pass,$db,$host,$port)
   {
 
      set_error_handler(array($this, "_connect_error"));
      $er = error_reporting(E_ALL);

      if(!($user || $pass || $db || $host || $port)) {
         $user = @constant("_CAL_DBUSER_");
         $pass = @constant("_CAL_DBPASS_");
         $db = @constant("_CAL_DBNAME_");
         $host = @constant("_CAL_DBHOST_");
         $port = @constant("_CAL_DBPORT_");
      }

 
      $conn_str = "dbname=".($db ? $db : "template1") ." ";

      if(strlen($host)) $conn_str .= "host=".$host." ";
      if(strlen($port)) $conn_str .= "port=".$port." ";
      if(strlen($user)) $conn_str .= "user=".$user." ";
      if(strlen($pass)) $conn_str .= "password=".$pass." ";

      if(@constant("_CAL_PERSISTENT_SQL_CONN_")) $this->dbHandle = pg_pconnect($conn_str);
      else $this->dbHandle = pg_pconnect($conn_str);

      $this->_connected = ($this->dbHandle);

      error_reporting($er);
      restore_error_handler();

   }


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


   function sql_alias($col, $as)
   {
      return $col ." as ". $as ." ";
   }

   function sql_binary_and($v1,$v2)
   {

      return " CAST(". $v1 ." as BIGINT) & CAST(". $v2 ." as BIGINT) ";

   }

   function sql_limit($select, $limit, $offset)
   {

      return $select . " limit ". $limit ." offset ". $offset;
   }

   function escape_string($str)
   {

      return pg_escape_string($str);

   }

##################################
#
### error out
#
##################################

   function error_out($func, $msg, $xtra = "")
   {
      if(!$this->quiet) {
         echo("<BR>". _ERROR_ .": class.pgsql.php :: ". $func ." :: ". $msg ."<br>");
         echo($xtra ."<br>");
      }

      if($this->die_on_error) exit;

   }


}


?>
