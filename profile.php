<?php
// Connexion à la base de données (à adapter selon votre configuration)
$conn = new mysqli('localhost', 'admin', 'Admin1234!', 'Upload');

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des noms de fichier depuis la base de données
$sql = "SELECT nom, prenom, filename FROM profile";
$result = $conn->query($sql);
?>
<table>
    <thead>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Images</th>
    </thead>
<?php
while ($row = $result->fetch_assoc()) {
    ?>
    <tbody>
        <td><?=$row['nom']?></td>
        <td><?=$row['prenom']?></td>
        <td><img src='uploads/<?=$row['filename']?>' alt='<?=$row['filename']?>' style="width:250px; height:100px;"></td>
    </tbody>
<?php
}
$conn->close();
?>
</table>