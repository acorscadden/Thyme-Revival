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
// $Id: color_picker.php,v 1.7 2008/10/23 18:52:36 ian Exp $
//

error_reporting(E_ALL ^ (E_NOTICE));

require_once(dirname(dirname(dirname(__FILE__))) ."/include/config.php");

?>
<html>
<head>
<title>Color Picker</title>
</head>
<body bgColor='#ffffff' text='#000000'>
<?php

   $transpng = _CAL_BASE_URL_."images/spacer.png";
   $frm = $_REQUEST['form'];
   $elm = $_REQUEST['elm'];
   $lbls = $_REQUEST['lbl'];


?>
<script language='javascript' type='text/javascript'>

function preview( color )
{

   document.getElementById('color_prev').style.background = color;
   document.getElementById('color_prev_txt').innerHTML = "<b><font " +
	"color='black'>" + color + "</font><font color='" +
	color + "'> &nbsp; &nbsp; &nbsp; &nbsp; </font> <font " +
	"color='white'>" + color + "</font></b>";

}

function chooseColor( color )
{

   if(color.charAt(0) != '#')
      return;
   
   window.opener.document.forms['<?php echo($frm) ?>'].elements['<?php echo($elm) ?>'].value = color;

   <?php if($lbls): ?>
   <?php

       $lbls = explode(";",$lbls);

     foreach($lbls as $lbl) {
       if($_REQUEST['fg']) 
        echo("window.opener.document.getElementById('".$lbl."').style.color = color;\n");
       else
        echo("window.opener.document.getElementById('".$lbl."').style.background = color;\n");

     }
   ?>
   <?php endif ?>

   window.opener.document.forms['<?php echo($frm) ?>'].elements['<?php echo($elm) ?>'].onblur();

      self.close();
}

</script>

<table border=0 cellpadding=0 cellspacing=0 width='100%'>
<tr>
  <td align='center'>

<table cellpadding=0 cellspacing=0 border=1>
<tr valign='middle'>
   <td colspan=18 style='vertical-align: "middle";'>
<div id='color_prev' align='center'
	style='text-align: center; vertical-align: middle; padding: 0px; border: 0px;'>
<center><span id='color_prev_txt' align='center' valign='middle'
	style='height: 20px; vertical-align: "middle";'> </span></center>
</div>
   </td>
</tr>
<tr>
  <td colspan=18 style='height: 3px;'>
   </td>
