<?php 

	require_once("include/bdd.php");

	if(empty($_POST)){
		header("Location: index.php?erreur=FormulaireVide");
		exit;
	}

	affiche($_POST);

	// les variables sont vides
	// les variables sont valides
	// les données sont différentes de la base
	// pas de balise html, pas d'espaces, pas de caractères spéciaux, rien qui mette en danger le site
	$error = [];
	
	if(empty($_POST['utilisateur_id'])){
		$error[] = "utilisateurIdInexistant";		
	}
	if(empty($_POST['utilisateur_mail'])){
		$error[] = "utilisateurMailVide";		
	}
	if(!filter_var($_POST['utilisateur_mail'], FILTER_VALIDATE_EMAIL)){
		$error[] = "utilisateurMailMalForme";		
	}
	// pas de vérification nécéssaire pour la présentation : elle peut être null
	/*
	if(preg_match("", $_POST['utilisateur_tel'])){
		$error[] = "utilisateurTelMalForme";
	}
	*/

	// En fonction du type de l'utilisateur je définie quel fichier je dois inclure 
    switch ($_SESSION['userType']) {
      case 'admin':
        # code...
        //$include = "formEditAdmin.php";
      	$reqSql = "SELECT * FROM `utilisateur` AS u JOIN `stagiaire` AS s ON (u.`utilisateur_id` = s.`stagiaire_utilisateur_id`) WHERE u.`utilisateur_id` = :utilisateur_id;";
        break;
      case 'entreprise':
        # code...
        //$include = "formEditEntreprise.php";
      	$reqSql = "SELECT * FROM `utilisateur` AS u JOIN `stagiaire` AS s ON (u.`utilisateur_id` = s.`stagiaire_utilisateur_id`) WHERE u.`utilisateur_id` = :utilisateur_id;";
        break;
      case 'formateur':
        # code...
        //$include = "formEditFormateur.php";
      	$reqSql = "SELECT * FROM `utilisateur` AS u JOIN `stagiaire` AS s ON (u.`utilisateur_id` = s.`stagiaire_utilisateur_id`) WHERE u.`utilisateur_id` = :utilisateur_id;";
        break;
      default:
        # code...
        if(empty($_POST['stagiaire_prenom'])){
			$error[] = "stagiairePrenomVide";		
		}
		if(empty($_POST['stagiaire_nom'])){
			$error[] = "stagiaireNomVide";		
		}
		$reqSql = "SELECT * FROM `utilisateur` AS u JOIN `stagiaire` AS s ON (u.`utilisateur_id` = s.`stagiaire_utilisateur_id`) WHERE u.`utilisateur_id` = :utilisateur_id;";
        break;
    }

	if(sizeof($error)>0){
		header("Location: index.php?editError=".implode("-",$error));
		exit;
	}

	$reqPrepare = $db->prepare($reqSql);
    $reqPrepare->bindValue(":utilisateur_id", $_POST['utilisateur_id']);
    $reqPrepare->execute();

    $utilisateurBdd = $reqPrepare->fetch(PDO::FETCH_OBJ);
    $modif = [];

    foreach ($_POST as $key => $value) {
    	# code...
    	if($key != "utilisateur_mdp" && $key != "utilisateur_mdp2" && $key != "stagiaire_cv"){

    		if($utilisateurBdd->$key != $value){
    			$arrayTemp["requete"] = "`".$key."` = :".$key;
    			$arrayTemp["table"] = explode("_",$key)[0];
    			$modif[] = $arrayTemp;
    		}
    	}
    }

    if(sizeof($modif)>0){
    	$reqSQLupdateUser = "UPDATE `utilisateur` SET ";
    	$reqSQLupdateStagiaire = "UPDATE `stagiaire` SET ";	

    	foreach ($modif as $m) {
    		# code...
    		switch ($m["table"]) {
    			case 'admin':
    				# code...
    				break;
    			case 'entreprise':
    				# code...
    				break;
    			case 'formateur':
    				# code...
    				break;
    			case 'stagiaire':
    				# code...
    				$reqSQLupdateStagiaire .= $m["requete"].", ";
    				break;
    			default:
    				# code...
    				$reqSQLupdateUser .= $m["requete"].", ";
    				break;
    		}
    	}

    	$reqSQLupdateUser = "WHERE `utilisateur_id` = :utilisateur_id";
    	$reqSQLupdateStagiaire = "WHERE `stagiaire_id` = :stagiaire_id";	

    	// a ce stade les requêtes sql sont mal formées
    }

    //affiche($modif);