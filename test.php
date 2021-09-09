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
        <h1>Test</h1>

        <pre>
====================================
<?php 



if (isset($_SESSION["user"])){
    echo "Bonjour ".$_SESSION["user"]["firstName"] .", vous êtes connecté !";
}else{
    echo "Vous êtes inconnu !";
}

echo "<br>";
var_dump($_SESSION);


    
?>

====================================
        </pre>

    </div>
  

</body>
</html>