</tr>
<tr>
<td bgColor='#000000'><a href='javascript:chooseColor("#000000");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#000000")'></a></td>
<td bgColor='#330000'><a href='javascript:chooseColor("#330000");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#330000")'></a></td>
<td bgColor='#660000'><a href='javascript:chooseColor("#660000");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#660000")'></a></td>
<td bgColor='#990000'><a href='javascript:chooseColor("#990000");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#990000")'></a></td>
<td bgColor='#CC0000'><a href='javascript:chooseColor("#CC0000");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC0000")'></a></td>
<td bgColor='#FF0000'><a href='javascript:chooseColor("#FF0000");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF0000")'></a></td>
<td bgColor='#003300'><a href='javascript:chooseColor("#003300");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#003300")'></a></td>
<td bgColor='#333300'><a href='javascript:chooseColor("#333300");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#333300")'></a></td>
<td bgColor='#663300'><a href='javascript:chooseColor("#663300");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#663300")'></a></td>
<td bgColor='#993300'><a href='javascript:chooseColor("#993300");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#993300")'></a></td>
<td bgColor='#CC3300'><a href='javascript:chooseColor("#CC3300");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC3300")'></a></td>
<td bgColor='#FF3300'><a href='javascript:chooseColor("#FF3300");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF3300")'></a></td>
<td bgColor='#006600'><a href='javascript:chooseColor("#006600");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#006600")'></a></td>
<td bgColor='#336600'><a href='javascript:chooseColor("#336600");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#336600")'></a></td>
<td bgColor='#666600'><a href='javascript:chooseColor("#666600");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#666600")'></a></td>
<td bgColor='#996600'><a href='javascript:chooseColor("#996600");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#996600")'></a></td>
<td bgColor='#CC6600'><a href='javascript:chooseColor("#CC6600");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC6600")'></a></td>
<td bgColor='#FF6600'><a href='javascript:chooseColor("#FF6600");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF6600")'></a></td>
</tr>
<tr height='12'>
<td bgColor='#009900'><a href='javascript:chooseColor("#009900");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#009900")'></a></td>
<td bgColor='#339900'><a href='javascript:chooseColor("#339900");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#339900")'></a></td>
<td bgColor='#669900'><a href='javascript:chooseColor("#669900");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#669900")'></a></td>
<td bgColor='#999900'><a href='javascript:chooseColor("#999900");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#999900")'></a></td>
<td bgColor='#CC9900'><a href='javascript:chooseColor("#CC9900");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC9900")'></a></td>
<td bgColor='#FF9900'><a href='javascript:chooseColor("#FF9900");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF9900")'></a></td>
<td bgColor='#00CC00'><a href='javascript:chooseColor("#00CC00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00CC00")'></a></td>
<td bgColor='#33CC00'><a href='javascript:chooseColor("#33CC00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33CC00")'></a></td>
<td bgColor='#66CC00'><a href='javascript:chooseColor("#66CC00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66CC00")'></a></td>
<td bgColor='#99CC00'><a href='javascript:chooseColor("#99CC00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99CC00")'></a></td>
<td bgColor='#CCCC00'><a href='javascript:chooseColor("#CCCC00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCCC00")'></a></td>
<td bgColor='#FFCC00'><a href='javascript:chooseColor("#FFCC00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFCC00")'></a></td>
<td bgColor='#00FF00'><a href='javascript:chooseColor("#00FF00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00FF00")'></a></td>
<td bgColor='#33FF00'><a href='javascript:chooseColor("#33FF00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33FF00")'></a></td>
<td bgColor='#66FF00'><a href='javascript:chooseColor("#66FF00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66FF00")'></a></td>
<td bgColor='#99FF00'><a href='javascript:chooseColor("#99FF00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99FF00")'></a></td>
<td bgColor='#CCFF00'><a href='javascript:chooseColor("#CCFF00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCFF00")'></a></td>
<td bgColor='#FFFF00'><a href='javascript:chooseColor("#FFFF00");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFFF00")'></a></td>
</tr>
<tr>
<td bgColor='#000033'><a href='javascript:chooseColor("#000033");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#000033")'></a></td>
<td bgColor='#330033'><a href='javascript:chooseColor("#330033");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#330033")'></a></td>
<td bgColor='#660033'><a href='javascript:chooseColor("#660033");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#660033")'></a></td>
<td bgColor='#990033'><a href='javascript:chooseColor("#990033");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#990033")'></a></td>
<td bgColor='#CC0033'><a href='javascript:chooseColor("#CC0033");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC0033")'></a></td>
<td bgColor='#FF0033'><a href='javascript:chooseColor("#FF0033");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF0033")'></a></td>
<td bgColor='#003333'><a href='javascript:chooseColor("#003333");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#003333")'></a></td>
<td bgColor='#333333'><a href='javascript:chooseColor("#333333");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#333333")'></a></td>
<td bgColor='#663333'><a href='javascript:chooseColor("#663333");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#663333")'></a></td>
<td bgColor='#993333'><a href='javascript:chooseColor("#993333");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#993333")'></a></td>
<td bgColor='#CC3333'><a href='javascript:chooseColor("#CC3333");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC3333")'></a></td>
<td bgColor='#FF3333'><a href='javascript:chooseColor("#FF3333");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF3333")'></a></td>
<td bgColor='#006633'><a href='javascript:chooseColor("#006633");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#006633")'></a></td>
<td bgColor='#336633'><a href='javascript:chooseColor("#336633");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#336633")'></a></td>
<td bgColor='#666633'><a href='javascript:chooseColor("#666633");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#666633")'></a></td>
<td bgColor='#996633'><a href='javascript:chooseColor("#996633");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#996633")'></a></td>
<td bgColor='#CC6633'><a href='javascript:chooseColor("#CC6633");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC6633")'></a></td>
<td bgColor='#FF6633'><a href='javascript:chooseColor("#FF6633");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF6633")'></a></td>
</tr>
<tr height='12'>
<td bgColor='#009933'><a href='javascript:chooseColor("#009933");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#009933")'></a></td>
<td bgColor='#339933'><a href='javascript:chooseColor("#339933");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#339933")'></a></td>
<td bgColor='#669933'><a href='javascript:chooseColor("#669933");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#669933")'></a></td>
<td bgColor='#999933'><a href='javascript:chooseColor("#999933");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#999933")'></a></td>
<td bgColor='#CC9933'><a href='javascript:chooseColor("#CC9933");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC9933")'></a></td>
<td bgColor='#FF9933'><a href='javascript:chooseColor("#FF9933");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF9933")'></a></td>
<td bgColor='#00CC33'><a href='javascript:chooseColor("#00CC33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00CC33")'></a></td>
<td bgColor='#33CC33'><a href='javascript:chooseColor("#33CC33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33CC33")'></a></td>
<td bgColor='#66CC33'><a href='javascript:chooseColor("#66CC33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66CC33")'></a></td>
<td bgColor='#99CC33'><a href='javascript:chooseColor("#99CC33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99CC33")'></a></td>
<td bgColor='#CCCC33'><a href='javascript:chooseColor("#CCCC33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCCC33")'></a></td>
<td bgColor='#FFCC33'><a href='javascript:chooseColor("#FFCC33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFCC33")'></a></td>
<td bgColor='#00FF33'><a href='javascript:chooseColor("#00FF33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00FF33")'></a></td>
<td bgColor='#33FF33'><a href='javascript:chooseColor("#33FF33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33FF33")'></a></td>
<td bgColor='#66FF33'><a href='javascript:chooseColor("#66FF33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66FF33")'></a></td>
<td bgColor='#99FF33'><a href='javascript:chooseColor("#99FF33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99FF33")'></a></td>
<td bgColor='#CCFF33'><a href='javascript:chooseColor("#CCFF33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCFF33")'></a></td>
<td bgColor='#FFFF33'><a href='javascript:chooseColor("#FFFF33");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFFF33")'></a></td>
</tr>
<tr>
<td bgColor='#000066'><a href='javascript:chooseColor("#000066");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#000066")'></a></td>
<td bgColor='#330066'><a href='javascript:chooseColor("#330066");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#330066")'></a></td>
<td bgColor='#660066'><a href='javascript:chooseColor("#660066");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#660066")'></a></td>
<td bgColor='#990066'><a href='javascript:chooseColor("#990066");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#990066")'></a></td>
<td bgColor='#CC0066'><a href='javascript:chooseColor("#CC0066");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC0066")'></a></td>
<td bgColor='#FF0066'><a href='javascript:chooseColor("#FF0066");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF0066")'></a></td>
<td bgColor='#003366'><a href='javascript:chooseColor("#003366");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#003366")'></a></td>
<td bgColor='#333366'><a href='javascript:chooseColor("#333366");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#333366")'></a></td>
<td bgColor='#663366'><a href='javascript:chooseColor("#663366");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#663366")'></a></td>
<td bgColor='#993366'><a href='javascript:chooseColor("#993366");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#993366")'></a></td>
<td bgColor='#CC3366'><a href='javascript:chooseColor("#CC3366");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC3366")'></a></td>
<td bgColor='#FF3366'><a href='javascript:chooseColor("#FF3366");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF3366")'></a></td>
<td bgColor='#006666'><a href='javascript:chooseColor("#006666");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#006666")'></a></td>
<td bgColor='#336666'><a href='javascript:chooseColor("#336666");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#336666")'></a></td>
<td bgColor='#666666'><a href='javascript:chooseColor("#666666");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#666666")'></a></td>
<td bgColor='#996666'><a href='javascript:chooseColor("#996666");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#996666")'></a></td>
<td bgColor='#CC6666'><a href='javascript:chooseColor("#CC6666");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC6666")'></a></td>
<td bgColor='#FF6666'><a href='javascript:chooseColor("#FF6666");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF6666")'></a></td>
</tr>
<tr height='12'>
<td bgColor='#009966'><a href='javascript:chooseColor("#009966");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#009966")'></a></td>
<td bgColor='#339966'><a href='javascript:chooseColor("#339966");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#339966")'></a></td>
<td bgColor='#669966'><a href='javascript:chooseColor("#669966");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#669966")'></a></td>
<td bgColor='#999966'><a href='javascript:chooseColor("#999966");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#999966")'></a></td>
<td bgColor='#CC9966'><a href='javascript:chooseColor("#CC9966");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC9966")'></a></td>
<td bgColor='#FF9966'><a href='javascript:chooseColor("#FF9966");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF9966")'></a></td>
<td bgColor='#00CC66'><a href='javascript:chooseColor("#00CC66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00CC66")'></a></td>
<td bgColor='#33CC66'><a href='javascript:chooseColor("#33CC66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33CC66")'></a></td>
<td bgColor='#66CC66'><a href='javascript:chooseColor("#66CC66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66CC66")'></a></td>
<td bgColor='#99CC66'><a href='javascript:chooseColor("#99CC66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99CC66")'></a></td>
<td bgColor='#CCCC66'><a href='javascript:chooseColor("#CCCC66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCCC66")'></a></td>
<td bgColor='#FFCC66'><a href='javascript:chooseColor("#FFCC66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFCC66")'></a></td>
<td bgColor='#00FF66'><a href='javascript:chooseColor("#00FF66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00FF66")'></a></td>
<td bgColor='#33FF66'><a href='javascript:chooseColor("#33FF66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33FF66")'></a></td>
<td bgColor='#66FF66'><a href='javascript:chooseColor("#66FF66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66FF66")'></a></td>
<td bgColor='#99FF66'><a href='javascript:chooseColor("#99FF66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99FF66")'></a></td>
<td bgColor='#CCFF66'><a href='javascript:chooseColor("#CCFF66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCFF66")'></a></td>
<td bgColor='#FFFF66'><a href='javascript:chooseColor("#FFFF66");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFFF66")'></a></td>
</tr>
<tr>
<td bgColor='#000099'><a href='javascript:chooseColor("#000099");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#000099")'></a></td>
<td bgColor='#330099'><a href='javascript:chooseColor("#330099");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#330099")'></a></td>
<td bgColor='#660099'><a href='javascript:chooseColor("#660099");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#660099")'></a></td>
<td bgColor='#990099'><a href='javascript:chooseColor("#990099");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#990099")'></a></td>
<td bgColor='#CC0099'><a href='javascript:chooseColor("#CC0099");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC0099")'></a></td>
<td bgColor='#FF0099'><a href='javascript:chooseColor("#FF0099");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF0099")'></a></td>
<td bgColor='#003399'><a href='javascript:chooseColor("#003399");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#003399")'></a></td>
<td bgColor='#333399'><a href='javascript:chooseColor("#333399");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#333399")'></a></td>
<td bgColor='#663399'><a href='javascript:chooseColor("#663399");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#663399")'></a></td>
<td bgColor='#993399'><a href='javascript:chooseColor("#993399");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#993399")'></a></td>
<td bgColor='#CC3399'><a href='javascript:chooseColor("#CC3399");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC3399")'></a></td>
<td bgColor='#FF3399'><a href='javascript:chooseColor("#FF3399");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF3399")'></a></td>
<td bgColor='#006699'><a href='javascript:chooseColor("#006699");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#006699")'></a></td>
<td bgColor='#336699'><a href='javascript:chooseColor("#336699");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#336699")'></a></td>
<td bgColor='#666699'><a href='javascript:chooseColor("#666699");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#666699")'></a></td>
<td bgColor='#996699'><a href='javascript:chooseColor("#996699");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#996699")'></a></td>
<td bgColor='#CC6699'><a href='javascript:chooseColor("#CC6699");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC6699")'></a></td>
<td bgColor='#FF6699'><a href='javascript:chooseColor("#FF6699");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF6699")'></a></td>
</tr>
<tr height='12'>
<td bgColor='#009999'><a href='javascript:chooseColor("#009999");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#009999")'></a></td>
<td bgColor='#339999'><a href='javascript:chooseColor("#339999");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#339999")'></a></td>
<td bgColor='#669999'><a href='javascript:chooseColor("#669999");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#669999")'></a></td>
<td bgColor='#999999'><a href='javascript:chooseColor("#999999");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#999999")'></a></td>
<td bgColor='#CC9999'><a href='javascript:chooseColor("#CC9999");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC9999")'></a></td>
<td bgColor='#FF9999'><a href='javascript:chooseColor("#FF9999");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF9999")'></a></td>
<td bgColor='#00CC99'><a href='javascript:chooseColor("#00CC99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00CC99")'></a></td>
<td bgColor='#33CC99'><a href='javascript:chooseColor("#33CC99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33CC99")'></a></td>
<td bgColor='#66CC99'><a href='javascript:chooseColor("#66CC99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66CC99")'></a></td>
<td bgColor='#99CC99'><a href='javascript:chooseColor("#99CC99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99CC99")'></a></td>
<td bgColor='#CCCC99'><a href='javascript:chooseColor("#CCCC99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCCC99")'></a></td>
<td bgColor='#FFCC99'><a href='javascript:chooseColor("#FFCC99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFCC99")'></a></td>
<td bgColor='#00FF99'><a href='javascript:chooseColor("#00FF99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00FF99")'></a></td>
<td bgColor='#33FF99'><a href='javascript:chooseColor("#33FF99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33FF99")'></a></td>
<td bgColor='#66FF99'><a href='javascript:chooseColor("#66FF99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66FF99")'></a></td>
<td bgColor='#99FF99'><a href='javascript:chooseColor("#99FF99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99FF99")'></a></td>
<td bgColor='#CCFF99'><a href='javascript:chooseColor("#CCFF99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCFF99")'></a></td>
<td bgColor='#FFFF99'><a href='javascript:chooseColor("#FFFF99");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFFF99")'></a></td>
</tr>
<tr>
<td bgColor='#0000CC'><a href='javascript:chooseColor("#0000CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0000CC")'></a></td>
<td bgColor='#3300CC'><a href='javascript:chooseColor("#3300CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3300CC")'></a></td>
<td bgColor='#6600CC'><a href='javascript:chooseColor("#6600CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6600CC")'></a></td>
<td bgColor='#9900CC'><a href='javascript:chooseColor("#9900CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9900CC")'></a></td>
<td bgColor='#CC00CC'><a href='javascript:chooseColor("#CC00CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC00CC")'></a></td>
<td bgColor='#FF00CC'><a href='javascript:chooseColor("#FF00CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF00CC")'></a></td>
<td bgColor='#0033CC'><a href='javascript:chooseColor("#0033CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0033CC")'></a></td>
<td bgColor='#3333CC'><a href='javascript:chooseColor("#3333CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3333CC")'></a></td>
<td bgColor='#6633CC'><a href='javascript:chooseColor("#6633CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6633CC")'></a></td>
<td bgColor='#9933CC'><a href='javascript:chooseColor("#9933CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9933CC")'></a></td>
<td bgColor='#CC33CC'><a href='javascript:chooseColor("#CC33CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC33CC")'></a></td>
<td bgColor='#FF33CC'><a href='javascript:chooseColor("#FF33CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF33CC")'></a></td>
<td bgColor='#0066CC'><a href='javascript:chooseColor("#0066CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0066CC")'></a></td>
<td bgColor='#3366CC'><a href='javascript:chooseColor("#3366CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3366CC")'></a></td>
<td bgColor='#6666CC'><a href='javascript:chooseColor("#6666CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6666CC")'></a></td>
<td bgColor='#9966CC'><a href='javascript:chooseColor("#9966CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9966CC")'></a></td>
<td bgColor='#CC66CC'><a href='javascript:chooseColor("#CC66CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC66CC")'></a></td>
<td bgColor='#FF66CC'><a href='javascript:chooseColor("#FF66CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF66CC")'></a></td>
</tr>
<tr height='12'>
<td bgColor='#0099CC'><a href='javascript:chooseColor("#0099CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0099CC")'></a></td>
<td bgColor='#3399CC'><a href='javascript:chooseColor("#3399CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3399CC")'></a></td>
<td bgColor='#6699CC'><a href='javascript:chooseColor("#6699CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6699CC")'></a></td>
<td bgColor='#9999CC'><a href='javascript:chooseColor("#9999CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9999CC")'></a></td>
<td bgColor='#CC99CC'><a href='javascript:chooseColor("#CC99CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC99CC")'></a></td>
<td bgColor='#FF99CC'><a href='javascript:chooseColor("#FF99CC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF99CC")'></a></td>
<td bgColor='#00CCCC'><a href='javascript:chooseColor("#00CCCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00CCCC")'></a></td>
<td bgColor='#33CCCC'><a href='javascript:chooseColor("#33CCCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33CCCC")'></a></td>
<td bgColor='#66CCCC'><a href='javascript:chooseColor("#66CCCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66CCCC")'></a></td>
<td bgColor='#99CCCC'><a href='javascript:chooseColor("#99CCCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99CCCC")'></a></td>
<td bgColor='#CCCCCC'><a href='javascript:chooseColor("#CCCCCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCCCCC")'></a></td>
<td bgColor='#FFCCCC'><a href='javascript:chooseColor("#FFCCCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFCCCC")'></a></td>
<td bgColor='#00FFCC'><a href='javascript:chooseColor("#00FFCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00FFCC")'></a></td>
<td bgColor='#33FFCC'><a href='javascript:chooseColor("#33FFCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33FFCC")'></a></td>
<td bgColor='#66FFCC'><a href='javascript:chooseColor("#66FFCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66FFCC")'></a></td>
<td bgColor='#99FFCC'><a href='javascript:chooseColor("#99FFCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99FFCC")'></a></td>
<td bgColor='#CCFFCC'><a href='javascript:chooseColor("#CCFFCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCFFCC")'></a></td>
<td bgColor='#FFFFCC'><a href='javascript:chooseColor("#FFFFCC");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFFFCC")'></a></td>
</tr>
<tr>
<td bgColor='#0000FF'><a href='javascript:chooseColor("#0000FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0000FF")'></a></td>
<td bgColor='#3300FF'><a href='javascript:chooseColor("#3300FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3300FF")'></a></td>
<td bgColor='#6600FF'><a href='javascript:chooseColor("#6600FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6600FF")'></a></td>
<td bgColor='#9900FF'><a href='javascript:chooseColor("#9900FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9900FF")'></a></td>
<td bgColor='#CC00FF'><a href='javascript:chooseColor("#CC00FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC00FF")'></a></td>
<td bgColor='#FF00FF'><a href='javascript:chooseColor("#FF00FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF00FF")'></a></td>
<td bgColor='#0033FF'><a href='javascript:chooseColor("#0033FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0033FF")'></a></td>
<td bgColor='#3333FF'><a href='javascript:chooseColor("#3333FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3333FF")'></a></td>
<td bgColor='#6633FF'><a href='javascript:chooseColor("#6633FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6633FF")'></a></td>
<td bgColor='#9933FF'><a href='javascript:chooseColor("#9933FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9933FF")'></a></td>
<td bgColor='#CC33FF'><a href='javascript:chooseColor("#CC33FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC33FF")'></a></td>
<td bgColor='#FF33FF'><a href='javascript:chooseColor("#FF33FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF33FF")'></a></td>
<td bgColor='#0066FF'><a href='javascript:chooseColor("#0066FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0066FF")'></a></td>
<td bgColor='#3366FF'><a href='javascript:chooseColor("#3366FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3366FF")'></a></td>
<td bgColor='#6666FF'><a href='javascript:chooseColor("#6666FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6666FF")'></a></td>
<td bgColor='#9966FF'><a href='javascript:chooseColor("#9966FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9966FF")'></a></td>
<td bgColor='#CC66FF'><a href='javascript:chooseColor("#CC66FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC66FF")'></a></td>
<td bgColor='#FF66FF'><a href='javascript:chooseColor("#FF66FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF66FF")'></a></td>
</tr>
<tr height='12'>
<td bgColor='#0099FF'><a href='javascript:chooseColor("#0099FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#0099FF")'></a></td>
<td bgColor='#3399FF'><a href='javascript:chooseColor("#3399FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#3399FF")'></a></td>
<td bgColor='#6699FF'><a href='javascript:chooseColor("#6699FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#6699FF")'></a></td>
<td bgColor='#9999FF'><a href='javascript:chooseColor("#9999FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#9999FF")'></a></td>
<td bgColor='#CC99FF'><a href='javascript:chooseColor("#CC99FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CC99FF")'></a></td>
<td bgColor='#FF99FF'><a href='javascript:chooseColor("#FF99FF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FF99FF")'></a></td>
<td bgColor='#00CCFF'><a href='javascript:chooseColor("#00CCFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00CCFF")'></a></td>
<td bgColor='#33CCFF'><a href='javascript:chooseColor("#33CCFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33CCFF")'></a></td>
<td bgColor='#66CCFF'><a href='javascript:chooseColor("#66CCFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66CCFF")'></a></td>
<td bgColor='#99CCFF'><a href='javascript:chooseColor("#99CCFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99CCFF")'></a></td>
<td bgColor='#CCCCFF'><a href='javascript:chooseColor("#CCCCFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCCCFF")'></a></td>
<td bgColor='#FFCCFF'><a href='javascript:chooseColor("#FFCCFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFCCFF")'></a></td>
<td bgColor='#00FFFF'><a href='javascript:chooseColor("#00FFFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#00FFFF")'></a></td>
<td bgColor='#33FFFF'><a href='javascript:chooseColor("#33FFFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#33FFFF")'></a></td>
<td bgColor='#66FFFF'><a href='javascript:chooseColor("#66FFFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#66FFFF")'></a></td>
<td bgColor='#99FFFF'><a href='javascript:chooseColor("#99FFFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#99FFFF")'></a></td>
<td bgColor='#CCFFFF'><a href='javascript:chooseColor("#CCFFFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#CCFFFF")'></a></td>
<td bgColor='#FFFFFF'><a href='javascript:chooseColor("#FFFFFF");'
		><img src='<?php echo($transpng) ?>'
		height=12 width=12 border=0
		onMouseOver='preview("#FFFFFF")'></a></td>
