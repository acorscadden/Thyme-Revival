<?php

function _ex_img_str($src,$alt = _ICON_,$ht = null, $wt = null)
{

   # HANDLE PNGS
   ################
   if(substr(strtolower($src),-4) == '.png' && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {

      $img_style = ($ht ? "width: {$wt}px; height: {$ht}px; " : "") ." filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{$src}', sizingMethod='".($ht ? "scale" : "image") ."');";
      $src = _CAL_BASE_URL_."images/spacer.png";

   }


   $img_style = "style=\"padding: 0px; margin: 0px; border: 0px; vertical-align: middle; {$img_style}\"";
   

   $alt = str_replace("'","\\'",$alt);

   return "<img alt='$alt' title='$alt' ". ($ht ? "height={$ht} width={$wt} " : "") ."{$img_style} src='{$src}' border=0>";

}

?>
