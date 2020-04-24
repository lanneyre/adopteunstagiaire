<?php 

// On teste si le mail est vide
if(isset($_POST['send']) && empty($_POST['utilisateur_mail'])){
	header("Location: mdpOublie.php?Error=EmailVide");
	exit;
}

// on teste si le mail est mal formé
if(isset($_POST['send']) && !filter_var($_POST['utilisateur_mail'], FILTER_VALIDATE_EMAIL)){
	header("Location: mdpOublie.php?Error=EmailInvalide");
	exit;	
}

//var_dump($_POST);
if(isset($_POST['send'])){
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
			header("Location: mdpOublie.php?Error=mailInexistant");
			exit;
			//echo "Le mail n'est pas enregistré dans la bdd";
		} else {
			function randomPassword($nbcarac = 15) {
			    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#=!?.$%*-+';
			    $pass = array(); //remember to declare $pass as an array
			    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			    for ($i = 0; $i < $nbcarac; $i++) {
			        $n = rand(0, $alphaLength);
			        $pass[] = $alphabet[$n];
			    }
			    return implode($pass); //turn the array into a string
			}

			$utilisateur = $reqprepare->fetch(PDO::FETCH_OBJ);

			// je prépare la requete de modif dans la bdd
			$sqlUPDATE = "UPDATE `utilisateur` SET `utilisateur_mdp` = :utilisateur_mdp WHERE `utilisateur_id` = :utilisateur_id;";
			$reqprepare = $db->prepare($sqlUPDATE);

			// genération du mdp
			$newmdp = randomPassword();
			$newmdpHash	= password_hash($newmdp, PASSWORD_DEFAULT);

			// je commence une transaction qui me permetra de valider ou non la requete en fonction de la réussite de l'envoi de mail
			$db->beginTransaction();
			// on modifie la bdd
			$reqprepare->bindValue(":utilisateur_id", $utilisateur->utilisateur_id);
			$reqprepare->bindValue(":utilisateur_mdp", $newmdpHash);
			$reqprepare->execute();

			//on envoie le mail
			//mail ( string $to , string $subject , string $message [, mixed $additional_headers [, string $additional_parameters ]] )
			if(mail($utilisateur->utilisateur_mail, "Changement de mdp", "Votre nouveau mot de passe est : ".$newmdp)){
				// si le mail est envoyé je valide la transaction, je valide l'execution de la requete
				$db->commit();
				header("Location: index.php?mdpEnvoye");
				exit;
			} else {
				// Sinon j'annule purement et simplement toutes les requetes depuis le début de la transaction
				$db->rollBack();
				header("Location: index.php?mailNonPartis");
				exit;
			}

			
		}
	}catch(PDOException $exception){
		echo $exception->getMessage();
	}
}