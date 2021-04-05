<?php

function afficher_en_tete(){
?>

<!DOCTYPE html>
<html>

<head>

    <title>Treknet</title>
    <link rel="icon" type="image/png" sizes="16x16" href="logopng.png">
    <link rel = "stylesheet" href="../CSS/stylepk.css">
</head>

<body>
<nav>
    <ul>
        <li><a href ="main.html">ACCUEIL</a></li>
        <li><a href ="apropo.html">À PROPOS</a></li>
        <li><a href ="inscription.html">INSCRIPTION</a></li>
        <li><a href ="cours.html">COURS</a></li>
        <li><a href ="initiation.html">INITIATION</a></li>
        <li><a href ="medias.html">DANS LES MEDIAS</a></li>
        <li><a href ="contact.html/">CONTACT</a></li>
    </ul>
</nav>
</body>

<?php
} 
?>


<?php

function afficher_pied_de_page(){
    global $traduction;
 ?>
        <footer class= "footer">
    <div class= "container">
        <div class= "row">
            <div class= "footer-col">
                <h3>MENTIONS LEGALES</h3>
                <ul>
                    <li><a href="https://decathlon.fr"> <?php echo $traduction["Conditions utilisation"]; ?> </a></li>
                    <li><a href="https://www.fsgt.org/">Politiques de données</a></li>
                    <li><a href="https://www.us-fontenay.com/">Copyright</a></li>
                </ul>
            </div>
            <div class= "footer-col">
                <h3>RETROUVEZ-NOUS SUR LES RESEAUX</h3>
                <ul>
                    <li><a href="https://fr-fr.facebook.com/ParkourFontenay/">Facebook</a></li>
                    <li><a href="https://www.instagram.com/parkour_fsb/">Instagram</a></li>
                    <li><a href="https://www.youtube.com/channel/UCu6uGPnipaefRu0nxM-L-8A">Youtube</a></li>
                </ul>
            </div>
            <div class= "footer-col">
                <h3>QUI SOMMES-NOUS ?</h3>
                <ul>
                    <li><a href="apropo.html">À propos</a></li>
                    <li><a href="coach.html">Le projet</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class= "logo">
                <img classe="imglog" src="logopkf.jpg" alt="logo pkf" width="90" height="90">
            </div>
        </div>
    </div>
</footer>

</body>
</html>
    

<?php
}

?>
