<?php
// On démarre la session php
session_start();
if(isset($_SESSION["user"])){
    header("Location: profil.php");
    exit;
}
    // On vérifie si le form a ete envoyé
    if(!empty($_POST)) {
    // Le form a ete envoyé
    // On vérifie que tout les champs son rempli
    if(isset($_POST["nickname"], $_POST["email"], $_POST["pass"])
    && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        // Le formulaire est complet
        // On récupère les données en les protégeant
        $pseudo = strip_tags($_POST["nickname"]);
        // On initialise l'erreur session
        $_SESSION["error"] = [];
        // On vérifie le pseudo
        if(strlen($pseudo) < 2){
            $_SESSION["error"][] = "Ce pseudo est trop cours";
        }
        // On vérifie si l'email est bien un email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"][] = "Ce n'est pas un email valide";
        }
        // Si pas d'erreur on passe à la suite
        if($_SESSION["error"] === []) {
        // On va hacher le mot de passe
        $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
        // Ajoutez ici tous les controles souhaité

        // On vérifie si l'email exist
        // Co à la BDD
        require_once "require/bdd_connexion.php";

        if(isset($_POST['email'])) {
            $email = $_POST['email'];
            $sql = "SELECT * FROM utilisateurs WHERE email=?";
            $requete = $db->prepare($sql);
            $requete->execute([$email]); 
            $user = $requete->fetch();
            if ($user) {
                // email existe
                $_SESSION["error"][] = "l'email exist";
                header("Location: inscription.php");
                exit;
            }
        }    

        // On enregistre en base de donnée
        $sql = "INSERT INTO `utilisateurs`(`username`, `email`, `pass`, `roles`) 
        VALUES (:pseudo, :email, '$pass', '[\"ROLE_USER\"]')";
        // Préparer la requete
        $requete = $db->prepare($sql);
        $requete->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $requete->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        // $requete->bindValue(":pass", $pass, PDO::PARAM_STR);
        // On execute la requete SQL
        $requete->execute();

        // On récupère l'id du nouvelle utilisateur
        $id = $db->lastInsertId();

        // On co l'utilisateur
        
        // On va stocker dans $session les information utilisateur
        $_SESSION["user"] = [
            "id" => $id,
            "pseudo" => $pseudo,
            "email" => $_POST["email"],
            "roles" => ["ROLE_USER"]
        ];
        // On peut redirigé vers la page de profile par ex
        header("Location: profil.php");
    }

    }else{
        //incomplet
        $_SESSION["error"] = ["Le formulaire n'est pas complet"];
    }
}

    include_once "includes/header.php";
    include "includes/navbar.php";
    ?>
        
    <h2>Inscription</h2>
    <?php
    if(isset($_SESSION["error"])) {
        foreach($_SESSION["error"] as $message) {
            ?>
            <p><?=$message?></p>
            <?php
        }
        unset($_SESSION["error"]);
    }
    ?>
    <form action="" method="post">
        <div>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="nickname" id="pseudo">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="pass">Mot de passe</label>
            <input type="password" name="pass" id="pass">
        </div>
        <button type="submit">M'inscrire</button>
    </form>

    <?php
    include_once "includes/footer.php";
?>