<script language="javascript" type='text/javascript'>
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
// $Id: css_edit.php,v 1.18 2006/09/28 16:32:57 root Exp $
//

var hexchars = "0123456789ABCDEF";
var c_elms = new Array();

var picker_url = "<?php echo(@constant("_CAL_BASE_URL_")) ?>modules/common_files/color_picker.php?form=<?php echo($GLOBALS['_cal_form']->name) ?>";


function color_picker(elmName, preview, fg)
{

    var picker = picker_url + "&elm=" + elmName + "&lbl=" + preview + '&fg=' + fg;
    var added_already = new Array();
    var recent_count = 0;


    for(var i = 0; i < c_elms.length; i++)
    {
       color = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[c_elms[i]].value;

       if(color.charAt(0) == '#') {
          color = color.substr(1, color.length - 1);
       }

       if(!added_already[color]) {
          picker = picker + '&recent_color_' + recent_count + '=' + color;
          recent_count++;
          added_already[color] = 1;
       }

    }

    newWin(picker, 500, 300);

}

function updateBgColor(elm, preview)
{

   color = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value;

   if(color.charAt(0) == '#' && (color.length == 4 || color.length == 7)) {
      document.getElementById(preview).style.background = color;
   } else if(color.length == 0) {
      document.getElementById(preview).style.background = '';
   }

}

function updateFgColor(elm, preview)
{

   color = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value;

   if(color.charAt(0) == '#' && (color.length == 4 || color.length == 7)) {
      document.getElementById(preview).style.color = color;
   } else if(color.length == 0) {
      document.getElementById(preview).style.color = '';
   }

}


function updateBgColorGlobal(elmName)
{

   var color = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elmName].value;

   var elm;

   var i = 0;

   while(elm = document.getElementById('global_ids_' + i++))
   {

      if(elm) elm.style.background = color;
      else break;
   }

}

function updateFgColorGlobal(elmName)
{

   var color = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elmName].value;

   var elm;

   var i = 0;

   while(elm = document.getElementById('global_ids_' + i++))
   {

      if(elm) elm.style.color = color;
      else break;

   }

}




function darker(elm, preview, fg)
{

   var color = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value;
   color = color.toUpperCase();

   if(!(color.charAt(0) == '#' && (color.length == 4 || color.length == 7)))
      return;

   
   if(color.length == 4) {

      color = color.substr(1, 3);

      var c1 = color.substr(0,1);
      var c2 = color.substr(1,1);
      var c3 = color.substr(2,1);

      if(c1 != "0")
         var c1_rep = hexchars.substr(hexchars.indexOf(c1) - 1, 1);
      else
         var c1_rep = c1;

      if(c2 != "0")
         var c2_rep = hexchars.substr(hexchars.indexOf(c2) - 1, 1);
      else
         var c2_rep = c2;

      if(c3 != "0")
         var c3_rep = hexchars.substr(hexchars.indexOf(c3) - 1, 1);
      else
         var c3_rep = c3;

     
      color = '#' + c1_rep +""+ c2_rep +""+ c3_rep;

      document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value = color;

      if(preview == 'globals') {

         if(fg == 1)
            updateFgColorGlobal(elm);
         else
            updateBgColorGlobal(elm);

      } else if(fg == 1) {
         updateFgColor(elm, preview);
      } else {
         updateBgColor(elm, preview);
      }

      return;
   }


   if(color.length == 7) {

      color = color.substr(1, 6);

      var c1 = color.substr(0,2);
      var c2 = color.substr(2,2);
      var c3 = color.substr(4,2);

      c1 = hex_sub(c1);
      c2 = hex_sub(c2);
      c3 = hex_sub(c3);

      color = '#' + c1 + "" + c2 + "" + c3;

      document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value = color;

      if(preview == 'globals') {

         if(fg == 1)
            updateFgColorGlobal(elm);
         else
            updateBgColorGlobal(elm);

      } else if(fg == 1) {
         updateFgColor(elm, preview);
      } else {
         updateBgColor(elm, preview);
      }

   }



   
}


function lighter(elm, preview, fg)
{

   var color = document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value;

   color = color.toUpperCase();

   if(!(color.charAt(0) == '#' && (color.length == 4 || color.length == 7)))
      return;


   if(color.length == 4) {

      color = color.substr(1, 3);

      var c1 = color.substr(0,1);
      var c2 = color.substr(1,1);
      var c3 = color.substr(2,1);

      if(c1 != "F")
         var c1_rep = hexchars.substr(hexchars.indexOf(c1) + 1, 1);
      else
         var c1_rep = c1;

      if(c2 != "F")
         var c2_rep = hexchars.substr(hexchars.indexOf(c2) + 1, 1);
      else
         var c2_rep = c2;

      if(c3 != "F")
         var c3_rep = hexchars.substr(hexchars.indexOf(c3) + 1, 1);
      else
         var c3_rep = c3;


      color = '#' + c1_rep + c2_rep + c3_rep;

      document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value = color;

      if(preview == 'globals') {

         if(fg == 1)
            updateFgColorGlobal(elm);
         else
            updateBgColorGlobal(elm);

      } else if(fg == 1) {
         updateFgColor(elm, preview);
      } else {
         updateBgColor(elm, preview);
      }

   }

   if(color.length == 7) {

      color = color.substr(1, 6);

      var c1 = color.substr(0,2);
      var c2 = color.substr(2,2);
      var c3 = color.substr(4,2);

      c1 = hex_add(c1);
      c2 = hex_add(c2);
      c3 = hex_add(c3);

      color = '#' + c1 + "" + c2 + "" + c3;

      document.forms['<?php echo($GLOBALS['_cal_form']->name) ?>'].elements[elm].value = color;

      if(preview == 'globals') {

         if(fg == 1)
            updateFgColorGlobal(elm);
         else
            updateBgColorGlobal(elm);

      } else if(fg == 1) {
         updateFgColor(elm, preview);
      } else {
         updateBgColor(elm, preview);
      }

   }



}


