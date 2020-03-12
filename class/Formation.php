<?php
/*
	resumé de la class formation
*/

class Formation {
	private $id;
	private $nom;
	private $programme;
	private $competences;

	public function __get($attribut){
		/*if($attribut== "nom"){
			return "erreur";
		} else {*/
			return $this->$attribut;
		//}
	}

	public function __set($attribut, $valeur){
		$this->$attribut = $valeur;
	}
}