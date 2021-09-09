<?php 
session_start();
include('script/functions.php');

if (!empty($_POST)) {
    $securizedDataFromForm = treatFormData(
        $_POST,
        "title",
        "note",
    );

    extract($securizedDataFromForm, EXTR_OVERWRITE);
}

$data = openDB();

if (isset($title, $note)) {
    array_push($data['note'], [
        'title' => $title,
        'note' => $note,
    ]);
    writeDB($data);
}
$notes = $data["note"];

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
        <h1>Page de prise de note</h1>



        <form action="" method="post">
            <div class="mb-3">
                <label for="title">Titre de la note : </label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="note">La note : </label>
                <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </div>
        </form>

        <div>
            <?php
            // vérifie si le fichier jsonDB.json existe
            if ($notes) {
                $num = 1;
                echo '
                <div class="accordion" id="accordionNotes">';

                foreach ($notes as $value) {
                    
                    echo '
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading'.$num.'">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse'.$num.'" aria-expanded="false" aria-controls="flush-collapse'.$num.'">'.
                                $value['title']
                            .'</button>
                            </h2>
                            <div id="flush-collapse'.$num.'" class="accordion-collapse collapse" aria-labelledby="flush-heading'.$num.'" data-bs-parent="#accordionNotes">
                            <div class="accordion-body"><pre>'. $value['note'] .'</pre></div>
                            </div>
                        </div>';
                    $num++;
                }

                echo '</div>';

            } else {
                echo "Aucune note existante !";
            }
            ?>
        </div>

    </div>


</body>

</html>