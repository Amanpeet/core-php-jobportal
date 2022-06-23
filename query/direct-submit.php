<?php

//process form data
if( isset($_POST['qck_submit']) && !empty($_POST['qck_submit'])  ){

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
      'pay_type',
      'qck_travellers',
      'qck_first_name',
      'qck_last_name',
      'qck_phone_num',
      'qck_email',
      'qck_dob',
      'qck_zipcode',
      'qck_address',
      'qck_place',
      'qck_country',
      'qck_passport',
      'qck_passport_expiry',
      'qck_payment_mode',
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

    $qck_traveller_2 = array();
    $qck_traveller_3 = array();
    $qck_traveller_4 = array();
    $qck_traveller_5 = array();
    $qck_traveller_6 = array();
    $qck_traveller_7 = array();
    $qck_traveller_8 = array();
    $qck_traveller_9 = array();

    //loop thru travellers
    for ($i=2; $i < 10; $i++) {

      // Set Optional Values
      $optional_fields = array(
        "qck_travellers_fname_$i",
        "qck_travellers_lname_$i",
        "qck_travellers_dob_$i",
        "qck_travellers_phone_$i",
        "qck_travellers_passport_$i",
        "qck_travellers_expiry_$i",
      );

      // Loop over types, assign values if not set
      foreach($optional_fields as $fieldo) {
        $fieldo_value = "";
        if ( isset( $_POST[$fieldo] ) && !empty( $_POST[$fieldo] ) ) {
          $fieldo_value = mysqli_real_escape_string($conn, $_POST[$fieldo]);
          ${'qck_traveller_'.$i}[$fieldo] = $fieldo_value;
        }
        $_POST[$fieldo] = $fieldo_value;
      }
    }

    //if any error
    if ($error) {
      // echo "the if cond.";
      //errors defined above
      // echo "<strong> ERROR: Required fields Empty or Invalid. Please try again.</strong>";
    } else {

      //get user email
      $user_email = $_SESSION['user_email'];
      //generate new form id
      $uniqd = round(microtime(true));
      $qck_id = "QCK".$uniqd;

      //set field vars
      $pay_type            = mysqli_real_escape_string($conn, $_POST['pay_type']);
      $qck_travellers      = mysqli_real_escape_string($conn, $_POST['qck_travellers']);
      $qck_first_name      = mysqli_real_escape_string($conn, $_POST['qck_first_name']);
      $qck_last_name       = mysqli_real_escape_string($conn, $_POST['qck_last_name']);
      $qck_dob             = mysqli_real_escape_string($conn, $_POST['qck_dob']);
      $qck_phone_num       = mysqli_real_escape_string($conn, $_POST['qck_phone_num']);
      $qck_email           = mysqli_real_escape_string($conn, $_POST['qck_email']);
      $qck_address         = mysqli_real_escape_string($conn, $_POST['qck_address']);
      $qck_place           = mysqli_real_escape_string($conn, $_POST['qck_place']);
      $qck_country         = mysqli_real_escape_string($conn, $_POST['qck_country']);
      $qck_zipcode         = mysqli_real_escape_string($conn, $_POST['qck_zipcode']);
      $qck_passport        = mysqli_real_escape_string($conn, $_POST['qck_passport']);
      $qck_passport_expiry = mysqli_real_escape_string($conn, $_POST['qck_passport_expiry']);
      $qck_payment_mode    = mysqli_real_escape_string($conn, $_POST['qck_payment_mode']);

      // serialize arrays if not empty
      $qck_traveller_2 = ( !empty($qck_traveller_2) ) ? serialize( $qck_traveller_2 ) : '' ;
      $qck_traveller_3 = ( !empty($qck_traveller_3) ) ? serialize( $qck_traveller_3 ) : '' ;
      $qck_traveller_4 = ( !empty($qck_traveller_4) ) ? serialize( $qck_traveller_4 ) : '' ;
      $qck_traveller_5 = ( !empty($qck_traveller_5) ) ? serialize( $qck_traveller_5 ) : '' ;
      $qck_traveller_6 = ( !empty($qck_traveller_6) ) ? serialize( $qck_traveller_6 ) : '' ;
      $qck_traveller_7 = ( !empty($qck_traveller_7) ) ? serialize( $qck_traveller_7 ) : '' ;
      $qck_traveller_8 = ( !empty($qck_traveller_8) ) ? serialize( $qck_traveller_8 ) : '' ;
      $qck_traveller_9 = ( !empty($qck_traveller_9) ) ? serialize( $qck_traveller_9 ) : '' ;

      //get total payment
      $qck_total_amt = searchAmount($pay_type) * $qck_travellers;

      // INSERT INP DATA
      $main_sql = "INSERT INTO `quick_forms`( `user_email`, `pay_type`, `qck_id`, `qck_travellers`, `qck_first_name`, `qck_last_name`, `qck_dob`, `qck_phone_num`, `qck_email`, `qck_address`, `qck_place`, `qck_country`, `qck_zipcode`, `qck_passport`, `qck_passport_expiry`, `qck_total_amt`, `qck_payment_mode`, `qck_traveller_2`, `qck_traveller_3`, `qck_traveller_4`, `qck_traveller_5`, `qck_traveller_6`, `qck_traveller_7`, `qck_traveller_8`, `qck_traveller_9` ) VALUES ( '$user_email', '$pay_type', '$qck_id', '$qck_travellers', '$qck_first_name', '$qck_last_name', '$qck_dob', '$qck_phone_num', '$qck_email', '$qck_address', '$qck_place', '$qck_country', '$qck_zipcode', '$qck_passport', '$qck_passport_expiry', '$qck_total_amt', '$qck_payment_mode', '$qck_traveller_2', '$qck_traveller_3', '$qck_traveller_4', '$qck_traveller_5', '$qck_traveller_6', '$qck_traveller_7', '$qck_traveller_8', '$qck_traveller_9' ) ";
      $main_que = mysqli_prepare($conn, $main_sql);

      if( $main_que ){
        mysqli_stmt_execute($main_que);
        echo "<strong class='text-success'> SUCCESS: Form Application Created Successfully.</strong>";

        //SEND MAIL TO ALERT ADMINS
        $form_type = "Quick Travellers Form";
        $query = "New Quick Travellers Form Filled on IndiaVisa.co.uk UK Website.";
        $to = "enquiry@indiavisa.co.uk";
        // $to = "amanpreet@intiger.in";
        $from = "alert@indianevisaonline.com";
        $subject = "IndiaVisa.co.uk New Quick Travellers Form";
        $message = "<html><head><title>New Quick Travellers Form</title></head><body>";
        $message .= "<p>New Quick Travellers Form on IndiaVisa.co.uk UK Website.</p>";
        $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
        $message .= "<tr> <td>Visa Type</td> <td>".$pay_type." (Quick Form) </td> </tr>";
        $message .= "<tr> <td>Travellers</td> <td>".$qck_travellers."</td> </tr>";
        $message .= "<tr> <td>Form ID</td> <td>".$qck_id."</td> </tr>";
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
          echo "<h5 class='text-success'> Please note your Form Application ID: $qck_id </h5>";
          echo "<h5 class='text-success'> You have selected to pay via Cheque Deposit. Cheque should be made payable to 'India Visa'. </h5>";
        } else {
          $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/payment-only.php?pay=quick_form&qid=$qck_id";
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

