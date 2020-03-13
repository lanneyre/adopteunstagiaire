<?php 
require ("class/Pratique.php");
require ("class/Formation.php");
require ("class/Stage.php");
require ("class/Utilisateur.php");
require ("class/Stagiaire.php");
require ("class/Entreprise.php");

$form = new Formation();

echo '$form->id = '.$form->id.'<br>';
$form->id = 42;
echo '$form->id = '.$form->id.'<br>';

echo '<hr>';

$stage = new Stage();

echo '$stage->id = '.$stage->id.'<br>';
$stage->id = 22;
echo '$stage->id = '.$stage->id.'<br>';

echo '<hr>';

$user = new Utilisateur();

echo '$user->mail = '.$user->mail.'<br>';
$user->mail = "remi.lanney@cote-azur.cci.fr";
echo '$user->mail = '.$user->mail.'<br>';

echo '$user->mdp = '.$user->mdp.'<br>';
$user->encryptMdp("test");
echo '$user->mdp = '.$user->mdp.'<br>';

echo '<hr>';

$stagiaire = new Stagiaire();

echo '$stagiaire->nom = '.$stagiaire->nom.'<br>';
$stagiaire->nom = "LANNEY";
echo '$stagiaire->nom = '.$stagiaire->nom.'<br>';

echo '<hr>';

$entreprise = new Entreprise();

echo '$entreprise->id = '.$entreprise->id.'<br>';
$entreprise->id = "ICS";
echo '$entreprise->id = '.$entreprise->id.'<br>';