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


function compteExiste($connexion,$pseudo,$email){
    $req = "SELECT count(*) FROM profil where pseudo = '$pseudo' OR email = '$email' ";
    $resultat=requete( $req,connexion('treknet'));
    $count = $resultat['count(*)'];
    return ($count != 0 );
}



function creerProfil($pseudo,$email,$mot_de_passe,$num_section,$espece){
    $connexion=connexion('treknet');
    $requete2="SELECT MAX(num_profil) FROM profil";
    $resultat2=requete($requete2,$connexion);
    $num = $resultat2['MAX(num_profil)']+1;
    $req= "INSERT INTO profil (pseudo,email,mot_de_passe,num_section,num_grade,photo_de_profil,espece,num_profil,admi)    
    VALUES ('$pseudo','$email','$mot_de_passe','$num_section','0','../Images/Profil/pp_default.png','$espece','$num','0');";
    requete1($req,$connexion);

    $req3 = "INSERT INTO abonnement (num_profil_suivi, num_profil_suivant) VALUES ($num,$num)";
    requete1($req3,$connexion);
    
    header("Location: ../index.php");
}




function modifierProfilpwd($pseudo,$email,$mot_de_passe,$description,$espece){   

    $connexion=connexion('treknet');
    $num_profil=$_SESSION['num_profil'];
    $req= "UPDATE profil SET pseudo='$pseudo', email='$email', mot_de_passe= '$mot_de_passe', description= '$description' ,  espece ='$espece' WHERE num_profil='$num_profil';";
    requete1($req,$connexion);
    $_SESSION['pseudo']=$pseudo;
    $_SESSION['email']= $email;
    $_SESSION['espece']=$espece;
    
    header("Location: modifier_profil.php");
}


function modifierProfil($pseudo,$email,$description,$espece){
$connexion=connexion('treknet');
    $num_profil=$_SESSION['num_profil'];
    $req= "UPDATE profil SET pseudo='$pseudo', email ='$email', description= '$description', espece='$espece' WHERE num_profil='$num_profil';";
    requete1($req,$connexion);
    $_SESSION['pseudo']=$pseudo;
    $_SESSION['email']= $email;
    $_SESSION['description']=$description;
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
    $req = "SELECT * FROM profil where pseudo = '$pseudo' ";
    $resultat=requete( $req,connexion('treknet'));
    $diff=date_diff(date_create($resultat['date_inscription']),date_create($fecha));
    $days = $diff->format("%a");
    while($i<count($condi)){
        if ($days>$condi[$i]){
            $grade=$i+1;
        }
            $i=$i+1;
     }

    if ($resultat['admi']==1){
        $grade=11;
    }
     $req= "UPDATE profil SET num_grade='$grade' WHERE pseudo='$pseudo';";
    requete1($req,connexion('Treknet'));         
}

function creer_message($pseudo, $destinataire,$mess){
    $req= "INSERT INTO message (expediteur,destinataire,mess) VALUES ('$pseudo','$destinataire','$mess' );";
    requete1($req,connexion('treknet'));
    header("Location: conver.php");
}

function montrer_message($pseudo, $destinataire){
    $req1=" SELECT * FROM message WHERE (expediteur='$pseudo' AND  destinataire='$destinataire') OR (expediteur='$destinataire' AND  destinataire='$pseudo') ORDER BY date_message DESC;";

    $res = requete1($req1, connexion('treknet'));

    while($row=mysqli_fetch_array($res)){
    if (strcmp($row['expediteur'],$pseudo) && strcmp($row['destinataire'],$destinataire)){
            afficher_mess_droite($row['mess']);
        } else if (strcmp($row['destinataire'],$pseudo) && strcmp($row['expediteur'],$destinataire)){
            afficher_mess_gauche($row['mess']);
        }
    }
}


?>