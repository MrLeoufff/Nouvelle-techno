<?php
// Nom de l'image
$fichier = "bridge-7859045_1280.png";

$image = __DIR__ . "/uploads/" . $fichier;

// On récupère les infos de l'image

$infos = getimagesize($image);

$width = $infos[0];
$heigth = $infos[1];

// On créer une nouvelle image vierge
$newImage = imagecreatetruecolor($width / 2, $heigth / 2);

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

// On copie toute l'image source dans l'image de destination en la réduisant
imagecopyresampled(
    $newImage, // Image de destination
    $imageSource, // Image d'origine
    0, // Position en X du coin supérieur gauche dans l'image de destination
    0, // Position en Y du coin supérieur gauche dans l'image de destination
    0, // Position en X du coin supérieur gauche dans l'image source
    0, // Position en Y du coin supérieur gauche dans l'image source
    $width / 2, // Largeur dans l'image de destination
    $heigth / 2, // Largeur dans l'image de destination
    $width, // Hauteur dans l'image source
    $heigth // Hauteur dans l'image source
);

// On enregistre la nouvelle image dans le server
switch($infos["mime"]) {
    case "image/png":
        // On enregistre l'image
        imagepng($newImage, __DIR__ . "/uploads/resize-" . $fichier);
        break;
    case "image/jpeg":
        // On enregistre l'image
        imagejpeg($newImage, __DIR__ . "/uploads/resize-" . $fichier);
        break;
    }

    // On détruit les image dans la mémoire
    imagedestroy($imageSource);
    imagedestroy($newImage);




?>
