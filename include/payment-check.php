<?php
include_once("backend/inc/connection.php");

//response string
print_r($_REQUEST);

$user_id    = $_REQUEST['user_id'];
$payment_id = $_REQUEST['payment_id'];
$id         = $_REQUEST['id'];

$date   = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$date11 = $date->format('Y-m-d');

$result123 = "SELECT * FROM payments WHERE user_id='$user_id'";
$resyy     = mysqli_query($con,$result123);

if($resss=mysqli_fetch_assoc($resyy)) {

	$diff   = abs(strtotime($date11) - strtotime($resss['date']));
	$years  = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	$age    = $months*30 + $days;
	if($age > 90)	{
		$sqlll = "UPDATE payments SET date='$date11' WHERE `user_id`='$user_id' ";
		$res34 = mysqli_query($con,$sqlll);
	}

} else {

  $sql    = "INSERT INTO payments(`user_id`,`job_id`,`payment_id`,`day`,`date`)VALUES('$user_id','$id','$payment_id','90','$date11')";
  $result = mysqli_query($con,$sql);

}
