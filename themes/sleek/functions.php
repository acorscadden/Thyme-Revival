<?php


############
#
# SLEEK THEME
#
############

function _ex_sleek_cal_title(&$_cur_cal,$links)
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

function _ex_sleek_content_title($l="",$m="",$r="")
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

function _ex_sleek_section_header($text)
{

   echo("<table cellpadding=0 border=1 cellspacing=0 align=center width='100%'>\n");
   echo("<tr>");
   echo("<td align=left height=24> &nbsp; &nbsp; &nbsp; ");

   echo($text);

   echo("</td>
   </tr>\n");
   echo("</table>\n");

}


####################
#
###
#
#####################

function _ex_sleek_tabs($tabs)
{

   echo("<table width='100%' border=0 cellpadding=0 class='cal_disabled'
        style='border-collapse: collapse;'>\n<tr valign='middle'>\n");


  echo("\t<td align='left' width=30 class='grad_left'> &nbsp; </td>\n");

  echo("<td align='center' height=30>
        <table border=0 style='border-collapse: collapse' cellpadding=0>
        <tr valign='middle'>\n");

   echo("<td class='grad_right' width=30> </td>");

   $selected = 0;

   for($i = 0; $i < count($tabs); $i++) {


      $disp = $tabs[$i]['name'];

         echo("<td width=10> &nbsp; </td>\n");

         echo("\t<td width='80' nowrap
           align=center class='". ($tabs[$i]['selected'] ? 'cal_selected'  : 'cal_disabled') ."'>
           <a href=\"". $tabs[$i]['url'] ."\">");
         echo($disp);
         echo("</a></td>\n");



   }

   echo("<td width=10> &nbsp; </td>");
   echo("<td class='grad_left' width=30> </td>");

   echo("</tr>\n</table></td>\n");

   echo("\t<td align=right width=30 class='grad_right'> &nbsp; </td>\n");

   echo("
        </tr>
        </table>\n");

}


######################
#
###
#
######################

function _ex_sleek_content_header()
{

   # no header row for main table..
   ###########################
   
   return;

}

function _ex_sleek_content_footer($links)
{

   echo("<div class='main_footer'>\n");

   echo("<table width='100%' border=0 cellpadding=0 cellspacing=0
style='border-collapse: collapse'>
<tr valign='middle'>");


echo("
<td class='cal_disabled'><img src='". _CAL_BASE_URL_ .
"themes/sleek/images/tab_bg_left.jpg' alt='header'></td><td class='cal_disabled' align='center'>");

if(count($links) > 0) {

   echo("( ");

   echo(join(" || ", $links));

   echo(" )");
}

   echo("
</td>
<td class='cal_disabled' align='right'><img src='". _CAL_BASE_URL_
	."themes/sleek/images/tab_bg_right.jpg' alt='header'></td>
");

echo("
</tr>
</table>
</div>
");


}


?>
