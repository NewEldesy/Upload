<?php
include_once('conf.php');
$uploadDirectory = 'uploads/';

if (isset($_POST)) {
    //var_dump($_FILES); die();
    // Vérification de l'existence du fichier et gestion des erreurs
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo "Erreur lors du téléchargement du fichier.";
        exit;
    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Validation du type de fichier et de la taille
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxFileSize = 5 * 1024 * 1024; // 5 Mo

    if (!in_array($_FILES['file']['type'], $allowedTypes) || $_FILES['file']['size'] > $maxFileSize) {
        echo "Type de fichier non autorisé ou taille de fichier dépassée.";
        exit;
    }

    $filename = basename($_FILES['file']['name']);
    $destination = $uploadDirectory . $filename;

    // Déplacement du fichier téléchargé
    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
        // Connexion à la base de données (à adapter selon votre configuration)
        $conn = db();

        // Prévention des injections SQL avec des requêtes préparées
        $sql = "INSERT INTO profile (nom, prenom, filename) VALUES (:nom, :prenom, :filename)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":filename", $filename);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Enregistrement dans la base de données réussi.";
                header('location:profile.php');
            } else {
                echo "Erreur d'enregistrement dans la base de données.";
            }
        } else {
            echo "Erreur de préparation de la requête SQL.";
        }
    } else {
        echo "Erreur lors de l'enregistrement du fichier.";
    }
} else {
    echo "Méthode de requête incorrecte.";
}
?>