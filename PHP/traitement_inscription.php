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
    $requete2="SELECT MAX(num_profil) FROM profil";
    $resultat=requete1($requete,$connexion);
    $resultat2=requete($requete2,$connexion);
    $count = $resultat['count(*)'];
    $num = $resultat2['MAX(num_profil)']+1;

    if($count == 0){
        $req ="insert into profil (num_profil,pseudo,email,mot_de_passe,num_section,num_grade,photo_de_profil)
        values ('$num','$pseudo','$email','$mot_de_passe','$num_section',0, '$image')";
        requete1($req, $connexion);

        

        $req3 = "INSERT INTO abonnement (num_profil_suivi, num_profil_suivant) VALUES ($num,$num)";
        requete1($req3,$connexion);

        header("Location: index.php");
        die;
    }
    else{
        afficher_inscription("Pseudo ou adresse mail déja utilisé(s)");
    }
}
?>
