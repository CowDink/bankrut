<?php
function getUserLanguage() {
	$langs = array();
	
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		// break up string into pieces (languages and q factors)
		preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
		if (count($lang_parse[1])) {
			// create a list like â??enâ?? => 0.8
			$langs = array_combine($lang_parse[1], $lang_parse[4]);
			// set default to 1 for any without q factor
			foreach ($langs as $lang => $val) {
				if ($val === ''){
			   	 $langs[$lang] = 1;
				}
			}
			// sort list based on value
			arsort($langs, SORT_NUMERIC);
		}
	}
	
	//extract most important (first)
	foreach ($langs as $lang => $val){ 
		break; 
	}

	//if complex language simplify it
	if (stristr($lang,"-")){
		$tmp = explode("-",$lang); 
		$lang = $tmp[0]; 
	}
	
	return $lang;
}

$method = 1;
$lang = getUserLanguage();

$theme_normal = __DIR__.'/../var/theme_normal.php';
$theme_night = __DIR__.'/../var/theme_night.php';

$lang_id = __DIR__.'/../var/language_bahasa.php';
$lang_en = __DIR__.'/../var/language_english.php';
$lang_jv = __DIR__.'/../var/language_javanese.php';


//set language to user setting if exist
if(isset($_SESSION['username'])) {
	require_once(__DIR__."/../connect.php");
	$username = $_SESSION['username'];
	$user_resource = mysqli_query($koneksi, "SELECT * FROM accounts WHERE username = '$username'");
	$user_array = mysqli_fetch_array($user_resource);
	$user_lang = $user_array['language'];
	$user_theme = $user_array['theme'];
	if($user_lang == 0){
		//if user dont setting the language
		$method = 1;
	}else{
		//if user already setting the language
		$method = 2;
	}
	
	if($user_theme <= 1){
		include($theme_normal);
	}else{
		include($theme_night);
	}
			
}else{
	include($theme_normal);
}


//method 1
if($method == 1){
	if($lang == "id"){
		if(file_exists($lang_id)){
			include($lang_id);
		}else{
			include($lang_en);
		}
	}else if($lang == "jv"){
		if(file_exists($lang_jv)){
			include($lang_jv);
		}else{
			include($lang_en);
		}  
	}else{
		include($lang_en);
	}
//method 2
}else{
	if($user_lang == 1){
		include($lang_en);
	}
	if($user_lang == 2){
		include($lang_id);
	}
	if($user_lang == 3){
		include($lang_jv);
	}
}

?>
	
