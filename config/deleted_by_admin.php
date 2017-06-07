<?php

session_start();
if(isset($_SESSION['username'])) {
	header('location:../index.php'); 
}
require_once('../connect.php');
require_once('client_lang.php');

$acc_type = $user_array['account_type'];
if($acc_type < 3){
	header('location:../home.php?page=admin'); 
}

$id_to_delete = $_GET['id_user_to_delete'];

$query = mysqli_query($koneksi, "DELETE FROM accounts WHERE id = '$id_to_delete'");

if($query){
	header('location:../home.php?page=admin&type=success_delete&id_deleted_user='.$id_to_delete); 
}else{
	header('location:../home.php?page=admin&type=error_delete&id_deleted_user='.$id_to_delete); 
}

?>