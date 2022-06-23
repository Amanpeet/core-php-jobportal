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

        <h4 class="pb-2 pt-2"> Add <strong>New Job</strong> <?php echo "<small class='text-uppercase text-muted float-right'>$login_role</small>"; ?></h4>

        <div class="jobs-editing bg-white p-3 border">

          <?php
          /* IF DELETE MEMBER */
          if( isset($_REQUEST['del']) ) {
            $id = $_REQUEST['del'];
            $del_user = '';
            ?>
              <div class="p-2 border-bottom">
                <h3> <strong>Delete Job</strong> </h3>
                <p>Confirm deletion of Specific Job. This step is non-reversible.</p>
              </div>
              <div class="form-box p-2">
                <form id="id_card_form" name="id_card_form" action="" method="post">
                  <?php
                    $select = "SELECT * FROM jobs WHERE `jid` = '$id' ";
                    $que = mysqli_query($conn, $select);
                    $fet = mysqli_fetch_array($que);
                    $del_user = $fet['job_title'];
                  ?>
                  <h5>Do you really want to delete id:<strong><?php echo $fet['jid']; ?> (Title: <?php echo $del_user; ?>) </strong>from database? </h5>
                  <p> Note: This action cannot be undone. </p>
                  <div class="text-left">
                    <input type="submit" class="btn btn-danger" name="deletemon" value="Delete">
                    <a class="btn btn-dark" href="jobs-view.php">Cancel</a>
                    <br><br>
                  </div>
                </form>
              </div>

              <div id="response" class="h5 pt-3">
                <?php
                if(isset($_POST['deletemon'])){
                  $delete1 = "DELETE FROM jobs WHERE `jid` = '$id' ";
                  $quer1 = mysqli_query($conn, $delete1);
                  if( $quer1 ){
                    userlog('job_delete', "Deleted Job with id: $id"); //record keeping
                    echo "<strong class='text-success'>SUCCESS: Job Deleted. Redirecting back...";
                    echo '<script>window.location="jobs-view.php";</script>';
                  } else{
                    echo "<strong class='text-success'>ERROR: Job not deleted. Please try again later.</strong>";
                  }
                }
                ?>
              </div>
              <?php

          /* IF ADD MEMBER */
          } elseif( isset($_REQUEST['add']) ) {
            $id = $_REQUEST['add'];
            ?>

            <!-- Operation addmon -->
            <div id="response" class="h5 pt-3 text-danger">
              <?php
              if(isset($_POST['addmon'])) {

                // Required field names
                $required_fields = array(
                  'job_category',
                  'job_title',
                  'job_responsibility',
                  'job_salary',
                  'job_location',
                  'job_industry',
                  'job_type',
                  'job_employment',
                  'job_functional_area',
                  'job_validity',
                  'job_description',
                  'job_experience_req',
                  'job_education_req',
                  'job_skills_req',
                  'company_details',
                  'status',
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
                  $job_category        = mysqli_real_escape_string($conn, $_POST['job_category']);
                  $job_title           = mysqli_real_escape_string($conn, $_POST['job_title']);
                  $job_responsibility  = mysqli_real_escape_string($conn, $_POST['job_responsibility']);
                  $job_salary          = mysqli_real_escape_string($conn, $_POST['job_salary']);
                  $job_location        = mysqli_real_escape_string($conn, $_POST['job_location']);
                  $job_industry        = mysqli_real_escape_string($conn, $_POST['job_industry']);
                  $job_type            = mysqli_real_escape_string($conn, $_POST['job_type']);
                  $job_employment      = mysqli_real_escape_string($conn, $_POST['job_employment']);
                  $job_functional_area = mysqli_real_escape_string($conn, $_POST['job_functional_area']);
                  $job_validity        = mysqli_real_escape_string($conn, $_POST['job_validity']);
                  $job_description     = mysqli_real_escape_string($conn, $_POST['job_description']);
                  $job_experience_req  = mysqli_real_escape_string($conn, $_POST['job_experience_req']);
                  $job_education_req   = mysqli_real_escape_string($conn, $_POST['job_education_req']);
                  $job_skills_req      = mysqli_real_escape_string($conn, $_POST['job_skills_req']);
                  $company_details     = mysqli_real_escape_string($conn, $_POST['company_details']);
                  $status              = mysqli_real_escape_string($conn, $_POST['status']);

                  $posted_by = $login_user; //username from session

                  $accepted_ext = array("pdf", "docx", "doc", "PDF", "DOCX", "DOC", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                  $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                  $uniqd = round(microtime(true));
                  // $uniqd = $username;

                  //file1
                  $file_documents = '';
                  $fileserr1 = false;
                  if( empty($_FILES['file_documents']) ){
                    $file_documents = '';
                    $fileserr1 = false;
                  } elseif( ($_FILES['file_documents']['size'] == 0) ){
                    $file_documents = '';
                    $fileserr1 = false;
                  } elseif( $_FILES['file_documents']['size'] > (2*1024*1024) ) { //2MB
                    $fileserr1 = true;
                  } else {
                    $temp = explode(".", $_FILES["file_documents"]["name"]);
                    $ext  = end($temp);
                    if( in_array($ext, $accepted_ext ) == false ){
                      $fileserr1 = true;
                    } else {
                      $newfilename = 'job_file_' . $uniqd . '.' . end($temp);
                      $imagetmp    = trim($_FILES['file_documents']['tmp_name']);
                      $path        = "uploads/".$newfilename;
                      move_uploaded_file($imagetmp, $path);
                      $file_documents = $newfilename;
                      $fileserr1 = false;
                    }
                  }

                  //no files error
                  if( $fileserr1 ){
                    echo "<strong class='text-danger'>ERROR: Uploaded Files are Invalid or Over allowed size of 2MB. Try again with Valid files.</strong>";
                  } else {

                    // add to db
                    $insert_sql = "INSERT INTO jobs( `job_category`, `job_title`, `job_responsibility`, `job_salary`, `job_location`, `job_industry`, `job_type`, `job_employment`, `job_functional_area`, `job_validity`, `job_description`, `job_experience_req`, `job_education_req`, `job_skills_req`, `company_details`, `file_documents`, `status`, `posted_by` ) VALUES( '$job_category', '$job_title', '$job_responsibility', '$job_salary', '$job_location', '$job_industry', '$job_type', '$job_employment', '$job_functional_area', '$job_validity', '$job_description', '$job_experience_req', '$job_education_req', '$job_skills_req', '$company_details', '$file_documents', '$status', '$posted_by' ) ";

                    $quer = mysqli_prepare($conn, $insert_sql);
                    if( $quer ){
                      $querx = mysqli_stmt_execute($quer);
                      $last = mysqli_insert_id($conn);
                      userlog('job_add', "Added new job with id: $last"); //record keeping
                      echo "<strong class='text-success'>SUCCESS: New Job Added Successfully.</strong>";
                      // echo '<script>window.location="jobs-edit.php?view='.$last.'&added=1";</script>';
                    } else {
                      echo "<strong>ERROR: New Job not Added. Please try again later.</strong>";
                    }

                  }
                }
              }
              ?>
            </div>

            <div class="row border-bottom mb-3">
              <div class="col-md">
                <p>Create new job to accept user applications. Some details cannot be changed later. </p>
              </div>
              <div class="col-md text-right">
                <a class="btn btn-light" href="jobs-view.php">Back to Jobs</a>
              </div>
            </div>

            <!-- add form -->
            <div class="form-box p-2">
              <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-striped table-responsive-md">
                  <tbody>
                    <tr>
                      <td style="width: 25%;"> Job Category </td>
                      <td style="width: 75%;">
                        <select class="chosen-select form-control w-50" name="job_category" data-placeholder="Select Category" required>
                          <option value="">Set Category</option>
                          <option value="designing">Designing</option>
                          <option value="developing">Developing</option>
                          <option value="hardware">Hardware</option>
                          <option value="government">Government</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> Job Title </td>
                      <td> <input type="text" class="form-control" name="job_title" required> </td>
                    </tr>
                    <tr>
                      <td> Responsibility </td>
                      <td> <input type="text" class="form-control" name="job_responsibility" required> </td>
                    </tr>
                    <tr>
                      <td> Salary </td>
                      <td> <input type="text" class="form-control" name="job_salary" required> </td>
                    </tr>
                    <tr>
                      <td> Location </td>
                      <td> <input type="text" class="form-control" name="job_location" required> </td>
                    </tr>
                    <tr>
                      <td> Industry </td>
                      <td> <input type="text" class="form-control" name="job_industry" required> </td>
                    </tr>
                    <tr>
                      <td> Type </td>
                      <td> <input type="text" class="form-control" name="job_type" required> </td>
                    </tr>
                    <tr>
                      <td> Employment </td>
                      <td> <input type="text" class="form-control" name="job_employment" required> </td>
                    </tr>
                    <tr>
                      <td> Functional Area </td>
                      <td> <input type="text" class="form-control" name="job_functional_area" required> </td>
                    </tr>
                    <tr>
                      <td> Validity </td>
                      <td> <input type="text" class="form-control" name="job_validity" required> </td>
                    </tr>
                    <tr>
                      <td> Description </td>
                      <td> <textarea class="form-control" name="job_description" rows="2" required></textarea> </td>
                    </tr>
                    <tr>
                      <td> Experience Required </td>
                      <td> <input type="text" class="form-control" name="job_experience_req" required> </td>
                    </tr>
                    <tr>
                      <td> Education Required </td>
                      <td> <input type="text" class="form-control" name="job_education_req" required> </td>
                    </tr>
                    <tr>
                      <td> Skills Required </td>
                      <td> <input type="text" class="form-control" name="job_skills_req" required> </td>
                    </tr>
                    <tr>
                      <td> Company Details </td>
                      <td> <textarea class="form-control" name="company_details" rows="2" required></textarea> </td>
                    </tr>
                    <tr>
                      <td> Attach Documents <small>(if any)</small> </td>
                      <td> <input type="file" class="form-control-file" name="file_documents" accept="image/*, .pdf, .docx, .doc" /></td>
                    </tr>
                    <tr>
                      <td> Status </td>
                      <td>
                        <select name="status" class="form-control w-50" required>
                          <option value="">Set Status</option>
                          <option value="draft">Draft</option>
                          <option value="active">Active</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div class="my-4">
                  <input type="submit" class="btn btn-primary" name="addmon" value="ADD NEW JOB">
                  <a href="jobs-view.php" class="btn btn-dark">Cancel</a> <br><br>
                </div>

              </form>
            </div>
            <?php

          /* IF UPDATE MEMBER */
          } elseif( isset($_REQUEST['edit']) ) {
            $id = $_REQUEST['edit'];
            ?>

            <!-- Operation updatemon -->
            <div id="response" class="h5 px-2">
              <?php
              if(isset($_POST['updatemon'])) {

                $job_category        = mysqli_real_escape_string($conn, $_POST['job_category']);
                $job_title           = mysqli_real_escape_string($conn, $_POST['job_title']);
                $job_responsibility  = mysqli_real_escape_string($conn, $_POST['job_responsibility']);
                $job_salary          = mysqli_real_escape_string($conn, $_POST['job_salary']);
                $job_location        = mysqli_real_escape_string($conn, $_POST['job_location']);
                $job_industry        = mysqli_real_escape_string($conn, $_POST['job_industry']);
                $job_type            = mysqli_real_escape_string($conn, $_POST['job_type']);
                $job_employment      = mysqli_real_escape_string($conn, $_POST['job_employment']);
                $job_functional_area = mysqli_real_escape_string($conn, $_POST['job_functional_area']);
                $job_validity        = mysqli_real_escape_string($conn, $_POST['job_validity']);
                $job_description     = mysqli_real_escape_string($conn, $_POST['job_description']);
                $job_experience_req  = mysqli_real_escape_string($conn, $_POST['job_experience_req']);
                $job_education_req   = mysqli_real_escape_string($conn, $_POST['job_education_req']);
                $job_skills_req      = mysqli_real_escape_string($conn, $_POST['job_skills_req']);
                $company_details     = mysqli_real_escape_string($conn, $_POST['company_details']);
                $status              = mysqli_real_escape_string($conn, $_POST['status']);

                $accepted_ext = array("pdf", "docx", "doc", "PDF", "DOCX", "DOC", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                $uniqd = round(microtime(true));
                // $uniqd = $username;

                //grab existing files
                $select = "SELECT * FROM jobs WHERE `jid` = '$id' LIMIT 1";
                $que = mysqli_query($conn, $select);
                $fet = mysqli_fetch_array($que);
                $file_documents = $fet['file_documents'];

                //file1
                // $file_documents = '';
                $fileserr1 = false;
                if( empty($_FILES['file_documents']) ){
                  // $file_documents = '';
                  $fileserr1 = false;
                } elseif( ($_FILES['file_documents']['size'] == 0) ){
                  // $file_documents = '';
                  $fileserr1 = false;
                } elseif( $_FILES['file_documents']['size'] > (2*1024*1024) ) { //2MB
                  $fileserr1 = true;
                } else {
                  $temp = explode(".", $_FILES["file_documents"]["name"]);
                  $ext  = end($temp);
                  if( in_array($ext, $accepted_ext ) == false ){
                    $fileserr1 = true;
                  } else {
                    $newfilename = 'job_file_' . $uniqd . '.' . end($temp);
                    $imagetmp    = trim($_FILES['file_documents']['tmp_name']);
                    $path        = "uploads/".$newfilename;
                    move_uploaded_file($imagetmp, $path);
                    $file_documents = $newfilename;
                    $fileserr1 = false;
                  }
                }

                //no files error
                if( $fileserr1 ){
                  echo "<strong class='text-danger'>ERROR: Uploaded Files are Invalid or Over allowed size of 2MB. Try again with Valid files.</strong>";
                } else {

                  // update to db
                  $data_sql = "UPDATE jobs SET `job_category` = '$job_category', `job_title` = '$job_title', `job_responsibility` = '$job_responsibility', `job_salary` = '$job_salary', `job_location` = '$job_location', `job_industry` = '$job_industry', `job_type` = '$job_type', `job_employment` = '$job_employment', `job_functional_area` = '$job_functional_area', `job_validity` = '$job_validity', `job_description` = '$job_description', `job_experience_req` = '$job_experience_req', `job_education_req` = '$job_education_req', `job_skills_req` = '$job_skills_req', `company_details` = '$company_details', `file_documents` = '$file_documents', `status` = '$status'  WHERE `jid` = '$id' ";

                  $quer = mysqli_prepare($conn, $data_sql);
                  if( $quer ){
                    $querx = mysqli_stmt_execute($quer);
                    userlog('job_add', "updated new job with id: $id"); //record keeping
                    echo "<strong class='text-success'>SUCCESS: Job Details Updated Successfully.</strong>";
                    // echo '<script>window.location="jobs-edit.php?view='.$last.'&added=1";</script>';
                  } else {
                    echo "<strong>ERROR: Job Details NOT Updated. Please try again later.</strong>";
                  }

                }

              }
              ?>
            </div>

            <!-- update form -->
            <div class="form-box p-2">
              <form id="updatemon_form" name="updatemon_form" action="" method="post" enctype="multipart/form-data">

                <?php
                  $select = "SELECT * FROM jobs WHERE `jid` = '$id' LIMIT 1";
                  $que = mysqli_query($conn, $select);
                  $fet2 = mysqli_fetch_array($que);
                  $datef = date('d M, Y', strtotime($fet2['dated']));
                ?>

                <div class="row border-bottom mb-3">
                  <div class="col-md">
                    <p>Once updated, values cannot be reversed. <br> Created on <strong><?php echo $datef; ?></strong> </p>
                  </div>
                  <div class="col-md text-right">
                    <a class="btn btn-primary" href="jobs-edit.php?view=<?php echo $fet2['jid']; ?>">View Job</a>
                    <a class="btn btn-danger" href="jobs-edit.php?del=<?php echo $fet2['jid']; ?>">Delete</a>
                    <a class="btn btn-light" href="jobs-view.php">Back to Jobs</a>
                  </div>
                </div>

                <!-- form 1 table -->
                <h5><strong>Job Details</strong></h5>
                <table class="table table-bordered table-striped table-responsive-md">
                  <tbody>
                    <tr>
                      <td style="width: 25%;"> Job Category </td>
                      <td style="width: 75%;">
                        <select class="chosen-select form-control w-50" name="job_category" data-placeholder="Select Category">
                          <option value="<?php echo $fet2['job_category']; ?>">Set Category</option>
                          <option value="designing">Designing</option>
                          <option value="developing">Developing</option>
                          <option value="hardware">Hardware</option>
                          <option value="government">Government</option>
                        </select>
                        <small>Current Category: <?php echo $fet2['job_category']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <td> Job Title </td>
                      <td> <input type="text" class="form-control" name="job_title"  value="<?php echo $fet2['job_title']; ?>"required> </td>
                    </tr>
                    <tr>
                      <td> Responsibility </td>
                      <td> <input type="text" class="form-control" name="job_responsibility" value="<?php echo $fet2['job_responsibility']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Salary </td>
                      <td> <input type="text" class="form-control" name="job_salary" value="<?php echo $fet2['job_salary']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Location </td>
                      <td> <input type="text" class="form-control" name="job_location" value="<?php echo $fet2['job_location']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Industry </td>
                      <td> <input type="text" class="form-control" name="job_industry" value="<?php echo $fet2['job_industry']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Type </td>
                      <td> <input type="text" class="form-control" name="job_type" value="<?php echo $fet2['job_type']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Employment </td>
                      <td> <input type="text" class="form-control" name="job_employment" value="<?php echo $fet2['job_employment']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Functional Area </td>
                      <td> <input type="text" class="form-control" name="job_functional_area" value="<?php echo $fet2['job_functional_area']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Validity </td>
                      <td> <input type="text" class="form-control" name="job_validity" value="<?php echo $fet2['job_validity']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Description </td>
                      <td> <textarea class="form-control" name="job_description" rows="2" required><?php echo $fet2['job_description']; ?></textarea> </td>
                    </tr>
                    <tr>
                      <td> Experience Required </td>
                      <td> <input type="text" class="form-control" name="job_experience_req" value="<?php echo $fet2['job_experience_req']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Education Required </td>
                      <td> <input type="text" class="form-control" name="job_education_req" value="<?php echo $fet2['job_education_req']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Skills Required </td>
                      <td> <input type="text" class="form-control" name="job_skills_req" value="<?php echo $fet2['job_skills_req']; ?>" required> </td>
                    </tr>
                    <tr>
                      <td> Company Details </td>
                      <td> <textarea class="form-control" name="company_details" rows="2" required><?php echo $fet2['company_details']; ?></textarea> </td>
                    </tr>
                    <tr>
                      <td> Attach Documents<br> <small>(if any)</small> </td>
                      <td>
                        <input type="file" class="form-control-file" name="file_documents" accept="image/*, .pdf, .docx, .doc" />
                        <small class="text-muted">Uploading new file will replace old file. <?php echo (!empty($fet2['file_documents'])) ? ' <a href="../uploads/'.$fet2["file_documents"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
                      </td>
                    </tr>
                    <tr>
                      <td> Status </td>
                      <td>
                        <select name="status" class="form-control w-50" required>
                          <option value="<?php echo $fet2['status']; ?>">Set Status</option>
                          <option value="draft">Draft</option>
                          <option value="active">Active</option>
                        </select>
                        <small>Current Status: <?php echo $fet2['status']; ?></small>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div class="my-4">
                  <input type="submit" class="btn btn-primary mr-2" name="updatemon" value="UPDATE">
                  <a href="jobs-view.php" class="btn btn-dark">Cancel</a> <br><br>
                </div>

              </form>
            </div>

            <?php

          /* IF VIEW MEMBER */
          } elseif( isset($_REQUEST['view']) ) {
            $id = $_REQUEST['view'];
            ?>

                <!-- response for updatemon -->
                <div class="h5 text-success">
                  <?php
                  if( isset($_REQUEST['updated']) ) {
                    echo "<strong>SUCCESS: Job Details Updated Successfully.</strong>";
                  } elseif( isset($_REQUEST['added']) ) {
                    echo "<strong>SUCCESS: New Job Added Successfully.</strong>";
                  }
                  ?>
                </div>

                <?php
                  $select = "SELECT * FROM jobs WHERE `jid` = '$id' ";
                  $que = mysqli_query($conn, $select);
                  $fet2 = mysqli_fetch_array($que);
                  $datef = date('d M, Y', strtotime($fet2['dated']));
                ?>

                <div class="row border-bottom mb-3">
                  <div class="col-md">
                    <p>Viewing individual Job details.<br> Created on <strong><?php echo $datef; ?></strong> </p>
                  </div>
                  <div class="col-md text-right">
                    <a class="btn btn-dark" href="jobs-edit.php?edit=<?php echo $fet2['jid']; ?>">Edit Job</a>
                    <a class="btn btn-danger" href="jobs-edit.php?del=<?php echo $fet2['jid']; ?>">Delete</a>
                    <a class="btn btn-light" href="jobs-view.php">Back to Jobs</a>
                  </div>
                </div>

                <!-- form 1 table -->
                <h5><strong>Job Details</strong></h5>
                <table class="table table-bordered table-striped table-responsive-md">
                  <tbody>
                    <tr>
                      <td style="width: 25%;"> Job Category </td>
                      <td style="width: 75%;"> <?php echo $fet2['job_category']; ?> </td>
                    </tr>
                    <tr>
                      <td> Job Title </td>
                      <td> <?php echo $fet2['job_title']; ?> </td>
                    </tr>
                    <tr>
                      <td> Responsibility </td>
                      <td> <?php echo $fet2['job_responsibility']; ?> </td>
                    </tr>
                    <tr>
                      <td> Salary </td>
                      <td> <?php echo $fet2['job_salary']; ?> </td>
                    </tr>
                    <tr>
                      <td> Location </td>
                      <td> <?php echo $fet2['job_location']; ?> </td>
                    </tr>
                    <tr>
                      <td> Industry </td>
                      <td> <?php echo $fet2['job_industry']; ?> </td>
                    </tr>
                    <tr>
                      <td> Type </td>
                      <td> <?php echo $fet2['job_type']; ?> </td>
                    </tr>
                    <tr>
                      <td> Employment </td>
                      <td> <?php echo $fet2['job_employment']; ?> </td>
                    </tr>
                    <tr>
                      <td> Functional Area </td>
                      <td> <?php echo $fet2['job_functional_area']; ?> </td>
                    </tr>
                    <tr>
                      <td> Validity </td>
                      <td> <?php echo $fet2['job_validity']; ?> </td>
                    </tr>
                    <tr>
                      <td> Description </td>
                      <td> <?php echo $fet2['job_description']; ?> </td>
                    </tr>
                    <tr>
                      <td> Experience Required </td>
                      <td> <?php echo $fet2['job_experience_req']; ?> </td>
                    </tr>
                    <tr>
                      <td> Education Required </td>
                      <td> <?php echo $fet2['job_education_req']; ?> </td>
                    </tr>
                    <tr>
                      <td> Skills Required </td>
                      <td> <?php echo $fet2['job_skills_req']; ?> </td>
                    </tr>
                    <tr>
                      <td> Company Details </td>
                      <td> <?php echo $fet2['company_details']; ?> </td>
                    </tr>
                    <tr>
                      <td> Attached Documents<br> <small>(if any)</small> </td>
                      <td>
                        <small class="text-muted"> <?php echo (!empty($fet2['file_documents'])) ? ' <a href="../uploads/'.$fet2["file_documents"].'" target="_blank" /> View Attached File </a> ' : ''; ?> </small>
                      </td>
                    </tr>
                    <tr>
                      <td> Status </td>
                      <td> <?php echo $fet2['status']; ?> </td>
                    </tr>
                  </tbody>
                </table>

            <?php

          /* ELSE SHOW ERROR */
          } else {
            ?>
            <div class="">
              <h3> <strong>Job data not found</strong> </h3>
              <p>No Data found via given job id. Please go back and try again.</p>
              <a class="btn btn-dark btn-sm" href="jobs-view.php">Back to Jobs</a>
            </div>
            <?php
          } //if else end
          ?>


        </div>

      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); //footer ?>
