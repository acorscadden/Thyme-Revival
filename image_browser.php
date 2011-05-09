<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
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

   define("_CAL_BENCHMARK_", 0);
   define("_CAL_USE_SESSION_", 1);

   require_once(dirname(__FILE__) .'/include/config.php');

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");
   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.url.php");
   require_once(_CAL_BASE_PATH_."include/images.php");

   $_REQUEST['image'] = strip_tags($_REQUEST['image']);
   $_REQUEST['form'] = strip_tags($_REQUEST['form']);

   $relpath = "event_icons"; 
   $dir = $base = dirname(__FILE__) . '/' . $relpath;

   # If we did not get a path and only have one icons directory
   # Just use that..
   ###############################################################
   if(!$_REQUEST['path'] && ($dh = opendir($dir))) {

      $idirs = array();
      while(false !== ($file = readdir($dh))) {

         if(substr($file,0,1) == '.') continue;
          $idirs[] = $file;
      }

      closedir($dh);
      if(count($idirs) == 1 && is_dir($dir.$file)) $_REQUEST['path'] = $idirs[0];
      
   }

   #############
   $path = '/' .str_replace('..','',$_REQUEST['path']);
   $dir .= $path;

   $_cal_html = new _cal_html();

   $_cal_html->print_header(_IMAGE_BROWSER_);

   if(strncmp($dir,$base,strlen($base)) != 0) {
      $dir = $base;
      $_REQUEST['path'] = "";
      $path = '/';
   }


?>
<script language="javascript" type='text/javascript'>

function setIcon(file)
{

   window.opener.document.images['<?php echo($_REQUEST['image']) ?>'].src = '<?php echo(_CAL_BASE_URL_)?>' + file;
   window.opener.document.forms['<?php echo($_REQUEST['form']) ?>'].elements['<?php echo($_REQUEST['image']) ?>'].value = file;

   self.close();


}
</script>
<?php
   if (!($dh = opendir($dir))) {
      echo("<BR>". _ERROR_ .": image_browser.php :: opendir(". $dir .")<br>");
      $_cal_html->print_footer();
      exit;
   }

   echo("<table class='"._CAL_CSS_CAL_CONTENT_."' cellpadding=4 cellspacing=4>\n");

   if(!$idirs[0])
   echo("<tr><td colspan=7><a href='javascript:history.go(-1)'>&lt;-- ". _PREV_ ."</a></td></tr>\n");

   echo("<tr>\n");
       
   $i = 0;

   /* This is the correct way to loop over the directory. */
   while (false !== ($file = readdir($dh))) { 

       if(substr($file,0,1) == '.') {
          continue;
       }

       if(is_dir($dir ."/". $file)) {

          $url = new _cal_url();
          $url->addArg("path", $_REQUEST['path']. "/". $file);
          $url->addArg("image", $_REQUEST['image']);
          $url->addArg("form", $_REQUEST['form']);

          echo("</tr><tr><td colspan=7>");
          echo("<a class='"._CAL_CSS_ULINE_."' href='". $url->toString() ."'>$file</a></td></tr><tr>");
          $i++;
          continue;
       }

       switch (strtolower(substr($file, -4))) {

          case '.jpg':
          case '.png':
          case '.gif':

             if($i % 10 == 0 && $i > 0) {
                echo("</tr><tr>");
             }
             echo("<td>"); 
             echo("<a href='javascript:setIcon(\"". $relpath . $path ."/". $file ."\")'>");
             echo(_ex_img_str($relpath . $path ."/". $file,_ICON_));
             echo("</a>");
             echo("</td>");
             $i++;
             break;
       }
   }

   closedir($dh);

   echo("\n</tr>\n</table>");


   $_cal_html->print_footer();
?>
