
var frm_defaults = new Array();

<?php


if($_cal_event->id > 0) {


   #########################
   #
   ### PRINT FORM DEFAULTS
   #
   #########################

   foreach(array_keys($_cal_form->defaults) as $k)
   {

      if(!$_cal_form->excludes[$k]) continue;

      if(!$k) continue;

      if(is_array($_cal_form->defaults[$k])) continue;

      # skip certain items
      if(!preg_match("/^(r|start|end)/", $k)) continue;

      echo("frm_defaults['". $k ."'] = '". $_cal_form->defaults[$k] ."';\n");
   }

   # manual items

   echo("frm_defaults['r_source'] = '". $_cal_event->rep_sel ."';\n");
   echo("frm_defaults['repeat'] = '". ($_cal_event->repeat_every_mask > 0 ? "repeat" : "repeat_on") ."';\n");
   echo("frm_defaults['r_freq'] = '". ($_cal_event->freq - 1) ."';\n");

   if($_cal_event->end == "" || !isset($_cal_event->end))
      echo("frm_defaults['ends'] = '0';\n");
   else if($_cal_event->end != "")
      echo("frm_defaults['ends'] = '1';\n");
   else if($_cal_event->end_after > 0)
      ecoh("frm_defaults['ends'] = '2';\n");


   foreach(array('r_years_mdays','r_months_wdays','r_months_mdays','r_months_setpos') as $msel) {

      if(!is_array($_cal_form->defaults[$msel])) continue;
      $i = 0;
      echo("\nfrm_defaults['". $msel ."'] = new Array();\n");
      foreach(array_keys($_cal_form->defaults[$msel]) as $k) {
         if(!$k) continue;
         echo("frm_defaults['". $msel ."'][".($i++)."] = '". $k ."';\n");
      }
   }


   ################################
   #
   ### FIND ANY FUTURE EXCEPTIONS
   #
   ################################

   $ex_dates_or = $_cal_sql->query("select COUNT(*) as odate from {$GLOBALS['_cal_dbpref']}Events
		where override_id = ". $_cal_event->id);

   if($ex_dates_or[0]['odate']) 
      echo("var m_orride = ". $ex_dates_or[0]['odate'] .";\n");
   else 
      echo("var m_orride = 0;\n");

}


?>

function checksave()
{

   var frm = document.forms['EventForm'].elements;

   // applying to all events
   if(frm['apply_to1'] && m_orride && !e_rep_same()) {
      return confirm("<?php echo(preg_replace("/[\n|\r](?<!\\\)/", "\\\\n" ,_CONFIRM_EVNT_RPT_CHANGE_)) ?>");
   }

   return true;
}

function e_rep_same()
{


   var frm = document.forms['EventForm'].elements;

   // new event
   if(!frm['eid'] > 0) return true;

   // never did repeat
   if(!frm['apply_to1']) return true;

   // only applying to this recurrence
   if(frm['apply_to1'][1].checked) return true;

   // set rrule diff to start
   frm['rrule_diff'].value = 1;

   // check repeating
   if(frm['r_source'].value != frm_defaults['r_source']) return false;

   //////////////////////////
   //
   // check simple repeating
   //
   //////////////////////////

   if(frm['r_source'].value == 'simple') {


      if(frm['repeat'][0].checked && frm_defaults['repeat'] != 'repeat') return false;
      if(frm['repeat'][1].checked && frm_defaults['repeat'] != 'repeat_on') return false;

       // repeat every
       ///////////////
      if(frm_defaults['repeat'] == 'repeat') {

         // repeat every X 
         if(frm['repeat_every'].value != frm_defaults['repeat_every']) return false;

         // repeat every value
         if(e_changed_sel('repeat_every_val')) return false;

         // check checkboxes if selected days
         // ********************************##
         if(frm['repeat_every_val'].options[frm['repeat_every_val'].selectedIndex].value == 6) {

            if(e_changed_ckb('repeat_selected_', 1, 8)) return false;

         }

      // repeat on
      //////////////
      } else {

         // repeat_on select
         if(e_changed_sel('repeat_on')) return false;

         // repeat_on_wday
         if(e_changed_sel('repeat_on_wday')) return false;

         // repeat X months
         if(frm['repeat_on_months'].value != frm_defaults['repeat_on_months']) return false;

      }

   /////////////////////////////
   //
   // check advanced repeating
   //
   ////////////////////////////
   } else {

 
      // check advanced repeating rule
      if((frm['r_freq'].value * 1) != (frm_defaults['r_freq'] * 1)) return false;

      // yearly
      //////////
      if((frm['r_freq'].value * 1) == 0) {


         // X years
         if(frm['r_years'].value != frm_defaults['r_years']) return false;

         // weekday checkboxes
         if(e_changed_ckb('r_year_wday_',0,7)) return false;

         // month checkboxes
         if(e_changed_ckb('r_year_month_', 1, 13)) return false;

         // month days
         if(e_changed_msel('r_years_mdays')) return false;

      // monthly
      /////////////
      } else if((frm['r_freq'].value * 1) == 1) {


         // X months
         if(frm['r_months'].value != frm_defaults['r_months']) return false;

         // weekdays
         if(e_changed_msel('r_months_wdays')) return false;

         // month days
         if(e_changed_msel('r_months_mdays')) return false;

         // specific occurrences
	 if(e_changed_msel('r_months_setpos')) return false;         

      // weekly
      /////////////
      } else if((frm['r_freq'].value * 1) == 2) {

         // X weeks
         if(frm['r_weeks'].value != frm_defaults['r_weeks']) return false;

         // week start
         if(e_changed_sel('r_wkst')) return false;

         // weekday checkboxes
         if(e_changed_ckb('r_week_wday_', 0, 7)) return false;

         // month checkboxes
         if(e_changed_ckb('r_week_month_', 1, 13)) return false;


      // daily
      //////////////
      } else if((frm['r_freq'].value * 1) == 3) {

         // X days
         if(frm['r_days'].value != frm_defaults['r_days']) return false;

         // weekday checkboxes
         if(e_changed_ckb('r_day_wday_', 0, 7)) return false;

         // month checkboxes
         if(e_changed_ckb('r_day_month_', 1, 13)) return false;

      // easter
      //////////////
      } else {

         // X days
         if(frm['r_easter'].value != frm_defaults['r_easter']) return false;

         if(e_changed_sel('r_easter_when')) return false;

      }


   }

   // check start date
   ///////////////////
   if(e_changed_sel('startdate_yr')) return false;
   if(e_changed_sel('startdate_mo')) return false;
   if(e_changed_sel('startdate_da')) return false;

   // passed all tests

   frm['rrule_diff'].value = 0;

   return true;

}

function e_changed_sel(sel)
{

   var frm = document.forms['EventForm'].elements;

   return frm[sel].options[frm[sel].selectedIndex].value != frm_defaults[sel];

}

function e_changed_msel(sel)
{

   var cur_opts = document.forms['EventForm'].elements[sel].options;
   var def_opts = frm_defaults[sel];

   if(!(cur_opts.length || cur_opts.length > 0) && !(def_opts.length)) return false;

   if(cur_opts.length != def_opts.length) return true;

   for(i = 0; i < def_opts.length; i++)
   {

      if(cur_opts[i].value != def_opts[i])
         return true;

   }

   return false;
}

function e_changed_ckb(cname, start, end)
{

   var frm = document.forms['EventForm'].elements;

   // check checkboxes
   for(i = start; i < end; i++)
   {
      if((frm[cname + i].checked * 1) && (!frm_defaults[cname + i]))
         return true;

      if(frm_defaults[cname + i] && !frm[cname + i].checked)
         return true;
      
   }

   return false;
   
}

