<?php
session_start();
require_once("fonctions.php");
require_once("fonctions_affichage.php");
bloquer_sans_session();

afficher_en_tete();
?>

 <div class="blank"></div>

 
<!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
<form enctype="multipart/form-data" action="traitement_publication.php" method="post">
  <!-- MAX_FILE_SIZE doit précéder le champs input de type file -->
  <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
  <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->  
  <input name="img_publication" type="file" />
  <input type="submit" value="Choisir cette photo" />
</form>


<?php
afficher_pied_de_page();
?>