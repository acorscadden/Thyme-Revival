<?php



  function m_sort_display ($a, $b)
  {
    return strcasecmp ($a['display_name'], $b['display_name']);
  }

  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.template.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.form.php';
  require_once @constant ('_CAL_BASE_PATH_') . 'include/classes/class.event_matrix.php';
  global $_cal_html;
  global $_cal_sql;
  global $_cal_user;
  global $_cal_modules;
  global $_cur_cal;
  $_cal_html->print_heading (_SYNC_);
  if ($_SESSION['calendar'] == 0)
  {
    return null;
  }

  $_cal_form = new _cal_form ('import');
  $_cal_form->defaults['etype'] = intval ($_SESSION['evnt_type']);
  $_cal_form->print_header ('enctype=\'multipart/form-data\'');
  $_cal_form->print_hidden ('module', 'sync');
  $_cal_tmpl = new _cal_template ();
  $_cal_tmpl->row_header_width = 200;
  $_cal_tmpl->print_header ();
  $_cal_modules['sync']['import'] = array ();
  $_cal_modules['sync']['export'] = array ();
  $dh = dir (@constant ('_CAL_BASE_PATH_') . 'modules/sync/import');
  while (false !== $entry = $dh->read ())
  {
    if (substr ($entry, 0, 1) == '.')
    {
      continue;
    }

    if (!@include 'import/' . $entry . '/register_format.php')
    {
      continue;
    }
  }

  $dh->close ();
  $imp_opts = array ();
  foreach (array_keys ($_cal_modules['sync']['import']) as $imp)
  {
    $imp_opts[$imp] = $_cal_modules['sync']['import'][$imp]['display_name'];
  }

  uksort ($imp_opts, 'm_sort_display');
  $dh = dir (@constant ('_CAL_BASE_PATH_') . 'modules/sync/export');
  while (false !== $entry = $dh->read ())
  {
    if (substr ($entry, 0, 1) == '.')
    {
      continue;
    }

    if (!@include 'export/' . $entry . '/register_format.php')
    {
      continue;
    }
  }

  $dh->close ();
  $exp_opts = array ();
  foreach (array_keys ($_cal_modules['sync']['export']) as $imp)
  {
    if ($_cal_modules['sync']['export'][$imp]['hide_sync'])
    {
      continue;
    }

    $exp_opts[$imp] = $_cal_modules['sync']['export'][$imp]['display_name'];
  }

  uksort ($exp_opts, 'm_sort_display');
  if ((($_REQUEST['sync_action'] == _IMPORT_ AND $_cal_user->access->can_add ($_cur_cal)) AND 0 < $_FILES['import_file']['size']))
  {
    $path = 'modules/sync/import/' . $_cal_modules['sync']['import'][$_REQUEST['import_from']]['include'];
    require @constant ('_CAL_BASE_PATH_') . $path;
  }

  if ($_cal_user->access->can_add ($_cur_cal))
  {
    $_cal_tmpl->new_section (_IMPORT_);
    $_cal_tmpl->section_row (_IMPORT_FROM_, $_cal_form->select ('import_from', $imp_opts, 'onChange="update_imp_form(this)"'));
    if (count ($_cur_cal->get_categories ()))
    {
      $_cal_tmpl->section_row (_IMPORT_AS_, $_cal_form->select ('etype', array (0 => '(' . _NONE_ . ')') + $_cur_cal->get_categories ()));
    }

    $_cal_tmpl->section_spacer ();
    if (@constant ('_CAL_ENABLE_TZ_'))
    {
      define ('_CAL_DOING_OPTS_', 1);
      include @constant ('_CAL_BASE_PATH_') . 'include/languages/' . _CAL_LANG_ . '.php';
      $old_width = $_cal_tmpl->row_header_width;
      $_cal_tmpl->row_header_width = 140;
      ob_start ();
      echo '<br><div align=\'left\' id=\'locale_div\' style=\'display: ' . ($_cal_form->defaults['locale'] ? 'inline' : 'none') . '\'>
            <table border=0 align=left style=\'border-collapse: collapse; border: 0px\'>';
      require_once @constant ('_CAL_BASE_PATH_') . 'modules/options/locale.php';
      echo '</table>
';
      echo '</div>';
      $locale_conf = ob_get_contents ();
      ob_end_clean ();
      $_cal_form->defaults['locale'] = 2;
      $_cal_tmpl->section_row (_TIMEZONE_, $_cal_form->select ('locale', array (_NONE_, _FORCE_, _AUTODETECT_), ' onChange=\'set_imp_locale(this)\'') . ' ' . $locale_conf);
      $_cal_tmpl->section_spacer ();
    }

    $_cal_tmpl->section_row ('', '<input type=file size=40 name=\'import_file\'>');
    $_cal_tmpl->section_row (_SYNC_DUPLICATES_, $_cal_form->select ('duplicates', array (_IGNORE_DUPLICATES_, _OVERWRITE_EXISTING_EVENT_, _CREATE_NEW_EVENT_)));
    if ($_cal_user->access->can_admin ($_cur_cal))
    {
      $_cal_tmpl->section_row (_FULL_SYNC_, $_cal_form->checkbox ('fullsync') . ' ' . _FULL_SYNC_DESC_);
    }

    $_cal_tmpl->end_section ();
    $_cal_tmpl->toolbar ('', $_cal_form->submit ('sync_action', _IMPORT_));
    $_cal_tmpl->section_spacer ();
    $_cal_tmpl->section_spacer ();
  }

  $_cal_tmpl->print_footer ();
  $_cal_form->print_footer ();
  if ($_SESSION['v'] == 'w')
  {
    $wday = _ex_date ('w', $_SESSION['time']);
    if ($_cal_user->options->week_start <= $wday)
    {
      $offset = 0 - $wday + $_cal_user->options->week_start;
    }
    else
    {
      $offset = $_cal_user->options->week_start - $wday - 7;
    }

    $tmptime = $_SESSION['time'] + $offset * 86400;
    list ($_cal_form->defaults['startdate_da'], $_cal_form->defaults['startdate_mo'], $_cal_form->defaults['startdate_yr']) = preg_split ('/-/', _ex_date ('j-n-Y', $tmptime));
    list ($_cal_form->defaults['enddate_da'], $_cal_form->defaults['enddate_mo'], $_cal_form->defaults['enddate_yr']) = preg_split ('/-/', _ex_date ('j-n-Y', $tmptime + 6 * 86400));
  }
  else
  {
    if ($_SESSION['v'] == 'd')
    {
      list ($_cal_form->defaults['startdate_da'], $_cal_form->defaults['startdate_mo'], $_cal_form->defaults['startdate_yr']) = preg_split ('/-/', _ex_date ('j-n-Y', $_SESSION['time']));
      list ($_cal_form->defaults['enddate_da'], $_cal_form->defaults['enddate_mo'], $_cal_form->defaults['enddate_yr']) = preg_split ('/-/', _ex_date ('j-n-Y', $_SESSION['time']));
    }
    else
    {
      if ($_SESSION['v'] == 'y')
      {
        list ($_cal_form->defaults['startdate_da'], $_cal_form->defaults['startdate_mo'], $_cal_form->defaults['startdate_yr']) = preg_split ('/-/', _ex_date ('1-1-Y', $_SESSION['time']));
        list ($_cal_form->defaults['enddate_da'], $_cal_form->defaults['enddate_mo'], $_cal_form->defaults['enddate_yr']) = preg_split ('/-/', _ex_date ('31-12-Y', $_SESSION['time']));
      }
      else
      {
        $_cal_form->defaults['startdate_mo'] = $_cal_form->defaults['enddate_mo'] = $_SESSION['m'];
        $_cal_form->defaults['startdate_da'] = 1;
        $_cal_form->defaults['enddate_da'] = _ex_date ('t', $_SESSION['time']);
      }
    }
  }

  $_cal_form->name = 'export';
  echo '<form action=\'modules/sync/export.php\' method=POST enctype=\'multipart/form-data\'
        name=\'' . $_cal_form->name . '\'>
