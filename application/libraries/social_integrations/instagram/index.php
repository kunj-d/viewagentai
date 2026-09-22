<?php
error_reporting(0);
require 'src/Instagram.php';

/////// CONFIG ///////
$username = 'imraj.insta11';
$password = 'Imraj@123';
$debug = FALSE;

$username_id='e6664a2ec8d643e59427af88bdffd5e0';
$token='37195be56a8f40c4b0f7ec27dfc16e7d';
$upload = 'upload/images.jpg';     // path to the photo
$caption = 'new one message here';     // caption

#resize image
$img = file_get_contents($upload);
$im = imagecreatefromstring($img);
$width = imagesx($im);
$height = imagesy($im);
$newwidth = '640';
$newheight = '640';
$thumb = imagecreatetruecolor($newwidth, $newheight);
imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
imagejpeg($thumb, 'myChosenName.jpg'); //save image as jpg
#end

#simple login object
$i = new Instagram($username, $password,$username_id,$token,$debug);
//echo '<pre>';var_dump($i);die;
try {
    $i->login();
} catch (InstagramException $e) {
    $e->getMessage();  
}

#simple upload
try {
    $i->uploadPhoto('myChosenName.jpg', $caption);
} catch (Exception $e) {
    echo $e->getMessage();
}
   


