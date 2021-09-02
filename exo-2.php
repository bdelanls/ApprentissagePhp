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
        <h1>Exercice 2</h1>

        <h3>Décoder des messages</h3>
        <p>les messages à décoder</p>
        <?php
        $message1 = "0@sn9sirppa@#?ia'jgtvryko1";
        $message2 = "q8e?wsellecif@#?sel@#?setuotpazdsy0*b9+mw@x1vj";
        $message3 = "aopi?sgnirts@#?sedhtg+p9l!";
        ?>
        <ul>
            <li>message 1 : <?php echo $message1; ?></li>
            <li>message 2 : <?php echo $message2; ?></li>
            <li>message 3 : <?php echo $message3; ?></li>
        </ul>
        <p>comment proceder?</p>
        <ol>
            <li>Calculer la longueur de la chaîne et la diviser par 2, tu obtiendras ainsi le "chiffre-clé".</li>
            <li>Récupère ensuite la <a href="https://www.php.net/manual/fr/function.substr.php">sous-chaîne</a> de la longueur du chiffre-clé en commençant à partir du 6ème caractère.</li>
            <li>Remplace les chaînes '@#?' par un espace.</li>
            <li>Pour finir, inverse la chaîne de caractères.</li>
        </ol>
        <?php
        /**
         * pour la division, un code à tester:
         * $number = 50;
         * $result = 50 / 2;
         * echo $result;
         */
        // TO DO
        $nbCharMessage1 = strlen($message1) /2 ;
        $strMessage1 = substr($message1, 5, $nbCharMessage1);
        $decodedMessage1 = str_replace("@#?", " ", $strMessage1);
        $decodedMessage1 = strrev($decodedMessage1);

        // TO DO
        $nbCharMessage2 = strlen($message2) /2 ;
        $strMessage2 = substr($message2, 5, $nbCharMessage2);
        $decodedMessage2 = str_replace("@#?", " ", $strMessage2);
        $decodedMessage2 = strrev($decodedMessage2);

        // TO DO
        $nbCharMessage3 = strlen($message3) /2 ;
        $strMessage3 = substr($message3, 5, $nbCharMessage3);
        $decodedMessage3 = str_replace("@#?", " ", $strMessage3);
        $decodedMessage3 = strrev($decodedMessage3);

?>
        <p>résultats:</p>
        <p>message1: <?php echo $decodedMessage1 ?><br>
            message2: <?php echo $decodedMessage2 ?><br>
            message3: <?php echo $decodedMessage3 ?><br>
        </p>

    </div>
</body>
</html>