</tr>
</table>
<br>
<table cellpadding=0 cellspacing=0 border=1>
<tr>

</tr><tr>
<td bgColor='#DFDFDF'><a href='javascript:chooseColor("#DFDFDF");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#DFDFDF")'></a></td>
<td bgColor='#DEDEDE'><a href='javascript:chooseColor("#DEDEDE");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#DEDEDE")'></a></td>
<td bgColor='#DDDDDD'><a href='javascript:chooseColor("#DDDDDD");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#DDDDDD")'></a></td>
<td bgColor='#DCDCDC'><a href='javascript:chooseColor("#DCDCDC");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#DCDCDC")'></a></td>
<td bgColor='#DBDBDB'><a href='javascript:chooseColor("#DBDBDB");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#DBDBDB")'></a></td>
<td bgColor='#DADADA'><a href='javascript:chooseColor("#DADADA");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#DADADA")'></a></td>
<td bgColor='#D9D9D9'><a href='javascript:chooseColor("#D9D9D9");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D9D9D9")'></a></td>
<td bgColor='#D8D8D8'><a href='javascript:chooseColor("#D8D8D8");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D8D8D8")'></a></td>
<td bgColor='#D7D7D7'><a href='javascript:chooseColor("#D7D7D7");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D7D7D7")'></a></td>
<td bgColor='#D6D6D6'><a href='javascript:chooseColor("#D6D6D6");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D6D6D6")'></a></td>
<td bgColor='#D5D5D5'><a href='javascript:chooseColor("#D5D5D5");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D5D5D5")'></a></td>
<td bgColor='#D4D4D4'><a href='javascript:chooseColor("#D4D4D4");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D4D4D4")'></a></td>
<td bgColor='#D3D3D3'><a href='javascript:chooseColor("#D3D3D3");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D3D3D3")'></a></td>
<td bgColor='#D2D2D2'><a href='javascript:chooseColor("#D2D2D2");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D2D2D2")'></a></td>
<td bgColor='#D1D1D1'><a href='javascript:chooseColor("#D1D1D1");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#D1D1D1")'></a></td>
</tr>
<tr>
<td bgColor='#CFCFCF'><a href='javascript:chooseColor("#CFCFCF");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#CFCFCF")'></a></td>
<td bgColor='#CECECE'><a href='javascript:chooseColor("#CECECE");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#CECECE")'></a></td>
<td bgColor='#CDCDCD'><a href='javascript:chooseColor("#CDCDCD");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#CDCDCD")'></a></td>
<td bgColor='#CCCCCC'><a href='javascript:chooseColor("#CCCCCC");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#CCCCCC")'></a></td>
<td bgColor='#CBCBCB'><a href='javascript:chooseColor("#CBCBCB");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#CBCBCB")'></a></td>
<td bgColor='#CACACA'><a href='javascript:chooseColor("#CACACA");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#CACACA")'></a></td>
<td bgColor='#C9C9C9'><a href='javascript:chooseColor("#C9C9C9");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C9C9C9")'></a></td>
<td bgColor='#C8C8C8'><a href='javascript:chooseColor("#C8C8C8");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C8C8C8")'></a></td>
<td bgColor='#C7C7C7'><a href='javascript:chooseColor("#C7C7C7");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C7C7C7")'></a></td>
<td bgColor='#C6C6C6'><a href='javascript:chooseColor("#C6C6C6");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C6C6C6")'></a></td>
<td bgColor='#C5C5C5'><a href='javascript:chooseColor("#C5C5C5");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C5C5C5")'></a></td>
<td bgColor='#C4C4C4'><a href='javascript:chooseColor("#C4C4C4");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C4C4C4")'></a></td>
<td bgColor='#C3C3C3'><a href='javascript:chooseColor("#C3C3C3");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C3C3C3")'></a></td>
<td bgColor='#C2C2C2'><a href='javascript:chooseColor("#C2C2C2");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C2C2C2")'></a></td>
<td bgColor='#C1C1C1'><a href='javascript:chooseColor("#C1C1C1");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#C1C1C1")'></a></td>
</tr>
<tr>

