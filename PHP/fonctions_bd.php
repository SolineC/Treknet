<?php

function connexion($base){
    $connexion = mysqli_connect ('localhost','trekuser','5dBh3t*57nNhHDJv',$base);
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
    $connexion=connexion('treknet');
    $requete2="SELECT MAX(num_profil) FROM profil";
    $resultat2=requete($requete2,$connexion);
    $num = $resultat2['MAX(num_profil)']+1;
    $req= "INSERT INTO profil (pseudo,email,mot_de_passe,num_section,num_grade,photo_de_profil,langue,espece,num_profil)    
    VALUES ('$pseudo','$email','$mot_de_passe','$num_section','0','../Images/Profil/pp_defaut.png','$langue','$espece','$num');";
    requete1($req,$connexion);

    $req3 = "INSERT INTO abonnement (num_profil_suivi, num_profil_suivant) VALUES ($num,$num)";
    requete1($req3,$connexion);
    
    header("Location: index.php");
}


function creer_message($pseudo, $destinataire,$mess){
    $req= "INSERT INTO message (expediteur,destinataire,date_message)    
    VALUES ('$pseudo',$destinataire,$mess);";
    requete1($req,connexion('treknet'));
    header("Location: traitement_messagerie.php");
}

function montrer_message($pseudo, $destinataire){
    $req=" SELECT * FROM message WHERE expediteur='$pseudo' OR 
    destinataire='$destinataire' OR expediteur='$destinataire' OR destinataire = '$pseudo' ORDER BY date_message ASC;";
    $res = requete1($req, connexion('treknet'));
    while ($row=msqli_fetch_assoc($res));
        if (strcmp($row['expediteur'],$pseudo) && strcmp($row['destinataire'],$destinataire)){
            afficher_mess_droite($row['message']);
        } else if (strcmp($row['destinataire'],$pseudo) && strcmp($row['expediteur'],$destinataire)){
            afficher_mess_gauche($row['message']);
        }

}

?>
