<?php 
session_start();
include('script/functions.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js" defer></script>
</head>
<body>
    <?php include('./partial/_navBar.php') ?>
    <div class="container">
        <h1>Exercices</h1>
        <p>Lien GitHub : <a href="https://github.com/bdelanls/ApprentissagePhp.git">https://github.com/bdelanls/ApprentissagePhp.git</a></p>
        <h3>Les exercices en php</h3>
        <ul>
            <li>Premier exercice</li>
            <li><a href="exo-2.php">Exercice 2</a> : décoder des chaînes de caractères</li>
            <li><a href="exo-3.php">Exercice 3</a> : travailler avec des tableaux</li>
            <li><a href="exo-4.php">Exercice 4</a> : travailler avec des boucles</li>
            <li><a href="exo-5.php">Exercice 5</a> : encodage et décodage avec un formulaire</li>
            <li><a href="exo-6.php">Exercice 6</a> : mise en oeuvre de la boucle while</li>
            <li><a href="exo-7.php">Exercice 7</a> : encodage et décodage (suite)</li>
        </ul>

    </div>


</body>
</html>