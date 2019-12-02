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
<li><a class="active" href="rfrais.php">Renseignez note de frais</a>
<li><a href="vfrais.php">Consultez note de frais</a>
  <li><a href="cfrais.php">Validation note de frais</a>
<li style="float:right;"><a href="connection.php?deco">Déconnection</a></li>
</ul>
 <img src="gsb.jpg" alt="logo gsb" title="logo gsb"></img>

</header><section><article>
	<h4>Saisie fiche de frais pour le mois de <?php 
setlocale(LC_TIME,"fr_FR.UTF-8","fra");
$mois = strftime('%B');

//recup année courante 
$annee = strftime('%Y');
echo "$mois $annee";


//aprés le 20 de chaque moi impossible de rentrer des frais 
if (strftime('%d')>'20'){
  header("Location: accueil.php");
}

	?></h4>
		 <form name="Frais" method="post" action="rfrais.php"></br>
 
 <label for="Dated"> Saisie des frais pour la date du </label>
 <input type="date" name="Dated" placeholder="jj/mm/aaaa" id="Dated"/>
  <label for="Datef"> au </label>
  <input type="date" name="Datef" placeholder="jj/mm/aaaa"  id="Datef"/>
 
 
</br></br>
	</article></section>
	<section><article>
<fieldset> <legend>VISITEUR</legend>
	 
 <label for="nom"> Nom </label>
<?php print "<input type='text' name='nom' value='".$nom."' />" ?>
  <label for="Prenom"> Prénom </label>
<?php print "<input type='text' name='Prenom' value='".$prenom."' />" ?>
   <label for="Matricule"> Matricule </label>
 <?php print "<input type='text' name='Matricule' value='".$id."' />" ?>
  </br>
 </fieldset></br>
 </article></section>
 	<section><article>

<fieldset> <legend>FRAIS FORFAITAIRES</legend>
	
	<table> 
 	<thead><tr>
  <th>LIBELLE </th>
  <th>QUANTITE </th>
  <th>MONTANT UNITAIRE </th>
  <th>TOTAL</th></
</tr></thead></br>
<tbody>
  <tr>
  <td><label for="Etape">Etape</label></td>
  <td> <input type="text" name="quantitee" id="quantitee" value="0"/></td>
  <td>110.00€ </td>
  <td><input type="text" name="Totale" id="Totale" value="0" /> €  </td>
</tr>
<tr>
  <td><label for="Nuitée">Nuitée</label></td>
  <td> <input type="text" name="quantiten" id="quantiten" value="0"/></td>
  <td>80.00€ </td>
  <td><input type="text" name="Totaln" id="Totaln" value="0" /> €  </td>
</tr>
<tr>
  <td><label for="repas">Repas midi</label></td>
  <td> <input type="text" name="repas" id="repas" value="0"/> </td>
  <td>29.00€ </td>
  <td><input type="text" name="Totalr" id="Totalr" value="0" />€ </td>
</tr>
<tr>
  <td><label for="Km">Kilomètrage</label></td>
  <td> <input type="text" name="Km" id="Km" value="0"/> </td>
  <td></td>
  <td><input type="text" name="Totalkm" id="Totalkm" value="0" /> € </td>
</tr>
<tr>
  <td> </td>
  <td> </td>
  <td> </td>
  <td><input type="text" name="Total" id="Total" value="0"/> € </td>
</tr>
</tbody>
</table>
<h5>Barême kilométrique(valeur au kilomètre)</h5>
  <input type="radio" id="Km1" name="Kms" value="0,52">
  <label for="Km1">0.52€</label>
   <input type="radio" id="Km2" name="Kms" value="0,58">
  <label for="Km2">0.58€</label>
   <input type="radio" id="Km3" name="Kms" value="0,62" checked="checked" >
  <label for="Km3">0.62€</label>
   <input type="radio" id="Km4" name="Kms" value="0,67">
  <label for="Km4">0.67€</label></br></br>
 <input class="button" type="button" id="calculer" value="calculer" name="calculer" onclick="calctt()">

  </br>
 </fieldset>
 </article></section>
