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
    $req="INSERT INTO `Abonnement` (num_profil_suivi, num_profil_suivant) VALUES ('$num_suivi','$num_suivant')";
    requete1($req,$connexion);
    
    
    header("Location: accueil.php");
    
}else{
    echo "erreur";
}


?>