<div class='<?php echo(_CAL_CSS_CALNAV_) ?>'>
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
// $Id: navbar.php,v 1.16 2006/03/10 17:36:52 ian Exp $
//


   global $_cal_sql, $_cal_modules, $_cal_user, $_cal_nav_umods, $_cal_dbpref;

   $_cal_nav_umods or $_cal_nav_umods = $_cal_sql->query("select * from {$_cal_dbpref}NavModules
        where uid = ".  $_cal_user->id  ." order by leftright, mod_order");


   if(!$_cal_orientation && !$_cal_modules['navbar']['modules_left']) $_cal_orientation = 1;

   foreach($_cal_nav_umods as $u)
   {

      if(intval($_cal_orientation) != intval($u['leftright'])) continue;


      if($_cal_user->guest && $_cal_modules[$u['module']]['no_guest'])
         continue;

      if(!$_cal_user->guest && $_cal_modules[$u['module']]['guest_only'])
         continue;

      if(!$_cal_user->admin && $_cal_modules[$u['module']]['admin_module'])
         continue;

      if($_cal_user->admin && $_cal_modules[$u['module']]['no_admin'])
         continue;

      

      if(!@include(@constant("_CAL_BASE_PATH_") . "modules/". $_cal_modules[$u['module']]['navbar']))
         continue;

      eval($_cal_modules[$u['module']]['callback']);
      echo("<br>");

   }

   $_cal_orientation = 1;

?>
</div>
