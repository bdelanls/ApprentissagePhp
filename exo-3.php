<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier projet</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js" defer></script>
</head>
<body>
    <?php include('./partial/_navBar.php') ?>

    <div class="container">
    <h1>Exercice 3</h1>
        <?php
        $tab1 = ["moteur", "carotte", "haricot", "pomme de terre", "usine", "salade", "navet", "marteau"];
        ?>
        <p>voici les éléments du tableau de base:
        <ul>
            <li><?php echo $tab1[0]; ?></li>
            <li><?php echo $tab1[1]; ?></li>
            <li><?php echo $tab1[2]; ?></li>
            <li><?php echo $tab1[3]; ?></li>
            <li><?php echo $tab1[4]; ?></li>
            <li><?php echo $tab1[5]; ?></li>
            <li><?php echo $tab1[6]; ?></li>
            <li><?php echo $tab1[7]; ?></li>
        </ul>
        </p>
        <h3>Premier exercice:</h3>
        <p>retirer les 3 intrus: et afficher les valeurs</p>
        <p>résultat:
            <?php
            // TO DO
            array_splice($tab1, 0, 1);
            array_splice($tab1, 3, 1);
            array_splice($tab1, 5, 1);
            // var_dump($tab1);


            ?>
        <ul>
            <li><?php echo $tab1[0]; ?></li>
            <li><?php echo $tab1[1]; ?></li>
            <li><?php echo $tab1[2]; ?></li>
            <li><?php echo $tab1[3]; ?></li>
            <li><?php echo $tab1[4]; ?></li>
        </ul>
        </p>
        <h3>Second exercice:</h3>
        <p>transformaer la chaîne de caractère "bleu, vert, noir, rouge, jaune" en un tableau</p>
        <p>ajouter en première position du tableau la valeur "violet"</p>
        <p>résultat:
            <?php
            // TO DO

            $colors = "bleu, vert, noir, rouge, jaune";
            $arrColors = explode(", ", $colors);
            array_unshift($arrColors, "violet");

            ?>
            <ul>
                <li><?php  echo $arrColors[0]; 
                    ?></li>
                <li><?php  echo $arrColors[1]; 
                    ?></li>
                <li><?php  echo $arrColors[2]; 
                    ?></li>
                <li><?php  echo $arrColors[3]; 
                    ?></li>
                <li><?php  echo $arrColors[4]; 
                    ?></li>
                <li><?php  echo $arrColors[5]; 
                    ?></li>
            </ul>
        </p>

    </div>
  

</body>
</html>