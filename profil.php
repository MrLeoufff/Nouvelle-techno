<?php
session_start();
    include_once "includes/header.php";
    include_once "includes/navbar.php";
    ?>
        
    <h2>Profil de : <?=$_SESSION["user"]["pseudo"]?></h2>

    <p>Pseudo : <?=$_SESSION["user"]["pseudo"]?></p>
    <p>Email : <?=$_SESSION["user"]["email"]?></p>

    

    <?php
    include_once "includes/footer.php";
?>