</tr><tr>
<td bgColor='#BFBFBF'><a href='javascript:chooseColor("#BFBFBF");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#BFBFBF")'></a></td>
<td bgColor='#BEBEBE'><a href='javascript:chooseColor("#BEBEBE");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#BEBEBE")'></a></td>
<td bgColor='#BDBDBD'><a href='javascript:chooseColor("#BDBDBD");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#BDBDBD")'></a></td>
<td bgColor='#BCBCBC'><a href='javascript:chooseColor("#BCBCBC");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#BCBCBC")'></a></td>
<td bgColor='#BBBBBB'><a href='javascript:chooseColor("#BBBBBB");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#BBBBBB")'></a></td>
<td bgColor='#BABABA'><a href='javascript:chooseColor("#BABABA");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#BABABA")'></a></td>
<td bgColor='#B9B9B9'><a href='javascript:chooseColor("#B9B9B9");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B9B9B9")'></a></td>
<td bgColor='#B8B8B8'><a href='javascript:chooseColor("#B8B8B8");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B8B8B8")'></a></td>
<td bgColor='#B7B7B7'><a href='javascript:chooseColor("#B7B7B7");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B7B7B7")'></a></td>
<td bgColor='#B6B6B6'><a href='javascript:chooseColor("#B6B6B6");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B6B6B6")'></a></td>
<td bgColor='#B5B5B5'><a href='javascript:chooseColor("#B5B5B5");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B5B5B5")'></a></td>
<td bgColor='#B4B4B4'><a href='javascript:chooseColor("#B4B4B4");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B4B4B4")'></a></td>
<td bgColor='#B3B3B3'><a href='javascript:chooseColor("#B3B3B3");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B3B3B3")'></a></td>
<td bgColor='#B2B2B2'><a href='javascript:chooseColor("#B2B2B2");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B2B2B2")'></a></td>
<td bgColor='#B1B1B1'><a href='javascript:chooseColor("#B1B1B1");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#B1B1B1")'></a></td>
</tr>
<tr>
<td bgColor='#AFAFAF'><a href='javascript:chooseColor("#AFAFAF");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#AFAFAF")'></a></td>
<td bgColor='#AEAEAE'><a href='javascript:chooseColor("#AEAEAE");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#AEAEAE")'></a></td>
<td bgColor='#ADADAD'><a href='javascript:chooseColor("#ADADAD");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#ADADAD")'></a></td>
<td bgColor='#ACACAC'><a href='javascript:chooseColor("#ACACAC");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#ACACAC")'></a></td>
<td bgColor='#ABABAB'><a href='javascript:chooseColor("#ABABAB");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#ABABAB")'></a></td>
<td bgColor='#AAAAAA'><a href='javascript:chooseColor("#AAAAAA");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#AAAAAA")'></a></td>
<td bgColor='#A9A9A9'><a href='javascript:chooseColor("#A9A9A9");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A9A9A9")'></a></td>
<td bgColor='#A8A8A8'><a href='javascript:chooseColor("#A8A8A8");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A8A8A8")'></a></td>
<td bgColor='#A7A7A7'><a href='javascript:chooseColor("#A7A7A7");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A7A7A7")'></a></td>
<td bgColor='#A6A6A6'><a href='javascript:chooseColor("#A6A6A6");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A6A6A6")'></a></td>
<td bgColor='#A5A5A5'><a href='javascript:chooseColor("#A5A5A5");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A5A5A5")'></a></td>
<td bgColor='#A4A4A4'><a href='javascript:chooseColor("#A4A4A4");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A4A4A4")'></a></td>
<td bgColor='#A3A3A3'><a href='javascript:chooseColor("#A3A3A3");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A3A3A3")'></a></td>
<td bgColor='#A2A2A2'><a href='javascript:chooseColor("#A2A2A2");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A2A2A2")'></a></td>
<td bgColor='#A1A1A1'><a href='javascript:chooseColor("#A1A1A1");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#A1A1A1")'></a></td>
</tr>
<tr>

