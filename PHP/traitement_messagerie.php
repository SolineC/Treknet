<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");
bloquer_sans_session();


$connexion = connexion("treknet");
  //  $mess=preTraiterChampSQL($_POST['mess'],$connexion);
    $desti= $_POST['pseudo'];


afficher_conversation($_SESSION['pseudo'],$desti);
    creer_message($_SESSION['pseudo'], $desti, $_POST['mess']);

?>