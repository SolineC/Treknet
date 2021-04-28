<?php

session_start();
require_once("fonctions.php");
require_once("fonctions_affichage.php");
require_once("fonctions_bd.php");
bloquer_sans_session();

if(isset($_POST['num_profil'])){
    $num=$_POST['num_profil'];
}
else{
    $num=$_SESSION["num_profil"];
}

afficher_page_profil($num);
?>