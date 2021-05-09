<?php

require_once("fonctions_bd.php");



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
    <link rel="stylesheet" href="../CSS/style_messagerie.css">

    
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
                    <li><a href ="publication.php" title="Nouvelle publication"><i class="fas fa-plus"></i></a></li>
                    <li><a href ="liste_conver.php" title="Envoyer un message"><i class="fas fa-paper-plane"></i></a></li>
                    <li><a href ="modifier_profil.php" title="Modifier le profil"><i class="fas fa-cog"></i></a></li>
                    <?php
                        if($_SESSION["grade"]>=10){
                            echo '<li><a href ="profil.php" title="Gérer les utilisateurs"><i class="fas fa-user-cog"></i></a></li>"';
                        }
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
        
    </div>
    

    <?php
}



function afficher_utilisateur(){
    if(isset($_SESSION["pseudo"])){
        
    ?>
    <div class="boite-utilisateur">
        <div class="face front">
            <?php echo '<img class="pp big" src="'.$_SESSION["photo"].'" alt="photo de profil">';?>
            <p class="username"><?php echo $_SESSION['pseudo'] ?></p>
        </div>
        <div class="face back">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere nesciunt neque commodi consequatur, sit odio ab, porro, dolor aspernatur hic voluptates omnis tenetur ullam? Iusto eum quae error inventore maiores voluptates at omnis, amet, nemo numquam quos obcaecati ut consectetur reiciendis! Similique praesentium minus nemo sit velit dicta quia mollitia?.</p>
        </div>
        
    </div>
    <?php
    }
}

function afficher_erreurs($message){
    
        echo '<p class="erreur">',$message,'</p>';
    
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
                <a href="../PHP/inscription.php" class="bouton">Inscription</a>
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
                    <a href="../PHP/index.php" class="bouton">Connexion</a> 
            </form>
        </div>   
        
    </main>  
</body>
</html>
<?php
}


function afficher_test($message){
    afficher_erreurs($message);

?>

    <div class="blocInscription">
        <form action="traitement_test.php" method="post" class="formulaire">
            
    <p>Si l'un des moteur du vaisseau tombe en panne, mais vous ne savez pas comment le reparer. Que faites vous?</p>
    
            <input type="radio" name="q1" value="5"> 
            <label for="q1">Vous demandez de l'aide à quelqu'un d'autre</label> <br>
             <input type="radio" name="q1" value="1"> 
             <label for="q1">Vous lisez le manuel d'instructions de l'appareil</label> <br>
             <input type="radio" name="q1" value="10">
             <label for="q1">Vous essayez de le réparer avec vos connaissances, pas de chance si ça explose</label> <br>
    <p>Qu'est ce que vous offrez à l'équipage?</p>
             <input type="radio" name="q2" value="10">
             <label for="q2">Vos habilités techniques</label><br>   
             <input type="radio" name="q2" value="5"> 
             <label for="q2">Votre stratégie </label><br>   
             <input type="radio" name="q2" value="1">  
             <label for="q2">Votre intelligence</label><br>   


     <p>Quel est votre plus grand défaut?</p>

             <input type="radio" name="q3" value="1">
             <label for="q3"> Vous oubliez souvent de tenir compte des sentiments des autres </label> <br>
             <input type="radio" name="q3" value="10">  
             <label for="q3">Vous avez tendance à avoir des accidents</label> <br>
             <input type="radio" name="q3" value="5">  
             <label for="">Vous êtes litteralment parfait</label> <br>

    <p>À l'Academie Spacial vous aviez une certaine reputation... Vous étiez </p>

             <input type="radio" name="q4" value="1"> 
             <label for="q4"> L'élève le plus intelligent</label> <br>
             <input type="radio" name="q4" value="5">
             <label for="q4"> Le délégué</label> <br>
             <input type="radio" name="q4" value="10">
             <label for="q4"> Le bricoleur</label> <br>

    <p>Que faissiez lorsque vous aviez des mauvaises notes?</p>
             <input type="radio" name="q5" value="10">
             <label for="q5">Vous étudiez plus</label> <br>
             <input type="radio" name="q5" value="5"> 
             <label for="q5">Vous parliez avec le prof </label> <br>
             <input type="radio" name="q5" value="1">  
             <label for="q5">Vous aviez pas des mauvaises notes</label> <br>

   <p>Vous aterrisez sur une planete où les habitants peuvent dire que la verité ou bien que des mensonges. <br>
   Vous arriviez à un refuge où ils habitent deux hommes. Le premier dit que aucun des deux peut dire la verité. <br>
    Puis le deuxieme dit qu'ils ne veulent pas vous faire du mal.

   </p>
             <input type="radio" name="q6" value="5"> 
             <label for="q6">Le premier dit vrai, alors le deuxieme dit faux donc ils veulent vous faire du mal </label> <br>
             <input type="radio" name="q6" value="1"> 
             <label for="q6">Le premier dit faux, alors le deuxime dit vrai donc ils ne veulent pas vous faire du mal </label> <br>
             <input type="radio" name="q6" value="10"> 
             <label for="q6"> Vous tirez sur les deux, dans le cas où</label> <br>
<br>
<br>
        
            <input type="submit" class="bouton" value="Enregistrer">  
    </form>
</div> 
<?php
}

