<?php

   if(!$_cur_cal->id) return;

   global $_cur_cal, $_cal_user;

   $_cal_modules['sync']['include'] = "sync/sync.php";

   if(!$_cal_user->access->can_add($_cur_cal))
      $_cal_modules['sync']['display_name'] = _EXPORT_;
   else
      $_cal_modules['sync']['display_name'] = _SYNC_;

   $_cal_modules['sync']['parents'][] = 'footer';
   $_cal_modules['sync']['priority'] = -90;
   $_cal_modules['sync']['hide_nav'] = 1;
   $_cal_modules['sync']['keep_cal_title'] = 1;


?>
