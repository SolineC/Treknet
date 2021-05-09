<?php

require_once("fonctions_bd.php");
require_once("fonctions.php");
require_once("fonctions_affichage.php");
session_start();
bloquer_sans_session();
afficher_en_tete();

$connexion = connexion("treknet");

if ($_SERVER['REQUEST_METHOD']== "POST"){

    if ((!isset($_POST['q1']))||(!isset($_POST['q2']))||(!isset($_POST['q3']))||(!isset($_POST['q4']))||
    (!isset($_POST['q5']))||(!isset($_POST['q6']))){
        afficher_test("Vous devez répondre à toutes les questions");
        exit();
    }

    $total= $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] +$_POST['q6'];
    
    $num_section=2;

     if (($total>25)&&($total<35)){
        $num_section=1;
    } else if ($total>=35){
        $num_section=3;
    } 

    

    modifierSection($num_section);
}
?>
