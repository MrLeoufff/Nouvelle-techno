<?php
// On démarre la session php
session_start();
if(isset($_SESSION["user"])){
    header("Location: profil.php");
    exit; 
}
    // On vérifie si le form a ete envoyé
    if(!empty($_POST)){
    // Le form a ete envoyé
    // On vérifie que tout les champs son rempli
    if(isset($_POST["email"], $_POST["pass"])
    && !empty($_POST["email"]) && !empty($_POST["pass"])
    ){
        // On vérifie que c'est bien un email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("Vous n'avez pas entrer d'email valide");
        }
        // On se co à la BDD
        require_once "require/bdd_connexion.php";
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $requete = $db->prepare($sql);
        $requete->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        $requete->execute();
        $user = $requete->fetch();
        // Si je n'est pas l'utilisateur en BDD
        var_dump($user);
        if(!$user){
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }
        // On a un utilisateur existant, on vérifie son mdp
        if(!password_verify($_POST["pass"], $user["pass"])) {
            var_dump($_POST["pass"]);
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }
        // Ici l'utilisateur et le mdp sont correct
        // On va pouvoir ouvrir la session/co l'utilisateur
        
        // On va stocker dans $session les information utilisateur
        $_SESSION["user"] = [
            "id" => $user["id_utilisateur"],
            "pseudo" => $user["username"],
            "email" => $user["email"],
            "roles" => $user["roles"]
        ];
        // On peut redirigé vers la page de profile par ex
        header("Location: profil.php");
        exit;
    }
}
    include_once "includes/header.php";
    include_once "includes/navbar.php";
    ?>
        
    <h2>Connexion</h2>

    <form action="" method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="pass">Mot de passe</label>
            <input type="password" name="pass" id="pass">
        </div>
        <button type="submit">Me connecter</button>
    </form>

    <?php
    include_once "includes/footer.php";
?>