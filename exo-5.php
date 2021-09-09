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
        <h1>Exercice 5</h1>

        <?php 

        $message = "";
        $messageEncode = "";
        $key = "";

        $formValid = false;

            if (!empty($_POST)) {
                if (isset($_POST["message"])){
                    $message = strip_tags($_POST["message"]);
                }
                if (isset($_POST["key"])){
                    $key = strip_tags($_POST["key"]);
                }
                if (isset($_POST["messageEncode"])){
                    $messageEncode = strip_tags($_POST["messageEncode"]);
                }
                
                // Alert message !
                $arrAlert = [];

                if (empty($key)){
                    $arrAlert[] = "La clé est obligatoire.";
                }
                if (empty($message) && empty($messageEncode)){
                    $arrAlert[] = "Le champ \"message\" ou \"message codé\" doit être renseigné.";
                }
                if (!empty($message) && !empty($messageEncode)){
                    $arrAlert[] = "Seul un champ doit être renseigné, \"message\" ou \"message codé\"";
                }

                if (!empty($arrAlert)){
                    echo '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Attention !</strong> <ul>';
                        
                        for ($i = 0; $i < count($arrAlert); $i++){
                            echo "<li>$arrAlert[$i]</li>";
                        }
                        
                    echo '</ul>Essayez encore.
                        </div>';

                }else  if(!preg_match('#^[a-zA-Z\s]*$#',$message) || !preg_match('#^[a-zA-Z]*$#',$key) || !preg_match('#^[a-zA-Z\s]*$#',$messageEncode)){
                    echo '
                    <div class="alert alert-dismissible alert-danger">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Attention !</strong> Pas d\'accents ni de caracères spéciaux et pas d\'espace dans la clé, essayez encore
                    </div>';
                }else{
                    $formValid = !$formValid;
                }

                // It's ok, start encode or decode
                
                if($formValid){
                    
                    $message = strtoupper($message);
                    $key = strtoupper($key);
                    $messageEncode = strtoupper($messageEncode);

                    $tabVigenere = createVigenere();

                    if(empty($message)){
                        // decode
                        $message = decode($messageEncode, $key, $tabVigenere);

                    }else{
                        // encode
                        $messageEncode = encode($message, $key, $tabVigenere);
                    }
                }
            }

        function createVigenere(){
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

        function encode($txt, $key, $tabVigenere){
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

        function decode($txt, $key, $tabVigenere){
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


           //var_dump($message, $key, $messageEncode);

        ?>

        <h3>Système d'encodage et de décodage de vigenère</h3>
        <p>Vous pouvez entrer un message et une clé ou la clé et le message à décoder.</p>
        <form method="post">
            <div class="mb-3">
                <label for="message" class="form-label">Le message : </label>
                <input type="text" name="message" id="message" class="form-control" value="<?php echo $message ?>">
            </div>
            <div class="mb-3">
                <label for="key" class="form-label">La clé : </label>
                <input type="text" name="key" id="key"  class="form-control" value="<?php echo $key ?>">
            </div>
            <div class="mb-3">
                <label for="messageEncode" class="form-label">Le message codé : </label>
                <input type="text" name="messageEncode" id="messageEncode"  class="form-control" value="<?php echo $messageEncode ?>">
            </div>
            <div class="mb-3">
                <input type="reset" value="Annuler"  class="btn btn-secondary" onclick="emptyForm();">
                <input type="submit" value="Vigenériser"  class="btn btn-primary">
            </div>
        </form>

    </div>
  
<script>
    function emptyForm(){
        var messageValue = document.querySelector('#message');
        var keyValue = document.querySelector('#key');
        var messageEncodeValue = document.querySelector('#messageEncode');
        messageValue.defaultValue = "";
        keyValue.defaultValue = "";
        messageEncodeValue.defaultValue = "";
        
    }
</script>
</body>
</html>