<?php 
session_start();
if($_SESSION["autoriser"]!="oui"){
   header("location:login.php");
   exit();
}
if(date("H")<18)
   $bienvenue="Bonjour et bienvenue ".
   $_SESSION["prenomNom"].
   " dans votre espace personnel";
else
   $bienvenue="Bonsoir et bienvenue ".
   $_SESSION["prenomNom"].
   " dans votre espace personnel";
     
  date_default_timezone_set('EUROPE/Paris');
  setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
  setcookie("visite",strftime("Dernière connexion %A %d %B %Y heure %H h %M"),time()*60);
  include ('mesFonctions.inc.php');
  include("svg.inc.php");
?>
<!doctype html>
<html lang="fr">
  <head>
    <title>Intranet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="SAEZ Nathan">
   
    <!-- CSS bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- CSS perso -->
    <link href="css/styles.css" rel="stylesheet">
  </head>
  <body>  
    <header>
      <?php include("menu.inc.php"); ?>
    </header>