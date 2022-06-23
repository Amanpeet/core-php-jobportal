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

        <h4 class="border-bottom pb-3 pt-2 mb-4"> User <strong>Applications</strong> <?php echo "<small class='text-uppercase text-muted float-right'>$login_role</small>"; ?></h4>

        <?php if(isset($_REQUEST['job']) && !empty($_REQUEST['job'])) { ?>

          <?php
          $jid = $_REQUEST['job'];

          /* get the jobs */
          $job_sql = "SELECT * FROM jobs WHERE `jid` = '$jid' AND `posted_by` = '$login_user' ";
          $job_query = mysqli_query($conn, $job_sql);
          if( mysqli_num_rows($job_query) > 0 ){
            while($job = mysqli_fetch_array($job_query)) {
              $datef = date('d M, Y', strtotime($job['dated']));
              $job_id = $job['jid'];

              /* get the applications */
              $appl_sql = "SELECT * FROM applied WHERE `job_id` = '$job_id' ";
              $appl_query = mysqli_query($conn, $appl_sql);
              $total_rows = mysqli_num_rows($appl_query);
              ?>
              <div class="card bg-white mb-4">
                <div class="card-body">
                  <h6 class="card-subtitle text-muted float-right"><small>JOB ID: <?php echo $job['jid']; ?></small></h6>
                  <h5 class="card-title pb-2 mb-3 d-inline-block"><strong><?php echo $job['job_title']; ?></strong></h5>
                  <div class="card-text">
                    <p> <?php echo strip_tags( substr( $job['job_description'], 0, 200 ) ) . '...'; ?> </p>
                    <div class="row border-bottom pb-3 mb-4">
                      <div class="col"> <strong>STATUS:</strong> <span class="text-uppercase text-dark"><?php echo $job['status']; ?></strong> </div>
                      <div class="col"> <strong>CREATED:</strong> <span class="text-uppercase text-dark"><?php echo $datef; ?></strong> </div>
                      <div class="col"> <strong>APPLICATIONS:</strong> <span class="text-uppercase text-dark"><?php echo $total_rows; ?></strong> </div>
                    </div>
                  </div>

                  <?php
                  if( $total_rows > 0 ){
                    $count = 1;
                    while($applicant = mysqli_fetch_array($appl_query)) {
                      ?>
                      <div class="card bg-light mb-4">
                        <div class="card-body">
                          <h6 class="card-subtitle text-muted mb-3"><small>APPLICATION #<?php echo $count; ?></small></h6>
                          <p class="mb-2"> <strong>Applicant's Username:</strong> <span class="text-dark"><?php echo $applicant['user_applied']; ?></span> </p>
                          <p class="mb-3"> <strong>Applicant's Purposal:</strong> <span class="text-dark"><?php echo $applicant['user_purposal']; ?></span> </p>
                          <!-- <p class="mb-3"> <strong>Your Feedback:</strong> <?php echo (!empty($applicant['employer_reply'])) ? $applicant['employer_reply'] : '<i>pending</i>'; ?></p> -->
                          <a class="btn btn-primary btn-sm" href="profile.php?user=<?php echo $applicant['user_applied']; ?>" target="_blank">View User's Profile</a>
                          <!-- <a class="btn btn-dark btn-sm" href="#" data-toggle="modal" data-target="#jobReplyModal">Give Feedback</a> -->
                        </div>
                      </div>
                      <?php
                      $count++;
                    }
                  }
                  ?>

                </div>
              </div>
              <?php
            }
          } else { ?>

            <h4 class="mt-5"><strong>No jobs found!</strong></h4>
            <p> It seems like you dont have posted any jobs yet. Navigate to Add New Job Page and Post a job first. </p>

          <?php } ?>

        <?php } else { ?>

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
                $datef = date('d M, Y', strtotime($job['dated']));
                $job_id = $job['jid'];
                /* get the applications */
                $appl_sql = "SELECT * FROM applied WHERE `job_id` = '$job_id' ";
                $appl_query = mysqli_query($conn, $appl_sql);
                $total_rows = mysqli_num_rows($appl_query);
                ?>
                <div class="card bg-white mb-4">
                  <div class="card-body">
                    <h6 class="card-subtitle text-muted float-right"><small>JOB ID: <?php echo $job['jid']; ?></small></h6>
                    <h5 class="card-title border-bottom pb-2 mb-3 d-inline-block"><strong><?php echo $job['job_title']; ?></strong></h5>
                    <div class="card-text">
                      <!-- <p> <?php //echo strip_tags( substr( $job['job_description'], 0, 200 ) ) . '...'; ?> </p> -->
                      <div class="row">
                        <div class="col"> <strong>STATUS:</strong> <span class="text-uppercase text-dark"><?php echo $job['status']; ?></strong> </div>
                        <div class="col"> <strong>CREATED:</strong> <span class="text-uppercase text-dark"><?php echo $datef; ?></strong> </div>
                        <div class="col"> <strong>APPLICATIONS:</strong> <span class="text-uppercase text-dark"><?php echo $total_rows; ?></strong> </div>
                      </div>
                    </div>
                    <a class="btn btn-color btn-sm mt-3" href="jobs-applied.php?job=<?php echo $job['jid']; ?>">View Applications</a>
                  </div>
                </div>
                <?php
              }
            } else {
              ?>
              <h4 class="mt-5"><strong>No jobs found!</strong></h4>
              <p> It seems like you dont have posted any jobs yet. Navigate to Add New Job Page and Post a job first. </p>
              <?php
            }
            ?>

          </div>

        <?php } ?>

      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="jobReplyModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jobReplyModalLabel">Give Feedback to User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" name="jobreply_form">
          <input type="hidden" name="job_id" value="<?php echo $job['jid']; ?>">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Applying for</label>
            <input type="text" class="form-control" name="job_title" value="<?php echo $job['job_title']; ?>" readonly required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Write Purposal</label>
            <textarea class="form-control" name="user_purposal" required></textarea>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg" name="jobreply_submit">SUBMIT</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); //footer ?>

