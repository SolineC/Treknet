<?php
require_once("fonctions.php");

require_once("fonctions_affichage.php");

session_start();

bloquer_sans_session();

/*commentaire inutile*/

afficher_accueil();

?>