<?php

?>

<nav>
    <?php
    
    ?>
    <ul>
        <a href="index"><li>Accueil</li></a>
        <a href="articles"><li>Articles</li></a>
        <?php if(!isset($_SESSION["user"])): ?>
            <a href="connexion"><li>Connection</li></a>
            <a href="inscription"><li>Inscription</li></a>
        <?php else: ?>
            <li>Bonjour <?= ($_SESSION["user"]["pseudo"]) ?></li>
            <a href="deconnexion"><li>Déconnection</li></a>
        <?php endif; ?>
    </ul>
</nav>
