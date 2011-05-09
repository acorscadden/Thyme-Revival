<?php

##################
#
# DEFUALT THEME
#
#################

function _ex_default_cal_title(&$_cur_cal,$links)
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

function _ex_default_content_title($l="",$m="",$r="")
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

function _ex_default_section_header($text)
{

   echo("<table cellpadding=0 cellspacing=0 align=center width='100%'>\n");
   echo("<tr><td align=left nowrap class='main_header'
        width=10> </td>");
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

function _ex_default_tabs($tabs)
{

   echo("<table align='center' border=0 cellpadding=0 class='body'
        style='border-collapse: collapse;'>\n<tr>\n");

   echo("\t<td width='204'> &nbsp; </td>\n");

   for($i = 0; $i < count($tabs); $i++) {

      $disp = $tabs[$i]['name'];

      echo("\t<td width=14></td>\n");

      echo("\t<td align=center nowrap
        style='text-align: center; padding-left: 20px; padding-right: 20px; ' ");

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

function _ex_default_content_header()
{

   # header row for main table..
   ###########################

   echo("<table width='100%' border=0 cellpadding=0 cellspacing=0
style='border-collapse: collapse;'>
<tr>
<td class='body'> </td>
<td class='main_header' width='100%'></td>
<td align='center' class='body'>
</td>
</tr>
</table>
");

}


function _ex_default_content_footer($links)
{

   echo("<table width='100%' border=0 cellpadding=0 cellspacing=0
style='border-collapse: collapse'>
<tr valign='middle'>
<td class='body'></td>
<td class='main_header' width='100%'
align='center'>");

if(count($links) > 0) {

   echo("[ ");

   echo(join(" : ", $links));
   
   echo(" ]");
}

   echo("
</td>
<td class='body'></td>
</tr>
</table>
");


}

?>
