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


  require_once @constant ('_CAL_BASE_PATH_') . 'include/config.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.options.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.sql_based.php';
  class _cal_group extends _cal_sql_based
  {
    var $id = null;
    var $name = null;
    var $description = null;
    function _cal_group ($id = null)
    {
      if (($id !== null AND !$id))
      {
        $id = 0;
      }

      $this->_cal_sql_based ('' . $GLOBALS['_cal_dbpref'] . 'Groups', 'id', $id);
      $this->sequence = '' . $GLOBALS['_cal_dbpref'] . 'groups_id_seq';
      if ($id)
      {
        $this->fill_vars ();
      }

    }
  }

?>