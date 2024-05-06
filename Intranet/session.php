<?php
   // Définir une durée de vie de 1 heure pour le cookie de session
   $lifetime = 3600; // durée de vie en secondes (1 heure = 3600 secondes)
   session_set_cookie_params($lifetime);
   
   session_start();
   
   // Vérifiez si l'utilisateur est connecté
   if (!isset($_SESSION)) {
      
     // Redirigez l'utilisateur vers la page de connexion
     header('Location: login.php');
     exit();
   }
?>