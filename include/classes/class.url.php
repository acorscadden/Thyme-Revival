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
// $Id: class.url.php,v 1.25 2008/06/27 19:58:02 ian Exp $
//

class _cal_url
{

   var $args = array();
   var $base;
   var $amp;
   var $eq = '=';
   var $start = '?';

   function _cal_url($base = "")
   {

      global $_cal_persistent_url;

      $this->base_set = strlen($base);


      if($base || @constant('_CAL_SEF_URLS_')) {

         if(@constant("_CAL_BASE_URL_")) $this->base = constant("_CAL_BASE_URL_");

         $this->base .= $base;

      } else {

         $this->base = substr($_SERVER['PHP_SELF'], -1) == '/' ? '' : basename($_SERVER['PHP_SELF']);
      }


      if(defined("_CAL_URL_PERSISTENT_")) {
         $this->addArgs($_GET);
      }

      if(is_array($_cal_persistent_url)) {

         $this->addArgs($_cal_persistent_url);

      }

      if(@defined("_CAL_AMP_")) {
         $this->amp = _CAL_AMP_;
      } else {
         $this->amp = '&';
      } 

      if(@constant("_CAL_REQ_AMP_")) $this->amp = _CAL_REQ_AMP_;
      if(@constant("_CAL_REQ_EQ_")) $this->eq = _CAL_REQ_EQ_;
      if(@constant("_CAL_REQ_START_")) $this->start = _CAL_REQ_START_;
   }

   function addArg($name, $val = "")
   {

      if(strlen($val) == 0) {
         unset($this->args[$name]);
      } else {
         $this->args[$name] = $val;
      }
   }

   function addArgs($arrArgs)
   {
      while (list($key, $val) = each($arrArgs)) {
         $this->args[$key] = $val;
      }
      reset($this->args);

   }

   function fromRequest($name)
   {
      if(!isset($_REQUEST[$name])) {
         return;
      }

      $this->args[$name] = $_REQUEST[$name];

   }

   function toString()
   {
      $link = $this->base;
      $first = 1;

      if(@constant('_CAL_SEF_URLS_') && $GLOBALS['_cur_cal'] && !$this->base_set) {

          $link .= $GLOBALS['_cur_cal']->title;

      }

      while (list($key, $val) = each($this->args)) {

         if($first) {
            $link .= $this->start;
            $first = 0;
         } else {
            $link .= $this->amp;
         }

         if(is_array($val)) {

            foreach($val as $item) {
               $link .= urlencode($key .'[]') . $this->eq . urlencode($item) . $this->amp;
            }
            $link = rtrim($link, $this->amp);
            continue;
         }

         $link .= urlencode($key). $this->eq .urlencode($val);
      }
      reset($this->args);

      return $link;
   }

}


?>
