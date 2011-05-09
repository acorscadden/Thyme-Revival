<?php

  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.template_tabbed.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.form.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.table.php';
  global $_cal_tmpl;
  global $_cal_user;
  global $_cal_form;
  global $_cal_sql;
  global $_cal_dbpref;
  @define ('_WIN32_', @substr (@strtolower (PHP_OS), 0, 3) == 'win');
  $_cal_html->print_heading (_GLOBAL_SETTINGS_);
  if (!$_cal_user->admin)
  {
    $_cal_html->permission_denied ();
    return null;
  }

  if ((@constant ('_CAL_ATTACHMENTS_') AND !_ex_is_writable (@constant ('_CAL_ATTACHMENTS_PATH_'), true)))
  {
    $_cal_html->warning (sprintf (_WARNING_ATTACH_, @constant ('_CAL_ATTACHMENTS_PATH_')));
  }

  if (!_ex_is_writable (@constant ('_CAL_BASE_PATH_') . 'customize', true))
  {
    $_cal_html->warning (sprintf (_WARNING_DIR_NOT_WRITABLE_, @constant ('_CAL_BASE_PATH_') . 'customize'));
  }

  $_cal_form = new _cal_form ('globalsettings');
  $_cal_form->print_header ();
  $_cal_form->print_hidden ('module');
  $_cal_tmpl = new _cal_template ();
  $_cal_tmpl->print_header ();
  $globs_reg = array ('_CAL_MAIL_FROM_' => 1, '_CAL_MAIL_PROG_' => 1, '_CAL_MAIL_PATH_' => 1, '_CAL_MAIL_AUTH_' => 1, '_CAL_MAIL_AUTH_USER_' => 1, '_CAL_MAIL_AUTH_PASS_' => 1, '_CAL_MAIL_SERVER_' => 1, '_CAL_MAIL_PORT_' => 1, '_CAL_ATTACHMENTS_' => 1, '_CAL_ATTACHMENTS_PATH_' => 1, '_CAL_SITE_NAME_' => 1, '_CAL_FORCE_THEME_' => 1, '_CAL_GUEST_EMAIL_OK_' => 1, '_CAL_DISABLE_ADDR_BOOK_' => 1, '_CAL_HIDE_QUICK_ADD_' => 1, '_CAL_FORCE_DEFAULT_OPTS_' => 1, '_CAL_NO_GUEST_TIMEZONE_' => 1, '_CAL_DISABLE_WYSIWYG_' => 1, '_CAL_SHOW_CAL_NAMES_' => 1, '_CAL_THEME_POPUPS_' => 1, '_CAL_PHP_CLI_' => 1, '_CAL_JOB_INTERVAL_' => 1, '_CAL_NO_JOBS_' => 1, '_CAL_MULTI_REMIND_' => 1, '_CAL_LICENSE_KEY_' => 1);
  $job_config_intervals = array (0 => _NO_SCHEDULED_TASK_, 5 => '5 ' . _MINUTES_, 10 => '10 ' . _MINUTES_, 20 => '20 ' . _MINUTES_, 30 => '30 ' . _MINUTES_, 60 => '1 ' . _HOUR_, 120 => '2 ' . _HOURS_, 180 => '3 ' . _HOURS_, 240 => '4 ' . _HOURS_, 360 => '6 ' . _HOURS_, 720 => '12 ' . _HOURS_, 1440 => '24 ' . _HOURS_);
  if ($_REQUEST['globset_action'])
  {
    if ($_REQUEST['cal_force_theme'] == 'a')
    {
      $_REQUEST['cal_force_theme'] = '';
    }

    foreach (array_keys ($globs_reg) as $g)
    {
      if ((@constant ('_CAL_LICENSE_KEY_') AND $g == '_CAL_LICENSE_KEY_'))
      {
        continue;
      }

      $globs[$g] = $_REQUEST[strtolower (substr (substr ($g, 1), 0, 0 - 1))];
    }

    if ($_REQUEST['license_key'])
    {
//      $_REUQEST['license_key'] = strtoupper ($_REQUEST['license_key']);
//      echo '<script language=\'javascript\' type=\'text/javascript\'>
//';
//      if (_ex_valid_license_key ($_REQUEST['license_key']))
//      {
//        $globs['_CAL_LICENSE_KEY_'] = $_REQUEST['license_key'];
//        echo 'alert(\'' . str_replace ('\'', '\\\'', _LICENSE_KEY_ACCEPTED_) . '\');
//';
//      }
//      else
//      {
//        echo 'alert(\'' . str_replace ('\'', '\\\'', _INVALID_LICENSE_KEY_) . '\');
//';
//      }

//      echo '</script>
//';
    }

    if ($_REQUEST['sched_interval'] == 0)
    {
      $globs['_CAL_NO_JOBS_'] = 1;
    }
    else
    {
      $globs['_CAL_JOB_INTERVAL_'] = $_REQUEST['sched_interval'];
      $globs['_CAL_NO_JOBS_'] = 0;
    }

    $set_globs = $_cal_sql->query ('' . 'select variable, setting from ' . $_cal_dbpref . 'GlobalSettings', true);
    foreach (array_keys ($globs) as $g)
    {
      if (isset ($set_globs[$g]))
      {
        if (!strlen ($globs[$g]))
        {
          $_cal_sql->query ('' . 'delete from ' . $_cal_dbpref . 'GlobalSettings
               where variable = \'' . $g . '\'');
        }
        else
        {
          $_cal_sql->query ('' . 'update ' . $_cal_dbpref . 'GlobalSettings
               set setting = \'' . $_cal_sql->escape_string ($globs[$g]) . '\'
               where variable = \'' . $g . '\'');
        }
      }
      else
      {
        if ($globs[$g])
        {
          $_cal_sql->query ('' . 'insert into ' . $_cal_dbpref . 'GlobalSettings (variable, setting) values (\'' . $g . '\',
            \'' . $_cal_sql->escape_string ($globs[$g]) . '\')');
        }
      }

      unset ($_REQUEST[strtolower (substr (substr ($g, 1), 0, 0 - 1))]);
    }

    $globs = $_cal_sql->query ('' . 'select variable, setting from ' . $_cal_dbpref . 'GlobalSettings', true);
    $i = 1;
    while ($i < 4)
    {
      if (($_REQUEST['_glob_' . $i] AND !isset ($globs[$_REQUEST['_glob_' . $i]])))
      {
        $_REQUEST['_glob_' . $i] = '_CAL_' . strtoupper ($_REQUEST['_glob_' . $i]) . '_';
        if ($_cal_sql->query ('' . 'insert into ' . $_cal_dbpref . 'GlobalSettings (variable, setting) values(\'' . $_cal_sql->escape_string ($_REQUEST['_glob_' . $i]) . '\', \'' . $_cal_sql->escape_string ($_REQUEST['_globv_' . $i]) . '\')'))
        {
          $globs[$_REQUEST['_glob_' . $i]] = $_REQUEST['_globv_' . $i];
        }
      }

      unset ($_REQUEST['_glob_' . $i]);
      ++$i;
    }

    foreach (array_keys ($_REQUEST) as $k)
    {
      if (substr ($k, 0, 8) != '_globcv_')
      {
        continue;
      }

      $v = $_cal_sql->escape_string ($_REQUEST[$k]);
      $k = $_cal_sql->escape_string (substr ($k, 8));
      if ($v === '')
      {
        $q = '' . 'delete from ' . $_cal_dbpref . 'GlobalSettings where variable = \'' . $k . '\'';
        unset ($globs[$k]);
      }
      else
      {
        $q = '' . 'update ' . $_cal_dbpref . 'GlobalSettings set setting = \'' . $v . '\' where variable = \'' . $k . '\'';
        $globs[$k] = $v;
      }

      $_cal_sql->query ($q);
    }

    file_put_contents (_CAL_BASE_PATH_ . 'customize/site_header.html', $_REQUEST['site_header']);
    file_put_contents (_CAL_BASE_PATH_ . 'customize/site_footer.html', $_REQUEST['site_footer']);
    file_put_contents (_CAL_BASE_PATH_ . 'customize/site_head.html', $_REQUEST['site_head']);
    echo '<br><h4 align=\'center\'>' . _UPDATED_ . '</h4>
';
    require_once _CAL_BASE_PATH_ . 'include/classes/class.url.php';
    $_cal_url = new _cal_url ();
    $_cal_url->addArg ('module', 'global_settings');
    $_cal_html->js_redirect ($_cal_url->toString ());
    return null;
  }

  ($globs OR $globs = $_cal_sql->query ('' . 'select variable, setting from ' . $_cal_dbpref . 'GlobalSettings', true));
  if (count ($globs))
  {
    $custom_globs = array_flip (array_diff (array_keys ($globs), array_keys ($globs_reg)));
  }
  else
  {
    $custom_globs = array ();
  }

  $mail_progs = array (_MAIL_PROG_PHP_, _MAIL_PROG_CMD_, _MAIL_PROG_SERVER_);
  $smtp_auth = $globs['_CAL_MAIL_AUTH_'] == 'yes';
  if (!$globs['_CAL_ATTACHMENTS_PATH_'])
  {
    $globs['_CAL_ATTACHMENTS_PATH_'] = _CAL_BASE_PATH_ . 'attachments';
  }

  if (!$globs['_CAL_MAIL_PATH_'])
  {
    $globs['_CAL_MAIL_PATH_'] = ini_get ('sendmail_path');
  }

  if (!$globs['_CAL_MAIL_SERVER_'])
  {
    $globs['_CAL_MAIL_SERVER_'] = ini_get ('SMTP');
  }

  if (!$globs['_CAL_MAIL_PORT_'])
  {
    $globs['_CAL_MAIL_PORT_'] = ini_get ('smtp_port');
  }

  foreach (array_keys ($globs) as $g)
  {
    $_cal_form->defaults[trim (strtolower ($g), '_')] = $globs[$g];
  }

  $theme_options['a'] = _NONE_;
  $dh = dir (@constant ('_CAL_BASE_PATH_') . '/themes');
  while (false !== $entry = $dh->read ())
  {
    if (($entry == '.' OR $entry == '..'))
    {
      continue;
    }

    $theme_options[$entry] = $entry;
  }

  $dh->close ();
  ksort ($theme_options);
  $_cal_form->defaults['cal_force_theme'] = @constant ('_CAL_FORCE_THEME_');
  if (@constant ('_CAL_SITE_NAME_') != 'Thyme')
  {
    $_cal_form->defaults['cal_site_name'] = @constant ('_CAL_SITE_NAME_');
  }

  $_cal_form->defaults['site_header'] = @file_get_contents (_CAL_BASE_PATH_ . 'customize/site_header.html');
  $_cal_form->defaults['site_footer'] = @file_get_contents (_CAL_BASE_PATH_ . 'customize/site_footer.html');
  $_cal_form->defaults['site_head'] = @file_get_contents (_CAL_BASE_PATH_ . 'customize/site_head.html');
  $_cal_tmpl->row_header_width = 140;
  $_cal_tmpl->new_section (_GENERAL_);
