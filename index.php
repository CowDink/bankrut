<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location:login.php'); 
} else { 
	header('location:home.php');
}
?>

<html>
<head>
<link rel="icon" href="assets/images/favicon.ico">
</head>
<body>
</body>
</html>