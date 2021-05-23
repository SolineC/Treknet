

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
    <link rel="stylesheet" href="../CSS/style_messagerie.css" >


    
    
    
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
                    <li><a href="profil.php" title="Profil"> <i class="fas fa-user"></i> </a></li>
                    <li><a href ="publication.php" title="Nouvelle publication"><i class="fas fa-plus"></i></a></li>
                    <li><a href ="liste_conver.php" title="Envoyer un message"><i class="fas fa-paper-plane"></i></a></li>
                    <li><a href ="modifier_profil.php" title="Modifier le profil"><i class="fas fa-cog"></i></a></li>
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


function afficher_conver($pseudo, $chemin,$num,$couleur){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    ?>
   <?php echo'<div style="background-color:'.$color.';" class="boite-profil">';?>
        <img class="pp" src=<?php echo $chemin ?> alt="photo de profil">  <!--petites boites lors de recherche de membres -->
        <form action="conver.php" method="post">
        <?php echo '<input type="submit" class="pseudo" name="pseudo" value='.$pseudo.'>'; ?>
        
        <input type="hidden" name="num_profil" value=<?php echo $num;?>>
        </form><?php
          
        

        ?>
        
    </div>
    

    <?php
}


function afficher_conver_instruction(){
    ?>
   
    <div class= "instruction">
    
        <h1>Messagerie du vaissea</h1>

        <h4>Communiquez vous avec les membres de votre equipage 
            et partagez des anecdotes sur les mondes que vous aviez decouverts ensembles
    </h4> <br> 
        <p>Les insultes ou les manques de respect ne seront pas tolerées entre camarades</p>
    </div>
    
    <?php
}

function afficher_page_profil($num,$tab_user){
    if($tab_user["pseudo"]==$_SESSION["pseudo"]) {
        $abo=1;
    }else{
        $abo=0;
    }
    
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

    $req4="SELECT * FROM profil WHERE num_profil IN 
    (SELECT num_profil_suivi FROM abonnement WHERE num_profil_suivant='".$num."') AND num_profil != '".$num."'";
    $res4=requete1($req4,$connexion);
    $req5="SELECT * FROM profil WHERE num_profil IN 
    (SELECT num_profil_suivant FROM abonnement WHERE num_profil_suivi='".$num."') AND num_profil != '".$num."'";
    $res5=requete1($req5,$connexion);


    echo '<div class="blank"></div>';


    while($ligne=mysqli_fetch_array($res)){
        $image=$ligne['image'];
        $texte=$ligne['texte'];
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        $date=$ligne['date_publication'];
        $num_pub=$ligne['num_publication'];

        afficher_publication($image,$texte,$pp,$pseudo,$couleur,$date,$abo,$num_pub);
        
    
    }

 
    
    echo '<div class="cote suivi">';
    echo "<p>Il y a ".$res2["COUNT(*)"]." membres dans l'équipage de ".$tab_user["pseudo"]." </p>";
    
    while($ligne=mysqli_fetch_array($res4)){
        
        
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        
      
        afficher_profil($pseudo,$pp,1,$ligne['num_profil'],$couleur);
        
    
    }
    echo "</div>";
    echo '<div class="cote suivant">';
    echo "<p>".$tab_user["pseudo"]." est dans l'équipage de ".$res3["COUNT(*)"]." membres </p>";
    while($ligne=mysqli_fetch_array($res5)){
        
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        

      
        afficher_profil($pseudo,$pp,1,$ligne["num_profil"],$couleur);
        
    
    }


    echo "</div>";
    /**ICI PBM POTENTIEL */
$np=$_SESSION["num_profil"];$ns=$tab_user["num_profil"];
$req6="SELECT COUNT(*) FROM abonnement WHERE num_profil_suivant='".$np."' AND num_profil_suivi='".$ns."'";
$res6=requete($req6,$connexion);

    if($res6["COUNT(*)"]!=0) {$abo=0;}else{$abo=1;}

/**ICI PBM POTENTIEL */
    
    
    if($tab_user["pseudo"]!=$_SESSION["pseudo"] ){
        
        bloc_abonnement($abo,$num);
        }
    
    
    afficher_pied_de_page();
}

function bloc_abonnement($abo,$num){
    echo '<div class="test">';
        
    if($abo==1){
        
        ?>
        <form action="traitement_abonnement.php" method="post">
            <?php echo '<input type="hidden" name="num_suivi" value="'.$num.'">';?>
            <?php echo '<input type="hidden" name="page" value="'.getAdresse().'">';?>
            <input type="submit" value="S'abonner" class="bouton">
      </form>
      <?php
    }
    else{
        
       ?>
       <form action="traitement_desabonnement.php" method="post">
           <?php echo '<input type="hidden" name="num_suivi" value="'.$num.'">';?>
           <?php echo '<input type="hidden" name="page" value="'.getAdresse().'">';?>
           <input type="submit" value="Se desabonner" class="bouton" >
     </form>

       <?php
       
    }


      
        echo '</div>';
    

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
            <p>  <?php echo $_SESSION['description'] ?> </p>
            </div>
        </div>
        
    </div>
    <?php
    
}

