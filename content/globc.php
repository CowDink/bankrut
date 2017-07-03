<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse <?=$theme_sidebar;?> w3-animate-right" style="z-index:4;width:100%;display:none;right:0;" id="mySidebar2"><br>
  <div class="w3-container w3-row">
  	<i class="fa fa-close w3-right" id="close2"></i>
    <!-- user icon -->
    <div class="w3-col s4 w3-center">
      <h4>Edit</h4>
    </div>
     <audio src="assets/audio/main.ogg" controls autoplay loop>
		audio is not supported
	</audio>
  </div><!-- end of main sidebar menu -->
</nav><!-- end of sidebar menu -->
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" style="cursor:pointer;z-index:3;" title="close side menu" id="myOverlay2"></div>



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
    	<button type="button" class="w3-button w3-green w3-margin-left w3-round" id="btn"><i class="fa fa-paper-plane"></i></button>
      </td>
      </tr>
      </table>
	</div>
</div>
	
	<script>
window.onload = function(){
setTimeout(let, 2100);
function let(){
$('#pesan').val($('#chat-output').html());}
document.getElementById("btn").addEventListener("click", w3_open2)
document.getElementById("close2").addEventListener("click", w3_close2)

// Get the Sidebar
var mySidebar2 = document.getElementById("mySidebar2");

// Get the DIV with overlay effect
var overlayBg2 = document.getElementById("myOverlay2");
// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open2() {
    if (mySidebar2.style.display === 'block') {
        mySidebar2.style.display = 'none';
        overlayBg2.style.display = "none";
    } else {
        mySidebar2.style.display = 'block';
        overlayBg2.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close2() {
    mySidebar2.style.display = "none";
    overlayBg2.style.display = "none";
}
}
		
		$(function(){
			show();
			menu();
			
			function show(){
				$.ajax({
					type:'POST',
					url:"config/process_globc.php",
					data:"action=show",
					success: function(data){
						setTimeout(show, 1000);
						setTimeout(menu, 1100);
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
			 function menu(){
				 $(".pencil").click(function(){
		     		prompt($(".pencil"));
			 	});
			 }
		 });
	</script>
</div>