';
  $_cal_tmpl->print_header ();
  $_cal_tmpl->new_section (_EXPORT_);
  $_cal_tmpl->section_row (_EXPORT_TO_, $_cal_form->select ('export_to', $exp_opts, 'onChange=\'update_range(this.options[this.selectedIndex].value)\'') . '<span id=\'quirks\'></span>');
  if (count ($_cur_cal->get_categories ()))
  {
    $_cal_tmpl->section_row (_EVENT_TYPES_, $_cal_form->mselect ('event_types[]', $_cur_cal->get_categories ()));
    $_cal_tmpl->section_row ('', '<font size=1><i>' . _EVENT_TYPES_DESC_ . (strpos (strtolower ($_SERVER['HTTP_USER_AGENT']), 'windows') ? _MULTI_SELECT_WIN_ : '') . '</i></font>');
  }

  $_cal_tmpl->section_row (_DATE_, $_cal_form->dateselect ('startdate'));
  $_cal_tmpl->section_row (_END_DATE_, $_cal_form->dateselect ('enddate'));
  $_cal_tmpl->end_section ();
  $_cal_tmpl->toolbar ('', $_cal_form->submit ('sync_action', _EXPORT_));
  $_cal_tmpl->print_footer ();
  $_cal_form->print_footer ();
  echo '<s';
  echo 'cript language="JavaScript" type="text/javascript">

