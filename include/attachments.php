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
// $Id: attachments.php,v 1.19 2007/10/03 18:20:16 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.attachment_minimal.php");

function update_attachments(&$event)
{

   global $_cal_sql, $_cal_err_msgs, $_cur_cal;

   $_cal_sql or $_cal_sql = new _cal_sql();

   ########################
   # MANIPULATE ATTACHMENTS
   ########################

   foreach($_FILES as $attch) {


      if(!(@constant("_CAL_ATTACHMENTS_") && ($_cur_cal->options & 1))) continue;

      ##########################
      #
      ### SAVE ATTACHMENTS
      #
      ##########################
      if($attch['error'] > 0 && $attch['error'] < 4) {

         $msgs = array(1 => "UPLOAD_ERR_INI_SIZE","UPLOAD_ERR_FORM_SIZE","UPLOAD_ERR_PARTIAL");

         $_cal_err_msgs[] = _ERROR_ ." :: ". $attch['error'] ." :: ". $msgs[$attch['error']]  ."<br>" .
	   'http://www.php.net/manual/features.file-upload.errors.php';
         continue;
      }


      if($attch['name'])
      {

         if(intval(@constant("_CAL_ATTACHMENTS_SIZE_")) > 0)
         {
 
            if(($attch['size'] / 1024) / 1024 > intval(@constant("_CAL_ATTACHMENTS_SIZE_"))) {
               $_cal_err_msgs[] = $attch['name'] ." : " . _ATTACHMENT_TOO_BIG_ ." (".
                    @constant("_CAL_ATTACHMENTS_SIZE_") ._MBYTES_.")";
               continue;
            }
         }

         $a = new _cal_attachment_minimal();

         $a->filesize = $attch['size'];
         $a->filetype = $attch['type'];
         $a->filename = $attch['name'];
         $a->eid = $event->id;

         # "pointer" is a reserverd type
         if($a->filetype == "pointer")
            $a->filetype = "pointer_";


         # save the attachment ...
         if(!$a->save())
            die(_ERROR_ ." :: class.attachment_minimal.php :: save()\n");


         if(!$a->save_attachment($attch['tmp_name']))
         {
            $_cal_err_msgs[] = _ERROR_ ." :: class.attachment_minimal.php :: save_attachment()\n";
            $_cal_sql->query("delete from {$GLOBALS['_cal_dbpref']}Attachments where id = ". $a->id);
         }

      }

   }

   ################################
   #
   ### ADD URL ATTACHMENTS
   #
   ################################
   for($i = 0; $i < 5; $i++) {

      if(strlen(trim($_REQUEST['url_attachment_' . $i]))) {

         if(!strpos($_REQUEST['url_attachment_'. $i], "://"))
            $_REQUEST['url_attachment_'. $i] = 'http://' . $_REQUEST['url_attachment_'. $i];

         $a = new _cal_attachment_minimal();
         $a->filename = $_REQUEST['url_attachment_'. $i];
         $a->filetype = $_REQUEST['url_attachment_title_'. $i];
         $a->eid = $event->id;
         $a->save();

      } 


   }

   ##################################
   #
   ### LIST OF ATTACHMENTS TO DELETE
   #
   ##################################
   $keys = array_keys($_REQUEST);
   $aids_to_delete = array();

   foreach($keys as $key)
   {

      if(strpos($key, "delete_attach_") !== 0)
         continue;

      if($_REQUEST[$key] == 1)
         $aids_to_delete[] = substr($key,14);

   }

   ############################
   #
   ### JUST COPY AN INSTANCE
   #
   ############################

   if($_REQUEST['eid'] == $event->override_id && ($_REQUEST['eid'] > 0))
   {

      $alist = $_cal_sql->query("select id from {$GLOBALS['_cal_dbpref']}Attachments where eid = ". intval($_REQUEST['eid']));

      foreach($alist as $aid)
      {

         # skip it if it's in the delete list

         if(array_search($aid['id'], $aids_to_delete) !== FALSE)
            continue;

    
         $a = new _cal_attachment_minimal(); 
         $a->eid = $event->id;
         $a->filetype = "pointer";
         $a->filename = $aid['id'];
         $a->filesize = 0;
         $a->save();

      }


   ## we aren't copying an instance
   } else {


      foreach($aids_to_delete as $aid)
      {
         _cal_attachment_minimal::delete_attachment($aid);
      }

   }

}


?> 
