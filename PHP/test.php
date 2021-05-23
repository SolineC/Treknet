<?php
require_once("fonctions_affichage.php");
require_once("fonctions.php");

session_start();
bloquer_sans_session();
afficher_en_tete();
afficher_test("");
afficher_pied_de_page();

?>