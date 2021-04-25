<?php
session_start();
require_once("fonctions.php");
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");




if(isset($_POST['pseudo']) && isset($_POST['mot_de_passe'])){
    $connexion = connexion("treknet");
    $pseudo = preTraiterChampSQL($_POST['pseudo'], $connexion);
    $mdp=preTraiterChampSQL($_POST['mot_de_passe'], $connexion);
    

    if($pseudo !== "" && $mdp !== ""){
            
            $requete = "SELECT count(*),mot_de_passe FROM profil where pseudo = '$pseudo'";
            $resultat = requete($requete,$connexion);   
            $count = $resultat['count(*)'];
            if($count != 0 ){
                if( password_verify($mdp,$resultat['mot_de_passe'])){ /*a suivre*/
                    
                    $_SESSION['pseudo'] = $pseudo;

                    $req = "SELECT num_grade, num_profil, langue, num_section, photo_de_profil FROM profil where pseudo = '".$pseudo."'";
                    $rep = requete($req,$connexion);
                    
                    $couleur = $rep['num_section'];
                    $langue = $rep['langue'];
                    $photo = $rep['photo_de_profil'];
                    $grade = $rep['num_grade'];
                    

                    $_SESSION['couleur'] = $couleur;
                    $_SESSION['langue'] = $langue;
                    $_SESSION['photo'] = $photo;
                    $_SESSION['grade'] = $grade;
                    $_SESSION['num_profil'] = $rep['num_profil'];
                
                    afficher_accueil();
                }
                else{
                    afficher_connexion('mot de passe incorrect');
                }
            }
            else{
                afficher_connexion("Pseudo incorrect");
            }
        }
    
    else{
        afficher_connexion("Il manque des champs !");
    }
}
else{
    afficher_connexion("");
}
deconnexion_DB($connexion);

?>
        