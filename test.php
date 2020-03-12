<?php 
require ("class/Formation.php");

$form = new Formation();

echo '$form->id = '.$form->id.'<br>';
$form->id = 42;
echo '$form->id = '.$form->id.'<br>';