<?php

   global $_cal_obj;

   $_cal_tmpl->new_section(_REMOTE_ACCESS_, true);
   $_cal_tmpl->new_row();

   if(preg_match("/Microsoft/",$_SERVER['SERVER_SOFTWARE']) && !@constant("_CAL_FORCE_DAV_URL_")) {
      $remote = @constant("_CAL_BASE_URL_") ."remote/ical.php?/";
   } else {
      $remote = @constant("_CAL_BASE_URL_") ."remote/ical.php/";
   }

   $remote .= $_cal_obj->id ."/".rawurlencode($_cal_obj->title).".ics";

   echo("<div style='width: 500px'>\n");
   echo($_cal_form->checkbox("cal_opts_pub", ($_cal_obj->options & 4 ? " checked " : "")));
   echo(" ". _ENABLE_REMOTE_ACCESS_UPD_ ."<br><br>" ._REMOTE_ACCESS_DESC_ ."<br><br>");
   echo("</div>\n");

   $wcal = preg_replace("/^.*?:\/\//","webcal://",$remote);

   echo("<b>".preg_replace("/\s*\(.?ics\).*/","",_ICAL_) ."</b>: <a class='"._CAL_CSS_ULINE_."'
        href='".  $remote ."'>". $remote ."</a><br><br>");
   echo("<b>Webcal</b>: <a class='"._CAL_CSS_ULINE_."' href='$wcal'>$wcal</a><br><br>");


      $vs = array(_DAY_ => '',_WEEK_ => _CAL_AMP_.'view=week', _MONTH_ => _CAL_AMP_.'view=month');

   $remote = _CAL_BASE_URL_."remote/rss.php?calendar={$_cal_obj->id}";

   echo("<b>"._SYNDICATION_."</b>:<ul>");

      foreach(array_keys($vs) as $vk)
      {
         echo("<li><b>".$vk."</b> <br>
                <a href=\"javascript:show_synd_src('$remote". $vs[$vk] ."', '','images/rss20.gif')\"><img
                    src='"._CAL_BASE_URL_."images/rss20.gif' alt='RSS 2.0' border=0></a>

                <a href=\"javascript:show_synd_src('http://add.my.yahoo.com/rss?url=','".
                    ($remote. $vs[$vk]) ."','images/myYahoo.gif')\"><img
                    src='"._CAL_BASE_URL_."images/myYahoo.gif' alt='Add to Yahoo!' border=0></a>

             <a href=\"javascript:show_synd_src('http://www.newsgator.com/ngs/subscriber/subext.aspx?url=','".
                    ($remote.$vs[$vk])."', 'images/newsGator.gif')\"><img
                    src='"._CAL_BASE_URL_."images/newsGator.gif' alt='Add to NewsGator' border=0></a>

                <a href=\"javascript:show_synd_src('http://my.msn.com/addtomymsn.armx?id=rss"._CAL_AMP_.
                    "ut=','".
                    ($remote. $vs[$vk])
                    ."','images/myMsn.gif')\"><img
                    src='"._CAL_BASE_URL_."images/myMsn.gif' alt='Add to MSN' border=0></a>

               <br><br>\n");

     }

   echo("</ul>\n");

   echo("<div style='width: 500px'>\n");
   echo( _REMOTE_ACCESS_DESC_USERS_ ."<br><br>");
   echo("</div>\n");

   $_cal_tmpl->toolbar("",$_cal_form->submit("cals_action", _SAVE_) ." ". $_cal_form->submit("cals_action", _CLOSE_), "");
   $_cal_tmpl->end_row();
   $_cal_tmpl->end_section();
?>
