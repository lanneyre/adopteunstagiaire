<?php
/*
	resumé de la class formation
*/

class Formation extends Pratique{
	
	protected $id;
	protected $nom;
	protected $programme;
	protected $competences;

	function __construct($id = 1, $nom = "dwwm 2", $programme = "Au secours", $competences = "Pour faire quoi ?"){
		$this->id = $id;
		$this->nom = $nom;
		$this->programme = $programme;
		$this->competences = $competences;
	}
}