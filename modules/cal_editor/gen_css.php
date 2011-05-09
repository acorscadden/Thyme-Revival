<?php



  echo '<style type=\'text/css\' media=\'screen\'>
';
  echo '
/***********
 * ' . strtoupper (_GENERAL_) . ' *
 ***********/
';
  if ($_REQUEST['underline_links'] != 1)
  {
    echo '#cal a:visited { text-decoration: none; }
';
    echo '#cal a:link {  text-decoration: none; }
';
  }

  if ($_REQUEST['underline_links'] == 0)
  {
    echo '#cal a:hover { text-decoration:  none; }
';
  }

  if ($_REQUEST['underline_links'] == 2)
  {
    echo '#cal a:hover { text-decoration: underline; }
';
  }

  echo '

#cal .month_mini table { border-collapse: collapse; }

#cal .spacer_tiny { height: 1px; padding: 0px; }
#cal .spacer_small { height: 2px; width: 2px; padding: 0px; }
#cal .spacer { height: 20px; width: 20px; padding: 0px; }

#cal .heading { vertical-align: middle; }

';
  if ($_REQUEST['table_bgcolor'])
  {
    echo '#cal table { background: ' . $_REQUEST['table_bgcolor'] . '; }
';
  }

  if ($_REQUEST['font_color'])
  {
    echo '#cal table { color: ' . $_REQUEST['font_color'] . '; }
';
  }

  if ($_REQUEST['font_family'])
  {
    echo '#cal table { font-family: ' . $_REQUEST['font_family'] . '; }
';
  }

  if ($_REQUEST['font_size'])
  {
    echo '#cal table { font-size: ' . $_REQUEST['font_size'] . 'px; }
';
  }

  echo '

/**********
 * ' . strtoupper (_HEADER_) . ' *
 **********/
';
  if ($_REQUEST['header_color'])
  {
    echo '#cal .heading { background: ' . $_REQUEST['header_color'] . '; }
';
  }

  if ($_REQUEST['header_font_color'])
  {
    echo '#cal .heading { color: ' . $_REQUEST['header_font_color'] . '; }
';
  }

  if ($_REQUEST['header_font_size'])
  {
    echo '#cal .heading { font-size: ' . $_REQUEST['header_font_size'] . 'px; }
';
  }

  if ($_REQUEST['header_bold'])
  {
    echo '#cal .heading { font-weight: bold; }
';
  }

  if ($_REQUEST['header_italics'])
  {
    echo '#cal .heading { font-style: italic; }
';
  }

  if ($_REQUEST['header_uline'])
  {
    echo '#cal .heading { text-decoration: underline; }
';
  }

  if ($_REQUEST['header_link_color'])
  {
    echo '#cal a.heading:link, #cal a.heading:visited { color: ' . $_REQUEST['header_link_color'] . '; }
';
  }

  if ($_REQUEST['header_link_size'])
  {
    echo '#cal a.heading:link, #cal a.heading:visited { font-size: ' . $_REQUEST['header_link_size'] . 'px; }
';
  }

  if ($_REQUEST['header_link_bold'])
  {
    echo '#cal a.heading:link, #cal a.heading:visited { font-weight: bold; }
';
  }
  else
  {
    echo '#cal a.heading:link, #cal a.heading:visited { font-weight: normal; }
';
  }

  if ($_REQUEST['header_link_italics'])
  {
    echo '#cal a.heading:link, #cal a.heading:visted { font-style: italic; }
';
  }
  else
  {
    echo '#cal a.heading:link, #cal a.heading:visited { font-style: normal; }
';
  }

  if ($_REQUEST['header_link_uline'])
  {
    echo '#cal a.heading:link, #cal a.heading:visited { text-decoration: underline; }
';
  }
  else
  {
    echo '#cal a.heading:link, #cal a.heading:visited { text-decoration: none; }
';
  }

  echo '

/******************
 * ' . strtoupper (_WEEKDAY_HEADER_) . ' *
 ******************/
';
  if ($_REQUEST['row_header_color'])
  {
    echo '#cal .row_header { background: ' . $_REQUEST['row_header_color'] . '; }
';
  }

  if ($_REQUEST['row_header_font_color'])
  {
    echo '#cal .row_header { color: ' . $_REQUEST['row_header_font_color'] . '; }
';
  }

  if ($_REQUEST['row_header_font_size'])
  {
    echo '#cal .row_header { font-size: ' . $_REQUEST['row_header_font_size'] . 'px; }
';
  }

  if ($_REQUEST['row_header_bold'])
  {
    echo '#cal .row_header { font-weight: bold; }
';
  }
  else
  {
    echo '#cal .row_header { font-weight: normal; }
';
  }

  if ($_REQUEST['row_header_italics'])
  {
    echo '#cal .row_header { font-style: italic; }
';
  }

  if ($_REQUEST['row_header_uline'])
  {
    echo '#cal .row_header { text-decoration: underline; }
';
  }

  echo '

