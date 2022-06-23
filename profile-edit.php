<?php include('include/fg-logincheck.php'); //header ?>
<?php include('header.php'); //header ?>



<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>My Profile</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <div class="row">
      <div class="col-lg-10 mx-auto mb-3 px-0">
        <a class="btn btn-color" href="profile.php"> <i class="fa fa-user"></i> View Profile</a>
        <!-- <a id="genpdfbtn" class="btn btn-dark float-right" href="#"> <i class="fa fa-download"></i> Download as Resume</a> -->
      </div>

      <div class="col-lg-10 mx-auto p-0">
        <?php
        if( !empty($login_user) && !empty($login_role) ) {
          $find_user = $login_user;
          ?>
            <div id="" class="p-3 border bg-white">

              <!-- Operation updatemon -->
              <div id="response" class="h5">
                <?php
                if(isset($_POST['updatemon'])) {

                  //set field vars
                  $username  = mysqli_real_escape_string($conn, $_POST['username']);
                  $form_type = mysqli_real_escape_string($conn, $_POST['form_type']);
                  $email     = mysqli_real_escape_string($conn, $_POST['email']);
                  $pass1     = mysqli_real_escape_string($conn, $_POST['password']);
                  $pass2     = mysqli_real_escape_string($conn, $_POST['password2']);

                  //grab existing files
                  $select1 = "SELECT * FROM users WHERE `username` = '$find_user'";
                  $que1 = mysqli_query($conn, $select1);
                  $fet1 = mysqli_fetch_array($que1);
                  $username = $fet1['username'];
                  $password = $fet1['password'];
                  // Confirm Password
                  if( !empty($pass1) && !empty($pass2) && ($pass1 === $pass2) ) {
                    $password = md5($pass1);
                  }

                  // $status = "active";
                  $status    = mysqli_real_escape_string($conn, $_POST['status']);
                  $fullname  = mysqli_real_escape_string($conn, $_POST['fullname']);
                  $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
                  $phone2    = mysqli_real_escape_string($conn, $_POST['phone2']);
                  $address   = mysqli_real_escape_string($conn, $_POST['address']);
                  $state     = mysqli_real_escape_string($conn, $_POST['state']);
                  $city      = mysqli_real_escape_string($conn, $_POST['city']);
                  $pincode   = mysqli_real_escape_string($conn, $_POST['pincode']);
                  $dob       = mysqli_real_escape_string($conn, $_POST['dob']);
                  $gender    = mysqli_real_escape_string($conn, $_POST['gender']);

                  $job_category = mysqli_real_escape_string($conn, $_POST['job_category']);
                  $job_location = mysqli_real_escape_string($conn, $_POST['job_location']);

                  //loop thru dyanamic fields
                  $education1 = array();
                  $education2 = array();
                  $education3 = array();
                  $education4 = array();
                  for ($i=1; $i < 5; $i++) {
                    $optional_fields1 = array(
                      "edu_course_$i",
                      "edu_institute_$i",
                      "edu_year_$i",
                    );
                    foreach($optional_fields1 as $fieldo) {
                      $fieldo_value = "";
                      if ( isset( $_POST[$fieldo] ) && !empty( $_POST[$fieldo] ) ) {
                        $fieldo_value = mysqli_real_escape_string($conn, $_POST[$fieldo]);
                        ${'education'.$i}[$fieldo] = $fieldo_value;
                      }
                      $_POST[$fieldo] = $fieldo_value;
                    }
                  }

                  //loop thru dyanamic fields
                  $experience1 = array();
                  $experience2 = array();
                  $experience3 = array();
                  $experience4 = array();
                  for ($i=1; $i < 5; $i++) {
                    $optional_fields1 = array(
                      "exp_title_$i",
                      "exp_company_$i",
                      "exp_years_$i",
                    );
                    foreach($optional_fields1 as $fieldo) {
                      $fieldo_value = "";
                      if ( isset( $_POST[$fieldo] ) && !empty( $_POST[$fieldo] ) ) {
                        $fieldo_value = mysqli_real_escape_string($conn, $_POST[$fieldo]);
                        ${'experience'.$i}[$fieldo] = $fieldo_value;
                      }
                      $_POST[$fieldo] = $fieldo_value;
                    }
                  }

                  // serialize arrays if not empty
                  $education1 = (!empty($education1)) ? serialize($education1) : '' ;
                  $education2 = (!empty($education2)) ? serialize($education2) : '' ;
                  $education3 = (!empty($education3)) ? serialize($education3) : '' ;
                  $education4 = (!empty($education4)) ? serialize($education4) : '' ;

                  $experience1 = (!empty($experience1)) ? serialize($experience1) : '' ;
                  $experience2 = (!empty($experience2)) ? serialize($experience2) : '' ;
                  $experience3 = (!empty($experience3)) ? serialize($experience3) : '' ;
                  $experience4 = (!empty($experience4)) ? serialize($experience4) : '' ;

                  $skills   = mysqli_real_escape_string($conn, $_POST['skills']);
                  $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);

                  $accepted_ext = array("pdf", "docx", "doc", "PDF", "DOCX", "DOC", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                  $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");

                  //grab existing files
                  $select = "SELECT * FROM userdata WHERE username = '$username'";
                  $que = mysqli_query($conn, $select);
                  $fet = mysqli_fetch_array($que);
                  $file_resume = $fet['file_resume'];
                  $file_profile_pic = $fet['file_profile_pic'];
                  // $file_identification = $fet['file_identification'];
                  // $uniqd = $username . round(microtime(true));
                  $uniqd = $username;

                  //file1
                  // $file_resume = '';
                  $fileserr2 = false;
                  if( empty($_FILES['file_resume']) ){
                    // $file_resume = '';
                    $fileserr2 = false;
                  } elseif( ($_FILES['file_resume']['size'] == 0) ){
                    // $file_resume = '';
                    $fileserr2 = false;
                  } else if( $_FILES['file_resume']['size'] > (1*1024*1024) ) { //1MB
                    $fileserr2 = true;
                  } else {
                    $temp = explode(".", $_FILES["file_resume"]["name"]);
                    $ext  = end($temp);
                    if( in_array($ext, $accepted_ext ) == false ){
                      $fileserr2 = true;
                    } else {
                      $newfilename = $uniqd . '_resume' . '.' . end($temp);
                      $imagetmp    = trim($_FILES['file_resume']['tmp_name']);
                      $path        = "../uploads/".$newfilename;
                      move_uploaded_file($imagetmp, $path);
                      $file_resume = $newfilename;
                      $fileserr2 = false;
                    }
                  }

                  //file2
                  // $file_profile_pic = '';
                  $fileserr1 = false;
                  if( empty($_FILES['file_profile_pic']) ){
                    // $file_profile_pic = '';
                    $fileserr1 = false;
                  } elseif( ($_FILES['file_profile_pic']['size'] == 0) ){
                    // $file_profile_pic = '';
                    $fileserr1 = false;
                  } elseif( $_FILES['file_profile_pic']['size'] > (1*1024*1024) ) { //1MB
                    $fileserr1 = true;
                  } else {
                    $temp = explode(".", $_FILES["file_profile_pic"]["name"]);
                    $ext  = end($temp);
                    if( in_array($ext, $accepted_img ) == false ){
                      $fileserr1 = true;
                    } else {
                      $newfilename = $uniqd . '_pic' . '.' . end($temp);
                      $imagetmp    = trim($_FILES['file_profile_pic']['tmp_name']);
                      $path        = "../uploads/".$newfilename;
                      move_uploaded_file($imagetmp, $path);
                      $file_profile_pic = $newfilename;
                      $fileserr1 = false;
                    }
                  }

                  //no files error
                  if( $fileserr1 || $fileserr2 ){
                    echo "<strong class='text-danger'>ERROR: Uploaded Files are Invalid or Over allowed size of 1MB. Try again with Valid files.</strong>";
                  } else {

                    $main_sql = "UPDATE users SET `email` = '$email', `password` = '$password', `fullname` = '$fullname', `status` = '$status' WHERE username = '$username' ";
                    $main_que = mysqli_prepare($conn, $main_sql);

                    if( $main_que ){
                      mysqli_stmt_execute($main_que);
                      echo "<strong class='text-success'>SUCCESS: User Updated. </strong>";

                      $data_sql = "UPDATE userdata SET `email` = '$email', `phone` = '$phone', `phone2` = '$phone2', `fullname` = '$fullname', `address` = '$address', `state` = '$state', `city` = '$city', `pincode` = '$pincode', `dob` = '$dob', `gender` = '$gender', `job_category` = '$job_category', `job_location` = '$job_location', `education1` = '$education1', `education2` = '$education2', `education3` = '$education3', `education4` = '$education4', `experience1` = '$experience1', `experience2` = '$experience2', `experience3` = '$experience3', `experience4` = '$experience4', `skills` = '$skills', `linkedin` = '$linkedin', `file_resume` = '$file_resume', `file_profile_pic` = '$file_profile_pic', `notes` = '$notes' WHERE username = '$username' ";
                      $data_que = mysqli_prepare($conn, $data_sql);
                      if( $data_que ){
                        mysqli_stmt_execute($data_que);
                        echo "<strong class='text-success'> Userdata also Updated.</strong>";
                      } else {
                        echo "<strong class='text-danger'> Userdata Updation failed. </strong>";
                      }

                    } else {
                      echo "<strong class='text-danger'> ERROR: User Updation failed. </strong>";
                    }

                  }

                }
                ?>
              </div>

              <!-- update form -->
              <div class="form-box p-2">
                <form id="updatemon_form" name="updatemon_form" action="" method="post" enctype="multipart/form-data">

                  <?php
                    // user info
                    $select = "SELECT * FROM users WHERE `username` = '$find_user'";
                    $que = mysqli_query($conn, $select);
                    $fet = mysqli_fetch_array($que);
                    $datef = date('d M, Y', strtotime($fet['dated']));
                    $get_user = $fet['username'];
                    // userdata info
                    $select2 = "SELECT * FROM userdata WHERE `username` = '$get_user'";
                    $que2 = mysqli_query($conn, $select2);
                    $fet2 = mysqli_fetch_array($que2);
                  ?>

                  <div class="row">
                    <div class="col-8">
                      <div class="pt-5">
                        <!-- <h3> <strong><?php echo $login_name; ?></strong> </h3> -->
                        <h3> <strong>Edit Profile</strong> </h3>
                        <p>Edit profile information of your account.</p>
                      </div>
                    </div>
                    <div class="col-4 text-right pb-3">
                      <img class="img-thumbnail profile-pic" src="uploads/<?php echo $fet2['file_profile_pic']; ?>" alt="">
                    </div>
                  </div>

                  <!-- form 1 table -->
                  <h5><strong>Login Details</strong></h5>
                  <table class="table table-bordered table-striped table-sm table-responsive-md">
                    <tbody>
                      <tr>
                        <td style="width: 30%;"> <strong class="py-2 d-block">Username</strong> </td>
                        <td style="width: 70%;">
                          <strong class="py-3"><?php echo $fet['username']; ?></strong>
                          <input type="hidden" name="username" value="<?php echo $fet['username']; ?>">
                        </td>
                      </tr>
                      <tr>
                        <td> <strong>Email</strong> </td>
                        <td> <input type="email" class="form-control" name="email" value="<?php echo $fet['email']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> <strong>Full Name</strong> </td>
                        <td> <input type="tel" class="form-control" name="fullname" value="<?php echo $fet['fullname']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> Set New Password </td>
                        <td> <input type="password" class="form-control" name="password" placeholder="new password"> </td>
                      </tr>
                      <tr>
                        <td> Confirm New Password </td>
                        <td> <input type="password" class="form-control" name="password2" placeholder="confirm password"> </td>
                      </tr>
                    </tbody>
                  </table>

                  <h5><strong>Personal Details</strong></h5>
                  <input type="hidden" name="form_type" value="<?php echo $fet2['form_type']; ?>">
                  <table class="table table-bordered table-striped table-sm table-responsive-md">
                    <tbody>
                      <tr>
                        <td style="width: 30%;"> Profile Photo </td>
                        <td style="width: 70%;">
                          <input type="file" class="form-control-file" name="file_profile_pic" accept="image/*" />
                          <small class="text-muted">Uploading new file will replace old file. <?php echo (!empty($fet2['file_profile_pic'])) ? ' <a href="../uploads/'.$fet2["file_profile_pic"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
                        </td>
                      </tr>
                      <tr>
                        <td> Resume / CV </td>
                        <td>
                          <input type="file" class="form-control-file" name="file_resume" accept="image/*, .pdf, .docx, .doc" />
                          <small class="text-muted">Uploading new file will replace old file. <?php echo (!empty($fet2['file_resume'])) ? ' <a href="../uploads/'.$fet2["file_resume"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
                        </td>
                      </tr>
                      <tr>
                        <td> Phone </td>
                        <td> <input type="text" class="form-control" name="phone" value="<?php echo $fet2['phone']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> Phone 2 </td>
                        <td> <input type="text" class="form-control" name="phone2" value="<?php echo $fet2['phone2']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> Address </td>
                        <td> <input type="text" class="form-control" name="address" value="<?php echo $fet2['address']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> State </td>
                        <td> <input type="text" class="form-control" name="state" value="<?php echo $fet2['state']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> City </td>
                        <td> <input type="text" class="form-control" name="city" value="<?php echo $fet2['city']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> Pincode </td>
                        <td> <input type="text" class="form-control" name="pincode" value="<?php echo $fet2['pincode']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> DOB </td>
                        <td> <input type="text" class="form-control" name="dob" value="<?php echo $fet2['dob']; ?>"> </td>
                      </tr>
                      <tr>
                        <td> Gender </td>
                        <td> <input type="text" class="form-control" name="gender" value="<?php echo $fet2['gender']; ?>"> </td>
                      </tr>
                    </tbody>
                  </table>

                  <?php if($login_role=='user'){ ?>
                    <h5><strong>User Profile</strong></h5>
                    <table class="table table-bordered table-striped table-sm table-responsive-md">
                      <tbody>
                        <tr>
                          <td style="width: 30%;"> Skills </td>
                          <td style="width: 70%;">
                            <input type="text" class="form-control" name="skills" value="<?php echo $fet2['skills']; ?>">
                          </td>
                        </tr>
                        <tr>
                          <td> Education 1 </td>
                          <td>
                            <?php $edu1 = unserialize($fet2['education1']); // echo $fet2['education1']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="edu_course_1" value="<?php echo $edu1['edu_course_1']; ?>" placeholder="course">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_institute_1" value="<?php echo $edu1['edu_institute_1']; ?>" placeholder="institute">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_year_1" value="<?php echo $edu1['edu_year_1']; ?>" placeholder="year">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Education 2 </td>
                          <td>
                            <?php $edu2 = unserialize($fet2['education2']); // echo $fet2['education2']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="edu_course_2" value="<?php echo $edu2['edu_course_2']; ?>" placeholder="course">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_institute_2" value="<?php echo $edu2['edu_institute_2']; ?>" placeholder="institute">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_year_2" value="<?php echo $edu2['edu_year_2']; ?>" placeholder="year">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Education 3 </td>
                          <td>
                            <?php $edu3 = unserialize($fet2['education3']); // echo $fet2['education3']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="edu_course_3" value="<?php echo $edu3['edu_course_3']; ?>" placeholder="course">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_institute_3" value="<?php echo $edu3['edu_institute_3']; ?>" placeholder="institute">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_year_3" value="<?php echo $edu3['edu_year_3']; ?>" placeholder="year">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Education 4 </td>
                          <td>
                            <?php $edu4 = unserialize($fet2['education4']); // echo $fet2['education4']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="edu_course_4" value="<?php echo $edu4['edu_course_4']; ?>" placeholder="course">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_institute_4" value="<?php echo $edu4['edu_institute_4']; ?>" placeholder="institute">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="edu_year_4" value="<?php echo $edu4['edu_year_4']; ?>" placeholder="year">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Experience 1 </td>
                          <td>
                            <?php $exp1 = unserialize($fet2['experience1']); // echo $fet2['experience1']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="exp_title_1" value="<?php echo $exp1['exp_title_1']; ?>" placeholder="title">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_company_1" value="<?php echo $exp1['exp_company_1']; ?>" placeholder="company">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_years_1" value="<?php echo $exp1['exp_years_1']; ?>" placeholder="years">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Experience 2 </td>
                          <td>
                            <?php $exp2 = unserialize($fet2['experience2']); // echo $fet2['experience2']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="exp_title_2" value="<?php echo $exp2['exp_title_2']; ?>" placeholder="title">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_company_2" value="<?php echo $exp2['exp_company_2']; ?>" placeholder="company">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_years_2" value="<?php echo $exp2['exp_years_2']; ?>" placeholder="years">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Experience 3 </td>
                          <td>
                            <?php $exp3 = unserialize($fet2['experience3']); // echo $fet2['experience3']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="exp_title_3" value="<?php echo $exp3['exp_title_3']; ?>" placeholder="title">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_company_3" value="<?php echo $exp3['exp_company_3']; ?>" placeholder="company">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_years_3" value="<?php echo $exp3['exp_years_3']; ?>" placeholder="years">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Experience 4 </td>
                          <td>
                            <?php $exp4 = unserialize($fet2['experience4']); // echo $fet2['experience4']; ?>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" name="exp_title_4" value="<?php echo $exp4['exp_title_4']; ?>" placeholder="title">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_company_4" value="<?php echo $exp4['exp_company_4']; ?>" placeholder="company">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="exp_years_4" value="<?php echo $exp4['exp_years_4']; ?>" placeholder="years">
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> Linkedin </td>
                          <td> <input type="text" class="form-control" name="linkedin" value="<?php echo $fet2['linkedin']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> <strong>Job Category</strong> </td>
                          <td> <input type="text" class="form-control" name="job_category" value="<?php echo $fet2['job_category']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> <strong>Job Location</strong> </td>
                          <td> <input type="text" class="form-control" name="job_location" value="<?php echo $fet2['job_location']; ?>"> </td>
                        </tr>
                      </tbody>
                    </table>
                  <?php } ?>

                  <?php if($login_role=='employer'){ ?>
                    <h5><strong>Employer Profile</strong></h5>
                    <table class="table table-bordered table-striped table-sm table-responsive-md">
                      <tbody>
                        <tr>
                          <td style="width: 30%;"> Company Name  </td>
                          <td style="width: 70%;">
                            <input type="text" class="form-control" name="com_name" value="<?php echo $fet2['com_name']; ?>">
                          </td>
                        </tr>
                        <tr>
                          <td> Company Industry </td>
                          <td> <input type="text" class="form-control" name="com_industry" value="<?php echo $fet2['com_industry']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company Location </td>
                          <td> <input type="text" class="form-control" name="com_location" value="<?php echo $fet2['com_location']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company Website </td>
                          <td> <input type="text" class="form-control" name="com_website" value="<?php echo $fet2['com_website']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company Phone </td>
                          <td> <input type="text" class="form-control" name="com_phone" value="<?php echo $fet2['com_phone']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company Email </td>
                          <td> <input type="text" class="form-control" name="com_email" value="<?php echo $fet2['com_email']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company Address </td>
                          <td> <input type="text" class="form-control" name="com_address" value="<?php echo $fet2['com_address']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company State </td>
                          <td> <input type="text" class="form-control" name="com_state" value="<?php echo $fet2['com_state']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company City </td>
                          <td> <input type="text" class="form-control" name="com_city" value="<?php echo $fet2['com_city']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> Company Pincode </td>
                          <td> <input type="text" class="form-control" name="com_pincode" value="<?php echo $fet2['com_pincode']; ?>"> </td>
                        </tr>
                        <tr>
                          <td> LinkedIn</td>
                          <td> <input type="text" class="form-control" name="linkedin" value="<?php echo $fet2['linkedin']; ?>"> </td>
                        </tr>
                      </tbody>
                    </table>
                  <?php } ?>


                  <div class="my-4 text-center">
                    <input type="submit" class="btn btn-primary" name="updatemon" value="UPDATE">
                    <a href="profile.php" class="btn btn-dark">Cancel</a> <br><br>
                  </div>

                </form>
              </div>



            </div>
          <?php

        } else { /* ELSE SHOW ERROR */
          ?>
          <div class="p-3 border-bottom">
            <h3> <strong>No user found!</strong> </h3>
            <p>No Data found via given id. Please go back and try again.</p>
          </div>
          <?php
        } //if else end
        ?>


      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); //footer ?>
