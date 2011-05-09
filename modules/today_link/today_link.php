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
//

   global $_cal_weekdays, $_cal_months;

   $time = _ex_localtime();


   $url = new _cal_url();
   $url->addArg("d", _ex_date("j", $time));
   $url->addArg("m", _ex_date("n", $time));
   $url->addArg("y", _ex_date("Y", $time));

   # Today
   echo("<a class='"._CAL_CSS_MAIN_HEADER_."'
        href='". $url->toString() ."'>");

   if(function_exists('_ex_lang_date_header_full_date')) {

    echo(_ex_lang_date_header_full_date(_ex_date("w", $time), _ex_date("j", $time),
        _ex_date("n", $time), ''));

   } else if(@constant("_CAL_EURO_DATE_")) {

      echo($_cal_weekdays[_ex_date("w", $time)]. " ");
      echo(_ex_date("j", $time) ." ");
      echo($_cal_months[_ex_date("n", $time)]);


   } else {

      echo($_cal_weekdays[_ex_date("w", $time)]. ", ");
      echo($_cal_months[_ex_date("n", $time)]. " ");
      echo(_ex_date("j", $time));

   }


   echo("</a>");

   echo("<br>");
