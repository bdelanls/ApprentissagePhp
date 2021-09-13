<?php 
session_start();
include("script/functions.php");

$data = openDB();
$users = $data["user"];
$role = false;

$email = $_SESSION['user']['email'];

foreach ($users as $user){
    if ($user["email"] === $email){
        $name = $user["name"];
        $firstName = $user["firstName"];
        $role = true;
        $photo = $user["photo"];
        break;
    }
}

if(!$role){
    header("Location: /");
}


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
        <h1>Mon compte</h1>

        <div class="card w-50">
            <div class="card-body">
                <p class="card-text">Nom : <?php echo $name; ?></p>
                <p class="card-text">Prénom : <?php echo $firstName; ?></p>
                <p class="card-text">Email : <?php echo $email; ?></p>
                <?php if ($photo): ?>
                    <p><img src="img/upload/<?php echo $photo; ?>" alt=""></p>
                <?php else: ?>
                <p class="card-text">Pas de photo de profil</p>
                <?php endif ?>   
                <a href="editAccount.php" class="btn btn-primary mt-2">Modifier mes informations</a>
            </div>
        </div>

    </div>
  

</body>
</html>