<?php include('inc/header.php'); ?>

<?php
/* IF DELETE MEMBER */
if( isset($_REQUEST['del']) ) {
  $id = $_REQUEST['del'];
  $del_user = '';
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>Delete User</strong> </h3>
      <p>Confirm deletion of Specific User.</p>
    </div>
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post">
        <?php
          $select = "SELECT * FROM users WHERE uid = '$id' AND username != 'admin' "; //save admin
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
          $del_user = $fet['username'];
        ?>
        <h5>Do you really want to delete id:<strong><?php echo $fet['uid']; ?> (Name: <?php echo $del_user; ?>) </strong>from database? </h5>
        <p> Note: This action cannot be undone. </p>
        <div class="text-left">
          <input type="submit" class="btn btn-danger" name="deletemon" value="Delete">
          <a class="btn btn-dark" href="users.php">Cancel</a>
          <br><br>
        </div>
      </form>
    </div>

    <div id="response" class="h5 pt-3 text-danger">
      <?php
      if(isset($_POST['deletemon'])){
        $delete1 = "DELETE FROM users WHERE `uid` = '$id' AND `username` != 'admin' ";
        $delete2 = "DELETE FROM userdata WHERE `username` = '$del_user' AND `username` != 'admin' ";
        $quer1 = mysqli_query($conn, $delete1);
        $quer2 = mysqli_query($conn, $delete2);
        if( $quer1 && $quer2 ){
          userlog('user_delete', "Deleted user with id: $id"); //record keeping
          echo "<strong>SUCCESS: User Deleted. Redirecting back...";
          echo '<script>window.location="users.php";</script>';
        } else{
          echo "<strong>ERROR: User not deleted. Please try again later.</strong>";
        }
      }
      ?>
    </div>
    <?php

/* IF ADD MEMBER */
} elseif( isset($_REQUEST['add']) ) {
  $id = $_REQUEST['add'];
  ?>
  <div class="p-2 border-bottom">
    <h3> <strong>Add User</strong> </h3>
    <p>Write Details and Hit <strong>Add User</strong> on bottom. Some fields can't be changed later.</p>
  </div>

  <!-- Operation updatemon -->
  <div id="response" class="h5 pt-3 text-danger">
    <?php
    if(isset($_POST['addmon'])) {

      // Required field names
      $required_fields = array(
        'username',
        'password',
        'email',
        'fullname',
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
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $email    = mysqli_real_escape_string($conn, $_POST['email']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $status   = mysqli_real_escape_string($conn, $_POST['status']);

        $role = 'user'; //fill role if active

        //get old values
        $ex_sql = "SELECT username FROM admins WHERE (username = '$username' OR email = '$email') UNION ALL SELECT username FROM users WHERE(username = '$username' OR email = '$email') ";
        $ex_query = mysqli_query($conn, $ex_sql);
        $ex_row   = mysqli_fetch_array($ex_query);
        if( mysqli_num_rows($ex_query) > 0 ){
          echo "<strong>ERROR: Username or Email already Exists. Please try again.</strong>";
        } elseif( !preg_match('/^[a-z0-9]{4,20}$/', $username) ){ //validate username
          echo "<strong>ERROR: Username seems invalid. Please try again.</strong>";
        } else {

          // add to db
          $insert_sql = "INSERT INTO users(`username`, `password`, `email`, `role`, `fullname`, `status` ) VALUES( '$username', MD5('$password'), '$email', '$role', '$fullname', '$status' ) ";
          $insert_sql2 = "INSERT INTO userdata(`username`, `email`, `form_type`, `fullname`) VALUES( '$username', '$email', '$role', '$fullname' ) ";

          $quer = mysqli_prepare($conn, $insert_sql);
          $quer2 = mysqli_prepare($conn, $insert_sql2);

          if( $quer && $quer2 ){
            $querx = mysqli_stmt_execute($quer);
            $quer2x = mysqli_stmt_execute($quer2);

            $last = mysqli_insert_id($conn);

            userlog('user_add', "Added new user with id: $last"); //record keeping
            echo "<strong class='text-success'>SUCCESS: New User Added Successfully.</strong>";
            // echo '<script>window.location="users-single.php?view='.$last.'&added=1";</script>';
          } else {
            echo "<strong>ERROR: New User not Added. Please try again later.</strong>";
          }

        }
      }
    }
    ?>
  </div>

  <!-- add form -->
  <div class="form-box p-2">
    <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
      <div class="py-2">
        <small> All fields are required. Additional fields are available in frontend. </small>
      </div>
      <table class="table table-bordered table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> <strong>Username</strong> </td>
            <td style="width: 60%;">
              <input type="text" class="form-control" name="username" required>
            </td>
            <td style="width: 20%;">
            </td>
          </tr>
          <tr>
            <td> <strong>Password</strong> </td>
            <td> <input type="text" class="form-control" name="password" required> </td>
          </tr>
          <tr>
            <td> <strong>Email</strong> </td>
            <td> <input type="email" class="form-control" name="email" required> </td>
          </tr>
          <tr>
            <td> Full Name </td>
            <td> <input type="text" class="form-control" name="fullname" required> </td>
          </tr>
          <tr>
            <td> Status </td>
            <td>
              <select name="status" class="form-control w-50" required>
                <option value="">Set Status</option>
                <option value="pending">pending</option>
                <option value="active">active</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="my-4">
        <input type="submit" class="btn btn-primary" name="addmon" value="ADD USER">
        <a href="admins.php" class="btn btn-dark">Cancel</a> <br><br>
      </div>

    </form>
  </div>
  <?php

/* IF UPDATE MEMBER */
} elseif( isset($_REQUEST['edit']) ) {
  $id = $_REQUEST['edit'];
  ?>

  <div class="p-2 border-bottom">
    <h3> <strong>Edit User</strong> </h3>
    <p>Edit Fields and Hit <strong>UPDATE</strong> on bottom. Some fields can't be changed. Once values are updated, they cannot be reversed.</strong> </p>
  </div>

  <!-- Operation updatemon -->
  <div id="response" class="h5">
    <?php
    if(isset($_POST['updatemon'])) {

      //set field vars
      $username  = mysqli_real_escape_string($conn, $_POST['username']);
      $form_type = mysqli_real_escape_string($conn, $_POST['form_type']);
      $email     = mysqli_real_escape_string($conn, $_POST['email']);
      $pass1  = mysqli_real_escape_string($conn, $_POST['password']);
      $pass2 = mysqli_real_escape_string($conn, $_POST['password2']);

      //grab existing files
      $select1 = "SELECT * FROM users WHERE `uid` = '$id'";
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

      $com_name     = mysqli_real_escape_string($conn, $_POST['com_name']);
      $com_industry = mysqli_real_escape_string($conn, $_POST['com_industry']);
      $com_location = mysqli_real_escape_string($conn, $_POST['com_location']);
      $com_website  = mysqli_real_escape_string($conn, $_POST['com_website']);
      $com_phone    = mysqli_real_escape_string($conn, $_POST['com_phone']);
      $com_email    = mysqli_real_escape_string($conn, $_POST['com_email']);
      $com_address  = mysqli_real_escape_string($conn, $_POST['com_address']);
      $com_state    = mysqli_real_escape_string($conn, $_POST['com_state']);
      $com_city     = mysqli_real_escape_string($conn, $_POST['com_city']);
      $com_pincode  = mysqli_real_escape_string($conn, $_POST['com_pincode']);

      $accepted_ext = array("pdf", "docx", "doc", "PDF", "DOCX", "DOC", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
      $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");

      //grab existing files
      $select = "SELECT * FROM userdata WHERE username = '$username'";
      $que = mysqli_query($conn, $select);
      $fet = mysqli_fetch_array($que);
      $file_resume = $fet['file_resume'];
      $file_profile_pic = $fet['file_profile_pic'];
      $file_identification = $fet['file_identification'];
      // $uniqd = $username . round(microtime(true));
      $uniqd = $username;

      //file1
      // $file_resume = '';
      $fileserr1 = false;
      if( empty($_FILES['file_resume']) ){
        // $file_resume = '';
        $fileserr3 = false;
      } elseif( ($_FILES['file_resume']['size'] == 0) ){
        // $file_resume = '';
        $fileserr1 = false;
      } else if( $_FILES['file_resume']['size'] > (1*1024*1024) ) { //1MB
        $fileserr1 = true;
      } else {
        $temp = explode(".", $_FILES["file_resume"]["name"]);
        $ext  = end($temp);
        if( in_array($ext, $accepted_ext ) == false ){
          $fileserr1 = true;
        } else {
          $newfilename = $uniqd . '_resume' . '.' . end($temp);
          $imagetmp    = trim($_FILES['file_resume']['tmp_name']);
          $path        = "../uploads/".$newfilename;
          move_uploaded_file($imagetmp, $path);
          $file_resume = $newfilename;
          $fileserr1 = false;
        }
      }

      //file2
      // $file_profile_pic = '';
      $fileserr3 = false;
      if( empty($_FILES['file_profile_pic']) ){
        // $file_profile_pic = '';
        $fileserr3 = false;
      } elseif( ($_FILES['file_profile_pic']['size'] == 0) ){
        // $file_profile_pic = '';
        $fileserr3 = false;
      } elseif( $_FILES['file_profile_pic']['size'] > (1*1024*1024) ) { //1MB
        $fileserr3 = true;
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

      //file3
      // $file_identification = '';
      $fileserr2 = false;
      if( empty($_FILES['file_identification']) ){
        // $file_identification = '';
        $fileserr3 = false;
      } elseif( ($_FILES['file_identification']['size'] == 0) ){
        // $file_identification = '';
        $fileserr2 = false;
      } else if( $_FILES['file_identification']['size'] > (1*1024*1024) ) { //1MB
        $fileserr2 = true;
      } else {
        $temp = explode(".", $_FILES["file_identification"]["name"]);
        $ext  = end($temp);
        if( in_array($ext, $accepted_ext ) == false ){
          $fileserr1 = true;
        } else {
          $newfilename = $uniqd . '_id' . '.' . end($temp);
          $imagetmp    = trim($_FILES['file_identification']['tmp_name']);
          $path        = "../uploads/".$newfilename;
          move_uploaded_file($imagetmp, $path);
          $file_identification = $newfilename;
          $fileserr1 = false;
        }
      }

      //no files error
      if( $fileserr1 || $fileserr2 || $fileserr3 ){
        echo "<strong class='text-danger'>ERROR: Uploaded Files are Invalid or Over allowed size of 1MB. Try again with Valid files.</strong>";
      } else {

        $main_sql = "UPDATE users SET `email` = '$email', `password` = '$password', `fullname` = '$fullname', `status` = '$status' WHERE username = '$username' ";
        $main_que = mysqli_prepare($conn, $main_sql);

        if( $main_que ){
          mysqli_stmt_execute($main_que);
          echo "<strong class='text-success'>SUCCESS: User Updated. </strong>";

          $data_sql = "UPDATE userdata SET `email` = '$email', `phone` = '$phone', `phone2` = '$phone2', `fullname` = '$fullname', `address` = '$address', `state` = '$state', `city` = '$city', `pincode` = '$pincode', `dob` = '$dob', `gender` = '$gender', `job_category` = '$job_category', `job_location` = '$job_location', `education1` = '$education1', `education2` = '$education2', `education3` = '$education3', `education4` = '$education4', `experience1` = '$experience1', `experience2` = '$experience2', `experience3` = '$experience3', `experience4` = '$experience4', `skills` = '$skills', `com_name` = '$com_name', `com_industry` = '$com_industry', `com_location` = '$com_location', `com_website` = '$com_website', `com_phone` = '$com_phone', `com_email` = '$com_email', `com_address` = '$com_address', `com_state` = '$com_state', `com_city` = '$com_city', `com_pincode` = '$com_pincode', `file_resume` = '$file_resume', `file_identification` = '$file_identification', `file_profile_pic` = '$file_profile_pic' WHERE username = '$username' ";
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
        $select = "SELECT * FROM users WHERE `uid` = '$id' AND username != 'admin'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $datef = date('d M, Y', strtotime($fet['dated']));
        $get_user = $fet['username'];
      ?>
      <div class="row border-bottom mb-3">
        <div class="col-md-8">
          <div class="pt-2 pb-3">
            <!-- <h4><?php echo $id; ?></h4> -->
            <small class="text-muted"> Created on <?php echo $datef; ?></small><br>
            <a class="btn btn-primary" href="users-single.php?view=<?php echo $fet['uid']; ?>">View or Print</a>
            <a class="btn btn-danger" href="users-single.php?del=<?php echo $fet['uid']; ?>">Delete</a>
          </div>
        </div>
      </div>

      <!-- form 1 table -->
      <h5><strong>Login Details</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> <strong>Username</strong> </td>
            <td style="width: 60%;">
              <?php echo $fet['username']; ?>
              <input type="hidden" name="username" value="<?php echo $fet['username']; ?>">
            </td>
            <td style="width: 20%;"> </td>
          </tr>
          <tr>
            <td> New Password </td>
            <td> <input type="text" class="form-control" name="password" placeholder="set new password"> </td>
          </tr>
          <tr>
            <td> Confirm Password </td>
            <td> <input type="text" class="form-control" name="password2" placeholder="confirm password"> </td>
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
            <td> Account Status </td>
            <td>
              <select name="status" class="form-control">
                <option value="<?php echo $fet['status']; ?>">Set Status</option>
                <option value="pending">pending</option>
                <option value="active">active</option>
              </select>
              <small>Current Status: <strong><?php echo $fet['status']; ?></strong></small>
            </td>
          </tr>
        </tbody>
      </table>

      <?php
        $select2 = "SELECT * FROM userdata WHERE `username` = '$get_user'";
        $que2 = mysqli_query($conn, $select2);
        $fet2 = mysqli_fetch_array($que2);
      ?>
      <h5><strong>Personal Details</strong></h5>
      <input type="hidden" name="form_type" value="<?php echo $fet2['form_type']; ?>">
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Profile Photo </td>
            <td style="width: 60%;">
              <input type="file" class="form-control-file" name="file_profile_pic" accept="image/*" />
              <small class="text-muted">Uploading new file will replace old file. <?php echo (!empty($fet2['file_profile_pic'])) ? ' <a href="../uploads/'.$fet2["file_profile_pic"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
            </td>
            <td style="width: 20%;" rowspan="6" class="table-light">
              <?php echo (!empty($fet2['file_profile_pic'])) ? ' <img src="../uploads/'.$fet2["file_profile_pic"].'" alt="" />  ' : ''; ?>
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
            <td> Identification </td>
            <td>
              <input type="file" class="form-control-file" name="file_identification" accept="image/*, .pdf, .docx, .doc" />
              <small class="text-muted">Uploading new file will replace old file. <?php echo (!empty($fet2['file_identification'])) ? ' <a href="../uploads/'.$fet2["file_identification"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
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

      <h5><strong>User Profile</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Skills </td>
            <td style="width: 60%;">
              <input type="text" class="form-control" name="skills" value="<?php echo $fet2['skills']; ?>">
            </td>
            <td style="width: 20%;"> </td>
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
            <td> <strong>Job Category</strong> </td>
            <td> <input type="text" class="form-control" name="job_category" value="<?php echo $fet2['job_category']; ?>"> </td>
          </tr>
          <tr>
            <td> <strong>Job Location</strong> </td>
            <td> <input type="text" class="form-control" name="job_location" value="<?php echo $fet2['job_location']; ?>"> </td>
          </tr>
          <tr>
            <td> <strong>Linkedin</strong> </td>
            <td> <input type="text" class="form-control" name="linkedin" value="<?php echo $fet2['linkedin']; ?>"> </td>
          </tr>
        </tbody>
      </table>

      <h5><strong>Employer Profile</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Company Name  </td>
            <td style="width: 60%;">
              <input type="text" class="form-control" name="com_name" value="<?php echo $fet2['com_name']; ?>">
            </td>
            <td style="width: 20%;"> </td>
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
        </tbody>
      </table>

      <!-- Admin Notes -->
      <h5 class="border-top pt-4 mt-4"><strong>NOTES</strong> <small>(For Admins use)</small> </h5>
      <table class="table table-bordered table-striped table-sm">
        <tbody>
          <tr>
            <!-- <td> </td> -->
            <td> <textarea class="form-control" name="notes"><?php echo $fet2['notes']; ?></textarea> <small>Extra notes or information</small> </td>
          </tr>
        </tbody>
      </table>

      <div class="my-4">
        <input type="submit" class="btn btn-primary btn-lg" name="updatemon" value="UPDATE">
        <a href="users.php" class="btn btn-dark">Cancel</a> <br><br>
      </div>

    </form>
  </div>


  <!-- Operation updatemon -->
  <div id="response" class="h5 pt-3 text-danger">
    <?php
    if(isset($_POST['updatemon'])) {

      $error = false;
      //get old values
      $ex_sql   = "SELECT * FROM users WHERE `uid` = '$id' AND username != 'admin' ";
      $ex_query = mysqli_query($conn, $ex_sql);
      $ex_row   = mysqli_fetch_array($ex_query);
      $password = $ex_row['password'];
      $email    = $ex_row['email'];
      $fullname = $ex_row['fullname'];
      $status   = $ex_row['status'];
      $role = ''; //fill role if active

      if( isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password2']) && !empty($_POST['password2']) ) {
        $pass1 = mysqli_real_escape_string($conn, $_POST['password']);
        $pass2 = mysqli_real_escape_string($conn, $_POST['password2']);
        if( $pass1 != $pass2 ){
          echo "<strong>ERROR: Passwords doesnt match, Not Updated. </strong>";
        } else {
          $password = md5($pass1);
          // $password1 = mysqli_real_escape_string($conn, $_POST['password2']); //not needed
        }
      }

    }
    ?>
  </div>

  <?php

/* IF VIEW MEMBER */
} elseif( isset($_REQUEST['view']) ) {
  $id = $_REQUEST['view'];
  ?>
      <!-- SHOW ALL ITEMS HERE -->
      <div class="p-2 border-bottom">
        <h3> <strong>View User</strong> </h3>
        <p>Viewing individual User details. Click <strong>Edit</strong> on right to modify details.</p>
      </div>

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h5 text-success">
        <?php
        if( isset($_REQUEST['updated']) ) {
          echo "<strong>SUCCESS: User Details Updated Successfully.</strong>";
        } elseif( isset($_REQUEST['added']) ) {
          echo "<strong>SUCCESS: New User Added Successfully.</strong>";
        }
        ?>
      </div>

      <?php
        $select = "SELECT * FROM users WHERE `uid` = '$id' AND username != 'admin'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $datef = date('d M, Y', strtotime($fet['dated']));
        $get_user = $fet['username'];
      ?>
      <div class="row border-bottom mb-3">
        <div class="col-md-8">
          <div class="pt-2 pb-3">
            <small class="text-muted"> Created on <?php echo $datef; ?></small><br>
            <a class="btn btn-primary" href="users-single.php?edit=<?php echo $fet['uid']; ?>">Edit this</a>
            <a class="btn btn-danger" href="users-single.php?del=<?php echo $fet['uid']; ?>">Delete</a>
          </div>
        </div>
      </div>

      <!-- form 1 table -->
      <h5><strong>Login Details</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> <strong>Username</strong> </td>
            <td style="width: 60%;"> <?php echo $fet['username']; ?> </td>
            <td style="width: 20%;"> </td>
          </tr>
          <tr>
            <td> <strong>Email</strong> </td>
            <td> <?php echo $fet['email']; ?> </td>
          </tr>
          <tr>
            <td> <strong>Full Name</strong> </td>
            <td> <?php echo $fet['fullname']; ?> </td>
          </tr>
          <tr>
            <td> Account Status </td>
            <td> <?php echo $fet['status']; ?> </td>
          </tr>
        </tbody>
      </table>

      <?php
        $select2 = "SELECT * FROM userdata WHERE `username` = '$get_user'";
        $que2 = mysqli_query($conn, $select2);
        $fet2 = mysqli_fetch_array($que2);
      ?>
      <h5><strong>Personal Details</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Profile Photo </td>
            <td style="width: 60%;">
              <?php echo (!empty($fet2['file_profile_pic'])) ? ' <a href="../uploads/'.$fet2["file_profile_pic"].'" target="_blank" /> View Photo </a> ' : ''; ?>
            </td>
            <td style="width: 20%;" rowspan="6" class="table-light">
              <?php echo (!empty($fet2['file_profile_pic'])) ? ' <img src="../uploads/'.$fet2["file_profile_pic"].'" alt="" />  ' : ''; ?>
            </td>
          </tr>
          <tr>
            <td> Resume / CV </td>
            <td>
              <?php echo (!empty($fet2['file_resume'])) ? ' <a href="../uploads/'.$fet2["file_resume"].'" target="_blank" /> View File </a> ' : ''; ?>
            </td>
          </tr>
          <tr>
            <td> Identification </td>
            <td>
              <?php echo (!empty($fet2['file_identification'])) ? ' <a href="../uploads/'.$fet2["file_identification"].'" target="_blank" /> View File </a> ' : ''; ?>
            </td>
          </tr>
          <tr>
            <td> User Type </td>
            <td><?php echo $fet2['form_type']; ?> </td>
          </tr>
          <tr>
            <td> Phone </td>
            <td> <?php echo $fet2['phone']; ?> </td>
          </tr>
          <tr>
            <td> Phone 2 </td>
            <td> <?php echo $fet2['phone2']; ?> </td>
          </tr>
          <tr>
            <td> Address </td>
            <td> <?php echo $fet2['address']; ?> </td>
          </tr>
          <tr>
            <td> State </td>
            <td> <?php echo $fet2['state']; ?> </td>
          </tr>
          <tr>
            <td> City </td>
            <td> <?php echo $fet2['city']; ?> </td>
          </tr>
          <tr>
            <td> Pincode </td>
            <td> <?php echo $fet2['pincode']; ?> </td>
          </tr>
          <tr>
            <td> DOB </td>
            <td> <?php echo $fet2['dob']; ?> </td>
          </tr>
          <tr>
            <td> Gender </td>
            <td> <?php echo $fet2['gender']; ?> </td>
          </tr>
        </tbody>
      </table>

      <h5><strong>User Profile</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Skills </td>
            <td style="width: 60%;"> <?php echo $fet2['skills']; ?> </td>
            <td style="width: 20%;"> </td>
          </tr>
          <tr>
            <td> Education 1 </td>
            <td>
              <?php $edu1 = unserialize($fet2['education1']); // echo $fet2['education1']; ?>
              <span class="text-muted">Course:</span> <?php echo $edu1['edu_course_1']; ?>
              <span class="text-muted pl-5">Institute:</span> <?php echo $edu1['edu_institute_1']; ?>
              <span class="text-muted pl-5">Year:</span> <?php echo $edu1['edu_year_1']; ?>
            </td>
          </tr>
          <tr>
            <td> Education 2 </td>
            <td>
              <?php $edu1 = unserialize($fet2['education2']); // echo $fet2['education2']; ?>
              <span class="text-muted">Course:</span> <?php echo $edu1['edu_course_2']; ?>
              <span class="text-muted pl-5">Institute:</span> <?php echo $edu1['edu_institute_2']; ?>
              <span class="text-muted pl-5">Year:</span> <?php echo $edu1['edu_year_2']; ?>
            </td>
          </tr>
          <tr>
            <td> Education 3 </td>
            <td>
              <?php $edu1 = unserialize($fet2['education3']); // echo $fet2['education3']; ?>
              <span class="text-muted">Course:</span> <?php echo $edu1['edu_course_3']; ?>
              <span class="text-muted pl-5">Institute:</span> <?php echo $edu1['edu_institute_3']; ?>
              <span class="text-muted pl-5">Year:</span> <?php echo $edu1['edu_year_3']; ?>
            </td>
          </tr>
          <tr>
            <td> Education 4 </td>
            <td>
              <?php $edu1 = unserialize($fet2['education4']); // echo $fet2['education4']; ?>
              <span class="text-muted">Course:</span> <?php echo $edu1['edu_course_4']; ?>
              <span class="text-muted pl-5">Institute:</span> <?php echo $edu1['edu_institute_4']; ?>
              <span class="text-muted pl-5">Year:</span> <?php echo $edu1['edu_year_4']; ?>
            </td>
          </tr>
          <tr>
            <td> Experience 1 </td>
            <td>
              <?php $exp1 = unserialize($fet2['experience1']); // echo $fet2['experience1']; ?>
              <span class="text-muted">Title:</span> <?php echo $edu1['exp_title_1']; ?>
              <span class="text-muted pl-5">Company:</span> <?php echo $edu1['exp_company_1']; ?>
              <span class="text-muted pl-5">Years:</span> <?php echo $edu1['exp_years_1']; ?>
            </td>
          </tr>
          <tr>
            <td> Experience 2 </td>
            <td>
              <?php $exp2 = unserialize($fet2['experience2']); // echo $fet2['experience2']; ?>
              <span class="text-muted">Title:</span> <?php echo $edu1['exp_title_2']; ?>
              <span class="text-muted pl-5">Company:</span> <?php echo $edu1['exp_company_2']; ?>
              <span class="text-muted pl-5">Years:</span> <?php echo $edu1['exp_years_2']; ?>
            </td>
          </tr>
          <tr>
            <td> Experience 3 </td>
            <td>
              <?php $exp3 = unserialize($fet2['experience3']); // echo $fet2['experience3']; ?>
              <span class="text-muted">Title:</span> <?php echo $edu1['exp_title_3']; ?>
              <span class="text-muted pl-5">Company:</span> <?php echo $edu1['exp_company_3']; ?>
              <span class="text-muted pl-5">Years:</span> <?php echo $edu1['exp_years_3']; ?>
            </td>
          </tr>
          <tr>
            <td> Experience 4 </td>
            <td>
              <?php $exp4 = unserialize($fet2['experience4']); // echo $fet2['experience4']; ?>
              <span class="text-muted">Title:</span> <?php echo $edu1['exp_title_4']; ?>
              <span class="text-muted pl-5">Company:</span> <?php echo $edu1['exp_company_4']; ?>
              <span class="text-muted pl-5">Years:</span> <?php echo $edu1['exp_years_4']; ?>
            </td>
          </tr>
          <tr>
            <td> <strong>Job Category</strong> </td>
            <td> <?php echo $fet2['job_category']; ?> </td>
          </tr>
          <tr>
            <td> <strong>Job Location</strong> </td>
            <td> <?php echo $fet2['job_location']; ?> </td>
          </tr>
        </tbody>
      </table>

      <h5><strong>Employer Profile</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Company Name  </td>
            <td style="width: 60%;"> <?php echo $fet2['com_name']; ?> </td>
            <td style="width: 20%;"> </td>
          </tr>
          <tr>
            <td> Company Industry </td>
            <td> <?php echo $fet2['com_industry']; ?> </td>
          </tr>
          <tr>
            <td> Company Location </td>
            <td> <?php echo $fet2['com_location']; ?> </td>
          </tr>
          <tr>
            <td> Company Website </td>
            <td> <?php echo $fet2['com_website']; ?> </td>
          </tr>
          <tr>
            <td> Company Phone </td>
            <td> <?php echo $fet2['com_phone']; ?> </td>
          </tr>
          <tr>
            <td> Company Email </td>
            <td> <?php echo $fet2['com_email']; ?> </td>
          </tr>
          <tr>
            <td> Company Address </td>
            <td> <?php echo $fet2['com_address']; ?> </td>
          </tr>
          <tr>
            <td> Company State </td>
            <td> <?php echo $fet2['com_state']; ?> </td>
          </tr>
          <tr>
            <td> Company City </td>
            <td> <?php echo $fet2['com_city']; ?> </td>
          </tr>
          <tr>
            <td> Company Pincode </td>
            <td> <?php echo $fet2['com_pincode']; ?> </td>
          </tr>
        </tbody>
      </table>

      <!-- Admin Notes -->
      <h5 class="border-top pt-4 mt-4"><strong>NOTES</strong> <small>(For Admins use)</small> </h5>
      <table class="table table-bordered table-striped table-sm">
        <tbody>
          <tr>
            <!-- <td> </td> -->
            <td colspan="2"> <?php echo $fet2['notes']; ?> </td>
          </tr>
          <tr>
            <td style="width: 50%;"> <strong>Activity</strong> </td>
            <td style="width: 50%;"> <strong>Count</strong> </td>
          </tr>
          <?php
          $activity_sql = "SELECT COUNT(*) as `count`, `action_term` FROM userlog WHERE `user_name` = '$get_user' GROUP BY action_term ";
          $activity_res = mysqli_query($conn, $activity_sql);
          while($activity_row = mysqli_fetch_array($activity_res)){
            $datef = date('d M, Y', strtotime($fet['dated']));
            ?>
            <tr>
              <td> <?php echo $activity_row['action_term']; ?> </td>
              <td> <?php echo $activity_row['count']; ?> </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>


  <?php

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Data not found</strong> </h3>
    <p>No Data found via given id. Please go back and try again.</p>
  </div>
  <?php
} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>