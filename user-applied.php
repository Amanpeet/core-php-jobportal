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

        <h4 class="border-bottom pb-3 pt-2 mb-4"> Your <strong>Applied Jobs</strong> <?php echo "<small class='text-uppercase text-muted float-right'>$login_role</small>"; ?></h4>

        <div class="jobs-listing">

          <?php
          //pagination part 1
          $items_per_page = 8;
          if (isset($_GET["pagex"])) {
            $pagex = $_GET["pagex"];
          } else {
            $pagex = 1;
          }
          $start_from = ($pagex - 1) * $items_per_page;

          /* get the jobs */
          $job_sql = "SELECT * FROM applied WHERE `user_applied` = '$login_user' LIMIT $items_per_page OFFSET $start_from";
          $job_query = mysqli_query($conn, $job_sql);
          if( mysqli_num_rows($job_query) > 0 ){
            while($job = mysqli_fetch_array($job_query)) {
              ?>
              <div class="card bg-white mb-4">
                <div class="card-body">
                  <h6 class="card-subtitle text-muted float-right"><small>JOB ID: <?php echo $job['job_id']; ?></small></h6>
                  <h5 class="card-title border-bottom pb-2 mb-3 d-inline-block"><strong><?php echo $job['job_title']; ?></strong></h5>
                  <div class="card-text">
                    <p> <strong>Your Purposal:</strong> <?php echo strip_tags( substr( $job['user_purposal'], 0, 200 ) ) . '...'; ?> </p>
                    <p> <strong>Employer's Feedback:</strong> <?php echo (!empty($job['employer_reply'])) ? $job['employer_reply'] : 'pending'; ?></p>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <h6 class="card-subtitle text-muted mb-2 text-uppercase"><small>NOPE</small></h6>
            <h4 class="card-title"><strong>No jobs Applied!</strong></h4>
            <div class="card-text">
              <p> It seems like you dont have applied to any jobs yet. Browse Jobs and Apply to job first. </p>
            </div>
            <?php
          }
          ?>

        </div>

      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); //footer ?>

