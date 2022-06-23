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
      <h2 class=""><span>Reset</span> Password</h2>
      <p class="w-75 mx-auto">Please Choose a strong password with over 8 chars, and must include atleast one Uppercase, one Lowercase & one Number. Mix them up to create a strong password.</p>
    </div>

    <div class="row">
      <div class="col-md-10 mx-auto mb-4">

        <div class="text-center">

          <?php
          // VERIFY PASSWORD RESET LINK
          if ( isset($_GET["token"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"]) ) { //method: GET

            $error = "";
            $token = $_GET["token"];
            $email = $_GET["email"];
            $curDate = date("Y-m-d H:i:s");

            $chk_sql = "SELECT * FROM `users_resetpass` WHERE `token`='$token' AND `email`='$email'; ";
            $query = mysqli_query($conn, $chk_sql);
            if ( mysqli_num_rows($query) < 1 ) {
              $error .= '<h4 class="text-danger">Invalid Link</h4>
              <p>The link is invalid/expired. Either you did not copy the correct link from the email, or you have already used the key in which case it is deactivated. Go back to Forgot Password page and Request a new password reset link.</p>';
            } else {

              $row = mysqli_fetch_assoc($query);
              $expDate = $row['expDate'];
              if ($expDate >= $curDate) {
                ?>
                <form name="forgot-pass-form" method="post" class="login mb-3">
                  <input type="hidden" name="user_email" value="<?php echo $email; ?>" />
                  <input type="hidden" name="action" value="update" />
                  <div class="row">
                    <div class="form-group col-sm-7 mx-auto text-left">
                      <label><strong>Enter New Password</strong></label>
                      <input class="form-control" name="new_pass1" type="password" required />
                    </div>
                    <div class="form-group col-sm-7 mx-auto text-left">
                      <label><strong>Confirm New Password</strong></label>
                      <input class="form-control" name="new_pass2" type="password" required />
                    </div>
                    <div class="form-group col-sm-12 mb-0">
                      <input type="submit" name="reset_submit" class="btn btn-primary" value="RESET PASSWORD" />
                    </div>
                  </div>
                </form>
              <?php
              } else {
                $error .= "<h5 class='text-danger'>Link Expired</h5>
                <h6>The link has expired. You are trying to use the expired link which as valid only 24 hours (1 days after request).</h6>";
              }
            }
            if ($error != "") {
              echo "<div>" . $error . "</div>";
            }
          }

          // UPDATE PASSWORD FORM
          if ( isset($_POST["reset_submit"]) && isset($_POST["user_email"]) && isset($_POST["action"]) && ($_POST["action"] == "update")) { //method: POST

            $error = "";
            $pass1 = mysqli_real_escape_string($conn, $_POST["new_pass1"]);
            $pass2 = mysqli_real_escape_string($conn, $_POST["new_pass2"]);
            $email = mysqli_real_escape_string($conn, $_POST["user_email"]);
            $curDate = date("Y-m-d H:i:s"); //current date

            //match passwords
            if ($pass1 != $pass2) {
              $error .= "<h5 class='text-danger'>Password do not match, both password should be same.</h5>";
            }

            // Validate Password strength
            $uppercase = preg_match('@[A-Z]@', $_POST['new_pass1']);
            $lowercase = preg_match('@[a-z]@', $_POST['new_pass1']);
            $number    = preg_match('@[0-9]@', $_POST['new_pass1']);
            if( !$uppercase || !$lowercase || !$number || strlen($_POST['new_pass1']) < 8 ) {
              $error .= "<h5 class='text-danger'> ERROR: Password should be over 8 chars with a Uppercase, Lowercase & Number.</h5>";
            }

            if ($error != "") {
              echo "<div>" . $error . "</div>";
              echo "<h6>Go Back and Click the password reset link again to try again.</h6>";
            } else {
              $newpass = md5($pass1);

              //set new pass
              $update_sql = "UPDATE `users` SET `password`='$newpass' WHERE `email`='$email' ";
              $main_que = mysqli_prepare($conn, $update_sql);
              if ($main_que) {
                mysqli_stmt_execute($main_que);
                echo '<h5 class="text-success">Password Updated! </h5>';
                echo '<h6>Your password has been updated successfully. You can Login now! </h6>';
                //delete password reset rows
                $delete_sql = "DELETE FROM `users_resetpass` WHERE `email`='$email' ";
                $other_que = mysqli_prepare($conn, $delete_sql);
                if ($other_que) {
                  mysqli_stmt_execute($other_que);
                  echo '<h6>All password reset links are now invalidated.</h6>';
                }
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
