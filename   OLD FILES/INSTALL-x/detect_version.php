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

  function detect_version (&$s)
  {
    global $_cal_dbpref;
    $flds = $s->getFields ('' . $_cal_dbpref . 'Events');
    if (!count ($flds))
    {
      return 'none';
    }

    if (array_search ('freq', $flds) !== FALSE)
    {
      return '1.3';
    }

    return 'unknown';
  }

?>