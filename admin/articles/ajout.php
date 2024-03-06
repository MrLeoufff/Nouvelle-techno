<?php
// On vérifie que POST n'est pas vide
if(!empty($_POST)) {
    // POST n'est pas vide on vérifie que les données sont présentes
    if(
        isset($_POST["titre"], $_POST["contenu"])
        && !empty($_POST["titre"]) && !empty($_POST["contenu"])
    ){
        // Le formulaire est complet on récupère les données en les protégeant (faille XSS)
        // On retire toutes les balises
        $titre = strip_tags($_POST["titre"]);
        // On neutralise toute balise du contenu
        $contenu = htmlspecialchars($_POST["contenu"]);
        // On peut les enegistrer pour cela on se co à la BDD
        require_once "../../require/bdd_connexion.php";
        // J'écris ma requete
        $sql = "INSERT INTO recettes (`titre`, `contenu`) VALUES (:titre, :contenu)";
        // On prépare la requete
        $requete = $db->prepare($sql);
        // On inject les valeur
        $requete->bindValue(":titre", $titre, PDO::PARAM_STR);
        $requete->bindValue(":contenu", $contenu, PDO::PARAM_STR);
        // On execute la requete
        if(!$requete->execute()) {
            die("Une érreur est survenue");
        }
        // On récupère l'id de l'article
        $id = $db->lastInsertId();
        die("Article ajouté sous le numéro $id");
    }else{
        die("Le formulaire est incomplet");
    }
}

include_once "../../includes/header.php";
include_once "../../includes/navbar.php";

?>

<h1>Ajouter un article</h1>

<form action="" method="post">
    <div>
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div>
        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu"></textarea>
    </div>
    <button type="submit">Envoyer</button>
</form>


<?php
include_once "../../includes/footer.php";
?>