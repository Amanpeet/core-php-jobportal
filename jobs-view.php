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

        <h4 class="border-bottom pb-3 pt-2 mb-4"> View/Edit <strong>Jobs</strong> <?php echo "<small class='text-uppercase text-muted float-right'>$login_role</small>"; ?></h4>

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
          $job_sql = "SELECT * FROM jobs WHERE `posted_by` = '$login_user' LIMIT $items_per_page OFFSET $start_from";
          $job_query = mysqli_query($conn, $job_sql);
          if( mysqli_num_rows($job_query) > 0 ){
            while($job = mysqli_fetch_array($job_query)) {
              ?>
              <div class="card bg-white mb-4">
                <div class="card-body">
                  <!-- <h6 class="card-subtitle text-muted mb-2"><small><?php //echo date('d M, Y', strtotime($job['dated'])); ?></small></h6> -->
                  <h6 class="card-subtitle text-muted mb-2 text-uppercase"><small><?php echo $job['job_category']; ?></small></h6>
                  <h5 class="card-title"><strong><?php echo $job['job_title']; ?></strong></h5>
                  <div class="card-text">
                    <p> <?php echo strip_tags( substr( $job['job_description'], 0, 200 ) ) . '...'; ?> </p>
                    <div class="row">
                      <div class="col"> <strong>STATUS:</strong> <span class="text-uppercase text-dark"><?php echo $job['status']; ?></strong> </div>
                    </div>
                  </div>
                  <a class="btn btn-color btn-sm mt-3" href="jobs-edit.php?view=<?php echo $job['jid']; ?>">View Details</a>
                  <a class="btn btn-dark btn-sm mt-3" href="jobs-edit.php?edit=<?php echo $job['jid']; ?>">Edit Job</a>
                  <a class="btn btn-danger btn-sm mt-3" href="jobs-edit.php?del=<?php echo $job['jid']; ?>">Delete Job</a>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <h6 class="card-subtitle text-muted mb-2 text-uppercase"><small>NOPE</small></h6>
            <h4 class="card-title"><strong>No jobs found!</strong></h4>
            <div class="card-text">
              <p> It seems like you dont have posted any jobs yet. Navigate to Add New Job Page and Post a job first. </p>
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

