<?php 

session_start();

if(isset($_SESSION['username'])) {
	header('location:index.php'); 
}
require_once('../connect.php');
require_once('client_lang.php');

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$error_msg = "";

function randomNumber($length = 20) {
    $num = '';

    for($i = 0; $i < $length; $i++) {
        $num .= mt_rand(0, 9);
    }

    return $num;
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
	for ($i = 0; $i < $length; $i++) {
    	$randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	return $randomString;
}

do{
	$req = randomNumber();
	$checkreq = mysqli_query($koneksi, "SELECT * FROM accounts WHERE req = '$req'");
}while(mysqli_num_rows($checkreq) > 0);

$checkuser = mysqli_query($koneksi, "SELECT * FROM accounts WHERE username = '$username'");
$checkmail = mysqli_query($koneksi, "SELECT * FROM accounts WHERE email = '$email'");


if((mysqli_num_rows($checkuser) > 0)||(mysqli_num_rows($checkmail) > 0)){
	$error_msg = $var_err_msg_acc_true;
}else{
	if($password != $password2){
		$error_msg = $var_different_pass;
	}else{
		$save = mysqli_query($koneksi, "INSERT INTO accounts(email, username, password, phone, req, gender) VALUES('$email', '$username','$password', '$phone', '$req', '$gender')");
		if($save) {
			$user = mysqli_query($koneksi, "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'");
			$userResult = mysqli_fetch_array($user)['username'];
			if(!file_exists("../account/".$userResult."/uploads")){
				mkdir("../account/".$userResult."/uploads", 0755, true);
				mkdir("../account/".$userResult."/data", 0755, true);
			}
			header('location:register_succes.php');
		} else {
			$error_msg = $var_wrong;
		}
	}
}
?>
	
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../libraries/css/w3.css">
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
if($error_msg){
	echo '<h4>'.$error_msg.'</h4>';
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

