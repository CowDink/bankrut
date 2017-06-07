<?php
$user_key = $_POST['username'];
header('location:../home.php?page=admin&type=control_panel&user_key='.$user_key.'#edit_user_data'); 
?>