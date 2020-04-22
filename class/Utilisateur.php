<?php 
/**
 * 
 */
class Utilisateur extends Pratique implements interfaceUtilisateur
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

	// Chacune de ses fonctions on été déclarée dans l'interface donc je doit obligatoirement les implémenter dans cette classe
	public function encryptMdp($mdp){
		$this->mdp = password_hash($mdp, PASSWORD_DEFAULT);
	}

	public function connection($login, $mdp){

	}

	public function changeMdp($oldMdp, $newmdp){

	}

	// cas particulier car elle doit être surcharger dans les classe filles
	public function updateData($data){

	}
}