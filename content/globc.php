<div style="padding-top:10px; padding-right:10px" id="#ctop" class=" w3-margin-top">
	<div class="w3-container" id="chat-output">
	<h1>Wait..</h1>
	</div>
	<div class="w3-bar w3-round <?=$theme_sidebar;?> w3-padding w3-bottom" style="z-index:2;padding-right:20px;">
  <!--<button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" style="margin-top:3px;" onclick="w3_open();"><i class="fa fa-bars"></i></button>-->
  <!--<span class="w3-bar-item w3-right"><a href="home.php"><img src="<?=$ppPath;?>" class="w3-circle" style="width:30px;height:30px;"></img></a></span>-->
  	<table>
  	<tr>
  	<td style="width:100%;">
  	  <input type="text" class="w3-input w3-round-large" id="pesan" placeholder="type here.." style="width:100%">
  	</td><td>
    	<button type="button" class="w3-button w3-green w3-margin-left w3-round" id="btn1"><i class="fa fa-paper-plane"></i></button>
      </td>
      </tr>
      </table>
	</div>
</div>
	
	<script>
		$(function(){
			
			setTimeout(show, 1000);
			
			function show(){
				$.ajax({
					type:'POST',
					url:"config/process_globc.php",
					data:"action=show",
					success: function(data){
						setTimeout(show, 1000);
						$('#chat-output').html(data);
					}
				});
			}
			
			show();
			
			$('#btn1').click(function(){
				
				var isi = $('#pesan').val();
				
				if(isi){
					$.ajax({
						type:'POST',
						url:"config/process_globc.php",
						data:"isi="+isi+"&action=send",
						success: function(data){
							$('#pesan').val("");
							window.location.href = '#top';
							show();
						}
				    });
				}
		 	});
		 });
	</script>
</div>