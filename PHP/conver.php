<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");

bloquer_sans_session();


$connexion = connexion("treknet");
  
$desti= $_POST['pseudo'];
$SESSION['desti']= $desti;
afficher_en_tete();
afficher_conversation($_SESSION['pseudo'],$desti);
    

montrer_message($_SESSION['pseudo'],$desti);

?>