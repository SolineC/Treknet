<?php
function bloquer_sans_session(){
    if(!isset($_SESSION["pseudo"])){
        afficher_connexion(""); //page formulaire préremplie avec login, si dispo
        exit;
    }
}

function preTraiterChampSQL($champ, $connexion) {  
    
    if (!empty($champ)) {    
        $champ = trim($champ);        
        $champ = mysqli_real_escape_string($connexion, htmlspecialchars($champ));
        
    }
    return $champ;
}

function logout(){
    $_SESSION = array();
    session_destroy();
}

function getAdresse(){

    $url= pathinfo($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])["basename"];

    return $url;
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

?>
