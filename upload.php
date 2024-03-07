<?php
// On vérifie si un fichier a ete envoyé
if(isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
    // On a reçu l'image
    // On procède au vérifications
    // On vérifie toujours l'extention et le type Mime
    $allowed = [
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png",
        "pdf" => "application/pdf"
        // On vérifie si le fichier envoyé correspond avec la liste $allowed
    ];
    // On récupère le nom de l'image
    $filename = $_FILES["image"]["name"];
    // On récupère le type
    $filetype = $_FILES["image"]["type"];
    // On récupère la taille du fichier
    $filesize = $_FILES["image"]["size"];

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    // On vérifie l'absence de l'extension dans les clés de $allowed ou l'absence des valeurs dans le typeMime
    if(!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
        // Ici soit l'extension soit le type est incorrect
        die("Attention le format de fichier est incorrect!");
    }
    // Ici le type est correct
    // On limite à 1MO la taille du fichier
    if($filesize > 1024 * 1024) {
        die("Le fichier est trop gros");
    }
    // On génère un nom unique
    $newname = md5(uniqid());
    // On génère le chemin complet
    $newfilename = __DIR__ . "/uploads/$newname.$extension";

    // On déplace le fichier dans uploads
    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)){
        die("L'upload a échouer");
    }
    // Protégé à l'écriture
    chmod($newfilename, 0644);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajout de fichier</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="fichier">Fichier</label>
            <input type="file" name="image" id="fichier">
        </div>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>


