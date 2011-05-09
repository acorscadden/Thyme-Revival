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
// $Id: cal_details.php,v 1.39 2008/08/27 13:20:12 ian Exp $
//

   define("_CAL_BENCHMARK_", 0);

   define("_CAL_USE_SESSION_", 1);


   require_once(dirname(__FILE__)."/include/config.php");

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.event.php");


   global $_cal_tmpl, $_cal_form, $_cal_html, $_cal_user, $_cur_cal, $_cal_dbpref;

   $_cal_html = new _cal_html();

   require_once(_CAL_BASE_PATH_."include/classes/class.cal_obj.php");
   $_cur_cal = new _cal_obj($_SESSION['calendar']);


   $_cal_html->print_header(_CALENDAR_ ." - ". $_cur_cal->title);

   if(!$_cal_user->access->can_view($_cur_cal)) {
      $_cal_html->permission_denied(true);
      return;
   }


   if(function_exists("_ex_auth_login")) {

     list($owner) = _ex_auth_get_users_by_id(array($_cur_cal->owner));

   } else {
      list($owner) = $_cal_sql->query("select name, email from {$GLOBALS['_cal_dbpref']}Users
        where id = ". abs($_cur_cal->owner));
   }
?>
           <table border=1 align=center cellpadding=4 class='<?php echo(_CAL_CSS_CAL_CONTENT_ ." ". _CAL_CSS_SPACED_TABLE_)?>'>
           <tr>
           <th colspan=2><?php echo($_cur_cal->title) ?></th>
           </tr>
           <tr>
           <th><?php echo(_DESCRIPTION_) ?></th>
                <td colspan=1><?php echo($_cur_cal->description) ?></td>
           </tr>


           <?php if($_cur_cal->type != 1 && $_cur_cal->type != 2): ?>
              <tr>
              <th><?php echo(_OWNER_) ?></th>
              <td><?php
                echo($owner['name'] ." - ".  $owner['email']);
               ?></td>
              </tr>

           <?php else: ?>
              <tr>
              <th><?php echo(_CALENDARS_) ?></th>
              <td><?php



                echo(join(", ", $_cur_cal->get_calendars()));

 
                
               ?></td>
              </tr>
           <?php endif ?>

           <?php if($_cur_cal->type == 0): ?>

              <?php if(($_cur_cal->options & 8 > 0) || ($_cur_cal->options & 1 > 0)): ?>

              <tr> <th><?php echo(_OPTIONS_) ?></th>
                 <td>
                 <br>
                 <?php if(@constant("_CAL_ATTACHMENTS_") && (($_cur_cal->options & 1) > 0)): ?>
                 <?php
                     echo(" ". _ATTACHMENTS_ ."<br>");
                 ?>
                 <br>
                 <?php endif ?>
                <?php
                    if($_cur_cal->options & 8) {
                    ########################
                    # STRICT EVENT SECURITY
                    ########################
                     echo(" ". _STRICT_EVENT_SECURITY_."<br>");
                     echo("<font size=-2>"._STRICT_EVENT_SECURITY_DESC_."</font>");
                    }
                ?>
               </td>
             </tr>

              <?php endif ?>

          <?php endif ?>
<?php

      echo("<tr><th>\n");

      if((preg_match("/Microsoft/",$_SERVER['SERVER_SOFTWARE']) || preg_match("/Zues/",$_SERVER['SERVER_SOFTWARE'])) && !@constant("_CAL_FORCE_DAV_URL_")) {
         $remote = @constant("_CAL_BASE_URL_") ."remote/ical.php?/";
      } else {
         $remote = @constant("_CAL_BASE_URL_") ."remote/ical.php/";
      }

      $remote .= $_cur_cal->id ."/".rawurlencode($_cur_cal->title).".ics";

      echo(" ". _REMOTE_ACCESS_ ."</th><td>" ._REMOTE_ACCESS_DESC_ ."<br><br>");

      $wcal = preg_replace("/^.*?:\/\//","webcal://",$remote);

      echo("<b>".preg_replace("/\s*\(.?ics\).*/","",_ICAL_)."</b>: <a class='"._CAL_CSS_ULINE_."' href='".  $remote ."'>". $remote ."</a><br><br>");
      echo("<b>Webcal</b>: <a class='"._CAL_CSS_ULINE_."' href='$wcal'>$wcal</a><br><br>");

     $remote = @constant("_CAL_BASE_URL_") ."remote/rss.php?calendar=". $_cur_cal->id;

      echo("<b>"._SYNDICATION_."</b>:<ul>");
  
      $vs = array(_DAY_ => '',_WEEK_ => '&view=week', _MONTH_ => '&view=month');


      foreach(array_keys($vs) as $vk)
      {
         echo("<li><b>".$vk."</b> <br>
                <a href='$remote". $vs[$vk] ."' target=_blank><img
                    src='images/rss20.gif' alt='RSS 2.0' border=0></a>

                <a href='http://add.my.yahoo.com/rss?url=".urlencode($remote.$vs[$vk])."' target=_blank><img
                    src='images/myYahoo.gif' alt='Add to Yahoo!' border=0></a>

                <a href='http://www.newsgator.com/ngs/subscriber/subext.aspx?url=".
                    urlencode($remote.$vs[$vk])."'
                    target=_blank><img
                    src='images/newsGator.gif' alt='Add to NewsGator' border=0></a>
                <a href='http://my.msn.com/addtomymsn.armx?id=rss&ut=".urlencode($remote. $vs[$vk]) ."'
                    target=_blank><img
                    src='images/myMsn.gif' alt='Add to MSN' border=0></a>

               <br><br>\n");

     }

     echo("</ul>\n");

      echo("</td></tr>\n");


  echo("<tr><td colspan=2 class='"._CAL_CSS_TOOLBAR_."' align='center'>
    <input type=button class='"._CAL_CSS_BUTTON_."' onClick='self.close()' value='". _CLOSE_ ."'> </td></tr>\n");


   echo("</table>\n");




   $_cal_html->print_footer();
?>
