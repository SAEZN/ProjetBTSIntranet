<?php require('include/entete.inc.php');?>

<!DOCTYPE html>
<html>
<head>
    <title>Partage de fichiers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Partage de fichiers</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fileToUpload">Sélectionner un fichier :</label>
            <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Nom du fichier</th>
                <th>Taille</th>
                <th>Télécharger</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            $servername = "localhost";
            $username = "root";
            $password = ""; // ou votre mot de passe
            $dbname = "intranet";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Récupérer les fichiers depuis la base de données
            $sql = "SELECT id, filename, filetype, filedata FROM files";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $filename = $row['filename'];
                    $filetype = $row['filetype'];
                    $filesize = strlen($row['filedata']); // La taille des données binaires
                    echo "<tr>";
                    echo "<td>$filename</td>";
                    echo "<td>$filesize octets</td>";
                    echo "<td><a href='download.php?id=".$row['id']."' class='btn btn-primary'>Télécharger</a></td>";
                    echo "<td><a href='suppr.php?id=".$row['id']."' class='btn btn-danger'>Supprimer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun fichier disponible.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>