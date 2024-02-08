<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Vérifier si le fichier image est une vraie image ou une fausse image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Le fichier est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
}

// Vérifier si le fichier existe déjà
if (file_exists($target_file)) {
    echo "Désolé, le fichier existe déjà.";
    $uploadOk = 0;
}

// Vérifier la taille du fichier
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Désolé, votre fichier est trop volumineux.";
    $uploadOk = 0;
}

// Autoriser certains formats de fichiers
$allowed_extensions = array("jpg", "jpeg", "png", "gif");
if(!in_array($imageFileType, $allowed_extensions)) {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
}

// Vérifier si $uploadOk est à 0 à cause d'une erreur
if ($uploadOk == 0) {
    echo "Désolé, votre fichier n'a pas été uploadé.";
// Si tout est correct, tenter d'uploader le fichier
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a été correctement uploadé.";
    } else {
        echo "Désolé, une erreur est survenue lors de l'upload de votre fichier.";
    }
}
?>