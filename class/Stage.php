<?php 
/**
 * 
 */
class Stage {
	
	private $id;
	private $dateDebut;
	private $dateFin;
	private $formation;

	public function __get($attribut){
		return $this->$attribut;
	}

	public function __set($attribut, $valeur){
		$this->$attribut = $valeur;
	}
}