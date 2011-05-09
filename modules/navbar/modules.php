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
// $Id: modules.php,v 1.19 2006/03/10 17:36:52 ian Exp $
//

   global $_cal_sql, $_cal_html, $_cal_user, $_cal_modules, $_cal_dbpref, $_cal_tmpl;


   ################################
   #
   ### CHECK FOR DEFAULT USER OPTS
   #
   ################################
   if($duser) {
      $me = $_cal_user;
      $_cal_user = &$duser;

   }

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");

   define("_CAL_DOING_OPTS_", 1);
   require(@constant("_CAL_BASE_PATH_") . "include/languages/". constant("_CAL_LANG_") .".php");



   if($_REQUEST['navbar_module_action'] == _CONFIGURE_)
   {

      include(@constant("_CAL_BASE_PATH_"). "modules/". $_cal_modules[$_REQUEST['sub_module']]['configure']);
      return;

   }


   #############################
   #
   ### GET LIST OF MODULES
   #
   #############################
   
   # USER ENABLED MODULES
   $umods = $_cal_sql->query("select module,mod_order,leftright from {$_cal_dbpref}NavModules where uid = " .
	   $_cal_user->id ." order by leftright, mod_order");


   # ALL MODULES
   $mods = $_cal_modules['navbar']['sub_modules'];




