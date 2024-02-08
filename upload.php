<?php
include_once('conf.php');

if(isset($_POST) && isset($_FILES)){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $file = $_FILES['file'];
    //Dossier ou sont enregistré les fichiers
    $uploadDir = 'uploads/';
    //Nom du fichier
    $filename = basename($file['name']);

    $connexion = db();
    $query = "INSERT INTO profile SET Nom=:nom, Prenom=:prenom, Filename=:filename";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);

    //chemin du dossier uploads
    $uploadFilename = $uploadDir . $filename;
    //Vérifier si la copie du fichier au niveau du serveur est éffectuer
    //Si la copie est éffectuer
    if(move_uploaded_file($file['tmp_name'], $uploadFilename)){
        $stmt->bindParam(":filename", $filename);
        $stmt->execute();
        header('location : profile.php');
    }
    //Si la copie n'est pas effectuer
    else{ echo "fail";} 
}
?>