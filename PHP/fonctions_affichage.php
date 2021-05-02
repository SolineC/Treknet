

<?php

require_once("fonctions_bd.php");
require_once("fonctions.php");




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
                    <!-- <input type="hidden" name="searchtype" value="pseudo"> -->
                    <input type="hidden" name="page" value="<?php echo getAdresse();?> ">
                    <button class="sub-search" type="submit"><i class="fas fa-search"></i></button>
                </form>    
            </div>
        
            <nav>
                <ul>
                    <li><a href="accueil.php" title="Accueil"><i class="fas fa-home"></i></a></li>
                    <li><a href ="publication.php" title="Nouvelle publication"><i class="fas fa-plus"></i></a></li>
                    <li><a href ="#" title="Envoyer un message"><i class="fas fa-paper-plane"></i></a></li>
                    <li><a href ="profil.php" title="Modifier le profil"><i class="fas fa-cog"></i></a></li>
                     <?php
                        //if($_SESSION["grade"]>=10){
                           // echo '<li><a href ="profil.php" title="Gérer les utilisateurs"><i class="fas fa-user-cog"></i></a></li>"';
                        //}
                    ?> 
                    <li><a href ="../PHP/deconnexion.php"><i class="fas fa-sign-out-alt"></i></a></li>     
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
                            <li><a href="#">À propos</a></li>
                            <li><a href="#">Le projet</a></li>
                            <li><a href="#">Contact</a></li>
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


function afficher_profil($pseudo, $chemin,$oui,$num,$couleur){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    ?>
   <?php echo'<div style="background-color:'.$color.';" class="boite-profil">';?>
        <img class="pp" src=<?php echo $chemin ?> alt="photo de profil">  <!--petites boites lors de recherche de membres -->
        <form action="profil.php" method="post">
        <?php echo '<input type="submit" class="pseudo" value='.$pseudo.'>'; ?>
        
        <input type="hidden" name="num_profil" value=<?php echo $num;?>>
        </form><?php
        afficher_abonnement($oui,$num);       
        

        ?>
        
    </div>
    

    <?php
}

function afficher_page_profil($num,$tab_user){
    afficher_en_tete();
    afficher_utilisateur($tab_user);

    $connexion=connexion('treknet');
    
    $req="SELECT * FROM `Publication` LEFT JOIN `Abonnement` 
    ON publication.num_profil = abonnement.num_profil_suivi JOIN `Profil` 
    ON publication.num_profil = profil.num_profil WHERE abonnement.num_profil_suivant='".$num."' AND abonnement.num_profil_suivi='".$num."'
    ORDER BY publication.num_publication DESC";
    $res = requete1($req,$connexion);
    $req2="SELECT COUNT(*) FROM profil WHERE num_profil IN 
    (SELECT num_profil_suivi FROM abonnement WHERE num_profil_suivant='".$num."') AND num_profil != '".$num."'";
    $res2=requete($req2,$connexion);
    $req3="SELECT COUNT(*) FROM profil WHERE num_profil IN 
    (SELECT num_profil_suivant FROM abonnement WHERE num_profil_suivi='".$num."') AND num_profil != '".$num."'";
    $res3=requete($req3,$connexion);

    while($ligne=mysqli_fetch_array($res)){
        $image=$ligne['image'];
        $texte=$ligne['texte'];
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        $date=$ligne['date_publication'];
        $num_pub=$ligne['num_publication'];

        afficher_publication($image,$texte,$pp,$pseudo,$couleur,$date,1,$num_pub);
        
    
    }

    echo "Mon equipage : ".$res2["COUNT(*)"]." | ".$res3["COUNT(*)"];
    
afficher_pied_de_page();
}



function afficher_abonnement($oui,$num){
    if($oui==0){
        ?>
        <form action="traitement_abonnement.php" method="post">
        <?php echo '<input type="hidden" name="num_suivi" value="'.$num.'">';?>
        <?php echo '<input type="hidden" name="page" value="'.getAdresse().'">';?>
        <input type="submit" value="+" class="abo">
  </form>
  <?php
    }
}

