<div class="widget card dasboard-nav bg-white p-3">
  <h5 class="border-bottom pb-2 mb-3 mt-1">Navigate</h5>

  <?php if( $employer ){ ?>

      <h6> <a href="dashboard.php"> <i class="fa fa-box"></i> Dashboard </a> </h6>
      <h6> <a href="profile.php"> <i class="fa fa-user"></i> View Profile </a> </h6>
      <h6> <a href="profile-edit.php"> <i class="fa fa-edit"></i> Edit Profile </a> </h6>
      <h6></h6>
      <h6> <a href="jobs-edit.php?add=1"> <i class="fa fa-user-tie"></i> Add New Job </a> </h6>
      <h6> <a href="jobs-view.php"> <i class="fa fa-server"></i> View/Edit Jobs </a> </h6>
      <h6> <a href="jobs-applied.php"> <i class="fa fa-file-alt"></i> User Appications </a> </h6>

  <?php } else { ?>

      <h6> <a href="dashboard.php"> <i class="fa fa-box"></i> Dashboard </a> </h6>
      <h6> <a href="profile.php"> <i class="fa fa-user"></i> View Profile</a> </h6>
      <h6> <a href="profile-edit.php"> <i class="fa fa-edit"></i> Edit Profile</a> </h6>
      <h6></h6>
      <h6> <a href="user-applied.php"> <i class="fa fa-user-tie"></i> Applied Jobs </a> </h6>
      <h6> <a href="user-resume.php"> <i class="fa fa-download"></i> Download Resume </a> </h6>

  <?php } ?>

</div>
