<?php 
include_once("include.php");

$form = new Formation(15, "dwwm 2", "plein d'hémoglobine", "pleins");

echo '$form->id = '.$form->id.'<br>';
echo '$form->nom = '.$form->nom.'<br>';
echo '$form->programme = '.$form->programme.'<br>';
echo '$form->competences = '.$form->competences.'<br>';

$form = new Formation();

echo '$form->id = '.$form->id.'<br>';
echo '$form->nom = '.$form->nom.'<br>';
echo '$form->programme = '.$form->programme.'<br>';
echo '$form->competences = '.$form->competences.'<br>';

$form = new Formation( 424242, "test");

echo '$form->id = '.$form->id.'<br>';
echo '$form->nom = '.$form->nom.'<br>';
echo '$form->programme = '.$form->programme.'<br>';
echo '$form->competences = '.$form->competences.'<br>';

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