<?php
	include('connexion.inc.php');
	
	if(isset($_COOKIE['connexion'])&&!empty($_COOKIE['connexion'])){
		$cookie = htmlentities($_COOKIE['connexion']);
		$verif = mysql_query("SELECT sid FROM utilisateurs WHERE sid ='$cookie';");
		$bdd = mysql_fetch_array($verif);
		if($bdd){
			$connect = true;
			$getEmail = mysql_query("SELECT email FROM utilisateurs WHERE sid = '$cookie';");
			$email_util = mysql_fetch_array($getEmail);
			echo "<div class='alert alert-success'>
					<strong>".utf8_encode('Vous �tes connect� sur le compte ').$email_util['email']." ".utf8_encode("<a href='deconnexion.php'>D�connexion</a>")."</strong> 
				</div>";
		}else{
			$connect = false;
		}
	}else{
		$connect = false;
	}
?>