function afficher_utilisateur($tab_user){
   
    ?>
    <div class="boite-utilisateur">
        <div class="face front">
            <?php echo '<img class="pp big" src="'.$tab_user["photo_de_profil"].'" alt="photo de profil">';?>
            <p class="username"><?php echo $tab_user['pseudo'] ?></p>
            <div class="infos">
            <p><?php echo $tab_user['nom_grade'] ?></p>
            <p><?php echo $tab_user['espece'] ?></p>
            <p>Membre depuis le : <?php echo $tab_user['date_inscription'] ?></p>
            </div>
        </div>
        <div class="face back">
            <div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere nesciunt neque commodi consequatur, sit odio ab, porro, dolor aspernatur hic voluptates omnis tenetur ullam? Iusto eum quae error inventore maiores voluptates at omnis, amet, nemo numquam quos obcaecati ut consectetur reiciendis! Similique praesentium minus nemo sit velit dicta quia mollitia?.</p>
            </div>
        </div>
        
    </div>
    <?php
    
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
    
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/style.css">
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
                <a class="mdp" href="PHP/forgot_password.php">Mot de passe oublié ?</a>
                <a href="../Treknet/PHP/inscription.php" class="bouton">Inscription</a>
            </form>
        </div>    
    </main>  
</body>
</html>
<?php
}

function afficher_inscription($message){
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
        <div class="blocInscription">
        <form action="traitement_inscription.php" method="post" class="formulaire">
                    
                    <input type="text" name="pseudo" class="input" required="required" placeholder="Pseudo">
                    <input type="email" name="mail" class="input" required="required" placeholder="Adresse Mail">
                    <input type="password" name="mot_de_passe" class="input" placeholder="Mot de Passe">
                

                    <select name="section" class="deroul" >
                        <option value=0 >Section</option>
                        <option value=1 class="jaune">Opérations</option>
                        <option value=2 class="bleu">Scientifiques</option>
                        <option value=3 class="rouge">Navigation</option>
                    
                    </select> 

                    <select name="espece" class="deroul" >
                        <option value=0 >Espèce</option>
                        <option value=Humain>Humain</option>
                        <option value=Vulcan >Vulcain</option>
                        <option value=Andorian >Andorian</option>
                        <option value=Tellarite >Tellarite</option>
                    
                    </select> 

                    <select name="langue" class="deroul" >
                        <option value=0 >Langue</option>
                        <option value=English >English</option>
                        <option value=Español >Español</option>
                        <option value=Français >Français</option>
                    
                    </select> 
                
                    <input type="submit" class="bouton" value="Inscription">  
                    <a href="../index.php" class="bouton">Connexion</a> 
            </form>
        </div>   
        
    </main>  
</body>
</html>
<?php
}

function afficher_cote_gauche(){
    ?>
    <aside class="gauche">

        <p>Tableau de bord</p>
        <div>
            
        <?php

        echo $_SESSION['grade']." ".$_SESSION["pseudo"];
        echo "<br>";
       
        echo "<br>";
        echo "> Connecté(e)"
          
        ?>
        </div>
        <a href="profil.php" title="Voir le profil">Voir mon profil</a>
        <div>> Flux des publications à jour</div>

        
    </aside>

<?php
}

function afficher_cote_droit(){
    ?>
    <aside class="droit">
        <a href="messagerie.php" title="Envoyer un message">test</a>
    </aside>

<?php
}

function afficher_accueil(){
    afficher_en_tete();
    afficher_cote_gauche();

    #afficher_utilisateur();
    /*echo "<br>";

    echo "<br>";
                                            #pour le debuggage
    echo "<br>";

    echo "<br>";*/

    
    #echo '<a href="test.php">Test</a>';
    afficher_publications(0);
    afficher_cote_droit();
    afficher_pied_de_page();
}

