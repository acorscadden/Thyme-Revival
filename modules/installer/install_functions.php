<?php



  function _ex_valid_install ($file, $key)
  {
    if (!file_exists ($file))
    {
      return false;
    }

    return $key == md5 (5 + 3 . 'valid' . file_get_contents ($file) . 'inst' . '2');
  }

  function _ex_parse_xml ($file)
  {
    $fp = fopen ($file, 'r');
    if (!$fp)
    {
      return false;
    }

    $xml = $parents = array ();
    $p = 0 - 1;
    while ($line = fgets ($fp))
    {
      if (preg_match ('' . '/^\\s*<[a-zA-Z]+>\\s*$/', $line))
      {
        $parents[] = preg_replace ('/^\\s*?</', '', preg_replace ('' . '/>\\s*$/', '', $line));
        ++$p;
        continue;
      }
      else
      {
        if (preg_match ('' . '/^\\s*<\\/[a-zA-Z]+>\\s*$/', $line))
        {
          array_pop ($parents);
          --$p;
          continue;
        }
        else
        {
          if (preg_match ('/<(.+?)>(.+?)<\\/\\1>/', $line, $matches))
          {
            $xml[$parents[count ($parents) - 1]][$matches[1]] = $matches[2];
            continue;
          }
          else
          {
            $attribs = array ();
            if (preg_match ('/^\\s*<([^=]+) /', $line, $matches))
            {
              $attribs['type'] = $matches[1];
              $line = substr ($line, strlen ($matches[0]), strlen ($line));
            }

            preg_match_all ('/[[<|\\s]*(.*?)(?<!\\\\)=("?)(.+?)(?<!\\\\)\\2[\\s|\\/|>]/', $line, $matches);
            $i = 0;
            while ($i < count ($matches[1]))
            {
              $attribs[$matches[1][$i]] = html_entity_decode (preg_replace ('/(?<!\\\\)\\\\/', '', $matches[3][$i]));
              ++$i;
            }

            $xml[$parents[count ($parents) - 1]][] = $attribs;
            continue;
          }

          continue;
        }

        continue;
      }
    }

    return $xml;
  }

  function _ex_unpack ($zip, $path)
  {
  }

  function _ex_installer_cleanup ()
  {
    _ex_rmrf (_CAL_BASE_PATH_ . 'modules/installer/repository/install');
    mkdir (_CAL_BASE_PATH_ . 'modules/installer/repository/install');
  }

  if (!function_exists ('_ex_rmrf'))
  {
    function _ex_rmrf ($dir)
    {
      if ($handle = opendir ($dir))
      {
        while (false !== $file = readdir ($handle))
        {
          if (($file == '..' OR $file == '.'))
          {
            continue;
          }

          clearstatcache ();
          if (is_dir ($dir . '/' . $file))
          {
            _ex_rmrf ($dir . '/' . $file);
            continue;
          }
          else
          {
            unlink ($dir . '/' . $file);
            continue;
          }
        }

        closedir ($handle);
        rmdir ($dir);
      }

    }
  }

?>