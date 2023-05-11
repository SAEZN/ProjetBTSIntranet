<?php
include('session.php');


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
		//  // Vérifiez si l'utilisateur est autorisé à supprimer des fichiers
        //  if ($can_delete) {
        //     echo '<h2>Supprimer des fichiers</h2>';
        //     echo '<form action="" method="post">';
        //     echo '<div class="form-group">';
        //     echo '<label for="fileToDelete">Sélectionnez le fichier à supprimer :</label>';
        //     echo '<select name="fileToDelete" id="fileToDelete" class="form-control">';
        //     $files = scandir("uploads/");
        //     for ($i = 2; $i < count($files); $i++) {
        //         echo '<option value="'.$files[$i].'">'.$files[$i].'</option>';
        //     }
        //     echo '</select>';
        //     echo '</div>';
        //     echo '<button type="submit" class="btn btn-danger">Supprimer</button>';
        //     echo '</form>';
    
        // }
    
        // if(isset($_POST['fileToDelete'])) {
        //     $fileToDelete = $_POST['fileToDelete'];
        //     $filePath = "uploads/".$fileToDelete;
        //     if (file_exists($filePath)) {
        //         unlink($filePath);
        //         echo '<div class="alert alert-success alert-dismissible">';
        //         echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        //         echo '<strong>Succès :</strong> Le fichier '.$fileToDelete.' a été supprimé.';
        //         echo '</div>';
        //     } else {
        //         echo '<div class="alert alert-danger alert-dismissible">';
        //         echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        //         echo '<strong>Erreur :</strong> Le fichier '.$fileToDelete.' n\'existe pas.';
        //     }
        // }

                if(isset($_FILES['fileToUpload'])) {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                        $uploadOk = 1;
                        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    
                        // Vérifier le type de fichier
                        if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx" && $fileType != "xls" && $fileType != "xlsx") {
                            echo '<div class="alert alert-danger alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong>Erreur :</strong> Seuls les fichiers PDF, Word et Excel sont autorisés.
                                    </div>';
                            $uploadOk = 0;
                        }
                    
                        // Vérifier si le fichier existe déjà
                        if (file_exists($target_file)) {
                            echo '<div class="alert alert-danger alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong>Erreur :</strong> Ce fichier existe déjà.
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
                    
                        // Si $uploadOk est toujours égal à 1, cela signifie que le fichier est valide et nous l'uploadons avec la fonction move_uploaded_file()
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                echo '<div class="alert alert-success alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong>Succès :</strong> Le fichier a bien été uploadé.
                                    </div>';
                                    // Redirigez l'utilisateur vers la page d'accueil
                                    header('Location: PartageDocument.php?success=delete');
                                    exit();
                            } else {
                                echo '<div class="alert alert-danger alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong>Erreur :</strong> Une erreur est survenue pendant l\'upload de votre fichier.
                                    </div>';
                            }
                        }
                    }
                    