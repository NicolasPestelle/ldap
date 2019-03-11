<?php
	include('includes/connexion.inc.php');
	
	if(isset($_GET['id'])){
		$delId = $_GET['id'];
		$delete = mysql_query("DELETE FROM articles WHERE id = $delId;");
		mysql_query($delete);
		
		$verif = mysql_query("SELECT * FROM articles WHERE id = $delId;");
		if(mysql_query($verif)==false){
			header("Location:index.php");
		}
	}
?>