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
//
// Modified lastRSS parser. http://lastrss.webdot.cz
//
// Distributed under the GPL
//
//


require_once(_CAL_BASE_PATH_."include/http_get.php");

class _cal_rss
{

    // -------------------------------------------------------------------
    // Public properties
    // -------------------------------------------------------------------
    var $default_cp = 'UTF-8';
    var $CDATA = 'content';
    var $cp = '';
    var $items_limit = 0;
    var $stripHTML = False;
    var $date_format = '';

    // -------------------------------------------------------------------
    // Private variables
    // -------------------------------------------------------------------
    var $channeltags = array ('title', 'link', 'description', 'language', 'copyright', 'managingEditor', 'webMaster', 'lastBuildDate', 'rating', 'docs');
    var $itemtags = array('title', 'link', 'description', 'author', 'category', 'comments', 'enclosure', 'guid', 'pubDate', 'source');
    var $imagetags = array('title', 'url', 'link', 'width', 'height');
    var $textinputtags = array('title', 'description', 'name', 'link'); 


function _cal_rss()
{
   if(@constant("_CAL_RSS_CDATA_")) $this->CDATA = _CAL_RSS_CDATA_;
   if(@constant("_CAL_RSS_NO_HTML_")) $this->stripHTML = true;
}

function get_all()
{

   $now = time();

   $mins = intval(($now % 86400) / 60);
   $mins -= ($mins % 5);

   # GET A LIST OF REGISTERED RSS FEEDS
   ######################################
   global $_cal_feeds;

   $dh = dir(@constant("_CAL_BASE_PATH_")."/modules");

   while (false !== ($entry = $dh->read())) {
	
      if(substr($entry, 0,1) == ".") {
         continue;
      }

      if(!@include(@constant("_CAL_BASE_PATH_"). "modules/".$entry."/register_rss.php"))
         continue;

   }
   $dh->close();


   if(!is_array($_cal_feeds)) $_cal_feeds = array();

   # OPTIONALY GET EACH FEED
   ###########################
   foreach(array_keys($_cal_feeds) as $f)
   {

      # 20 mins minimum interval
      $_cal_feeds[$f]['interval'] = max(max(_CAL_JOB_INTERVAL_,1),$_cal_feeds[$f]['interval']);

      if(@constant("_CAL_JOB_DEBUG_"))
         echo("Checking RSS feed {$_cal_feeds[$f]['title']} with url: ". $_cal_feeds[$f]['urls'][0] ."\n");

      $xml = '';

      if(@constant("_CAL_JOB_DEBUG_"))
         echo("Checking $mins minutes against feed interval {$_cal_feeds[$f]['interval']}\n");

      if($mins % $_cal_feeds[$f]['interval']) continue;

      if(@constant("_CAL_JOB_DEBUG_"))
         echo("Getting RSS feed with url: ". $_cal_feeds[$f]['urls'][0] ."\n");


      $this->get($_cal_feeds[$f]);
   }

}

function get(&$f)
{

   $xml = '';

   $single_return = (count($f['urls']) == 1);

   # get feed urls
   ##################
   foreach($f['urls'] as $u) {


      $filename = preg_replace("/.*\//", "", $u);

      if($f['username']) $user = $f['username'].':'.$f['password'] .'@';

      # save original url
      $ou = $u;
      $u = preg_replace("/\/\//", "//$user", $u);


      # get contents
      ###############
      $er = error_reporting(E_WARNING);
      set_error_handler(array($this, "_connect_error"));

      $xml = _ex_http_get($u);

      error_reporting($er);
      restore_error_handler();

      if (!$xml || !strlen(trim($xml))) {
         echo "Unable to open remote url $ou for feed {$f['title']}.\n";

         if($single_return) return 0;

         continue;
      }

      # write to file
      #################
      $repository = @constant("_CAL_BASE_PATH_") ."modules/{$f}/repository";

      if($f['repository']) $repository = @constant("_CAL_BASE_PATH_") . $f['repository'];

      # make it if it does not exist
      @mkdir($repository);

      if(!$filename) $filename = 'default.xml';
      else $filename = preg_replace("/[^A-Za-z0-9\.]/", "_", $filename);

      $repository .= '/'.$filename;

      file_put_contents($repository, serialize($this->parse_real($xml)));

   }

   return 1;


}

function parse($fl)
{
   return unserialize(file_get_contents($fl));
}

function _connect_error($errno, $errstr, $errfile, $errline, $errcontext)
{
   echo("<b>"._ERROR_ ."</b>: " . preg_replace("/^.*?\):/","",$errstr) ."<br><br>");
   return true;

}


    // -------------------------------------------------------------------
    // Modification of preg_match(); return trimed field with index 1
    // from 'classic' preg_match() array output
    // -------------------------------------------------------------------
    function my_preg_match ($pattern, $subject) {
        // start regullar expression
        preg_match($pattern, $subject, $out);

        // if there is some result... process it and return it
        if(isset($out[1])) {
            // Process CDATA (if present)
            if ($this->CDATA == 'content') { // Get CDATA content (without CDATA tag)
                $out[1] = strtr($out[1], array('<![CDATA['=>'', ']]>'=>''));
            } elseif ($this->CDATA == 'strip') { // Strip CDATA
                $out[1] = strtr($out[1], array('<![CDATA['=>'', ']]>'=>''));
            }

            // If code page is set convert character encoding to required
            if ($this->cp != '')
                //$out[1] = $this->MyConvertEncoding($this->rsscp, $this->cp, $out[1]);
                $out[1] = iconv($this->rsscp, $this->cp.'//TRANSLIT', $out[1]);
            // Return result

            return trim(@html_entity_decode($out[1]));
        } else {
        // if there is NO result, return empty string
            return '';
        }
    }

