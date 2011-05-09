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
// $Id: class.cal_obj.php,v 1.41 2008/10/20 19:44:03 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql.php");
require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.sql_based.php");

class _cal_obj extends _cal_sql_based
{

var $invalids = array();

var $has_subcals = false;

var $view_filter = "";

var $requestable = array();
var $addable = array();

var $view_explicit = array();

function _cal_obj($cid = null)
{

   global $_cal_sql, $_cal_dbpref;

   $cid = abs($cid);

      $this->_cal_sql_based("{$GLOBALS['_cal_dbpref']}Calendars", "id", $cid);
      $this->id = $cid;

   $this->fields = array("title", "description", "options", "request_pre", "request_post",
        "request_notify", "request_contact","type","owner");


   $this->fill_vars();

   # not found? 
   if($this->not_found) {
      unset($this->id); unset($this->keyval);
   }

   $this->options = intval($this->options) + 0;

   $this->sequence = "{$_cal_dbpref}calendars_id_seq";

   $this->etypes_cal = $this->id;

   $this->has_subcals = ($this->type == 1 || $this->type == 2);

   # Check for view category
   if($this->has_subcals && $_SESSION['vcat']) {

      $etlist = $_cal_sql->query("select calendar, id from {$_cal_dbpref}EventTypes
        where calendar ". $this->get_constraint() ." and lower(name) = '".
        strtolower($_cal_sql->escape_string($_SESSION['vcat'])) ."'");

      $vflist = array();

      foreach($etlist as $etl) {
 
         $vflist[] = "({$_cal_dbpref}Events.calendar = {$etl['calendar']} and ".
                $_cal_sql->sql_binary_and("etype", $etl['id']) ." >= 1)";

      }

      if(!count($vflist)) {

         $this->view_filter = "calendar = 0";

      } else {
         $this->view_filter = " ( ". join(" or ", $vflist) ." ) ";
      }


   }

}

function get_categories_for_view()
{

   global $_cal_sql, $_cal_dbpref;

   if($this->etypes_cal != $this->id) {

      $ets = $_cal_sql->query("select calendar, id, name, icon from
            {$_cal_dbpref}EventTypes where calendar = {$this->etypes_cal} 
            order by lower(name)");


   } else {
      $ets = $_cal_sql->query("select calendar, id, name, icon from
                     {$_cal_dbpref}EventTypes where calendar ".
        $this->get_constraint() ." order by lower(name)");

   }

   $etcache = array();

   if(!$this->cal_ids) $this->cal_ids = array($this->id);

   foreach($this->cal_ids as $cid) $etcache[$cid] = array();

   foreach($ets as $et) {

      $etcache[$et['calendar']][$et['id']]['name'] = $et['name'];

      if($et['icon'])
      $etcache[$et['calendar']][$et['id']]['icon'] = $et['icon'];

      $etcache[$et['calendar']][$et['id']]['background'] = $et['background'];
   }

   return $etcache;

}

function get_user_list($access_lvl = 0, $fill_info = 0)
{

   global $_cal_sql, $_cal_dbpref;

   $access_lvl = intval($access_lvl);

   $users = array();

   # get all groups and members
   ###############################
   $users = array_merge($users,$_cal_sql->query("select distinct {$_cal_dbpref}Users.id as `rid`
        ". ($fill_info ? ",{$_cal_dbpref}Users.* " : "") ."
        {$_cal_dbpref}CalendarMembers.access_lvl
        from {$_cal_dbpref}CalendarMembers
        left join {$_cal_dbpref}GroupMembers on {$_cal_dbpref}CalendarMembers.rid = 
            {$_cal_dbpref}GroupMembers.id and {$_cal_dbpref}CalendarMembers.rtype = 1
            and {$_cal_dbpref}CalendarMembers.access_lvl >= {$access_lvl}
        left join {$_cal_dbpref}Users on {$_cal_dbpref}GroupMembers.uid = {$_cal_dbpref}Users.id
        where {$_cal_dbpref}CalendarMembers.cid = {$this->id} and
            {$_cal_dbpref}CalendarMembers.rtype = 1", true));

   # direct members
   ###################
   $users = array_merge($users,
        $_cal_sql->query("select rid, access_lvl
        ". ($fill_info ? ", {$_cal_dbpref}Users.*" : "") ."
        from {$_cal_dbpref}CalendarMembers
        ". ($fill_info ? " left join {$_cal_dbpref}Users on
            {$_cal_dbpref}Users.id = rid " : "") ."
        where cid = {$this->id} and rtype = 0 and access_lvl >= {$access_lvl}", true));

   # owner
   ###########
   if($access_lvl != 1) {
      require_once(_CAL_BASE_PATH_."include/classes/helpers/tie_to.php");

      $o_obj = new _cal_user(null,null,$this->owner);
      $o_arr = array();

      _ex_tie_to($o_arr,$o_obj);

      $users[] = $o_arr;
   }

   $members = array();
   #####################################
   #
   ### CUSTOM AUTH MODULE
   #
   #######################################
   if(function_exists("_ex_auth_get_user") && $fill_info) {

      # get list of ids
      #################
      foreach($users as $u) $ids[] = $u['rid'];

      $ids = array_unique($ids);
      $info = _ex_auth_get_users_by_id($ids, true);

      for($i = 0; $i < count($users); $i++) {

         if(!is_array($info[$users[$i]['rid']])) continue;

         $info[$users[$i]['rid']]['access_lvl'] = max($users[$i]['access_lvl'], $info[$users[$i]['rid']]['access_lvl']);
         $members[$users[$i]['rid']] = $info[$users[$i]['rid']];
         $members[$users[$i]['rid']]['rid'] = $users[$i]['rid'];

      }


   } else {

      foreach($users as $u) {
         $u['access_lvl'] = max($members[$u['rid']]['access_lvl'], $u['access_lvl']);
         $members[$u['rid']] = $u;
      }

   }

   return $members; 

}


function get_category_css()
{

   global $_cal_sql, $_cal_dbpref;


   if(!$this->category_css) $this->get_categories();

   if(($this->type == 1 || $this->type == 2) && !($this->options & 16)) {
      $this->category_css = $_cal_sql->query("select * from {$_cal_dbpref}EventTypes where calendar = {$this->etypes_cal}");
   }

   return $this->category_css;

}

function get_category_icons($cat_id)
{

   if(!$this->categories) $this->get_categories(); 

   if($cat_id == 0) return;

   if(!$this->categories) {
      $this->get_categories();
   }

   if($this->cat_icons[$cat_id]) return array($this->cat_icons[$cat_id]);

   # miltiple categories
   $cats = array();

   if(!count($this->cat_icons)) return array();

   foreach(array_keys($this->cat_icons) as $_c_id) {
      $_c_id = intval($_c_id);
      if((($_c_id * 1) & ($cat_id * 1)) != 0 && $this->cat_icons[$_c_id]) {
         $cats[] = $this->cat_icons[$_c_id];
      }

   }

   return $cats;
 

}

function get_category_name($cat_id)
{

   $cat_id = ($cat_id * 1);

   if($cat_id == 0) return;

   if(!$this->categories) $this->get_categories();

   if($this->categories[$cat_id]) return $this->categories[$cat_id];

   # miltiple categories
   $cats = array();

   if(!count($this->categories)) return "";

   foreach(array_keys($this->categories) as $_c_id) {
      if((($_c_id * 1) & ($cat_id * 1)) != 0) {
         $cats[] = $this->categories[$_c_id];
      }

   }

   return join(_LIST_SEP_, $cats);
}


function get_categories()
{
   global $_cal_sql, $_cal_dbpref;

   if($this->categories) return $this->categories;

   if($this->type == 1 || $this->type == 2 || !$this->id || $this->not_found) return array();

   $cats = $_cal_sql->query("select * from {$_cal_dbpref}EventTypes
       where calendar = ". intval($this->etypes_cal) ." order by lower(name)");

   $this->categories = $this->cat_icons = $this->category_css = array();

   foreach($cats as $c) {
      $this->categories[$c['id']] = $c['name'];   

      if($this->id != $this->etypes_cal) $c['calendar'] = $this->id;

      $this->category_css[$c['id']] = $c;

      if(!$this->has_css) {
         $this->has_css = strlen($c['icon'].$c['background'].$c['border'].
        $c['timecolor'].$c['titlecolor'].$c['fontweight'].$c['fontstyle'].$c['textdecoration']);
      }

      if($c['icon']) $this->cat_icons[$c['id']] = $c['icon'];
   }

   return $this->categories;
   
}

function get_calendar_name($cal_id)
{
   if($this->type == 0) return;

   if(!$this->calendars) $this->get_calendars();

   return $this->calendars[$cal_id];
}

function get_calendars()
{
   global $_cal_dbpref, $_cal_user, $_cal_sql;

   if($this->type == 0) return array();

   if($this->calendars) return $this->calendars;

   if(!$this->cal_ids) {
       # let get_constraint take care of it
       $this->get_constraint();
   }

   if(!count($this->cal_ids)) $this->cal_ids = array(0);

   $this->calendars = $_cal_sql->query("select id, title from {$_cal_dbpref}Calendars
                where id in (".
               join(",",$this->cal_ids) .") order by lower(title)", 1);

   return $this->calendars;

 
}

function get_constraint($ignore_access = false)
{

    global $_cal_sql, $_cal_dbpref, $_cal_user;

    # calendar types
    #
    # 0 - normal
    # 1 - view
    # 2 - global view
    # 3 - calendar group
    # 4 - sub calendar
 
    if($this->constraint) return $this->constraint;


    $acl_cache_added = array();

    # VIEWS
    #################
    if($this->type == 1 || $this->type == 2) {


       # global view or all calendars view
       #####################################
       if($this->type == 1 || $this->type == 2) {

          # hide from guest users or disabled  all calendars view
          if(($_cal_user->guest && ($this->options & 2)) || ($this->type == 2 && !($this->options & 1))) {
             $this->cal_ids = array();
             $this->constraint = " = 0 ";
             return " = 0 ";
          }

       }

       # global / site view
       #######################
       if($this->type == 2) {

          $cal_ids = $_cal_user->access->get_cals(0, " {$_cal_dbpref}Calendars.type = 0");


       # other
       } else {


          # normal view
          ###################
          if($this->type == 1) {

             $cal_ids = $_cal_sql->query("select rid, type from {$_cal_dbpref}CalendarMembers
                left join {$_cal_dbpref}Calendars on {$_cal_dbpref}Calendars.id = rid
                where cid = ".  abs($this->id), 1);

          }

          if(!count($cal_ids)) $cal_ids = array("0");

          # site view without explicitly allow all to view checked
          #########################################################
          if(!($this->type == 1 && $this->owner == 0 && ($this->options & 1))) {

             $v_cal_ids = $_cal_user->access->get_cals_sel(0,"
                {$_cal_dbpref}Calendars.id in (". join(",",array_keys($cal_ids)) .") ");

             foreach(array_keys($cal_ids) as $cid) {

                if(!$v_cal_ids[$cid]) {
                   unset($cal_ids[$cid]);
                   if($this->type == 1 && $this->owner > 0) $this->invalids[] = $cid;
                }
             }

          # site view with explicitly allow all to view checked
          #######################################################
          } else if(($this->type == 1 && $this->owner == 0 && ($this->options & 1))) {
         
             $cv = $_cal_user->access->get_cals_sel(0);
 
             # explicitly allow view access to these in access's cache
             foreach(array_keys($cal_ids) as $cid) {
                if($cv[$cid]) continue;
                $_cal_user->access->cache[$cid][0] = 1;
                $acl_cache_added[] = $cid;
             }

          }

       }

         if(!is_array($cal_ids)) $cal_ids = array();

         $cal_ids = array_keys($cal_ids);
         if(!count($cal_ids)) $cal_ids = array("0");

         $constraint = " in (". join(",",$cal_ids) .") ";

         $this->cal_ids = $cal_ids;

    # NORMAL CALENDAR
    ################## 
    } else {

         $constraint = " = ". abs($this->id) ." ";

    }

    # GET CALENDAR OPTIONS
    ###########################
    if($this->has_subcals && count($this->cal_ids) && !@constant('_CAL_DISABLE_ADD_TO_VIEW_')) {

       $acl_cache_added[] = '0';

       $this->addable = $_cal_user->access->get_cals_sel(1, "{$_cal_dbpref}Calendars.id in (".
            join(',', $this->cal_ids) .")");


       $this->requestable =
            $_cal_sql->query("select id, options from {$_cal_dbpref}Calendars where id in
            (". join(',', $this->cal_ids) .") and (". $_cal_sql->sql_binary_and("options", 130) ." = 2) and
                id not in (". join(',', $acl_cache_added) .")", true);



       $this->show_add = count($this->requestable) || count($this->addable);
    }


   $this->constraint = $constraint;

   return $constraint;

}

function get_master_cal_id($child) {

   global $_cal_sql, $_cal_dbpref;

   list($pcal) = $_cal_sql->query("select name, name from {$_cal_dbpref}EventTypes where id = 0
        and calendar = {$child}");

   return intval($pcal['name']);

}

function get_sub_cal_ids($master)
{
   global $_cal_sql, $_cal_dbpref;
   
   return $_cal_sql->query("select calendar, calendar from {$_cal_dbpref}EventTypes
                where id = 0 and name = '". abs($master) ."'", true);

}

function get_members(&$cal)
{
   global $_cal_dbpref, $_cal_sql;

   if(is_object($cal)) {

      $cid = $cal->id;
      $type = $cal->type;

   } else if(is_array($cal)) {

      $cid = $cal['id'];
      $type = $cal['type'];

   } 

   if($type == 0 || $type == 3 || $type == 4) {

      $groups = $_cal_sql->query("select * from {$_cal_dbpref}CalendarMembers
                left join {$_cal_dbpref}Groups on
                {$_cal_dbpref}Groups.id = {$_cal_dbpref}CalendarMembers.rid
                where cid = ".  $cid . " and rtype = 1");

      $users = $_cal_sql->query("select {$_cal_dbpref}CalendarMembers.*,
            {$_cal_dbpref}Users.name as description, {$_cal_dbpref}Users.id,
               {$_cal_dbpref}Users.userid as name from {$_cal_dbpref}CalendarMembers
               left join {$_cal_dbpref}Users on {$_cal_dbpref}Users.id = {$_cal_dbpref}CalendarMembers.rid
               where cid = ".  $cid . " and rtype = 0");


            #####################################
            #
            ### CUSTOM AUTH MODULE
            #
            #######################################
            if(function_exists("_ex_auth_get_user")) {

               # get list of ids
               #################
               foreach($users as $u) $ids[] = $u['rid'];

               $info = _ex_auth_get_users_by_id($ids, true);

               for($i = 0; $i < count($users); $i++) {

                  if(!is_array($info[$users[$i]['rid']])) continue;

                  $users[$i]['description'] = $info[$users[$i]['rid']]['name'];
                  $users[$i]['name'] = $info[$users[$i]['rid']]['userid'];
                  $users[$i]['rid'] = $users[$i]['rid'];

               }


            }

            $members = array_merge($groups,$users);


            usort($members, array('_cal_obj',"_member_sort"));

      return $members;

   } else {


      return $_cal_sql->query("select {$_cal_dbpref}Calendars.* from {$_cal_dbpref}CalendarMembers
                left join {$_cal_dbpref}Calendars on
                {$_cal_dbpref}Calendars.id = {$_cal_dbpref}CalendarMembers.rid
                where cid = ". $cid ." and rtype = 2 order by lower({$_cal_dbpref}Calendars.title)");

   }

}

function _member_sort($a,$b) {

   return strnatcasecmp($a['name'],$b['name']);

}

function save()
{

   if($this->type == 2 && !($this->options & 1)) $this->options = 0;
   
   return parent::save();
}

}

?>
