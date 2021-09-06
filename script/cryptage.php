<?php 



// Initialisation de la table de Vigenère
function createVigenere():array{
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
    return $tabVigenere;
}

// Encodage avec table de Vigenère
function encode(string $txt, string $key, array $tabVigenere):string{
    $tabCleBackend = str_split($key);
    $tabMessage = str_split($txt);
    $cryptedMessage = "";
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

    return $cryptedMessage;
}

// Décodage avec table de Vigenère
function decode(string $txt, string $key, array $tabVigenere):string{
    $tabCleDecode = str_split($key);
    $tabMessageEncode = str_split($txt);
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
    return $decodedMessage;
}

// init table Cesar
function initCesar():array{
    $keyString = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $keyString .= $keyString; 
    $arrCesar = str_split($keyString);
    return $arrCesar;

}

// codage César
function encodeCesar(string $txt, int $key, array $tabCesar):string{
    $arrText = str_split($txt);
    $message = "";

    for($i = 0; $i < count($arrText); $i++){
        if($arrText[$i] !== " "){   
            $num = array_search($arrText[$i], $tabCesar);
            $message .= $tabCesar[$num + $key];
        }else{
            $message .= " ";
        }
    }
    return $message;

}
// déodage César
function decodeCesar(string $txt, int $key, array $tabCesar):string{
    $arrText = str_split($txt);
    $message = "";

    for($i = 0; $i < count($arrText); $i++){
        if($arrText[$i] !== " "){
            $num = array_search($arrText[$i], $tabCesar);
            $message .= $tabCesar[($num + 26) - $key];
        }else{
            $message .= " ";
        }
    }
    return $message;

}