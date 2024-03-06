
<?php
// On démarre la session php
session_start();
    include_once "includes/header.php";
    include_once "includes/navbar.php";
    
    
    // On vérifie si on récupère un id
    if(!isset($_GET["id"]) || empty($_GET["id"])) {
        // Je n'ai pas d'id je redirige vers la page articleS
        header("Location: articles.php");
        exit;
    }
    
    // On récupère l'id
    $id = $_GET["id"];
    
    require_once "require/bdd_connexion.php";
    // On va récupérer l'article dans la base
    // On écris la requete
    $sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id";
    // On prépare la requete
    $requete = $db->prepare($sql);
    // On inject les parametre
    $requete->bindValue(":id", $id, PDO::PARAM_INT);
    // On execute la requete
    $requete->execute();
    // On récupere l'utilisateur
    $utilisateur = $requete->fetch();

    if(!$utilisateur) {
        http_response_code(404);
        echo ("Utilisateur inexistant");
        exit;
    }
    
?>
<section>
    <article>
        <h3> <?=strip_tags($utilisateur["username"])?></h3>
            <p><?= strip_tags($utilisateur["roles"])?></p>
                <div>
                    <p>Email => <?= strip_tags($utilisateur["email"])?></p>
                </div>
    </article>
</section>

<?php
    include_once "includes/footer.php";
?>
