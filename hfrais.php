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
  <title>Fiche hors frais GSB</title>
  <link rel="stylesheet" href="cssaccueil.css">

 </head>
<body>
<header> 
<ul>
<li><a href="Accueil.php">Accueil</a>
<li><a class="active" href="hfrais.php">Renseignez note des hors frais</a>
<li><a href="rfrais.php">Renseignez note de frais</a>
<li><a href="vfrais.php">Consultez note de frais</a>
  <li><a href="cfrais.php">Validation note de frais</a>
<li style="float:right;"><a href="Deconnection.php">Déconnection</a></li>
</ul>
 <img src="gsb.jpg" alt="logo gsb" title="logo gsb"></img>

</header><section><article>
  <h4>Saisie fiche hors frais pour le mois de <?php 
setlocale(LC_TIME,"fr_FR.UTF-8","fra");
$mois = strftime('%B');
echo $mois;
//aprés le 20 impossible de rentrer des frais 
if (strftime('%d')>'20'){
  header("Location: accueil.php");
}
  ?></h4>
     <form name="mois" method="post" action="hfrais.php"></br>
 
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
   <?php print "<input type='text' name='Prenom' value='".$id."' />" ?>
  
  </br>
 </fieldset></br>
 </article></section>
  <section><article>

<fieldset> <legend>FRAIS HORS FORFAIT</legend>

  <table> 
  <thead><tr>
  <th>LIBELLE </th>
  <th>MONTANT </th>
 </tr></thead></br>
<tbody>
<tr>
  <td> <input type="text" name="LIBELLE" id="LIBELLE" placeholder="Exemple" /> </td>
  <td><input type="text" name="MONTANT" id="MONTANT" value="0" />€ </td>
</tr>
</tbody>
</table>
  </br>
 </fieldset>
 </article></section></br>



  <input class="button" type="submit" id="Envoyer" value="Envoyer" name="Envoyer">
   <input class="button" type="reset" id="clear" value="Effacer" name="clear">
</form>
 <a href="accueil.php"><input class="button" type="submit" id="Retour" value="Retour" name="Retour"></a>
<?php
 if(isset($_POST['Envoyer'])){
if(isset($_POST['LIBELLE'])){
if(isset($_POST['MONTANT'])){
//recupe type de frais 
 $typeFrais=$_POST['LIBELLE'];


//recup id clients
$Idv=$_SESSION['Uid'];
//recup montant 
$montant = $_POST['MONTANT'];
settype($montant, "float");
//recup date 
$datetime= new Datetime();
$date= $datetime->format("Y-m-d");


//var_dump($Idv,$mois,$typeFrais,$date,$montant


 $sql3="INSERT INTO fichefrais(idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) VALUES('".$Idv."','".$mois."','0','".$montant."','".$date."','CR')";
$bdd->query($sql3); 



 $sql2="INSERT INTO lignefraishorsforfait(idVisiteur,mois,libelle,date,montant) VALUES('".$Idv."','".$mois."','".$typeFrais."','".$date."','".$montant."')";
$bdd->query($sql2); 

  }
  else
  {
    echo"merci de remplir tous les champs";
  }




$montants = $test + $_POST['MONTANT'];

$_SESSION['montant']= $montants;


  $upfichefrais="UPDATE fichefrais SET montantValide= '".$montants."' ,dateModif ='".$date."' ";
  $bdd->query($upfichefrais); 

}
}


?>


</body>
</html>