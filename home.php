<?php
session_start();
//unset($_SESSION['username']);
if(!isset($_SESSION['username'])) {
	header('location:login.php'); 
} else { 
	$username = $_SESSION['username'];
}
require_once('config/client_lang.php');

$home_dir = __DIR__;

//user data
$uname = $user_array['username'];
$email = $user_array['email'];
$password = $user_array['password'];
$req = $user_array['req'];
$phone = $user_array['phone'];
$status = $user_array['status'];
$gender = $user_array['gender'];
$acc_type = $user_array['account_type'];

$ppPath = "account/".$username."/uploads/profile_picture.png";

if(!file_exists($ppPath)){
	if($gender == 1){
		$ppPath = "assets/images/male_avatars.png";
	}else{
		$ppPath = "assets/images/female_avatars.png";
	}
}


?>

<!DOCTYPE html>
<html>
<title><?=$var_title?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<link rel="icon" href="assets/images/favicon.ico">
<link rel="stylesheet" href="libraries/css/w3.css">
<link  href="libraries/css/cropper.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="libraries/js/jquery.min.js"></script><!-- jQuery is required -->
<!-- Latest compiled JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script src="libraries/js/cropper.js"></script>
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
/*audio { display:none; }*/
</style>
<body class="<?=$theme_body_color;?>">

<!-- Top container -->
<div class="w3-bar w3-top <?=$theme_top_container;?> w3-large" style="z-index:5">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" style="margin-top:3px;" onclick="w3_open();"><i class="fa fa-bars"></i></button>
  <span class="w3-bar-item w3-right"><a href="home.php"><img src="<?=$ppPath;?>" class="w3-circle" style="width:30px;height:30px;"></img></a></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse <?=$theme_sidebar;?> w3-animate-left" style="z-index:4;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <!-- user icon -->
    <div class="w3-col s4">
      <img src="<?=$ppPath;?>" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <!-- dropdown menu -->
    <div class="w3-col s8 w3-bar"><!-- upper sidebar menu -->
      <span><?=$var_welcome;?>, <strong><?=$username?></strong></span><br><!-- welcome -->
      <!-- account drop down menu -->
      <div class="w3-dropdown-hover">
      	<button class="w3-bar-item w3-button w3-center">
      	<i class="fa fa-user"></i>
      	</button><br>
      	<!-- menu -->
     	 <div style="margin-top:15px;" class="w3-dropdown-content w3-bar-block w3-card-4">
     		 <a href="home.php?page=profile" class="w3-bar-item w3-button">Profile</a>
        	  <a href="home.php?page=setting&type=account" class="w3-bar-item w3-button">Account Settings</a>
      	    <a href="home.php?page=setting&type=preference" class="w3-bar-item w3-button">Preference</a>
    		  <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    	  </div><!-- end of menu -->
      </div><!-- end of account drop down menu -->
      <!-- chat drop down menu -->
      <div class="w3-dropdown-hover">
      	<button class="w3-bar-item w3-button w3-center">
      	<i class="fa fa-envelope"></i>
      	</button><br>
      	<!-- menu -->
     	 <div style="margin-top:15px;" class="w3-dropdown-content w3-bar-block w3-card-4">
        	  <a href="#" class="w3-bar-item w3-button">New Chat</a>
      	    <a href="#" class="w3-bar-item w3-button">Inbox</a>
    		  <a href="#" class="w3-bar-item w3-button">Contact</a>
    	  </div><!-- end of menu -->
      </div><!-- end of chat drop down menu -->
	  <!-- setting drop down menu -->
      <div class="w3-dropdown-hover">
      	<button class="w3-bar-item w3-button w3-center">
      	<i class="fa fa-cog"></i>
      	</button><br>
      	<!-- menu -->
     	 <div style="margin-top:15px; padding-left:20;" class="w3-dropdown-content w3-bar-block w3-card-4 w3-margin-right">
        	  <a href="home.php?page=setting" class="w3-bar-item w3-button">Settings</a>
    	  </div><!-- end of menu -->
      </div><!-- end of setting drop down menu -->
    </div><!-- end of drop down menu -->
  </div>
  <hr>
  <!-- dashboard -->
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <!-- main sidebar menu -->
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="home.php?page=overview" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>&#160Overview</a>
    <a href="home.php?page=globc" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>&#160Global Chat</a>
    <a href="home.php?page=traffic" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>&#160belum jadi</a>
    <a href="home.php?page=sample" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>&#160belum jadi</a>
    <audio src="assets/audio/main.ogg" controls autoplay loop>
		audio is not supported
	</audio>
  </div><!-- end of main sidebar menu -->
</nav><!-- end of sidebar menu -->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer;z-index:3;" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main top" style="margin-left:300px;margin-top:43px;">



  <?php
  	$pages_dir = 'content';
  	if(!empty($_GET['page'])){
			$pages = scandir($pages_dir, 0);
			unset($pages[0], $pages[1]);
 
			$p = $_GET['page'];
			if(in_array($p.'.php', $pages)){
				include($pages_dir.'/'.$p.'.php');
			} else {
				echo '<div class="w3-row-padding w3-margin-bottom">
   			       	<div class="w3-quarter">
						  	<br><br><h4>404 Belum jadi</h4>
						  </div>
					  </div>';
			}
		} else {
			include($pages_dir.'/overview.php');
		}
		
		
  ?>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 <?=$theme_sidebar;?>">
    <h6><?=$var_footer_copyright?></h6>
    <p><a href="#top" id="footer">kembali ke atas</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
	
	$(document).ready(function() {
   // jQuery code goes here
    // alert ("hy");
    });
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");
// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>
