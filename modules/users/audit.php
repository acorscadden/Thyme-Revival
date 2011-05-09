<?php

$eusers = $_cal_sql->query("select id, userid from {$GLOBALS['_cal_dbpref']}Users where id > 1 order by id");

############################
#
### DO THESE IN 100 @ A TIME
#
############################
$cusers = $ids = array();

for($i = 0; $i < count($eusers); $i += 100)
{

   $a = $i;

   while($a % 100 || $a == $i) {

      if(!is_array($eusers[$a])) break;

      $ids[] = $eusers[$a]['id'];
      $a++; 

   } 


   # GET LIST OF USERS FOR IDS..
   ##############################
   $cusers += _ex_auth_get_users_by_id($ids, true);

   # CHECK FOR USERS
   ###################
   foreach($ids as $id) {


      # USER NOT FOUND!!!!!!!!!
      ########################### 
      if(!isset($cusers[$id])) {

        $form->defaults['name'] = _NOT_FOUND_;
        $form->defaults['email'] = _NOT_FOUND_;


        echo("<tr>\n");

        echo("<td align='center'><font class='"._CAL_CSS_HIL_."'>". $id ."</font></td>");

        echo("<td align='center'>". $id  ."</td>");

        echo("<td align='center'>". $id  ."</td>");


        echo("<td align='center'> --- </td>\n");


        echo("<td align='center' class='"._CAL_CSS_TOOLBAR_."'>");

           $form->print_header("form_".$id);
           echo($form->fromRequest("module"));
           $form->print_hidden("user", $id);
           $form->print_hidden("uid", $id);

           echo($form->submit('user_action', _DELETE_));

           $form->print_footer();

        echo("
              </td>");
        echo("</tr>");

      }

   }

}

unset($ids);
unset($cusers);
unset($eusers);

?>
