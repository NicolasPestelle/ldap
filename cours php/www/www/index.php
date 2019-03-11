<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');
include('includes/header.inc.php');

$res = mysql_query("SELECT * FROM articles;");
date_default_timezone_set('UTC');
//$data = mysql_fetch_array($res);

while($data = mysql_fetch_array($res)){
	$id = $data['id'];
	echo '<h3>'.utf8_encode($data['titre']).'</h3>';
	echo '<h5> Posté le '.$data['date'].'</h5>';
	echo '<p>'.nl2br(htmlspecialchars($data['contenu'])).'</p>';
	echo "<a class='btn btn-primary' href='article.php?id=$id'>Modifier</a> ";
	echo "<a class='btn btn-danger' href='supprimer_article.php?id=$id'>Supprimer</a>";
}
include('includes/footer.inc.php');
?>