<?php
// Initialisation de la session
session_start();

// On écrase toutes les variables de session
$_SESSION = array();

// Destruction de la session
session_destroy();

// Redirection vers la page de connexion
header("location: ../../View/login-page.php");
exit;
?>