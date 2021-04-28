<?php

session_start();
require_once("fonctions.php");
require_once("fonctions_affichage.php");
require_once("fonctions_bd.php");
bloquer_sans_session();



afficher_en_tete();
afficher_utilisateur();

$connexion=connexion('treknet');
    $num=$_SESSION["num_profil"];
    $req="SELECT * FROM `Publication` LEFT JOIN `Abonnement` 
    ON publication.num_profil = abonnement.num_profil_suivi JOIN `Profil` 
    ON publication.num_profil = profil.num_profil WHERE abonnement.num_profil_suivant='".$num."' AND abonnement.num_profil_suivi='".$num."'
    ORDER BY publication.num_publication DESC";
    $res = requete1($req,$connexion);

    while($ligne=mysqli_fetch_array($res)){
        $image=$ligne['image'];
        $texte=$ligne['texte'];
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        $date=$ligne['date_publication'];
        $num_pub=$ligne['num_publication'];

        afficher_publication($image,$texte,$pp,$pseudo,$couleur,$date,1,$num_pub);
        
    
    }
afficher_pied_de_page();