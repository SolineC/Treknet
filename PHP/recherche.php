<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");
bloquer_sans_session();

$connexion = connexion('treknet');

$rech = mysqli_real_escape_string($connexion, $_GET['search']);
#$req = "SELECT pseudo FROM `Profil` WHERE pseudo LIKE \"%%\"";
$req = "SELECT pseudo, photo_de_profil FROM `Profil` WHERE pseudo LIKE \"%$rech%\"";
$res = requete1($req, $connexion);

afficher_en_tete();

afficher_utilisateur();


//echo '<div class="blank"></div>';

echo '<div class="boite-recherche">';
    #afficher_profil("Soline", "../Images/Profil/soline.jpeg");


while ($ligne=mysqli_fetch_assoc($res)){
afficher_profil($ligne['pseudo'], $ligne['photo_de_profil']);
echo "<br>";
}


afficher_publications();

afficher_pied_de_page();

?>