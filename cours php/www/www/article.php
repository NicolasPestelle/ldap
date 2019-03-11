<?php
	include('includes/connexion.inc.php');
	include('includes/header.inc.php');
	
	if(isset($_POST['titre'])){
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$titre = mysql_real_escape_string($_POST['titre']);
			$contenu = mysql_real_escape_string($_POST['contenu']);
			$sql = mysql_query("UPDATE articles SET titre='$titre', contenu='$contenu' WHERE id=$id");
			
			mysql_query($sql);
			header("Location:index.php");
		}else{
			$titre = mysql_real_escape_string($_POST['titre']);
			$contenu = mysql_real_escape_string($_POST['contenu']);
			date_default_timezone_set('UTC');
			$date = date("Y-m-d");
			$insert = mysql_query("INSERT INTO articles(titre, contenu, date) VALUES('$titre', '$contenu', '$date');");
			
			mysql_query($insert);
			echo "<div class='alert alert-success'>
					<strong>L'article a été envoyé avec succès.</strong> 
				</div>";
			header("Location:index.php");
		}
	}else{
		$titre = "";
		$contenu = "";
		if(isset($_GET['id'])){
			$id = (int) $_GET['id'];
			$res = mysql_query("SELECT * FROM articles WHERE id=$id;");
			$data= mysql_fetch_array($res);
			$titre = $data['titre'];
			$contenu = $data['contenu'];
		}
	}
?>

	<form action="article.php" method="post">
		<?php if(isset($_GET['id'])){ echo "<input type='hidden' name='id' value=$id>";}?>
		<div class="clearfix">
			<label for="titre">Titre:</label>
			<input id="titre" name="titre" size="255" type="text" value="<?php echo $titre;?>">
		</div>
		<div class="clearfix">
			<label for="contenu">Contenu:</label>
			<textarea id="contenu" name="contenu" cols="60" rows="20"><?php echo $contenu;?></textarea></div>
		<input class="btn btn-primary" id="envoi" type="submit" value="Enregistrer">
	</form>
		

<?php
	include('includes/footer.inc.php');
?>