<?php

   global $_cal_obj;

   ########################
   #
   ### EVENT REQUESTS
   #
   #######################

      $_cal_tmpl->new_section(_REQUESTS_, true);
      $_cal_tmpl->new_row();

      echo($_cal_form->checkbox("cal_opts_request", ($_cal_obj->options & 2 ? " checked " : "") .
                        " onClick='upd_requests(this.checked)'"));
      echo(" ". _ENABLE_ ."<br><br>");
      ?>

       <div id='requests'>
          <hr align='center' width='100%'>

             <?php

                $_cal_form->defaults['e_req_mode'] = intval((bool)($_cal_obj->options & 128));

                echo(_MODE_. " ". $_cal_form->select('e_req_mode', array(_READ_ONLY_,_NORMAL_),
			'onChange="upd_req_mode_desc()"'));
                echo(" <span id='req_mode_desc'></span><br><br>");

                echo(_REQUEST_MSG_PRE_ ."<br>");
                echo($_cal_form->textarea("request_pre", 5,70));
             ?>
             <br><br>
             <?php
                echo(_REQUEST_MSG_POST_."<br>");
                echo($_cal_form->textarea("request_post", 5,70));

                echo("<br><br>");

                # only if we're the owner of this calendar
                ##########################################
                if(@constant("_CAL_MAIL_FROM_")) {

                   $contacts = $_cal_sql->query("select id, email from {$_cal_dbpref}ContactOpts
                        where uid = ". $_cal_obj->owner, true);

                   $omail = new _cal_user("","",$_cal_obj->owner);
                   $contacts[0] = $omail->email;

                   if($_cal_obj->owner != $_cal_user->id && count($contacts)) {

                      echo($_cal_form->checkbox("request_notify") ." ". _REQUEST_NOTIFY_OWNER_ ." ");
                      echo($_cal_form->hidden('request_contact', $_cal_obj->request_contact));

                   } else if(count($contacts)) {

                      echo($_cal_form->checkbox("request_notify") ." ". _REQUEST_NOTIFY_EMAIL_ ." ");
                      echo($_cal_form->select("request_contact", $contacts));

                   }
                }
             ?>
            <br><br>
        </div>
      <?php

      $_cal_tmpl->toolbar("",$_cal_form->submit("cals_action", _SAVE_) ." ".
            $_cal_form->submit("cals_action", _CLOSE_), "");

?>
<script language='javascript' type='text/javascript'>

function upd_req_mode_desc()
{

   var vo = '<?php echo(str_replace("'","\\'",_REQUEST_MODE_VIEW_ONLY_)) ?>';
   var no = '<?php echo(str_replace("'","\\'",_REQUEST_MODE_NORMAL_)) ?>';

   document.getElementById('req_mode_desc').innerHTML = (document.forms['<?php echo($_cal_form->name) ?>'].elements['e_req_mode'].selectedIndex ? no : vo);
}

</script>
<?php

      $_cal_html->js_onload[] = 'upd_req_mode_desc();';

      $_cal_tmpl->end_row();
      $_cal_tmpl->end_section();
?>
