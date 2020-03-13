<?php 
require ("class/Pratique.php");
require ("class/Formation.php");
require ("class/Stage.php");

$form = new Formation();

echo '$form->id = '.$form->id.'<br>';
$form->id = 42;
echo '$form->id = '.$form->id.'<br>';

echo '<hr>';

$stage = new Stage();

echo '$stage->id = '.$stage->id.'<br>';
$stage->id = 22;
echo '$stage->id = '.$stage->id.'<br>';