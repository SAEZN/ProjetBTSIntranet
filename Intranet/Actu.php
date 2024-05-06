<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualité</title>
</head>
<body>
<?php require('include/entete.inc.php');?>
<?php

// Récupération du flux RSS
$feed = simplexml_load_file('https://www.udaf11.fr/feed/');

// Boucle sur les articles du flux RSS
foreach ($feed->channel->item as $item) {
    $title = $item->title;
    $link = $item->link;
    $description = $item->description;
    $date = date('d/m/Y', strtotime($item->pubDate));
    
    // Affichage des articles dans une card Bootstrap
    echo '
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">' . $title . '</h5>
            <p class="card-text">' . $description . '</p>
            <p class="card-text"><small class="text-muted">Publié le ' . $date . '</small></p>
            <a href="' . $link . '" target="_blank" class="btn btn-primary">Lire l\'article</a>
        </div>
    </div>';
}

?>
<?php require('include/pied.inc.php');?>
</body>
</html>