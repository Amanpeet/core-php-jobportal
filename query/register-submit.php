<?php

//process form data
if( isset($_POST['register_submit']) && !empty($_POST['register_submit'])  ){

  //set errors
  $error = 0;

  // validate captcha
  if( isset($_POST['form_captcha']) && !empty($_POST['form_captcha'])  ){
    $form_captcha = $_POST['form_captcha'];
    if( $form_captcha == $_SESSION['code'] ){
      // echo "captcha validation successfull. ";
    } else {
      // $error = "<h5 class='text-danger'> ERROR: Captcha validation failed. </h5>";
    }
  } else {
    // $error = "<h5 class='text-danger'> ERROR: Form captcha not found. </h5>";
  }

  // Required field names
  $required_fields = array(
    'form_type',
    'username',
    'email',
    'password',
    'password2',
    'fullname',
    'phone',
    'phone2',
    'address',
    'state',
    'city',
    'pincode',
    'dob',
    'gender',
  );
  foreach($required_fields as $field) {
    if ( !isset( $_POST[$field] ) || empty( $_POST[$field] ) ) {
      $error = "<h5 class='text-danger'> ERROR: Required fields Empty or Invalid. </h5>".$_POST[$field];
    } else {
      $trim_val = mysqli_real_escape_string($conn, $_POST[$field]);
      if ( trim($trim_val) == '' ){
        $error = "<h5 class='text-danger'> ERROR: Required fields cant be just spaces. </h5>";
      }
    }
  }

  // Set Optional Values
  $optional_fields = array(
    'job_category',
    'job_location',
    'linkedin',
    'skills',
    'com_name',
    'com_industry',
    'com_location',
    'com_website',
    'com_phone',
    'com_email',
    'com_address',
    'com_state',
    'com_city',
    'com_pincode',
  );
  foreach($optional_fields as $fieldo) {
    $fieldo_value = "";
    if ( isset( $_POST[$fieldo] ) && !empty( $_POST[$fieldo] ) ) {
      $fieldo_value = mysqli_real_escape_string($conn, $_POST[$fieldo]);
    }
    $_POST[$fieldo] = $fieldo_value; //not errors
  }

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

  // Confirm Employer or User
  if ( $_POST['form_type'] != 'employer' && $_POST['form_type'] != 'user') {
    $error = "<h5 class='text-danger'> ERROR: Register type Unknown. </h5>";
  }

  // Confirm Password
  if( $_POST["password"] != $_POST["password2"] ) {
    $error = "<h5 class='text-danger'> ERROR: Passwords do not match. Please try again. </h5>";
  }

  // Validate Password strength
  $uppercase = preg_match('@[A-Z]@', $_POST['password']);
  $lowercase = preg_match('@[a-z]@', $_POST['password']);
  $number    = preg_match('@[0-9]@', $_POST['password']);
  if( !$uppercase || !$lowercase || !$number || strlen($_POST['password']) < 8 ) {
    $error = "<h5 class='text-danger'> ERROR: Password should be over 8 chars with a Uppercase, Lowercase & Number.</h5>";
  }

  // Validate username
  if( !preg_match('/^[a-z0-9]{4,20}$/', $_POST['username']) ){
    $error = "<h5 class='text-danger'> ERROR: Username seems invalid. Please try again. </h5>";
  }

  //Check if username exists in database
  $check_username = mysqli_real_escape_string($conn, $_POST['username']);
  $sql1 = "SELECT * FROM users WHERE `username`='$check_username' ";
  $result1 = mysqli_query($conn, $sql1);
  if( mysqli_num_rows($result1) > 0 ) { //existing username
    $error = "<h5 class='text-danger'> ERROR: User already exists with same Username. </h5>";
  }

  //Check if email exists in database
  $check_email = mysqli_real_escape_string($conn, $_POST['email']);
  $sql2 = "SELECT * FROM users WHERE `email`='$check_email' ";
  $result2 = mysqli_query($conn, $sql2);
  if( mysqli_num_rows($result2) > 0 ){ //existing email
    $error = "<h5 class='text-danger'> ERROR: User already exists with same Email Address. </h5>";
  }

  //if not any error
  if ( $error === 0) {

    //set field vars
    $form_type = mysqli_real_escape_string($conn, $_POST['form_type']);
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $password  = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
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

    // $uniqd = $username . round(microtime(true));
    $uniqd = $username;
    $password = md5($password);
    $status = "active";

    $accepted_ext = array("pdf", "docx", "doc", "PDF", "DOCX", "DOC", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
    $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");

    //file1
    $file_resume = '';
    $fileserr1 = false;
    if( empty($_FILES['file_resume']) ){
      $file_resume = '';
      $fileserr3 = false;
    } elseif( ($_FILES['file_resume']['size'] == 0) ){
      $file_resume = '';
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
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $file_resume = $newfilename;
        $fileserr1 = false;
      }
    }

    //file2
    $file_profile_pic = '';
    $fileserr3 = false;
    if( empty($_FILES['file_profile_pic']) ){
      $file_profile_pic = '';
      $fileserr3 = false;
    } elseif( ($_FILES['file_profile_pic']['size'] == 0) ){
      $file_profile_pic = '';
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
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $file_profile_pic = $newfilename;
        $fileserr1 = false;
      }
    }

    //file3
    $file_identification = '';
    $fileserr2 = false;
    if( empty($_FILES['file_identification']) ){
      $file_identification = '';
      $fileserr3 = false;
    } elseif( ($_FILES['file_identification']['size'] == 0) ){
      $file_identification = '';
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
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $file_identification = $newfilename;
        $fileserr1 = false;
      }
    }



    //no files error
    if( $fileserr1 || $fileserr2 || $fileserr3 ){
      echo "<h5 class='text-danger'>ERROR: Uploaded Files are Invalid or Over allowed size of 1MB. Try again with Valid files.</h5>";
      reloadformvalues();

    } else {

      $main_sql = "INSERT INTO `users`( `username`, `email`, `password`, `fullname`, `role`, `status` ) VALUES ( '$username', '$email', '$password', '$fullname', '$form_type', '$status' )";
      $main_que = mysqli_prepare($conn, $main_sql);

      if( $main_que ){
        mysqli_stmt_execute($main_que);
        echo "<h5 class='text-success'><strong> SUCCESS: Registration Successfull. You can login now! </strong></h5>";

        $data_sql = "INSERT INTO `userdata`( `form_type`, `username`, `email`, `phone`, `phone2`, `fullname`, `address`, `state`, `city`, `pincode`, `dob`, `gender`, `job_category`, `job_location`, `education1`, `education2`, `education3`, `education4`, `experience1`, `experience2`, `experience3`, `experience4`, `skills`, `linkedin`, `com_name`, `com_industry`, `com_location`, `com_website`, `com_phone`, `com_email`, `com_address`, `com_state`, `com_city`, `com_pincode`, `file_resume`, `file_identification`, `file_profile_pic` ) VALUES ( '$form_type', '$username', '$email', '$phone', '$phone2', '$fullname', '$address', '$state', '$city', '$pincode', '$dob', '$gender', '$job_category', '$job_location', '$education1', '$education2', '$education3', '$education4', '$experience1', '$experience2', '$experience3', '$experience4', '$skills', '$linkedin',  '$com_name', '$com_industry', '$com_location', '$com_website', '$com_phone', '$com_email', '$com_address', '$com_state', '$com_city', '$com_pincode', '$file_resume', '$file_identification', '$file_profile_pic' )";
        $data_que = mysqli_prepare($conn, $data_sql);
        if( $data_que ){
          mysqli_stmt_execute($data_que);
          // echo "<h5 class='text-success'> SUCCESS: Userdata Registered.</h5>";
        } else {
          // echo "<h5 class='text-danger'> ERROR: Userdata Insert failed. </h5>";
        }

        //SEND MAIL TO ALERT ADMINS
        // $form_type = "Quick Travellers Form";
        // $query = "New Quick Travellers Form Filled on IndiaVisa.co.uk UK Website.";
        // $to = "enquiry@indiavisa.co.uk";
        // // $to = "amanpreet@intiger.in";
        // $from = "alert@indianevisaonline.com";
        // $subject = "IndiaVisa.co.uk New Quick Travellers Form";
        // $message = "<html><head><title>New Quick Travellers Form</title></head><body>";
        // $message .= "<p>New Quick Travellers Form on IndiaVisa.co.uk UK Website.</p>";
        // $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
        // $message .= "<tr> <td>Visa Type</td> <td>".$pay_type." (Quick Form) </td> </tr>";
        // $message .= "<tr> <td>Travellers</td> <td>".$qck_travellers."</td> </tr>";
        // $message .= "<tr> <td>Form ID</td> <td>".$qck_id."</td> </tr>";
        // $message .= "<tr> <td>Email</td> <td>".$user_email."</td> </tr>";
        // $message .= "<tr> <td>Source</td> <td>".$query."</td> </tr>";
        // $message .= "</table>";
        // $message .= "</body></html>";
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $headers .= 'From: <'.$from.'>' . "\r\n";
        // $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
        // $mail_check = @mail($to, $subject, $message, $headers);

      } else {
        echo "<h5 class='text-danger'> ERROR: Registration failed. Try again later. </h5>";
        reloadformvalues();
      }

    }

  } else {
    echo $error;
    //set form values if errors
    reloadformvalues();
  }

}//end process

// Set the previous Form Values
function reloadformvalues(){
  ?>
  <script type="text/javascript">
    $(document).ready(function(){
      <?php foreach ($_POST as $fieldName => $fieldValue): ?>
      $("input[type=text][name=<?php echo $fieldName; ?>]").val("<?php echo $fieldValue; ?>");
      console.log('form values set again');
      <?php endforeach; ?>
    });
  </script>
  <?php
}
