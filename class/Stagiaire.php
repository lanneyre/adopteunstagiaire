<?php 
/**
 * 
 */
class Stagiaire extends Utilisateur
{
	protected $nom;
	protected $prenom;
	protected $img;
	protected $CV;
	protected $statut;
	protected $formation;

	// public function __get($attribut){
	// 	return $this->$attribut;
	// }

	// public function __set($attribut, $valeur){
	// 	$this->$attribut = $valeur;
	// }



	public static function getNbStagiaire($formation_id){
		// je récupère ici tous les apprenants de la promotion
        // la requete
        if($formation_id == 0) {
        	$sqlAllApprenants = "SELECT * FROM `stagiaire`;";
        } else {
        	$sqlAllApprenants = "SELECT * FROM `stagiaire` WHERE `stagiaire_formation_id` = :stagiaire_formation_id;";	
        }
        // que j'envoie au serveur
        // $GLOBALS permet d'accéder à la variable déclarée plus haut dans le code (dans le fichier bdd) Sans ça $db n'éxiste pas dans la classe
        $requeteAllApprenants = $GLOBALS['db']->prepare($sqlAllApprenants);
        // j'attache l'id de la formation à ma requete 
        if($formation_id != 0) {
	        $requeteAllApprenants->bindValue(":stagiaire_formation_id", $formation_id);
	    }
        // Je demande au serveur d'executer la requète
        $requeteAllApprenants->execute();
        // avant de récupérer le nombre de résultats
        return $requeteAllApprenants->rowCount();
	}

	public function updateData($data){
		
	}

	public static function getAllStagiaire($formation_id = 0, $offset = 0, $nbCard = 20){
		// je récupère ici tous les apprenants de la promotion
        // la requete
        if($formation_id == 0) {
        	$sqlAllApprenants = "SELECT * FROM `stagiaire` AS s JOIN `utilisateur` AS u ON (s.`stagiaire_utilisateur_id` = u.`utilisateur_id`) ORDER BY RAND();";
        } else {
        	$sqlAllApprenants = "SELECT * FROM `stagiaire` AS s JOIN `utilisateur` AS u ON (s.`stagiaire_utilisateur_id` = u.`utilisateur_id`) WHERE s.`stagiaire_formation_id` = :stagiaire_formation_id ORDER BY s.`stagiaire_nom` ASC LIMIT :offset, :nbCard;";
        }
        
        // que j'envoie au serveur
        $requeteAllApprenants = $GLOBALS['db']->prepare($sqlAllApprenants);
        // j'attache l'id de la formation à ma requete
        if($formation_id != 0) {
	        $requeteAllApprenants->bindValue(":stagiaire_formation_id", $formation_id);
	    }
        $requeteAllApprenants->bindValue(":offset", $offset, PDO::PARAM_INT);
        $requeteAllApprenants->bindValue(":nbCard", $nbCard, PDO::PARAM_INT);
        // Je demande au serveur d'executer la requète
        $requeteAllApprenants->execute();
        // avant de récupérer les résultats sous forme de tableau d'objet
        return $requeteAllApprenants->fetchAll(PDO::FETCH_OBJ);
	}

}