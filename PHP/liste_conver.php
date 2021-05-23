<?php
session_start();
require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");

bloquer_sans_session();


$connexion = connexion('treknet');


$req = "SELECT pseudo, photo_de_profil,num_profil,num_section FROM `Profil` WHERE num_profil in 
(Select num_profil_suivi from abonnement where num_profil_suivant='".$_SESSION['num_profil']."') AND num_profil in (Select num_profil_suivant from abonnement where num_profil_suivi='".$_SESSION['num_profil']."')
AND num_profil != '".$_SESSION['num_profil']."'";
$res = requete1($req, $connexion);




afficher_en_tete();
?>
<audio autoplay>
        <source src="..\Musique\Main Computer.mp3" type="audio/mpeg" >
    </audio>

    <?php   
echo '<div class="blank"></div>';
while ($ligne=mysqli_fetch_assoc($res)){
afficher_conver($ligne['pseudo'], $ligne['photo_de_profil'],$ligne['num_profil'],$ligne['num_section']);
echo '<br>';

}
afficher_conver_instruction();
afficher_pied_de_page();

?>