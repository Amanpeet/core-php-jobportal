<?php include('include/fg-logincheck.php'); //header ?>
<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Dashboard</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <?php include('include/dashboard-nav.php'); //header ?>
      </div>
      <div class="col-md-8 col-lg-9">

        <h4 class="border-bottom pb-3 pt-2 mb-4"> Welcome <?php echo "<strong>".$login_name."</strong> <small class='text-uppercase text-muted float-right'>$login_role</small>"; ?></h4>

        <div class="dashboard">

          <p>This section is under construction. Check back later.</p>
          <a class="btn btn-color" href="profile.php">View Profile</a>

        </div>

      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); //footer ?>