function afficher_erreurs($message){
    
        echo '<p class="erreur">',$message,'</p>';
        if (!empty($message)){
        
        ?>
        <audio autoplay>
                <source src="..\Musique\error.mp3" type="audio/mpeg" >
        </audio>
        <?php
        }
}

function afficher_connexion($message){
    
    ?>
    <!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <?php
    if(getAdresse()=="Treknet" || getAdresse()=="index.php"){
        ?>
    
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/style.css">
    <?php
    }else{
    ?>

    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <?php
    }
    ?>

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
            <form action="PHP/traitement_connexion.php" method="POST">
                <input type="text" class="input"  name="pseudo" required="required" placeholder="Pseudo">
                <input type="password" class="input" name="mot_de_passe" required="required" placeholder="Mot de Passe">
                <input type="submit" class="bouton" value="CONNEXION" >
                <!-- <a class="mdp" href="PHP/forgot_password.php">Mot de passe oublié ?</a> -->
                <a href="PHP/inscription.php" class="bouton">Inscription</a>
                <audio autoplay>
                <source src="Musique\Classic voice over.mp3" type="audio/mpeg" >
                </audio>
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
                        <option value=Romulien >Romulien</option>
                    
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
 <div class="generique">   

        <h1>TABLEAU DE BORD </h1>
        <div class="boite-diode">
            <div class="diode"></div>
            <div class="diode"></div>
           
        </div>

<h3> Voila les souvenirs des membres de ton équipage...</h3>
<div class="boite-diode">
    <div class="diode"></div>
    <div class="diode"></div>
    <div class="diode"></div>
</div>

 <p>...après avoir exploré d'étranges nouveaux mondes,
découvert de nouvelles vies
 et civilisations et avoir été là où personne n'est jamais allé !
 </p>
 </div>
 <div class="boite-bitoniaux">
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 <div class="bitoniaux"></div>
 </div>
        
    </aside>
    <a href="liste_conver.php"><img src="../Images/communicator.jpg" alt="communicateur" class="communicator" title="Envoyer un message"></a>

<?php
}

function afficher_cote_droit(){
    ?>
    <aside class="droit">
    </aside>

<?php
}

function afficher_accueil(){
    ?>
    <audio autoplay>
                <source src="..\Musique\Beeping and clicking.mp3" type="audio/mpeg" >
        </audio>
    
        <?php    

    afficher_en_tete();

    afficher_cote_gauche();

    #afficher_utilisateur();
   /* echo "<br>";

    echo "<br>";
                                            #pour le debuggage
    echo "<br>";

    echo "<br>";

    
    echo '<a href="essai.php">Test</a>';*/
    afficher_publications(0);
    //afficher_cote_droit();
    afficher_pied_de_page();
}

