<?php

session_start();
require_once("fonctions.php");
require_once("fonctions_affichage.php");
require_once("fonctions_bd.php");
bloquer_sans_session();

if(isset($_POST['num_profil'])){
    $num=$_POST['num_profil'];
}
else{
    $num=$_SESSION["num_profil"];
}

$connexion=connexion('treknet');
$req="SELECT * FROM profil JOIN grade ON profil.num_grade = grade.num_grade WHERE num_profil='".$num."'";
$res=requete($req,$connexion);


afficher_page_profil($num,$res);
?>