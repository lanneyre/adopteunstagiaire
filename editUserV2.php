<?php 

	require_once("include/bdd.php");

	if(empty($_POST)){
		header("Location: index.php?erreur=FormulaireVide");
		exit;
	}

	affiche($_POST);

	// les variables sont vides
	// les variables sont valides
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
        break;
      case 'entreprise':
        # code...
        //$include = "formEditEntreprise.php";
        break;
      case 'formateur':
        # code...
        //$include = "formEditFormateur.php";
        break;
      default:
        # code...
        if(empty($_POST['stagiaire_prenom'])){
			$error[] = "stagiairePrenomVide";		
		}
		if(empty($_POST['stagiaire_nom'])){
			$error[] = "stagiaireNomVide";		
		}
        break;
    }

	if(sizeof($error)>0){
		header("Location: index.php?editError=".implode("-",$error));
		exit;
	}


	$db->beginTransaction();

	$toutCePasseBien = true;

	$sqlUser = "UPDATE `utilisateur` SET `utilisateur_mail` = :utilisateur_mail, `utilisateur_presentation` = :utilisateur_presentation, `utilisateur_tel` = :utilisateur_tel WHERE `utilisateur`.`utilisateur_id` = :utilisateur_id;";
	$reqprepare = $db->prepare($sqlUser);
	$reqprepare->bindValue(":utilisateur_mail", $_POST['utilisateur_mail']);
	$reqprepare->bindValue(":utilisateur_presentation", $_POST['utilisateur_presentation']);
	$reqprepare->bindValue(":utilisateur_tel", $_POST['utilisateur_tel']);
	$reqprepare->bindValue(":utilisateur_id", $_POST['utilisateur_id']);

	if(!$reqprepare->execute()){
		$toutCePasseBien = false;
	} else {
		$sql = "SELECT * FROM `utilisateur` WHERE `utilisateur_id` = :utilisateur_id";
		$req = $db->prepare($sql);
		$req->bindValue(":utilisateur_id", $_POST['utilisateur_id']);
		$req->execute();

		$_SESSION['user'] = $req->fetch(PDO::FETCH_OBJ);
	}

	switch ($_SESSION['userType']) {
		case 'admin':
			# code...
			$reqSqlAdmin = "UPDATE `admin` SET `admin_role` = :admin_role WHERE `admin`.`admin_id` = :admin_id;";
			$reqprepareAdmin = $db->prepare($reqSqlAdmin);
			$reqprepareAdmin->bindValue(":admin_role", $_POST['admin_role']);
			$reqprepareAdmin->bindValue(":admin_id", $_POST['admin_id']);
			if(!$reqprepareAdmin->execute()){
				$toutCePasseBien = false;
			}  else {
				$sql = "SELECT * FROM `admin` WHERE `admin_id` = :admin_id";
				$req = $db->prepare($sql);
				$req->bindValue(":admin_id", $_POST['admin_id']);
				$req->execute();

				$_SESSION['admin'] = $req->fetch(PDO::FETCH_OBJ);
			}
			break;
		case 'formateur':
			# code...
			$reqSQLFormateur = "UPDATE `formateur` SET `formateur_nom` = :formateur_nom, `formateur_prenom` = :formateur_prenom WHERE `formateur`.`formateur_id` = :formateur_id;"; 
			$reqprepapreFormateur = $db->prepare($reqSQLFormateur);
			$reqprepapreFormateur->bindValue(":formateur_prenom", $_POST['formateur_prenom']);
			$reqprepapreFormateur->bindValue(":formateur_nom", $_POST['formateur_nom']);
			$reqprepapreFormateur->bindValue(":formateur_id", $_POST['formateur_id']);
			if(!$reqprepapreFormateur->execute()){
				$toutCePasseBien = false;
			} else {
				$sql = "SELECT * FROM `formateur` WHERE `formateur_id` = :formateur_id";
				$req = $db->prepare($sql);
				$req->bindValue(":formateur_id", $_POST['formateur_id']);
				$req->execute();

				$_SESSION['formateur'] = $req->fetch(PDO::FETCH_OBJ);
			}
			break;
		case 'entreprise':
			# code...
			$reqSQLEntreprise = "UPDATE `entreprise` SET `entreprise_raisonSociale` = :entreprise_raisonSociale, `entreprise_adresse` = :entreprise_adresse, `entreprise_cp` = :entreprise_cp, `entreprise_ville` = :entreprise_ville, `entreprise_siret` = :entreprise_siret, `entreprise_caracteristiques` = :entreprise_caracteristiques WHERE `entreprise`.`entreprise_id` = :entreprise_id; ";
			$reqprepareEntreprise = $db->prepare($reqSQLEntreprise);
			$reqprepareEntreprise->bindValue(":entreprise_raisonSociale", $_POST['entreprise_raisonSociale']);
			$reqprepareEntreprise->bindValue(":entreprise_adresse", $_POST['entreprise_adresse']);
			$reqprepareEntreprise->bindValue(":entreprise_cp", $_POST['entreprise_cp']);
			$reqprepareEntreprise->bindValue(":entreprise_ville", $_POST['entreprise_ville']);
			$reqprepareEntreprise->bindValue(":entreprise_siret", $_POST['entreprise_siret']);
			$reqprepareEntreprise->bindValue(":entreprise_caracteristiques", $_POST['entreprise_caracteristiques']);
			$reqprepareEntreprise->bindValue(":entreprise_id", $_POST['entreprise_id']);
			if(!$reqprepareEntreprise->execute()){
				$toutCePasseBien = false;
			} else {
				$sql = "SELECT * FROM `entreprise` WHERE `entreprise_id` = :entreprise_id";
				$req = $db->prepare($sql);
				$req->bindValue(":entreprise_id", $_POST['entreprise_id']);
				$req->execute();

				$_SESSION['entreprise'] = $req->fetch(PDO::FETCH_OBJ);
			}
			break;
		default:
			# code...
			$reqSQLStagiaire = "UPDATE `stagiaire` SET `stagiaire_prenom` = :stagiaire_prenom, `stagiaire_nom` = :stagiaire_nom, `stagiaire_statut` = :stagiaire_statut, `stagiaire_preferences` = :stagiaire_preferences WHERE `stagiaire`.`stagiaire_id` = :stagiaire_id ";
			$reqprepareStagiaire = $db->prepare($reqSQLStagiaire);
			$reqprepareStagiaire->bindValue(":stagiaire_prenom", $_POST['stagiaire_prenom']);
			$reqprepareStagiaire->bindValue(":stagiaire_nom", $_POST['stagiaire_nom']);
			$reqprepareStagiaire->bindValue(":stagiaire_statut", $_POST['stagiaire_statut']);
			$reqprepareStagiaire->bindValue(":stagiaire_preferences", $_POST['stagiaire_preferences']);
			$reqprepareStagiaire->bindValue(":stagiaire_id", $_POST['stagiaire_id']);
			if(!$reqprepareStagiaire->execute()){
				$toutCePasseBien = false;
			} else {
				$sql = "SELECT * FROM `stagiaire` WHERE `stagiaire_id` = :stagiaire_id";
				$req = $db->prepare($sql);
				$req->bindValue(":stagiaire_id", $_POST['stagiaire_id']);
				$req->execute();

				$_SESSION['stagiaire'] = $req->fetch(PDO::FETCH_OBJ);
			}
			break;
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

