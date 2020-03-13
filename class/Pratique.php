<?php 
/**
 * 
 */
class Pratique
{
	
	public function __get($attribut){
		return $this->$attribut;
	}

	public function __set($attribut, $valeur){
		$this->$attribut = $valeur;
	}
}