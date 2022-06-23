<?php
session_start();
include_once("../backend/inc/connection.php");
// include_once($_SERVER['DOCUMENT_ROOT']."/backend/inc/connection.php");

$error = "";
if(isset($_POST["loginhit"])) {

  if(empty($_POST["user_email"]) || empty($_POST["user_password"])) {
    $error = "Both fields are required.";
  } else  {
    $username = $_POST['user_email'];
    $password = $_POST['user_password'];

    // To protect from MySQL injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $password = md5($password);

    $sql = "";
    // check if its username or email
    if(filter_var( $username, FILTER_VALIDATE_EMAIL) ) { //if its a valid email
      $sql = "SELECT * FROM users WHERE `email`='$username' AND `password`='$password'";
    } else { //otherwise username
      $sql = "SELECT * FROM users WHERE `username`='$username' AND `password`='$password'";
    }

    // Check with database
    // $sql = "SELECT * FROM users WHERE `email`='$username' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // echo $row['username'];
    // If exist in our database then create session else echo error.
    if(mysqli_num_rows($result) == 1) {
      // Initializing Session
      $_SESSION['user_email']    = $row['email'];
      $_SESSION['user_username'] = $row['username'];
      $_SESSION['user_fullname'] = $row['fullname'];
      $_SESSION['user_role']     = $row['role'];
      $_SESSION['user_status']   = $row['status'];

      if( $row['status'] == 'active' ){ //check account is active
        header("location: ../dashboard.php"); // Redirect
        // echo '<script>window.location="../index.php";</script>';
        $insert_sql = "INSERT INTO userlog(`user_name`, `user_role`, `action_term`, `action_details`) VALUES( '".$row['username']."', '".$row['role']."', 'login', 'Front End User logged in using login page' ) ";
        $quer = @mysqli_query($conn, $insert_sql); //for userlog
      } else {
        $error = "Your Account is pending Activation.";
        header("location: ../login.php?error=".$error); // Redirect
        // echo '<script>window.location="../user-login.php";</script>';
      }

    } else {
      $error = "Incorrect Username/Email and Password.";
      header("location: ../login.php?error=".$error); // Redirect
      // echo '<script>window.location="../user-login.php";</script>';
    }
  }
} else {
  // echo "Bad request";
}
