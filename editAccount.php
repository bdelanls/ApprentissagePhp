<?php 
session_start();
include('script/functions.php');

/**
 * Init
 */

$data = openDB();
$userID = 0;
$users = $data["user"];
$role = false;

$emailSession = $_SESSION['user']['email'];

foreach ($users as $user){
    if ($user["email"] === $emailSession){
        $role = true;
        break;
    }
    $userID++;
}


if(!$role){
    header("Location: /");
}

/**
 * Form
 */


if (!empty($_POST)) {
    $securizedDataFromForm = treatFormData(
        $_POST,
        "name",
        "firstName",
        "email",
        "password",
    );
    $photo = $_FILES['photo'];
    extract($securizedDataFromForm, EXTR_OVERWRITE);

    if (isset($name) && $name) {
        $data['user'][$userID]['name'] = $name;
    }
    if (isset($firstName) && $firstName) {
        $data['user'][$userID]['firstName'] = $firstName;
    }
    if (isset($email) && $email) {
        $validEmail = true;
        foreach($data['user'] as $user){
            if (($user['email'] === $email) && ($user != $data['user'][$userID])){
                $validEmail = false;
                break;
            }
        }
        if ($validEmail){
            $data['user'][$userID]['email'] = $email;
        }
        
    }

    if (isset($password) && $password) {
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $data['user'][$userID]['password'] = $passwordHash;
    }

    if (isset($photo) && $photo['name']){
        $errorFile = "";

        $theFileOnServer = $photo['tmp_name'];
        $autorizedMime = ["image/jpeg", "image.jpg", "image/gif", "image/png"];

        // test mime type
        $testMime = mime_content_type($theFileOnServer);
        if (!in_array($testMime, $autorizedMime)){
            $errorFile = "Le fichier n'est pas reconnu comme une image.";
        }

        // test uploaded file
        if (!is_uploaded_file($theFileOnServer)){
            $errorFile = "Il y a une erreur d'upload du fichier.";
        }

        // test size
        $fileSize = filesize($theFileOnServer);
        if (99000 < $fileSize) {
            $errorFile = "Le fichier est trop volumineux.";
        }

        if (!$errorFile){
            $originalFileName = basename($photo['name']);
            $ext = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $mainName = pathinfo($originalFileName, PATHINFO_FILENAME);
            $tmpCleanedName = preg_replace("/\s/", "-", $mainName);
            $tmpCleanedName = trim($tmpCleanedName, "-");
            $finalName = $tmpCleanedName . uniqid() . "." . $ext;
            $destination = UPLOADFOLDER . $finalName;
            $successUpload = move_uploaded_file($theFileOnServer, $destination);
            if (!$successUpload){
                $errorFile = "Il y a eu un problème lors de l'upload.";
            }else{
                $data['user'][$userID]['photo'] = $finalName;
            }
        }
    }
    
    writeDB($data);
    $validMAJ = true;
    
}



$name = $data['user'][$userID]['name'];
$firstName = $data['user'][$userID]['firstName'];
$email = $data['user'][$userID]['email'];
$photo = $data['user'][$userID]['photo'];




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
        <h1>Modifier mon compte</h1>

        <?php 
            if (isset($validEmail) && !$validEmail){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    L\'email existe déjà, choisissez-en un autre.
                </div>';
            }
            if (isset($errorFile) && $errorFile){
                echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>'
                    .$errorFile.
                '</div>';
            }
            if (isset($validMAJ)){
                echo '<div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    Les informations ont bien été mises à jour.
                </div>';
            }

        ?>


        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name">Nom : </label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="firstName">Prénom : </label>
                <input type="text" name="firstName" id="firstName" class="form-control" value="<?php echo $firstName; ?>">
            </div>
            <div class="mb-3">
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Lissez vide si vous ne voulez pas modifier votre mot de passe">
            </div>
            <div class="mb-3">
                <label for="photo">Photo de profil : </label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <?php if ($photo): ?>
                <div class="mb-3">
                    <img src="img/upload/<?php echo $photo; ?>" alt="">
                </div>
            <?php endif ?>    
            <input type="submit" value="Mettre à jour" class="btn btn-primary">
        </form>


    </div>
  

</body>
</html>