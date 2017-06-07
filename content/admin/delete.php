<header class="w3-container w3-center" style="padding-top:22px">
    <h5><b><i class="fa fa-exclamation-circle"></i> Do you really want to delete this account?</b></h5>
  </header>
<!-- 1 div -->
<div class="w3-row-padding w3-margin-bottom">

	<!-- Yes -->
    <a href="config/deleted_by_admin.php?id_user_to_delete=<?php $link = $_GET['to_delete']; echo $link;?>">
     <div class="w3-quarter w3-left w3-margin-right" style="width:47%;">
      <div class="w3-container w3-round w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-check w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Yes</h4>
      </div>
     </div>
    </a>

	<!-- No -->
    <a href="home.php?page=admin&type=control_panel&user_key=<?=$link;?>#edit_user_data">
     <div class="w3-quarter w3-right" style="width:47%;">
      <div class="w3-container w3-round w3-green w3-padding-16">
        <div class="w3-left"><i class="fa fa-close w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>No</h4>
      </div>
     </div>
    </a>

<!--end of 1 div-->
</div>