function afficher_accueil(){
    afficher_en_tete();
    afficher_utilisateur();
    /*echo "<br>";

    echo "<br>";
                                            #pour le debuggage
    echo "<br>";

    echo "<br>";

    echo '<a href="test.php">Test</a>';*/
    afficher_publications();
    afficher_pied_de_page();
}

function afficher_publication($image, $texte, $pp, $pseudo,$couleur,$date){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    ?>
    <div class="blank"></div>
    <!--  -->
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
}

function afficher_publications(){
    $connexion=connexion('treknet');
    $num=$_SESSION["num_profil"];
    $req="SELECT * FROM `Publication` LEFT JOIN `Abonnement` 
    ON publication.num_profil = abonnement.num_profil_suivi JOIN `Profil` 
    ON publication.num_profil = profil.num_profil WHERE abonnement.num_profil_suivant='".$num."'
    ORDER BY publication.date_publication DESC";
    $res = requete1($req,$connexion);

    while($ligne=mysqli_fetch_array($res)){
        $image=$ligne['image'];
        $texte=$ligne['texte'];
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        $date=$ligne['date_publication'];

        afficher_publication($image,$texte,$pp,$pseudo,$couleur,$date);
        
    }
}

function afficher_list_conver($pseudo, $chemin,$num,$couleur){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    
    ?>
    <link rel="stylesheet" href="../CSS/style_recherche.css">
   <?php echo'<div style="background-color:'.$color.';" class="boite-profil">';?>
   <div class="list_conver">
        <img class="pp" src=<?php echo $chemin ?> alt="photo de profil">  <!--petites boites lors de recherche de membres -->
        <form action="conver.php" class="pseudo" method="post">
        <?php echo '<input type="submit" class="pseudo" name= "pseudo" value='.$pseudo.'>'; ?>
        

        </form>
        
    </div>
    </div>
    <?php
}



function afficher_message(){
    ?>
    
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
                <a href="../PHP/inscription.php" class="bouton">Inscription</a>
            </form>
        </div>    
   
<?php
}

function afficher_conversation($pseudo,$des){
    ?>


    
<div class= "chat-global">

     <div class="nav-top">

        <div class="location">
            <!-- <img src="../Images/Messagerie/Chevron_left.svg.png" >  -->
            <a href="liste_conver.php" ><i class="fas fa-chevron-left"></i></a>
            


        </div>

        <div class="nom_inter">
            <p> <?php echo $des?></p> <!-- Nom interlocuteur -->
        </div>
    </div>
    <?php   // montrer_message($pseudo, $des);?>

    <div class="chat-form">

            <form class="barra">
                    <div class="group-inp">
                        <form action="../PHP/traitement_conver.php" method="POST">
                        <input type="text" placeholder="Ecris un message" class= "text" name="mess" minlength="1" maxlength="1000">
                        <input type="submit" class="submit-msg-btn">
                        </button>
                        </form>
                    </div>
            </form>

    </div>
</div>
</div>


<?php
}
function afficher_modifier($message){
  
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

        <form enctype="multipart/form-data" action="traitement_modifier_profil.php" method="post" class="formulaire">
             <input name="photo" type="file" />
                    
                    <input type="text" name="pseudo" class="input"  placeholder="<?php echo $_SESSION['pseudo'] ?>">
                    <input type="email" name="email" class="input" placeholder="<?php echo $_SESSION['email'] ?>">
                    <input type="password" name="mot_de_passe" class="input" placeholder="Nouveau mot de passe">
                

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
                
                    <input type="submit" class="bouton" value="Modifier"> 
                    <a href="../PHP/test.php" class="bouton">Test Section</a> 
            </form>

            
        </div>   
        
    </main>  
</body>
</html>
<?php
}


?>
