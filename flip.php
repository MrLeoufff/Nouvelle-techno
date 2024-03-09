<?php
// Nom de l'image
$fichier = "bridge-7859045_1280.png";

$image = __DIR__ . "/uploads/" . $fichier;

// On récupère les infos de l'image

$infos = getimagesize($image);

switch($infos["mime"]) {
    case "image/png":
        // On ouvre l'image png
        $imageSource = imagecreatefrompng($image);
    break;
    case "image/jpeg":
        $imageSource = imagecreatefromjpeg($image);
    break;
    default:
    die("Format d'image incorrect");
}

// On "retourne" l'image
imageflip($imageSource, IMG_FLIP_HORIZONTAL);


// On enregistre la nouvelle image dans le server
switch($infos["mime"]) {
    case "image/png":
        // On enregistre l'image
        imagepng($imageSource, __DIR__ . "/uploads/flip-" . $fichier);
        break;
    case "image/jpeg":
        // On enregistre l'image
        imagejpeg($imageSource, __DIR__ . "/uploads/flip-" . $fichier);
        break;
    }

    // On détruit les image dans la mémoire
    imagedestroy($imageSource);
    





?>