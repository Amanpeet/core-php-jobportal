<?php

//process form data
if( isset($_POST['inp_submit']) && !empty($_POST['inp_submit'])  ){

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
      'inp_app_ref_num',
      'inp_apply_for',
      'inp_booklet_type',
      'inp_applicant_name',
      'inp_dob',
      'inp_birth_country',
      'inp_birth_state',
      'inp_birth_city',
      'inp_gender',
      'inp_fathers_name',
      'inp_mothers_name',
      'inp_passport_phone',
      'inp_passport_email',
      'inp_address_main',
      'inp_payment_mode',
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
      'inp_reissue_reasons',
      'inp_particulars_change',
      'inp_other_specify',
      'inp_application_type',
      'inp_applicant_alias',
      'inp_alias_name1',
      'inp_alias_name2',
      'inp_name_change',
      'inp_previous_name1',
      'inp_previous_name2',
      'inp_validity_req',
      'inp_visible_marks',
      'inp_martial_status',
      'inp_citizen_by',
      'inp_pan_num',
      'inp_voter_num',
      'inp_aadhaar_num',
      'inp_employment_type',
      'inp_organization_name',
      'inp_edu_qualification',
      'inp_govt_servant_check',
      'inp_non_ecr_check',
      'inp_fathers_nationality',
      'inp_fathers_pass_num',
      'inp_mothers_nationality',
      'inp_mothers_pass_num',
      'inp_guardian_name',
      'inp_spouse_name',
      'inp_passport_address',
      'inp_phone_num',
      'inp_contact_name',
      'inp_contact_address',
      'inp_contact_phone',
      'inp_contact_email',
      'inp_prev_check',
      'inp_prev_pass_num',
      'inp_prev_file_num',
      'inp_prev_date_issue',
      'inp_prev_date_expiry',
      'inp_prev_place_issue',
      'inp_nope_check',
      'inp_nope_date_issue',
      'inp_nope_date_expiry',
      'inp_nope_place_issue',
      'inp_diplo_check',
      'inp_diplo_pass_num',
      'inp_diplo_date_issue',
      'inp_diplo_date_expiry',
      'inp_diplo_place_issue',
      'inp_criminal_check',
      'inp_criminal_court',
      'inp_criminal_case',
      'inp_criminal_laws',
      'inp_convict_check',
      'inp_convict_court',
      'inp_convict_case',
      'inp_convict_laws',
      'inp_refused_check',
      'inp_refused_details',
      'inp_revoked_check',
      'inp_revoked_passport',
      'inp_revoked_details',
      'inp_asylum_check',
      'inp_asylum_where',
      'inp_asylum_details',
      'inp_ec_check',
      'inp_ec_num',
      'inp_ec_issue',
      'inp_ec_authority',
      'inp_ec_country',
      'inp_ec_reason',
      'inp_declaration_date',
      'inp_declaration_place',
    );

    // Loop over types, assign values if not set
    foreach($optional_fields as $fieldo) {
      $fieldo_value = "";
      if ( isset( $_POST[$fieldo] ) && !empty( $_POST[$fieldo] ) ) {
        $fieldo_value = mysqli_real_escape_string($conn, $_POST[$fieldo]);
      } else {
        echo "ERROR: $fieldo ";
      }
      $_POST[$fieldo] = $fieldo_value;
    }

    //if any error
    if ($error) {
      echo "the if cond.";
      //errors defined above
      // echo "<strong> ERROR: Required fields Empty or Invalid. Please try again.</strong>";
    } else {

      //generate new form id
      $uniqd = round(microtime(true));
      $inp_id = "INP".$uniqd;

      //set field vars
      $inp_app_ref_num         = mysqli_real_escape_string($conn, $_POST['inp_app_ref_num']);
      $inp_apply_for           = mysqli_real_escape_string($conn, $_POST['inp_apply_for']);
      $inp_reissue_reasons     = mysqli_real_escape_string($conn, $_POST['inp_reissue_reasons']);
      $inp_particulars_change  = mysqli_real_escape_string($conn, $_POST['inp_particulars_change']);
      $inp_other_specify       = mysqli_real_escape_string($conn, $_POST['inp_other_specify']);
      $inp_application_type    = mysqli_real_escape_string($conn, $_POST['inp_application_type']);
      $inp_booklet_type        = mysqli_real_escape_string($conn, $_POST['inp_booklet_type']);
      $inp_applicant_name      = mysqli_real_escape_string($conn, $_POST['inp_applicant_name']);
      $inp_applicant_alias     = mysqli_real_escape_string($conn, $_POST['inp_applicant_alias']);
      $inp_alias_name1         = mysqli_real_escape_string($conn, $_POST['inp_alias_name1']);
      $inp_alias_name2         = mysqli_real_escape_string($conn, $_POST['inp_alias_name2']);
      $inp_name_change         = mysqli_real_escape_string($conn, $_POST['inp_name_change']);
      $inp_previous_name1      = mysqli_real_escape_string($conn, $_POST['inp_previous_name1']);
      $inp_previous_name2      = mysqli_real_escape_string($conn, $_POST['inp_previous_name2']);
      $inp_dob                 = mysqli_real_escape_string($conn, $_POST['inp_dob']);
      $inp_validity_req        = mysqli_real_escape_string($conn, $_POST['inp_validity_req']);
      $inp_birth_country       = mysqli_real_escape_string($conn, $_POST['inp_birth_country']);
      $inp_birth_state         = mysqli_real_escape_string($conn, $_POST['inp_birth_state']);
      $inp_birth_city          = mysqli_real_escape_string($conn, $_POST['inp_birth_city']);
      $inp_gender              = mysqli_real_escape_string($conn, $_POST['inp_gender']);
      $inp_visible_marks       = mysqli_real_escape_string($conn, $_POST['inp_visible_marks']);
      $inp_martial_status      = mysqli_real_escape_string($conn, $_POST['inp_martial_status']);
      $inp_citizen_by          = mysqli_real_escape_string($conn, $_POST['inp_citizen_by']);
      $inp_pan_num             = mysqli_real_escape_string($conn, $_POST['inp_pan_num']);
      $inp_voter_num           = mysqli_real_escape_string($conn, $_POST['inp_voter_num']);
      $inp_aadhaar_num         = mysqli_real_escape_string($conn, $_POST['inp_aadhaar_num']);
      $inp_employment_type     = mysqli_real_escape_string($conn, $_POST['inp_employment_type']);
      $inp_organization_name   = mysqli_real_escape_string($conn, $_POST['inp_organization_name']);
      $inp_edu_qualification   = mysqli_real_escape_string($conn, $_POST['inp_edu_qualification']);
      $inp_govt_servant_check  = mysqli_real_escape_string($conn, $_POST['inp_govt_servant_check']);
      $inp_non_ecr_check       = mysqli_real_escape_string($conn, $_POST['inp_non_ecr_check']);
      $inp_fathers_name        = mysqli_real_escape_string($conn, $_POST['inp_fathers_name']);
      $inp_fathers_nationality = mysqli_real_escape_string($conn, $_POST['inp_fathers_nationality']);
      $inp_fathers_pass_num    = mysqli_real_escape_string($conn, $_POST['inp_fathers_pass_num']);
      $inp_mothers_name        = mysqli_real_escape_string($conn, $_POST['inp_mothers_name']);
      $inp_mothers_nationality = mysqli_real_escape_string($conn, $_POST['inp_mothers_nationality']);
      $inp_mothers_pass_num    = mysqli_real_escape_string($conn, $_POST['inp_mothers_pass_num']);
      $inp_guardian_name       = mysqli_real_escape_string($conn, $_POST['inp_guardian_name']);
      $inp_spouse_name         = mysqli_real_escape_string($conn, $_POST['inp_spouse_name']);
      $inp_passport_address    = mysqli_real_escape_string($conn, $_POST['inp_passport_address']);
      $inp_passport_phone      = mysqli_real_escape_string($conn, $_POST['inp_passport_phone']);
      $inp_passport_email      = mysqli_real_escape_string($conn, $_POST['inp_passport_email']);
      $inp_address_main        = mysqli_real_escape_string($conn, $_POST['inp_address_main']);
      $inp_phone_num           = mysqli_real_escape_string($conn, $_POST['inp_phone_num']);
      $inp_contact_name        = mysqli_real_escape_string($conn, $_POST['inp_contact_name']);
      $inp_contact_address     = mysqli_real_escape_string($conn, $_POST['inp_contact_address']);
      $inp_contact_phone       = mysqli_real_escape_string($conn, $_POST['inp_contact_phone']);
      $inp_contact_email       = mysqli_real_escape_string($conn, $_POST['inp_contact_email']);
      $inp_prev_check       = mysqli_real_escape_string($conn, $_POST['inp_prev_check']);
      $inp_prev_pass_num       = mysqli_real_escape_string($conn, $_POST['inp_prev_pass_num']);
      $inp_prev_file_num       = mysqli_real_escape_string($conn, $_POST['inp_prev_file_num']);
      $inp_prev_date_issue     = mysqli_real_escape_string($conn, $_POST['inp_prev_date_issue']);
      $inp_prev_date_expiry    = mysqli_real_escape_string($conn, $_POST['inp_prev_date_expiry']);
      $inp_prev_place_issue    = mysqli_real_escape_string($conn, $_POST['inp_prev_place_issue']);
      $inp_nope_check       = mysqli_real_escape_string($conn, $_POST['inp_nope_check']);
      $inp_nope_date_issue     = mysqli_real_escape_string($conn, $_POST['inp_nope_date_issue']);
      $inp_nope_date_expiry    = mysqli_real_escape_string($conn, $_POST['inp_nope_date_expiry']);
      $inp_nope_place_issue    = mysqli_real_escape_string($conn, $_POST['inp_nope_place_issue']);
      $inp_diplo_check       = mysqli_real_escape_string($conn, $_POST['inp_diplo_check']);
      $inp_diplo_pass_num      = mysqli_real_escape_string($conn, $_POST['inp_diplo_pass_num']);
      $inp_diplo_date_issue    = mysqli_real_escape_string($conn, $_POST['inp_diplo_date_issue']);
      $inp_diplo_date_expiry   = mysqli_real_escape_string($conn, $_POST['inp_diplo_date_expiry']);
      $inp_diplo_place_issue   = mysqli_real_escape_string($conn, $_POST['inp_diplo_place_issue']);
      $inp_criminal_check      = mysqli_real_escape_string($conn, $_POST['inp_criminal_check']);
      $inp_criminal_court      = mysqli_real_escape_string($conn, $_POST['inp_criminal_court']);
      $inp_criminal_case       = mysqli_real_escape_string($conn, $_POST['inp_criminal_case']);
      $inp_criminal_laws       = mysqli_real_escape_string($conn, $_POST['inp_criminal_laws']);
      $inp_convict_check       = mysqli_real_escape_string($conn, $_POST['inp_convict_check']);
      $inp_convict_court       = mysqli_real_escape_string($conn, $_POST['inp_convict_court']);
      $inp_convict_case        = mysqli_real_escape_string($conn, $_POST['inp_convict_case']);
      $inp_convict_laws        = mysqli_real_escape_string($conn, $_POST['inp_convict_laws']);
      $inp_refused_check       = mysqli_real_escape_string($conn, $_POST['inp_refused_check']);
      $inp_refused_details     = mysqli_real_escape_string($conn, $_POST['inp_refused_details']);
      $inp_revoked_check       = mysqli_real_escape_string($conn, $_POST['inp_revoked_check']);
      $inp_revoked_passport    = mysqli_real_escape_string($conn, $_POST['inp_revoked_passport']);
      $inp_revoked_details     = mysqli_real_escape_string($conn, $_POST['inp_revoked_details']);
      $inp_asylum_check        = mysqli_real_escape_string($conn, $_POST['inp_asylum_check']);
      $inp_asylum_where        = mysqli_real_escape_string($conn, $_POST['inp_asylum_where']);
      $inp_asylum_details      = mysqli_real_escape_string($conn, $_POST['inp_asylum_details']);
      $inp_ec_check            = mysqli_real_escape_string($conn, $_POST['inp_ec_check']);
      $inp_ec_num              = mysqli_real_escape_string($conn, $_POST['inp_ec_num']);
      $inp_ec_issue            = mysqli_real_escape_string($conn, $_POST['inp_ec_issue']);
      $inp_ec_authority        = mysqli_real_escape_string($conn, $_POST['inp_ec_authority']);
      $inp_ec_country          = mysqli_real_escape_string($conn, $_POST['inp_ec_country']);
      $inp_ec_reason           = mysqli_real_escape_string($conn, $_POST['inp_ec_reason']);
      $inp_declaration_date    = mysqli_real_escape_string($conn, $_POST['inp_declaration_date']);
      $inp_declaration_place   = mysqli_real_escape_string($conn, $_POST['inp_declaration_place']);
      $inp_payment_mode        = mysqli_real_escape_string($conn, $_POST['inp_payment_mode']);

      //file1
      $inp_profile_photo = '';
      $fileserr1 = false;
      if( ($_FILES['inp_profile_photo']['size'] == 0) ){
        $inp_profile_photo = '';
        $fileserr1 = false;
      } else if( $_FILES['inp_profile_photo']['size'] > (1*1024*1024) ) { //1MB
        $fileserr1 = true;
      } else {
        $temp        = explode(".", $_FILES["inp_profile_photo"]["name"]);
        $newfilename = $inp_id . '_profilex' . '.' . end($temp);
        $imagetmp    = trim($_FILES['inp_profile_photo']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $inp_profile_photo = $newfilename;
        $fileserr1 = false;
      }

      //file2
      $inp_signature_photo = '';
      $fileserr2 = false;
      if( ($_FILES['inp_signature_photo']['size'] == 0) ){
        $inp_signature_photo = '';
        $fileserr2 = false;
      } else if( $_FILES['inp_signature_photo']['size'] > (1*1024*1024) ) { //1MB
        $fileserr2 = true;
      } else {
        $temp        = explode(".", $_FILES["inp_signature_photo"]["name"]);
        $newfilename = $inp_id . '_signaturex' . '.' . end($temp);
        $imagetmp    = trim($_FILES['inp_signature_photo']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $inp_signature_photo = $newfilename;
        $fileserr2 = false;
      }

      //no files error
      if( $fileserr1 || $fileserr2 ){
        echo "<strong>ERROR: Images Missing or Invalid. Max Size Allowed: 1MB each.</strong>";
        $inp_profile_photo = '';
        $inp_signature_photo = '';
      } else {
      }

      // INSERT INP DATA
      $user_email = $_SESSION['user_email'];
      $main_sql = "INSERT INTO indian_passports( user_email, inp_id, inp_profile_photo, inp_signature_photo, inp_app_ref_num, inp_apply_for, inp_reissue_reasons, inp_particulars_change, inp_other_specify, inp_application_type, inp_booklet_type, inp_applicant_name, inp_applicant_alias, inp_alias_name1, inp_alias_name2, inp_name_change, inp_previous_name1, inp_previous_name2, inp_dob, inp_validity_req, inp_birth_country, inp_birth_state, inp_birth_city, inp_gender, inp_visible_marks, inp_martial_status, inp_citizen_by, inp_pan_num, inp_voter_num, inp_aadhaar_num, inp_employment_type, inp_organization_name, inp_edu_qualification, inp_govt_servant_check, inp_non_ecr_check, inp_fathers_name, inp_fathers_nationality, inp_fathers_pass_num, inp_mothers_name, inp_mothers_nationality, inp_mothers_pass_num, inp_guardian_name, inp_spouse_name, inp_passport_address, inp_passport_phone, inp_passport_email, inp_address_main, inp_phone_num, inp_contact_name, inp_contact_address, inp_contact_phone, inp_contact_email, inp_prev_check, inp_prev_pass_num, inp_prev_file_num, inp_prev_date_issue, inp_prev_date_expiry, inp_prev_place_issue, inp_nope_check, inp_nope_date_issue, inp_nope_date_expiry, inp_nope_place_issue, inp_diplo_check, inp_diplo_pass_num, inp_diplo_date_issue, inp_diplo_date_expiry, inp_diplo_place_issue, inp_criminal_check, inp_criminal_court, inp_criminal_case, inp_criminal_laws, inp_convict_check, inp_convict_court, inp_convict_case, inp_convict_laws, inp_refused_check, inp_refused_details, inp_revoked_check, inp_revoked_passport, inp_revoked_details, inp_asylum_check, inp_asylum_where, inp_asylum_details, inp_ec_check, inp_ec_num, inp_ec_issue, inp_ec_authority, inp_ec_country, inp_ec_reason, inp_declaration_date, inp_declaration_place, inp_payment_mode ) VALUES ('$user_email', '$inp_id', '$inp_profile_photo', '$inp_signature_photo', '$inp_app_ref_num', '$inp_apply_for', '$inp_reissue_reasons', '$inp_particulars_change', '$inp_other_specify', '$inp_application_type', '$inp_booklet_type', '$inp_applicant_name', '$inp_applicant_alias', '$inp_alias_name1', '$inp_alias_name2', '$inp_name_change', '$inp_previous_name1', '$inp_previous_name2', '$inp_dob', '$inp_validity_req', '$inp_birth_country', '$inp_birth_state', '$inp_birth_city', '$inp_gender', '$inp_visible_marks', '$inp_martial_status', '$inp_citizen_by', '$inp_pan_num', '$inp_voter_num', '$inp_aadhaar_num', '$inp_employment_type', '$inp_organization_name', '$inp_edu_qualification', '$inp_govt_servant_check', '$inp_non_ecr_check', '$inp_fathers_name', '$inp_fathers_nationality', '$inp_fathers_pass_num', '$inp_mothers_name', '$inp_mothers_nationality', '$inp_mothers_pass_num', '$inp_guardian_name', '$inp_spouse_name', '$inp_passport_address', '$inp_passport_phone', '$inp_passport_email', '$inp_address_main', '$inp_phone_num', '$inp_contact_name', '$inp_contact_address', '$inp_contact_phone', '$inp_contact_email', '$inp_prev_check', '$inp_prev_pass_num', '$inp_prev_file_num', '$inp_prev_date_issue', '$inp_prev_date_expiry', '$inp_prev_place_issue', '$inp_nope_check', '$inp_nope_date_issue', '$inp_nope_date_expiry', '$inp_nope_place_issue', '$inp_diplo_check', '$inp_diplo_pass_num', '$inp_diplo_date_issue', '$inp_diplo_date_expiry', '$inp_diplo_place_issue', '$inp_criminal_check', '$inp_criminal_court', '$inp_criminal_case', '$inp_criminal_laws', '$inp_convict_check', '$inp_convict_court', '$inp_convict_case', '$inp_convict_laws', '$inp_refused_check', '$inp_refused_details', '$inp_revoked_check', '$inp_revoked_passport', '$inp_revoked_details', '$inp_asylum_check', '$inp_asylum_where', '$inp_asylum_details', '$inp_ec_check', '$inp_ec_num', '$inp_ec_issue', '$inp_ec_authority', '$inp_ec_country', '$inp_ec_reason', '$inp_declaration_date', '$inp_declaration_place', '$inp_payment_mode') ";
      $main_que = mysqli_prepare($conn, $main_sql);

      if( $main_que ){
        mysqli_stmt_execute($main_que);
        echo "<strong class='text-success'> SUCCESS: Passport Application Created Successfully.</strong>";

        //SEND MAIL TO ALERT ADMINS
        $form_type = "Indian Passport Form";
        $query = "New Indian Passport Form Filled on IndiaVisa.co.uk UK Website.";
        $to = "enquiry@indiavisa.co.uk";
        $from = "alert@indianevisaonline.com";
        $subject = "IndiaVisa.co.uk New Indian Passport Form";
        $message = "<html><head><title>New OCI Form</title></head><body>";
        $message .= "<p>New Indian Passport Form on IndiaVisa.co.uk UK Website.</p>";
        $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
        $message .= "<tr> <td>Visa Type</td> <td>".$form_type."</td> </tr>";
        $message .= "<tr> <td>Form ID</td> <td>".$inp_id."</td> </tr>";
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
        if( $inp_payment_mode== 'cheque' ){
          echo "<h5 class='text-success'> Please note your Passport Application ID: $inp_id </h5>";
          echo "<h5 class='text-success'> You have selected to pay via Cheque Deposit. Cheque should be made payable to 'India Visa'. </h5>";
        } else {
          $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/payment-only.php?pay=indian_passport&nid=".$inp_id;
          echo '<script> window.location.href = "'.$redirect_to.'"; </script>';
        }

      } else {
        echo "<strong> ERROR: Passport Application not Created. Try again later. </strong>";
      }

    }

  } else {
    echo $errors;
  }

}//end process

