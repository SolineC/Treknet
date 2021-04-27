<?php

function connexion($base){
    $connexion = mysqli_connect ('localhost','root','',$base);
    if (!$connexion) {
        echo'Pas de  connexion  au  serveur'; 
        exit;
    }
    //echo'connexion réussie! <br/>';
    mysqli_set_charset($connexion ,'utf8');
    return $connexion;
}

function deconnexion_DB($connex){
    mysqli_close($connex);
}

function requete1($requete, $connex){
    
    $resultat = mysqli_query ($connex,$requete);
            if (!$resultat) {
                echo "requête  incorrecte";
                echo  mysqli_error($connex);
                }
            else {
                return $resultat;
            }
}
function requete($requete, $connex){
    
    $resultat = mysqli_query ($connex,$requete);
            if (!$resultat) {
                echo "requête  incorrecte";
                echo  mysqli_error($connex);
                }
            else {
                return mysqli_fetch_array($resultat);
            }
}
function image_bd($chemin, $connex){
    $req = "SELECT image FROM `Profil` WHERE image=$chemin";
    $resultat = mysqli_query ($connex,$req);
            if (!$resultat) {
                echo "requête  incorrecte";
                echo  mysqli_error($connex);
                }
            else {
                return $resultat;
            }
}

function vide($pseudo,$email,$mot_de_passe){
    $result;
    if (empty($pseudo) || empty($email)||empty($mot_de_passe)){
        $result=true;
    } else{
        $result=false;
    }
    return $result;

}

function invalidePseudo($pseudo){
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/",$pseudo)){
        $result=true;
    } else{
        $result=false;
    }
    return $result;

}

function invalideEmail($email){
    $result;
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $result=true;
    } else{
        $result=false;
    }
    return $result;
}

function compteExiste($connexion,$pseudo,$email){
    $req = "SELECT count(*) FROM profil where pseudo = '$pseudo' OR email = '$email' ";
    $resultat=requete( $req,connexion('treknet'));
    $count = $resultat['count(*)'];
    return ($count != 0 );
}



function creerProfil($pseudo,$email,$mot_de_passe,$num_section,$espece,$langue){
    $req= "INSERT INTO profil (pseudo,email,mot_de_passe,num_section,num_grade,photo_de_profil,langue,espece)    
    VALUES ('$pseudo','$email','$mot_de_passe','$num_section','0','../Images/Profil/pp_defaut.png','$langue','$espece');";
    requete1($req,connexion('treknet'));
    header("Location: index.php");
}

?>