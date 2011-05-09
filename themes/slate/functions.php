<?php

######################
#
# SLATE THEME
#
#######################

function _ex_slate_cal_title(&$_cur_cal,$links)
{

      echo("<div class='caltitle'>\n");
      echo("<h3 class=header>".$_cur_cal['title'] ."</h3>");
      echo($_cur_cal['description']);


      if(count($links)) {

         echo(" - ( ");

         echo(join(" | ", $links));

         echo(" )");

      }

      echo("</div>\n");
}

function _ex_slate_content_title($l="",$m="",$r="")
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

function _ex_slate_section_header($text)
{


   echo("<table cellpadding=0 cellspacing=0 align=center width='100%'>\n");
   echo("<tr><td align=left nowrap
        width=10><img src='". _CAL_BASE_URL_ ."themes/default/images/header_bg_lt.gif' width=35 height=24
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

function _ex_slate_tabs($tabs)
{



   echo("<table align='center' border=0 cellpadding=0 class='caltabtable'
	style='padding: 0px; margin: 0px'>\n<tr>\n<td width='50%'> &nbsp; </td>");



   for($i = 0; $i < count($tabs); $i++) {

      $disp = $tabs[$i]['name'];

      echo("\t<td style='width: 14px' nowrap > &nbsp; &nbsp; </td>\n");

      echo("\t<td align=center nowrap style='padding-left: 20px; padding-right: 20px;' ");

      # check if we're on this..
      if($tabs[$i]['selected']) {

         echo("class='main_header'><a class='main_header'
            href='". $tabs[$i]['url'] ."'>".
            $disp ."</a></td>\n");

      } else {

         echo("class='cal_disabled'><a href=\"". $tabs[$i]['url'] ."\">");
         echo($disp);
         echo("</a></td>\n");
      }

   }
   echo("\t<td width='50%'> &nbsp; </td>\n");


   echo("
        </tr>
        </table>\n");
}


######################
#
###
#
######################

function _ex_slate_content_header()
{
   return;

}

function _ex_slate_content_footer($links)
{

   echo("<hr width='100%' style='height: 0; background: #000; border: 0px; border-top: 1px solid #000;'>\n");

   if(!count($links)) return;

   echo("<table width='100%' border=0 cellpadding=0 cellspacing=0
style='border-collapse: collapse;' class='footer'>
<tr valign='middle'>
<td style='border-top: 1px double #c0c0c0; height: 20px; vertical-align: middle;'>  &nbsp; &nbsp; &nbsp; ");

   echo(join(" &nbsp; <b>:</b> &nbsp; ", $links));


   echo("
</td>
</tr>
</table>
");


}


?>