//  if ((@constant ('_CAL_LICENSE_KEY_') AND _ex_valid_license_key ()))
//  {
//    $_cal_tmpl->section_row (_LICENSE_KEY_, _CAL_LICENSE_KEY_);
//  }
//  else
//  {
//    $_cal_form->defaults['license_key'] = @constant ('_CAL_LICENSE_KEY_');
//    $_cal_tmpl->section_row (_LICENSE_KEY_, $_cal_form->textbox ('license_key', 32));
//    $_cal_tmpl->section_row ('', 'Web Site: ' . preg_replace ('/[\\/|:].*/', '', preg_replace ('/.*?\\/\\//', '', _CAL_BASE_URL_)));
//    if (function_exists ('_ex_server_key'))
//    {
//      $_cal_tmpl->section_row ('', 'Server key: ' . _ex_server_key ());
//    }
//  }

  $_cal_tmpl->section_spacer ();
  $_cal_tmpl->section_row (_SITE_THEME_, $_cal_form->select ('cal_force_theme', $theme_options) . ' ' . _SITE_THEME_DESC_);
  $_cal_tmpl->section_row (_SITE_NAME_, $_cal_form->textbox ('cal_site_name', 32));
  $_cal_tmpl->section_spacer ();
  $_cal_tmpl->section_row ('', @htmlentities (_SITE_HEAD_DESC_, ENT_QUOTES, _CHARSET_));
  $_cal_tmpl->section_row (_SITE_HEAD_, $_cal_form->textarea ('site_head', 10, 30, 'style=\'width: 95%\''));
  $_cal_tmpl->section_spacer ();
  $_cal_tmpl->section_row ('', @htmlentities (_SITE_HEADER_DESC_, ENT_QUOTES, _CHARSET_));
  $_cal_tmpl->section_row (_SITE_HEADER_, $_cal_form->textarea ('site_header', 10, 30, 'style=\'width: 95%\''));
  $_cal_tmpl->section_spacer ();
  $_cal_tmpl->section_row ('', @htmlentities (_SITE_FOOTER_DESC_, ENT_QUOTES, _CHARSET_));
  $_cal_tmpl->section_row (_SITE_FOOTER_, $_cal_form->textarea ('site_footer', 10, 30, 'style=\'width: 95%\''));
  $_cal_tmpl->section_row ('', '<input type=button class=\'' . _CAL_CSS_BUTTON_ . '\' value=\'' . _PREVIEW_ . '\'                               onClick=\'newWin("' . _CAL_BASE_URL_ . 'modules/global_settings/preview.php")\'>');
  $_cal_tmpl->end_section ();
  $_cal_tmpl->row_header_width = 200;
  $_cal_tmpl->new_section (_EMAIL_);
  $_cal_tmpl->section_row (_MAIL_FROM_EMAIL_, $_cal_form->textbox ('cal_mail_from', 40));
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_guest_email_ok') . '
    ' . _ALLOW_GUEST_USERS_EMAIL_);
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_disable_addr_book') . '
    ' . _DISABLE_SITE_ADDR_BOOK_);
  $_cal_tmpl->section_spacer ();
  $_cal_tmpl->section_row (_MAIL_PROGRAM_, $_cal_form->select ('cal_mail_prog', $mail_progs, 'onChange=\'update_mailer()\''));
  ob_start ();
  $_cal_table = new _caL_table ();
  $_cal_table->vertical = true;
  $_cal_table->align = 'left';
  $_cal_table->align_opts = array ('center', 'left');
  $_cal_table->class_opts = array (_CAL_CSS_ROW_HEADER_, '');
  echo '<div id=\'mail_path\' style=\'display: none\'>';
  $_cal_table->print_header (array ());
  $_cal_table->print_row (array (_MAIL_PATH_, $_cal_form->textbox ('cal_mail_path', 40)), false);
  $_cal_table->print_footer ();
  echo '</div>';
  echo '<div id=\'mail_smtp\' style=\'display: none\'>';
  $_cal_table->print_header (array ());
  $_cal_table->print_row (array (_MAIL_SERVER_, $_cal_form->textbox ('cal_mail_server', 40)), 0);
  $_cal_table->print_row (array (_MAIL_SERVER_PORT_, $_cal_form->textbox ('cal_mail_port', 2)), 0);
  $_cal_table->print_row (array (_MAIL_AUTH_, '
    <input type=radio name=cal_mail_auth ' . ($smtp_auth ? '' : 'checked') . ' value=no> ' . _NO_ . '
    <input type=radio name=cal_mail_auth ' . ($smtp_auth ? 'checked' : '') . ' value=yes> ' . _YES_), 0);
  $_cal_table->print_row (array (_MAIL_AUTH_USER_, $_cal_form->textbox ('cal_mail_auth_user', 40)), 0);
  $_cal_table->print_row (array (_MAIL_AUTH_PASS_, $_cal_form->password ('cal_mail_auth_pass', 40)), 0);
  $_cal_table->print_footer ();
  echo '</div>';
  $MAIL_CONFIG = ob_get_contents ();
  ob_end_clean ();
  $_cal_tmpl->section_row ('', $MAIL_CONFIG);
  $_cal_tmpl->end_section ();
  if (@constant ('_CAL_NO_JOBS_'))
  {
    $_cal_form->defaults['sched_interval'] = 0;
  }
  else
  {
    $_cal_form->defaults['sched_interval'] = max (5, @constant ('_CAL_JOB_INTERVAL_'));
  }

  if (!$_cal_form->defaults['cal_php_cli'])
  {
    $_cal_form->defaults['cal_php_cli'] = PHP_BINDIR . DIRECTORY_SEPARATOR . 'php' . (@constant ('_WIN32_') ? '.exe' : '');
  }

  $_cal_tmpl->new_section (_SCHEDULED_TASK_);
  $_cal_tmpl->row_header_width = 300;
  $_cal_tmpl->section_row (_SCHEDULED_TASK_CONFIGURED_, $_cal_form->select ('sched_interval', $job_config_intervals));
  $_cal_tmpl->section_row (_PHP_CLI_, $_cal_form->textbox ('cal_php_cli', 32));
  $_cal_tmpl->end_section ();
  $_cal_tmpl->new_section (_ATTACHMENTS_);
  $_cal_tmpl->section_row (_ALLOW_ATTACHMENTS_, $_cal_form->checkbox ('cal_attachments'));
  $_cal_tmpl->section_row (_ATTACHMENTS_PATH_, $_cal_form->textbox ('cal_attachments_path', 64));
  $_cal_tmpl->end_section ();
  $_cal_tmpl->new_section (_MISC_);
  $_cal_tmpl->row_header_width = 50;
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_theme_popups') . ' ' . _THEME_POPUPS_);
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_force_default_opts') . ' ' . _FORCE_DEFAULT_OPTS_);
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_show_cal_names') . ' ' . _SHOW_CALENDAR_NAMES_);
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_no_guest_timezone') . ' ' . _NO_GUEST_TIMEZONE_);
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_hide_quick_add') . ' ' . _HIDE_QUICK_ADD_);
  $_cal_tmpl->section_row ('', $_cal_form->checkbox ('cal_disable_wysiwyg') . ' ' . _DISABLE_WYSIWYG_EDITOR_);
  $multi_remind_opts = array (_NO_ONE_, _EVENT_OWNER_, _CALENDAR_ADMINS_, _SITE_ADMINS_);
  $_cal_tmpl->section_row ('', sprintf (_ALLOW_CONFIGURE_REMINDERS_, $_cal_form->select ('cal_multi_remind', $multi_remind_opts)));
  $_cal_tmpl->end_section ();
  $_cal_tmpl->new_section (_CUSTOM_);
  $_cal_tmpl->row_header_width = 200;
  $_cal_tmpl->section_row (_NAME_, _VALUE_);
  foreach (array_keys ($custom_globs) as $c)
  {
    $_cal_form->defaults['_globcv_' . $c] = $globs[$c];
    $_cal_tmpl->section_row (preg_replace ('/^_CAL_(.*)_/', '\\1', $c), $_cal_form->textbox ('_globcv_' . $c, 20));
  }

  $i = 1;
  while ($i < 4)
  {
    $_cal_tmpl->section_row ($_cal_form->textbox ('_glob_' . $i, 20), $_cal_form->textbox ('_globv_' . $i, 20));
    ++$i;
  }

  if (!@constant ('_CAL_SITE_SETTINGS_HELP_URL_'))
  {
    define ('_CAL_SITE_SETTINGS_HELP_URL_', 'http://www.extrosoft.com/Documentation/Administration/Custom_Settings_%10_Tweeks/');
  }

  $_cal_tmpl->section_row ('', '<a href=\'' . _CAL_SITE_SETTINGS_HELP_URL_ . '\' class=\'' . _CAL_CSS_ULINE_ . '\' target=_blank>' . _HELP_ . '</a>');
  $_cal_tmpl->end_section ();
  $_cal_tmpl->toolbar ('', $_cal_form->submit ('globset_action', _SAVE_) . ' ' . $_cal_form->submit ('module', _CLOSE_), '');
  $_cal_tmpl->print_footer ();
  $_cal_form->print_footer ();
  $_cal_html->js_onload[] = 'update_mailer()';
  echo '<s';
  echo 'cript language=\'javascript\' type=\'text/javascript\'>
<!--

function update_mailer()
{

   var mail_sel = document.forms[\'globalsettings\'].elements[\'cal_mail_prog\'].selectedIndex;

   document.getElementById(\'mail_smtp\').style.display = (mail_sel == 2 ? \'inline\' : \'none\');
   document.getElementById(\'mail_path\').style.display = (mail_sel == 1 ? \'inline\' : \'none\');
}

//-->
</script>
';
?>