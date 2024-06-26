<?php
$servername = "localhost";
$username = "root";
$password = ""; // ou votre mot de passe
$dbname = "intranet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: PartageDocument.php?success=delete");
    exit();
} else {
    echo "ID de fichier manquant.";
}

$conn->close();
?>