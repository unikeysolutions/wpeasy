<?php
/* */ 
include 'classes/core.php';
/* */
$Sync = new Core;
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
   $Sync->RenamedTheme(realpath(dirname(__FILE__)),$_GET['themeq']);
   $Sync->ChangeStyle(realpath(dirname(__FILE__)),$_GET['themeq'],$_GET['names'],$_GET['url'],$_GET['desp'],$_GET['aut'],$_GET['ver']);
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
  $Sync->rrmdir('classes');
  header("location:index.php");
}
  break;
  default:
   $Sync->HtChange(realpath(dirname(__FILE__)));
    header("location:?step=1");
    break;
}
 
?>

 <!doctype html>
<html lang="tr">
  <head>
    <title>Wordpress Sync System of UNIWEB</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="classes/style.css"  >
  </head>
  <body  style="background-color:#03041a;">
  
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
           <p class="card-text text-right"><small class="text-danger">By Unicoder / UNIWEB</small> </p>
         </div>
       </div>
       </div>
       <div class="col-md-4">
       
       </div> 
      
      </div>
    </div>
    <!-- Container -->
    <div class="container protected" style="padding-top:15px;">
      <div class="row">
       <div class="col-md-1">
       
       </div>
       <div class="col-md-10">
       <div class="card border-info">
            <?php 
$max_time = ini_get("max_execution_time");
  echo '<div class="card-header"><small class="text-danger">
  Important ! Max Execution Time : > 300 | Your Value is Set to : '. $max_time.'</small></div>';
        ?>
      
    
         <div class="card-body">
          <?php
switch (@$_GET['step']) {
  case '1':
?>
<div class="container text-center no-reveal">
 
 
      <h4>Starting Wordpress Sync</h4>
   
      <a href="?step=1&o=1" title="Create your Bootstrap themes in minutes" class="fancy-button is-big">Go and fork in  Github </a>

      <p>
 
      </p>
    </div>
 
  <?php
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

   <div align="right "> <input type="submit"  class="btn btn-primary btn-sm" value="Next">  </div> 
 
</form>  

</div> 
<div class="col-md-2 protected">
       
       </div>  
          <div align="right"> <a   class="fancy-button" style="padding:10px 17px 3px 20px;" href="?step=3" > Skip </a></div> 
<?php
 
    break;
  case '3':
  echo '<h4 class="text-center text-warning ">Clear Junk Files</h4><br> <center><div class="protected"><a   href="?step=3&o=1"   class="fancy-button" >Start</a> </div></center>';
    break;
  case '4':
  echo '<h4 class="text-center text-success">Successful , Wordpress is Synchronized.. </h4><br>  <center><div class="protected"><a   href="?step=4&o=1"  class="fancy-button" >Destroy Me!</a> </div></center>';
  
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
 