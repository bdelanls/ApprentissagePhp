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
    <h1>Exercice 6</h1>
       <?php
       $code = hexdec("223a");
       $result = "tout les gagnants ont joué, essayez";
       $response = "";
       if (!empty($_POST)) {
           if ($_POST["try"]) {
               $try = strip_tags($_POST["try"]);
           }
           if (isset($try)) {

                if ($code == $try) {
                    $result = "bien joué, le code est $try";
                } else {
                    $result = "non, le code n'est pas $try";

                    $test = 0;
                    while ($test <= 10000) {

                        if($test === $code){
                            $response = $test;
                            break;
                        }
                        $test++;
                    }
                }

                

               
           }
       }
       // TO DO with while
       
       ?>
       <p>le code à trouver est fixe, tentez votre chance ou faites en sorte que la machine vous aide à trouver la bonne réponse</p>
       <?php if ($response) : ?>
           <p>la réponse est : <?php echo $response; ?></p>
       <?php endif ?>
       <form method="post">
           <div class="form-group">
               <label class="col-form-label" for="try">trouver le code</label>
               <input type="text" class="form-control border border-3" name="try">
           </div>
           <a href="/exo6.php" class="btn btn-primary mt-3 mb-3">Annuler</a>
           <input type="submit" class="btn btn-primary mt-3 mb-3" value="essayer">
       </form>
       <p><?php echo $result; ?></p>

    </div>
  

</body>
</html>