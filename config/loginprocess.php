<?php
//error_reporting(0);
session_start();
require_once("../connect.php");
require_once("client_lang.php");
$username = $_POST['username'];
$pass = $_POST['password'];
$checkuser = mysqli_query($koneksi, "SELECT * FROM accounts WHERE username = '$username'");
$user_num = mysqli_num_rows($checkuser);
$result = mysqli_fetch_array($checkuser);
$error = 0;
if($user_num == 0) {
	$error = 1;
} else {
	if($pass <> $result['password']) {
		$error = 1;
	} else {
		$_SESSION['username'] = $result['username'];
		if(!file_exists("../account/".$result['username']."/uploads")){
			mkdir("../account/".$result['username']."/uploads", 0755, true);
			mkdir("../account/".$result['username']."/data", 0755, true);
		}
		header('location:../home.php');
		
	}
}
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
  <title><?=$var_register;?></title>
</head>

<body class="w3-blue w3-center">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>

<!--box-->
<div class="w3-container" style="margin: 100px auto 0 auto;padding:0px 0px 70px 0px;width:300px;">
<?php
if($error == 1){
	echo '<h4>'.$var_not_and_wrong.' '.$var_for.' '.$var_user.' <u><i>'.$username.'</i></u> '.$var_and.' '.$var_pass.' <u><i>'.$pass.'</i></u></h4>';
}else{
	echo '<h4>'.$var_wrong.'</h4>';
}
?>
</div>

<p><a href="../login.php"><?=$var_login;?></a> <?=$var_or;?> <a href="../register.php"><?=$var_register;?></a></p>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
  
    <script src="js/index.js"></script>

</body>
</html>
