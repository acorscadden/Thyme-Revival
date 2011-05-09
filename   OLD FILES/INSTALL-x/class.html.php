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


  class html
  {
    var $_head = array ();
    var $js_onload = array ();
    function html ()
    {
    }

    function adv ()
    {
      $th = '                <table border=0
                style=\'background: #ffffff; padding: 0px;\'>
                <tr valign=\'middle\'>

               <td align\'center\' style=\'padding: 0px\'><img src=\'images/logo.png\'></td>


                <td align=\'center\'><font color=\'white\' size=\'-1\'> </td>


                </tr></table>
';
      echo '<table width=\'100%\' align=\'center\' style=\'border: 2px solid black; background: #ffffff; padding: 0px\'>
        <tr valign=\'middle\'><td align=\'left\'>' . $th . '</td><td align=\'right\'
	stle=\'padding 2px; background: #ffffff\'>
	<font color=\'#000000\' style=\'margin-right: 10px; font-family: arial; font-size: 11px\'><b> Version - ' . $GLOBALS['this_ver'] . '</b></font></td></tr></table><br>
';
      echo '<div id=\'cal\'>
';
    }

    function print_heading ($l = '', $m = '', $r = '')
    {
      echo '<table width=\'90%\' align=\'center\'><tr><td>
';
      _ex_content_title ($l, $m, $r);
      echo '</td></tr></table>
';
      echo '<hr width=\'90%\'>
';
      echo '<div align=\'center\' style=\'width: 100%;\'>
';
      echo '<div align=\'left\' style=\'width: 90%\'>
';
    }

    function print_sub_heading ($text)
    {
      _ex_section_header ($text);
    }

    function print_header ($title, $strXTRA = '')
    {
      header ('Content-Type: text/html; charset=iso-8859-1');
      if (0 < strlen ($strXTRA))
      {
        header ($strXTRA);
      }

      echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
';
      echo '
<html>
<head>
';
      echo '<title>' . $title . '</title>
';
      foreach ($this->_head as $str)
      {
        echo $str . '
';
      }

      echo '<style type=\'text/css\'>
   body { margin-top: 0px; }
   #cal a.hil:link, #cal a.hil:visited {
	   text-decoration: underline;
	   background: #ffff00;
	   color: #000000;
           padding: 2px;
	   }

   #cal font.hil { background: #ffff00; color: #000000; }

   #cal table td, #cal table { color: #000000; border-color: #ffffff; font-family: arial, verdana, \'sans serif\'; font-size: 11px;

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

#cal a:link, #cal a:visited { color: #006699; text-decoration: underline; }

#cal .spacer_tiny { height: 1px; padding: 0px; }

#cal table tr td.toolbar, #cal table tr.toolbar td { background: #999999; border: 1px solid black; }

#cal a.main_header:link, #cal a.main_header:visited { font-size: 11px; color: #fff; }

#faqlist ul { font-size: 12px; list-style-type: none; }
#faqlist li { padding: 4px; }

#faq a:link, #faq a:visited { color: #006699; text-decoration: underline; }



   </style>
   ';
      echo '</head>
';
      echo '<body class=\'cal\'>
';
    }

    function print_footer ()
    {
      echo '<script language=\'JavaScript\' type=\'text/javascript\'>
';
      foreach ($this->js_onload as $js)
      {
        echo $js . '
';
      }

      echo '</script>
';
      echo '<br>';
      echo '<div align=\'right\' style=\'font-size: 9px\'>&copy; 2006 eXtovert software LLC - All rights reserved</div>';
      echo '</div></div></div>
</body>
</html>
';
    }

    function add_head ($str)
    {
      $this->_head[] = $str;
    }
  }

  require @constant ('_CAL_BASE_PATH_') . 'css/css_defines.php';
  require @constant ('_CAL_BASE_PATH_') . 'include/classes/class.url.php';
  require @constant ('_CAL_BASE_PATH_') . 'include/theme_engine.php';
  require @constant ('_CAL_BASE_PATH_') . 'themes/default/register_theme.php';
  define ('_CHARSET_', 'iso-8859-1');
?>