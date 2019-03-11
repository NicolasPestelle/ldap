<?php
include('includes/connexion.inc.php');

//header("Content-type: image/jpg");


//chemin image
$imgid =$_GET['id'];
$chem = "data/images/$imgid.jpg";
echo $chem;

//calcul ratio et taille image ($l=200)
$var = getimagesize($chem);

$imgLarg = $var[0];
$imgHaut = $var[1];
$maxlarg = 200;
$ratio = $imgLarg/$maxlarg;
$realLarg = $imgLarg/$ratio;
$realHaut = $imgHaut/$ratio;

echo $realHaut;
echo $realLarg;

//ouvrir  img src


//créer img dest


//redim


//rendre img dest


?>