<?

require_once("fonctions_bd.php");
require_once("fonctions_affichage.php");
require_once("fonctions.php");


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
    
        <div class="connexion">

            <h3>Mot de passe oublié</h3>
            <form action="traitement_password.php" method="POST">
                <input type="text" class="input"  name="mail" required="required" placeholder="Adresse mail">
                <input type="submit" class="bouton" value="Envoyer" >
                
                <a href="../index.php" class="bouton">Connexion</a>
            </form>
        </div>    
    </main>  
</body>
</html>


<?php

?>