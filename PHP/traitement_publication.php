<?php
session_start();
require_once("fonctions.php");
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
bloquer_sans_session();


if(isset($_FILES['img_publication']) && isset($_POST['texte'])){

    $dossier = "../Images/Publications/";
    $fichier = $dossier . basename($_FILES['img_publication']['name']);   /**php.net manual */
    $ext=pathinfo($fichier)['extension'];
    $texte=$_POST['texte'];

    if($ext=="png" || $ext == "jpg" || $ext="jpeg"){
        if($_FILES['img_publication']['size']>500000){

            afficher_nouvelle_publication("Image trop grosse. Taille maximale : 500ko");
        }else {
            $connexion = connexion('treknet');
            $num=$_SESSION['num_profil'];
            $req1="SELECT MAX(num_publication) FROM `Publication`";

            $res=requete($req1, $connexion);
            $numid=$res['MAX(num_publication)'] +1;
            $fichier=$dossier.$numid.".".$ext;
        
            if(move_uploaded_file($_FILES['img_publication']['tmp_name'], $fichier)) {
    
                $req2="INSERT INTO publication (num_publication,image,texte,num_profil) VALUES ('$numid','$fichier','$texte','$num')";
                requete1($req2,$connexion);
        
                header("Location: accueil.php");
       
            }else{
                afficher_nouvelle_publication("Erreur, veuillez réessayer. Erreur probable : Image trop grosse. Taille maximale : 200ko");
            }
        }
    }else{
        afficher_nouvelle_publication("Format de l'image non accepté. Formats acceptés : png, jpg, jpeg.");
    }
}











?>