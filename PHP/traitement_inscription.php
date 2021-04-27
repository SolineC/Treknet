<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions.php");
require_once("fonctions_affichage.php");

$connexion = connexion("treknet");


if ($_SERVER['REQUEST_METHOD']== "POST"){
    $pseudo= preTraiterChampSQL($_POST['pseudo'],$connexion);
    $email= preTraiterChampSQL($_POST['mail'],$connexion);
    $mot_de_passe= preTraiterChampSQL(password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),$connexion);
    $num_section= preTraiterChampSQL($_POST['section'],$connexion);
    $espece= preTraiterChampSQL($_POST['espece'],$connexion);
    $langue= preTraiterChampSQL($_POST['langue'],$connexion);
    $image="../Images/Profil/pp_default.png";


    if (vide($pseudo,$email,$mot_de_passe) || ($espece ==0) || ($num_section==0) || ($langue==0)){
        afficher_inscription("Champ(s) Manquant(s)");
        exit();
    }


    if (invalidePseudo($pseudo)){
        afficher_inscription("Pseudo invalide");
        exit();
    }

    if (invalideEmail($email)){
        afficher_inscription("Email invalide");
        exit();
    }


    if (compteExiste($connexion,$pseudo,$email)){
        afficher_inscription("Pseudo ou email déjà utilisé");
        exit();
    }
    creerProfil($pseudo,$email,$mot_de_passe,$num_section,$langue,$espece);    
} else {
        afficher_connexion("T'as bien été enregistré");
    exit();
    
}
?>
