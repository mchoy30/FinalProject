<?php 

session_start();


//$_SESSION['Captcha'] = $Captcha;

$img = imagecreatetruecolor(120, 40);
$white = imagecolorallocate($img, 255, 255, 255);
$grey = imagecolorallocate($img, 150, 150, 135);
$black = imagecolorallocate($img, 0, 0, 0);
$red = imagecolorallocate($img, 255, 0, 0);
$pink = imagecolorallocate($img, 200, 0, 150);
$font = "arial.ttf";

$Captcha = generateRandomString(rand(4,6));

imagefill($img, 0, 0, $black);
imagettftext($img, 15, 3, 15, 25, $red, $font, $Captcha);
imagettftext($img, 14.5, 1.8, 14.4, 23, $white, $font, $Captcha);

header("Content-type: image/png");

imagepng($img);


imagedestroy($img);

$_SESSION['Captcha'] = $Captcha;

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


	
 ?>