var exp_frm = document.forms[\'export\'];
var imp_frm = document.forms[\'import\'];

var date_ranges = new Array();

';
  foreach (array_keys ($exp_opts) as $_cal_format)
  {
    echo 'date_ranges[\'' . $_cal_format . '\'] = ' . intval ($_cal_modules['sync']['export'][$_cal_format]['date_range']) . ';
';
  }

  echo '

';
  echo '
var imp_opts = new Array();

';
  foreach (array_keys ($imp_opts) as $i)
  {
    if (isset ($_cal_modules['sync']['import'][$i]['duplicates']))
    {
      echo 'imp_opts[\'' . $i . '\'] = new Array();
';
      echo 'imp_opts[\'' . $i . '\'][\'duplicates\'] = ' . intval ($_cal_modules['sync']['import'][$i]['duplicates']) . ';
';
      continue;
    }
  }

  echo '

';
  echo '
function update_imp_form(sel)
{

   var f = sel.options[sel.selectedIndex].value;

   if(imp_opts[f] && imp_opts[f][\'duplicates\']) {
      imp_frm.elements[\'duplicates\'].selectedIndex = imp_opts[f][\'duplicates\'];
      imp_frm.elements[\'duplicates\'].disabled = true;
   } else {
      imp_frm.elements[\'duplicates\'].selectedIndex = 0;
      imp_frm.elements[\'duplicates\'].disabled = false;
   }

}

';
  echo 'var date_elms = new Array(\'startdate_da\',\'startdate_mo\',\'startdate_yr\',\'enddate_da\',\'enddate_mo\',\'enddate_yr\');

function update_range(format)
{

   var enable = (date_ranges[format] == 0);

   for(i = 0; i < date_elms.length; i++)
   {

      exp_frm.elements[date_elms[i]].disabled = enable;

   }

   if(format == \'ical\') {

      document.getElementById(\'quirks\').innerHTML = \'<input type=checkbox ';
  echo 'name="qm"> ';
  echo _QUIRKS_MODE_;
  echo '\';

   } else {

      document.getElementById(\'quirks\').innerHTML = \'\';

   }
   

}


function set_imp_locale(sel)
{

   if(sel.selectedIndex == 1) {
      document.getElementById(\'locale_div\').style.display = \'inline\';
   } else {
      document.getElementById(\'locale_div\').style.display = \'none\';
   }
}

update_imp_form(imp_frm.elements[\'import_from\']);
update_range(exp_frm.elements[\'export_to';
  echo '\'].options[exp_frm.elements[\'export_to\'].selectedIndex].value);
</script>
';
?>
