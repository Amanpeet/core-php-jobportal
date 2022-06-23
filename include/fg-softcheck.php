<?php
include_once("backend/inc/connection.php");
// include_once($_SERVER['DOCUMENT_ROOT']."/backend/inc/connection.php");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$loggedin = false;
if( isset($_SESSION['user_email']) && !empty($_SESSION['user_email']) ){
  $login_email = $_SESSION['user_email'];
  $login_name  = $_SESSION['user_fullname'];
  $login_user  = $_SESSION['user_username'];
  $login_role  = $_SESSION['user_role'];
  $loggedin = true;
  // echo "logged as: $user_check ($login_role)";
  //roles true functions
  $employer = ($login_role == 'employer') ? true : false;
  $user = ($login_role == 'user') ? true : false;
} else {
  $loggedin = false;
  // echo "not logged in";
}
