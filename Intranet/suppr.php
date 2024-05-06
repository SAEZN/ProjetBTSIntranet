<?php
session_start();
// Supprimez le fichier
unlink('uploads/' . $_GET['file']);

// Redirigez l'utilisateur vers la page d'accueil
 header('Location: PartageDocument.php?success=delete');
exit();
?>