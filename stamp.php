<?php

if (!isset($_FILES['userfile']))
    exit('Image not upload');

if ($_FILES['userfile']['error'] > 0)
    exit('Image not found');

$stamp = imagecreatefromjpeg('logo.jpg');

if ($_FILES['userfile']['type'] == "image/png")
    $image = imagecreatefrompng($_FILES['userfile']['tmp_name']);
else if ($_FILES['userfile']['type'] == "image/jpeg")
    $image = imagecreatefromjpeg($_FILES['userfile']['tmp_name']);

$image_w = imagesx($image);
$image_h = imagesy($image);
if ($image_w <= $image_h)
    $new_stamp_w = $image_w / 4;
else
    $new_stamp_w = $image_h / 4;

$new_stamp = imagescale($stamp, $new_stamp_w);
imagecopymerge($image, $new_stamp, 0, $image_h - $new_stamp_w, 0, 0, $new_stamp_w, $new_stamp_w, 50);

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
imagedestroy($stamp);