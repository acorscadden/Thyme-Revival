<?php
//
// Distributed under the GPL
//



if(get_magic_quotes_gpc() && is_array($_REQUEST)) {
   foreach(array_keys($_REQUEST) as $key)
   {
      if(is_array($_REQUEST[$key])) {
         $_REQUEST[$key] = array_map("stripslashes", $_REQUEST[$key]);
         continue;
      }
      $_REQUEST[$key] = stripslashes($_REQUEST[$key]);
   }
}


if(!function_exists('array_combine')) {

   function array_combine( $keys, $vals ) {
     $keys = array_values( (array) $keys );
     $vals = array_values( (array) $vals );
     $n = max( count( $keys ), count( $vals ) );
     $r = array();
     for( $i=0; $i<$n; $i++ ) {
        $r[ $keys[ $i ] ] = $vals[ $i ];
     }
    return $r;
   }
}

if (!function_exists('file_get_contents')) {
    function file_get_contents($filename, $incpath = false, $resource_context = null)
    {
        if (false === $fh = fopen($filename, 'rb', $incpath)) {
            trigger_error('file_get_contents() failed to open stream: No such file or directory', E_USER_WARNING);
            return false;
        }

        clearstatcache();
        if ($fsize = @filesize($filename)) {
            $data = fread($fh, $fsize);
        } else {
            $data = '';
            while (!feof($fh)) {
                $data .= fread($fh, 8192);
            }
        }

        fclose($fh);
        return $data;
    }
}

if (!defined('FILE_APPEND')) {
    define('FILE_APPEND', 8);
}


if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $content, $flags = null, $resource_context = null)
    {
        // If $content is an array, convert it to a string
        if (is_array($content)) {
            $content = implode('', $content);
        }

        // If we don't have a string, throw an error
        if (!is_scalar($content)) {
            trigger_error('file_put_contents() The 2nd parameter should be either a string or an array', E_USER_WARNING);
            return false;
        }

        // Get the length of date to write
        $length = strlen($content);

        // Check what mode we are using
        $mode = ($flags & FILE_APPEND) ?  'ab' : 'wb';
     

        // Check if we're using the include path
        $use_inc_path = ($flags & FILE_USE_INCLUDE_PATH) ?
                    true :
                    false;


        // Open the file for writing
        if (($fh = @fopen($filename, $mode, $use_inc_path)) === false) {
            trigger_error("file_put_contents() failed to open stream {$filename} : Permission denied", E_USER_WARNING);
            return false;
        }

        // Write to the file
        $bytes = 0;
        if (($bytes = @fwrite($fh, $content)) === false) {
            $errormsg = sprintf('file_put_contents() Failed to write %d bytes to %s',
                            $length,
                            $filename);
            trigger_error($errormsg, E_USER_WARNING);
            return false;
        }

        // Close the handle
        @fclose($fh);

        // Check all the data was written
        if ($bytes != $length) {
            $errormsg = sprintf('file_put_contents() Only %d of %d bytes written, possibly out of free disk space.',
                            $bytes,
                            $length);
            trigger_error($errormsg, E_USER_WARNING);
            return false;
        }

        // Return length
        return $bytes;
    }
}

?>
