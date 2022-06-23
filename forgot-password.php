<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Password Recovery</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <div class="heading-section text-center my-5">
      <h2 class=""><span>Forgot</span> Password</h2>
      <p class="w-75 mx-auto">Please input your registered email id where we will send the reset password link. If you doesnt recieve link in your inbox, make sure you check spam folder too. Otherwise check your email id is correct.</p>
    </div>

    <div class="row">
      <div class="col-md-10 mx-auto mb-4">

        <div class="text-center">

          <form name="forgot-pass-form" method="post" class="mb-3">
            <div class="row">
              <div class="form-group col-sm-6 mx-auto">
                <label><strong>Registered Email</strong></label>
                <input class="form-control" name="user_email" type="email" placeholder="example@email.com" required />
              </div>
              <div class="form-group col-sm-12 mb-0">
                <input type="submit" name="mail_submit" class="btn btn-primary" value="Submit" />
              </div>
            </div>
          </form>

          <?php
          if (isset($_POST['mail_submit'])) {

            $error = "";
            $email = strip_tags($_POST['user_email']);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ( !$email ) {
              $error = "<h6 class='text-danger'>Invalid email address please type a valid email address!</h6>";
            } else {
              $sel_query = "SELECT * FROM `users` WHERE email='$email' ";
              $results = mysqli_query($conn, $sel_query);
              if ( mysqli_num_rows($results) < 1 ) {
                $error = "<h6 class='text-danger'>No user is registered with this email.</h6>";
              }
            }

            // create the token and save
            if ($error != "") {
              echo "<h4 class='text-danger'>" . $error . "</h4>";
            } else {
              $expFormat = mktime(
                date("H"),
                date("i"),
                date("s"),
                date("m"),
                date("d") + 1, // expires 1 day later
                date("Y")
              );
              $expDate = date("Y-m-d H:i:s", $expFormat);
              $token = md5( (2418 * 2) . $email );
              $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
              echo $token = $token . $addKey;

              // Insert Into Table
              $insert_sql = "INSERT INTO `users_resetpass` (`email`, `token`, `expDate`) VALUES ('$email', '$token', '$expDate' );";
              $main_que = mysqli_prepare($conn, $insert_sql);
              if( $main_que ){
                mysqli_stmt_execute($main_que);
                // echo "<h6 class='text-success'>Password Reset Token Generated Successfully.</h6>";
              }

              //craft pass reset email
              $to = $email;
              $from = "info@rojgarway.com";
              $subject = "RojgarWay - Forgot Password Request";
              $message = "";
              $message .= "<p>New Reset Password Request.</p>";
              $message .= '<p>Please click on the following link to reset your password.</p>';
              $message .= '<p><a href="https://www.rojgarway.com/reset-password.php?token=' . $token . '&email=' . $email . '&action=reset" target="_blank">https://www.rojgarway.com/reset-password.php?token=' . $token . '&email=' . $email . '&action=reset</a></p>';
              $message .= '<p>Please be sure to copy the entire link into your browser.<strong>The link will expire after 1 day</strong> for security reasons.</p>';
              $message .= '<p>If you did not request this forgotten password email, no action is needed, your password will not be reset. However, you may want to log into your account and change your security password as someone may have guessed it.</p>';

              // Always set content-type when sending HTML email
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= 'From: <'.$from.'>' . "\r\n";
              $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
              // $headers .= "CC: susan@example.com\r\n";

              $mail_check = mail($to, $subject, $message, $headers);
              if( $mail_check ){
                echo "<h6 class='text-success'> An email has been sent to your registered email with instructions to reset your password.</h6>";
              } else {
                echo "<h6 class='text-danger'>Operation Failed. Please contact us at <strong>info@rojgarway.com</strong></h6>";
              }

            }
          }
          ?>

        </div>

      </div>
    </div>

  </div>
</section>

<?php include('footer.php'); //footer ?>
