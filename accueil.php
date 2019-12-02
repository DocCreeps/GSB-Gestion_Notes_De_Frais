<?php
session_start();
include_once('connectbdd.php');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Accueil GSB</title>
  <link rel="stylesheet" href="cssaccueil.css">
 
 
 </head>
<body>
<header> 
 <ul>
<li><a class="active" href="Accueil.php">Accueil</a>
<li><a href="hfrais.php">Renseignez note des hors frais</a>
<li><a href="rfrais.php">Renseignez note de frais</a>
<li><a href="vfrais.php">Consultez note de frais</a>
	<li><a href="cfrais.php">Validation note de frais</a>
<li style="float:right;"><a href="connection.php?deco">Déconnection</a></li>
</ul>
</header>

<section><artticle>

<img src="gsb.jpg" alt="logo gsb" title="logo gsb"></img>
 <h3><b>Bienvenue sur GSB  </b></h3>
<?php
$requete = 'SELECT id, nom,prenom,Fonction FROM visiteur WHERE login LIKE "'.$_SESSION['Utilisateur'].'"';
$reponse = $bdd->query($requete);
while ($donnees = $reponse->fetch())
{
	$_SESSION['Uid']= $donnees['id'];
$_SESSION['Unom'] = $donnees['nom'];

$_SESSION['Uprenom'] = $donnees['prenom'];
$_SESSION['Ufonction']=$donnees['Fonction'];
$_SESSION['montant']= 0;
}

echo "Bonjour ", $_SESSION['Uprenom'];
echo " ", $_SESSION['Unom'];
?>
 <?php
setlocale(LC_TIME,"fr_FR.UTF-8","fra");
echo strftime("</br></br> Nous sommes le %A %d %B %Y.", $_SERVER['REQUEST_TIME']);
if (strftime('%d')>'20'){
	$jours= strftime('%d')-20;
	echo "</br></br> <b>Vous ne pouvez pas renseigner vos fiches de frais la date limite est passé de $jours jours. </b>";}

	if($_SESSION['Ufonction']!='Comptable'){
	echo "</br></br> <b>Vous n'êtes pas comptable, vous n'avez donc pas accès à la page validation note de frais. </b>";
}

$id = $_SESSION['Uid'];
 $secteur = "Select IdSecteur From couvre Where idVisiteur Like '".$id."'";
 var_dump($secteur);
 $reponse = $bdd->query($secteur);
while ($donnees = $reponse->fetch())
{
	echo" ".$donnees['IdSecteur'].""; 
}

 ?>

</article></section>



</body>
</html>