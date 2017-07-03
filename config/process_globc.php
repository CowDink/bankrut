<?php
session_start();
//unset($_SESSION['username']);
if(!isset($_SESSION['username'])) {
	header('location:login.php'); 
} else { 
	$username = $_SESSION['username'];
}
require_once('../connect.php');
require_once('../config/client_lang.php');
$action = $_POST['action'];

$user_rscsnd = mysqli_query($koneksi, "SELECT * FROM accounts WHERE username='$username'");
$sender_info = mysqli_fetch_array($user_rscsnd);
$sender_id = $sender_info['id'];

function timeago($time, $tense='ago') {
    // declaring periods as static function var for future use
    static $periods = array('year', 'month', 'day', 'hour', 'minute', 'second');

    // checking time format
    if(!(strtotime($time)>0)) {
        return trigger_error("Wrong time format: '$time'", E_USER_ERROR);
    }

    // getting diff between now and time
    $now  = new DateTime('now');
    $time = new DateTime($time);
    $diff = $now->diff($time)->format('%y %m %d %h %i %s');
    // combining diff with periods
    $diff = explode(' ', $diff);
    $diff = array_combine($periods, $diff);
    // filtering zero periods from diff
    $diff = array_filter($diff);
    // getting first period and value
    $period = key($diff);
    $value  = current($diff);

    // if input time was equal now, value will be 0, so checking it
    if(!$value) {
        $period = 'seconds';
        $value  = 0;
    } else {
        // converting days to weeks
        if($period=='day' && $value>=7) {
            $period = 'week';
            $value  = floor($value/7);
        }
        // adding 's' to period for human readability
        if($value>1) {
            $period .= 's';
        }
    }

    // returning timeago
    return "$value $period $tense";
}



if($action == "send"){
	$crat = new DateTime('now');
	$date_crat = $crat->format('Y-m-d H:i:s');
	$pesan = $_POST['isi'];
	mysqli_query($koneksi, "INSERT INTO global_chat (id_sender, body, sended_at) VALUES ('$sender_id', '$pesan', '$date_crat')");
}


	$show = mysqli_query($koneksi, "SELECT * FROM global_chat ORDER BY id DESC LIMIT 100");
	while($sunder_data = mysqli_fetch_array($show)){
	$sunder_id = $sunder_data['id_sender'];
	$chat_id = $sunder_data['id'];
	$sunder_info = mysqli_query($koneksi, "SELECT * FROM accounts WHERE id='$sunder_id'");
	$sunder_array = mysqli_fetch_array($sunder_info);
	$sunder_crat = $sunder_data['sended_at'];
	$sunder_name = $sunder_array['username'];
	$sunder_mess = $sunder_data['body'];
	$sunder_gender = $sunder_array['gender'];
	$sunder_type = $sunder_array['account_type'];
	
	switch($sunder_type){
		case 1:
		$sunder_type = $var_normal_user;
		break;
		case 2:
		$sunder_type = $var_moderator;
		break;
		case 3:
		$sunder_type = $var_admin;
		break;
	}
	
	$ppP = __DIR__."/../account/".$sunder_name."/uploads/profile_picture.png";
	if(file_exists($ppP)){
		$ppP = "account/".$sunder_name."/uploads/profile_picture.png";
	}else{
		if($sunder_gender == 1){
			$ppP = "assets/images/male_avatars.png";
		}else{
			$ppP = "assets/images/female_avatars.png";
		} 
	}
	
	if($username == $sunder_name){
		$panel_color = "w3-green";
		$added_bar = '<div class="w3-gray">
		   	<span class="w3-bar-item w3-right"><a href="home.php"><i class="fa fa-trash" style="color:#930006;"></i></a></span>
			   <span class="w3-bar-item w3-margin-right w3-right pencil"><a href="javascript:void(0)"><i class="fa fa-pencil" style="color:#FFD500;"></i></a></span>
			   </div>';
	}else{
		$added_bar = '<div class="w3-gray">
		   	<span class="w3-bar-item w3-right"><a href="home.php"><i class="fa fa-user" style="color:#00f"></i></a></span>
			   <span class="w3-bar-item w3-margin-right w3-right"><a href="home.php"><i class="fa fa-envelope" style="color:#0f0;"></i></a></span>
			   <span class="w3-bar-item w3-margin-right w3-right"><a href="home.php"><i class="fa fa-exclamation-circle" style="color:#930006;"></i></a></span>
	   	</div>';
		if($sunder_gender == 1){
			$panel_color = "w3-blue";
		}else{
			$panel_color = "w3-pink";
		}
	}
	/**
	$script = '<script>
				$(function(){
			   	$("#pencil").click(function(){
				   	alert("test");
			       });
			    });
			   </script>';
	*/
	
	echo '
		<div class=" w3-padding '.$panel_color.' w3-round w3-panel" style="height:60%;">
			<span class="w3-bar-item w3-left"><img src="'.$ppP.'" class="w3-circle" style="width:30px;height:30px;"></img>
				</span><h6 style="margin-left:20px;" class="">&#160&#160'.$sunder_name.'</h6><small class="w3-right w3-text-black"><i>'.$sunder_type.'</i></small>
			<small class="w3-text-dark-gray">'.timeago(date($sunder_crat) ).'</small><br>
   		 <text>'.$sunder_mess.'</text>
   		 '.$added_bar.'
		</div>';
	}

?>