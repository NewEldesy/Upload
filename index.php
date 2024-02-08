<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Create Profil</title>
    </head>
    <body>
        <h1>Créer Profil</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="nom">Nom</label>
            <br>
            <input type="text" name="nom" maxlength="100" required>
            <br><br>
            <label for="prenom">Prénom</label>
            <br>
            <input type="text" name="prenom" maxlength="150" required>
            <br><br>
            <input type="file" name="file" accept="image/jpeg, image/png" required>
            <br><br>
            <button type="submit">Upload</button>
        </form>
    </body>
</html>
