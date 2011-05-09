<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 eXtrovert Software                           |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@extrosoft.com.                                               |
// +----------------------------------------------------------------------+
//
// $Id: calendar_edit_tpl.php,v 1.96 2006/05/19 20:45:51 ian Exp $


################################
#
### GET CALENDAR INFO
#
#################################


/*


 CALENDAR OPTIONS BITWISE #

 1 = attachments

 2 = requests

 4 = remote updates

 8 = strict event security

 16 = set ? colors by owner, not ? colors by event type or category

 32 = allow multiple categories

 64 = remember locations

128 = Normal event request mode


 GLOBAL VIEW OPTIONS BITWISE

 1 = Allow everyone access to this View's calendars
     regardless of their members list

*/



   global $_cal_obj, $_cal_dbpref, $_cal_form;

   $_cal_form = new _cal_form("calendar_edit");

   require(@constant("_CAL_BASE_PATH_") ."modules/common_files/css_edit.php");

      ###############################
      #
      # CHECK FOR CUSTOM AUTH MODULE
      #
      #################################

      if(function_exists("_ex_auth_get_user")) {

         list($u) = _ex_auth_get_users_by_id(array($_cal_obj->owner));

         $_cal_obj->owner_name = $u['name'];
         $_cal_obj->owner_userid = $u['userid'];

      } else {

         list($o) = $_cal_sql->query("select name, userid from {$_cal_dbpref}Users
            where id = ". $_cal_obj->owner);

         $_cal_obj->owner_name = $o['name'];
         $_cal_obj->owner_userid = $o['userid'];
      }
      
      $_cal_obj->owner_name = $_cal_obj->owner_name ." (". $_cal_obj->owner_userid .")";

      if(!$members) {
         $members = _cal_obj::get_members($_cal_obj); 
      }

       $_cal_form->defaults = get_object_vars($_cal_obj);
       $_cal_form->print_header();
       $_cal_form->print_hidden('cid');
       $_cal_form->print_hidden('module');

       # do stuff...

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.template_tabbed.php");
require_once(_CAL_BASE_PATH_."include/classes/class.table.php");


global $_cal_tmpl;

$_cal_tmpl = new _cal_template('calendar_edit_template');
$_cal_tmpl->print_header();


$_cal_tmpl->new_section(_GENERAL_);
$_cal_tmpl->new_row();

$_cal_table = new _cal_table();

$_cal_table->vertical = true;

$_cal_table->align_opts[1] = 'left';
$_cal_table->print_header(array());
$_cal_table->print_row(array(_TITLE_,$_cal_form->textbox('title',32,'maxlength=64')), false);
$_cal_table->print_row(array(_DESCRIPTION_,$_cal_form->textbox('description',64,'maxlength=255')), false);


   $colors = array(_BY_OWNER_, (($_cal_obj->type == 1 || $_cal_obj->type == 2) ? _BY_CALENDAR_ : _BY_CATEGORY_));
   $_cal_form->defaults['color_by'] = ($_cal_obj->options & 16 ? 0 : 1);
   $_cal_table->print_row(array(_COLOR_BY_,$_cal_form->select('color_by',$colors)), false);

############################
#
### NORMAL CALENDARS
#
#############################

if($_cal_obj->type == 0) {

   $_cal_table->print_row(
        array(_OWNER_,
          $_cal_obj->owner_name . 
            ($_cal_user->admin ? " <input type=button class='"._CAL_CSS_BUTTON_."' onClick='chown()'
                      value='"._CHANGE_."'>" : "")
       ), false
   );

   $_cal_table->print_row(
        array(_OPTIONS_,

           $_cal_form->checkbox("cal_opts_multicat", ($_cal_obj->options & 32 ? " checked " : "")) .
              " ". _ALLOW_MULTI_CATS_."<br>".

           $_cal_form->checkbox("cal_opts_locations", ($_cal_obj->options & 64 ? " checked " : "")) .
              " ". _REMEMBER_LOCATIONS_."<br>".

           (@constant("_CAL_ATTACHMENTS_") ? 

              ########################
              # ATTACHMENTS
              #####################
              $_cal_form->checkbox("cal_opts_attch", ($_cal_obj->options & 1 ? " checked " : "")) .
                     " ". _ATTACHMENTS_ ."<br>"
          
           : "") .  
          
           $_cal_form->checkbox("cal_opts_sec", ($_cal_obj->options & 8 ? " checked " : "")) .
              " ". _STRICT_EVENT_SECURITY_."<br>" .
              "<font size=-2>"._STRICT_EVENT_SECURITY_DESC_."</font>"
       ), false
   );

}

#############################
#
### GLOBAL VIEWS
#
#############################
if($_cal_obj->type == 1 && $_cal_obj->owner == 0) {

   $_cal_table->print_row(
        array(_OPTIONS_,

           $_cal_form->checkbox("cal_opts_allow_all_view", ($_cal_obj->options & 1 ? " checked " : "")) .
              " ". _ALLOW_EVERYONE_VIEW_."<br>".

           $_cal_form->checkbox("cal_opts_hide_guests", ($_cal_obj->options & 2 ? " checked " : "")) .
              " ". _HIDE_VIEW_FROM_GUESTS_."<br>"


       ), false
   );


}

#############################
#
### ALL CALENDARS VIEW
#
#############################
if($_cal_obj->type == 2 && $_cal_obj->owner == 0) {

   $_cal_table->print_row(
        array(_OPTIONS_,

           $_cal_form->checkbox("cal_all_view_enabled", ($_cal_obj->options & 1 ? " checked " : "")) .
              " ". _ENABLED_."<br>".

           $_cal_form->checkbox("cal_opts_hide_guests", ($_cal_obj->options & 2 ? " checked " : "")) .
              " ". _HIDE_VIEW_FROM_GUESTS_."<br>"


       ), false
   );


}

$_cal_table->print_footer();
?>
<br><br>
<?php
$_cal_tmpl->toolbar("",$_cal_form->submit("cals_action", _SAVE_) .
    ($_cal_obj->type != 2 ? " ". $_cal_form->submit("cals_action", _CLOSE_) : ""), "");
$_cal_tmpl->end_row();

$_cal_tmpl->end_section();



if($_cal_obj->type == 0) {

   # MEMBERS
   #############
   require_once(_CAL_BASE_PATH_."modules/calendars/members_tpl.php");

}



if($_cal_obj->type == 0) {

   ################################
   #
   ### EVENT TYPES
   #
   ################################

   require_once(@constant("_CAL_BASE_PATH_") . "modules/calendars/event_types_tpl.php");

}



if($_cal_obj->type == 0) {

   ##########################
   #
   #### REMOTE ACCESS
   #
   ##########################

   require_once(_CAL_BASE_PATH_."modules/calendars/remote_access_tpl.php");

}




if($_cal_obj->type == 0) {

   ########################
   #
   ### EVENT REQUESTS
   #
   #######################

   require_once(_CAL_BASE_PATH_."modules/calendars/requests_tpl.php");

}



###########################
#
### VIEW
#
###########################

if($_cal_obj->type == 1) {

   require_once(_CAL_BASE_PATH_."modules/calendars/calendars_tpl.php");

} 


######################
#
# CALENDAR COLORS
#
#######################
if(($_cal_obj->type == 1 || $_cal_obj->type == 2) && !($_cal_obj->options & 16)) {

   ################################
   #
   ### COLORS
   #
   ################################

   require_once(@constant("_CAL_BASE_PATH_") . "modules/calendars/calendar_colors_tpl.php");


}

   $_cal_tmpl->print_footer();

          ?>


       <?php $_cal_form->print_footer(); ?>
       <?php


          # form to manipulate users
          $_cal_form = new _cal_form('uactionform');

          $_cal_form->print_header();
          $_cal_form->print_hidden('module');
          $_cal_form->print_hidden('cid');
          $_cal_form->print_hidden('rtype');
          $_cal_form->print_hidden('rid');
          $_cal_form->print_hidden('mc');
          $_cal_form->print_hidden('u_action',_ADD_);
          $_cal_form->print_hidden("access_lvl");
          $_cal_form->print_footer();


       ?>
       <?php require_once(@constant("_CAL_BASE_PATH_") . "include/js/newWin.js"); ?>
       <script language="JavaScript" type="text/javascript">
<!--

       function update_member(rid, rtype)
       {

          document.forms['uactionform'].elements['rtype'].value = rtype;
          document.forms['uactionform'].elements['rid'].value = rid;
          document.forms['uactionform'].elements['access_lvl'].value = document.forms['calendar_edit'].elements['access_lvl_' + rid + '_' + rtype].value;
          document.forms['uactionform'].elements['u_action'].value = '<?php echo(_UPDATE_) ?>';
          document.forms['uactionform'].submit();


       }

       function remove_member(rid, rtype)
       {
          document.forms['uactionform'].elements['rtype'].value = rtype;
          document.forms['uactionform'].elements['rid'].value = rid;
          document.forms['uactionform'].elements['u_action'].value = '<?php echo(_REMOVE_) ?>';
          document.forms['uactionform'].submit();


       }

       function upd_requests(v)
       {
          <?php if($_cal_obj->type == 0): ?>
          document.getElementById('requests').style.display = (v ? 'inline' : 'none');
          <?php else: ?>
          return 1;
          <?php endif ?>
       }

       <?php $_cal_html->js_onload[] = 'upd_requests('. ($_cal_obj->options & 2) .');'; ?>

       function add_calendar_submit(cid)
       {

          document.forms['uactionform'].elements['rtype'].value = 2;
          document.forms['uactionform'].elements['rid'].value = cid;
          document.forms['uactionform'].submit();


       }

       function add_calendar()
       {
          <?php
          $url = new _cal_url("modules/common_files/add_calendars.php");
          $url->amp = '&';
          $url->addArg("callback", "add_calendar_submit");
          $url->addArg("multi", 1);
          echo("var url = '". $url->toString() ."';\n");
          ?>
          newWin(url, 500, 400);

       }

       function edit_colors(rid, title)
       {

          document.forms['uactionform'].elements['rid'].value = rid;
          document.forms['uactionform'].elements['rtype'].value = title;
          document.forms['uactionform'].elements['u_action'].value = '<?php echo(_COLORS_) ?>';
          document.forms['uactionform'].submit();

       }

       function chown()
       {

          <?php
          $url = new _cal_url("modules/common_files/add_members.php");
          $url->amp = '&';
          $url->addArg("callback", "chown_submit");
          $url->addArg("uo", 1);
          echo("var url = '". $url->toString() ."';\n");
          ?>
          newWin(url, 500, 400);

       }

       function chown_submit(id, rtype)
       {

          document.forms['uactionform'].elements['rtype'].value = rtype;
          document.forms['uactionform'].elements['rid'].value = id;
          document.forms['uactionform'].elements['u_action'].value = 'chown';
          document.forms['uactionform'].submit();

       }


       function add_member()
       {

          <?php
          $url->amp = '&';
          $url->addArg('uo','');
          $url->addArg("callback", "add_member_submit");

          echo("var url = '". $url->toString() ."';\n");
          ?>
          newWin(url, 500, 400);

       }

       function add_member_submit(id, rtype)
       {

          document.forms['uactionform'].elements['rtype'].value = rtype;
          document.forms['uactionform'].elements['rid'].value = id;
          document.forms['uactionform'].submit();

       }


       function show_synd_src(url,feed, img)
       {

          win =  window.open('', "win", "width=500,height=300,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=yes");
          win.focus();

          win.document.open();
          win.document.writeln("<html>\n<head>\n<title><\/title>\n<\/head>\n<body>\n<form>\n");
          win.document.writeln('<textarea cols=50 rows=10>');

          win.document.writeln('<a href="' + url + escape(feed) + '"><img src="<?php echo(@constant("_CAL_BASE_URL_")) ?>' + img + '" border=0 alt="icon"\/><\/a>');

          win.document.writeln('<\/textarea>');
          win.document.writeln('<div align=center><input type=button value="<?php echo(_CLOSE_) ?>" onClick="self.close()"><\/div>');
          win.document.writeln("<\/form>\n<\/body>\n<\/html>\n");
          win.document.close();

       }
	// -->
       </script>
<?php require_once(@constant("_CAL_BASE_PATH_") . "include/js/check_name.php"); ?>
