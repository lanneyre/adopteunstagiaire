<?php 
/**
 * 
 */
class Stagiaire
{
	private $nom;
	private $prenom;
	private $CV;
	private $statut;
	private $formation;

	public function __get($attribut){
		return $this->$attribut;
	}

	public function __set($attribut, $valeur){
		$this->$attribut = $valeur;
	}
}