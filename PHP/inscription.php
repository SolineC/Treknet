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

        <div class="blocInscription">
            <form action="traitement_inscription.php" method="post" class="formulaire">
                    
                    <input type="text" name="pseudo" class="input"  placeholder="Pseudo">
                    <input type="email" name="mail" class="input" placeholder="Adresse Mail">
                    <input type="password" name="mot_de_passe" class="input" placeholder="Mot de Passe">
                

                    <select name="section" class="deroul" >
                        <option value=0 >Section</option>
                        <option value=1 class="jaune">Opérations</option>
                        <option value=2 class="bleu">Scientifiques</option>
                        <option value=3 class="rouge">Navigation</option>
                    
                    </select> 
                
                    <input type="submit" class="bouton" value="Inscription">  
            </form >



            

        </div>
    </main>




       

   
</body>

</html>