</tr><tr>
<td bgColor='#9F9F9F'><a href='javascript:chooseColor("#9F9F9F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#9F9F9F")'></a></td>
<td bgColor='#9E9E9E'><a href='javascript:chooseColor("#9E9E9E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#9E9E9E")'></a></td>
<td bgColor='#9D9D9D'><a href='javascript:chooseColor("#9D9D9D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#9D9D9D")'></a></td>
<td bgColor='#9C9C9C'><a href='javascript:chooseColor("#9C9C9C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#9C9C9C")'></a></td>
<td bgColor='#9B9B9B'><a href='javascript:chooseColor("#9B9B9B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#9B9B9B")'></a></td>
<td bgColor='#9A9A9A'><a href='javascript:chooseColor("#9A9A9A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#9A9A9A")'></a></td>
<td bgColor='#999999'><a href='javascript:chooseColor("#999999");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#999999")'></a></td>
<td bgColor='#989898'><a href='javascript:chooseColor("#989898");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#989898")'></a></td>
<td bgColor='#979797'><a href='javascript:chooseColor("#979797");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#979797")'></a></td>
<td bgColor='#969696'><a href='javascript:chooseColor("#969696");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#969696")'></a></td>
<td bgColor='#959595'><a href='javascript:chooseColor("#959595");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#959595")'></a></td>
<td bgColor='#949494'><a href='javascript:chooseColor("#949494");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#949494")'></a></td>
<td bgColor='#939393'><a href='javascript:chooseColor("#939393");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#939393")'></a></td>
<td bgColor='#929292'><a href='javascript:chooseColor("#929292");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#929292")'></a></td>
<td bgColor='#919191'><a href='javascript:chooseColor("#919191");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#919191")'></a></td>
</tr>
<tr>
<td bgColor='#8F8F8F'><a href='javascript:chooseColor("#8F8F8F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#8F8F8F")'></a></td>
<td bgColor='#8E8E8E'><a href='javascript:chooseColor("#8E8E8E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#8E8E8E")'></a></td>
<td bgColor='#8D8D8D'><a href='javascript:chooseColor("#8D8D8D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#8D8D8D")'></a></td>
<td bgColor='#8C8C8C'><a href='javascript:chooseColor("#8C8C8C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#8C8C8C")'></a></td>
<td bgColor='#8B8B8B'><a href='javascript:chooseColor("#8B8B8B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#8B8B8B")'></a></td>
<td bgColor='#8A8A8A'><a href='javascript:chooseColor("#8A8A8A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#8A8A8A")'></a></td>
<td bgColor='#898989'><a href='javascript:chooseColor("#898989");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#898989")'></a></td>
<td bgColor='#888888'><a href='javascript:chooseColor("#888888");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#888888")'></a></td>
<td bgColor='#878787'><a href='javascript:chooseColor("#878787");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#878787")'></a></td>
<td bgColor='#868686'><a href='javascript:chooseColor("#868686");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#868686")'></a></td>
<td bgColor='#858585'><a href='javascript:chooseColor("#858585");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#858585")'></a></td>
<td bgColor='#848484'><a href='javascript:chooseColor("#848484");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#848484")'></a></td>
<td bgColor='#838383'><a href='javascript:chooseColor("#838383");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#838383")'></a></td>
<td bgColor='#828282'><a href='javascript:chooseColor("#828282");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#828282")'></a></td>
<td bgColor='#818181'><a href='javascript:chooseColor("#818181");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#818181")'></a></td>
</tr>
<tr>

