<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");

bloquer_sans_session();


$connexion = connexion("treknet");

if (isset($_POST['mess'])){

}

?>