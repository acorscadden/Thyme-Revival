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


  function check_step ()
  {
  }

  function step ()
  {
    global $_cal_html;
    global $_cal_form;
    $_cal_html->print_heading ('License Agreement');
    echo '<table align=\'center\' width=\'100%\' border=0><tr><td align=\'center\'>

<iframe width=\'90%\' height=300 src=\'LICENSE.txt\' style=\'background: #ffffff; border-bottom: 1px solid black\'></iframe><br><br>
Can\'t see the license agreement? <a href=\'LICENSE.txt\' class=\'hil\' target=_blank>Click here</a>.<br>
</td></tr></table>
<br>
By installing this software, you are accepting and agreeing to the terms of this licens';
    echo 'e agreement.
If you are not willing to be bound by the terms of this license agreement, you should promptly
close this window and remove all copies of this software.
This license agreement represents the entire agreement
concerning this software between you and extrovert software, and it supersedes any prior
proposal, representation, or understanding between the parties.
<br><br>
<table cellpa';
    echo 'dding=5 align=\'center\'>
<tr class=\'toolbar\'>
  <td align=\'center\'>

';
    echo $_cal_form->submit ('action', 'Next', ' style=\'width: 80px;\'');
    echo '
</td>
</tr>
</table>

';
  }

  echo '
';
?>