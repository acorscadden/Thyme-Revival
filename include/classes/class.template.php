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

  class _cal_template
  {
    var $row_header_width = 250;
    var $row_valign = 'top';
    var $hidden_printed = false;
    function _cal_template ($name = '')
    {
      if (!$GLOBALS['_cal_tmpl_section_id'])
      {
        $GLOBALS['_cal_tmpl_section_id'] = 1;
      }

      $this->name = $name;
    }

    function print_header ($div = '')
    {
      require_once @constant ('_CAL_BASE_PATH_') . 'include/js/show_hide.js';
      if (0 < strlen ($div))
      {
        echo '<div id=\'' . $div . '\'>
';
        $this->div = $div;
      }

      echo '	<table width=\'100%\' border=0 cellpadding=2 cellspacing=2>
';
    }

    function print_footer ()
    {
      echo '
</table>
';
      if ($this->div)
      {
        echo '</div>
';
      }

    }

    function new_row ()
    {
      echo '
	<tr class=\'' . _CAL_CSS_ROW_HEADER_ . '\'>
		<td colspan=2>
';
    }

    function end_row ()
    {
      echo '
		</td>
	</tr>
';
    }

    function section_row ($heading = '', $text = '')
    {
      if (0 < strlen ($heading))
      {
        $heading .= ':';
      }

      echo '
   <tr valign=\'' . $this->row_valign . '\' class=\'' . _CAL_CSS_ROW_HEADER_ . '\'>
      <td align=right width=\'' . $this->row_header_width . '\'><b>' . $heading . '</b></td>
      <td align=left> ' . $text . '
      </td>

   </tr>

';
    }

    function section_row_indented ($heading = '', $text = '')
    {
      if (0 < strlen ($heading))
      {
        $heading .= ':';
      }

      echo '
   <tr valign=\'' . $this->row_valign . '\' class=\'' . _CAL_CSS_ROW_HEADER_ . '\'>
      <td align=right width=\'' . $this->row_header_width . '\'><b>' . $heading . '</b></td>
      <td align=left> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $text . '
      </td>

   </tr>

';
    }

    function new_section ($heading, $hideable = null, $subsection = false)
    {
      echo '
	<tr>
';
      if (($hideable AND !$this->hidden_printed))
      {
        echo $GLOBALS['_cal_form']->fromRequest ('show_hide');
        $this->hidden_printed = true;
      }

      echo '		<td ' . ($subsection ? ' colspan=2 ' : '') . '>
';
      if ($hideable)
      {
        $this->hideable_section = 1;
        $GLOBALS['_cal_tmpl_section_id'] *= 2;
        if ($_REQUEST['show_hide'] & $GLOBALS['_cal_tmpl_section_id'])
        {
          $heading .= ' <font size=1>[<a class=\'' . _CAL_CSS_MAIN_HEADER_ . '\' href=\'javascript:show_hide(' . $GLOBALS['_cal_tmpl_section_id'] . ');\'><span id=\'show_hide_lbl' . $GLOBALS['_cal_tmpl_section_id'] . '\'>' . _SHOW_ . '</span></a>]</font>';
          $hidden_tag = ' style=\'display: none;\' ';
        }
        else
        {
          $heading .= ' <font size=1>[<a class=\'' . _CAL_CSS_MAIN_HEADER_ . '\' href=\'javascript:show_hide(' . $GLOBALS['_cal_tmpl_section_id'] . ');\'><span id=\'show_hide_lbl' . $GLOBALS['_cal_tmpl_section_id'] . '\'>' . _HIDE_ . '</span></a>]</font>';
        }
      }
      else
      {
        $this->hideable_section = 0;
      }

      $GLOBALS['_cal_html']->print_sub_heading ($heading);
      if ($hideable)
      {
        echo '<div id=\'show_hide' . $GLOBALS['_cal_tmpl_section_id'] . '\' ' . $hidden_tag . '>
';
      }

      echo '<table border=0 cellspacing=0 cellpadding=4 width=\'100%\'>
';
    }

    function end_section ()
    {
      if ($this->hideable_section)
      {
        echo '</div>
';
      }

      echo '
</table>
';
      echo '
		</td>
	</tr>
';
    }

    function toolbar ($l = null, $c = null, $r = null)
    {
      echo '
	<tr class=\'' . _CAL_CSS_TOOLBAR_ . '\' valign=\'middle\'>
		<td class=\'' . _CAL_CSS_TOOLBAR_ . '\' colspan=2>
';
      echo '<table class=\'' . _CAL_CSS_TOOLBAR_ . '\' border=0 style=\'border-collapse: collapse\' width=\'100%\'>
	<tr valign=\'middle\'>';
      if ($l !== null)
      {
        echo '
		<td align=left class=\'' . _CAL_CSS_TOOLBAR_ . '\'>
';
        echo $l;
        echo '
		</td>
';
      }

      if ($c !== null)
      {
        echo '
		<td align=center class=\'' . _CAL_CSS_TOOLBAR_ . '\'>
';
        echo $c;
        echo '
		</td>
';
      }

      if (($r !== null OR $l !== null))
      {
        echo '
		<td align=right class=\'' . _CAL_CSS_TOOLBAR_ . '\'>
';
        echo $r;
        echo '
		</td>
';
      }

      echo '
	</tr>
</table>
';
      echo '
</td>
		</tr>
';
    }

    function section_spacer ()
    {
      echo '
	<tr class=\'' . _CAL_CSS_SPACER_TINY_ . '\'>
		<td class=\'' . _CAL_CSS_SPACER_TINY_ . '\' colspan=2> </td></tr>

';
    }
  }

?>