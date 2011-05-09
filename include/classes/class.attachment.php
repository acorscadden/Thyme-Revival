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
// $Id: class.attachment.php,v 1.8 2006/03/10 17:36:26 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");

class _cal_attachment extends _cal_sql_based
{

var $is_pointer = false;

function _cal_attachment($id)
{

   $this->_cal_sql_based("{$GLOBALS['_cal_dbpref']}Attachments", "id", $id);
   
   $this->fields = array("id", "eid", "filename", "filesize", "filetype");

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

   $this->suffix = strtolower(preg_replace("/.*\./", ".", $this->filename));
   $this->prefix = strtolower(preg_replace("/\..*$/", "", $this->filename));


   $this->icon = $this->get_icon();
   $this->size = $this->format_filesize();
}




#################################
#
### A MORE READABLE FILESIZE
#
#################################

function format_filesize()
{

   if($this->filesize < 1024)
      return intval($this->filesize) . " ". _BYTES_;

   if($this->filesize / 1024 < 1024)
      return intval($this->filesize / 1024) . " ". _KBYTES_;

   $fsize = ($this->filesize / 1024) / 1024;

   return sprintf("%01.2f", $fsize) . " " . _MBYTES_;
}


###########################
#
### RETURN THE ICON NAME 
#
############################

function get_icon()
{

   global $_cal_cached_icons;

   $this->get_icon_types();

   if(strpos($this->filename, "://") && !preg_match("/^[a-z]+:\/\/[a-z0-9\.]+[:|0-9]*\/.+/i", $this->filename))
      return $_cal_cached_icons['prefixes']['http'];


   # search in suffixes first
   ##########################
   if($_cal_cached_icons['suffixes'][$this->suffix])
      return $_cal_cached_icons['suffixes'][$this->suffix];

   # exact matches
   if($_cal_cached_icons['exeact_matches'][strtolower($this->filename)])
      return $_cal_cached_icons['exact_matches'][strtolower($this->filename)];

   # exact types
   if($_cal_cached_icons['exact_types'][strtolower($this->filetype)])
      return $_cal_cached_icons['exact_types'][strtolower($this->filetype)];

   # types
   if($_cal_cached_icons['types'][strtolower(preg_replace("/\/.*/", "", $this->filetype))])
      return $_cal_cached_icons['types'][strtolower(preg_replace("/\/.*/", "", $this->filetype))];


   # step through prefixes
   foreach(array_keys($_cal_cached_icons['prefixes']) as $p)
   {


      if(preg_match("/^$p/", $this->filename))
         return $_cal_cached_icons['prefixes'][$p];

   }

   return $_cal_cached_icons['default_icon'];

}


##############################
#
### GET A LIST OF ICON TYPES FROM
### include/mime-types.conf
#
#################################

function get_icon_types()
{

   global $_cal_cached_icons;

   if(count($_cal_cached_icons) > 0)
      return;

   # get the icon for this attachment
   $fh = fopen(@constant("_CAL_BASE_PATH_") . "include/mime-types.conf", "rb");

   if(!$fh) {
      echo(_ERROR_ ." :: class.attachment.php :: get_icon_types() :: include/mime-types.conf<br><br>");
      return;
   }

   while(!feof($fh))
   {

      $line = trim(strtolower(fgets($fh, 1024)));


      # DOING ADDICON
      ################
      if(substr($line, 0, 8) == "addicon ") {

         $items = preg_split("/\s+/", $line) ;

         # leave off the directive
         unset($items[0]);

         # grab the icon
         $icon = $items[1];
         unset($items[1]);

         # add these types
         foreach($items as $item) {

            # by suffix
            if(substr($item, 0,1) == '.') {

               $suffixes[$item] = $icon;

            # exact match
            } else {

               $exact_matches[$item] = $icon;
            }
         }


      # DOING AddIconByType
      #####################
      } else if (substr($line, 0, 14) == "addiconbytype ") {

         $items = preg_split("/\s+/", $line);

         # leave off the directive
         unset($items[0]);
         
         # grab the icon
         $icon = $items[1];
         unset($items[1]);

         # types
         if(strrpos($item, "*") == (strlen($item)-1)) {

            $types[rtrim($item, "/*")] = $icon;

         } else {

            $exact_types[$item] = $icon;
         }


      # DOING AddIconByPrefix
      #####################
      } else if (substr($line, 0, 16) == "addiconbyprefix ") {

         $items = preg_split("/\s+/", $line);

         # leave off the directive
         unset($items[0]);

         # grab the icon
         $icon = $items[1];
         unset($items[1]);

         # add these types
         foreach($items as $item) {

            $prefixes[$item] = $icon;
            
         }

         


      # DEFAULT ICON
      ################
      } else if(substr($line, 0, 12) == "defaulticon ") {

         list($no, $icon) = preg_split("/\s+/", $line);

         $default_icon = $icon;

      }


    }
    fclose($fh);

    $_cal_cached_icons['suffixes'] = $suffixes;
    $_cal_cached_icons['prefixes'] = $prefixes;
    $_cal_cached_icons['exect_matches'] = $exact_matches;
    $_cal_cached_icons['types'] = $types;
    $_cal_cached_icons['exact_types'] = $exact_types;
    $_cal_cached_icons['default_icon'] = $default_icon;

}



}


?>
