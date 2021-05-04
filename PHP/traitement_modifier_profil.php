<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions.php");
require_once("fonctions_affichage.php");

$connexion = connexion("treknet");


if ($_SERVER['REQUEST_METHOD']== "POST"){
    $pseudo= preTraiterChampSQL($_POST['pseudo'],$connexion);
    $email= preTraiterChampSQL($_POST['email'],$connexion);
    $espece= $_POST['espece']; //pas besoin de preTraiter
    $langue= $_POST['langue'];

    if (compteExiste($connexion,$pseudo,$email)){
        $pseudo=$_SESSION['pseudo'];
        $email=$_SESSION['email'];
        afficher_modifier( "Utilisateur avec le même pseudo ou email");
        exit();
    }
    if (empty($pseudo)){
        $pseudo=$_SESSION['pseudo'];
    }
    if (empty($email)){
        $email=$_SESSION['email'];
    }
    
    if (($espece ==0)){
        $espece=$_SESSION['espece'];
    }
    if (($langue==0)){
        $langue=$_SESSION['langue'];
    }


    if (invalidePseudo($pseudo)){
        $pseudo=$_SESSION['pseudo'];
    }

    if (invalideEmail($email)){
        $email=$_SESSION['email'];
    }


    
    if (empty($_POST['mot_de_passe'])){
        modifierProfil($pseudo,$email,$espece,$langue);    
        exit();
    } else {
        $mot_de_passe= preTraiterChampSQL(password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),$connexion);
        modifierProfilpwd($pseudo,$email,$mot_de_passe,$espece,$langue);    
        exit();
    }

    header("Location: modifier_profil.php");

    }
 


?>
