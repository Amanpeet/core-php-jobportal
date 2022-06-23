<?php

//process form data
if( isset($_POST['oci_submit']) && !empty($_POST['oci_submit'])  ){

  //set errors
  $errors = 0;

  // validate captcha
  if( isset($_POST['form_captcha']) && !empty($_POST['form_captcha'])  ){
    $form_captcha = $_POST['form_captcha'];
    if( $form_captcha == $_SESSION['code'] ){
      // echo "captcha validation successfull. ";
    } else {
      $errors = " ERROR: Captcha validation failed. ";
    }
  } else {
    $errors = " ERROR: Form captcha not found. ";
  }

  //chck if any error found
  if( $errors === 0 ){

    // Required field names
    $required_fields = array(
      'oci_surname',
      'oci_given_name',
      'oci_gender',
      'oci_dob',
      'oci_birth_country',
      'oci_birth_state',
      'oci_birth_city',
      'oci_nationality',
      'oci_visible_marks',
      'oci_fathers_name',
      'oci_fathers_nationality',
      'oci_mothers_name',
      'oci_mothers_nationality',
      'oci_martial_status',
      'oci_passport_num',
      'oci_issue_place',
      'oci_issue_date',
      'oci_expiry_date',
      'oci_occupation',
      'oci_employer_address',
      'oci_address_main',
      'oci_address_place',
      'oci_address_country',
      'oci_address_zipcode',
      'oci_email_id',
      'oci_phone_num',
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

    // Set Optional Values
    $optional_fields = array(
      'oci_marriage_date',
      'oci_spouse_name',
      'oci_spouse_nationality',
      'oci_spouse_passport_num',
      'oci_spouse_issue_place',
      'oci_spouse_issue_date',
      'oci_applied_check',
      'oci_applied_date',
      'oci_applied_where',
      'oci_applied_details',
      'oci_asylum_check',
      'oci_asylum_date',
      'oci_asylum_where',
      'oci_asylum_details',
      'oci_citizen_check',
      'oci_citizen_date',
      'oci_citizen_where',
      'oci_citizen_details',
      'oci_grandparents_check',
      'oci_grandparents_date',
      'oci_grandparents_where',
      'oci_grandparents_details',
      'oci_armed_check',
      'oci_armed_date',
      'oci_armed_where',
      'oci_armed_details',
      'oci_acquisition_name',
      'oci_acquisition_method',
      'oci_acquisition_date',
      'oci_acquisition_previous',
      'oci_ind_family_sr_no',
      'oci_ind_family_name',
      'oci_ind_family_address',
      'oci_ind_family_relation',
      'oci_criminal_applicant',
      'oci_criminal_date_place',
      'oci_criminal_nature',
      'oci_criminal_outcome',
      'oci_criminal_name',
      'oci_criminal_date',
      'oci_criminal_place',
      'oci_minor_name',
      'oci_minor_place',
      'oci_declaration_name',
      'oci_declaration_date',
      'oci_declaration_place',
      'oci_payment_mode',
    );

    // Loop over types, assign values if not set
    foreach($optional_fields as $fieldo) {
      $fieldo_value = "";
      if ( isset( $_POST[$fieldo] ) && !empty( $_POST[$fieldo] ) ) {
        $fieldo_value = mysqli_real_escape_string($conn, $_POST[$fieldo]);
      }
      $_POST[$fieldo] = $fieldo_value;
    }

    //if any error
    if ($error) {
      //errors defined above
      // echo "<strong> ERROR: Required fields Empty or Invalid. Please try again.</strong>";
    } else {

      //generate new form id
      $uniqd = round(microtime(true));
      $oci_id = "OCI".$uniqd;

      //set field vars
      $oci_surname              = mysqli_real_escape_string($conn, $_POST['oci_surname']);
      $oci_given_name           = mysqli_real_escape_string($conn, $_POST['oci_given_name']);
      $oci_gender               = mysqli_real_escape_string($conn, $_POST['oci_gender']);
      $oci_dob                  = mysqli_real_escape_string($conn, $_POST['oci_dob']);
      $oci_birth_country        = mysqli_real_escape_string($conn, $_POST['oci_birth_country']);
      $oci_birth_state          = mysqli_real_escape_string($conn, $_POST['oci_birth_state']);
      $oci_birth_city           = mysqli_real_escape_string($conn, $_POST['oci_birth_city']);
      $oci_nationality          = mysqli_real_escape_string($conn, $_POST['oci_nationality']);
      $oci_visible_marks        = mysqli_real_escape_string($conn, $_POST['oci_visible_marks']);
      $oci_fathers_name         = mysqli_real_escape_string($conn, $_POST['oci_fathers_name']);
      $oci_fathers_nationality  = mysqli_real_escape_string($conn, $_POST['oci_fathers_nationality']);
      $oci_mothers_name         = mysqli_real_escape_string($conn, $_POST['oci_mothers_name']);
      $oci_mothers_nationality  = mysqli_real_escape_string($conn, $_POST['oci_mothers_nationality']);
      $oci_martial_status       = mysqli_real_escape_string($conn, $_POST['oci_martial_status']);
      $oci_marriage_date        = mysqli_real_escape_string($conn, $_POST['oci_marriage_date']);
      $oci_spouse_name          = mysqli_real_escape_string($conn, $_POST['oci_spouse_name']);
      $oci_spouse_nationality   = mysqli_real_escape_string($conn, $_POST['oci_spouse_nationality']);
      $oci_spouse_passport_num  = mysqli_real_escape_string($conn, $_POST['oci_spouse_passport_num']);
      $oci_spouse_issue_place   = mysqli_real_escape_string($conn, $_POST['oci_spouse_issue_place']);
      $oci_spouse_issue_date    = mysqli_real_escape_string($conn, $_POST['oci_spouse_issue_date']);
      $oci_passport_num         = mysqli_real_escape_string($conn, $_POST['oci_passport_num']);
      $oci_issue_place          = mysqli_real_escape_string($conn, $_POST['oci_issue_place']);
      $oci_issue_date           = mysqli_real_escape_string($conn, $_POST['oci_issue_date']);
      $oci_expiry_date          = mysqli_real_escape_string($conn, $_POST['oci_expiry_date']);
      $oci_occupation           = mysqli_real_escape_string($conn, $_POST['oci_occupation']);
      $oci_employer_address     = mysqli_real_escape_string($conn, $_POST['oci_employer_address']);
      $oci_address_main         = mysqli_real_escape_string($conn, $_POST['oci_address_main']);
      $oci_address_place        = mysqli_real_escape_string($conn, $_POST['oci_address_place']);
      $oci_address_country      = mysqli_real_escape_string($conn, $_POST['oci_address_country']);
      $oci_address_zipcode      = mysqli_real_escape_string($conn, $_POST['oci_address_zipcode']);
      $oci_email_id             = mysqli_real_escape_string($conn, $_POST['oci_email_id']);
      $oci_phone_num            = mysqli_real_escape_string($conn, $_POST['oci_phone_num']);
      $oci_applied_check        = mysqli_real_escape_string($conn, $_POST['oci_applied_check']);
      $oci_applied_date         = mysqli_real_escape_string($conn, $_POST['oci_applied_date']);
      $oci_applied_where        = mysqli_real_escape_string($conn, $_POST['oci_applied_where']);
      $oci_applied_details      = mysqli_real_escape_string($conn, $_POST['oci_applied_details']);
      $oci_asylum_check         = mysqli_real_escape_string($conn, $_POST['oci_asylum_check']);
      $oci_asylum_date          = mysqli_real_escape_string($conn, $_POST['oci_asylum_date']);
      $oci_asylum_where         = mysqli_real_escape_string($conn, $_POST['oci_asylum_where']);
      $oci_asylum_details       = mysqli_real_escape_string($conn, $_POST['oci_asylum_details']);
      $oci_citizen_check        = mysqli_real_escape_string($conn, $_POST['oci_citizen_check']);
      $oci_citizen_date         = mysqli_real_escape_string($conn, $_POST['oci_citizen_date']);
      $oci_citizen_where        = mysqli_real_escape_string($conn, $_POST['oci_citizen_where']);
      $oci_citizen_details      = mysqli_real_escape_string($conn, $_POST['oci_citizen_details']);
      $oci_grandparents_check   = mysqli_real_escape_string($conn, $_POST['oci_grandparents_check']);
      $oci_grandparents_date    = mysqli_real_escape_string($conn, $_POST['oci_grandparents_date']);
      $oci_grandparents_where   = mysqli_real_escape_string($conn, $_POST['oci_grandparents_where']);
      $oci_grandparents_details = mysqli_real_escape_string($conn, $_POST['oci_grandparents_details']);
      $oci_armed_check          = mysqli_real_escape_string($conn, $_POST['oci_armed_check']);
      $oci_armed_date           = mysqli_real_escape_string($conn, $_POST['oci_armed_date']);
      $oci_armed_where          = mysqli_real_escape_string($conn, $_POST['oci_armed_where']);
      $oci_armed_details        = mysqli_real_escape_string($conn, $_POST['oci_armed_details']);
      $oci_acquisition_name     = mysqli_real_escape_string($conn, $_POST['oci_acquisition_name']);
      $oci_acquisition_method   = mysqli_real_escape_string($conn, $_POST['oci_acquisition_method']);
      $oci_acquisition_date     = mysqli_real_escape_string($conn, $_POST['oci_acquisition_date']);
      $oci_acquisition_previous = mysqli_real_escape_string($conn, $_POST['oci_acquisition_previous']);
      $oci_ind_family_sr_no     = mysqli_real_escape_string($conn, $_POST['oci_ind_family_sr_no']);
      $oci_ind_family_name      = mysqli_real_escape_string($conn, $_POST['oci_ind_family_name']);
      $oci_ind_family_address   = mysqli_real_escape_string($conn, $_POST['oci_ind_family_address']);
      $oci_ind_family_relation  = mysqli_real_escape_string($conn, $_POST['oci_ind_family_relation']);
      $oci_criminal_applicant   = mysqli_real_escape_string($conn, $_POST['oci_criminal_applicant']);
      $oci_criminal_date_place  = mysqli_real_escape_string($conn, $_POST['oci_criminal_date_place']);
      $oci_criminal_nature      = mysqli_real_escape_string($conn, $_POST['oci_criminal_nature']);
      $oci_criminal_outcome     = mysqli_real_escape_string($conn, $_POST['oci_criminal_outcome']);
      $oci_criminal_name        = mysqli_real_escape_string($conn, $_POST['oci_criminal_name']);
      $oci_criminal_date        = mysqli_real_escape_string($conn, $_POST['oci_criminal_date']);
      $oci_criminal_place       = mysqli_real_escape_string($conn, $_POST['oci_criminal_place']);
      $oci_minor_name           = mysqli_real_escape_string($conn, $_POST['oci_minor_name']);
      $oci_minor_place          = mysqli_real_escape_string($conn, $_POST['oci_minor_place']);
      $oci_declaration_name     = mysqli_real_escape_string($conn, $_POST['oci_declaration_name']);
      $oci_declaration_date     = mysqli_real_escape_string($conn, $_POST['oci_declaration_date']);
      $oci_declaration_place    = mysqli_real_escape_string($conn, $_POST['oci_declaration_place']);
      $oci_payment_mode         = mysqli_real_escape_string($conn, $_POST['oci_payment_mode']);

      //file1
      $oci_profile_photo = '';
      $fileserr1 = false;
      if( ($_FILES['oci_profile_photo']['size'] == 0) ){
        $oci_profile_photo = '';
        $fileserr1 = false;
      } else if( $_FILES['oci_profile_photo']['size'] > (1*1024*1024) ) { //1MB
        $fileserr1 = true;
      } else {
        $temp        = explode(".", $_FILES["oci_profile_photo"]["name"]);
        $newfilename = $oci_id . '_profile' . '.' . end($temp);
        $imagetmp    = trim($_FILES['oci_profile_photo']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $oci_profile_photo = $newfilename;
        $fileserr1 = false;
      }

      //file2
      $oci_signature_photo = '';
      $fileserr2 = false;
      if( ($_FILES['oci_signature_photo']['size'] == 0) ){
        $oci_signature_photo = '';
        $fileserr2 = false;
      } else if( $_FILES['oci_signature_photo']['size'] > (1*1024*1024) ) { //1MB
        $fileserr2 = true;
      } else {
        $temp        = explode(".", $_FILES["oci_signature_photo"]["name"]);
        $newfilename = $oci_id . '_signature' . '.' . end($temp);
        $imagetmp    = trim($_FILES['oci_signature_photo']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $oci_signature_photo = $newfilename;
        $fileserr2 = false;
      }

      //no files error
      if( $fileserr1 || $fileserr2 ){
        echo "<strong>ERROR: Images Missing or Invalid. Max Size Allowed: 1MB each.</strong>";
        $oci_profile_photo = '';
        $oci_signature_photo = '';
      } else {
      }

      // INSERT OCI DATA
      $user_email = $_SESSION['user_email'];
      $main_sql = "INSERT INTO oci_forms( user_email, oci_id, oci_profile_photo, oci_signature_photo, oci_surname, oci_given_name, oci_gender, oci_dob, oci_birth_country, oci_birth_state, oci_birth_city, oci_nationality, oci_visible_marks, oci_fathers_name, oci_fathers_nationality, oci_mothers_name, oci_mothers_nationality, oci_martial_status, oci_marriage_date, oci_spouse_name, oci_spouse_nationality, oci_spouse_passport_num, oci_spouse_issue_place, oci_spouse_issue_date, oci_passport_num, oci_issue_place, oci_issue_date, oci_expiry_date, oci_occupation, oci_employer_address, oci_address_main, oci_address_place, oci_address_country, oci_address_zipcode, oci_email_id, oci_phone_num, oci_applied_check, oci_applied_date, oci_applied_where, oci_applied_details, oci_asylum_check, oci_asylum_date, oci_asylum_where, oci_asylum_details, oci_citizen_check, oci_citizen_date, oci_citizen_where, oci_citizen_details, oci_grandparents_check, oci_grandparents_date, oci_grandparents_where, oci_grandparents_details, oci_armed_check, oci_armed_date, oci_armed_where, oci_armed_details, oci_acquisition_name, oci_acquisition_method, oci_acquisition_date, oci_acquisition_previous, oci_ind_family_sr_no, oci_ind_family_name, oci_ind_family_address, oci_ind_family_relation, oci_criminal_applicant, oci_criminal_date_place, oci_criminal_nature, oci_criminal_outcome, oci_criminal_name, oci_criminal_date, oci_criminal_place, oci_minor_name, oci_minor_place, oci_declaration_name, oci_declaration_date, oci_declaration_place, oci_payment_mode) VALUES ( '$user_email', '$oci_id', '$oci_profile_photo', '$oci_signature_photo', '$oci_surname', '$oci_given_name', '$oci_gender', '$oci_dob', '$oci_birth_country', '$oci_birth_state', '$oci_birth_city', '$oci_nationality', '$oci_visible_marks', '$oci_fathers_name', '$oci_fathers_nationality', '$oci_mothers_name', '$oci_mothers_nationality', '$oci_martial_status', '$oci_marriage_date', '$oci_spouse_name', '$oci_spouse_nationality', '$oci_spouse_passport_num', '$oci_spouse_issue_place', '$oci_spouse_issue_date', '$oci_passport_num', '$oci_issue_place', '$oci_issue_date', '$oci_expiry_date', '$oci_occupation', '$oci_employer_address', '$oci_address_main', '$oci_address_place', '$oci_address_country', '$oci_address_zipcode', '$oci_email_id', '$oci_phone_num', '$oci_applied_check', '$oci_applied_date', '$oci_applied_where', '$oci_applied_details', '$oci_asylum_check', '$oci_asylum_date', '$oci_asylum_where', '$oci_asylum_details', '$oci_citizen_check', '$oci_citizen_date', '$oci_citizen_where', '$oci_citizen_details', '$oci_grandparents_check', '$oci_grandparents_date', '$oci_grandparents_where', '$oci_grandparents_details', '$oci_armed_check', '$oci_armed_date', '$oci_armed_where', '$oci_armed_details', '$oci_acquisition_name', '$oci_acquisition_method', '$oci_acquisition_date', '$oci_acquisition_previous', '$oci_ind_family_sr_no', '$oci_ind_family_name', '$oci_ind_family_address', '$oci_ind_family_relation', '$oci_criminal_applicant', '$oci_criminal_date_place', '$oci_criminal_nature', '$oci_criminal_outcome', '$oci_criminal_name', '$oci_criminal_date', '$oci_criminal_place', '$oci_minor_name', '$oci_minor_place', '$oci_declaration_name', '$oci_declaration_date', '$oci_declaration_place', '$oci_payment_mode' )";
      $main_que = mysqli_prepare($conn, $main_sql);

      if( $main_que ){
        mysqli_stmt_execute($main_que);
        echo "<strong class='text-success'> SUCCESS: OCI Application Created Successfully.</strong>";

        //SEND MAIL TO ALERT ADMINS
        $form_type = "OCI Form";
        $query = "New OCI Form Filled on IndiaVisa.co.uk UK Website.";
        $to = "enquiry@indiavisa.co.uk";
        $from = "alert@indianevisaonline.com";
        $subject = "IndiaVisa.co.uk New OCI Form";
        $message = "<html><head><title>New OCI Form</title></head><body>";
        $message .= "<p>New OCI Form on IndiaVisa.co.uk UK Website.</p>";
        $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
        $message .= "<tr> <td>Visa Type</td> <td>".$form_type."</td> </tr>";
        $message .= "<tr> <td>Form ID</td> <td>".$oci_id."</td> </tr>";
        $message .= "<tr> <td>Email</td> <td>".$user_email."</td> </tr>";
        $message .= "<tr> <td>Source</td> <td>".$query."</td> </tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
        $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
        $mail_check = @mail($to, $subject, $message, $headers);

        //redirect to next form
        if( $oci_payment_mode== 'cheque' ){
          echo "<h5 class='text-success'> Please note your OCI Application ID: $oci_id </h5>";
          echo "<h5 class='text-success'> You have selected to pay via Cheque Deposit. Cheque should be made payable to 'India Visa'. </h5>";
        } else {
          $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/payment-only.php?pay=oci_form&oid=".$oci_id;
          echo '<script> window.location.href = "'.$redirect_to.'"; </script>';
        }

      } else {
        echo "<strong> ERROR: OCI Application not Created. Try again later. </strong>";
      }

    }

  } else {
    echo $errors;
  }

}//end process