</tr><tr>
<td bgColor='#7F7F7F'><a href='javascript:chooseColor("#7F7F7F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#7F7F7F")'></a></td>
<td bgColor='#7E7E7E'><a href='javascript:chooseColor("#7E7E7E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#7E7E7E")'></a></td>
<td bgColor='#7D7D7D'><a href='javascript:chooseColor("#7D7D7D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#7D7D7D")'></a></td>
<td bgColor='#7C7C7C'><a href='javascript:chooseColor("#7C7C7C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#7C7C7C")'></a></td>
<td bgColor='#7B7B7B'><a href='javascript:chooseColor("#7B7B7B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#7B7B7B")'></a></td>
<td bgColor='#7A7A7A'><a href='javascript:chooseColor("#7A7A7A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#7A7A7A")'></a></td>
<td bgColor='#797979'><a href='javascript:chooseColor("#797979");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#797979")'></a></td>
<td bgColor='#787878'><a href='javascript:chooseColor("#787878");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#787878")'></a></td>
<td bgColor='#777777'><a href='javascript:chooseColor("#777777");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#777777")'></a></td>
<td bgColor='#767676'><a href='javascript:chooseColor("#767676");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#767676")'></a></td>
<td bgColor='#757575'><a href='javascript:chooseColor("#757575");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#757575")'></a></td>
<td bgColor='#747474'><a href='javascript:chooseColor("#747474");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#747474")'></a></td>
<td bgColor='#737373'><a href='javascript:chooseColor("#737373");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#737373")'></a></td>
<td bgColor='#727272'><a href='javascript:chooseColor("#727272");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#727272")'></a></td>
<td bgColor='#717171'><a href='javascript:chooseColor("#717171");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#717171")'></a></td>
</tr>
<tr>
<td bgColor='#6F6F6F'><a href='javascript:chooseColor("#6F6F6F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#6F6F6F")'></a></td>
<td bgColor='#6E6E6E'><a href='javascript:chooseColor("#6E6E6E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#6E6E6E")'></a></td>
<td bgColor='#6D6D6D'><a href='javascript:chooseColor("#6D6D6D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#6D6D6D")'></a></td>
<td bgColor='#6C6C6C'><a href='javascript:chooseColor("#6C6C6C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#6C6C6C")'></a></td>
<td bgColor='#6B6B6B'><a href='javascript:chooseColor("#6B6B6B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#6B6B6B")'></a></td>
<td bgColor='#6A6A6A'><a href='javascript:chooseColor("#6A6A6A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#6A6A6A")'></a></td>
<td bgColor='#696969'><a href='javascript:chooseColor("#696969");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#696969")'></a></td>
<td bgColor='#686868'><a href='javascript:chooseColor("#686868");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#686868")'></a></td>
<td bgColor='#676767'><a href='javascript:chooseColor("#676767");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#676767")'></a></td>
<td bgColor='#666666'><a href='javascript:chooseColor("#666666");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#666666")'></a></td>
<td bgColor='#656565'><a href='javascript:chooseColor("#656565");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#656565")'></a></td>
<td bgColor='#646464'><a href='javascript:chooseColor("#646464");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#646464")'></a></td>
<td bgColor='#636363'><a href='javascript:chooseColor("#636363");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#636363")'></a></td>
<td bgColor='#626262'><a href='javascript:chooseColor("#626262");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#626262")'></a></td>
<td bgColor='#616161'><a href='javascript:chooseColor("#616161");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#616161")'></a></td>
</tr>
<tr>

