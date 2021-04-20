<?php

require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");

$connexion = connexion('treknet');

$rech = mysqli_real_escape_string($connexion, $_GET['search']);
#$req = "SELECT pseudo FROM `Profil` WHERE pseudo LIKE \"%%\"";
$req = "SELECT pseudo, photo_de_profil FROM `Profil` WHERE pseudo LIKE \"%$rech%\"";
$res = requete($req, $connexion);

afficher_en_tete();

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

while ($ligne=mysqli_fetch_assoc($res)){
afficher_profil($ligne['pseudo'], $ligne['photo_de_profil']);
echo "<br>";
}

afficher_pied_de_page();

?>