<?php

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


  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql_based_adv.php';
  class _cal_event_type extends _cal_sql_based_adv
  {
    function _cal_event_type ($keys = null)
    {
      $this->_cal_sql_based_adv ('' . $GLOBALS['_cal_dbpref'] . 'EventTypes', $keys);
      if ($keys != null)
      {
        $this->fill_vars ();
      }

    }
  }

?>