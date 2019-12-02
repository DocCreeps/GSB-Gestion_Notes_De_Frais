<?php
session_start();
include_once('connectbdd.php');
$_SESSION['montant'] = 0; 
?>

 

<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <title>Connexion GSB</title>
  <link rel="stylesheet" href="mycss.css">
 
 
 </head>
<body>
 

 <section></br></br>

 <article>
 <!--formulaire d'inscription-->
 <img src="gsb.jpg" alt="logo gsb" title="logo gsb"></img>
  <form name="connexion" method="post" action="connection.php">
 
 <label for="id"> Entrez votre Identifiant: </label></br>
 <input type="text" name="id" placeholder="Identifiant"/></br></br>
  <label for="password"> Entrez votre Mot de passe: </label></br>
 <input type="password" name="mdp" placeholder="Mot de passe"/></br></br>
 
 
<!--bouton de connexion et efface le formulaire-->
 <input type="submit" id="connect" value="Connecter" name="Connect"></br></form>
 </article>
 </section>

 
 

 
 
 
</body>
</html>
 <?php
if(isset($_POST['id'])){
$nom = $_POST['id'];


$requete = 'SELECT * FROM visiteur WHERE login LIKE "'.$nom.'"';
$reponse = $bdd->query($requete);


while ($donnees = $reponse->fetch())
{
	if($nom == $donnees['login'] &&  $_POST['mdp'] ==$donnees['mdp'])
		{
			echo "connection reussi";
			$_SESSION['Utilisateur'] = $_POST['id'];
			
			header('Location: accueil.php');
		}
	else
		{
			echo 'Identifiant ou Mot De Passe incorrecte';
			header('Location: connection.php');
		}

}
}
 ?>