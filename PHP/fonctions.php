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


?>
