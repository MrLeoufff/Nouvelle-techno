<?php
// Définir des constantes d'environnement pour se co à la base de donné
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "nouvelle_techno");
// DSN (data source name) de connexion le chemin de la BDD
    $dsn = "mysql:name=".DBNAME."host=".DBHOST;
//Tentative de co dans le try sinon on passe dans le catch
    try{
// On instancie PDO
    $db = new PDO($dsn, DBUSER, DBPASS);
// Pour s'assurer d'envoyer les données en UTF8
        $db->exec("SET NAMES utf8");
        $db->exec("USE nouvelle_techno");
// On définit le mode de "fetch" par defaut
        $db->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
        // echo "On est connecter";
    }catch(PDOException $e){
        die("Erreur :".$e->getMessage());
    }
// Ici on est co à la BDD
?>
