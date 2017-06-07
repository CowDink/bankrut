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

$newMail = $_POST["email"];
$newUser = $_POST["username"];
$newPass = $_POST["password"];
$newPhone = $_POST["phone"];

if($newMail || $newUser || $newPass || $newPhone){
	if($_POST["email"]){
		$sat = mysqli_query($koneksi, "UPDATE accounts SET email = '$newMail' WHERE username = '$uname'");
	}
	if($_POST["username"]){
		$oldName = $uname;
		$dua = mysqli_query($koneksi, "UPDATE accounts SET username = '$newUser' WHERE username = '$uname'");
		$_SESSION['username'] = $newUser;
		rename("../account/".$oldName, "../account/".$newUser);
	}
	if($_POST["password"]){
		$tig = mysqli_query($koneksi, "UPDATE accounts SET password = '$newPass' WHERE username = '$uname'");
	}
	if($_POST["phone"]){
		$empt = mysqli_query($koneksi, "UPDATE accounts SET phone = '$newPhone' WHERE username = '$uname'");
	}
	header('location:../home.php?page=setting&type=success_update_profile'); 
}else{
	//echo "gk work";
	header('location:../home.php?page=setting&type=account'); 
}
?>