/********************************
 * ' . strtoupper (_DAYS_) . ' 
 * 
 * .cal_content = ' . strtolower (_NORMAL_DAYS_) . '
 * .cal_disabled = ' . strtolower (_DAYS_NOT_IN_MONTH_) . '
 * .cal_selected = ' . strtolower (_HIGHLIGHTED_DAYS_) . '
 *
 *******************************/
';
  if ($_REQUEST['content_color'])
  {
    echo '#cal .cal_content { background: ' . $_REQUEST['content_color'] . '; }
';
  }

  if ($_REQUEST['content_font_color'])
  {
    echo '#cal .cal_content { color: ' . $_REQUEST['content_font_color'] . '; }
';
  }

  if ($_REQUEST['disabled_content_color'])
  {
    echo '#cal .cal_disabled { background: ' . $_REQUEST['disabled_content_color'] . '; }
';
  }

  if ($_REQUEST['disabled_content_font_color'])
  {
    echo '#cal .cal_disabled { color: ' . $_REQUEST['disabled_content_font_color'] . '; }
';
  }

  if ($_REQUEST['selected_content_color'])
  {
    echo '#cal .cal_selected { background: ' . $_REQUEST['selected_content_color'] . '; }
';
  }

  if ($_REQUEST['selected_content_font_color'])
  {
    echo '#cal .cal_selected { color: ' . $_REQUEST['selected_content_font_color'] . '; }
';
  }

  echo '

/**********************************
 * 
 * ' . strtoupper (_EVENTS_) . '
 *
 * .cal_event = ' . strtolower (_NORMAL_EVENTS_) . '
 * .cal_event_imp = ' . strtolower (_FLAGGED_EVENTS_) . '
 * font.*, a.* = ' . strtolower (_TITLE_) . '
 *
 *********************************/
';
  if ($_REQUEST['cal_event_color'])
  {
    echo '#cal td.cal_event { background: ' . $_REQUEST['cal_event_color'] . '; }
';
  }

  if ($_REQUEST['cal_event_font_color'])
  {
    echo '#cal td.cal_event { color: ' . $_REQUEST['cal_event_font_color'] . '; }
';
  }

  if ($_REQUEST['cal_event_title_font_color'])
  {
    echo '#cal font.cal_event, #cal a.cal_event:link, #cal a.cal_event:visited { color: ' . $_REQUEST['cal_event_title_font_color'] . '; }
';
  }

  if ($_REQUEST['cal_event_border_color'])
  {
    echo '#cal td.cal_event {
        border-left: 2px solid ' . $_REQUEST['cal_event_border_color'] . ';
        border-bottom: 2px solid ' . $_REQUEST['cal_event_border_color'] . ';
        }
';
  }

  echo '
';
  if ($_REQUEST['flag_event_color'])
  {
    echo '#cal td.cal_event_imp { background: ' . $_REQUEST['flag_event_color'] . '; }
';
  }

  if ($_REQUEST['flag_event_font_color'])
  {
    echo '#cal td.cal_event_imp { color: ' . $_REQUEST['flag_event_font_color'] . '; }
';
  }

  if (((($_REQUEST['flag_event_title_font_color'] OR $_REQUEST['flag_event_title_font_weight']) OR $_REQUEST['flag_event_title_font_italics']) OR $_REQUEST['flag_event_title_font_uline']))
  {
    echo '#cal font.cal_event_imp, #cal a.cal_event_imp:link, #cal a.cal_event_imp:visited {
';
    if ($_REQUEST['flag_event_title_font_color'])
    {
      echo '	color: ' . $_REQUEST['flag_event_title_font_color'] . ';
';
    }

    if ($_REQUEST['flag_event_title_font_weight'])
    {
      echo '	font-weight: bold;
';
    }

    if ($_REQUEST['flag_event_title_font_italics'])
    {
      echo '	font-style: italic;
';
    }

    if ($_REQUEST['flag_event_title_font_uline'])
    {
      echo '	text-decoration: underline;
';
    }

    echo '}

';
  }

  if ($_REQUEST['flag_event_border_color'])
  {
    echo '#cal td.cal_event_imp {
        border-left: 2px solid ' . $_REQUEST['flag_event_border_color'] . ';
        border-bottom: 2px solid ' . $_REQUEST['flag_event_border_color'] . ';
        }
';
  }

  echo '
</style>
';
?>