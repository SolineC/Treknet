<?php
require_once("fonctions.php");
require_once("fonctions_affichage.php");
session_start();
logout();
header("Location: ../index.php");
?>