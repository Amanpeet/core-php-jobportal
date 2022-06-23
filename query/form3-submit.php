<?php

//process form data
if( isset($_POST['form3_submit']) && !empty($_POST['form3_submit'])  ){

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

    //form 1 check
    $form1_check = false;
    $formid_data_sql = "SELECT * FROM formdata_form1 WHERE form_id = '$form_id' ";
    $formid_data_query = mysqli_query($conn, $formid_data_sql);
    if(mysqli_num_rows($formid_data_query) > 0){
      $form1_check = true;
      // echo " Form id found in database. ";
    } else {
      $errors = " ERROR: Form id not found in database. ";
    }

    //form 2 check
    $form2_check = false;
    $form2_data_sql = "SELECT * FROM formdata_form2 WHERE form_id = '$form_id' ";
    $form2_data_query = mysqli_query($conn, $form2_data_sql);
    if(mysqli_num_rows($form2_data_query) > 0){
      $form2_check = true;
      // echo " Form 2 id found in database. ";
    } else {
      $errors = " ERROR: Form 2 id not found in database. ";
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
      'f3_house_num',
      'f3_village_town',
      'f3_state_province',
      'f3_country',
      'f3_zip_code',
      'f3_phone_num',
      'f3_email',
      'f3_same_address',
      'f3_perma_house_num',
      'f3_perma_village_town',
      'f3_perma_state_province',
      'f3_fathers_name',
      'f3_fathers_nationality',
      'f3_fathers_birth_place',
      'f3_fathers_birth_country',
      'f3_mothers_name',
      'f3_mothers_nationality',
      'f3_mothers_birth_place',
      'f3_mothers_birth_country',
      'f3_martial_status',
      'f3_present_occupation',
      'f3_employer_business',
      'f3_work_address',
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
      'f3_mobile_num',
      'f3_fathers_prev_nationality',
      'f3_mothers_prev_nationality',
      'f3_spouse_name',
      'f3_spouse_nationality',
      'f3_spouse_prev_nationality',
      'f3_spouse_birth_place',
      'f3_spouse_birth_country',
      'f3_grand_in_pak',
      'f3_grand_in_pak_more',
      'f3_occupation_more',
      'f3_designation',
      'f3_work_phone',
      'f3_past_occupation',
      'f3_past_occupation_more',
      'f3_military_past',
      'f3_military_past_details',
      'f3_military_organisation',
      'f3_military_designation',
      'f3_military_rank',
      'f3_military_posting',
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
      $form_type                = mysqli_real_escape_string($conn, $_POST['form_type']);
      $form_id                  = mysqli_real_escape_string($conn, $_POST['form_id']);

      $f3_house_num             = mysqli_real_escape_string($conn, $_POST['f3_house_num']);
      $f3_village_town          = mysqli_real_escape_string($conn, $_POST['f3_village_town']);
      $f3_state_province        = mysqli_real_escape_string($conn, $_POST['f3_state_province']);
      $f3_country               = mysqli_real_escape_string($conn, $_POST['f3_country']);
      $f3_zip_code              = mysqli_real_escape_string($conn, $_POST['f3_zip_code']);
      $f3_phone_num             = mysqli_real_escape_string($conn, $_POST['f3_phone_num']);
      $f3_mobile_num            = mysqli_real_escape_string($conn, $_POST['f3_mobile_num']);
      $f3_email                 = mysqli_real_escape_string($conn, $_POST['f3_email']);
      $f3_same_address          = mysqli_real_escape_string($conn, $_POST['f3_same_address']);
      $f3_perma_house_num       = mysqli_real_escape_string($conn, $_POST['f3_perma_house_num']);
      $f3_perma_village_town    = mysqli_real_escape_string($conn, $_POST['f3_perma_village_town']);
      $f3_perma_state_province  = mysqli_real_escape_string($conn, $_POST['f3_perma_state_province']);
      $f3_fathers_name          = mysqli_real_escape_string($conn, $_POST['f3_fathers_name']);
      $f3_fathers_nationality   = mysqli_real_escape_string($conn, $_POST['f3_fathers_nationality']);
      $f3_fathers_birth_place   = mysqli_real_escape_string($conn, $_POST['f3_fathers_birth_place']);
      $f3_fathers_birth_country = mysqli_real_escape_string($conn, $_POST['f3_fathers_birth_country']);
      $f3_mothers_name          = mysqli_real_escape_string($conn, $_POST['f3_mothers_name']);
      $f3_mothers_nationality   = mysqli_real_escape_string($conn, $_POST['f3_mothers_nationality']);
      $f3_mothers_birth_place   = mysqli_real_escape_string($conn, $_POST['f3_mothers_birth_place']);
      $f3_mothers_birth_country = mysqli_real_escape_string($conn, $_POST['f3_mothers_birth_country']);
      $f3_martial_status        = mysqli_real_escape_string($conn, $_POST['f3_martial_status']);
      $f3_present_occupation    = mysqli_real_escape_string($conn, $_POST['f3_present_occupation']);
      $f3_employer_business     = mysqli_real_escape_string($conn, $_POST['f3_employer_business']);
      $f3_work_address          = mysqli_real_escape_string($conn, $_POST['f3_work_address']);

      $f3_fathers_prev_nationality = mysqli_real_escape_string($conn, $_POST['f3_fathers_prev_nationality']);
      $f3_mothers_prev_nationality = mysqli_real_escape_string($conn, $_POST['f3_mothers_prev_nationality']);
      $f3_spouse_name              = mysqli_real_escape_string($conn, $_POST['f3_spouse_name']);
      $f3_spouse_nationality       = mysqli_real_escape_string($conn, $_POST['f3_spouse_nationality']);
      $f3_spouse_prev_nationality  = mysqli_real_escape_string($conn, $_POST['f3_spouse_prev_nationality']);
      $f3_spouse_birth_place       = mysqli_real_escape_string($conn, $_POST['f3_spouse_birth_place']);
      $f3_spouse_birth_country     = mysqli_real_escape_string($conn, $_POST['f3_spouse_birth_country']);
      $f3_grand_in_pak             = mysqli_real_escape_string($conn, $_POST['f3_grand_in_pak']);
      $f3_grand_in_pak_more        = mysqli_real_escape_string($conn, $_POST['f3_grand_in_pak_more']);
      $f3_occupation_more          = mysqli_real_escape_string($conn, $_POST['f3_occupation_more']);
      $f3_designation              = mysqli_real_escape_string($conn, $_POST['f3_designation']);
      $f3_work_phone               = mysqli_real_escape_string($conn, $_POST['f3_work_phone']);
      $f3_past_occupation          = mysqli_real_escape_string($conn, $_POST['f3_past_occupation']);
      $f3_past_occupation_more     = mysqli_real_escape_string($conn, $_POST['f3_past_occupation_more']);
      $f3_military_past            = mysqli_real_escape_string($conn, $_POST['f3_military_past']);
      $f3_military_past_details    = mysqli_real_escape_string($conn, $_POST['f3_military_past_details']);
      $f3_military_organisation    = mysqli_real_escape_string($conn, $_POST['f3_military_organisation']);
      $f3_military_designation     = mysqli_real_escape_string($conn, $_POST['f3_military_designation']);
      $f3_military_rank            = mysqli_real_escape_string($conn, $_POST['f3_military_rank']);
      $f3_military_posting         = mysqli_real_escape_string($conn, $_POST['f3_military_posting']);

      // check if data existing
      $checkexisting = "SELECT * FROM formdata_form3 WHERE form_id = '$form_id' ";
      $checkque = mysqli_query($conn, $checkexisting);

      // set query to update or insert
      $query_sql = "";

      if(mysqli_num_rows($checkque) > 0){
        echo "<strong> WARNING: Same Form id exists, Updating values. </strong>";

        $query_sql = "UPDATE formdata_form3 SET form_type = '$form_type', f3_house_num = '$f3_house_num', f3_village_town = '$f3_village_town', f3_state_province = '$f3_state_province', f3_country = '$f3_country', f3_zip_code = '$f3_zip_code', f3_phone_num = '$f3_phone_num', f3_mobile_num = '$f3_mobile_num', f3_email = '$f3_email', f3_same_address = '$f3_same_address', f3_perma_house_num = '$f3_perma_house_num', f3_perma_village_town = '$f3_perma_village_town', f3_perma_state_province = '$f3_perma_state_province', f3_fathers_name = '$f3_fathers_name', f3_fathers_nationality = '$f3_fathers_nationality', f3_fathers_birth_place = '$f3_fathers_birth_place', f3_fathers_birth_country = '$f3_fathers_birth_country', f3_mothers_name = '$f3_mothers_name', f3_mothers_nationality = '$f3_mothers_nationality', f3_mothers_birth_place = '$f3_mothers_birth_place', f3_mothers_birth_country = '$f3_mothers_birth_country', f3_martial_status = '$f3_martial_status', f3_present_occupation = '$f3_present_occupation', f3_employer_business = '$f3_employer_business', f3_work_address = '$f3_work_address', f3_fathers_prev_nationality = '$f3_fathers_prev_nationality', f3_mothers_prev_nationality = '$f3_mothers_prev_nationality', f3_spouse_name = '$f3_spouse_name', f3_spouse_nationality = '$f3_spouse_nationality', f3_spouse_prev_nationality = '$f3_spouse_prev_nationality', f3_spouse_birth_place = '$f3_spouse_birth_place', f3_spouse_birth_country = '$f3_spouse_birth_country', f3_grand_in_pak = '$f3_grand_in_pak', f3_grand_in_pak_more = '$f3_grand_in_pak_more', f3_occupation_more = '$f3_occupation_more', f3_designation = '$f3_designation', f3_work_phone = '$f3_work_phone', f3_past_occupation = '$f3_past_occupation', f3_past_occupation_more = '$f3_past_occupation_more', f3_military_past = '$f3_military_past', f3_military_past_details = '$f3_military_past_details', f3_military_organisation = '$f3_military_organisation', f3_military_designation = '$f3_military_designation', f3_military_rank = '$f3_military_rank', f3_military_posting = '$f3_military_posting' WHERE form_id = '$form_id' ";

      } else {

        $query_sql = "INSERT INTO formdata_form3( form_id, form_type, f3_house_num, f3_village_town, f3_state_province, f3_country, f3_zip_code, f3_phone_num, f3_mobile_num, f3_email, f3_same_address, f3_perma_house_num, f3_perma_village_town, f3_perma_state_province, f3_fathers_name, f3_fathers_nationality, f3_fathers_prev_nationality, f3_fathers_birth_place, f3_fathers_birth_country, f3_mothers_name, f3_mothers_nationality, f3_mothers_prev_nationality, f3_mothers_birth_place, f3_mothers_birth_country, f3_martial_status, f3_spouse_name, f3_spouse_nationality, f3_spouse_prev_nationality, f3_spouse_birth_place, f3_spouse_birth_country, f3_grand_in_pak, f3_grand_in_pak_more, f3_present_occupation, f3_occupation_more, f3_employer_business, f3_work_address, f3_designation, f3_work_phone, f3_past_occupation, f3_past_occupation_more, f3_military_past, f3_military_past_details, f3_military_organisation, f3_military_designation, f3_military_rank, f3_military_posting) VALUES ('$form_id', '$form_type', '$f3_house_num', '$f3_village_town', '$f3_state_province', '$f3_country', '$f3_zip_code', '$f3_phone_num', '$f3_mobile_num', '$f3_email', '$f3_same_address', '$f3_perma_house_num', '$f3_perma_village_town', '$f3_perma_state_province', '$f3_fathers_name', '$f3_fathers_nationality', '$f3_fathers_prev_nationality', '$f3_fathers_birth_place', '$f3_fathers_birth_country', '$f3_mothers_name', '$f3_mothers_nationality', '$f3_mothers_prev_nationality', '$f3_mothers_birth_place', '$f3_mothers_birth_country', '$f3_martial_status', '$f3_spouse_name', '$f3_spouse_nationality', '$f3_spouse_prev_nationality', '$f3_spouse_birth_place', '$f3_spouse_birth_country', '$f3_grand_in_pak', '$f3_grand_in_pak_more', '$f3_present_occupation', '$f3_occupation_more', '$f3_employer_business', '$f3_work_address', '$f3_designation', '$f3_work_phone', '$f3_past_occupation', '$f3_past_occupation_more', '$f3_military_past', '$f3_military_past_details', '$f3_military_organisation', '$f3_military_designation', '$f3_military_rank', '$f3_military_posting' ) ";

      }

      //execute query
      $que = mysqli_prepare($conn, $query_sql);
      if($que){
        mysqli_stmt_execute($que);
        echo "<strong> SUCCESS: Form 3 saved successfully. Loading Next Form...</strong>";

        //update main formdata
        $user_email = $_SESSION['user_email'];
        $main_sql = "UPDATE formdata_main SET form3_status = 'completed' WHERE form_id = '$form_id' ";
        $main_que = mysqli_prepare($conn, $main_sql);
        mysqli_stmt_execute($main_que);

        //redirect to next form
        $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/e-visa-form4.php?formid=".$form_id;
        if (headers_sent() === false) {
          header('Location: ' . $redirect_to );
        } else {
          echo '<script> window.location.href = "'.$redirect_to.'"; </script>';
        }

      } else {
        echo "<strong> ERROR: Form 3 not saved. Please try again later. </strong>";
      }

    }

  } else {
    echo $errors;
  }

}//end process
