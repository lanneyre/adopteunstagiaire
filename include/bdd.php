<?php 
// ce fichier va servir à regrouper tous ce qui est relié à la bdd

require_once("include/config.php");
try{
	$db = new PDO("mysql:host=".$host.";dbname=".$dbname, $userBdd, $passBdd); // dsn, user, pass	
} catch (Exception $exception){
	$messageError = $exception->getMessage();
}