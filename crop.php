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

// On recadre l'image avec imagecrop
$newImage = imagecrop($imageSource, [
    "x" => 200,
    "y" => 200,
    "width" => 300,
    "height" => 150
]);

// On enregistre la nouvelle image dans le server
switch($infos["mime"]) {
    case "image/png":
        // On enregistre l'image
        imagepng($newImage, __DIR__ . "/uploads/crop-" . $fichier);
        break;
    case "image/jpeg":
        // On enregistre l'image
        imagejpeg($newImage, __DIR__ . "/uploads/crop-" . $fichier);
        break;
    }

    // On détruit les image dans la mémoire
    imagedestroy($imageSource);
    





?>