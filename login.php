<?php 

	if(!empty($_POST['utilisateur_mail']) && !empty($_POST['utilisateur_mdp'])){
		if(filter_var($_POST['utilisateur_mail'], FILTER_VALIDATE_EMAIL)){
			// echo "ok";
			require_once("include/bdd.php");
			try{
				// Si vous voulez permettre l'injection SQL
				$requeteSQL = "SELECT `utilisateur_mail` FROM `utilisateur` WHERE `utilisateur_mail` = '".$_POST['utilisateur_mail']."' AND `utilisateur_mdp` = '".$_POST['utilisateur_mdp']."';";
				$reqprepare = $db->query($requeteSQL);


				// Et si vous voulez vous en protéger :
				// $requeteSQL = "SELECT `utilisateur_mail` FROM `utilisateur` WHERE `utilisateur_mail` = :utilisateur_mail AND `utilisateur_mdp` = :utilisateur_mdp;";
				// $reqprepare = $db->prepare($requeteSQL);
				// $reqprepare->bindValue(":utilisateur_mail", $_POST['utilisateur_mail']);
				// $reqprepare->bindValue(":utilisateur_mdp", $_POST['utilisateur_mdp']);
				// $reqprepare->execute();

				if($reqprepare->rowCount() == 0){
					echo "Les identifiants sont érronés";
				} else {
					echo "vous êtes connectés";
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