</tr><tr>
<td bgColor='#5F5F5F'><a href='javascript:chooseColor("#5F5F5F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#5F5F5F")'></a></td>
<td bgColor='#5E5E5E'><a href='javascript:chooseColor("#5E5E5E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#5E5E5E")'></a></td>
<td bgColor='#5D5D5D'><a href='javascript:chooseColor("#5D5D5D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#5D5D5D")'></a></td>
<td bgColor='#5C5C5C'><a href='javascript:chooseColor("#5C5C5C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#5C5C5C")'></a></td>
<td bgColor='#5B5B5B'><a href='javascript:chooseColor("#5B5B5B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#5B5B5B")'></a></td>
<td bgColor='#5A5A5A'><a href='javascript:chooseColor("#5A5A5A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#5A5A5A")'></a></td>
<td bgColor='#595959'><a href='javascript:chooseColor("#595959");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#595959")'></a></td>
<td bgColor='#585858'><a href='javascript:chooseColor("#585858");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#585858")'></a></td>
<td bgColor='#575757'><a href='javascript:chooseColor("#575757");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#575757")'></a></td>
<td bgColor='#565656'><a href='javascript:chooseColor("#565656");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#565656")'></a></td>
<td bgColor='#555555'><a href='javascript:chooseColor("#555555");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#555555")'></a></td>
<td bgColor='#545454'><a href='javascript:chooseColor("#545454");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#545454")'></a></td>
<td bgColor='#535353'><a href='javascript:chooseColor("#535353");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#535353")'></a></td>
<td bgColor='#525252'><a href='javascript:chooseColor("#525252");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#525252")'></a></td>
<td bgColor='#515151'><a href='javascript:chooseColor("#515151");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#515151")'></a></td>
</tr>
<tr>
<td bgColor='#4F4F4F'><a href='javascript:chooseColor("#4F4F4F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#4F4F4F")'></a></td>
<td bgColor='#4E4E4E'><a href='javascript:chooseColor("#4E4E4E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#4E4E4E")'></a></td>
<td bgColor='#4D4D4D'><a href='javascript:chooseColor("#4D4D4D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#4D4D4D")'></a></td>
<td bgColor='#4C4C4C'><a href='javascript:chooseColor("#4C4C4C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#4C4C4C")'></a></td>
<td bgColor='#4B4B4B'><a href='javascript:chooseColor("#4B4B4B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#4B4B4B")'></a></td>
<td bgColor='#4A4A4A'><a href='javascript:chooseColor("#4A4A4A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#4A4A4A")'></a></td>
<td bgColor='#494949'><a href='javascript:chooseColor("#494949");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#494949")'></a></td>
<td bgColor='#484848'><a href='javascript:chooseColor("#484848");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#484848")'></a></td>
<td bgColor='#474747'><a href='javascript:chooseColor("#474747");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#474747")'></a></td>
<td bgColor='#464646'><a href='javascript:chooseColor("#464646");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#464646")'></a></td>
<td bgColor='#454545'><a href='javascript:chooseColor("#454545");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#454545")'></a></td>
<td bgColor='#444444'><a href='javascript:chooseColor("#444444");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#444444")'></a></td>
<td bgColor='#434343'><a href='javascript:chooseColor("#434343");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#434343")'></a></td>
<td bgColor='#424242'><a href='javascript:chooseColor("#424242");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#424242")'></a></td>
<td bgColor='#414141'><a href='javascript:chooseColor("#414141");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#414141")'></a></td>
</tr>
<tr>

