<?php
session_start();
include("connection.php");

$error = "";
if(isset($_POST["submit"])) {

  if(empty($_POST["username"]) || empty($_POST["password"])) {
    $error = "Both fields are required.";
  } else  {
    $username=$_POST['username'];
    $password=$_POST['password'];

    // To protect from MySQL injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $password = md5($password);

    //Check username and password from database
    // $sql = "SELECT * FROM admins WHERE `username`='$username' AND `password`='$password' ";
    $sql = "SELECT `username`, `role` FROM admins WHERE `username`='$username' AND `password`='$password' UNION SELECT `username`, `role` FROM users WHERE `username`='$username' AND `password`='$password' LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    // echo $row['username'];
    //If exist in our database then create session else echo error.
    if(mysqli_num_rows($result) == 1) {
      if( $row['role'] == 'admin' || $row['role'] == 'editor' || $row['role'] == 'user' ){
        $_SESSION['username'] = $row['username']; // Initializing Session
        $_SESSION['role'] = $row['role']; // Initializing Session

        $insert_sql = "INSERT INTO userlog(`user_name`, `user_role`, `action_term`, `action_details`) VALUES( '".$row['username']."', '".$row['role']."', 'login', 'user logged in using login panel' ) ";
        $quer = @mysqli_query($conn, $insert_sql); //for userlog

        header("location: dashboard.php"); // Redirect
      } else {
        $error = "Your account is pending approval.";
      }
    } else {
      $error = "Incorrect username or password.";
    }
  }
} else {
  // echo "Bad request";
}

?>