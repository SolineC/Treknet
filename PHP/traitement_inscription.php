<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions.php");

$connexion = connexion("treknet");


if ($_SERVER['REQUEST_METHOD']== "POST"){
    $pseudo= preTraiterChampSQL($_POST['pseudo'],$connexion);
    $email= preTraiterChampSQL($_POST['mail'],$connexion);
    $mot_de_passe= password_hash(preTraiterChampSQL($_POST['mot_de_passe'],$connexion), PASSWORD_DEFAULT);
    $num_section= preTraiterChampSQL($_POST['section'],$connexion);
    $image="../Images/Profil/pp_default.png";

    $requete="SELECT COUNT(*) FROM profil WHERE pseudo = $pseudo OR email=$email";
    $resultat=requete1($requete,$connexion);
    $count = $resultat['count(*)'];

    if($count == 0){
        $req ="insert into profil (pseudo,email,mot_de_passe,num_section,num_grade,photo_de_profil)
        values ('$pseudo','$email','$mot_de_passe','$num_section',0, '$image')";
        requete1($req, $connexion);
        header("Location: index.php");
        die;
    }
    else{
        afficher_inscription("Pseudo ou adresse mail déja utilisé(s)");
    }
}
?>
