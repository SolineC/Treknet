<?php


function afficher_en_tete(){

    switch($_SESSION["couleur"]){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
?>

<!DOCTYPE html>
<html>

<head>

    <title>Treknet</title>
    <link rel="icon" type="image/png" sizes="16x16" href="logopng.png">
    <link rel="stylesheet" href="../fontawesome-free-5.15.2-web/fontawesome-free-5.15.2-web/css/all.css">
    <link rel="stylesheet" href="../CSS/style_recherche.css">
    <link rel="stylesheet" href="../CSS/style_general.css" >
    
    
</head>

<?php echo '<body style="background-color:'.$color.';">'; ?>
    <div class="wrap">
        <div class="menu">
            <a href="accueil.php" class="logo">treknet</a>
            <div class="recherche">
                <form action="recherche.php" method="GET">
                    <input class="input-recherche" name="search" type="text" placeholder="Chercher un trekker">
                    <input type="hidden" name="searchtype" value="pseudo">
                    <button class="sub-search" type="submit"><i class="fas fa-search"></i></button>
                </form>    
            </div>
        
            <nav>
                <ul>
                    <li><a href="accueil.php" title="Accueil"><i class="fas fa-home"></i></a></li>
                    <li><a href ="main.html" title="Nouvelle publication"><i class="fas fa-plus"></i></a></li>
                    <li><a href ="#" title="Envoyer un message"><i class="fas fa-paper-plane"></i></a></li>
                    <li><a href ="profil.php" title="Modifier le profil"><i class="fas fa-cog"></i></a></li>
                    <?php
                        if($_SESSION["grade"]>=10){
                            echo '<li><a href ="profil.php" title="Gérer les utilisateurs"><i class="fas fa-user-cog"></i></a></li>"';
                        }
                    ?>
                    <li><a href ="#"><i class="fas fa-sign-out-alt"></i></a></li>     
                </ul>
            </nav>
        </div>


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
                            <li><a href="#">Conditions d'utilisation </a></li>
                            <li><a href="#">Politiques de données</a></li>
                            <li><a href="#">Mentions Légales</a></li>
                        </ul>
                    </div>
                    <div class= "footer-col">
                        <h3>RETROUVEZ-NOUS SUR LES RESEAUX</h3>
                        <ul>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Youtube</a></li>
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
                    
                </div>
            </div>
        </footer>
    </div>

</body>
</html>
    

<?php
}


function afficher_profil($pseudo, $chemin){
    switch($_SESSION["couleur"]){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    ?>
    <div class="boite-profil">
        <img class="pp" src=<?php echo $chemin ?> alt="photo de profil">  <!--petites boites lors de recherche de membres -->
        <?php echo '<p class="pseudo">', $pseudo , '</p>'; ?>
        <?php echo '<div class="indicateur-section" style="background-color:'.$color.';"></div>' ?>
    </div>
    

    <?php
}

function afficher_utilisateur(){
    if(isset($_SESSION["pseudo"])){
        
    ?>
    <div class="boite-utilisateur">
        <?php echo '<img class="pp big" src="'.$_SESSION["photo"].'" alt="photo de profil">';?>
        <h3><?php echo $_SESSION['pseudo'] ?></h3>
    </div>
    <?php
    }
}

function afficher_erreurs($message){
    
        echo '<p class="erreur">',$message,'</p>';
    

}

function afficher_connexion($message){
    ?>
    <!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Where no man has gone before</title>

</head>

<body>
   

    <main>


        <div class="logo">

            <h1>treknet</h1> 
            <p>le réseau des trekkies par exellence</p>

        </div>
        <?php
            afficher_erreurs($message);
        ?>

        <div class="connexion">

            <form action="../PHP/traitement_connexion.php" method="POST">

            <input type="text" class="input"  name="pseudo" required="required" placeholder="Pseudo">
            <input type="password" class="input" name="mot_de_passe" required="required" placeholder="Mot de Passe">
            <input type="submit" class="bouton" value="CONNEXION" >
            <a class="mdp" href="#">Mot de passe oublié ?</a>
            <!-- <input type="submit" value="" class="input" placeholder="CONNEXION"> -->
            <a href="../PHP/inscription.php" class="bouton">Inscription</a>
        </form>

        </div>
        
    </main>
   
</body>

</html>
<?php
}

function afficher_accueil(){
    afficher_en_tete();
    afficher_utilisateur();
    afficher_pied_de_page();

}


?>
