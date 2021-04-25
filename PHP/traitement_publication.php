<?php
session_start();
require_once("fonctions.php");
require_once("fonctions_affichage.php");
bloquer_sans_session();

$compteur=0;

$dossier = "../Images/Publications/";
$fichier = $dossier . basename($_FILES['img_publication']['name']);


echo $fichier;



if (move_uploaded_file($_FILES['img_publication']['tmp_name'], $fichier)) {
    echo "Le fichier est valide, et a été téléchargé
           avec succès. Voici plus d'informations :\n";
} else {
    echo "Attaque potentielle par téléchargement de fichiers.
          Voici plus d'informations :\n";
}


?>