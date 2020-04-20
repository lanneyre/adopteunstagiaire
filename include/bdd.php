<?php 
// ce fichier va servir à regrouper tous ce qui est relié à la bdd

require_once("include/config.php");
require_once("class/Autoloader.php");
Autoloader::register();

try{
	$db = new PDO("mysql:host=".$host.";dbname=".$dbname, $userBdd, $passBdd); // dsn, user, pass	
	//$GLOBALS['db'] = $db;
} catch (Exception $exception){
	$messageError = $exception->getMessage();
}



