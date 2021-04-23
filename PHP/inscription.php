<?php
session_start();
require_once("fonctions_bd.php");


if ($_SERVER['REQUEST_METHOD']== "POST"){
    $pseudo= $_POST['pseudo'];
    $email= $_POST['mail'];
    $mot_de_passe= $_POST['mot_de_passe'];
    $num_section= $_POST['Section'];
    $req ="insert into profil (pseudo,email,mot_de_passe,num_section) values ('$pseudo','$email','$mot_de_passe','$num_section')";
    $con= mysqli_connect("localhost","root","","treknet");
    requete($req, $con);
    header("Location: connexion.php");
    die;
}
?>
