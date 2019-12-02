<?php
	try
 {

  $bdd = new PDO ('mysql:host=localhost;dbname=GSB', 'root', '');

 }

 catch(Exception $e)
 {
  die('Erreur :'.$e->getMessage());
 }


if(!$bdd){
	exit("Echec de la connection");
}
 	else
	{
	
} 	
	
?>