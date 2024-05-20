<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intranet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT filename, filetype, filedata FROM files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filename, $filetype, $filedata);
    $stmt->fetch();
    $stmt->close();

    if ($filedata) {
        header("Content-Type: " . $filetype);
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        echo $filedata;
        exit();
    } else {
        echo "Fichier non trouvé.";
    }
} else {
    echo "ID de fichier manquant.";
}

$conn->close();
?>