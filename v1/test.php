<!DOCTYPE html>
<html>
<head>
    <title>Upload d'image en PHP</title>
</head>
<body>

<form action="test2.php" method="post" enctype="multipart/form-data">
    <!-- Sélectionnez une image à uploader : -->
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br><br>
    <input type="submit" value="Uploader l'image" name="submit">
</form>

</body>
</html>