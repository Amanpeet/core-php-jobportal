<?php include('inc/header.php'); ?>

<!-- page title -->
<div class="p-3 border-bottom">
  <h3> <strong>Welcome <?php echo $login_role; ?> </strong> </h3>
  <p>Click on <strong>Links</strong> in left sidebar to perform actions.</p>
</div>

<div class="m-3">
  <div class="row text-center">

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="admins.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-user-shield"></i> Admins </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="employers.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-user-tie"></i> Employers </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="users.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-users"></i> Users </h5></a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- include header -->
<?php include('inc/footer.php'); ?>