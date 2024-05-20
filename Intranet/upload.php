<?php
include('session.php');

// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intranet";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Partage de fichiers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <?php
        if(isset($_GET['error'])){
            echo '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Erreur :</strong> Seuls les fichiers PDF, Word et Excel sont autorisés.
                  </div>';
        }
        elseif(isset($_GET['success'])){
            echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Succès :</strong> Le fichier a bien été uploadé.
                  </div>';
        }
        ?>
    </div>

    <div class="container">
        <h2>Partage de fichiers</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fileToUpload">Sélectionnez un fichier à uploader :</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <div class="container">
        <?php
        if(isset($_FILES['fileToUpload'])) {
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

            // Vérifier le type de fichier
            if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx" && $fileType != "xls" && $fileType != "xlsx") {
                echo '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>Erreur :</strong> Seuls les fichiers PDF, Word et Excel sont autorisés.
                      </div>';
                $uploadOk = 0;
            }

            // Vérifier la taille du fichier
            if ($_FILES["fileToUpload"]["size"] > 500000000) {
                echo '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>Erreur :</strong> Votre fichier est trop volumineux.
                      </div>';
                $uploadOk = 0;
            }

            // Si $uploadOk est toujours égal à 1, cela signifie que le fichier est valide et nous l'uploadons dans la base de données
            if ($uploadOk == 1) {
                $filename = $_FILES["fileToUpload"]["name"];
                $filetype = $_FILES["fileToUpload"]["type"];
                $filedata = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

                // Préparer la requête SQL
                $stmt = $conn->prepare("INSERT INTO files (filename, filetype, filedata) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $filename, $filetype, $filedata);

                if ($stmt->execute()) {
                    echo '<div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Succès :</strong> Le fichier a bien été uploadé.
                          </div>';
                    // Redirigez l'utilisateur vers la page d'accueil
                    header('Location: PartageDocument.php?success=upload');
                    exit();
                } else {
                    echo '<div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Erreur :</strong> Une erreur est survenue pendant l\'upload de votre fichier.
                          </div>';
                }
            }
        }
        ?>
    </div>

    <div class="container">
        <h2>Fichiers disponibles</h2>
        <ul>
            <?php
            // Afficher la liste des fichiers
            $result = $conn->query("SELECT id, filename FROM files");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<li><a href="download.php?id='.$row["id"].'">'.$row["filename"].'</a></li>';
                }
            } else {
                echo "Aucun fichier disponible.";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$conn->close();
?>