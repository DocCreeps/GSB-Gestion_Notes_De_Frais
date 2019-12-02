<?php
session_start();
include_once('connectbdd.php');
$nom=$_SESSION['Unom'];
$prenom=$_SESSION['Uprenom'];
$id = $_SESSION['Uid'];
$test = $_SESSION['montant'];
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
<li><a class="active" href="vfrais.php">Consultez note de frais</a>
<li><a href="cfrais.php">Validation note de frais</a>
<li style="float:right;"><a href="connection.php?deco">Déconnection</a></li>
</ul>
 <img src="gsb.jpg" alt="logo gsb" title="logo gsb"></img>
</header><section><article>

<?php
$annee = strftime('%Y');
$recupnotefrais = " SELECT mois,montantValide, idEtat FROM fichefrais WHERE idVisiteur = '".$id."' ";
$reponse= $bdd->query($recupnotefrais); 
?>
<form name="afficheFraisc" method="post" action="vfrais.php">
<fieldset> <legend><b>Vos notes de frais</b></legend>
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
    echo "<tr><td>".$donnees['mois']."</td><td>".$donnees['montantValide']."</td> <td>".$donnees['idEtat']." </td>";

}
?>
</tbody>
</table>
</fieldset><?php
$recupnotefrais = " SELECT mois FROM fichefrais WHERE idVisiteur = '".$id."' ";
$reponse= $bdd->query($recupnotefrais); 
?>
<form name="afficheFraisc" method="post" action="vfrais.php">
<fieldset> <legend><b>Vos notes de frais détailler</b></legend>
<select id='idmois' name='idmois'>
<?php

while ($donnees = $reponse->fetch())
{
    echo  "<option value=".$donnees['mois'].">".$donnees['mois']."</option>";



}
?></select></br></br>
<input class="button" type="submit" id="Affiche" value="Affiche" name="Affiche">
</fieldset>
<?php //affiche le detaille des frais hors forfait
if(isset($_POST['Affiche'])){
	$mois= $_POST['idmois'];
	$affichehf = "SELECT libelle, date, montant FROM lignefraishorsforfait WHERE mois = '".$mois."' AND idVisiteur= '".$id."' ";
	$hfaf= $bdd->query($affichehf);?>
<fieldset> <legend>FRAIS HORS FORFAIT</legend>
	<table>
	<thead><tr>
  <th>LIBELLE </th>
  <th>DATE </th>
  <th>MONTANT </th>
</tr></thead>
<tbody><?php
while ($donnees = $hfaf->fetch())
{
    
 echo "<tr><td>".$donnees['libelle']."</td> <td>".$donnees['date']."</td> <td>".$donnees['montant']." </td></tr>";




}


}

?></tbody></table></fieldset>
<?php //affiche le detaille des frais forfait
if(isset($_POST['Affiche'])){
	$mois= $_POST['idmois'];
	$affichef = "SELECT idFraisForfait, quantite FROM lignefraisforfait WHERE mois = '".$mois."' AND idVisiteur= '".$id."'";
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

</form>

<?php //affiche le detaille des frais forfait annuel

  $affichesuma= "SELECT idFraisForfait, Sum(quantite) As Quantiteannuel FROM lignefraisforfait WHERE Annee = '".$annee."' AND idVisiteur= '".$id."' GROUP BY idFraisForfait";
  $suma= $bdd->query($affichesuma);?><fieldset> <legend>FRAIS FORFAIT Annuel </legend><table>
  <thead><tr>
  <th>IdFrais </th>
  <th>Quantité total</th>
  <th>Montant</th>
   </tr></thead>
<tbody><?php
while ($donnees = $suma->fetch())
{
    
 echo "<tr><td>".$donnees['idFraisForfait']."</td> <td>".$donnees['Quantiteannuel']."</td>  ";

if($donnees['idFraisForfait'] =='ETP'){
  $etpannu=$donnees['Quantiteannuel']*110;
  echo "<td>".$etpannu."</td>";
}
if($donnees['idFraisForfait'] =='NUI'){
  $nuiannu=$donnees['Quantiteannuel']*80;
  echo "<td>".$nuiannu."</td>";
}
if($donnees['idFraisForfait'] =='REP'){
  $repannu=$donnees['Quantiteannuel']*29;
  echo "<td>".$repannu."</td>";
}
if($donnees['idFraisForfait'] =='KM'){
  $kmannu=$donnees['Quantiteannuel']*0.62;
  echo "<td>".$kmannu."</td>";
}


}





?></tbody></table></fieldset>



</body>
</html>