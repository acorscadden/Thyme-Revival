<?php

   global $_cal_obj;

   # MEMBERS
   #############
   $_cal_tmpl->new_section(_MEMBERS_, true);

   if($_REQUEST['u_action'] && $_REQUEST['u_action'] != 'chown')
      $_cal_tmpl->default_tab = count($_cal_tmpl->tabs);

   $_cal_tmpl->new_row();


   if($_cal_obj->type == 3) {
      echo("<div align='center'>"._MASTER_CALENDARS_MEMBERS_MSG_."</div><br>");
   } else if($_cal_obj->type == 4) {

       list($pcal) = $_cal_sql->query("select id, title, type from {$_cal_dbpref}Calendars
		where id = ".	_cal_obj::get_master_cal_id($_cal_obj->id));

       echo("<div align='center'>".sprintf(_SUB_CALENDARS_MEMBERS_MSG_, "<u>{$pcal['title']}</u>").
		"</div><br>");
   }

   $_cal_table->vertical = false;

   $_cal_table->align_opts[0] = 'left';

   $_cal_table->print_header(
        array(_NAME_,_DESCRIPTION_,_ACCESS_LVL_,
           "<input type=button onClick='add_member()' value='"._ADD_."' class='"._CAL_CSS_BUTTON_."'>"
         ), true
    );

    include_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");

    $uimg = $_cal_html->get_img_url("images/user.gif");
    $gimg = $_cal_html->get_img_url("images/groups.gif");

    # LOAD MASTER CALENDAR MEMBERS?
    #################################
    if($_cal_obj->type == 4) {

       $pmems = _cal_obj::get_members($pcal);

       foreach($pmems as $pm) {
          $pacl[$pm['rtype']][$pm['rid']] = $pm['access_lvl'];
       }

       if(!@constant("_CAL_SUBCAL_NO_MEMBERS_")) {
          $members = _ex_cal_member_merge($members,$pmems);
       }
    }

    # to compare with mcount
    $i = 0;
    foreach($members as $mem)
    {

       if($i > $mcount) $pcal = 1;
       else $pcal = 0;

       $acls = array("0"=>_READ_ONLY_,"1"=>_NORMAL_,"2"=>_ADMIN_);

       if($printed[$mem['rtype']][$mem['rid']]) continue;

       $printed[$mem['rtype']][$mem['rid']] = 1;

       if($pacl && isset($pacl[$mem['rtype']][$mem['rid']])) {

          $mem['update_only'] = 1;

          if($pacl[$mem['rtype']][$mem['rid']] > 0) unset($acls[0]);
          if($pacl[$mem['rtype']][$mem['rid']] > 1) unset($acls[1]);

          unset($pacl[$mem['rtype']][$mem['rid']]);
       }

       if(!$mem['rid']) $mem['rid'] = 0;

       if($mem['rid'] == 0 && $mem['rtype'] == 1) {
          $mem['name'] = $mem['description'] = _REGISTERED_USERS_;
       }

       if($mem['name'] == $_cal_user->userid && $mem['rtype'] == 0)
          continue;

       if($mem['rid'] == 0 && $mem['rtype'] == 0) {
          ($mem['name'] = _PUBLIC_) && ($mem['description'] = _PUBLIC_);
       }

       $_cal_form->defaults['access_lvl_' . $mem['rid'] ."_" .$mem['rtype']] = $mem['access_lvl'];


       $_cal_table->print_row(
           array(
              "<img width=16 height=16 alt='member image' src='".
            (($mem['rtype'] || (!$mem['rtype'] && !$mem['rid'])) ? $gimg : $uimg) ."'> ".
              $mem['name'], $mem['description'],

              $_cal_form->select('access_lvl_'. $mem['rid'] ."_" .$mem['rtype'], $acls),

              ($mem['noexist'] ? 

              "<input type=button class='"._CAL_CSS_BUTTON_."' value='". _UPDATE_ ."' ".
                 " onClick='add_member_submit(". $mem['rid'] .", ". $mem['rtype'] .")'>"
              :

              "<input type=button class='"._CAL_CSS_BUTTON_."' value='". _UPDATE_ ."' ".
                 " onClick='update_member(". $mem['rid'] .", ". $mem['rtype'] .")'>") .

              ($mem['update_only'] ? "" : 
              " <input type=button class='"._CAL_CSS_BUTTON_."' value='". _REMOVE_ ."' ".
                 " onClick='remove_member(". $mem['rid'] .", ". $mem['rtype'] .")'>\n")

           ), true
       );

    }

    $_cal_table->print_footer();
    ?>
    <br><br>
    <?php

   $_cal_tmpl->toolbar("",$_cal_form->submit("cals_action", _CLOSE_), "");

   $_cal_tmpl->end_row();
   $_cal_tmpl->end_section();


function _ex_cal_member_merge(&$scal,&$pcal) {

   $mlist = array();

   # build list of memebrs in child calendar
   #########################################3
   for($i = 0; $i < count($scal); $i++) {
      $mlist[$scal[$i]['rtype']][$scal[$i]['rid']] = $scal[$i]['access_lvl'];
      $scal[$i]['exist'] = 1;
   }

   for($i = 0; $i < count($pcal); $i++) {
      if(isset($mlist[$pcal[$i]['rtype']][$pcal[$i]['rid']])) {
         $pcal[$i]['exist'] = 1;
         $mlist[$pcal[$i]['rtype']][$pcal[$i]['rid']] = max($mlist[$pcal[$i]['rtype']][$pcal[$i]['rid']], $pcal[$i]['access_lvl']);
      }
   }

   $members = array();
   foreach(array_merge($scal,$pcal) as $mem) {

      if(!$mem['exist']) $mem['noexist'] = 1;
      $mem['access_lvl'] = $mlist[$mem['rtype']][$mem['rid']];
      $members[] = $mem;

   }

   usort($members,array('_cal_obj','_member_sort'));

   return $members;
}


?>
