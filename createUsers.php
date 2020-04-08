<?php 
    require_once("include/bdd.php");

    $sqlAllApprenants = "SELECT * FROM `utilisateur`;";
        // que j'envoie au serveur
        $requeteAllApprenants = $db->query($sqlAllApprenants);
        // avant de récupérer les résultats
        $allApprenants = $requeteAllApprenants->fetchAll(PDO::FETCH_OBJ);

    // $sqlUsers = "INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_mail`, `utilisateur_mdp`, `utilisateur_presentation`, `utilisateur_tel`) VALUES (NULL, :utilisateur_mail, :utilisateur_mdp, \"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.\", \"06 21 34 59 78\");";
    // $reqUsers = $db->prepare($sqlUsers);

    $SQLuptStagiaire = "UPDATE `utilisateur` SET `utilisateur_mdp` = :utilisateur_mdp WHERE `utilisateur`.`utilisateur_id` = :utilisateur_id ";
    $requpdStagiaire = $db->prepare($SQLuptStagiaire);

    foreach ($allApprenants as $apprenant) {
    	# code...
    	// $utilisateur_mail = str_replace(" ", "-", strtolower(substr($apprenant->stagiaire_nom, 0,1)).".".strtolower($apprenant->stagiaire_prenom)."@ics-nice.com");
    	// $utilisateur_mdp = $utilisateur_mail;
    	// $reqUsers->bindValue(":utilisateur_mail", $utilisateur_mail);
    	// $reqUsers->bindValue(":utilisateur_mdp", $utilisateur_mdp);
    	// $reqUsers->execute();
    	// $stagiaire_utilisateur_id = $apprenant->stagiaire_id + 3;
    	// $requpdStagiaire->bindValue(":stagiaire_utilisateur_id",$stagiaire_utilisateur_id);
    	// $requpdStagiaire->bindValue(":stagiaire_id", $apprenant->stagiaire_id);
    	// $requpdStagiaire->execute();

        $requpdStagiaire->bindValue(":utilisateur_mdp",password_hash($apprenant->utilisateur_mdp, PASSWORD_BCRYPT));
        $requpdStagiaire->bindValue(":utilisateur_id", $apprenant->utilisateur_id);
        $requpdStagiaire->execute();
    }