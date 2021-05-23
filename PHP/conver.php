<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");

bloquer_sans_session();


$connexion = connexion("treknet");

if (isset($_POST['pseudo'])){
    $_SESSION['desti']=$_POST['pseudo'];
}

afficher_en_tete();
afficher_conversation($_SESSION['pseudo'],$_SESSION['desti']);
afficher_pied_de_page();
?>