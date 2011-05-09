<?php

// HTTP GET FUNCTION

function _ex_http_get($url = -1, $user="", $pass="") {


   // -1 is to check if http_get is possible
   if($url === -1) return(ini_get("allow_url_fopen") || function_exists("curl_init"));


   // USE CURL
   if(function_exists("curl_init")) {

      // create a new curl resource
      $ch = curl_init();

      // set URL and other appropriate options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      if($user) curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");

      // grab URL and return it
      $url = curl_exec($ch);

      // close curl resource, and free up system resources
      curl_close($ch);

      return $url;

   // USE FOPEN
   } else if(ini_get("allow_url_fopen") && !@defined("_CAL_FORCE_CURL_")) {

      if($user) $user .= ':'.$pass.'@';

      $url = preg_replace("/\/\//", "//$user", $url);

      return file_get_contents($url);

   }



}

?>
