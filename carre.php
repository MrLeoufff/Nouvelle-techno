<?php
// Nom de l'image
$fichier = "bridge-7859045_1280.png";

$image = __DIR__ . "/uploads/" . $fichier;

// On récupère les infos de l'image

$infos = getimagesize($image);

$width = $infos[0];
$height = $infos[1];

// On doit savoir si l'image est portrait ou paysage ou carré
switch($width <=> $height) {
    case -1:
        // largeur < hauteur (-1) => portrait
        $tailleCarre = $width;
        $src_x = 0;
        $src_y = ($height - $tailleCarre) / 2;
        break;
    case 0:
        // largeur = hauteur (0) => carré
        $tailleCarre = $width; // Ou $height
        $src_x = 0;
        $src_y = 0;
        break;
    case 1:
        // largeur > hauteur (1) => paysage
        $tailleCarre = $height; 
        $src_x = ($width - $tailleCarre) / 2;
        $src_y = 0;
        break;
}


// On créer une nouvelle image vierge
$newImage = imagecreatetruecolor(200, 200);

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
    $src_x, // Position en X du coin supérieur gauche dans l'image source
    $src_y, // Position en Y du coin supérieur gauche dans l'image source
    200, // Largeur dans l'image de destination
    200, // Largeur dans l'image de destination
    $tailleCarre, // Hauteur dans l'image source
    $tailleCarre // Hauteur dans l'image source
);

// On enregistre la nouvelle image dans le server
switch($infos["mime"]) {
    case "image/png":
        // On enregistre l'image
        imagepng($newImage, __DIR__ . "/uploads/carre-" . $fichier);
        break;
    case "image/jpeg":
        // On enregistre l'image
        imagejpeg($newImage, __DIR__ . "/uploads/carre-" . $fichier);
        break;
    }

    // On détruit les image dans la mémoire
    imagedestroy($imageSource);
    imagedestroy($newImage);




?>
