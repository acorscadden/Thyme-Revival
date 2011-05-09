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
//


########################
# tie the passed array's or
# object's vars to ours..
############################

function _ex_tie_to(&$obj, $mixed)
{

   if(is_object($mixed)) {

      $vars = get_object_vars($mixed);

      while(list($key, $val) = each($vars)) {

         is_object($obj) ? ($obj->$key = $val) : ($obj[$key] = $val);
      }

   } else if (is_array($mixed)) {

      while( list($key, $val) = each($mixed)) {

         is_object($obj) ?  ($obj->$key = $val) : ($obj[$key] = $val);
      }
   }


}




?>
