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
// $Id: class.form.php,v 1.43 2008/06/18 16:36:09 ian Exp $
//

require_once(@constant("_CAL_BASE_PATH_") . "include/date_utils.php");

class _cal_form
{

   var $name, $action;
   var $method = "POST";

   var $defaults = array();

   var $delopts = array();

##
   function _cal_form($name="", $action="")
   {
      if(strlen($action) < 1) { $action = $_SERVER['PHP_SELF']; }

      if(!$name) $name = "form_". rand(1,20) . rand(2,30) . rand(3,40);
      $this->name = $name;
      $this->action = $action;

   }

##################
#
##################

   function encode($v) {
      if(@constant('_NO_FORM_DECODE_')) return $v;
      return @htmlentities($v,ENT_QUOTES,_CHARSET_);
   }

   function durationselect($name)
   {
      $sel = "<select name=\"". $name ."_hr\">\n";
      
      for($i = 0; $i < 24; $i++) {

         $selected = $this->defaults[$name."_hr"] == $i ? "selected" : "";

         $sel .= "<option $selected value=\"" .$i ."\">". $i ." ";
         $sel .= ($i == 1 ? _HR_ : _HRS_);
         $sel .= "</option>\n";
      }
 
      $sel .= "</select>\n";

      $sel .= "<select name=\"". $name ."_min\">\n";

      for($i = 00; $i < 60; $i+=5) {

         $selected = $this->defaults[$name."_min"] == $i ? "selected" : "";

         $sel .= "<option value=\"". $i ."\" $selected>". $i ." ". _MINS_ ."</option>\n";

      }
      $sel .= "</select>\n";
      

      return $sel;

   }

################
#
#################
   function dateselect($name, $xtra = "")
   {
      global $_cal_months;

      # months
      ###############
      $this->defaults[$name."_mo"] or
	$this->defaults[$name."_mo"] = _ex_date("n",_ex_localtime());

      $mos = $this->select($name."_mo", $_cal_months, $xtra);



      # days
      ###############
      foreach(range(1,31) as $da) $days[$da] = $da;

      $this->defaults[$name."_da"] or $this->defaults[$name."_da"] = _ex_date("j",_ex_localtime());
      $das = $this->select($name."_da", $days, $xtra);


      # years
      #############
      $tmparr = array();

      $this->defaults[$name."_yr"] or $this->defaults[$name."_yr"] = _ex_date("Y",_ex_localtime());

      for($i = $this->defaults[$name."_yr"] - 1;
      		$i < $this->defaults[$name."_yr"] + 7; $i++)
      {
         $tmparr[$i] =  $i;
      }

      $yrs = $this->select($name."_yr", $tmparr, $xtra);
    


      # return it all
      #################33
      if(@constant("_CAL_EURO_DATE_") == 1)
         return $das . $mos . $yrs;
 
 
      return $mos . $das . $yrs; 

   }

   function timeselect($name)
   {

      return $this->hourselect($name)." ".$this->minuteselect($name);

   }

   function minuteselect($name)
   {

      $sel .= "<select name=\"". $name ."_min\">\n";

      for($i = 00; $i < 60; $i+=5) {

         $i = $i < 10 ? '0' . $i : $i;

         $selected = $this->defaults[$name."_min"] == $i ? "selected" : "";

         $sel .= "<option value=\"". $i ."\" $selected>:". $i ."</option>\n";

      }

      $sel .= "</select>\n";

      return $sel;

   }

   function hourselect($name)
   {

      global $_cal_user;

      $sel = "<select name=\"". $name ."_hr\">\n";

      if($_cal_user->options->hour_format == 12) {
         $sel .= "<option value=\"0\">12 "._AM_."</option>\n";
      } else {
         $sel .= "<option value=\"0\">00</option>\n";
      }

      for($i = 1; $i < 24; $i++)
      {
          $selected = $this->defaults[$name."_hr"] == $i ? $selected = "selected" : "";

          $sel .= "<option $selected value=\"" .$i ."\">";

          if($_cal_user->options->hour_format == 12) {
             $sel .= ($i > 12 ? $i - 12 : $i);
             $sel .= ($i < 12 ? " ". _AM_ : " ". _PM_);
          } else {
             $sel .= ($i < 10) ? '0'.intval($i) : $i;
          }

          $sel .= "</option>\n";

      }
      $sel .= "</select>\n";

      return $sel;

   }


##

