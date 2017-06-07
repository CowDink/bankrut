<?php
session_start();
//unset($_SESSION['username']);
if(!isset($_SESSION['username'])) {
	header('location:../login.php'); 
} else { 
	$username = $_SESSION['username'];
}

require_once('client_lang.php');

$acc_type = $user_array['account_type'];

if($acc_type < 3){
	include('../content/admin/denied.php'); 
}

//user data
$uname = $user_array['username'];
$email = $user_array['email'];
$password = $user_array['password'];
$req = $user_array['req'];
$phone = $user_array['phone'];
$status = $user_array['status'];
$gender = $user_array['gender'];

$toEdit = $_POST["username_to_edit"];

$newMail = $_POST["email"];
$newUser = $_POST["username"];
$newPass = $_POST["password"];
$newPhone = $_POST["phone"];
$newReq = $_POST['req'];
$newId = $_POST['id'];
$newGender = $_POST['gender'];
$newAccT = $_POST['account_type'];
$newTheme = $_POST['theme'];
$newLang = $_POST['language'];

if($newMail || $newUser || $newPass || $newPhone || $newReq || $newId || $newGender || $newAcct || $newTheme || $newLang){
	if($_POST["email"]){
		$sat = mysqli_query($koneksi, "UPDATE accounts SET email = '$newMail' WHERE username = '$toEdit'");
	}
	if($_POST["password"]){
		$tig = mysqli_query($koneksi, "UPDATE accounts SET password = '$newPass' WHERE username = '$toEdit'");
	}
	if($_POST["phone"]){
		$empt = mysqli_query($koneksi, "UPDATE accounts SET phone = '$newPhone' WHERE username = '$toEdit'");
	}
	if($_POST["req"]){
		$lim = mysqli_query($koneksi, "UPDATE accounts SET req = '$newReq' WHERE username = '$toEdit'");
	}
	if($_POST["id"]){
		$ena = mysqli_query($koneksi, "UPDATE accounts SET id = '$newId' WHERE username = '$toEdit'");
	}
	if($_POST["gender"]){
		$tjh = mysqli_query($koneksi, "UPDATE accounts SET gender = '$newGender' WHERE username = '$toEdit'");
	}
	if($_POST["account_type"]){
		$dlp = mysqli_query($koneksi, "UPDATE accounts SET account_type = '$newAccT' WHERE username = '$toEdit'");
	}
	if($_POST["theme"]){
		$smbl = mysqli_query($koneksi, "UPDATE accounts SET theme = '$newTheme' WHERE username = '$toEdit'");
	}
	if($_POST["language"]){
		$splh = mysqli_query($koneksi, "UPDATE accounts SET language = '$newLang' WHERE username = '$toEdit'");
	}
	if($_POST["username"]){
		$oldName = $uname;
		$dua = mysqli_query($koneksi, "UPDATE accounts SET username = '$newUser' WHERE username = '$toEdit'");
		rename("../account/".$oldName, "../account/".$newUser);
	}
	header('location:../home.php?page=setting&type=success_update_profile'); 
}else{
	//echo "gk work";
	header('location:../home.php?page=setting&type=account'); 
}
?>