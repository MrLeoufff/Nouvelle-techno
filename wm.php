<?php
// Nom de l'image
$fichier = "bridge-7859045_1280.png";

$image = __DIR__ . "/uploads/" . $fichier;

// On récupère les infos de l'image

$infos = getimagesize($image);

$width = $infos[0];
$heigth = $infos[1];



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

// On ouvre le logo
$logo = imagecreatefrompng(__DIR__. "/uploads/Arcadia-svg.png");
// On récupère les infos du logo
$logoInfos = getimagesize(__DIR__. "/uploads/Arcadia-svg.png");

// On copie toute l'image source dans l'image de destination en la réduisant
imagecopyresampled(
    $imageSource, // Image de destination
    $logo, // Image d'origine
    $infos[0] - $logoInfos[0] - (-80), // Position en X du coin supérieur gauche dans l'image de destination
    $infos[1] - $logoInfos[1] - (-80), // Position en Y du coin supérieur gauche dans l'image de destination
    0, // Position en X du coin supérieur gauche dans l'image source
    0, // Position en Y du coin supérieur gauche dans l'image source
    $logoInfos[0], // Largeur dans l'image de destination
    $logoInfos[1], // Largeur dans l'image de destination
    $logoInfos[0], // Hauteur dans l'image source
    $logoInfos[1] // Hauteur dans l'image source
);

// On enregistre la nouvelle image dans le server
switch($infos["mime"]) {
    case "image/png":
        // On enregistre l'image
        imagepng($imageSource, __DIR__ . "/uploads/wm-" . $fichier);
        break;
    case "image/jpeg":
        // On enregistre l'image
        imagejpeg($imageSource, __DIR__ . "/uploads/wm-" . $fichier);
        break;
    }

    // On détruit les image dans la mémoire
    imagedestroy($imageSource);
    imagedestroy($logo);




?>
