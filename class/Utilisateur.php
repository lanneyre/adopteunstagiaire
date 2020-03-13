<?php 
/**
 * 
 */
class Utilisateur extends Pratique
{
	protected $id;
	protected $mail;
	protected $mdp;
	protected $presentation;
	protected $tel;

	// public function __get($attribut){
	// 	return $this->$attribut;
	// }

	// public function __set($attribut, $valeur){
	// 	$this->$attribut = $valeur;
	// }

	public function encryptMdp($mdp){
		$this->mdp = password_hash($mdp, PASSWORD_DEFAULT);
	}
}