<?php

//process form data
if( isset($_POST['form1_submit']) && !empty($_POST['form1_submit'])  ){

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
      'f1_pass_type',
      'f1_nationality',
      'f1_port_arrival',
      'f1_dob',
      'f1_email',
      'f1_date_arrival',
    );

    // Loop over fields, check if unset or empty
    $error = false;
    foreach($required_fields as $field) {
      if ( !isset( $_POST[$field] ) || empty( $_POST[$field] ) ) {
        $error = true;
        echo "<strong> ERROR: Required fields Empty or Invalid. </strong>";
      } else {
        $trim_val = mysqli_real_escape_string($conn, $_POST[$field]);
        if ( trim($trim_val) == '' ){
          $error = true;
          echo "<strong> ERROR: Required fields cant be just spaces. </strong>";
        }
      }
    }

    // Required types names
    $required_types = array(
      'e_tourist_visa',
      'e_medical_visa',
      'e_business_visa',
      'e_conference_visa',
    );

    // Loop over types, set array
    $e_visa_type_arr = array();
    foreach($required_types as $type) {
      $type_value = "";
      if ( isset( $_POST[$type] ) && !empty( $_POST[$type] ) ) {
        $type_value = mysqli_real_escape_string($conn, $_POST[$type]);
      }
      if( !empty($type_value) ){
        $e_visa_type_arr[] = $type_value;
      }
    }

    // Required subtypes names
    $required_types = array(
      'e_tourist_visa_subtype',
      'e_medical_visa_subtype',
      'e_business_visa_subtype',
      'e_conference_visa_subtype',
    );

    // Loop over subtypes, set array
    $e_visa_subtype_arr = array();
    foreach($required_types as $subtype) {
      $subtype_value = "";
      if ( isset( $_POST[$subtype] ) && !empty( $_POST[$subtype] ) ) {
        $subtype_value = mysqli_real_escape_string($conn, $_POST[$subtype]);
      }
      if( !empty($subtype_value) ){
        $e_visa_subtype_arr[] = $subtype_value;
      }
    }

    //check atleast 1 visa type has value
    if ( empty( $e_visa_type_arr ) || empty( $e_visa_subtype_arr ) ) {
      $error = true;
      echo "<strong> ERROR: Select atleast one type of visa. </strong>";
    }

    //if any error
    if ($error) {
      //errors defined above
      // echo "<strong> ERROR: Required fields Empty or Invalid. Please try again.</strong>";
    } else {

      //set field vars
      $form_type       = mysqli_real_escape_string($conn, $_POST['form_type']);
      $f1_pass_type    = mysqli_real_escape_string($conn, $_POST['f1_pass_type']);
      $f1_nationality  = mysqli_real_escape_string($conn, $_POST['f1_nationality']);
      $f1_port_arrival = mysqli_real_escape_string($conn, $_POST['f1_port_arrival']);
      $f1_dob          = mysqli_real_escape_string($conn, $_POST['f1_dob']);
      $f1_email        = mysqli_real_escape_string($conn, $_POST['f1_email']);
      $f1_date_arrival = mysqli_real_escape_string($conn, $_POST['f1_date_arrival']);

      //array to string
      $e_visa_type = implode('; ', $e_visa_type_arr);
      $e_visa_subtype = implode('; ', $e_visa_subtype_arr);

      //generate new form id
      $uniqd = round(microtime(true));
      $form_id = "ING".$uniqd;

      // INSERT FORM1 DATA
      $query_sql = "INSERT INTO formdata_form1( form_id, form_type, f1_pass_type, f1_nationality, f1_port_arrival, f1_dob, f1_email, f1_date_arrival, e_visa_type, e_visa_subtype ) VALUES ( '$form_id', '$form_type', '$f1_pass_type', '$f1_nationality', '$f1_port_arrival', '$f1_dob', '$f1_email', '$f1_date_arrival', '$e_visa_type', '$e_visa_subtype' )";
      $que = mysqli_prepare($conn, $query_sql);

      // INSERT MAIN FORMDATA
      $user_email = $_SESSION['user_email'];
      $main_sql = "INSERT INTO formdata_main( form_id, user_email, form_type, form1_status ) VALUES ( '$form_id', '$user_email', '$form_type', 'completed' )";
      $main_que = mysqli_prepare($conn, $main_sql);

      if( $que && $main_que ){
        mysqli_stmt_execute($que);
        mysqli_stmt_execute($main_que);
        echo "<strong> SUCCESS: Application Created Successfully. Loading Next Form...</strong>";

        //redirect to next form
        $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/e-visa-form2.php?formid=".$form_id;
        if (headers_sent() === false) {
          header('Location: ' . $redirect_to );
        } else {
          echo '<script> window.location.href = "'.$redirect_to.'"; </script>';
        }

      } else {
        echo "<strong> ERROR: Application not Created. Please try again later. </strong>";
      }

    }

  } else {
    echo $errors;
  }

}//end process