<section><article>


 <script>
function calctt(){
 //calcul montant etapes
  var Totale = document.getElementById("quantitee").value * 110; 
 document.getElementById("Totale").value= Totale;

  //calcul montant nuitée
  var Totaln = document.getElementById("quantiten").value * 80; 
 document.getElementById("Totaln").value= Totaln;
  //calcul montant repas
 var Totalr = document.getElementById("repas").value * 29;
 document.getElementById("Totalr").value = Totalr;


  //calcul montant km
km1 = document.getElementById('Km1').checked; 
km2 = document.getElementById('Km2').checked; 
km3 = document.getElementById('Km3').checked;
km4 = document.getElementById('Km4').checked;

  if (km1==true) {  Totalkm = document.getElementById("Km").value * 0.52; } if (km2==true) { Totalkm = document.getElementById("Km").value * 0.58;} 
  if (km3==true) {  Totalkm = document.getElementById("Km").value * 0.62; } if (km4==true) {  Totalkm = document.getElementById("Km").value * 0.67;}

document.getElementById("Totalkm").value = Totalkm;


  //calcul montant  total 
 var Total =  parseFloat(document.getElementById("Totale").value) + parseFloat(document.getElementById("Totaln").value) +  parseFloat(document.getElementById("Totalr").value) +  parseFloat(document.getElementById("Totalkm").value);

 document.getElementById("Total").value=Total;
} </script>



</article></section></br>

 <input class="button" type="submit" id="Envoyer" value="Envoyer" name="Envoyer">
   <input class="button" type="reset" id="clear" value="Effacer" name="clear">


</form>
<a href="accueil.php"><input class="button" type="submit" id="Retour" value="Retour" name="Retour"></a>

<?php 

 if(isset($_POST['Envoyer'])){

if(isset($_POST['quantitee'])){

  $idFraise = "ETP";
  $quantite= $_POST['quantitee'];
  $montante = $_POST['Totale'];
  $reqAddFraisForfaite=("INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite, Annee) VALUES ('".$id."', '".$mois."', '".$idFraise."', '".$quantite."', '".$annee."')");
    $bdd->query($reqAddFraisForfaite); 
}

if(isset($_POST['quantiten'])){

  $idFraisn = "NUI";
  $quantitn= $_POST['quantiten'];
  $montantn = $_POST['Totaln'];
  $reqAddFraisForfaitn=("INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite,Annee ) VALUES ('".$id."', '".$mois."', '".$idFraisn."', '".$quantitn."','".$annee."')");
    $bdd->query($reqAddFraisForfaitn); 
}
if(isset($_POST['repas'])){

  $idFraisrep = "REP";
  $quantitrep= $_POST['repas'];
  $montantrep = $_POST['Totalr'];
  $reqAddFraisForfaitrep=("INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite, Annee ) VALUES ('".$id."', '".$mois."', '".$idFraisrep."', '".$quantitrep."','".$annee."')");
    $bdd->query($reqAddFraisForfaitrep); 
}
if(isset($_POST['Km'])){

  $idFraiskm = "KM";
  $quantitkm= $_POST['Km'];
  $montantkm = $_POST['Totalkm'];
  $reqAddFraisForfaitkm=("INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite, Annee ) VALUES ('".$id."', '".$mois."', '".$idFraiskm."', '".$quantitkm."','".$annee."')");
    $bdd->query($reqAddFraisForfaitkm); 
}

//recup date 
$datetime= new Datetime();
$date= $datetime->format("Y-m-d");

$montants = $test + $_POST['Total'];

$_SESSION['montant']= $montants;
   

 $sql3="INSERT INTO fichefrais(idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) VALUES('".$id."','".$mois."','0','".$montants."','".$date."','CR')";
$bdd->query($sql3); 


  $upfichefrais="UPDATE fichefrais SET montantValide= '".$montants."' ,dateModif ='".$date."' Where idVisiteur= '".$id."' ";
  $bdd->query($upfichefrais); 

}
?>




</body>

</html>