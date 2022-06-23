<?php

//process form data
if( isset($_POST['form5_submit']) && !empty($_POST['form5_submit'])  ){

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
      // echo " Form 3 id found in database. ";
    } else {
      $errors = " ERROR: Form 3 id not found in database. ";
    }

    //form 4 check
    $form4_check = false;
    $form4_data_sql = "SELECT * FROM formdata_form4 WHERE form_id = '$form_id' ";
    $form4_data_query = mysqli_query($conn, $form4_data_sql);
    if(mysqli_num_rows($form4_data_query) > 0){
      $form4_check = true;
      // echo " Form 4 id found in database. ";
    } else {
      $errors = " ERROR: Form 4 id not found in database. ";
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
      'f5_docs_check',
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

    //if any error
    if ($error) {
      //errors defined above
      // echo "<strong> ERROR: Required fields Empty or Invalid. Please try again.</strong>";
    } else {

      //set field vars
      $form_type     = mysqli_real_escape_string($conn, $_POST['form_type']);
      $form_id       = mysqli_real_escape_string($conn, $_POST['form_id']);
      $f5_docs_check = mysqli_real_escape_string($conn, $_POST['f5_docs_check']);

      //name from form_id
      // $uniqd = round(microtime(true));
      $uniqd = $form_id;

      //file1
      $f5_photo_upload = '';
      $fileserr1 = false;
      if( ($_FILES['f5_photo_upload']['size'] == 0) ){
        $f5_photo_upload = '';
        $fileserr1 = false;
      } else if( $_FILES['f5_photo_upload']['size'] > (1*1024*1024) ) { //1MB
        $fileserr1 = true;
      } else {
        $temp        = explode(".", $_FILES["f5_photo_upload"]["name"]);
        $newfilename = $uniqd . '_photo_upload' . '.' . end($temp);
        $imagetmp    = trim($_FILES['f5_photo_upload']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $f5_photo_upload = $newfilename;
        $fileserr1 = false;
      }

      //file2
      $f5_passport_pages = '';
      $fileserr2 = false;
      if( ($_FILES['f5_passport_pages']['size'] == 0) ){
        $f5_passport_pages = '';
        $fileserr2 = false;
      } else if( $_FILES['f5_passport_pages']['size'] > (1*1024*1024) ) { //1MB
        $fileserr2 = true;
      } else {
        $temp        = explode(".", $_FILES["f5_passport_pages"]["name"]);
        $newfilename = $uniqd . '_passport_pages' . '.' . end($temp);
        $imagetmp    = trim($_FILES['f5_passport_pages']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $f5_passport_pages = $newfilename;
        $fileserr2 = false;
      }

      //file3
      $f5_other_doc1 = '';
      $fileserr_doc1 = false;
      if( ($_FILES['f5_other_doc1']['size'] == 0) ){
        $f5_other_doc1 = '';
        $fileserr_doc1 = false;
      } else if( $_FILES['f5_other_doc1']['size'] > (1*1024*1024) ) { //1MB
        $fileserr_doc1 = true;
      } else {
        $temp        = explode(".", $_FILES["f5_other_doc1"]["name"]);
        $newfilename = $uniqd . '_other_doc1' . '.' . end($temp);
        $imagetmp    = trim($_FILES['f5_other_doc1']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $f5_other_doc1 = $newfilename;
        $fileserr_doc1 = false;
      }

      //file4
      $f5_other_doc2 = '';
      $fileserr_doc2 = false;
      if( ($_FILES['f5_other_doc2']['size'] == 0) ){
        $f5_other_doc2 = '';
        $fileserr_doc2 = false;
      } else if( $_FILES['f5_other_doc2']['size'] > (1*1024*1024) ) { //1MB
        $fileserr_doc2 = true;
      } else {
        $temp        = explode(".", $_FILES["f5_other_doc2"]["name"]);
        $newfilename = $uniqd . '_other_doc2' . '.' . end($temp);
        $imagetmp    = trim($_FILES['f5_other_doc2']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $f5_other_doc2 = $newfilename;
        $fileserr_doc2 = false;
      }

      //file5
      $f5_other_doc3 = '';
      $fileserr_doc3 = false;
      if( ($_FILES['f5_other_doc3']['size'] == 0) ){
        $f5_other_doc3 = '';
        $fileserr_doc3 = false;
      } else if( $_FILES['f5_other_doc3']['size'] > (1*1024*1024) ) { //1MB
        $fileserr_doc3 = true;
      } else {
        $temp        = explode(".", $_FILES["f5_other_doc3"]["name"]);
        $newfilename = $uniqd . '_other_doc3' . '.' . end($temp);
        $imagetmp    = trim($_FILES['f5_other_doc3']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $f5_other_doc3 = $newfilename;
        $fileserr_doc3 = false;
      }

      //file6
      $f5_other_doc4 = '';
      $fileserr_doc4 = false;
      if( ($_FILES['f5_other_doc4']['size'] == 0) ){
        $f5_other_doc4 = '';
        $fileserr_doc4 = false;
      } else if( $_FILES['f5_other_doc4']['size'] > (1*1024*1024) ) { //1MB
        $fileserr_doc4 = true;
      } else {
        $temp        = explode(".", $_FILES["f5_other_doc4"]["name"]);
        $newfilename = $uniqd . '_other_doc4' . '.' . end($temp);
        $imagetmp    = trim($_FILES['f5_other_doc4']['tmp_name']);
        $path        = "uploads/".$newfilename;
        move_uploaded_file($imagetmp, $path);
        $f5_other_doc4 = $newfilename;
        $fileserr_doc4 = false;
      }

      //no files error
      if( $fileserr1 || $fileserr2 || $fileserr_doc1 || $fileserr_doc2 || $fileserr_doc3 || $fileserr_doc4 ){
        echo "<strong>ERROR: Required files Missing or Invalid. Max Size Allowed: 1MB each.</strong>";
      } else {

        // check if data existing
        $checkexisting = "SELECT * FROM formdata_form5 WHERE form_id = '$form_id' ";
        $checkque = mysqli_query($conn, $checkexisting);

        // set query to update or insert
        $query_sql = "";

        if(mysqli_num_rows($checkque) > 0){
          echo "<strong> WARNING: Form id Exists, Updating values. </strong><br />";

          // get previous values if empty
          $getrow = mysqli_fetch_assoc($checkque);
          $f5_photo_upload = ( empty($f5_photo_upload) ) ? $getrow['f5_photo_upload'] : $f5_photo_upload;
          $f5_passport_pages = ( empty($f5_passport_pages) ) ? $getrow['f5_passport_pages'] : $f5_passport_pages;
          $f5_other_doc1 = ( empty($f5_other_doc1) ) ? $getrow['f5_other_doc1'] : $f5_other_doc1;
          $f5_other_doc2 = ( empty($f5_other_doc2) ) ? $getrow['f5_other_doc2'] : $f5_other_doc2;
          $f5_other_doc3 = ( empty($f5_other_doc3) ) ? $getrow['f5_other_doc3'] : $f5_other_doc3;
          $f5_other_doc4 = ( empty($f5_other_doc4) ) ? $getrow['f5_other_doc4'] : $f5_other_doc4;

          $query_sql = "UPDATE formdata_form5 SET form_type = '$form_type', f5_photo_upload = '$f5_photo_upload', f5_passport_pages = '$f5_passport_pages', f5_other_doc1 = '$f5_other_doc1', f5_other_doc2 = '$f5_other_doc2', f5_other_doc3 = '$f5_other_doc3', f5_other_doc4 = '$f5_other_doc4', f5_docs_check = '$f5_docs_check' WHERE form_id = '$form_id' ";

        } else {

          $query_sql = "INSERT INTO formdata_form5( form_id, form_type, f5_photo_upload, f5_passport_pages, f5_other_doc1, f5_other_doc2, f5_other_doc3, f5_other_doc4, f5_docs_check) VALUES ( '$form_id', '$form_type', '$f5_photo_upload', '$f5_passport_pages', '$f5_other_doc1', '$f5_other_doc2', '$f5_other_doc3', '$f5_other_doc4', '$f5_docs_check' )";

        }

        //execute query
        $que = mysqli_prepare($conn, $query_sql);
        if($que){
          mysqli_stmt_execute($que);
          echo "<strong> SUCCESS: Form 5 saved successfully. Loading Payment Page...</strong>";

          //update main formdata
          $user_email = $_SESSION['user_email'];
          $main_sql = "UPDATE formdata_main SET form5_status = 'completed' WHERE form_id = '$form_id' ";
          $main_que = mysqli_prepare($conn, $main_sql);
          mysqli_stmt_execute($main_que);

          //SEND MAIL TO ALERT ADMINS
          $query = "New Application Form filled on IndiaVisa.co.uk UK Website.";
          $to = "enquiry@indiavisa.co.uk";
          $from = "alert@indianevisaonline.com";
          $subject = "IndiaVisa.co.uk New Application Form";
          $message = "<html><head><title>New Application Form</title></head><body>";
          $message .= "<p>New Application Form on IndiaVisa.co.uk Website.</p>";
          $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
          $message .= "<tr> <td>Visa Type</td> <td>".$form_type."</td> </tr>";
          $message .= "<tr> <td>Form ID</td> <td>".$form_id."</td> </tr>";
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
          $redirect_to = "http://" . $_SERVER['HTTP_HOST'] . "/e-visa-payment.php?formid=".$form_id;
          if (headers_sent() === false) {
            header('Location: ' . $redirect_to );
          } else {
            echo '<script> window.location.href = "'.$redirect_to.'"; </script>';
          }

        } else {
          echo "<strong> ERROR: Form 5 not saved. Please try again later. </strong>";
        }

      }

    }

  } else {
    echo $errors;
  }

}//end process
