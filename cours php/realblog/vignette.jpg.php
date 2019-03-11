<?php
include('includes/connexion.inc.php');

header("Content-type: image/jpg");


//chemin image
$imgid =$_GET['id'];
$chem = "data/images/$imgid.jpg";


//calcul ratio et taille image ($l=200)
$var = getimagesize($chem);

$imgLarg = $var[0];
$imgHaut = $var[1];

$maxlarg = 200;
$ratio = $imgLarg/$maxlarg;
$realLarg =(int) $imgLarg/$ratio;
$realHaut =(int) $imgHaut/$ratio;


//création image 

$img = imagecreatetruecolor($realLarg, $realHaut);
$monimg = imagecreatefromjpeg($chem);
imagecopyresampled($img, $monimg, 0, 0, 0, 0, $realLarg, $realHaut, $imgLarg, $imgHaut);

//affichage
imagejpeg($img,null,100);

?>