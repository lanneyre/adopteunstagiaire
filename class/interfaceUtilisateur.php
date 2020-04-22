<?php 

// définit le comportement, les différentes functions qu'auront les class qui implémenteront cette interface
interface interfaceUtilisateur{

	// permet à l'utilisateur de se connecter
	// doit verifier si l'utilisateur existe, ce qu'il est (admin, entreprise, stagiaire ou formateur) et renseigner la session
	public function connection($login, $mdp);

	// permet d'encrypter une chaine de caractère comme un mot de passe
	public function encryptMdp($mdp);

	// permet de changer le mot de passe, 
	// vérifie d'abord si l'ancien mdp est juste et si oui le remplace par le nouveau
	public function changeMdp($oldMdp, $newmdp);

	// permet de changer les données de l'utilisateur 
	// $data est un tableau associatif contenant toutes les information à changer sauf le mdp
	public function updateData($data);
}