function lighter_border(elm, preview)
{
   lighter(elm, preview + "_border1", 0);
    updateBorder(elm, preview);
}

function darker_border(elm, preview)
{
   darker(elm, preview + "_border1", 0);
   updateBorder(elm, preview);
}


function hex_sub(hex)
{

   hex = hex.toUpperCase();

   var h1 = hexchars.indexOf(hex.substr(0,1));
   var h2 = hexchars.indexOf(hex.substr(1,1));

   h2 -= 4;

   if(h2 < 0 && h1 > 0) {
      h2  = 15;
      h1--;
   } else if(h2 < 0 && h1 == 0) {
      h2 = 0;
      h1 = 0;
   }

   return hexchars.substr(h1,1) + hexchars.substr(h2,1);


}


function hex_add(hex)
{
  
   hex = hex.toUpperCase();

   var h1 = hexchars.indexOf(hex.substr(0,1));
   var h2 = hexchars.indexOf(hex.substr(1,1));

   h2 += 4;

   if(h2 > 15 && h1 < 15) {
      h2  = 0;
      h1++;
   } else if(h2 >= 15 && h1 >= 15) {
      h2 = 15;
      h1 = 15;
   }

   return hexchars.substr(h1,1) + hexchars.substr(h2,1);  
   

}

function checkDecor(elm, preview)
{

   var decor = document.forms['<?php echo($_cal_form->name) ?>'].elements[elm].value; 

   document.getElementById(preview).style.textDecoration = decor;



}

function checkItalics(elm, preview)
{

   var itals = document.forms['<?php echo($_cal_form->name) ?>'].elements[elm].checked;
   var prev = document.getElementById(preview);

   if(itals)
      prev.style.fontStyle = 'italic';
   else
      prev.style.fontStyle = 'normal';

}

function checkUline(elm, preview)
{

   var itals = document.forms['<?php echo($_cal_form->name) ?>'].elements[elm].checked;
   var prev = document.getElementById(preview);

   if(itals)
      prev.style.textDecoration = 'underline';
   else
      prev.style.textDecoration = 'none';

}

function checkBold(elm, preview)
{

   var bold = document.forms['<?php echo($_cal_form->name) ?>'].elements[elm].checked;
   var prev = document.getElementById(preview);

   if(bold)
      prev.style.fontWeight = 'bold';
   else
      prev.style.fontWeight = 'normal';

}


function updateBorder(elm, preview)
{

   updateBgColor(elm, preview + "_border1");
   updateBgColor(elm, preview + "_border2");

}

function update_globals_font_size(fsize)
{

   var i = 0;

   while(elm = document.getElementById('global_ids_' + i++))
   {

      if(elm && fsize) elm.style.fontSize = fsize + 'px';
      else if(fsize == '') elm.style.fontSize = '';
      else break;

   }

}


function update_globals_font_family(fname)
{

   var i = 0;

   // default font for most browsers
   if(!fname) fname = 'times new roman';

   while(elm = document.getElementById('global_ids_' + i++))
   {
      if(elm) elm.style.fontFamily = fname;
      else break;

   }

}

</script>
<?php

function font_uline_picker($elmName, $preview)
{

    $rstr = $GLOBALS['_cal_form']->checkbox($elmName,
        "onClick='checkUline(\"". $elmName ."\", \"". $preview ."\")'") .
        " ". _UNDERLINE_;

    $GLOBALS['_cal_html']->js_onload[] = 'checkUline("'. $elmName .'", "'. $preview .'");';

    return $rstr;

}

function font_decoration_picker($elmName, $preview)
{

    $rstr = $GLOBALS['_cal_form']->select($elmName,
        array('none' => 'None', 'underline' => _UNDERLINE_, 'overline' => "Overline",
        'line-through' => 'Line-Through'),
        "onChange='checkDecor(\"". $elmName ."\", \"". $preview ."\")'");

    $GLOBALS['_cal_html']->js_onload[] = 'checkDecor("'. $elmName .'", "'. $preview .'");';

    return $rstr;

}

