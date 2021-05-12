<?php
/*if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
{
    $url = "https";
}
else
{
    $url = "http"; 
}  
$url .= "://"; 
$url .= $_SERVER['HTTP_HOST']; 
$url .= $_SERVER['REQUEST_URI']; 
echo $url; */
require_once("fonctions_affichage.php");
afficher_en_tete();



echo pathinfo($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])["basename"];
echo "<br>";
afficher_abonnement(0,4);


?>
   
   