<?php
session_start();
require_once("fonctions.php");
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
bloquer_sans_session();

if(isset($_POST["num_pub"])){
    $num_pub=$_POST["num_pub"];

   
    $connexion=connexion('treknet');
    $req="DELETE FROM publication WHERE num_publication='".$num_pub."'";


    requete1($req,$connexion);
    $loc="Location: ".$_POST["page"];
    header($loc);
}


?>