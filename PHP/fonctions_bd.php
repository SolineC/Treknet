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

function deconnexion_DB() {
    mysql_close();
}

function requete($requete, $connex) {
    
    $resultat = mysqli_query ($connex,$requete);
            if (!$resultat) {
                echo "requête  incorrecte";
                echo  mysqli_error($connex);
                }
            else {
                return $resultat;
            }
}
/*$req = 'SELECT  FROM `grade`';
connexion('treknet');
requete($req,'treknet');
*/
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
?>