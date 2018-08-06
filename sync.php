<?php
/* */ 
 
/* */
class SyncMaster  
{
     public function GetZip($download_url)
     {
 
        $file = "wordpress.zip";
        $script = basename($_SERVER['PHP_SELF']);
        file_put_contents($file, fopen($download_url, 'r'));
        $path = pathinfo(realpath($file), PATHINFO_DIRNAME); 
        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE) {
          $zip->extractTo($path);
          $zip->close();
        } else {
          echo "Couldn't open $file";
        }
     }
    
     public function RenamedTheme($newname)
     {
        rename(realpath(dirname(__FILE__)).'/wp-content/themes/kallyas',realpath(dirname(__FILE__)).'/wp-content/themes/'.$newname);
        rename(realpath(dirname(__FILE__)).'/wp-content/themes/kallyas-child',realpath(dirname(__FILE__)).'/wp-content/themes/'.$newname.'-child');
     }
     public function ChangeStyle($tname,$name,$urli,$desp,$out,$ver)
     {
      
      $fulldir=realpath(dirname(__FILE__)).'/wp-content/themes/'.$tname.'/style.css';
      $fullchilddir=realpath(dirname(__FILE__)).'/wp-content/themes/'.$tname.'-child/style.css';
      unlink( $fulldir);
     $FULLcss=<<<WEO
     /*
     Theme Name: %themename%
     Theme URI: %themeurl%
     Description: %themedesp%
     Author: %themeaut%
     Author URI: https://uniwebsolutions.com
     Version: 4.15.14
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
Author URI:     https://uniwebsolutions.com
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
$Sync = new SyncMaster;
switch (@$_GET['step']) {
  case '1':
   if(isset($_GET['o'])){
   $Sync->GetZip("https://github.com/unikeysolutions/wpeasy/blob/master/easywp.zip?raw=true");
   sleep(5);
   header("location:?step=2");
   }
    
    break;
   case '2':
   if(isset($_GET['b'])){
   $Sync->RenamedTheme($_GET['themeq']);
   $Sync->ChangeStyle($_GET['themeq'],$_GET['names'],$_GET['url'],$_GET['desp'],$_GET['aut'],$_GET['ver']);
   header("location:?step=3");
  }
   break;
   case '3':
   if(isset($_GET['o'])){
  
   unlink('license.txt');
   unlink('readme.html');
   header("location:?step=4");
  }
   break;
  case '4':
  if(isset($_GET['o'])){
  unlink($_SERVER["SCRIPT_FILENAME"]);
  unlink('wordpress.zip');
  header("location:index.php");
}
  break;
  default:
    header("location:?step=1");
    break;
}
 
?>

 <!doctype html>
<html lang="tr">
  <head>
    <title>Wordpress Sync System</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css"  >
  </head>
  <body  >
  
  <!-- Container Header -->  
    <div class="container" style="padding-top:15px;">
      <div class="row">
       <div class="col-md-4">
       
       </div>
       <div class="col-md-4">
       <div class="card border-success">
         <img class="card-img-top" src="holder.js/100px180/" alt="">
         <div class="card-body">
           <h4 class="card-title text-center"><p class="text-info">Wordpress Sync System</p></h4>
           <p class="card-text text-right"><small class="text-danger">By Unicoder</small> </p>
         </div>
       </div>
       </div>
       <div class="col-md-4">
       
       </div> 
      
      </div>
    </div>
    <!-- Container -->
    <div class="container" style="padding-top:15px;">
      <div class="row">
       <div class="col-md-1">
       
       </div>
       <div class="col-md-10">
       <div class="card border-info">
            <?php 
$max_time = ini_get("max_execution_time");
  echo '<div class="card-header">Important ! Max Execution Time : > 300 Your Set : '. $max_time.'</div>';
        ?>
      
    
         <div class="card-body">
          <?php
switch (@$_GET['step']) {
  case '1':

  echo '<h4 class="text-center text-warning">Starting Wordpres Sync</h4><br> <center><a type="button" href="?step=1&o=1" class="btn btn-info btn-xs">Start</a> </center> ';
    break;
  case '2':
?>
    <div class="row">
       <div class="col-md-3">
       
       </div>
       <div class="col-md-6">
       
       <h4 class="text-center text-warning">Change Theme Variables</h4><br>
<form method="get" action="">
 
  <div class="form-group row">
      <label for="theme" class="col-sm-6 col-form-label text-info">Theme Folder Name:</label>
      <div class="col-sm-6">
        <input type="text"   class="form-control " id="theme" name="themeq" placeholder="rok">
      </div>
    </div>
    <div class="form-group row">
      <label for="theme" class="col-sm-6 col-form-label text-info">Theme Name:</label>
      <div class="col-sm-6">
        <input type="text"   class="form-control " id="theme" name="names" placeholder="rok">
      </div>
    </div>
    <div class="form-group row">
      <label for="theme" class="col-sm-6 col-form-label text-info">Theme URI:</label>
      <div class="col-sm-6">
      <?php 
  $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

?>
        <input type="text"   class="form-control " id="theme" name="url" value="<?php echo $actual_link; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="theme" class="col-sm-6 col-form-label text-info">Description:</label>
      <div class="col-sm-6">
        <input type="text"   class="form-control " id="theme" name="desp" value="  Line Wordpress theme">
      </div>
    </div>
    <div class="form-group row">
      <label for="theme" class="col-sm-6 col-form-label text-info">Author:</label>
      <div class="col-sm-6">
        <input type="text"   class="form-control " id="theme" name="aut" value="UNIWEB">
      </div>
    </div>
    
    <input type="hidden" name="b" value="1"> 
    <input type="hidden" name="step" value="2"> 
   <div align="right"> <input type="submit" class="btn btn-success" value="Next">  </div> 
 
</form>  
</div> 
<div class="col-md-2">
       
       </div>  
<?php
 
    break;
  case '3':
  echo '<h4 class="text-center text-warning">Clear Junk Files</h4><br> <center><a type="button" href="?step=3&o=1" class="btn btn-info btn-xs">Start</a> </center>';
    break;
  case '4':
  echo '<h4 class="text-center text-success">Successfull , Wordpress is Synchronized.. </h4><br>  <center><a type="button" href="?step=4&o=1" class="btn btn-danger btn-xs">Destroy Me!</a> </center>';
  
    break;
  default:
   header("location:?step=1");
    break;
}
?>
         </div>
       </div>
       </div>
       <div class="col-md-1">
       
       </div>
     </div>
    </div>
    <!-- Optional JavaScript -->
    </div>
   
 
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"  ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"  ></script>
  </body>
</html>
 
