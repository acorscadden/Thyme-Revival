<?php

   global $_cal_obj;

   $_cal_tmpl->new_section(_CALENDARS_);
   $_cal_tmpl->new_row();

   if($_REQUEST['u_action']) $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

   ?>

      <table border=0 align='center' style='border-collapse: collapse'
                    class='<?php echo(_CAL_CSS_CAL_CONTENT_." "._CAL_CSS_SPACED_TABLE_) ?>' cellpadding=0>
         <tr><th><?php echo(_TITLE_) ?></th>
         <th><?php echo(_DESCRIPTION_) ?></th>

         <?php if($_cal_obj->type == 1): ?>
            <td class='<?php echo(_CAL_CSS_TOOLBAR_) ?>' align='center'>
            <input type=button onClick="add_calendar()"
                         value="<?php echo(_ADD_) ?>" class='<?php echo(_CAL_CSS_BUTTON_) ?>'></td>
         <?php endif ?>
         </tr>
         <?php

            foreach($members as $mem) {

               echo("<tr>\n");
               echo("<td>". $mem['title']."</td><td>".$mem['description']."</td>");

               if($_cal_obj->type == 1) {
                  echo("<td class='"._CAL_CSS_TOOLBAR_."' align='center'><input
                    type=button class='"._CAL_CSS_BUTTON_."'
                    value='". _REMOVE_ ."' onClick='remove_member(". $mem['id'] .", 2)'> ");

                  echo("</td>");
               }

               echo("</tr>\n");


            }


         ?>
        </table>

        <br><br>

        <?php

      $_cal_tmpl->toolbar("",$_cal_form->submit("cals_action", _CLOSE_));
      $_cal_tmpl->end_row();
      $_cal_tmpl->end_section();
?>
