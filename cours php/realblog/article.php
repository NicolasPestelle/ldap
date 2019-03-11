<?php
include('includes/connexion.inc.php');
include('includes/header.inc.php');
include('includes/verif_util.inc.php');

if($connect != true){
	header('Location:index.php');
}
/*pour changer l'emplacement d'une image : move_uploaded_file($chemin_source, $chemin_destination (cf dirname(__FILE__).'/chemin/fichier.ext')*/
/*php ini : upload_max_filesize = 2M(par défaut)*/
if(isset($_POST['titre'])){
	
	/*TRAITEMENTS*/
	if(isset($_POST['id'])){ // si id existe alors on modifie
		$title = mysql_real_escape_string ($_POST['titre']);
		$cont = mysql_real_escape_string ($_POST['texte']);
		$id =(int) $_POST['id'];
		$req = mysql_query("UPDATE articles SET titre='$title', contenu='$cont' WHERE id='$id';");
		$imgid = $id;
		mysql_query($req);
		header('Location:index.php');
		
	}else{ //sinon on ajoute
		$titre = mysql_real_escape_string ($_POST['titre']);
		$contenu = mysql_real_escape_string ($_POST['texte']);
		$date = time();
		mysql_query("INSERT INTO articles(titre, contenu, date) VALUES('$titre','$contenu', '$date');");
		$imgid = mysql_insert_id();
		echo"<div class='alert alert-success'>
		<strong>Success!</strong>
		</div>";
		header('Location:index.php');
	}
	
	/*ajout d'image*/
	if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name'])){
		$verif = explode("/", $_FILES['image']['type']);
		if($verif[1] == "jpeg"){
			//recup l'id de l'article, le mettre a la fin de dirname astuce : mysql_insert_id()
			$dest = dirname(__FILE__)."/data/images/$imgid.jpg";
			$src = $_FILES['image']['tmp_name'];
			move_uploaded_file($src,$dest);
		}
	}
	
}else{
	/*FORMULAIRE*/
	$title="";
	$cont="";
	if(isset($_GET['id'])){
		$id=(int)$_GET['id'];
		$res = mysql_query("SELECT * FROM articles WHERE id=$id");
		$data = mysql_fetch_array($res);
		$title=mysql_real_escape_string ($data['titre']);
		$cont=mysql_real_escape_string ($data['contenu']);
	}

?>
	 <!--div = style bootstrap-->
<form action='article.php' method='post' enctype="multipart/form-data">
	<div class='clearfix'>
		<label for='titre' >Titre</label>
		<div class='input'><input type='text' name='titre' id='titre' value="<?php echo $title?>"></div>
	</div>
	<div class='clearfix'>
		<label for='texte'>Texte</label>
		<div class='input'><textarea name='texte' id='texte'><?php echo $cont?></textarea></div>
	</div>
	<input type ="file" name ="image">
	<input type='submit' value='Enregistrer' class ='btn btn-primary'>
	<?php if(isset($_GET['id'])){ echo"<input type='hidden' name='id' value='$id'> ";}?>
</form>

<?php
/* RAPPEL COUR */
	//var_dump($_POST);
	// form ternaire : $var = condition ? sivrai : sifaux;
	//= if(condition) $var = sivrais; else $var = sifaux;
	
	//extract($data)=> $foo = $data['foo']  $bar = $data['bar']  faire attention doublon = écrasement de variables
}
	
include('includes/footer.inc.php');
?>