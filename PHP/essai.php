<?php
session_start();

require_once("fonctions_affichage.php");
require_once("fonctions_bd.php");
afficher_en_tete();
$connexion=connexion('treknet');
$num=$_SESSION["num_profil"];
echo "<br>";
echo "<br>";
echo "<br>";

$np=$_SESSION["num_profil"];
$ns=5;
$req6="SELECT COUNT(*) FROM abonnement WHERE num_profil_suivant='".$np."' AND num_profil_suivi='".$ns."'";
$res6=requete($req6,$connexion);

    if($res6["COUNT(*)"]!=0) {
        
        $abo=0;
        echo $abo;


    }
echo "<br>";
echo $res6["COUNT(*)"];


?>
   
   