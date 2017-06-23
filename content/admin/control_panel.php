<?php
function folderSize ($dir)
{
    $size = 0;
    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : folderSize($each);
    }
    return $size;
}
$ds = number_format(floor(folderSize($home_dir)/1024), 0, ',', '.');
$all_user = array();
$pi = 0;
$all_user_resource = mysqli_query($koneksi, "SELECT * FROM accounts");

						
$account_registered = mysqli_num_rows($all_user_resource);

?>


<!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-laptop"></i> Control Panel</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$account_registered;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Account Registered</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div style="max-height:200;" class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-hdd-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$ds;?> KB</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Resource Uses</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-product-hunt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>2450800</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total User Points</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-gamepad w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>1</h3>
        </div>
        <div class="w3-clear"></div>
        <h4 id="edit_user_data">Games Available</h4>
      </div>
    </div>
  </div>
  <hr>

<div class="w3-row-padding w3-margin-bottom w3-center">
  <div class="w3-container">
  	<h5>Edit User Data</h5>
    <div class="w3-row">
      <style>td{width:60%;}td#input{width:40%;}</style>
      <div class="w3-container w3-margin-right">
      	<table class="w3-table">
      		<form action="config/get_user_data_admin.php" method="POST">
      			<tr>
      				<td>
      				 <input value="" list="browsers" type="search" name="username" placeholder="Search accounts..." class="w3-input w3-left w3-middle ".$theme_body_color."" autocomplete="off">
  					 	<datalist id="browsers">
  							<?php
  					     	while ($data_user = mysqli_fetch_array($all_user_resource)){ 
  								 $all_user[$pi] = $data_user;
  							 	echo '<option value="'.$all_user[$pi]['id'].'">';
  								 echo '<option value="'.$all_user[$pi]['username'].'">';
  								 echo '<option value="'.$all_user[$pi]['req'].'">';
  								 echo '<option value="'.$all_user[$pi]['email'].'">';
  								 $pi++;
  						 	}
  							 ?>
    				  	</datalist>
  					</td>
      			</tr>
      		    <tr>
   				  <td>
   					 <input type="submit" name="submit" class="w3-button w3-green" value="Search" style="width:120px;"></input><!-- End Btn -->
   				  <!--</td>-->
   				  <!--<td>-->
   				  	<p class="w3-opacity w3-medium" id="result">*Note: you can search by id, req, username, or email</p>
   				  </td>
   			   </tr>
   			</form>
   		</table>
      </div>
      		<?php
   			 	if(isset($_GET['user_key'])){
						$user_search_result = $_GET['user_key'];
						
						//in_array() multidimensional array function
						function in_array_r($needle, $haystack, $strict = false) {
   						 foreach ($haystack as $item) {
      						  if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
      						      return true;
       						 }
  						  }

  						  return false;
						}
					
						if($user_search_result){
							if(in_array_r($user_search_result, $all_user)){
								$user_search_resource = mysqli_query($koneksi, "SELECT * 
																				FROM accounts 
																				WHERE username = '$user_search_result' 
																				OR id = '$user_search_result' 
																				OR email = '$user_search_result' 
																				OR req = '$user_search_result'");
								$user_search_array = mysqli_fetch_array($user_search_resource);
								
								$uppPath = "account/".$user_search_array['username']."/uploads/profile_picture.png";

								if(!file_exists($uppPath)){
									if($user_search_array['gender'] == 1){
										$uppPath = "assets/images/male_avatars.png";
									}else{
										$uppPath = "assets/images/female_avatars.png";
									}
								}
								
								echo '<div class="w3-col m2 text-center">
        							  	<img class="w3-circle" src="'.$uppPath.'" style="width:96px;height:96px;"><br>
       							  	 <h4 class="">'.$user_search_array['username'].'</h4>
      								</div>';
      						  echo '<div class="w3-container">';
								echo "<form action=\"config/update_user_data_by_admin.php\" method=\"POST\">";
								echo "<label class=\"w3-left\">Id : ".$user_search_array['id']."</label><br>";
								echo "<input type=\"number\" maxlength=\"16\" name=\"id\" placeholder=\"id\" class=\"w3-input w3-left w3-middle  ".$theme_body_color."\"/><br>";
								echo "<label class=\"w3-left\" style=\"padding-top:10px;\">Req : ".$user_search_array['req']."</label><br>";
								echo "<input type=\"number\" maxlength=\"16\" name=\"req\" placeholder=\"req\" class=\"w3-input w3-left w3-middle  ".$theme_body_color."\"/><br>";
								echo "<label class=\"w3-left\" style=\"padding-top:10px;\">Email : ".$user_search_array['email']."</label><br>";
								echo "<input type=\"email\" maxlength=\"256\" name=\"email\" placeholder=\"email\" class=\"w3-input w3-left w3-middle  ".$theme_body_color."\"/><br>";
								echo "<label class=\"w3-left\" style=\"padding-top:10px;\">Username : ".$user_search_array['username']."</label><br>";
								echo "<input type=\"text\" maxlength=\"20\" name=\"username\" placeholder=\"username\" class=\"w3-input w3-left w3-middle  ".$theme_body_color."\"/><br>";
								echo "<input type=\"hidden\" maxlength=\"20\" name=\"username_to_edit\" placeholder=\"username\" value=\"".$user_search_array['username']."\" class=\"w3-input w3-left w3-middle  ".$theme_body_color."\"/>";
								echo "<label class=\"w3-left\" style=\"padding-top:10px;\">Password : ".$user_search_array['password']."</label><br>";
								echo "<input type=\"text\" maxlength=\"256\" name=\"password\" placeholder=\"password\" class=\"w3-input w3-left w3-middle ".$theme_body_color."\"/><br>";
								echo "<label class=\"w3-left\" style=\"padding-top:10px;\">Phone : ".$user_search_array['phone']."</label><br>";
								echo "<input type=\"tel\" maxlength=\"20\" name=\"phone\" placeholder=\"phone\" class=\"w3-input w3-left w3-middle  ".$theme_body_color."\"/><br>";
								echo "<label class=\"w3-left\" style=\"padding-top:10px;\">Gender : ".(($user_search_array['gender'] == 1)? $var_male:$var_female)."</label><br>";
								echo '<select name="gender" class="w3-input w3-center w3-middle '.$theme_body_color.'" >
 						 				<option value="1" '.(($user_search_array["gender"] == 1)? "selected=selected":"").'>Male</option>
						 				 <option value="2" '.(($user_search_array["gender"] == 2)? "selected=selected":"").'>Female</option>
					  				</select><br>';
								echo "<label class=\"w3-left\">Language : ".(($user_search_array["language"] == 1)? $var_english:(($user_search_array["language"] == 2)? $var_bahasa:(($user_search_array["language"] == 3)? $var_jawa: (($lang == "en")? $var_english:(($lang == "id")? $var_bahasa:(($lang == "jv")? $var_jawa:$var_english)))))). "</label><br>";
								echo '<select name="language" class="w3-input w3-center w3-middle '.$theme_body_color.'" >
 						 				<option value="1" '.(($user_search_array["language"] == 1)? "selected=selected":"").'>'.$var_english.'</option>
						 				 <option value="2" '.(($user_search_array["language"] == 2)? "selected=selected":"").'>'.$var_bahasa.'</option>
										  <option value="3" '.(($user_search_array["language"] == 3)? "selected=selected":"").'>'.$var_jawa.'</option>
					  				</select><br>';
								echo "<label class=\"w3-left\">Theme : ".(($user_search_array["theme"] == 1)? $var_theme_normal:$var_theme_dark)."</label><br>";
								echo '<select name="theme" class="w3-input w3-center w3-middle '.$theme_body_color.'" >
 						 				<option value="1" '.(($user_search_array["theme"] == 1)? "selected=selected":"").'>'.$var_theme_normal.'</option>
						 				 <option value="2" '.(($user_search_array["theme"] == 2)? "selected=selected":"").'>'.$var_theme_dark.'</option>
					  				</select><br>';
								echo "<label class=\"w3-left\">Account Type : ".(($user_search_array["account_type"] == 1)? $var_normal_user:(($user_search_array["account_type"] == 2)? $var_moderator:(($user_search_array["account_type"] == 3)? $var_admin:$var_wrong)))."</label><br>";
								echo '<select name="account_type" class="w3-input w3-center w3-middle '.$theme_body_color.'" >
 						 				<option value="1" '.(($user_search_array["account_type"] == 1)? "selected=selected":"").'>'.$var_normal_user.'</option>
						 				 <option value="2" '.(($user_search_array["account_type"] == 2)? "selected=selected":"").'>'.$var_moderator.'</option>
										  <option value="3" '.(($user_search_array["account_type"] == 3)? "selected=selected":"").'>'.$var_admin.'</option>
					  				</select><br>';
								echo '<input type="submit" class="w3-button w3-left w3-green" style="width:130px;" value="'.$var_update.'"></input>';
								echo '<input type="reset" class="w3-button w3-left w3-margin-left w3-deep-orange" style="width:130px;" value="'.$var_reset.'"></input>';
								echo "</form>";
								echo '<button class="w3-button w3-right w3-margin-top w3-red" style="width:100%;" onclick="deleteAlert()">Delete this account</button>';
								echo '<div class="w3-container">';
								echo '<script>function deleteAlert(){
											  	if(confirm("Do you really want to delete this account?")){
														window.location.href = "home.php?page=admin&type=delete&to_delete='.$user_search_array['id'].'";
												  }else{}
											  }
									  </script>';
							}else{
								echo "Sorry, we don't find anything";
							}
						}else{
							echo "You don't type anything huh..";
						}
					}
   			?>
    </div>
  </div>
