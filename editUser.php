<?php 

	require_once("include/bdd.php");

	if(empty($_POST)){
		header("Location: index.php?erreur=FormulaireVide");
		exit;
	}

	//affiche($_POST);

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

	// je teste les différents champs de formulaire en fonction du type d'utilisateur
	// En fonction du type de l'utilisateur je récupère les informations de l'utilisateur contenu dans 2 tables différentes en fonction du type d'utilisateur
    switch ($_SESSION['userType']) {
      case 'admin':
        # code...
        //$include = "formEditAdmin.php";
      	$reqSql = "SELECT * FROM `utilisateur` AS u JOIN `admin` AS a ON (u.`utilisateur_id` = a.`admin_utilisateur_id`) WHERE u.`utilisateur_id` = :utilisateur_id;";
        break;
      case 'entreprise':
        # code...
        //$include = "formEditEntreprise.php";
      	$reqSql = "SELECT * FROM `utilisateur` AS u JOIN `entreprise` AS e ON (u.`utilisateur_id` = e.`entreprise_utilisateur_id`) WHERE u.`utilisateur_id` = :utilisateur_id;";
        break;
      case 'formateur':
        # code...
        //$include = "formEditFormateur.php";
      	$reqSql = "SELECT * FROM `utilisateur` AS u JOIN `formateur` AS f ON (u.`utilisateur_id` = f.`formateur_utilisateur_id`) WHERE u.`utilisateur_id` = :utilisateur_id;";
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
    // je recupère les données utilisateurs que je stocke dans la la variable $utilisateurBdd 
    $utilisateurBdd = $reqPrepare->fetch(PDO::FETCH_OBJ);

    // $modif est un tableau qui contiendra toutes les modifs que je dois faire dans la bdd
    $modif = [];

    foreach ($_POST as $key => $value) {
    	# code...
    	if($key != "utilisateur_mdp" && $key != "utilisateur_mdp2" && $key != "stagiaire_cv"){
    		// ce qui m'interesse ce sont les différences entre les post et les champs de la bdd
    		if($utilisateurBdd->$key != $value){
    			$arrayTemp["requete"] = "`".$key."` = :".$key; //"`utilisateur_presentation` = :utilisateur_presentation";
    			$arrayTemp["table"] = explode("_",$key)[0];
    			$modif[] = $arrayTemp;
    		}
    	}
    }

    if(sizeof($modif)>0){
    	$reqSQLupdateUser = "UPDATE `utilisateur` SET ";
    	$reqSQLupdateStagiaire = "UPDATE `stagiaire` SET ";	
    	$reqSQLupdateAdmin = "UPDATE `admin` SET ";
    	$reqSQLupdateEntreprise = "UPDATE `entreprise` SET ";	
    	$reqSQLupdateFormateur = "UPDATE `formateur` SET ";

    	$modifUser = [];
    	$modifStagiaire = [];
    	$modifAdmin = [];
    	$modifEntreprise = [];
    	$modifFormateur = [];

    	foreach ($modif as $m) {
    		# code...
    		switch ($m["table"]) {
    			case 'admin':
    				# code...
    				$modifAdmin[] = $m["requete"];
    				break;
    			case 'entreprise':
    				# code...
    				$modifEntreprise[] = $m["requete"];
    				break;
    			case 'formateur':
    				# code...
    				$modifFormateur[] = $m["requete"];
    				break;
    			case 'stagiaire':
    				# code...
    				$modifStagiaire[] = $m["requete"];
    				break;
    			default:
    				# code...
    				$modifUser[] = $m["requete"];
    				break;
    		}
    	}

    	// Je finis donc de créer mes requetes sql
    	$reqSQLupdateUser .= implode(", ", $modifUser)." WHERE `utilisateur_id` = :utilisateur_id;";
    	$reqSQLupdateStagiaire .= implode(", ", $modifStagiaire)." WHERE `stagiaire_id` = :stagiaire_id;";
    	$reqSQLupdateAdmin .= implode(", ", $modifAdmin)." WHERE `admin_id` = :admin_id;";
    	$reqSQLupdateEntreprise .= implode(", ", $modifEntreprise)." WHERE `entreprise_id` = :entreprise_id;";
    	$reqSQLupdateFormateur .= implode(", ", $modifFormateur)." WHERE `formateur_id` = :formateur_id;";

    	$db->beginTransaction();
    	// cette variable a valider la transaction
    	$toutCePasseBien = true;
    	// ici je les prépares
    	if(sizeof($modifUser) > 0){
    		$prepareUpdateUser = $db->prepare($reqSQLupdateUser);
    		$prepareUpdateUser->bindValue(":utilisateur_id", $utilisateurBdd->utilisateur_id);
    		foreach ($modifUser as $requete) {
				# code...
				$req = explode(" = ", $requete);
				$bindKey = end($req);
				// 
				$valeurToBind = $_POST[substr($bindKey, 1)]; // renvoi une chaine de caractères en partant du second
				$valeurToBind = $_POST[str_replace(":", "", $bindKey)]; // renvoi une chaine de caractère en remplaçant le premier paramètre par le second dans la chaine contenue dans le troisième argument
				$prepareUpdateUser->bindValue($bindKey, $valeurToBind);
			}	

			if(!$prepareUpdateUser->execute()){
				$toutCePasseBien = false;
			} else {
				$sql = "SELECT * FROM `utilisateur` WHERE `utilisateur_id` = :utilisateur_id";
				$req = $db->prepare($sql);
				$req->bindValue(":utilisateur_id", $utilisateurBdd->utilisateur_id);
				$req->execute();

				$_SESSION['user'] = $req->fetch(PDO::FETCH_OBJ);
			}
    	}

    	if(sizeof($modifStagiaire) > 0){
    		$prepareUpdateStagiaire = $db->prepare($reqSQLupdateStagiaire);
    		$prepareUpdateStagiaire->bindValue(":stagiaire_id", $utilisateurBdd->stagiaire_id);
    		foreach ($modifStagiaire as $requete) {
				# code...
				$req = explode(" = ", $requete);
				$bindKey = end($req);
				// 
				$valeurToBind = $_POST[substr($bindKey, 1)]; // renvoi une chaine de caractères en partant du second
				$valeurToBind = $_POST[str_replace(":", "", $bindKey)]; // renvoi une chaine de caractère en remplaçant le premier paramètre par le second dans la chaine contenue dans le troisième argument
				$prepareUpdateStagiaire->bindValue($bindKey, $valeurToBind);
			}	

			if(!$prepareUpdateStagiaire->execute()){
				$toutCePasseBien = false;
			} else {
				$sql = "SELECT * FROM `stagiaire` WHERE `stagiaire_id` = :stagiaire_id";
				$req = $db->prepare($sql);
				$req->bindValue(":stagiaire_id", $utilisateurBdd->stagiaire_id);
				$req->execute();

				$_SESSION['stagiaire'] = $req->fetch(PDO::FETCH_OBJ);
			}
    	}




    	if(sizeof($modifAdmin) > 0){
    		$prepareUpdateAdmin = $db->prepare($reqSQLupdateAdmin);
    		$prepareUpdateAdmin->bindValue(":admin_id", $utilisateurBdd->admin_id);
    		foreach ($modifAdmin as $requete) {
				# code...
				$req = explode(" = ", $requete);
				$bindKey = end($req);
				// 
				$valeurToBind = $_POST[substr($bindKey, 1)]; // renvoi une chaine de caractères en partant du second
				$valeurToBind = $_POST[str_replace(":", "", $bindKey)]; // renvoi une chaine de caractère en remplaçant le premier paramètre par le second dans la chaine contenue dans le troisième argument
				$prepareUpdateAdmin->bindValue($bindKey, $valeurToBind);
			}	

			if(!$prepareUpdateAdmin->execute()){
				$toutCePasseBien = false;
			}  else {
				$sql = "SELECT * FROM `admin` WHERE `admin_id` = :admin_id";
				$req = $db->prepare($sql);
				$req->bindValue(":admin_id", $utilisateurBdd->admin_id);
				$req->execute();

				$_SESSION['admin'] = $req->fetch(PDO::FETCH_OBJ);
			}
    	}

    	if(sizeof($modifEntreprise) > 0){
    		$prepareUpdateEntreprise = $db->prepare($reqSQLupdateEntreprise);
    		$prepareUpdateEntreprise->bindValue(":entreprise_id", $utilisateurBdd->entreprise_id);
    		foreach ($modifEntreprise as $requete) {
				# code...
				$req = explode(" = ", $requete);
				$bindKey = end($req);
				// 
				$valeurToBind = $_POST[substr($bindKey, 1)]; // renvoi une chaine de caractères en partant du second
				$valeurToBind = $_POST[str_replace(":", "", $bindKey)]; // renvoi une chaine de caractère en remplaçant le premier paramètre par le second dans la chaine contenue dans le troisième argument
				$prepareUpdateEntreprise->bindValue($bindKey, $valeurToBind);
			}	

			if(!$prepareUpdateEntreprise->execute()){
				$toutCePasseBien = false;
			} else {
				$sql = "SELECT * FROM `entreprise` WHERE `entreprise_id` = :entreprise_id";
				$req = $db->prepare($sql);
				$req->bindValue(":entreprise_id", $utilisateurBdd->entreprise_id);
				$req->execute();

				$_SESSION['entreprise'] = $req->fetch(PDO::FETCH_OBJ);
			}
    	}
    	
    	if(sizeof($modifFormateur) > 0){
    		$prepareUpdateFormateur = $db->prepare($reqSQLupdateFormateur);
    		$prepareUpdateFormateur->bindValue(":formateur_id", $utilisateurBdd->formateur_id);
    		foreach ($modifFormateur as $requete) {
				# code...
				$req = explode(" = ", $requete);
				$bindKey = end($req);
				// 
				$valeurToBind = $_POST[substr($bindKey, 1)]; // renvoi une chaine de caractères en partant du second
				$valeurToBind = $_POST[str_replace(":", "", $bindKey)]; // renvoi une chaine de caractère en remplaçant le premier paramètre par le second dans la chaine contenue dans le troisième argument
				$prepareUpdateFormateur->bindValue($bindKey, $valeurToBind);
			}	

			if(!$prepareUpdateFormateur->execute()){
				$toutCePasseBien = false;
			} else {
				$sql = "SELECT * FROM `formateur` WHERE `formateur_id` = :formateur_id";
				$req = $db->prepare($sql);
				$req->bindValue(":formateur_id", $utilisateurBdd->formateur_id);
				$req->execute();

				$_SESSION['formateur'] = $req->fetch(PDO::FETCH_OBJ);
			}
    	}

    	if($toutCePasseBien){
    		$db->commit();
   			header("Location: index.php?editOk");
   			exit;
    	} else {
    		$db->rollBack();
    		header("Location: index.php?editKO");
   			exit;
    	}
    	
    }

    //affiche($modif);