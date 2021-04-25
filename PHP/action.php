<?php
session_start();
require_once("fonctions.php");
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");


function preTraiterChampSQL($champ, $connexion) {  
    
    if (!empty($champ)) {    
        $champ = trim($champ);        
        $champ = mysqli_real_escape_string($connexion, htmlspecialchars($champ));
        
    }
    return $champ;
}


if(isset($_POST['pseudo']) && isset($_POST['mot_de_passe'])){
    $connexion = connexion("treknet");
    $pseudo = preTraiterChampSQL($_POST['pseudo'], $connexion);
    $mdp = preTraiterChampSQL($_POST['mot_de_passe'], $connexion);  /*hachage du mot de passe : password_hash($mdp, PASSWORD_DEFAULT); */

    if($pseudo !== "" && $mdp !== ""){
            $requete = "SELECT count(*) FROM profil where pseudo = '".$pseudo."' and mot_de_passe = '".$mdp."' ";
            $resultat = mysqli_query($connexion,$requete);
            $reponse  = mysqli_fetch_array($resultat);
            $count = $reponse['count(*)'];
            if($count != 0){
                $_SESSION['pseudo'] = $pseudo;
                afficher_accueil();
            }
            else{
                afficher_connexion("Pseudo ou mot de passe incorrect(s)");
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
        