</div>
<hr>
<div class="w3-row-padding w3-margin-bottom w3-center">
	<div class="w3-container">
  	<h5>Create Account</h5>
      <div class="w3-row">
     	 <style>td{width:60%;}td#input{width:40%;}</style>
     	 <div class="w3-container w3-margin-right">
     		<form method="post" action="config/regerror.php">

				<!--<h1 class="w3-opacity-min"><?=$var_register;?></h1>-->
				
				<input type="email" maxlength="256" name="email" placeholder="email" class="w3-input w3-center w3-middle <?=$theme_body_color?>" required/>

				<input type="text" maxlength="10" name="username" placeholder="username" class="w3-input w3-center w3-middle <?=$theme_body_color?>" style="margin-top:6px;" required/>

				<input type="password" maxlength="30" name="password" placeholder="password" class="w3-input w3-center w3-middle <?=$theme_body_color?>" style="margin-top:6px;" required/>

				<input type="password" maxlength="30" name="password2" placeholder="re-type password" class="w3-input w3-center w3-middle <?=$theme_body_color?>" style="margin-top:6px;" required/>

				<input type="text" maxlength="20" name="phone" placeholder="phone (optional)" class="w3-input w3-center w3-middle <?=$theme_body_color?>" style="margin-top:6px;"/>

				<select name="gender" class="w3-input w3-center w3-middle <?=$theme_body_color?>" required>
 				 <option value="1">Male</option>
 				 <option value="2">Female</option>
				</select>
				
				<select name="language" class="w3-input w3-center w3-middle <?=$theme_body_color?>" required>
 				 <option value="1"><?=$var_english?></option>
 				 <option value="2"><?=$var_bahasa?></option>
 				 <option value="2"><?=$var_jawa?></option>
				</select>
				
				<select name="theme" class="w3-input w3-center w3-middle <?=$theme_body_color?>" required>
 				 <option value="1"><?=$var_theme_normal?></option>
 				 <option value="2"><?=$var_theme_dark?></option>
				</select>
				
				<select name="acc_type" class="w3-input w3-center w3-middle <?=$theme_body_color?>" required>
 				 <option value="1"><?=$var_normal_user?></option>
 				 <option value="2"><?=$var_moderator?></option>
 				 <option value="3"><?=$var_admin?></option>
				</select>

				<input type="submit" class="w3-button w3-green" value="<?=$var_register;?>" style="width:120px;margin-top:15px;"></input><!-- End Btn -->

			</form>

     	 </div>
      </div>
    </div>
</div>
<hr>
  <div class="w3-container">
    <h5>General Stats</h5>
    <p>New Visitors</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
    </div>

    <p>New Users</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
    </div>

    <p>Bounce Rate</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
    </div>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Countries</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
      <tr>
        <td>United States</td>
        <td>65%</td>
      </tr>
      <tr>
        <td>UK</td>
        <td>15.7%</td>
      </tr>
      <tr>
        <td>Russia</td>
        <td>5.6%</td>
      </tr>
      <tr>
        <td>Spain</td>
        <td>2.1%</td>
      </tr>
      <tr>
        <td>India</td>
        <td>1.9%</td>
      </tr>
      <tr>
        <td>France</td>
        <td>1.5%</td>
      </tr>
    </table><br>
    <button class="w3-button w3-dark-grey">More Countries  <i class="fa fa-arrow-right"></i></button>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Recent Users</h5>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <img src="/w3images/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Mike</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar5.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jill</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar6.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jane</span><br>
      </li>
    </ul>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Recent Comments</h5>
    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar3.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
        <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar1.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>
  </div>
  <br>
  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
      </div>
    </div>
  </div>
