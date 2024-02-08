<?php
include_once('conf.php');

if(isset($_POST) && isset($_FILES)){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $file = $_FILES['file'];
    $uploadDir = 'uploads/';
    $filename = basename($file['name']);

    $connexion = db();
    $query = "INSERT INTO profile SET Nom=:nom, Prenom=:prenom, Filename=:filename";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);

    $uploadFilename = $uploadDir . $filename;
    if(move_uploaded_file($file['tmp_name'], $uploadFilename)){
        $stmt->bindParam(":filename", $filename);
        $stmt->execute();
        header('location : profile.php');
    }
    else{ echo "fail";}

    
}
?>