<?php 

session_start();

if(isset($_SESSION['username'])) {
	header('location:index.php'); 
}
require_once('../connect.php');
require_once('client_lang.php');
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
 	 html,body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
  </style>
  <title><?=$var_title;?></title>
</head>

<body class="w3-blue w3-center">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>

<!--box-->
<div class="w3-container" style="margin: 100px auto 0 auto;padding:0px 0px 70px 0px;width:300px;">
<?php
if($var_succes_msg){
	echo '<h4>'.$var_succes_msg.'</h4>';
}else{
	echo '<h4>'.$var_wrong.'</h4>';
}
?>
	<a href="../login.php"><button class="w3-button w3-green"><?=$var_login;?></button></a>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
  
    <script src="js/index.js"></script>

</body>
</html>
