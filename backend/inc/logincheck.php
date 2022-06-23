<?php
include('connection.php');
session_start();
$user_check=$_SESSION['username'];
// $sql = mysqli_query($conn, "SELECT username FROM admins WHERE username='$user_check' ");
$sql = mysqli_query($conn, "SELECT `username`, `role` FROM admins WHERE username='$user_check' UNION SELECT `username`, `role` FROM users WHERE username='$user_check'");
$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
$login_user = $row['username'];
$login_role = $row['role'];
if(!isset($user_check)) {
	// echo "redirecting to login from logincheck";
	header("Location: login.php");
  echo '<script>window.location="login.php";</script>';
}
//roles true functions
$admin  = ($login_role == 'admin') ? true : false;
$editor = ($login_role == 'editor') ? true : false;
$user   = ($login_role == 'user') ? true : false;
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