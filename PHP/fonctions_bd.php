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
    VALUES ('$pseudo','$email','$mot_de_passe','$num_section','0','../Images/Profil/pp_default.png','$langue','$espece','$num');";
    requete1($req,$connexion);

    $req3 = "INSERT INTO abonnement (num_profil_suivi, num_profil_suivant) VALUES ($num,$num)";
    requete1($req3,$connexion);
    
    header("Location: acceuil.php");
}




function modifierProfilpwd($pseudo,$email,$mot_de_passe,$espece,$langue){   

    $connexion=connexion('treknet');
    $num_profil=$_SESSION['num_profil'];
    $req= "UPDATE profil SET pseudo='$pseudo', email='$email', mot_de_passe= '$mot_de_passe', langue='$langue', espece ='$espece' WHERE num_profil='$num_profil';";
    requete1($req,$connexion);
    $_SESSION['pseudo']=$pseudo;
    $_SESSION['email']= $email;
    $_SESSION['couleur'] = $couleur;
    $_SESSION['langue'] = $langue;
    $_SESSION['espece']=$espece;
    
    header("Location: modifier_profil.php");
}


function modifierProfil($pseudo,$email,$espece,$langue){
$connexion=connexion('treknet');
    $num_profil=$_SESSION['num_profil'];
    $req= "UPDATE profil SET pseudo='$pseudo', email ='$email', langue ='$langue', espece='$espece' WHERE num_profil='$num_profil';";
    requete1($req,$connexion);
    $_SESSION['pseudo']=$pseudo;
    $_SESSION['email']= $email;
    $_SESSION['couleur'] = $couleur;
    $_SESSION['langue'] = $langue;
    $_SESSION['espece']=$espece;
    header("Location: modifier_profil.php");
}

function modifierPhoto($photo){
    $connexion=connexion('treknet');
        $num_profil=$_SESSION['num_profil'];
        $req= "UPDATE profil SET photo_de_profil ='$photo' WHERE num_profil='$num_profil';";
        requete1($req,$connexion);
        header("Location: modifier_profil.php");
}

function modifierSection($num_section){
        $connexion=connexion('treknet');
    $num_profil=$_SESSION['num_profil'];
    $req= "UPDATE profil SET num_section='$num_section' WHERE num_profil='$num_profil';";
    $_SESSION['couleur']= $num_section;    
    requete1($req,$connexion);
    header("Location: accueil.php");
}
function grade(){
    $pseudo = $_SESSION['pseudo'];
    $i=0;
    $grade=0;
    $fecha= date("Y-m-d");
    $condi= array(1,7,15,30,60,80,120,240,300,365);
    $diff=date_diff(date_create($_SESSION['date']),date_create($fecha));
    $days = $diff->format("%a");
    while($i<count($condi)){
        if ($days>$condi[$i]){
            $grade=$i+1;
        }
            $i=$i+1;
     }
     $req= "UPDATE profil SET num_grade='$grade' WHERE pseudo='$pseudo';";
    requete1($req,connexion('Treknet'));    
     header("Location: accueil.php");
     
}

function creer_message($pseudo, $destinataire,$mess){
    $mess=preTraiterChampSQL($_POST['mess'],$connexion);
    $req= "INSERT INTO message (expediteur,destinataire,mess)    
    VALUES ('$pseudo','$destinataire','$mess' );";
    requete1($req,connexion('treknet'));
    
}

function montrer_message($pseudo, $destinataire){
    $req=" SELECT * FROM message WHERE expediteur='$pseudo' OR 
    destinataire='$destinataire' OR expediteur='$destinataire' OR destinataire = '$pseudo' ORDER BY date_message ASC;";
    $res = requete1($req, connexion('treknet'));
    while ($row=msqli_fetch_assoc($res));
        if (strcmp($row['expediteur'],$pseudo) && strcmp($row['destinataire'],$destinataire)){
            afficher_mess_droite($row['mess']);
        } else if (strcmp($row['destinataire'],$pseudo) && strcmp($row['expediteur'],$destinataire)){
            afficher_mess_gauche($row['mess']);
        }

}


?>