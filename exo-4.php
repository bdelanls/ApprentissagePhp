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
    <title>Premier projet</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js" defer></script>
</head>
<body>
    <?php include('./partial/_navBar.php') ?>

    <div class="container">
    <h1>Exercice 4</h1>
    <h5>1- créer une <a href="https://www.latoilescoute.net/table-de-vigenere" target="_blank">table de vigenère</a></h5>
    <?php
    // TO DO

    $keyArr = [];
    $tabVigenere = [];
    $keyString = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    $keyArr = str_split($keyString);

    $keyVigenere = [];

    $tab = $keyArr;

    for($i = 0; $i<count($keyArr); $i++){

        for($j = 0; $j<count($keyArr); $j++){
            
            $keyVigenere[$keyArr[$j]] = $tab[$j];            
        }

        $tabVigenere[$keyArr[$i]] = $keyVigenere;

        $tab[] = $tab[0];
        array_splice($tab, 0, 1);

    }
    
    //var_dump($tabVigenere);
    //echo $tabVigenere['E']['O'];


    ?>
    <h5>2- encode le message "APPRENDRE PHP EST UNE CHOSE FORMIDABLE" avec la clé "BACKEND"</h5>
    <?php
    $message = "APPRENDRE PHP EST UNE CHOSE FORMIDABLE";
    $key = "BACKEND";
    // TO DO
    $cryptedMessage = "";
    /**
    * astuce pour la rotation de la clé BACKEND
    * 14 / 7 -> 2
    * 15 / 7 -> 2 reste 1
    * pour récuperer le "reste 1" il faut faire un modulo
    * 15 % 7 -> 1
    * 176 % 7 -> 1 (25 x 7 et reste 1)
    */

    $tabCleBackend = str_split($key);
    $tabMessage = str_split($message);
   
    $numCle = 0;

    for($i = 0; $i < count($tabMessage); $i++){

        if($tabMessage[$i] === " "){
            $cryptedMessage .= " ";
        }else{
            $cryptedMessage .= $tabVigenere[$tabMessage[$i]][$tabCleBackend[$numCle]];
        }

        if($numCle == count($tabCleBackend) -1){
            $numCle = 0;
        }else{
            $numCle++ ;
        }
        
    }



    ?>
    <p>le message est: <?php echo $message; ?></p>
    <p>la clé est: <?php echo $key ?></p>
    <p>le résultat est: <?php echo $cryptedMessage; ?></p>
    <h5>3- decoder le message "TWA PEE WM TESLH WL LSLVNMRJ" avec la clé "VIGENERE"</h5>
    <?php
    $encodedMessage = "TWA PEE WM TESLH WL LSLVNMRJ";
    $key4decode = "VIGENERE";
    // TO DO

    $tabCleDecode = str_split($key4decode);
    $tabMessageEncode = str_split($encodedMessage);
    $decodedMessage = "";

    $numCle = 0;

    for($i = 0; $i < count($tabMessageEncode); $i++){

        if($tabMessageEncode[$i] === " "){
            $decodedMessage .= " ";
        }else{

            foreach($tabVigenere as $key => $value){
                if($tabVigenere[$key][$tabCleDecode[$numCle]] === $tabMessageEncode[$i]){
                    $decodedMessage .= $key;
                }
            }
        }

        if($numCle == count($tabCleDecode) -1){
            $numCle = 0;
        }else{
            $numCle++ ;
        }
    }


    ?>
    <p>le message chiffré est: <?php echo $encodedMessage; ?></p>
    <p>la clé est: <?php echo $key4decode ?></p>
    <p>le résultat est: <?php echo $decodedMessage; ?></p>

    </div>
  

</body>
</html>