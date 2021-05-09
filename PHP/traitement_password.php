<?php

require_once("fonctions.php");
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");

echo $_POST["mail"];
$to      = 'ana.parres27@gmail.com';
$subject = 'Test envoi mail';
$message = 'coucou';
$headers = 'From: soline@corm.eu';
mail ($to ,$subject , $message, $headers);


?>