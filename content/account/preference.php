<div class="w3-row-padding w3-margin-bottom w3-center">
  <div class="w3-container">
    <h3><?=$var_preference_setting;?></h3>
    	 <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="<?=$ppPath;?>" style="width:96px;height:96px;"><br>
        <h4 class=""><?=$username;?></h4>
      </div>
      
      <br>
      <div class="w3-center w3-col m10 w3-container" style="width:50%">
		<p class="w3-opacity w3-left w3-medium" style="padding:;"><?=$req;?></p>
	  </div>
      <style>td{width:60%;}td#input{width:40%;}select{padding-bottom:10px;}</style>
      <div class="w3-container">
      	<table class="w3-table">
      		<form action="config/update_preference.php" method="POST">
      			<tr>
      				<label class="w3-left"><?=$var_theme;?></label>
      				<select name="theme" class="w3-input w3-center w3-middle <?=$theme_sidebar;?>" required>
 						 <option value="1" <?php if($user_theme == 1){echo "selected=selected";}?>><?=$var_theme_normal;?></option>
						  <option value="2" <?php if($user_theme == 2){echo "selected=selected";}?>><?=$var_theme_dark;?></option>
					  </select>
				  </tr>
				  <tr><br>
					 <label class="w3-left"><?=$var_lang;?></label>
			 		<select name="lang" class="w3-input w3-center w3-middle <?=$theme_sidebar;?>" required>
 					 	<option value="1" <?php if($user_lang == 1 || $lang == "en"){echo "selected=selected";}?>><?=$var_english;?></option>
  						<option value="2" <?php if($user_lang == 2 || $lang == "id"){echo "selected=selected";}?>><?=$var_bahasa;?></option>
   					   <option value="3" <?php if($user_lang == 3 || $lang == "jv"){echo "selected=selected";}?>><?=$var_jawa;?></option>
					 </select>
				  </tr>
				  <tr>
   					<br>
   					 <input type="submit" name="submit" class="w3-button w3-left w3-green" value="<?=$var_update;?>" style="width:120px;"></input><!-- End Btn -->
   			   </tr>
   			</form>
      	</table>
      </div>
    </div>
  </div>
</div>

