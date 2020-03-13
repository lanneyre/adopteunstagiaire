<?php 
/**
 * 
 */
class Entreprise
{
	private $raisonSociale;
	private $adresse;
	private $CP;
	private $ville;
	private $siret;

	public function __get($attribut){
		return $this->$attribut;
	}

	public function __set($attribut, $valeur){
		$this->$attribut = $valeur;
	}
}