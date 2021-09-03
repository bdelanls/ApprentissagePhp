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

        <h3>Système d'encodage et de décodage de vigenère</h3>
        <p>Vous pouvez entrer un message et une clé ou la clé et le message à décoder.</p>
        <form method="post">
            <div class="mb-3">
                <label for="message" class="form-label">Le message : </label>
                <input type="text" name="message" id="message" class="form-control">
            </div>
            <div class="mb-3">
                <label for="key" class="form-label">La clé : </label>
                <input type="text" name="key" id="key"  class="form-control">
            </div>
            <div class="mb-3">
                <label for="messageEncode" class="form-label">Le message codé : </label>
                <input type="text" name="messageEncode" id="messageEncode"  class="form-control">
            </div>
            <div class="mb-3">
                <input type="reset" value="Annuler"  class="btn btn-secondary">
                <input type="submit" value="Vigenériser"  class="btn btn-primary">
            </div>
        </form>

    </div>
  

</body>
</html>