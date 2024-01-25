<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

  

$imageFile='assets/images/gd/foto1.jpg';
$image=imagecreatefromjpeg($imageFile);
header('Content-type :image/jpeg');

imagejpeg($image);
imagedestroy($image);
//echo "ola GD";

?>