function font_italics_picker($elmName, $preview)
{

    $rstr = $GLOBALS['_cal_form']->checkbox($elmName,
	"onClick='checkItalics(\"". $elmName ."\", \"". $preview ."\")'") .
	" ". _ITALICS_;

    $GLOBALS['_cal_html']->js_onload[] = 'checkItalics("'. $elmName .'", "'. $preview .'");';

    return $rstr;

}

function font_weight_picker($elmName, $preview)
{

   $rstr = $GLOBALS['_cal_form']->checkbox($elmName,
        "onClick='checkBold(\"". $elmName ."\", \"". $preview ."\")'") .
        " ". _BOLD_;

   $GLOBALS['_cal_html']->js_onload[] = 'checkBold("'. $elmName .'", "'. $preview .'");';

   return $rstr;

}
function font_size_picker($elmName, $preview)
{

     if($preview == "globals") {

        $onChange = "update_globals_font_size(document.forms['".
	$GLOBALS['_cal_form']->name ."'].elements['".$elmName ."'].value)";

     } else {

        $onChange = "document.getElementById('". $preview ."').style.fontSize = ".
	"(document.forms['". $GLOBALS['_cal_form']->name ."'].elements['".
	$elmName ."'].value ? document.forms['". $GLOBALS['_cal_form']->name ."'].elements['".
    $elmName ."'].value + 'px' : '');";
     }

     $rstr = $GLOBALS['_cal_form']->select($elmName, 
        array('' => _DEFAULT_, 7 => 7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,
        31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50),
        "onChange=\"". $onChange ."\"");


     $GLOBALS['_cal_html']->js_onload[] =  $onChange;

     return $rstr;

}


function border_color_picker($elmName, $preview)
{

    $update = 'updateBorder("'. $elmName .'","'.$preview.'");';

    # text box
    $rstr = "<input type=text name='". $elmName ."' value='".
        $_REQUEST[$elmName] ."' onKeyUp='". $update ."'
        onKeyPress='". $update ."' onBlur='". $update ."'
        onChange='". $update ."' maxlength=31> ";

    # lighter / darker
    $rstr .= " <input type=button class='"._CAL_CSS_BUTTON_."' value='+' style='width: 15px; padding-left: 0px; padding-right: 0px;'
        onClick='lighter_border(\"". $elmName ."\", \"". $preview ."\");'>
        <input type=button class='"._CAL_CSS_BUTTON_."' value='-' style='width: 15px; padding-left: 0px; padding-right: 0px;'
        onClick='darker_border(\"". $elmName ."\", \"". $preview ."\");'> ";

    # color chooser & preview

    $rstr .= "<a href='javascript:color_picker(\"". $elmName ."\",\"".
	$preview . "_border1;". $preview . "_border2\", 0);'>";

    $rstr .= "<img src='"._CAL_BASE_URL_."modules/common_files/picker.gif' alt='color picker' width='15' height='12' border=0></a>";


    $GLOBALS['_cal_html']->js_onload[] = $update;
    $GLOBALS['_cal_html']->js_onload[] = "c_elms[c_elms.length] = '". $elmName ."';";

    
    return $rstr;




}

function color_picker($elmName, $preview, $fg = false)
{
 
    if($preview == "globals") {

       if($fg)
          $update = 'updateFgColorGlobal("'. $elmName .'");';
       else
          $update = 'updateBgColorGlobal("'. $elmName .'");';

    } elseif($fg) {
       $update = 'updateFgColor("'. $elmName .'", "'. $preview .'");';
    } else {
       $update = 'updateBgColor("'. $elmName .'", "'. $preview .'");';
    }

    # text box

    $rstr = "<input type=text name='". $elmName ."' value='".
        $_REQUEST[$elmName] ."' onKeyUp='". $update ."'
        onKeyPress='". $update ."' onBlur='". $update ."'
        onChange='". $update ."' maxlength=31> ";

    # lighter / darker
    $rstr .= " <input type=button class='"._CAL_CSS_BUTTON_."' value='+' style='width: 15px; padding-left: 0px; padding-right: 0px;'
        onClick='lighter(\"". $elmName ."\", \"". $preview ."\", ". intval($fg) .");'>
        <input type=button class='"._CAL_CSS_BUTTON_."' value='-' style='width: 15px; padding-left: 0px; padding-right: 0px;'
        onClick='darker(\"". $elmName ."\", \"". $preview ."\", ". intval($fg) .");'> ";

    # color chooser & preview
    if($preview == "globals")
    {
       $preview = "";

       for($i = 0; $i <= $GLOBALS['_cal_gids']; $i++) {
          $preview .= 'global_ids_' . $i .';';
       }
       $preview = rtrim($preview, ';');
    }

    $rstr .= "<a href='javascript:color_picker(\"". $elmName ."\",\"". $preview ."\", ".
	intval($fg) .");'>";

    $rstr .= "<img src='"._CAL_BASE_URL_."modules/common_files/picker.gif' alt='color picker' width='15' height='12' border=0></a>";

    $GLOBALS['_cal_html']->js_onload[] = $update;
    $GLOBALS['_cal_html']->js_onload[] = "c_elms[c_elms.length] = '". $elmName ."';";

    return $rstr;
}


?>