</tr><tr>
<td bgColor='#3F3F3F'><a href='javascript:chooseColor("#3F3F3F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#3F3F3F")'></a></td>
<td bgColor='#3E3E3E'><a href='javascript:chooseColor("#3E3E3E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#3E3E3E")'></a></td>
<td bgColor='#3D3D3D'><a href='javascript:chooseColor("#3D3D3D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#3D3D3D")'></a></td>
<td bgColor='#3C3C3C'><a href='javascript:chooseColor("#3C3C3C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#3C3C3C")'></a></td>
<td bgColor='#3B3B3B'><a href='javascript:chooseColor("#3B3B3B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#3B3B3B")'></a></td>
<td bgColor='#3A3A3A'><a href='javascript:chooseColor("#3A3A3A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#3A3A3A")'></a></td>
<td bgColor='#393939'><a href='javascript:chooseColor("#393939");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#393939")'></a></td>
<td bgColor='#383838'><a href='javascript:chooseColor("#383838");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#383838")'></a></td>
<td bgColor='#373737'><a href='javascript:chooseColor("#373737");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#373737")'></a></td>
<td bgColor='#363636'><a href='javascript:chooseColor("#363636");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#363636")'></a></td>
<td bgColor='#353535'><a href='javascript:chooseColor("#353535");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#353535")'></a></td>
<td bgColor='#343434'><a href='javascript:chooseColor("#343434");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#343434")'></a></td>
<td bgColor='#333333'><a href='javascript:chooseColor("#333333");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#333333")'></a></td>
<td bgColor='#323232'><a href='javascript:chooseColor("#323232");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#323232")'></a></td>
<td bgColor='#313131'><a href='javascript:chooseColor("#313131");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#313131")'></a></td>
</tr>
<tr>
<td bgColor='#2F2F2F'><a href='javascript:chooseColor("#2F2F2F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#2F2F2F")'></a></td>
<td bgColor='#2E2E2E'><a href='javascript:chooseColor("#2E2E2E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#2E2E2E")'></a></td>
<td bgColor='#2D2D2D'><a href='javascript:chooseColor("#2D2D2D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#2D2D2D")'></a></td>
<td bgColor='#2C2C2C'><a href='javascript:chooseColor("#2C2C2C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#2C2C2C")'></a></td>
<td bgColor='#2B2B2B'><a href='javascript:chooseColor("#2B2B2B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#2B2B2B")'></a></td>
<td bgColor='#2A2A2A'><a href='javascript:chooseColor("#2A2A2A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#2A2A2A")'></a></td>
<td bgColor='#292929'><a href='javascript:chooseColor("#292929");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#292929")'></a></td>
<td bgColor='#282828'><a href='javascript:chooseColor("#282828");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#282828")'></a></td>
<td bgColor='#272727'><a href='javascript:chooseColor("#272727");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#272727")'></a></td>
<td bgColor='#262626'><a href='javascript:chooseColor("#262626");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#262626")'></a></td>
<td bgColor='#252525'><a href='javascript:chooseColor("#252525");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#252525")'></a></td>
<td bgColor='#242424'><a href='javascript:chooseColor("#242424");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#242424")'></a></td>
<td bgColor='#232323'><a href='javascript:chooseColor("#232323");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#232323")'></a></td>
<td bgColor='#222222'><a href='javascript:chooseColor("#222222");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#222222")'></a></td>
<td bgColor='#212121'><a href='javascript:chooseColor("#212121");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#212121")'></a></td>
</tr>
<tr>

</tr><tr>
<td bgColor='#1F1F1F'><a href='javascript:chooseColor("#1F1F1F");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#1F1F1F")'></a></td>
<td bgColor='#1E1E1E'><a href='javascript:chooseColor("#1E1E1E");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#1E1E1E")'></a></td>
<td bgColor='#1D1D1D'><a href='javascript:chooseColor("#1D1D1D");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#1D1D1D")'></a></td>
<td bgColor='#1C1C1C'><a href='javascript:chooseColor("#1C1C1C");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#1C1C1C")'></a></td>
<td bgColor='#1B1B1B'><a href='javascript:chooseColor("#1B1B1B");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#1B1B1B")'></a></td>
<td bgColor='#1A1A1A'><a href='javascript:chooseColor("#1A1A1A");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#1A1A1A")'></a></td>
<td bgColor='#191919'><a href='javascript:chooseColor("#191919");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#191919")'></a></td>
<td bgColor='#181818'><a href='javascript:chooseColor("#181818");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#181818")'></a></td>
<td bgColor='#171717'><a href='javascript:chooseColor("#171717");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#171717")'></a></td>
<td bgColor='#161616'><a href='javascript:chooseColor("#161616");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#161616")'></a></td>
<td bgColor='#151515'><a href='javascript:chooseColor("#151515");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#151515")'></a></td>
<td bgColor='#141414'><a href='javascript:chooseColor("#141414");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#141414")'></a></td>
<td bgColor='#131313'><a href='javascript:chooseColor("#131313");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#131313")'></a></td>
<td bgColor='#121212'><a href='javascript:chooseColor("#121212");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#121212")'></a></td>
<td bgColor='#111111'><a href='javascript:chooseColor("#111111");'
		><img src='<?php echo($transpng) ?>'
                height=13 width=13 border=0
                onMouseOver='preview("#111111")'></a></td>
</tr>
</table>
   </td>
  </tr>
</table>
<br>
<div align='center'>
<select onChange='chooseColor(this.options[this.selectedIndex].value)'>
<option selected value=""> </option>
<?php

   $added = array();

   foreach(array_keys($_REQUEST) as $key)
   {

      if(!$_REQUEST[$key] || substr($key, 0, 13 ) != "recent_color_")
         continue;

      $color = $_REQUEST[$key];

      if($added[$color]) continue;

      echo("<option style='background: #". $color ."' value=\"#". $color ."\"> #".  $color ." </option>\n"); 

      $added[$color] = 1;
   }

   if($_REQUEST['rclist']) {
      foreach(explode(',',$_REQUEST['rclist']) as $c) {

         if($added[$c]) continue;

          echo("<option style='background: #". $c."' value=\"#". $c."\"> #".  $c." </option>\n");

          $added[$c] = 1;
      }
   }

?>
</select>
</div>
</body>
</html>
