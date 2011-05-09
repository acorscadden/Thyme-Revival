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
// $Id: modules.php,v 1.7 2006/03/10 17:36:40 ian Exp $
//

################################
#
### COMPARE BASED ON PRIORITY
#
###############################

function _ex_mod_cmp($a, $b)
{

   global $_cal_modules;

   if($_cal_modules[$a]['priority'] == $_cal_modules[$b]['priority']) return 0;
   return ($_cal_modules[$a]['priority'] < $_cal_modules[$b]['priority']) ? -1 : 1;


}

   ## modules
   ###################

   global $_cal_modules;

   $dh = dir(@constant("_CAL_BASE_PATH_")."modules");
   while (false !== ($entry = $dh->read())) {

      if(substr($entry, 0,1) == ".") {
         continue;
      }

      if(!@include(@constant("_CAL_BASE_PATH_"). "modules/".$entry."/register_module.php"))
         continue;

      if(!is_array($_cal_modules[$entry]['parents'])) continue;

      foreach($_cal_modules[$entry]['parents'] as $p)
      {
         $_cal_modules[$p]['sub_modules'][] = $entry;
         usort($_cal_modules[$p]['sub_modules'], "_ex_mod_cmp");
      }

   }
   $dh->close();


?>