   function textarea($name, $rows, $cols, $xtra="")
   {

      $this->excludes[$name] = 1;

      $tmpval = "<textarea rows=".$rows." cols=".$cols.
      	" name=\"".$name."\" ". $xtra ." >";

      $tmpval .= $this->encode($this->defaults[$name]);

      $tmpval .= "</textarea>\n";

      return $tmpval;

   }

   function textbox($name, $size = null, $xtra="")
   {

      $this->excludes[$name] = 1;

      $tmpval = "<input type=text name=\"".$name."\" " . $xtra;

      if($size > 0) {
         $tmpval .= " size=".$size;
      }

      $value = $this->encode($this->defaults[$name]);

      $tmpval .= " value=\"".$value."\"";
      $tmpval .= ">";

      return $tmpval;

   }

   function password($name, $size = null, $xtra="")
   {

      $this->excludes[$name] = 1;

      $tmpval = "<input type=password name=\"".$name."\" " . $xtra;

      if($size > 0) {
         $tmpval .= " size=".$size;
      }

      $value = $this->defaults[$name];

      $tmpval .= " value=\"".$value."\"";
      $tmpval .= ">";

      return $tmpval;

   }



   function print_hidden($mixedarg, $val = "__UNSET__")
   {
      echo($this->hidden($mixedarg, $val));
   }

   function hidden($mixedarg, $val = "__UNSET__")
   {

      if(is_array($mixedarg)) {

         while (list($key, $val) = each($mixedarg)) {

            if($this->excludes[$key]) continue;

            $ret .= "<input type=hidden name=\"".$key."\" value=\"";
            $ret .= $this->encode($val) . "\">\n";

            $this->excludes[$key] = 1;

         }
         reset($mixedarg);

       } else {
         
          if("__UNSET__" == $val) {
             $val = $_REQUEST[$mixedarg];
          } 
          $ret = "<input type=hidden name=\"". $mixedarg 
             ."\" value=\"". $this->encode($val) ."\">\n";

          $this->excludes[$mixedarg] = 1;
       }

       return $ret;

   }

   function dump_request()
   {

      foreach(array_keys($_REQUEST) as $key)
      {
         if($this->excludes[$key]) continue;

         $this->print_hidden($key, $_REQUEST[$key]);
         echo("\n");
      }

   }

   function fromRequest($mixedarg)
   {

      if(is_array($mixedarg)) {

         foreach(array_keys($mixedarg) as $key) {
            $ret .= "<input type=hidden name=\"".$key."\" value=\"";
            $ret .= $this->encode($_REQUEST[$key]) . "\">\n";

         }
         reset($mixedarg);

      } else {

         $ret = "\n<input type=hidden name='".$mixedarg."'
            value='" . $this->encode($_REQUEST[$mixedarg]) ."'>\n";
      }

      return $ret;

   }


   function select($name, $arrArgs, $xtra="")
   {

      $this->excludes[$name] = 1;

      if(isset($this->defaults[$name])) {
         $default = $this->defaults[$name];
      }

      $select = "<select name=\"". $name ."\"  ". $xtra .">\n";


      while( list($key, $val) = each($arrArgs)) {

         $select .= "<option value='".$this->encode($key) ."'";
	 if(strcmp($default , $key) == 0) {
	    $select.= " selected ";
	 }
	 $select .= ">".$this->encode($val)."</option>\n";

      }

      reset($arrArgs);
      $select .= "</select>\n";

      return $select;


   }

   function mselect_h($name, $arrArgs, $size=10, $xtra="")
   {
      $this->excludes[$name] = 1;


      $select = "<select name=\"". $name ."\" size=". $size ." ". $xtra .">\n";

      if(is_array($arrArgs)) {
         while( list($key, $val) = each($arrArgs)) {
            if($key === '') continue;
            $select .= "<option value='".$key."'>".$val."</option>\n";
            $hidden_val .= $key .",";
         }

         reset($arrArgs);

      }

      if(!is_array($arrArgs) || !count($arrArgs)) {
         $select .= '<option> </option>';
         $this->delopts[] = $name;
      }
      $select .= "</select>\n";


      $select .= $this->hidden($name ."_hidden", $hidden_val);

      $this->mselect_h_list[] = $name;

      return $select;


   }

