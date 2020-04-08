<?php 
	// je teste si les champs existet et si aucun n'est vide
	if(!empty($_POST['utilisateur_mail']) && !empty($_POST['utilisateur_mdp'])){
		// je teste si le mail est bien formé (pas s'il existe)
		if(filter_var($_POST['utilisateur_mail'], FILTER_VALIDATE_EMAIL)){
			// echo "ok";
			// j'intègre ma connexion à la bdd
			require_once("include/bdd.php");
			// si les mdp ne sont pas cryptés
			/*
			try{
				// Si vous voulez permettre l'injection SQL
				// $requeteSQL = "SELECT `utilisateur_mail` FROM `utilisateur` WHERE `utilisateur_mail` = '".$_POST['utilisateur_mail']."' AND `utilisateur_mdp` = '".$_POST['utilisateur_mdp']."';";
				// $reqprepare = $db->query($requeteSQL);


				// Et si vous voulez vous en protéger :
				$requeteSQL = "SELECT `utilisateur_mail` FROM `utilisateur` WHERE `utilisateur_mail` = :utilisateur_mail AND `utilisateur_mdp` = :utilisateur_mdp;";
				$reqprepare = $db->prepare($requeteSQL);
				$reqprepare->bindValue(":utilisateur_mail", $_POST['utilisateur_mail']);
				$reqprepare->bindValue(":utilisateur_mdp", $_POST['utilisateur_mdp']);
				$reqprepare->execute();

				if($reqprepare->rowCount() == 0){
					echo "Les identifiants sont érronés";
				} else {
					echo "vous êtes connectés";
				}
			}catch(PDOException $exception){
				echo $exception->getMessage();
			}*/

			// si les mdp sont cryptés
			try{

				// Et si vous voulez vous en protéger :
				// Je récupère tous les utilisateurs en fonction du mail.
				// Le mail étant définit comme unique dans la bdd : seul 2 cas sont possible : soit il y a 1 utilisateur soit il n'y en a pas
				$requeteSQL = "SELECT `utilisateur_mail`, `utilisateur_mdp` FROM `utilisateur` WHERE `utilisateur_mail` = :utilisateur_mail";

				// Afin d'éviter les injections SQL je prépare ma requête
				$reqprepare = $db->prepare($requeteSQL);
				// j'intègre le mail à ma requête
				$reqprepare->bindValue(":utilisateur_mail", $_POST['utilisateur_mail']);
				// j'exécute ma requete
				$reqprepare->execute();

				// Si ma requete ne renvoit aucune ligne : cela veut dire que l'email n'est pas dans la bdd
				if($reqprepare->rowCount() == 0){
					echo "Le mail n'est pas enregistré dans la bdd";
				} else {
					// je récupère les infos nottamment le mot de passe que je stocke dans la variable
					$utilisateur = $reqprepare->fetch(PDO::FETCH_OBJ);
					// ensuite je test si les mdp correspondent entre eux
					if(password_verify($_POST['utilisateur_mdp'], $utilisateur->utilisateur_mdp)){
						echo "vous êtes connectés";	
					} else {
						echo "Le mdp est faux";
					}			
				}
			}catch(PDOException $exception){
				echo $exception->getMessage();
			}
		} else {
			echo "entrez un email valide : ".$_POST['utilisateur_mail']." est pourri !";
		}
	} else {
		echo "erreur<br>tu recomence trouduc";
	}