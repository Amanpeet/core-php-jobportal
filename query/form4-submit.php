<?php

//process form data
if( isset($_POST['form4_submit']) && !empty($_POST['form4_submit'])  ){

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

    //form 3 check
    $form3_check = false;
    $form3_data_sql = "SELECT * FROM formdata_form3 WHERE form_id = '$form_id' ";
    $form3_data_query = mysqli_query($conn, $form3_data_sql);
    if(mysqli_num_rows($form3_data_query) > 0){
      $form3_check = true;
      // echo " Form 2 id found in database. ";
    } else {
      $errors = " ERROR: Form 3 id not found in database. ";
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
      'f4_visa_type',
      'f4_visa_subtype',
      'f4_places_visit',
      'f4_expected_duration',
      'f4_port_exit',
      'f4_visited_india',
      'f4_permission_refused',
      'f4_saarc_visited',
      'f4_india_ref_name',
      'f4_india_ref_address',
      'f4_india_ref_phone',
      'f4_home_ref_name',
      'f4_home_ref_address',
      'f4_home_ref_phone',
      'f4_crime_1',
      'f4_crime_2',
      'f4_crime_3',
      'f4_crime_4',
      'f4_crime_5',
      'f4_crime_6',
      'f4_info_check',
    );

    // Loop over fields, check if unset or empty
    $error = false;
    foreach($required_fields as $field) {
      if ( !isset( $_POST[$field] ) || empty( $_POST[$field] ) ) {
        $error = true;
        echo "<strong> ERROR: Required fields Empty or Invalid. </strong>".$field;
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
      'f4_places_visit_more',
      'f4_tour_operator',
      'f4_operator_name',
      'f4_operator_address',
      'f4_operator_hotel',
      'f4_operator_place',
      'f4_expected_entries',
      'f4_port_arrival',
      'f4_visited_address',
      'f4_visited_cities',
      'f4_visited_visa_num',
      'f4_visited_visa_type',
      'f4_visited_visa_place',
      'f4_visited_visa_issue',
      'f4_permission_refused_more',
      'f4_crime_details',
      'f4_saarc_country1_name',
      'f4_saarc_country2_name',
      'f4_saarc_country3_name',
      'f4_saarc_country4_name',
      'f4_saarc_country5_name',
      'f4_saarc_country6_name',
      'f4_saarc_country7_name',
      'f4_saarc_country1_year',
      'f4_saarc_country2_year',
      'f4_saarc_country3_year',
      'f4_saarc_country4_year',
      'f4_saarc_country5_year',
      'f4_saarc_country6_year',
      'f4_saarc_country7_year',
      'f4_saarc_country1_visits',
      'f4_saarc_country2_visits',
      'f4_saarc_country3_visits',
      'f4_saarc_country4_visits',
      'f4_saarc_country5_visits',
      'f4_saarc_country6_visits',
      'f4_saarc_country7_visits',
      'f4_company_name',
      'f4_company_address',
      'f4_company_website',
      'f4_company_business',
      'f4_hospital_name',
      'f4_hospital_address',
      'f4_hospital_state',
      'f4_hospital_district',
      'f4_hospital_phone',
      'f4_hospital_treatment',
      'f4_conf_name',
      'f4_conf_duration',
      'f4_conf_address',
      'f4_conf_state',
      'f4_conf_district',
      'f4_conf_pincode',
      'f4_conf_org_name',
      'f4_conf_org_address',
      'f4_conf_org_email',
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
      $form_type = mysqli_real_escape_string($conn, $_POST['form_type']);
      $form_id   = mysqli_real_escape_string($conn, $_POST['form_id']);

      $f4_visa_type               = mysqli_real_escape_string($conn, $_POST['f4_visa_type']);
      $f4_visa_subtype            = mysqli_real_escape_string($conn, $_POST['f4_visa_subtype']);
      $f4_places_visit            = mysqli_real_escape_string($conn, $_POST['f4_places_visit']);
      $f4_places_visit_more       = mysqli_real_escape_string($conn, $_POST['f4_places_visit_more']);
      $f4_tour_operator           = mysqli_real_escape_string($conn, $_POST['f4_tour_operator']);
      $f4_operator_name           = mysqli_real_escape_string($conn, $_POST['f4_operator_name']);
      $f4_operator_address        = mysqli_real_escape_string($conn, $_POST['f4_operator_address']);
      $f4_operator_hotel          = mysqli_real_escape_string($conn, $_POST['f4_operator_hotel']);
      $f4_operator_place          = mysqli_real_escape_string($conn, $_POST['f4_operator_place']);
      $f4_expected_duration       = mysqli_real_escape_string($conn, $_POST['f4_expected_duration']);
      $f4_expected_entries        = mysqli_real_escape_string($conn, $_POST['f4_expected_entries']);
      $f4_port_arrival            = mysqli_real_escape_string($conn, $_POST['f4_port_arrival']);
      $f4_port_exit               = mysqli_real_escape_string($conn, $_POST['f4_port_exit']);
      $f4_visited_india           = mysqli_real_escape_string($conn, $_POST['f4_visited_india']);
      $f4_visited_address         = mysqli_real_escape_string($conn, $_POST['f4_visited_address']);
      $f4_visited_cities          = mysqli_real_escape_string($conn, $_POST['f4_visited_cities']);
      $f4_visited_visa_num        = mysqli_real_escape_string($conn, $_POST['f4_visited_visa_num']);
      $f4_visited_visa_type       = mysqli_real_escape_string($conn, $_POST['f4_visited_visa_type']);
      $f4_visited_visa_place      = mysqli_real_escape_string($conn, $_POST['f4_visited_visa_place']);
      $f4_visited_visa_issue      = mysqli_real_escape_string($conn, $_POST['f4_visited_visa_issue']);
      $f4_permission_refused      = mysqli_real_escape_string($conn, $_POST['f4_permission_refused']);
      $f4_permission_refused_more = mysqli_real_escape_string($conn, $_POST['f4_permission_refused_more']);
      $f4_saarc_last              = mysqli_real_escape_string($conn, $_POST['f4_saarc_last']);
      $f4_saarc_visited           = mysqli_real_escape_string($conn, $_POST['f4_saarc_visited']);
      $f4_india_ref_name          = mysqli_real_escape_string($conn, $_POST['f4_india_ref_name']);
      $f4_india_ref_address       = mysqli_real_escape_string($conn, $_POST['f4_india_ref_address']);
      $f4_india_ref_phone         = mysqli_real_escape_string($conn, $_POST['f4_india_ref_phone']);
      $f4_home_ref_name           = mysqli_real_escape_string($conn, $_POST['f4_home_ref_name']);
      $f4_home_ref_address        = mysqli_real_escape_string($conn, $_POST['f4_home_ref_address']);
      $f4_home_ref_phone          = mysqli_real_escape_string($conn, $_POST['f4_home_ref_phone']);
      $f4_crime_1                 = mysqli_real_escape_string($conn, $_POST['f4_crime_1']);
      $f4_crime_2                 = mysqli_real_escape_string($conn, $_POST['f4_crime_2']);
      $f4_crime_3                 = mysqli_real_escape_string($conn, $_POST['f4_crime_3']);
      $f4_crime_4                 = mysqli_real_escape_string($conn, $_POST['f4_crime_4']);
      $f4_crime_5                 = mysqli_real_escape_string($conn, $_POST['f4_crime_5']);
      $f4_crime_6                 = mysqli_real_escape_string($conn, $_POST['f4_crime_6']);
      $f4_crime_details           = mysqli_real_escape_string($conn, $_POST['f4_crime_details']);
      $f4_info_check              = mysqli_real_escape_string($conn, $_POST['f4_info_check']);

      // saarc fields
      $f4_saarc_country1_name   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country1_name']);
      $f4_saarc_country2_name   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country2_name']);
      $f4_saarc_country3_name   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country3_name']);
      $f4_saarc_country4_name   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country4_name']);
      $f4_saarc_country5_name   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country5_name']);
      $f4_saarc_country6_name   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country6_name']);
      $f4_saarc_country7_name   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country7_name']);
      $f4_saarc_country1_year   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country1_year']);
      $f4_saarc_country2_year   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country2_year']);
      $f4_saarc_country3_year   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country3_year']);
      $f4_saarc_country4_year   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country4_year']);
      $f4_saarc_country5_year   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country5_year']);
      $f4_saarc_country6_year   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country6_year']);
      $f4_saarc_country7_year   = mysqli_real_escape_string($conn, $_POST['f4_saarc_country7_year']);
      $f4_saarc_country1_visits = mysqli_real_escape_string($conn, $_POST['f4_saarc_country1_visits']);
      $f4_saarc_country2_visits = mysqli_real_escape_string($conn, $_POST['f4_saarc_country2_visits']);
      $f4_saarc_country3_visits = mysqli_real_escape_string($conn, $_POST['f4_saarc_country3_visits']);
      $f4_saarc_country4_visits = mysqli_real_escape_string($conn, $_POST['f4_saarc_country4_visits']);
      $f4_saarc_country5_visits = mysqli_real_escape_string($conn, $_POST['f4_saarc_country5_visits']);
      $f4_saarc_country6_visits = mysqli_real_escape_string($conn, $_POST['f4_saarc_country6_visits']);
      $f4_saarc_country7_visits = mysqli_real_escape_string($conn, $_POST['f4_saarc_country7_visits']);

      $f4_saarc_countries = $f4_saarc_country1_name.'; '.$f4_saarc_country2_name.'; '.$f4_saarc_country3_name.'; '.$f4_saarc_country4_name.'; '.$f4_saarc_country5_name.'; '.$f4_saarc_country6_name.'; '.$f4_saarc_country7_name.'; ';
      $f4_saarc_years = $f4_saarc_country1_year.'; '.$f4_saarc_country2_year.'; '.$f4_saarc_country3_year.'; '.$f4_saarc_country4_year.'; '.$f4_saarc_country5_year.'; '.$f4_saarc_country6_year.'; '.$f4_saarc_country7_year.'; ';
      $f4_saarc_visits = $f4_saarc_country1_visits.'; '.$f4_saarc_country2_visits.'; '.$f4_saarc_country3_visits.'; '.$f4_saarc_country4_visits.'; '.$f4_saarc_country5_visits.'; '.$f4_saarc_country6_visits.'; '.$f4_saarc_country7_visits.'; ';

      // business only fields
      $f4_company_name        = mysqli_real_escape_string($conn, $_POST['f4_company_name']);
      $f4_company_address     = mysqli_real_escape_string($conn, $_POST['f4_company_address']);
      $f4_company_website     = mysqli_real_escape_string($conn, $_POST['f4_company_website']);
      $f4_ind_company_name    = mysqli_real_escape_string($conn, $_POST['f4_ind_company_name']);
      $f4_ind_company_address = mysqli_real_escape_string($conn, $_POST['f4_ind_company_address']);
      $f4_ind_company_website = mysqli_real_escape_string($conn, $_POST['f4_ind_company_website']);
      $f4_company_business    = mysqli_real_escape_string($conn, $_POST['f4_company_business']);
      $f4_business_details = $f4_company_name.';'.$f4_company_address.';'.$f4_company_website.';'.$f4_ind_company_name.';' .$f4_ind_company_address.';'.$f4_ind_company_website.';'.$f4_company_business;

      // medical only fields
      $f4_hospital_name      = mysqli_real_escape_string($conn, $_POST['f4_hospital_name']);
      $f4_hospital_address   = mysqli_real_escape_string($conn, $_POST['f4_hospital_address']);
      $f4_hospital_state     = mysqli_real_escape_string($conn, $_POST['f4_hospital_state']);
      $f4_hospital_district  = mysqli_real_escape_string($conn, $_POST['f4_hospital_district']);
      $f4_hospital_phone     = mysqli_real_escape_string($conn, $_POST['f4_hospital_phone']);
      $f4_hospital_treatment = mysqli_real_escape_string($conn, $_POST['f4_hospital_treatment']);
      $f4_medical_details = $f4_hospital_name.';' .$f4_hospital_address.';' .$f4_hospital_state.';' .$f4_hospital_district.';' .$f4_hospital_phone.';' .$f4_hospital_treatment;

      // conference only fields
      $f4_conf_name        = mysqli_real_escape_string($conn, $_POST['f4_conf_name']);
      $f4_conf_duration    = mysqli_real_escape_string($conn, $_POST['f4_conf_duration']);
      $f4_conf_address     = mysqli_real_escape_string($conn, $_POST['f4_conf_address']);
      $f4_conf_state       = mysqli_real_escape_string($conn, $_POST['f4_conf_state']);
      $f4_conf_district    = mysqli_real_escape_string($conn, $_POST['f4_conf_district']);
      $f4_conf_pincode     = mysqli_real_escape_string($conn, $_POST['f4_conf_pincode']);
      $f4_conf_org_name    = mysqli_real_escape_string($conn, $_POST['f4_conf_org_name']);
      $f4_conf_org_address = mysqli_real_escape_string($conn, $_POST['f4_conf_org_address']);
      $f4_conf_org_email   = mysqli_real_escape_string($conn, $_POST['f4_conf_org_email']);
      $f4_conference_details = $f4_conf_name.';' .$f4_conf_duration.';' .$f4_conf_address.';' .$f4_conf_state.';' .$f4_conf_district.';' .$f4_conf_pincode.';' .$f4_conf_org_name.';' .$f4_conf_org_address.';' .$f4_conf_org_email;

      // check if data existing
      $checkexisting = "SELECT * FROM formdata_form4 WHERE form_id = '$form_id' ";
      $checkque = mysqli_query($conn, $checkexisting);

      // set query to update or insert
      $query_sql = "";

      if(mysqli_num_rows($checkque) > 0){
        echo "<strong> WARNING: Same Form id exists, Updating values. </strong>";

        $query_sql = "UPDATE formdata_form4 SET form_type = '$form_type', f4_visa_type = '$f4_visa_type', f4_visa_subtype = '$f4_visa_subtype', f4_places_visit = '$f4_places_visit', f4_places_visit_more = '$f4_places_visit_more', f4_tour_operator = '$f4_tour_operator', f4_operator_name = '$f4_operator_name', f4_operator_address = '$f4_operator_address', f4_operator_hotel = '$f4_operator_hotel', f4_operator_place = '$f4_operator_place', f4_expected_duration = '$f4_expected_duration', f4_expected_entries = '$f4_expected_entries', f4_port_arrival = '$f4_port_arrival', f4_port_exit = '$f4_port_exit', f4_visited_india = '$f4_visited_india', f4_visited_address = '$f4_visited_address', f4_visited_cities = '$f4_visited_cities', f4_visited_visa_num = '$f4_visited_visa_num', f4_visited_visa_type = '$f4_visited_visa_type', f4_visited_visa_place = '$f4_visited_visa_place', f4_visited_visa_issue = '$f4_visited_visa_issue', f4_permission_refused = '$f4_permission_refused', f4_permission_refused_more = '$f4_permission_refused_more', f4_saarc_last = '$f4_saarc_last', f4_saarc_visited = '$f4_saarc_visited', f4_saarc_countries = '$f4_saarc_countries', f4_saarc_years = '$f4_saarc_years', f4_saarc_visits = '$f4_saarc_visits',
        f4_business_details = '$f4_business_details', f4_medical_details = '$f4_medical_details', f4_conference_details = '$f4_conference_details', f4_india_ref_name = '$f4_india_ref_name', f4_india_ref_address = '$f4_india_ref_address', f4_india_ref_phone = '$f4_india_ref_phone', f4_home_ref_name = '$f4_home_ref_name', f4_home_ref_address = '$f4_home_ref_address', f4_home_ref_phone = '$f4_home_ref_phone', f4_crime_1 = '$f4_crime_1', f4_crime_2 = '$f4_crime_2', f4_crime_3 = '$f4_crime_3', f4_crime_4 = '$f4_crime_4', f4_crime_5 = '$f4_crime_5', f4_crime_6 = '$f4_crime_6', f4_crime_details = '$f4_crime_details', f4_info_check = '$f4_info_check' WHERE form_id = '$form_id' ";

      } else {

        $query_sql = "INSERT INTO formdata_form4( form_id, form_type, f4_visa_type, f4_visa_subtype, f4_places_visit, f4_places_visit_more, f4_tour_operator, f4_operator_name, f4_operator_address, f4_operator_hotel, f4_operator_place, f4_expected_duration, f4_expected_entries, f4_port_arrival, f4_port_exit, f4_visited_india, f4_visited_address, f4_visited_cities, f4_visited_visa_num, f4_visited_visa_type, f4_visited_visa_place, f4_visited_visa_issue, f4_permission_refused, f4_permission_refused_more, f4_saarc_last, f4_saarc_visited, f4_saarc_countries, f4_saarc_years, f4_saarc_visits, f4_business_details, f4_medical_details,  f4_conference_details, f4_india_ref_name, f4_india_ref_address, f4_india_ref_phone, f4_home_ref_name, f4_home_ref_address, f4_home_ref_phone, f4_crime_1, f4_crime_2, f4_crime_3, f4_crime_4, f4_crime_5, f4_crime_6, f4_crime_details, f4_info_check) VALUES ( '$form_id', '$form_type', '$f4_visa_type', '$f4_visa_subtype', '$f4_places_visit', '$f4_places_visit_more', '$f4_tour_operator', '$f4_operator_name', '$f4_operator_address', '$f4_operator_hotel', '$f4_operator_place', '$f4_expected_duration', '$f4_expected_entries', '$f4_port_arrival', '$f4_port_exit', '$f4_visited_india', '$f4_visited_address', '$f4_visited_cities', '$f4_visited_visa_num', '$f4_visited_visa_type', '$f4_visited_visa_place', '$f4_visited_visa_issue', '$f4_permission_refused', '$f4_permission_refused_more', '$f4_saarc_last', '$f4_saarc_visited', '$f4_saarc_countries', '$f4_saarc_years', '$f4_saarc_visits', '$f4_business_details', '$f4_medical_details', '$f4_conference_details',  '$f4_india_ref_name', '$f4_india_ref_address', '$f4_india_ref_phone', '$f4_home_ref_name', '$f4_home_ref_address', '$f4_home_ref_phone', '$f4_crime_1', '$f4_crime_2', '$f4_crime_3', '$f4_crime_4', '$f4_crime_5', '$f4_crime_6', '$f4_crime_details', '$f4_info_check' ); ";

      }

      //execute query
      $que = mysqli_prepare($conn, $query_sql);
      if($que){
        mysqli_stmt_execute($que);
        echo "<strong> SUCCESS: Form 4 saved successfully. Loading Next Form...</strong>";

        //update main formdata
        $user_email = $_SESSION['user_email'];
        $main_sql = "UPDATE formdata_main SET form4_status = 'completed' WHERE form_id = '$form_id' ";
        $main_que = mysqli_prepare($conn, $main_sql);
        mysqli_stmt_execute($main_que);

        //redirect to next form
        $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/e-visa-form5.php?formid=".$form_id;
        if (headers_sent() === false) {
          header('Location: ' . $redirect_to );
        } else {
          echo '<script> window.location.href = "'.$redirect_to.'"; </script>';
        }

      } else {
        echo "<strong> ERROR: Form 4 not saved. Please try again later. </strong>";
      }

    }

  } else {
    echo $errors;
  }

}//end process
