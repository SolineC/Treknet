<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Where no man has gone before</title>

</head>

<body>
    <!-- <header>
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="connexion.html">Connexion</a></li>
                <li><a href="inscription.html">Inscription</a></li>
                <li><a href="apropos.html">À propos</a></li>
                
            </ul>
        </nav>
        </header> -->

    <main>


        <div class="logo">

            <h1>treknet</h1> 
            <p>le réseau des trekkies par exellence</p>

        </div>

        <div class="connexion">

            <form action="../PHP/action.php" method="POST">
                <input type="text" class="input"  name="pseudo" required="required" placeholder="Pseudo">
                <input type="password" class="input" name="mot_de_passe" required="required" placeholder="Mot de Passe">
                <input type="submit" class="bouton" value="CONNEXION" >
                <a class="mdp" href="#">Mot de passe oublié ?</a>
                <a href="inscription.html" class="bouton">Inscription</a>
            </form>

        </div>
        
    </main>




       

   
</body>

</html>