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

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.calendar_real.php");
?>
<table width='100%' style='border-collapse: collapse' class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<tr class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
   <td class='<?php echo(_CAL_CSS_BOUNDING_TABLE_) ?>'>
<?php

   global $cal;

   $cal or $cal = new _cal_calendar_real();

   if($_SESSION['evnt_type'] > 0) $cal->event_types = $_SESSION['evnt_type'];

   # cal view is defined in index.php

   switch($_cal_view)
   {
      case "y":
      $cal->display_years_mini();
      break;

      case "m":
      $cal->display_year_mini();
      break;

      default:
      $cal->display_month_mini();

   }
?>
   </td>
</tr>
</table>
