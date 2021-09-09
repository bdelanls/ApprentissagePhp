<?php 
    session_start();
    include('script/functions.php');

    $errorMessage = "";

    if (!empty($_POST)) {
        $securizedDataFromForm = treatFormData(
            $_POST,
            "email",
            "password",
        );

        extract($securizedDataFromForm, EXTR_OVERWRITE);
        $data = openDB();
        $users = $data["user"];
    
        foreach($users as $user){
            if($email == $user["email"]){
                $canConnect = password_verify($password, $user["password"]);
                if($canConnect){
                    $_SESSION["user"] = [
                        "name" => $user["name"],
                        "firstName" => $user["firstName"],
                        "email" => $user["email"],
                        "role" => $user["role"],
                    ];
                    header("Location: /");
                }
            }
            $errorMessage = "L'email ou le mot de passe est invalide !";
        }
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
        <h1>Connexion</h1>
        <?php
            if($errorMessage){
                echo $errorMessage;
                echo '
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>'
                    .$errorMessage.
                '</div>';
            }
        ?>

        <form method="post">
            <div class="mb-3">
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <input type="submit" value="Connexion" class="btn btn-primary">
        </form>

    </div>
  

</body>
</html>