<?php
// session_start();
// if (session_status() == PHP_SESSION_NONE) {
//   session_start();
// }
if(session_id() == '' || !isset($_SESSION)) {
  session_start();
}
$code=rand(1000,9999);
$_SESSION["code"]=$code;
// echo $code;
$im = imagecreatetruecolor(77, 31);
$bg = imagecolorallocate($im, 34, 40, 50); //background color blue
$fg = imagecolorallocate($im, 255, 255, 255);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 20, 5,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);