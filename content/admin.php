<?php

if($acc_type < 3){
	include('content/admin/denied.php'); 
}else{


  	$pages_dir = __DIR__.'/admin';
  	if(!empty($_GET['type'])){
			$pages = scandir($pages_dir, 0);
			unset($pages[0], $pages[1]);
 
			$p = $_GET['type'];
			if(in_array($p.'.php', $pages)){
				include($pages_dir.'/'.$p.'.php');
			} else {
				echo '<div class="w3-row-padding w3-margin-bottom">
   			       	<div class="w3-quarter">
						  	<br><br><h4>404 Belum jadi</h4>
						  </div>
					  </div>';
			}
		} else {
			include(__DIR__.'/admin/control_panel.php');
		}
		
}
  ?>