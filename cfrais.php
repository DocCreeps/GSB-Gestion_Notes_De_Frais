<?php
session_start();
include_once('connectbdd.php');
$fonction =$_SESSION['Ufonction'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Fiche frais GSB</title>
  <link rel="stylesheet" href="cssaccueil.css">
 
 
 </head>
<body>
<header> 
<ul>
<li><a href="Accueil.php">Accueil</a>
<li><a href="hfrais.php">Renseignez note des hors frais</a>
<li><a href="rfrais.php">Renseignez note de frais</a>
<li><a href="vfrais.php">Consultez note de frais</a>
<li><a class="active" href="cfrais.php">Validation note de frais</a>
<li style="float:right;"><a href="connection.php?deco">Déconnection</a></li>
</ul>
 <img src="gsb.jpg" alt="logo gsb" title="logo gsb"></img>
 <h3><b>Validation des notes de frais pour : </b></h3>
</header><section><article>
<?php
if($fonction!='Comptable'){
	header("Location: accueil.php");
}

?>
<form name="afficheFrais" method="post" action="cfrais.php"> 
	<select id='idclient' name='idclient'><?php
$client =" SELECT id,nom,prenom FROM visiteur";
$rep= $bdd->query($client); 
while ($lclients = $rep->fetch())
{
    echo  "<option value=".$lclients['id'].">".$lclients['nom'].", ".$lclients['prenom']."</option>";

}
?>

 
</select></br></br><input class="button" type="submit" id="Selectionner " value="Selectionner" name="Selectionner"></br></br>
<?php
if(isset($_POST['Selectionner'])){
	$idc=$_POST['idclient'];
  
  $recupnotefrais = " SELECT mois,montantValide, idEtat FROM fichefrais WHERE idVisiteur = '".$idc."' ";
$reponse= $bdd->query($recupnotefrais); 
?>
<fieldset> <legend><b>Ses notes de frais</b></legend>
<table>
	<thead><tr>
  <th>MOIS </th>
  <th>MONTANT </th>
  <th>ETATS </th>
</tr></thead>
<tbody>
<?php
while ($donnees = $reponse->fetch())
{
    echo "<tr><td>".$donnees['mois']."</td> <td>".$donnees['montantValide']."</td> <td>".$donnees['idEtat']." </td>";

    }


}

?>
</tbody>
</table>
</fieldset>
<?php 
if(isset($_POST['Selectionner'])){
	$ide=$_POST['idclient'];
  $_SESSION['Idc']=$ide;
$recupnotefrais = " SELECT mois FROM fichefrais WHERE idVisiteur = '".$ide."' ";
$reponse= $bdd->query($recupnotefrais); 
?>
<form name="afficheFraisc" method="post" action="vfrais.php">
<fieldset> <legend><b>Ses notes de frais détailler</b></legend>
<select id='idmois' name='idmois'>
<?php

while ($donnees = $reponse->fetch())
{
    echo  "<option value=".$donnees['mois'].">".$donnees['mois']."</option>";



}

?></select></br></br>
<input class="button" type="submit" id="Affiche" value="Affiche" name="Affiche">
</fieldset>
<?php }?>

<?php
 //affiche le detaille des frais hors forfait
if(isset($_POST['Affiche'])){
  $ide=$_SESSION['Idc'];
	$mois= $_POST['idmois'];
  $id = $_POST['idclient'];
	$affichehf = "SELECT libelle, date, montant FROM lignefraishorsforfait WHERE mois = '".$mois."' AND idVisiteur= '".$ide."'";
	$hfaf= $bdd->query($affichehf);?><fieldset> <legend>FRAIS HORS FORFAIT</legend><table>
	<thead><tr>
  <th>LIBELLE </th>
  <th>DATE </th>
  <th>MONTANT </th>
</tr></thead>
<tbody><?php
while ($donnees = $hfaf->fetch())
{
    
 echo "<tr><td>".$donnees['libelle']."</td> <td>".$donnees['date']."</td> <td>".$donnees['montant']." </td>";




}


}



?></tbody></table></fieldset>

<?php //affiche le detaille des frais forfait
if(isset($_POST['Affiche'])){
  $ide=$_SESSION['Idc'];
	$mois= $_POST['idmois'];
 $id = $_POST['idclient'];
	$affichef = "SELECT idFraisForfait, quantite FROM lignefraisforfait WHERE mois = '".$mois."' AND idVisiteur= '".$ide."'";
	$faf= $bdd->query($affichef);?><fieldset> <legend>FRAIS FORFAIT</legend><table>
	<thead><tr>
  <th>IdFrais </th>
  <th>Quantité </th>
   </tr></thead>
<tbody><?php
while ($donnees = $faf->fetch())
{
    
 echo "<tr><td>".$donnees['idFraisForfait']."</td> <td>".$donnees['quantite']."</td>";



}


}


?></tbody></table></fieldset>


</select></br></br>







</form>
</form>
</body>
</html>