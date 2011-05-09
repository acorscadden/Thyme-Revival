<?php

######################
#
# EXTROVERT THEME
#
#######################

function _ex_extrovert_cal_title(&$_cur_cal,$links)
{

      echo("<div class='caltitle'>\n");
      echo("<h3 class=header>".$_cur_cal['title'] ."</h3>");
      echo($_cur_cal['description']);


      if(count($links)) {

         echo(" - ( ");
         echo(join(" | ", $links));
         echo(" )");

      }

      echo("<br><br></div>\n");
}

function _ex_extrovert_content_title($l="",$m="",$r="")
{


   echo("<table border=0 width='100%' class='heading' style='border-collapse: collapse; border-spacing: 0px'>
             <tr valign='middle'>
             <td align='left' style='text-align: left'><font class='heading'>");
   echo($l);
   echo("</font>\n</td>\n");

   echo("<td align='center' style='text-align: center'><font class='heading'>");
   echo($m);
   echo("</font>\n</td>\n");

   echo("<td align='right' style='text-align: right'><font class='heading'>");
   echo($r);
   echo("</font>\n</td>\n");


   echo("</tr>\n</table>\n");

}


###################
#
###
#
###################

function _ex_extrovert_section_header($text)
{

   echo("<table cellpadding=0 cellspacing=0 align=center width='100%'>\n");
   echo("<tr><td align=left nowrap
        width=10><img src='". _CAL_BASE_URL_ ."themes/default/images/header_bg_lt.gif'
        alt='header' align='middle'></td>");
   echo("<th align=left class='main_header' width='100%'>");

   echo($text);

   echo("</th></tr>\n");
   echo("</table>\n");

}


####################
#
###
#
#####################

function _ex_extrovert_tabs($tabs)
{

   echo("<table align='center' border=0 cellpadding=0 class='body'
	style='border-collapse: collapse'>\n<tr>\n");

      echo("\t<td width=204> </td>");

   for($i = 0; $i < count($tabs); $i++) {

      $disp = $tabs[$i]['name'];

      echo("\t<td width=14></td>\n");

      echo("\t<td nowrap align=center style='padding-left: 20px; padding-right: 20px;' ");

      # check if we're on this..
      if($tabs[$i]['selected']) {

         echo("class='main_header'><a class='main_header'
            href='". $tabs[$i]['url'] ."'><b>".
            $disp ."</b></a></td>\n");

      } else {

         echo("class='cal_disabled'><a href=\"". $tabs[$i]['url'] ."\">");
         echo($disp);
         echo("</a></td>\n");
      }

   }
   echo("\t<td width=14> </td>\n");

   echo("\t<td width=204> </td>\n");

   echo("
        </tr>
        </table>\n");



}


######################
#
###
#
######################

function _ex_extrovert_content_header()
{

   # header row for main table..
   ###########################

   echo("<table width='100%' border=0 cellpadding=0 cellspacing=0
style='border-collapse: collapse;'>
<tr valign='middle'>
<td style=' border: 1px solid black; background-image: url(". _CAL_BASE_URL_ .
"themes/extrovert/images/border.gif);
background-repeat: repeat-x; height: 20px'> </td>
</tr>
</table>
");

}

function _ex_extrovert_content_footer($links)
{

   echo("<table width='100%' border=0 cellpadding=0 cellspacing=0
style='border-collapse: collapse;' class='footer'>
<tr valign='middle'>
<td style='border: 1px solid black; background-image: url(". _CAL_BASE_URL_ .
	"themes/extrovert/images/border.gif); background-repeat: repeat-x; height: 20px; vertical-align: middle;'>  &nbsp; &nbsp; &nbsp; ");

if(count($links) > 0) {

   echo(" |&gt; <b>");

   echo(join("</b> || <b>", $links));
 
   echo("</b> &lt;| ");

}

   echo("
</td>
</tr>
</table>
");


}


?>
