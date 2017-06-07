<?php 

session_start();
if(isset($_SESSION['username'])) {
	header('location:index.php'); 
}
require_once("connect.php");
require_once('config/client_lang.php');
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon.ico">
  <link rel="stylesheet" href="libraries/css/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
 	 html,body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
  </style>
  <title><?=$var_login;?></title>
</head>

<body class="w3-blue w3-center">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>

<!--box-->
<div class="w3-container" style="margin: 0 auto 0 auto;padding:0px 0px 70px 0px;width:300px;">
<form method="post" action="config/loginprocess.php">

<h1 class="w3-opacity-min"><?=$var_login;?></h1>
<div class="w3-group">
<input type="text" maxlength="10" name="username" placeholder="username" class="w3-input w3-center w3-middle w3-blue" required/>

<input type="password" maxlength="30" name="password" placeholder="password" class="w3-input w3-center w3-middle w3-blue" style="margin-top:6px;" required/>
</div>
<input type="submit" class="w3-button w3-green" value="<?=$var_login;?>" style="width:120px;margin-top:15px;"></input><!-- End Btn -->

</form>

<p class="w3-opacity-min"><?=$var_dont_have_account;?> <a href="register.php"><?=$var_register;?> </a><?=$var_now;?></p>

</div>
<div class="w3-container" style="margin: 0 auto 0 auto;padding:0px 0px 70px 0px;width:200px;">
	<h4>You may also like</h4>
	<ul align="left">
		<li><a href="jump_box/index.html">Jump Box</a></li>
	</ul>
	
</div>

  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
  
    <script src="js/index.js"></script>

</body>
</html>
