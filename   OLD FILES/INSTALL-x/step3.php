<?php

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


  function check_step3 ()
  {
    return true;
  }

  function step3 ()
  {
    global $_cal_html;
    global $_cal_form;
    global $_cal_config;
    global $_cal_sql;
    define ('_CAL_SQL_DRIVER_', $_REQUEST['db_driver']);
    define ('_CAL_DBHOST_', $_REQUEST['db_host']);
    define ('_CAL_DBPORT_', $_REQUEST['db_port']);
    define ('_CAL_DBUSER_', $_REQUEST['db_user']);
    define ('_CAL_DBPASS_', $_REQUEST['db_pass']);
    define ('_CAL_DBNAME_', $_REQUEST['db_name']);
    $GLOBALS['_cal_dbpref'] = $_REQUEST['db_pref'];
    require_once 'include/classes/class.sql.php';
    define ('_CAL_DOING_OPTS_', 1);
    include 'include/languages/en_US.php';
    $_cal_sql = new _cal_sql ();
    $dh = dir ('./include/languages');
    while (false !== $entry = $dh->read ())
    {
      if (!$fh = fopen ('./include/languages/' . $entry, 'r', TRUE))
      {
        return null;
      }
      $entry = preg_replace ('/\\.php/', '', $entry);
      $inx = 1;
      while (!feof ($fh) && $inx <= 30) 
      {
	 $inx = $inx + 1;
        $line = fgets ($fh, 1024);
	 $sp = -1;
	 if(!strpos ($line, "define("))
        	{
              if(strpos ($line, "_LANG_NAME_")){
        	list ($def, $val) = explode (',', $line);
         		$val = trim ($val);
          		if ((substr ($val, 0, 1) == '"' OR substr ($val, 0, 1) == '\''))

         		 $quot = substr ($val, 0, 1);
          		$val = substr ($val, 1, strpos (substr ($val, 1), $quot));
          		$lang_opts[$entry] = $val;
          		break;
	  		 }
        	}
      }

      fclose ($fh);
    }

    $dh->close ();
    require_once 'include/classes/class.template.php';
    $_cal_html->print_heading ('Step 3 :: Config Options');
    $_cal_tmpl = new _cal_template ();
    $_cal_tmpl->row_header_width = 200;
    $_cal_tmpl->print_header ();
    $_cal_config_to_form = array ('_CAL_ATTACHMENTS_' => 'attachments', '_CAL_ATTACHMENTS_SIZE_' => 'attch_size', '_CAL_ATTACHMENTS_MAX_' => 'attch_max', '_CAL_ATTACHMENTS_ZIP_' => 'attch_zip', '_CAL_ATTACHMENTS_PATH_' => 'attch_path', '_CAL_ATTACHMENTS_HIDE_' => 'attch_hide', '_CAL_LANG_' => 'language');
    foreach (array_keys ($_cal_config_to_form) as $key)
    {
      $_cal_form->defaults[$_cal_config_to_form[$key]] = $_cal_config[$key];
    }

    if (!$_cal_config['_CAL_ATTACHMENTS_PATH_'])
    {
      $_cal_form->defaults['attch_path'] = preg_replace ('' . '/INSTALL$/', '', dirname (__FILE__)) . 'attachments';
    }

    $_cal_form->defaults['map_link'] = !$_cal_config['_CAL_NOMAP_'];
    $_cal_form->defaults['base_path'] = preg_replace ('' . '/INSTALL$/', '', dirname (__FILE__));
    if (!$_cal_config['_CAL_LANG_'])
    {
      $_cal_form->defaults['language'] = 'en_US';
    }

    $BASE_URL = dirname ($_SERVER['HTTP_REFERER']) . '/';
    if (!class_exists ('JConfig'))
    {
      $orig = $_cal_config['_cal_exists_'];
      $_cal_config['_cal_exists_'] = 0;
      require dirname (__FILE__) . '/parse_config.php';
      $_cal_config['_cal_exists_'] = $orig;
    }

    if ($mosConfig_live_site)
    {
      $url = parse_url ($BASE_URL);
      $url2 = parse_url ($mosConfig_live_site);
      $BASE_URL = $url['scheme'] . '://' . $url2['host'] . ($url['port'] ? ':' . $url['port'] : '') . $url['path'];
      $url_msg = ' <font class="hil">(host was determined from Joomla\'s configuration)</font>';
      $_cal_form->defaults['site_email'] = $mosConfig_mailfrom;
    }
    else
    {
      $url_msg = '';
    }

    $_cal_form->defaults['base_url'] = $BASE_URL;
    $_cal_tmpl->new_section ('General');
    $_cal_tmpl->section_row ('Initial admin password', $_cal_form->password ('admin_pw') . ' retype:');
    $_cal_tmpl->section_row ('', $_cal_form->password ('admin_pw2'));
    $_cal_tmpl->section_row ('Admin e-mail address', $_cal_form->textbox ('admin_mail', 32) . ' E.g. me@mysite.com');
    $_cal_tmpl->section_row ('', 'This is the e-mail address of Thyme\'s admin account.');
    $_cal_tmpl->section_spacer ();
    $_cal_tmpl->section_row ('Base path', $_cal_form->textbox ('base_path', 50) . ' Path to your Thyme installation with trailing slash.');
    $_cal_tmpl->section_row ('Base URL', $_cal_form->textbox ('base_url', 50) . ' Full URL to Thyme with trailing slash.' . $url_msg);
    $_cal_tmpl->section_spacer ();
    $_cal_tmpl->section_row ('Site e-mail address', $_cal_form->textbox ('site_email', 40) . ' E.g.
	Company X &lt;calendar@companyx.com&gt;');
    $_cal_tmpl->section_row ('', 'When e-mail leaves Thyme (in reminders, notifications etc..), this is the
	e-mail address that will appear in the From field.');
    $_cal_tmpl->end_section ();
    $_cal_tmpl->new_section ('Locale');
    $_cal_tmpl->section_row ('Language', $_cal_form->select ('language', $lang_opts));
    $_cal_tmpl->section_spacer ();
    $_cal_tmpl->new_row ();
    include_once 'modules/options/locale.php';
    $_cal_tmpl->end_row ();
    $_cal_tmpl->new_row ();
    echo '<div align=\'center\' style=\'color: #a00; font-size: 12px\'>
   <b><i>NOTE: If available, please be sure to
   select the correct Daylight Saving Time for your location
   rather than "On" or "Off."</i></b></div>';
    $_cal_tmpl->end_row ();
    $_cal_tmpl->end_section ();
    $_cal_tmpl->new_section ('Misc');
    $_cal_tmpl->section_row ('Map Link', $_cal_form->checkbox ('map_link'));
    $_cal_tmpl->section_row ('', 'This will enable a "Map" link when viewing an event 
	that has an Address. If you are outside the United States, it is recommended
	that you not enable this option, as it will probably not work correctly.
	<Br><br>Optionally, you may enable this option, then edit include/custom_functions.php to make
	the map_link() function work correctly for your country.');
    $_cal_tmpl->section_spacer ();
    $_cal_tmpl->section_spacer ();
    $_cal_tmpl->end_section ();
    $_cal_tmpl->print_footer ();
    echo '<br><br>
<table cellpadding=5>
<tr class=\'toolbar\'>
';
    $_cal_form->print_hidden ('db_driver');
    $_cal_form->print_hidden ('db_host');
    $_cal_form->print_hidden ('db_port');
    $_cal_form->print_hidden ('db_user');
    $_cal_form->print_hidden ('db_pass');
    $_cal_form->print_hidden ('db_pref');
    $_cal_form->print_hidden ('db_name');
    if ($button)
    {
      echo '<td align=\'center\'>' . $_cal_form->submit ('action', $button, 'style=\'width: 80px;\'') . '</td>';
    }

    echo '  <td align=\'center\'>
';
    echo $_cal_form->submit ('action', 'Previous', ' style=\'width: 80px;\'');
    echo '
';
    echo $_cal_form->submit ('action', 'Finish', ' style=\'width: 80px;\' onClick="return validate_form()"');
    echo '</tr>
</table>
';
    echo '<s';
    echo 'cript language=\'javascript\' type=\'text/javascript\'>
<!-- 

var elms = document.forms[0].elements;

function validate_form()
{
   // PASSWORD VALIDATION
   ///////////////////////
   if(!elms[\'admin_pw\'].value.length) {
      alert(\'Please enter a default admin password.\');
      return false;
   }

   if(elms[\'admin_pw\'].value != elms[\'admin_pw2\'].value) {
      alert("The passwords ';
    echo 'you entered do not match.");
      return false;
   }

   return true;
}

-->
</script>

';
  }

  define ('_SHOW_', 'Show');
  define ('_HIDE_', 'Hide');
  echo '
';
?>