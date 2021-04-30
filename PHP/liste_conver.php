<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");

bloquer_sans_session();

$connexion = connexion('treknet');


$rech = mysqli_real_escape_string($connexion, $_GET['search']);
#$req = "SELECT pseudo FROM `Profil` WHERE pseudo LIKE \"%%\"";
$req = "SELECT pseudo, photo_de_profil, num_profil, num_section FROM `Profil` WHERE pseudo LIKE \"%$rech%\"";
$res = requete1($req, $connexion);



afficher_en_tete();

?>
<link rel="stylesheet" href="../CSS/style_messagerie.css" >
<?php
echo '<div class="list">';
 

while ($ligne=mysqli_fetch_assoc($res)){
    $req2="SELECT COUNT(*) FROM abonnement WHERE num_profil_suivant='".$_SESSION['num_profil']. "'AND num_profil_suivi='".$ligne['num_profil']."'";
    $res2=requete($req2,$connexion);
    
    afficher_profil($ligne['pseudo'], $ligne['photo_de_profil'],$res2['COUNT(*)'],$ligne['num_profil'],$ligne['num_section']);
    echo "<br>";
}





?>