    // -------------------------------------------------------------------
    // Replace HTML entities &something; by real characters
    // -------------------------------------------------------------------
    function unhtmlentities ($string) {
        // Get HTML entities table
        $trans_tbl = get_html_translation_table (HTML_ENTITIES, ENT_QUOTES);
        // Flip keys<==>values
        $trans_tbl = array_flip ($trans_tbl);
        // Add support for &apos; entity (missing in HTML_ENTITIES)
        $trans_tbl += array('&apos;' => "'");
        // Replace entities by values
        return strtr ($string, $trans_tbl);
    }

    // -------------------------------------------------------------------
    // Parse() is private method used by Get() to load and parse RSS file.
    // Don't use Parse() in your scripts - use Get($rss_file) instead.
    // -------------------------------------------------------------------
    function parse_real ($rss_content) {
        // Open and load RSS file
            // Parse document encoding
            $result['encoding'] = $this->my_preg_match("'encoding=[\'\"](.*?)[\'\"]'si", $rss_content);
            // if document codepage is specified, use it
            if ($result['encoding'] != '')
                { $this->rsscp = $result['encoding']; } // This is used in my_preg_match()
            // otherwise use the default codepage
            else
                { $this->rsscp = $this->default_cp; } // This is used in my_preg_match()

            // Parse CHANNEL info
            preg_match("'<channel.*?>(.*?)</channel>'si", $rss_content, $out_channel);
            foreach($this->channeltags as $channeltag)
            {
                $temp = $this->my_preg_match("'<$channeltag.*?>(.*?)</$channeltag>'si", $out_channel[1]);
                if ($temp != '') $result[$channeltag] = $temp; // Set only if not empty
            }
            // If date_format is specified and lastBuildDate is valid
            if ($this->date_format != '' && ($timestamp = strtotime($result['lastBuildDate'])) !==-1) {
                        // convert lastBuildDate to specified date format
                        $result['lastBuildDate'] = date($this->date_format, $timestamp);
            }

            // Parse TEXTINPUT info
            preg_match("'<textinput(|[^>]*[^/])>(.*?)</textinput>'si", $rss_content, $out_textinfo);
                // This a little strange regexp means:
                // Look for tag <textinput> with or without any attributes, but skip truncated version <textinput /> (it's not beggining tag)
            if (isset($out_textinfo[2])) {
                foreach($this->textinputtags as $textinputtag) {
                    $temp = $this->my_preg_match("'<$textinputtag.*?>(.*?)</$textinputtag>'si", $out_textinfo[2]);
                    if ($temp != '') $result['textinput_'.$textinputtag] = $temp; // Set only if not empty
                }
            }
            // Parse IMAGE info
            preg_match("'<image.*?>(.*?)</image>'si", $rss_content, $out_imageinfo);
            if (isset($out_imageinfo[1])) {
                foreach($this->imagetags as $imagetag) {
                    $temp = $this->my_preg_match("'<$imagetag.*?>(.*?)</$imagetag>'si", $out_imageinfo[1]);
                    if ($temp != '') $result['image_'.$imagetag] = $temp; // Set only if not empty
                }
            }
            // Parse ITEMS
            preg_match_all("'<item(| .*?)>(.*?)</item>'si", $rss_content, $items);
            $rss_items = $items[2];
            $i = 0;
            $result['items'] = array(); // create array even if there are no items
            foreach($rss_items as $rss_item) {
                // If number of items is lower then limit: Parse one item
                if ($i < $this->items_limit || $this->items_limit == 0) {

                    foreach($this->itemtags as $itemtag) {
                        $temp = $this->my_preg_match("'<$itemtag.*?>(.*?)</$itemtag>'si", $rss_item);
                        if ($temp != '') $result['items'][$i][$itemtag] = $temp; // Set only if not empty
                    }
                    // Strip HTML tags and other bullshit from DESCRIPTION
                    if ($this->stripHTML && $result['items'][$i]['description'])
                        $result['items'][$i]['description'] = strip_tags($this->unhtmlentities(strip_tags($result['items'][$i]['description'])));
                    // Strip HTML tags and other bullshit from TITLE
                    if ($this->stripHTML && $result['items'][$i]['title'])
                        $result['items'][$i]['title'] = strip_tags($this->unhtmlentities(strip_tags($result['items'][$i]['title'])));
                    // If date_format is specified and pubDate is valid
                    if ($this->date_format != '' && ($timestamp = strtotime($result['items'][$i]['pubDate'])) !==-1) {
                        // convert pubDate to specified date format
                        $result['items'][$i]['pubDate'] = date($this->date_format, $timestamp);
                    }
                    // Item counter
                    $i++;
                }
            }

            $result['items_count'] = $i;
            return $result;
    }


}

?>
