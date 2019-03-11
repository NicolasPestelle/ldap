<?php

try{
	$bdd = new PDO('mysql:host=localhost;dbname=vinyle;charset=utf8', 'root', 'root');
}
catch{
	die('Erreur : '.$e->getMessage());
}

?>
