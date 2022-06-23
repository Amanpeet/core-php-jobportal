<?php

//process form data
if( isset($_POST['form2_submit']) && !empty($_POST['form2_submit'])  ){

  //set errors
  $errors = 0;

  //validate form type POST
  if ( isset( $_POST['form_type'] ) && !empty( $_POST['form_type'] ) ) {
    $form_type = $_POST['form_type'];
    if ( $form_type == 'tourist' || $form_type == 'business' || $form_type == 'medical' || $form_type == 'conference' ){
      // echo "form type validation successfull. ";
    } else {
      $errors = " ERROR: Invalid form type. ";
    }
  } else {
    $errors = " ERROR: Form type not found. ";
  }

  // validate previous from id data
  if( isset($_POST['form_id']) && !empty($_POST['form_id'])  ){
    $form_id = $_POST['form_id'];
    $form1_check = false;
    $formid_data_sql = "SELECT * FROM formdata_form1 WHERE form_id = '$form_id' ";
    $formid_data_query = mysqli_query($conn, $formid_data_sql);
    if(mysqli_num_rows($formid_data_query) > 0){
      $form1_check = true;
      // echo " Form id found in database. ";
    } else {
      $errors = " ERROR: Form id not found in database. ";
    }
  } else {
    $errors = " ERROR: Form id not posted. ";
  }

  //chck if any error found
  if( $errors === 0 ){

    // Required field names
    $required_fields = array(
      'form_type',
      'form_id',
      'f2_surname',
      'f2_given_name',
      'f2_gender',
      'f2_dob',
      'f2_birth_city',
      'f2_birth_country',
      'f2_national_id',
      'f2_religion',
      'f2_visible_marks',
      'f2_edu_qualification',
      'f2_nationality',
      'f2_passport_num',
      'f2_issue_place',
      'f2_issue_date',
      'f2_expiry_date',
      'f2_other_passport',
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
      'f2_name_changed',
      'f2_previous_surname',
      'f2_previous_name',
      'f2_religion_others',
      'f2_acquire_nationality',
      'f2_previous_nationality',
      'f2_lived_years',
      '$f2_other_issue_country',
      '$f2_other_passport_num',
      '$f2_other_issue_date',
      '$f2_other_issue_place',
      '$f2_other_pass_nationality',
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

      //set field vars
      $form_id                   = mysqli_real_escape_string($conn, $_POST['form_id']);
      $form_type                 = mysqli_real_escape_string($conn, $_POST['form_type']);
      $f2_surname                = mysqli_real_escape_string($conn, $_POST['f2_surname']);
      $f2_given_name             = mysqli_real_escape_string($conn, $_POST['f2_given_name']);
      $f2_name_changed           = mysqli_real_escape_string($conn, $_POST['f2_name_changed']);
      $f2_previous_surname       = mysqli_real_escape_string($conn, $_POST['f2_previous_surname']);
      $f2_previous_name          = mysqli_real_escape_string($conn, $_POST['f2_previous_name']);
      $f2_gender                 = mysqli_real_escape_string($conn, $_POST['f2_gender']);
      $f2_dob                    = mysqli_real_escape_string($conn, $_POST['f2_dob']);
      $f2_birth_city             = mysqli_real_escape_string($conn, $_POST['f2_birth_city']);
      $f2_birth_country          = mysqli_real_escape_string($conn, $_POST['f2_birth_country']);
      $f2_national_id            = mysqli_real_escape_string($conn, $_POST['f2_national_id']);
      $f2_religion               = mysqli_real_escape_string($conn, $_POST['f2_religion']);
      $f2_religion_others        = mysqli_real_escape_string($conn, $_POST['f2_religion_others']);
      $f2_visible_marks          = mysqli_real_escape_string($conn, $_POST['f2_visible_marks']);
      $f2_edu_qualification      = mysqli_real_escape_string($conn, $_POST['f2_edu_qualification']);
      $f2_nationality            = mysqli_real_escape_string($conn, $_POST['f2_nationality']);
      $f2_acquire_nationality    = mysqli_real_escape_string($conn, $_POST['f2_acquire_nationality']);
      $f2_previous_nationality   = mysqli_real_escape_string($conn, $_POST['f2_previous_nationality']);
      $f2_lived_years            = mysqli_real_escape_string($conn, $_POST['f2_lived_years']);
      $f2_passport_num           = mysqli_real_escape_string($conn, $_POST['f2_passport_num']);
      $f2_issue_place            = mysqli_real_escape_string($conn, $_POST['f2_issue_place']);
      $f2_issue_date             = mysqli_real_escape_string($conn, $_POST['f2_issue_date']);
      $f2_expiry_date            = mysqli_real_escape_string($conn, $_POST['f2_expiry_date']);
      $f2_other_passport         = mysqli_real_escape_string($conn, $_POST['f2_other_passport']);
      $f2_other_issue_country    = mysqli_real_escape_string($conn, $_POST['f2_other_issue_country']);
      $f2_other_passport_num     = mysqli_real_escape_string($conn, $_POST['f2_other_passport_num']);
      $f2_other_issue_date       = mysqli_real_escape_string($conn, $_POST['f2_other_issue_date']);
      $f2_other_issue_place      = mysqli_real_escape_string($conn, $_POST['f2_other_issue_place']);
      $f2_other_pass_nationality = mysqli_real_escape_string($conn, $_POST['f2_other_pass_nationality']);

      // check if data existing
      $checkexisting = "SELECT * FROM formdata_form2 WHERE form_id = '$form_id' ";
      $checkque = mysqli_query($conn, $checkexisting);

      // set query to update or insert
      $query_sql = "";

      if(mysqli_num_rows($checkque) > 0){
        echo "<strong> WARNING: Same Form id exists, Updating values. </strong>";

        $query_sql = "UPDATE formdata_form2 SET form_type = '$form_type', f2_surname = '$f2_surname', f2_given_name = '$f2_given_name', f2_name_changed = '$f2_name_changed', f2_previous_surname = '$f2_previous_surname', f2_previous_name = '$f2_previous_name', f2_gender = '$f2_gender', f2_dob = '$f2_dob', f2_birth_city = '$f2_birth_city', f2_birth_country = '$f2_birth_country', f2_national_id = '$f2_national_id', f2_religion = '$f2_religion', f2_religion_others = '$f2_religion_others', f2_visible_marks = '$f2_visible_marks', f2_edu_qualification = '$f2_edu_qualification', f2_nationality = '$f2_nationality', f2_acquire_nationality = '$f2_acquire_nationality', f2_previous_nationality = '$f2_previous_nationality', f2_lived_years = '$f2_lived_years', f2_passport_num = '$f2_passport_num', f2_issue_place = '$f2_issue_place', f2_issue_date = '$f2_issue_date', f2_expiry_date = '$f2_expiry_date', f2_other_passport = '$f2_other_passport', f2_other_issue_country = '$f2_other_issue_country', f2_other_passport_num = '$f2_other_passport_num', f2_other_issue_date = '$f2_other_issue_date', f2_other_issue_place = '$f2_other_issue_place', f2_other_pass_nationality = '$f2_other_pass_nationality' WHERE form_id = '$form_id' ";

      } else {

        $query_sql = "INSERT INTO formdata_form2( form_id, form_type, f2_surname, f2_given_name, f2_name_changed, f2_previous_surname, f2_previous_name, f2_gender, f2_dob, f2_birth_city, f2_birth_country, f2_national_id, f2_religion, f2_religion_others, f2_visible_marks, f2_edu_qualification, f2_nationality, f2_acquire_nationality, f2_previous_nationality, f2_lived_years, f2_passport_num, f2_issue_place, f2_issue_date, f2_expiry_date, f2_other_passport, f2_other_issue_country, f2_other_passport_num, f2_other_issue_date, f2_other_issue_place, f2_other_pass_nationality ) VALUES ( '$form_id', '$form_type', '$f2_surname', '$f2_given_name', '$f2_name_changed', '$f2_previous_surname', '$f2_previous_name', '$f2_gender', '$f2_dob', '$f2_birth_city', '$f2_birth_country', '$f2_national_id', '$f2_religion', '$f2_religion_others', '$f2_visible_marks', '$f2_edu_qualification', '$f2_nationality', '$f2_acquire_nationality', '$f2_previous_nationality', '$f2_lived_years', '$f2_passport_num', '$f2_issue_place', '$f2_issue_date', '$f2_expiry_date', '$f2_other_passport', '$f2_other_issue_country', '$f2_other_passport_num', '$f2_other_issue_date', '$f2_other_issue_place', '$f2_other_pass_nationality' )";

      }

      //execute query
      $que = mysqli_prepare($conn, $query_sql);
      if($que){
        mysqli_stmt_execute($que);
        echo "<strong> SUCCESS: Form 2 saved successfully. Loading Next Form...</strong>";

        //update main formdata
        $user_email = $_SESSION['user_email'];
        $main_sql = "UPDATE formdata_main SET form2_status = 'completed' WHERE form_id = '$form_id' ";
        $main_que = mysqli_prepare($conn, $main_sql);
        mysqli_stmt_execute($main_que);

        //redirect to next form
        $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/e-visa-form3.php?formid=".$form_id;
        if (headers_sent() === false) {
          header('Location: ' . $redirect_to );
        } else {
          echo '<script> window.location.href = "'.$redirect_to.'"; </script>';
        }

      } else {
        echo "<strong> ERROR: Form 2 not saved. Please try again later. </strong>";
      }


    }

  } else {
    echo $errors;
  }

}//end process
