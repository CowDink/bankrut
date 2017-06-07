<?php
session_start();
//unset($_SESSION['username']);
if(!isset($_SESSION['username'])) {
	header('location:../login.php'); 
} else { 
	$username = $_SESSION['username'];
}
require_once('client_lang.php');

//user data
$uname = $user_array['username'];
$email = $user_array['email'];
$password = $user_array['password'];
$req = $user_array['req'];
$phone = $user_array['phone'];
$status = $user_array['status'];
$gender = $user_array['gender'];

$newTheme = $_POST["theme"];
$newLang = $_POST["lang"];

if($newTheme || $newLang){
	if($_POST["theme"]){
		$sat = mysqli_query($koneksi, "UPDATE accounts SET theme = '$newTheme' WHERE username = '$uname'");
	}
	if($_POST["lang"]){
		$empt = mysqli_query($koneksi, "UPDATE accounts SET language = '$newLang' WHERE username = '$uname'");
	}
	header('location:../home.php?page=setting&type=preference'); 
}else{
	//echo "gk work";
	header('location:../home.php?page=setting&type=preference'); 
}
?>