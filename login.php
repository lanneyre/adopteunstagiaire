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
				$requeteSQL = "SELECT * FROM `utilisateur` WHERE `utilisateur_mail` = :utilisateur_mail";

				// Afin d'éviter les injections SQL je prépare ma requête
				$reqprepare = $db->prepare($requeteSQL);
				// j'intègre le mail à ma requête
				$reqprepare->bindValue(":utilisateur_mail", $_POST['utilisateur_mail']);
				// j'exécute ma requete
				$reqprepare->execute();

				// Si ma requete ne renvoit aucune ligne : cela veut dire que l'email n'est pas dans la bdd
				if($reqprepare->rowCount() == 0){
					header("Location: index.php?errorLogin=mailInexistant");
					exit;
					//echo "Le mail n'est pas enregistré dans la bdd";
				} else {
					// je récupère les infos nottamment le mot de passe que je stocke dans la variable
					$utilisateur = $reqprepare->fetch(PDO::FETCH_OBJ);
					// ensuite je test si les mdp correspondent entre eux
					if(password_verify($_POST['utilisateur_mdp'], $utilisateur->utilisateur_mdp)){
						//echo "vous êtes connectés";

						// lorsque l'utilisateur se connecte, rempli une variable de session qui sera accessible de partout
						$_SESSION['user'] = $utilisateur;

						// Si un jour on rajoute une table (comprendre un nouveau type d'utilisateur, il suffira de la rajouter dans ce tableau)
						$tables = ["stagiaire", "entreprise", "formateur", "admin"];

						// Je parcours toutes mes tables d'utilisateurs particuliers 
						foreach ($tables as $table) {
							# code...
							// Je veux savoir si une ligne de ma table correspond à l'utilisateur connecté
							$requeteSQL = "SELECT * FROM `$table` WHERE `".$table."_utilisateur_id` = :utilisateur_id";
							// Afin d'éviter les injections SQL je prépare ma requête
							$reqprepare = $db->prepare($requeteSQL);
							// j'intègre le mail à ma requête
							$reqprepare->bindValue(":utilisateur_id", $utilisateur->utilisateur_id);
							// j'exécute ma requete
							$reqprepare->execute();

							//var_dump($reqprepare->rowCount());
							// Si j'ai une ligne qui correspond 
							if($reqprepare->rowCount()==1){
								// Je renseigne la session avec le type d'utilisateur : $table
								$_SESSION['userType'] = $table;
								// Ainsi que les informations correspondantes à l'utilisateur
								$_SESSION[$table] = $reqprepare->fetch(PDO::FETCH_OBJ);
								// je sors de la boucle car ça ne sert à rien de continuer la boucle : j'ai déjà les informations dont j'ai besoin.
								break;
							}
						}				

						// Je redirige vers la page d'accueil. Cette page devient totalement invisible pour celui qui navigue sur le site
						header("Location: index.php?login=ok");
						exit;	
					} else {
						header("Location: index.php?errorLogin=mdp");
						exit;
						//echo "Le mdp est faux";
					}			
				}
			}catch(PDOException $exception){
				echo $exception->getMessage();
			}
		} else {
			header("Location: index.php?errorLogin=mailInvalide");
			exit;
			//echo "entrez un email valide : ".$_POST['utilisateur_mail']." est pourri !";
		}
	} else {
		header("Location: index.php?errorLogin=noData");
		exit;
		//echo "erreur<br>tu recomence trouduc";
	}