#############################
#
### CHECK ACTION
#
#############################
$submod_sql = $_cal_sql->escape_string($_REQUEST['sub_module']);
$submod = $_REQUEST['sub_module'];
switch($_REQUEST['navbar_module_action'])
{

   # ENABLE A MODULE
   #####################
   case _ENABLE_:
      $_cal_sql->query("insert into {$_cal_dbpref}NavModules (uid,module,mod_order,leftright)
        values('". $_cal_user->id ."', '". $submod_sql ."', 0, 1)");


      $umods[] = array('module' => $submod, 'mod_order' => -1, 'leftright' => 0);

      $modmove = 1;

      break;


   # DISABLE A MODULE
   #####################
   case _DISABLE_:
     $_cal_sql->query("delete from {$_cal_dbpref}NavModules where uid = ". $_cal_user->id ." and module
        = '". $submod_sql ."'");

     $disable = $submod;
     break;


   default:
      # MOVE A MODULE
      ################
      $modmove = $_REQUEST['move'];



}
   

##########################################
#
### COMPILE THE COMPLETE LIST OF MODULES
#
##########################################
$modlist = array();
$duplicates = array();
foreach($umods as $u)
{

   if($disable == $u['module']) continue;
   if($umods[$u['module']]){
      $duplicates[] = $u['module'];
      continue;
   }

   $p = (($u['mod_order'] + 1) * 2);

   # CHECK FOR MOVING
   ######################
   if($submod == $u['module']) {
 
      switch($modmove)
      {
         case "up":
            $p -= 3;
            break;
         case "dn":
            $p += 3;
            break;
         case "left":
            $u['leftright'] = 0;
            break;
         case "right":
            $u['leftright'] = 1;
            break;

      } 


   } 

   $modlist[] = array('module' => $u['module'], 'leftright' => intval($u['leftright']),
                                                    'priority' => $p);

   $umods[$u['module']] = 1;

}

#####################################
#
### UPDATE MOD ORDER IF NEEDED
#
#####################################
if($modmove) {

   usort($modlist, "umodsort");

   # UPDATE TABLE..
   ##################
   for($i = 0, $a = 0; $i < count($modlist); $i++) {

      if($modlist[$i]['leftright'] == 1) $order = $a++;
      else $order = $i;

      $_cal_sql->query("update {$_cal_dbpref}NavModules set mod_order = $order, leftright = ".
            $modlist[$i]['leftright'] ." where uid = ". $_cal_user->id ." and module = '".
            $_cal_sql->escape_string($modlist[$i]['module']) ."'");
   }


}

###################################
#
### DELETE DUPLICATE ENTRIES
#
###################################
foreach($duplicates as $dup)
{

   $_cal_sql->query("delete from {$_cal_dbpref}NavModules where uid = ". $_cal_user->id ."
    and module = '". $_cal_sql->escape_string($dup) ."'");

}
foreach($_cal_modules['navbar']['sub_modules'] as $s) {

   if($umods[$s]) continue;

   $modlist[] = array('module' => $s, 'leftright' => 0, 'priority' => 0);

}


   # do any of these have a configure option?
   $config = true;



   echo("<br>\n<br>\n");


?>
<table border=2 cellpadding=4 align=center class='<?php echo(_CAL_CSS_SPACED_TABLE_." "._CAL_CSS_CAL_CONTENT_)?>'>
<tr class='<?php echo(_CAL_CSS_ROW_HEADER_) ?>'>
   <td align='center'><b><?php echo(_MODULE_) ?></b></td>
   <td align='center'><b><?php echo(_POSITION_) ?></b></td>
   <td align='center' colspan='2'><b><?php echo(_MOVE_) ?></b></td>
   <td align='center'><b><?php echo(_ENABLED_) ?></b></td>
<?php if($config): ?>
   <td align='center'><b><?php echo(_CONFIGURE_) ?></b></td>
<?php endif ?>
   <td align='center'><b><?php echo(_DESCRIPTION_) ?></b></td>
</tr>
<?php

   $up_img = $_cal_html->get_img_url("images/up.gif");
   $dn_img = $_cal_html->get_img_url("images/down.gif");

   $url = new _cal_url();
   $url->fromRequest("module");
   $url->addArg("submod", "navbar");

   $lastpos = $modlist[0]['leftright'];

   for($i = 0; $i < count($modlist); $i++)
   {

      $mod = $modlist[$i];

      $url->addArg("sub_module", $mod['module']);

      echo("<tr>\n");

      echo("<td>". $_cal_modules[$mod['module']]['display_name'] ."</td>\n");


      if($umods[$mod['module']]) {


         # POSITION
         ###################
         $url->addArg("navbar_module_action", "move");
         $url->addArg("move", ($mod['leftright'] ? "left" : "right"));

         echo("<td align='center'> ");

         echo(($mod['leftright'] ? _RIGHT_ : _LEFT_ ).
            " <a class='"._CAL_CSS_ULINE_."' style='font-weight: bolc' href='". $url->toString() ."'><b>".
                ($mod['leftright'] ? "<<" : ">>") ."</b></a>");

         echo(" </td>\n");


         # MOVE UP
         ############
         $url->addArg("move", "up");

         echo("<td align='center'> ");

         if($i != 0 && $mod['leftright'] == $lastpos) {
           echo("<a href='". $url->toString() ."'><img src='". $up_img ."' border=0 alt='move'></a>");
         }

         echo(" </td>\n");


         # MOVE DOWN
         #############
         $url->addArg("move", "dn");

         echo("<td align='center'> ");


         if(($i+1) != count($modlist) && $modlist[$i+1]['leftright'] == $mod['leftright']) {
            echo("<a href='". $url->toString() ."'><img src='". $dn_img . "' border=0 alt='move'></a> ");
         }


         echo("</td>\n");

         # DISABLE
         $url->addArg('navbar_module_action', _DISABLE_);

         echo("<td align='center'> <a href='". $url->toString() ."' class='"._CAL_CSS_ULINE_."'
		    >"._DISABLE_."</a></td>");


         if($config) {

            # CONFIGURE

            $url->addArg("navbar_module_action", _CONFIGURE_);

            echo("<td align='center'> ");

            if($_cal_modules[$mod['module']]['configure'])
                echo("<a href='". $url->toString() ."' class='"._CAL_CSS_ULINE_."'>"._CONFIGURE_."</a>");

            echo("</td>\n");

        }


      ########################
      #
      # NON ENABLED MODULE
      #
      ########################
      } else {

         echo("<td align='center'> - </td><td align='center'> - </td><td align='center'> - </td>");


         $url->addArg("navbar_module_action", _ENABLE_);
      
         # ENABLE 
         echo("<td align='center'> <a href='". $url->toString() ."' class='"._CAL_CSS_ULINE_."'
            >"._ENABLE_."</a></td>");


         if($config) {
            # CONFIGURE
            echo("<td align='center'> - </td>\n");

         }

 

      }


      $lastpos = $mod['leftright'];

      # DESCRIPTION

      if(!$_cal_modules[$mod['module']]['description']) $_cal_modules[$mod['module']]['description'] = "---";

      echo("<td> ". $_cal_modules[$mod['module']]['description'] ." </td>\n");


      echo("</tr>\n");

   }
 

   if($me) $_cal_user = $me;   

?>
</table>
<br><br><br>
<?php 

#############################
#
### SORT MODULES
#
#############################

function umodsort($a,$b)
{

   if($a['leftright'] < $b['leftright']) return -1;
   if($a['leftright'] > $b['leftright']) return 1;

   # same side
   if($a['priority'] < $b['priority']) return -1;
   if($a['priority'] > $b['priority']) return 1;
 
   return 0;


}

?>
