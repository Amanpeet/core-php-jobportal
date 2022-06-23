<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Job Details</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light job-details">
  <div class="container">

    <!-- Operation applymon -->
    <div id="response" class="h4 text-danger text-center">
      <?php
      if(isset($_POST['jobapply_submit'])) {

        // Required field names
        $required_fields = array(
          'job_id',
          'job_title',
          'user_purposal',
        );

        // Loop over fields, check if unset or empty
        $error = false;
        foreach($required_fields as $field) {
          if ( !isset( $_POST[$field] ) || empty( $_POST[$field] ) ) {
            $error = true;
            echo "<strong> ERROR: Required fields Empty or Invalid. </strong>".$_POST[$field];
          } else {
            $trim_val = mysqli_real_escape_string($conn, $_POST[$field]);
            if ( trim($trim_val) == '' ){
              $error = true;
              echo "<strong> ERROR: Required fields cant be just spaces. </strong>";
            }
          }
        }
        if( !$error ){
          // get values
          $job_id        = mysqli_real_escape_string($conn, $_POST['job_id']);
          $job_title     = mysqli_real_escape_string($conn, $_POST['job_title']);
          $user_purposal = mysqli_real_escape_string($conn, $_POST['user_purposal']);
          $user_applied  = $login_user; //username from session

          //get old values
          $ex_sql = "SELECT * FROM applied WHERE job_id = '$job_id' AND user_applied = '$user_applied' ";
          $ex_query = mysqli_query($conn, $ex_sql);
          $ex_row   = mysqli_fetch_array($ex_query);
          if( mysqli_num_rows($ex_query) > 0 ){
            echo "<strong>ERROR: You have already applied for this job. Please wait for Employer's feedback.</strong>";
          } else {
            // add to db
            $insert_sql = "INSERT INTO applied( `job_id`, `job_title`, `user_applied`, `user_purposal` ) VALUES( '$job_id', '$job_title', '$user_applied', '$user_purposal' ) ";
            $quer = mysqli_prepare($conn, $insert_sql);
            if( $quer ){
              $querx = mysqli_stmt_execute($quer);
              // echo "<strong class='text-success'>SUCCESS: You have Applied for this Job Successfully.</strong>";
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span>&times;</span> </button>
                <h4><strong class="text-success">SUCCESS: You have Applied for this Job Successfully.</strong></h4>
              </div>
              <?php
              // echo '<script>window.location="jobs-edit.php?view='.$last.'&added=1";</script>';
            } else {
              echo "<strong>ERROR: Application process failed. Please try again later.</strong>";
            }
          }
        }
      }
      ?>
    </div>

    <?php
    if( isset($_REQUEST['job']) && !empty($_REQUEST['job']) ){
      $jid = $_REQUEST['job'];
      //Simple select query
      $blog_sql = "SELECT * FROM jobs WHERE `jid` = '$jid' ";
      $blog_query = mysqli_query($conn, $blog_sql);
      $job = mysqli_fetch_assoc($blog_query);
      $datef = date('d M, Y', strtotime($job['dated']));

      if( !empty($job) ){ ?>

        <div class="heading-section text-center my-5">
          <h2><?php echo $job['job_title']; ?></h2>
          <h6 class="text-muted mt-4"> <?php echo $datef; ?> </h6>
        </div>
        <div class="row">
          <div class="col-md-9">
            <div class="card p-4">
              <p> <strong>Job Title:</strong> <?php echo $job['job_title']; ?> </p>
              <p> <strong>Responsibility:</strong> <?php echo $job['job_responsibility']; ?> </p>
              <p> <strong>Salary:</strong> <?php echo $job['job_salary']; ?> </p>
              <p> <strong>Location:</strong> <?php echo $job['job_location']; ?> </p>
              <p> <strong>Industry:</strong> <?php echo $job['job_industry']; ?> </p>
              <p> <strong>Type:</strong> <?php echo $job['job_type']; ?> </p>
              <p> <strong>Employment:</strong> <?php echo $job['job_employment']; ?> </p>
              <p> <strong>Functional Area:</strong> <?php echo $job['job_functional_area']; ?> </p>

              <h6 class="border-top pt-3 mt-3"></h6>
              <p> <strong>Description:</strong> <?php echo $job['job_description']; ?> </p>

              <h6 class="border-top pt-3 mt-3"></h6>
              <p> <strong>Experience Required:</strong> <?php echo $job['job_experience_req']; ?> </p>
              <p> <strong>Education Required:</strong> <?php echo $job['job_education_req']; ?> </p>
              <p> <strong>Skills Required:</strong> <?php echo $job['job_skills_req']; ?> </p>

              <h6 class="border-top pt-3 mt-3"></h6>
              <p> <strong>Company Details:</strong> <?php echo $job['company_details']; ?> </p>

              <?php if( !empty($job['file_documents']) ) { ?>
                <h6 class="border-top pt-3 mt-3"></h6>
                <p> <strong>Attached Documents:</strong> <a href="../uploads/<?php echo $job["file_documents"]; ?>" target="_blank" /> <strong>View Attached Files</strong> <i class="fa fa-file-download"></i> </a> </p>
              <?php } ?>

            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
              <a class="btn btn-primary btn-lg d-block" data-toggle="modal" data-target="#jobApplyModal">APPLY NOW</a>
            </div>
            <div class="jobs-widgets">
              <div class="card p-4 mt-4">
                <h6><small><strong>CATEGORY</strong></small></h6>
                <p> <?php echo $job['job_category']; ?> </p>
                <h6 class="border-top pt-3"><small><strong>VALIDITY</strong></small></h6>
                <p> <?php echo $job['job_validity']; ?> </p>
                <h6 class="border-top pt-3"><small><strong>EMPLOYER</strong></small></h6>
                <p> <?php echo $job['posted_by']; ?> </p>
              </div>
              <div class="card p-4 mt-4">
                <h6><small><strong>CONTACT US</strong></small></h6>
                <p>
                  <i class="fa fa-phone"></i> <a href="tel:+1234567890"> +1-1234567890 </a> <br>
                  <i class="fa fa-envelope"></i> <a href="mailto:info@rojgarway.com"> jobs@rojgarway.com </a>
                </p>
              </div>
            </div>
          </div>
        </div>

      <?php } else { ?>

        <div class="heading-section text-center my-5">
          <h2>Job Removed or Not Found!</h2>
          <div class="lead">No job listing found on given address, it may have been removed due to expiration or completion.</div>
        </div>

      <?php } ?>

    <?php } else { ?>

      <div class="heading-section text-center my-5">
        <h2>Post not Found!</h2>
        <div class="lead">No post found on given address, please check your url or search above.</div>
      </div>

    <?php } ?>

  </div>
</section>


<div class="modal fade" id="jobApplyModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jobApplyModalLabel">Apply for Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" name="jobapply_form">
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
            <button type="submit" class="btn btn-primary btn-lg" name="jobapply_submit">APPLY NOW</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include('footer.php'); //footer ?>
