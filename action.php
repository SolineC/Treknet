



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/profil.css">
    <link rel="stylesheet" href="./fontawesome-free-5.15.2-web/fontawesome-free-5.15.2-web/css/all.css">

    <title>Where no man has gone before</title>

</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="./HTML/index.html">Accueil</a></li>
                <li><a href="./HTML/index.html">Connexion</a></li>
                <li><a href="./HTML/inscription.html">Inscription</a></li>
                <li><a href="./HTML/apropos.html">À propos</a></li>
                
            </ul>
        </nav>
        </header>

    <main>

        <h1>Mon profil</h1>

        <div class="info">

            <p>Bonjour, <?php echo htmlspecialchars($_POST['mail']); ?>.</p>
            <p>mot de passe : <?php echo $_POST['password']; ?></p>

        </div>   

        <aside>
            <div class="relations">

                <div class="amis">
                    <h2>Equipage</h2>
                    <div class="membre">
                        <img src="../CSS/pp.png" alt="photo de profil" class="pp">
                        <a href="#">James T. Kirk</a>
                    </div>
                    <div class="membre">
                        <img src="../CSS/pp.png" alt="photo de profil" class="pp">
                        <a href="#">M. Spock</a>
                    </div>
                    <div class="membre">
                        <img src="../CSS/pp.png" alt="photo de profil" class="pp"> 
                        <a href="#">Bones McCoy</a>
                    </div>

                </div>

                <div class="groupes">
                    <h2>Brigades</h2>
                    <div class="membre">
                        <img src="../CSS/pp.png" alt="photo de profil" class="pp">
                        <a href="#">L'équipe scientifique</a>
                    </div>
                    <div class="membre">
                        <img src="../CSS/pp.png" alt="photo de profil" class="pp">
                        <a href="#">LiveLongAndProsper</a>
                    </div>
                    <div class="membre">
                        <img src="../CSS/pp.png" alt="photo de profil" class="pp"> 
                        <a href="#">Beam me up, Scotty !</a>
                    </div>

                </div>

            </div>

            <div class="remplissage"></div>

            <div class="messagerie">


                <a href="#" class="btn"><i class="fa fa-chevron-up"></i>Communicator</a>
                <div class="smenu">
                    <a href="#">Conversations</a>
                    <a href="#">Nouveau message</a>
                </div>
            </div>
        </aside>
        
    </main>




       

   
</body>

</html>