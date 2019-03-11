<?php
	setcookie("connexion","$sid",-3600);
	header('Location: index.php');
?>