<?php
	include('includes/connexion.inc.php');
	include('includes/header.inc.php');
?>

	<form action="connexion.php" method="post">
		<div class="clearfix">
			<label for="email">E-Mail</label>
			<input type="email" name="email" id="email">
		</div>
		<div class="clearfix">
			<label for="password">Mot de passe</label>
			<input type="password" id="password" name="mdp">
		</div>
		<input class="btn btn-primary" id="connexion" type="submit" value="Connecter">
	</form>
	
<?php
	if(isset($_POST['email'])){
		$email = mysql_real_escape_string($_POST['email']);
		$mdp = mysql_real_escape_string(md5($_POST['mdp']));
		
		$connexion = mysql_query("SELECT email, mdp FROM utilisateurs WHERE email = '$email' AND mdp = '$mdp';");
		if(mysql_num_rows($connexion) == 1){
			$sid = md5($email.time());
			$update = mysql_query("UPDATE utilisateurs SET sid='$sid' WHERE email= '$email';");
			setcookie("connexion","$sid",time()+300);
		}else{
			echo "Fail";
		}
	}

	include('includes/footer.inc.php');
?>