<?php
// Démarrer la session pour récupérer "user"
session_start();
if(!isset($_SESSION["user"])){
    header("Location: connexion.php");
    exit;
}

// on déconnect "user"
unset($_SESSION["user"]);

header("Location: index.php");

?>