function afficher_publication($image, $texte, $pp, $pseudo,$couleur,$date,$siprofil,$num_pub){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    if($_SESSION["num_grade"]>7){
        $siprofil=1;
    }
    
    if($siprofil==0){
    ?>
        <div class="blank"></div>
        <div class="boite-publication">
            <?php echo '<div class="publicateur" style="background-color:'.$color.';">'; ?>  
            
                <img src="<?php echo $pp; ?>" class="pp" alt="photo de profil">
                <p><?php echo $pseudo; ?></p>
                <p><?php echo $date; ?></p>
                
                
            </div>
            <img src="<?php echo $image; ?>" class="img-pub" alt="image publication">
            <p><?php echo $texte;?></p>   
        </div>
    <?php
    }else{
        ?>
        <div class="blank"></div>
        <div class="boite-publication prof">
            <form action="traitement_suppression.php" method="post">
                <input title="Supprimer la publication" class="suppr" type="submit" value="×">
                <input type="hidden" name="num_pub" value="<?php echo $num_pub; ?>">
                <input type="hidden" name="page" value="<?php echo getAdresse(); ?>">
            </form>
            <?php echo '<div class="publicateur" style="background-color:'.$color.';">'; ?>  
        
            <img src="<?php echo $pp; ?>" class="pp" alt="photo de profil">
            <p><?php echo $pseudo; ?></p>
            <p><?php echo $date; ?></p>
        </div>
        <img src="<?php echo $image; ?>" class="img-pub" alt="image publication">
        <p><?php echo $texte;?></p>   
        </div>
    <?php
    }
}

function afficher_publications($siprofil){
    $connexion=connexion('treknet');
    $num=$_SESSION["num_profil"];
    $req="SELECT * FROM `Publication` LEFT JOIN `Abonnement` 
    ON publication.num_profil = abonnement.num_profil_suivi JOIN `Profil` 
    ON publication.num_profil = profil.num_profil WHERE abonnement.num_profil_suivant='".$num."'
    ORDER BY publication.num_publication DESC";
    $res = requete1($req,$connexion);

    while($ligne=mysqli_fetch_array($res)){
        $image=$ligne['image'];
        $texte=$ligne['texte'];
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        $date=$ligne['date_publication'];

        afficher_publication($image,$texte,$pp,$pseudo,$couleur,$date,$siprofil,$ligne['num_publication']);
    
    }
}


function afficher_nouvelle_publication($message){
    session_start();

    afficher_en_tete();
    
    switch($_SESSION['couleur']){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
?>

 <div class="blank"></div>
    <?php afficher_erreurs($message);?>

 <div class="form-sub">
 <?php echo '<div class="publicateur" style="background-color:'.$color.';">'; ?>
    <img src="<?php echo $_SESSION['photo']; ?>" class="pp" alt="photo de profil">
                <p><?php echo $_SESSION['pseudo']; ?></p>
                <p><?php echo date('Y-m-d'); ?></p>
 </div>
  <!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
  <form enctype="multipart/form-data" action="traitement_publication.php" method="post">
    <!-- MAX_FILE_SIZE doit précéder le champs input de type file -->
    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
    <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES --> 
    <div class="img-sub">
        <input name="img_publication" value="+"  type="file" />
    </div> 
    <input type="text" name="texte" maxlength="1000" class="txt-sub" placeholder="Mon message">
    <input type="submit" value="Publier" class="bouton"/>
  </form>
 
</div>

<?php
afficher_pied_de_page();
}



function afficher_message_droite($message){
    ?>
    <div class="conversation">
    <div class="talk r">
        <p><?php echo $message ?></p>
    </div>
    <?php
}

function afficher_message_gauche($message){
    ?>
    <div class="conversation">
    <div class="talk l">
        <p><?php echo $message ?></p>
    </div>
    <?php
}

function afficher_conversation($pseudo,$des){
    ?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport"
    content="width=device-width,initial-sale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../CSS/style_messagerie.css">

</head>
<body>
<div class= "chat-global">

     <div class="nav-top">

        <div class="location">
            <img src="../Images/Messagerie/Chevron_left.svg.png" > 
            <a href="accueil.php" title="Accueil"class="p">Black</a>
        </div>

        <div class="nom_inter">
            <p>Ana</p> <!-- Nom interlocuteur -->
        </div>
    </div>
    <?php    montrer_message($pseudo, $des);?>

    </div>
    <div class="chat-form">

            <form class="barra">
                    <div class="group-inp">
                        <form action="traitement_messagerie.php" method="post">
                        <input type="text" placeholder="Ecris un message" class= "text" name="mess" minlength="1" maxlength="1000">
                        <input type="submit" class="submit-msg-btn" alt="../PHP/traitement_messagerie.php">
                        </button>
                        </form>
                    </div>
            </form>

    </div>
</div>
</body>
<?php
}

