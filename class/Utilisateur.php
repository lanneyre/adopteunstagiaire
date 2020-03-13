<?php 
/**
 * 
 */
class Utilisateur
{
	private $id;
	private $mail;
	private $mdp;
	private $presentation;
	private $tel;

	public function __get($attribut){
		return $this->$attribut;
	}

	public function __set($attribut, $valeur){
		$this->$attribut = $valeur;
	}

	public function encryptMdp($mdp){
		$this->mdp = password_hash($mdp, PASSWORD_DEFAULT);
	}
}