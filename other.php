<?php
include_once "conf.php";

if(isset($_POST['submit'])){
    $pdo = db();

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // var_dump($_FILES); die();

    $file = $_FILES['filename'];

    $file_name = $file['name'];
    $tempname = $file['tmp_name'];
    $folder = 'uploads/' . $file_name;

    $query = ("INSERT INTO `profile`(`Nom`, `Prenom`, `Filename`) VALUES (:nom, :prenom, :filename)");
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    if(move_uploaded_file($tempname, $folder)){
        $stmt->bindParam(":filename", $file_name);
        $stmt->execute();
        echo "upload success";
    }
    else{ echo "upload fail"; }
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
    <form method="POST" enctype="multipart/form-data">
        <label for="nom">Nom</label>
        <input type="text" name="nom">
        <br><br>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom">
        <br><br>
        <input type="file" name="filename">
        <br><br>
        <button type="submit" name="submit">Create Profile</button>
    </form>
</body>
</html>