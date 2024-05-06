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
	<table>
		<thead>
			<tr>
				<th>Nom du fichier</th>
				<th>Taille</th>
				<th>Date de modification</th>
				<th>Télécharger</th>
				<th>Supprimer</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$dir = "uploads/";
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					while (($file = readdir($dh)) !== false) {
						if ($file != "." && $file != "..") {
							$path = $dir . $file;
							$size = filesize($path);
							$date = date("d/m/Y H:i:s", filemtime($path));
							echo "<tr>";
							echo "<td>$file</td>";
							echo "<td>$size octets</td>";
							echo "<td>$date</td>";
							echo "<td><a href='$path' download>Télécharger</a></td>";
							echo "<td><a href='suppr.php?file=$file'>Supprimer</a></td>";
							echo "</tr>";
						}
					}
					closedir($dh);
				}
			}
			?>
		</tbody>
	</table>
</div>