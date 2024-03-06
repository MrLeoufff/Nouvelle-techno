
<?php
// On démarre la session php
session_start();
require_once "require/bdd_connexion.php";
    include_once "includes/header.php";
    include_once "includes/navbar.php";


    $sql = "SELECT * FROM utilisateurs";
    $requete = $db->query($sql);
    // // On prépare la requete
    // $requete = $db->prepare($sql);
    // // On inject les valeurs avec "bindValue"
    // $requete->bindValue(":username", $role, PDO::PARAM_STR);
    // $requete->bindValue(":pass", $pass, PDO::PARAM_STR);
    // // On execute
    // $requete->execute();
    // On récupère les donnés
    $utilisateurs = $requete->fetchAll();

?>
    <h2>Contenu de la page articles</h2>
        <section>
    <?php foreach($utilisateurs as $utilisateur):?>
        
            <article>
                <h3><a href="article.php?id=<?= $utilisateur["id_utilisateur"] ?>"> <?= strip_tags($utilisateur["username"])?></a></h3>
                <!-- <p><?= strip_tags($utilisateur["roles"])?></p>
                <div>
                    <p>Email => <?= strip_tags($utilisateur["email"])?></p>
                </div> -->
            </article>
        
            
            
            
            <?php endforeach; ?>
        </section>
<?php
    include_once "includes/footer.php";
?>
