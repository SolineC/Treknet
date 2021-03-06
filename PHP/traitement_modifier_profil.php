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
    
    if(isset($_FILES['photo']) ){

        $dossier = "../Images/Profil/";
        $fichier = $dossier . basename($_FILES['photo']['name']);   
        $ext=pathinfo($fichier)['extension'];
    
        if($ext=="png" || $ext == "jpg" || $ext="jpeg"){
            if($_FILES['photo']['size']>500000){
    
                afficher_modifier("Image trop grosse. Taille maximale : 500ko");
            }else {
                
                $fichier=$dossier. basename($_FILES['photo']['name']).".".$ext;
            
                if(move_uploaded_file($_FILES['photo']['tmp_name'], $fichier)) {
        
                    $req= "UPDATE profil SET photo_de_profil ='".$fichier."' WHERE num_profil='".$num_profil."';";
                     requete1($req,$connexion);
                     $_SESSION['photo_de_profil']=$fichier;
            
                    header("Location: accueil.php");
           
                }else{
                    afficher_modifier("Erreur, veuillez réessayer. Erreur probable : Image trop grosse. Taille maximale : 200ko");
                }
            }
        }else{
            afficher_modifier("Format de l'image non accepté. Formats acceptés : png, jpg, jpeg.");
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    ?>


?>
