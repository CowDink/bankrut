<div class="w3-row-padding w3-margin-bottom w3-center">
  <div class="w3-container">
    <h3><?=$var_account_setting;?></h3>
    	 <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="<?=$ppPath;?>" style="width:96px;height:96px;"><br>
        <h4 class=""><?=$username;?></h4>
      </div>
      
      <br>
      <div class="w3-center w3-col m10 w3-container" style="width:50%">
		<p class="w3-opacity w3-left w3-medium" style="padding:;"><?=$req;?></p>
	  </div>
      <style>td{width:60%;}td#input{width:40%;}</style>
      <div class="w3-container w3-margin-right">
      	<table class="w3-table">
      		<form action="config/update_profile.php" method="POST">
      			<tr>
      				<td id="input"><input type="email" maxlength="256" name="email" placeholder="email" class="w3-input w3-left w3-middle  <?=$theme_body_color;?>"/>
      				<br><?=$var_current_email;?>:<br><?=$email;?></td>
				  </tr>
				  <tr>
			 		<td id="input"><input type="text" maxlength="10" name="username" placeholder="username" class="w3-input w3-left w3-middle  <?=$theme_body_color;?>"/>
					 <br><?=$var_current_uname;?>:<br><?=$uname;?></td>
				  </tr>
				  <tr>
					 <td id="input"><input type="password" maxlength="30" name="password" placeholder="password" class="w3-input w3-left w3-middle  <?=$theme_body_color;?>"/>
					 <br><label><?=$var_current_pass;?>:<br><span id="curPas"><?=$password;?></span></label>
				  </tr>
				  <tr>
					 <td id="input"><input type="text" maxlength="20" name="phone" placeholder="phone" class="w3-input w3-left w3-middle  <?=$theme_body_color;?>"/>
					 <br><?=$var_current_phone;?>:<br><?=$phone;?></td>
   			   </tr>
   			   <tr>
   				  <td>
   					 <input type="submit" name="submit" class="w3-button w3-green" value="<?=$var_update;?>" style="width:120px;"></input><!-- End Btn -->
   			   </tr>
   			</form>
      	</table>
      </div>
      <script>
      	
      	/*	
      		var pass = $("#curPass").text();
      		var bint ="";
      		for(var i = 0;i < pass.length;i++){
      			bint += "*";
      		}
      alert(pass+" "+bint);
      
      		if($('#passChecked').is(':checked')){
      			alert("checked");
      		}else{
   		   	pass.text(pass);
   		   }
   		*/
      </script>
    </div>
  </div>
</div>

