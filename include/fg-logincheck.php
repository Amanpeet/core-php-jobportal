<?php
include_once("backend/inc/connection.php");
// include_once($_SERVER['DOCUMENT_ROOT']."/backend/inc/connection.php");

session_start();
$login_email  = $_SESSION['user_email'];
$login_name   = $_SESSION['user_fullname'];
$login_user   = $_SESSION['user_username'];
$login_role   = $_SESSION['user_role'];
$login_status = $_SESSION['user_status'];

if(!isset($login_email)) {
	// echo "redirecting to login from logincheck";
	header("Location: login.php");
  echo '<script>window.location="login.php";</script>';
}
//roles true functions
$employer = ($login_role == 'employer') ? true : false;
$user = ($login_role == 'user') ? true : false;
//user log function
function userlog(){
  // $action, $victim, $details
  extract(func_get_args(), EXTR_PREFIX_ALL, "args"); //dynamic parameters
  $action  = $args_0;
  $details = isset($args_1) ? $args_1 : '';
  $victim  = isset($args_2) ? $args_2 : '';
  if( empty($action) ){
    return false; //end here
  }
  if( empty($details) ){
    $details = '';
  }
  if( empty($victim) ){
    $victim = '';
  }
  global $conn, $login_user, $login_role;
  $insert_sql = "INSERT INTO userlog(`user_name`, `user_role`, `action_term`, `action_on`, `action_details`) VALUES( '$login_user', '$login_role', '$action', '$victim', '$details' ) ";
  $quer = mysqli_query($conn, $insert_sql);
  if($quer){
    return true;
  } else {
    return false;
  }
}
// userlog('img_reject', "Rejecting image with id: $login_role"); //example