   function mselect($name, $arrArgs, $size=10, $xtra="")
   {
      $this->excludes[$name] = 1;


      $select = "<select name=\"". $name ."\" size=". $size ." ". $xtra ." multiple>\n";

      # strip off [] from end of name
      if(strpos($name, "[")) $name = substr($name, 0, strlen($name) - 2);

      while( list($key, $val) = each($arrArgs)) {

         $select .= "<option value='".$key."'";
    
         if(is_array($this->defaults[$name]) && array_search($key, $this->defaults[$name]) !== FALSE) {
            $select.= " selected ";
         }
         $select .= ">".$val."</option>\n";

      }

      if(!count($arrArgs)) {
         $select .= '<option> </option>';
         $this->delopts[] = $name;
      }

      reset($arrArgs);
      $select .= "</select>\n";

      return $select;


   }

   function print_select($name, $arrArgs, $xtra="")
   {
      echo($this->select($name, $arrArgs, $xtra));
   }


   function print_header($xtra = "", $skip_onsubmit = false)
   {

      $this->skip_onsubmit = $skip_onsubmit;

      echo("<form method=\"".$this->method."\" ");
      echo("action=\"".$this->action."\" " . $xtra ." ");
      echo("name=\"".$this->name."\"".($skip_onsubmit ? "" :                                                          " onSubmit='return form_submit_". $this->name ."()'") .">\n");


   }

   function print_footer()
   {

      global $_cal_persistent_url;

      if($this->persistent_request)
         $this->dump_request();

      if(is_array($_cal_persistent_url)) {
         $this->print_hidden($_cal_persistent_url);
      }


      echo("</form>\n");


      echo("<script language='javascript' type='text/javascript'>\n<!--\n");
      echo("function form_submit_". $this->name ."() {\n");


      if(is_array($this->mselect_h_list) && count($this->mselect_h_list)) {
         foreach($this->mselect_h_list as $msel) {
            echo("fill_hidden_". $this->name ."('". $msel ."');\n");
         }

      } else {
         $this->fill_hidden_printed[$this->name] = 1;
      }

      if(is_array($this->onSubmit)) {
         foreach($this->onSubmit as $fnc) {
            echo($fnc .";\n");
         }
      }

      echo("\nreturn true;\n");
      echo("}\n");

      if(!$this->fill_hidden_printed[$this->name]) {
         echo("\n\nfunction fill_hidden_". $this->name ."(sel_name) {\n");

         echo("\tvar hidden_val = document.forms['". $this->name ."'].elements[sel_name + '_hidden'];\n");
         echo("\thidden_val.value = '';\n\n");

         echo("\tvar optlen = document.forms['".$this->name."'].elements[sel_name].options.length;\n");

         echo("\n\n\tfor(i = 0; i < optlen; i++) {\n\n");
         echo("\t\thidden_val.value += document.forms['".$this->name."'].elements[sel_name].options[i].value + ',';\n");

         echo("\n\t}\n");

         echo("}\n");

         $this->fill_hidden_printed[$this->name] = 1;
      }

      foreach($this->delopts as $sel)
         echo("document.forms['". $this->name ."'].elements['$sel'].options.length = 0;\n");

      echo("-->\n</script>");


   }

   function checkbox($name, $xtra="")
   {
      $this->excludes[$name] = 1;

      return "<input type=checkbox name='". $name ."' ".
        ($this->defaults[$name] ? "checked" : "") . " value='1' " . $xtra .">\n";
   }


   function submit($name, $value, $xtra="")
   {
      $this->excludes[$name] = 1;
      return "<input type=submit name='". $name ."'
	value='". $this->encode($value) ."'
    class='".strtolower($value)."_button ". _CAL_CSS_BUTTON_."' ". $xtra ." >";
   }


}

?>
