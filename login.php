<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
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
//


   define("_CAL_FORCE_THEME_","default");
   define("_CAL_BASE_PATH_", dirname(__FILE__) . '/');

   require_once(@constant("_CAL_BASE_PATH_") . "include/config.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/theme_engine.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.form.php");


   if(@include(_CAL_BASE_PATH_."customize/login.php")) return;

   @Header("Content-Type: text/html; charset=". _CHARSET_);

   _ex_theme_set("default");

?>
<html>
<head>
<title><?php echo(_CALENDAR_ .' - ' ._LOGIN_) ?></title>
<meta http-equiv="Content-type: text/html; charset=<?php echo(_CHARSET_) ?>" />
<style type='text/css'>

#cal html, body.cal
{
   height: 100%;
}

   body { margin-top: 0px; }
   #cal a.hil:link, #cal a.hil:visited {
           text-decoration: underline;
           background: #ffff00;
           color: #000000;
           padding: 2px;
           }

   #cal font.hil { background: #ffff00; color: #000000; }

   #cal table td, #cal table { color: #000000; border-color: #ffffff; font-family: arial, verdana, 'sans serif'; font-size: 11px;

}
   #cal .main_header { background: #000000; color: #ffffff; }
   #cal .row_header { background: #cccccc; }

   #cal font.heading { color: #a00; font-size: 18px; font-weight: bold; }

#cal .button {
   font-size: 12px;
   background-image: url(themes/sleek/images/tab_bg.gif);
   color: #fff;
   padding-left: 10px;
   padding-right: 10px;
   padding-top: 2px;
   padding-bottom: 2px;
   border: 0px;

}

#cal input, #cal select { font-size: 10px; }

#cal .textbox { width: 120px; }

#cal a:link, #cal a:visited { color: #006699; text-decoration: underline; }

#cal .spacer_tiny { height: 1px; padding: 0px; }

#cal table tr td.toolbar, #cal table tr.toolbar td { background: #999999; border: 1px solid black; padding: 4px;}

#cal a.main_header:link, #cal a.main_header:visited { font-size: 11px; color: #fff; }

</style>
</head>
<body class='cal'>
<div id='cal'>
<?php

   $form = new _cal_form();
   $form->action = _CAL_BASE_URL_._CAL_PAGE_MAIN_;
   $form->print_header();

?>
<table width='100%' align='center' style='border-bottom: 1px solid black; background: #ffffff; padding: 0px'>
        <tr valign='middle'><td align='left'>                <table border=0
                style='background: #ffffff; padding: 0px;'>
                <tr valign='middle'>

               <td align'center' style='padding: 0px'><img src='images/logo.png'></td>


                <td align='center'><font color='white' size='-1'> </td>


                </tr></table>
</td><td align='right'
    stle='padding 2px; background: #ffffff'>
    <font color='#000000' style='margin-right: 10px; font-family: arial; font-size: 11px'><b> ( 1.3 ) </b></font></td></tr></table><br><br><br><br>







<table border=0 class='<?php echo(_CAL_CSS_BODY_) ?>' width="100%" cellpadding=4 cellspacing=4 style="border: 0; padding: 4px;">
<tr valign=middle style="vertical-align: middle;"> 
<td align=center style='height: 100%'>


<?php if($_REQUEST['msg']): ?>
<h3 align=center style='display: inline'><?php echo($_REQUEST['msg']) ?></h3>
<br><br><br>
<?php endif ?>




<table width='75%' style='padding: 0px; border: 0px; border-collapse: collapse; border-spacing: 0px'>

<tr><td align='left' style='height: 40px'><font class='heading'><?php echo((defined("_CAL_SITE_NAME_") ? _CAL_SITE_NAME_ : "Thyme") ." :: "._LOGIN_) ?></font><br><br></td></tr>

<tr><td style='padding: 0px;'>
<?php _ex_content_header() ?>
</td></tr>
<tr><td class='row_header' style='padding-top: 50px; padding-bottom: 50px'>

<table border=0 align='center'
style="background: #fff; border: 2px solid #000; padding: 4px;"
cellpadding=4 class='<?php echo(_CAL_CSS_SPACED_TABLE_) ?>'>

<tr><td><img src='images/security.png'></td></td>

<td>
<table>
<tr>
   <td align=right><b><?php echo(_USERNAME_) ?>:</b></td>
   <td><input type=text class='<?php echo(_CAL_CSS_TEXTBOX_) ?>' name="userid"></td>
</tr>
<tr>
   <td align=right><b><?php echo(_PASSWORD_) ?></b>:</td>
   <td><input class='<?php echo(_CAL_CSS_TEXTBOX_) ?>' type=password name="pass"></td>
</tr>

<tr><td colspan=2 align="center">
<br>
<table>
   <td colspan=2 align="center"
   class='<?php echo(_CAL_CSS_TOOLBAR_) ?>'>
    <?php echo($form->submit("login", _LOGIN_, 
    " style='font-size: 12px; padding-top: 2px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px;'")) ?>
    </td>
</tr>
</table>
</td>
</tr>

</table>

</td></tr>

</table>

<?php

   $guest = new _cal_user("","",0);

   if($guest->login()) {
?>
   <br><div align='center'>
   <a class='<?php echo(_CAL_CSS_ULINE_) ?>'
    href="<?php echo(_CAL_PAGE_MAIN_) ?>?logout=1"><b><?php echo(_PUBLIC_ACCESS_) ?></b></a>
   </div>
<?php

   }
?>


</td></tr>
<tr><td>
<?php _ex_content_footer(array()) ?>
</td</tr></table>





</td>
</tr>
</table>
</div>
<?php
   $form->print_footer();
?>
<script language='javascript' type='text/javascript'>
<!--

document.forms[0].elements[0].focus();

-->
</script>
</body>
</html>
