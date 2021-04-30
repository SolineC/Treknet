<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");
bloquer_sans_session();


$connexion = connexion("treknet");

if ($_SERVER['REQUEST_METHOD']== "POST"){
    $mess=preTraiterChampSQL($_POST['mess'],$connexion);
    creer_message($_SESSION['pseudo'], "Ana", $mess);
}

afficher_conversation($_SESSION['pseudo'],"Soline")
?>