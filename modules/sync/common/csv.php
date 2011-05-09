<?php

  function strcsv ($data, $fd = ',', $quot = '"')
  {
    $str = '';
    foreach ($data as $cell)
    {
      $cell = str_replace ($quot, $quot . $quot, $cell);
      $str .= $quot . $cell . $quot . $fd;
    }

    return rtrim ($str, ',') . '
';
  }

?>