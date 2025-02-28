<?php #Melissa et Amina
session_start(); // Démarrer la session

// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil
header("Location: page_accueil.php");
exit();
?>