function afficher_publication($image, $texte, $pp, $pseudo,$couleur,$date,$siprofil,$num_pub){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    if($_SESSION["num_grade"]>10){
        $siprofil=1;
    }
    
    if($siprofil==0){
    ?>
        
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
    echo '<div class="blank"></div>';


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



function afficher_test($message){
    ?>
    <div class="test_section">
    <div class="test_erreur"> 
       <?php
    afficher_erreurs($message);

?>
    </div>
        <form action="traitement_test.php" method="post" class="formulaire">
            
    <p>L'un des moteur du vaisseau tombe en panne, mais vous ne savez pas comment le réparer. Que faites vous ?</p>
    <div class="test_question">
            <input type="radio" name="q1" id="q11" value="5"> 
            <label for="q11">Vous demandez de l'aide à quelqu'un d'autre</label> <br>
             <input type="radio" name="q1" id="q12" value="1"> 
             <label for="q12">Vous lisez le manuel d'instructions de l'appareil</label> <br>
             <input type="radio" name="q1" id="q13" value="10">
             <label for="q13">Vous essayez de le réparer avec vos connaissances, pas de chance si ça explose</label> <br>
 </div> 

    <p>Qu'offrez-vous à l'équipage ?</p>
    <div class="test_question">
             <input type="radio" name="q2" id="q21" value="10">
             <label for="q21">Vos habilités techniques</label><br>   
             <input type="radio" name="q2" id="q22" value="5"> 
             <label for="q22">Votre stratégie </label><br>   
             <input type="radio" name="q2" id="q23" value="1">  
             <label for="q23">Votre intelligence</label><br>   
     </div> 


     <p>Quel est votre plus grand défaut ?</p>
     <div class="test_question">
             <input type="radio" name="q3" id="q31" value="1">
             <label for="q31"> Vous oubliez souvent de tenir compte des sentiments des autres </label> <br>
             <input type="radio" name="q3" id="q32" value="10">  
             <label for="q32">Vous avez tendance à avoir des accidents</label> <br>
             <input type="radio" name="q3" id="q33" value="5">  
             <label for="q33">Vous êtes litteralment parfait</label> <br>
     </div> 
    <p>À l'Academie Spacial vous aviez une certaine reputation... Vous étiez : </p>
    <div class="test_question">

             <input type="radio" name="q4" id="q41" value="1"> 
             <label for="q41"> L'élève le plus intelligent</label> <br>
             <input type="radio" name="q4" id="q42" value="5">
             <label for="q42"> Le délégué</label> <br>
             <input type="radio" name="q4" id="q43" value="10">
             <label for="q43"> Le bricoleur</label> <br>
     </div> 

    <p>Que faissiez lorsque vous aviez des mauvaises notes ?</p>
    <div class="test_question">
             <input type="radio" name="q5" id="q51" value="10">
             <label for="q51">Vous étudiez plus</label> <br>
             <input type="radio" name="q5" id="q52"value="5"> 
             <label for="q52">Vous parliez avec le prof </label> <br>
             <input type="radio" name="q5" id="q53" value="1">  
             <label for="q53">Vous n'aviez pas des mauvaises notes</label> <br>
    </div> 

   <p>Vous atterrissez sur une planète où les habitants ne peuvent dire que la verité ou bien que des mensonges. <br>
   Vous arriviez à un refuge où habitent deux hommes. Le premier dit que les deux ne dissent la verité. <br>
    Puis le deuxieme dit qu'ils ne veulent pas vous faire du mal.

   </p>
   <div class="test_question">
             <input type="radio" name="q6" id="q61"value="5"> 
             <label for="q61">Le premier dit vrai, alors le deuxième dit faux donc ils veulent vous faire du mal </label> <br>
             <input type="radio" name="q6" id="q62" value="1"> 
             <label for="q62">Le premier dit faux, alors le deuxième dit vrai donc ils ne veulent pas vous faire du mal </label> <br>
             <input type="radio" name="q6" id="q62" value="10"> 
             <label for="q63"> Vous tirez sur les deux, au le cas où</label> <br>
    </div> 

<br>
<br>
        
            <input type="submit" class="bouton" value="Soumettre">  
    </form>
</div> 
<?php
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




function afficher_conversation($pseudo,$des){
    ?>



<div class= "chat-global">

     <div class="nav-top">

        <div class="location">
            <a href="liste_conver.php" ><i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="nom_inter">
            <p> <?php echo $des?></p> <!-- Nom interlocuteur -->
        </div>
    </div>
    <div class="pop">
    <?php
    montrer_message($pseudo, $des);
    ?>
    </div>
    <audio autoplay>
                <source src="..\Musique\message sent.mp3" type="audio/mpeg" >
        </audio>
    <div class="chat-form">
        <div class="barra">
                <div class="group-inp">
                    <form action="traitement_conver.php" method="POST">
                    <input type="text" placeholder="Ecris un message" class= "text" name="mess" >
                    <input type="submit" class="submit-msg-btn" name="valider">
                    </form>
                </div>
        </div>

    </div>
</div>



<?php
}
function afficher_mess_droite($message){
    ?>
    <div class="talk r">
        <p><?php echo $message ?></p>
    </div>
    <?php
}

function afficher_mess_gauche($message){
    ?>
           
    <div class="talk l">
        <p><?php echo $message ?></p>
    </div>
    <?php
}
function afficher_modifier($message){ 
?>    

        
            
        
        <div class="test_erreur">

<?php 
    
        afficher_erreurs($message);
 
 ?>
        </div>
       
        <div class="modifier">
            
        <aside></aside>
            <div class="haut">
               
           
              <img class="pp big" src="<?php echo $_SESSION['photo'] ?>" alt="photo de profil">     
              <form enctype="multipart/form-data" action="traitement_modifier_profil.php" method="post" class="formulaire">
             <input name="photo" type="file" />
             <p>Modifier photo de profil</p>
            
                    <div class=identifiant>
                        <p>Pseudo</p>
                    <input type="text" name="pseudo" class="input"  placeholder="<?php echo $_SESSION['pseudo'] ?>">
                    <p>Email</p> 
                    <input type="email" name="email" class="input" placeholder="<?php echo $_SESSION['email'] ?>">
                    <p>Changer mot de passe</p>
                    <input type="password" name="mot_de_passe" class="input" placeholder="Nouveau mot de passe">
                    </div>
            </div>        
                
                <div class="bas">
                    <select name="espece" class="deroul" >
                        <option value=0 >Espèce</option>
                        <option value=Humain>Humain</option>
                        <option value=Vulcan >Vulcain</option>
                        <option value=Andorian >Andorian</option>
                        <option value=Romulien >Romulien</option>
                    
                    </select> 
                    <a href="../PHP/test.php" class="bouton">Test Section</a> 
                    </div>   
                <div class="des">
                    <p>Description</p>
                    <textarea name="description" class="input" id="" cols="60" rows="10"></textarea>
                    <input type="submit" class="bouton" value="Modifier"> <br>
                </div>   
            </form>
            
            
        </div>   
        
 
<?php
afficher_modifier_instruction();
}


function afficher_modifier_instruction(){
    ?>
   
    <div class= "instructions">
    
        <h1>Modifier votre profil</h1>

        
    </div>
    
    <?php
}
?>

