<?php

  function _ex_theme_register ($g_func, $t_func)
  {
    $GLOBALS['_cal_theme']['functions'][$g_func] = $t_func;
  }

  function _ex_theme_set ($theme)
  {
    global $_cal_theme;
    if ($theme == $_cal_theme['name'])
    {
      return null;
    }

    $_cal_theme['last'] = $_cal_theme['name'];
    $_cal_theme['name'] = $theme;
    if (@constant ('_CAL_FORCE_THEME_'))
    {
      $theme = _CAL_FORCE_THEME_;
    }

    include @constant ('_CAL_BASE_PATH_') . 'themes/' . $theme . '/register_theme.php';
  }

  function _ex_theme_restore ()
  {
    if (!$GLOBALS['_cal_theme']['last'])
    {
      return null;
    }

    _ex_theme_set ($GLOBALS['_cal_theme']['last']);
  }

  function _ex_content_title ($l = '', $m = '', $r = '')
  {
    call_user_func ($GLOBALS['_cal_theme']['functions']['_ex_content_title'], $l, $m, $r);
  }

  function _ex_section_header ($text)
  {
    call_user_func ($GLOBALS['_cal_theme']['functions']['_ex_section_header'], $text);
  }

  function _ex_tabs ($tabs)
  {
    call_user_func ($GLOBALS['_cal_theme']['functions']['_ex_tabs'], $tabs);
  }

  function _ex_content_header ()
  {
    call_user_func ($GLOBALS['_cal_theme']['functions']['_ex_content_header']);
  }

  function _ex_content_footer ($links)
  {
    call_user_func ($GLOBALS['_cal_theme']['functions']['_ex_content_footer'], $links);
  }

  function _ex_cal_title (&$cal, $links)
  {
    call_user_func ($GLOBALS['_cal_theme']['functions']['_ex_cal_title'], $cal, $links);
  }

?>
