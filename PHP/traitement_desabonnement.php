<?php
session_start();
require_once("fonctions.php");
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
bloquer_sans_session();



$connexion=connexion('treknet');

if(isset($_POST['num_suivi'])){
    $num_suivant=$_SESSION['num_profil'];
    $num_suivi=$_POST['num_suivi'];
    $req="DELETE FROM `Abonnement` WHERE num_profil_suivant=$num_suivant AND num_profil_suivi=$num_suivi";
    requete1($req,$connexion);

    $loc="Location: ".$_POST["page"];  
    header($loc);
    
}else{
    echo "erreur";
}


?>