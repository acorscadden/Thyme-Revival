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


   global $_cal_user;

   define("_CAL_BENCHMARK_", 0);
   define("_CAL_USE_SESSION_", 1);

   define("_CAL_BASE_PATH_", preg_replace("/modules.global_settings$/","",dirname(__FILE__)) ."/");

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(_CAL_BASE_PATH_."include/classes/class.form.php");



?>
<html>
<head>
<title><?php echo(_PREVIEW_) ?></title>
<script language="javascript" type="text/javascript">

var head = window.opener.document.forms['globalsettings'].site_header.value;
var tail = window.opener.document.forms['globalsettings'].site_footer.value;

var content = "<?php echo("<table width='100%' border=0 align='center'><tr><td class='"._CAL_CSS_TOOLBAR_."' style='text-align: center; padding: 4px;'><input type=button class='"._CAL_CSS_BUTTON_."' value='"._CLOSE_."' onClick='self.close()'></td></tr></table>") ?>";

</script>
</head>
<body id='preview' onLoad="document.getElementById('preview').innerHTML = head + content + tail">

</body>
</html>
