<?php 
// ce fichier va servir à regrouper tous ce qui est relié à la bdd

require_once("include/config.php");
try{
	$db = new PDO("mysql:host=".$host.";dbname=".$dbname, $userBdd, $passBdd); // dsn, user, pass
	//LIMIT permet de limiter le nombre de résultats de la requête 
	// 0, 2 permet de dire "je veux 2 résultats à partir du premier résultat"
	// 10, 10 permet de dire "Je veux 10 résultats à partir du onzième"
	
} catch (Exception $exception){
	$messageError = $exception->getMessage();
}