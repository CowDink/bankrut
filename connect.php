<?php
 
$user_name = "root";
$password = "";
$database = "bank";
$host_name = "localhost";

$koneksi = mysqli_connect($host_name, $user_name, $password);
$db  = mysqli_select_db($koneksi, $database);

if(!$koneksi || !$db){
	echo "error";
}

?>