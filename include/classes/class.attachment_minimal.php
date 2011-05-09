<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
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
// $Id: class.attachment_minimal.php,v 1.13 2006/03/27 04:47:26 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");

class _cal_attachment_minimal extends _cal_sql_based
{

var $is_pointer = false;

function _cal_attachment_minimal($id = 0)
{

   global $_cal_dbpref;

   if($id > 0) {

      $this->id = $id;

      $this->_cal_sql_based("{$_cal_dbpref}Attachments", "id", $id);
   
      $this->fields = array("id", "eid", "filename", "filesize", "filetype");
      $this->add_translation("{$_cal_dbpref}Events.calendar", "calendar");
      $this->joins[] = "left join {$_cal_dbpref}Events on {$_cal_dbpref}Events.id = {$_cal_dbpref}Attachments.eid";

      $this->fill_vars();

      ###########################
      #
      ### are we just a pointer?
      #
      ############################

      if($this->filetype == "pointer")
      {
         $this->keyval = $this->id = $this->filename;
         $this->fill_vars();
         $this->is_pointer = true;
      }

 
   } else {

      $this->_cal_sql_based("{$_cal_dbpref}Attachments", "id");
      $this->fields = array("id", "eid", "filename", "filesize", "filetype"); 


   }


   $this->sequence = "{$_cal_dbpref}attachments_id_seq";

}

###########################
# returns attachment data
###########################

function &get_attachment()
{

   global $_cal_sql;


   if(!@constant("_CAL_ATTACHMENTS_NO_HIDE_")) {
      $file = _CAL_ATTACHMENTS_PATH_ ."/" . dechex($this->id) .
        md5(serialize(array_reverse(preg_split("//",$this->filename,-1, PREG_SPLIT_NO_EMPTY))))
        .".dat";
   } else {
      $file = _CAL_ATTACHMENTS_PATH_ ."/". $this->id ."." . $this->filename;
   }
 
   return file_get_contents($file); 
}



##########################
# prints attachment data
#########################

function print_attachment()
{

   global $_cal_sql;

      if(!@constant("_CAL_ATTACHMENTS_NO_HIDE_"))
         $file = _CAL_ATTACHMENTS_PATH_ ."/". dechex($this->id) . 
            md5(serialize(array_reverse(preg_split("//",$this->filename,-1, PREG_SPLIT_NO_EMPTY))))
            .".dat";
      else      
         $file = _CAL_ATTACHMENTS_PATH_ ."/". $this->id ."." . $this->filename;

      readfile($file);

}

#######################
# save attachment data
#######################

function save_attachment($filename)
{


   # check for the directory
   ##########################
   if(!file_exists(_CAL_ATTACHMENTS_PATH_))
      echo(_ERROR_ ." :: <font class='"._CAL_CSS_HIL_."'>". _CAL_ATTACHMENTS_PATH_ ."</font> does not exist!<br>\n");
   else if(!is_writable(_CAL_ATTACHMENTS_PATH_))
      echo(_ERROR_ ." :: can not write to <font class='"._CAL_CSS_HIL_."'>". _CAL_ATTACHMENTS_PATH_ ."</font>!<br>\n"); 


   if(!@constant("_CAL_ATTACHMENTS_NO_HIDE_")) {
      $newfile = _CAL_ATTACHMENTS_PATH_ ."/". dechex($this->id) . 
           md5(serialize(array_reverse(preg_split("//",$this->filename,-1, PREG_SPLIT_NO_EMPTY))))
            .".dat";
   } else {
      $newfile = _CAL_ATTACHMENTS_PATH_ ."/". $this->id ."." . $this->filename;
   }

   return move_uploaded_file($filename, $newfile);

}

########################
# delete attachment data
#########################

function delete_attachment_data()
{



   if(!@constant("_CAL_ATTACHMENTS_NO_HIDE_"))
      $file = _CAL_ATTACHMENTS_PATH_ ."/". dechex($this->id) . 
        md5(serialize(array_reverse(preg_split("//",$this->filename,-1, PREG_SPLIT_NO_EMPTY))))
            .".dat";
   else
      $file = _CAL_ATTACHMENTS_PATH_ ."/". $this->id ."." . $this->filename;


   return unlink($file);


}

#############################
#
### DELETE ATTACHMENT
#
############################

function delete_attachment($aid)
{

   global $_cal_sql, $_cal_dbpref;

   $a = new _cal_attachment_minimal($aid);

      # happily delete any attachment pointers
      #######################################
      if($a->is_pointer) {

         $_cal_sql->query("delete from {$_cal_dbpref}Attachments where id = ". $aid);

      }


      # do we have anything else that points
      # at this attachment?
      ########################################
      $pointers = count($_cal_sql->query("select id, eid from {$_cal_dbpref}Attachments where
    filetype = 'pointer' and filename = '". $a->id ."'", true));


      if(!$a->is_pointer && $pointers > 0) {

         # if this isn't a pointer, set the eid to 0 so that
         # we detatch it, yet leave it for the other events that
         # point to it

         $_cal_sql->query("update {$_cal_dbpref}Attachments set eid = 0 where id = ". $a->id);


      } elseif ($pointers == 0 && ($a->eid == 0 || !$a->is_pointer)) {

         # we can just delete it since nothing points to it

         $_cal_sql->query("delete from {$_cal_dbpref}Attachments where id = ". $a->id);

         # also delete the actual file if we need to

         $a->delete_attachment_data();

      }


}


}


?>
