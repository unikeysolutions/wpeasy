<?php
 
class Core 
{

    public static function extractZipArchive($archive, $destination) {
   
        if (!class_exists('ZipArchive')) {
          $GLOBALS['status'] = array('error' => 'Error: Your PHP version does not support unzip functionality.');
          return;
        }
    
        $zip = new ZipArchive;
    
        // Check if archive is readable.
        if ($zip->open($archive) === TRUE) {
          // Check if destination is writable
          if (is_writeable($destination . '/')) {
            $zip->extractTo($destination);
            $zip->close();
            $GLOBALS['status'] = array('success' => 'Files unzipped successfully');
          }
          else {
            $GLOBALS['status'] = array('error' => 'Error: Directory not writeable by webserver.');
          }
        }
        else {
          $GLOBALS['status'] = array('error' => 'Error: Cannot read .zip archive.');
        }
      }
    function HtChange($path)
{
    $fp = fopen($path.'/.htaccess','a+');
    if($fp)
    {
        fwrite($fp,'
RewriteEngine On
RewriteRule .* - [E=noconntimeout:1]
RewriteRule .* - [E=noabort:1]
      ');
    }
}

     public function GetZip($download_url)
     {
 
        $file = "wordpress.zip";
        $script = basename($_SERVER['PHP_SELF']);
        file_put_contents($file, fopen($download_url, 'r'));
        $path = pathinfo(realpath($file), PATHINFO_DIRNAME); 
       $this->extractZipArchive($file ,$path    );
     }
     function rrmdir($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                rrmdir($file);
            else
                unlink($file);
        }
        rmdir($dir);
    } 
     public function RenamedTheme($path,$newname)
     {
        rename($path.'/wp-content/themes/kallyas',$path.'/wp-content/themes/'.$newname);
        rename($path.'/wp-content/themes/kallyas-child',$path.'/wp-content/themes/'.$newname.'-child');
     }
     public function ChangeStyle($path,$tname,$name,$urli,$desp,$out,$ver)
     {
      
      $fulldir=$path.'/wp-content/themes/'.$tname.'/style.css';
      $fullchilddir=$path.'/wp-content/themes/'.$tname.'-child/style.css';
      unlink( $fulldir);
     $FULLcss=<<<WEO
     /*
     Theme Name: %themename%
     Theme URI: %themeurl%
     Description: %themedesp%
     Author: %themeaut%
     Author URI: https://www.uniwebsolutions.com
     Version: 4.16.9
     Tags: left-sidebar, right-sidebar, custom-background, custom-colors, custom-header, custom-menu, editor-style, full-width-template, theme-options, translation-ready
     License: GNU General Public License
     License URI: license.txt
     Text Domain: zn_framework
     */
     
     /*
       ** PLEASE DON'T ADD ANY CSS HERE !!!
       This file will be overwritten on updates and your CSS will be lost.
      
     */
WEO;
$FULLcssChild='
/*
Theme Name:     %themename% Child Theme
Theme URI:      %themeurl%
Description:    %themedesp%
Author:         %themeaut%
Author URI:     https://www.uniwebsolutions.com
Template:       %themename%
Version:        1.0
Tags: dark, light, left-sidebar, right-sidebar, fluid-layout, custom-background, custom-colors, custom-header, custom-menu, editor-style, full-width-template, theme-options, translation-ready
Text Domain:  zn_framework
*/
';       
      $FULLcss=str_replace("%themename%",$name,$FULLcss);
      $FULLcss=str_replace("%themeurl%",$urli,$FULLcss);
      $FULLcss=str_replace("%themedesp%",$desp,$FULLcss);
      $FULLcss=str_replace("%themeaut%",$out,$FULLcss);
      $FULLcssChild=str_replace("%themename%", strtolower($name),$FULLcssChild);
      $FULLcssChild=str_replace("%themeurl%",$urli,$FULLcssChild);
      $FULLcssChild=str_replace("%themedesp%",$desp,$FULLcssChild);
      $FULLcssChild=str_replace("%themeaut%",$out,$FULLcssChild);
 
      touch($fulldir);
      touch($fullchilddir);
      $dq=fopen($fulldir,"w");
      fwrite($dq,$FULLcss);
      fclose($dq);
      $fq=fopen($fullchilddir,"w");
      fwrite($fq,$FULLcssChild);
      fclose($fq);
     }

}