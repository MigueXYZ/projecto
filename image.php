<?php
//se receber uma imagem, mostra
if (isset($_GET['image'])) {
    $image = $_GET['image'];
    echo('
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Plataforma IoT</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
                <link rel="stylesheet" href="css/dashboardStyle.css">
            
            </head>
            <body class="body-park">
            <div class="container">
    ');
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<img class="card-img-top" src="' . $image . '">';
    echo '</div>';
    echo '</div>';
    // Mostrar um botão voltar
    echo '<div class="mt-3"><a class="btn btn-secondary" href="historico.php?log='.$_GET["log"].'">Voltar</a></div>';

    echo('    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
              </body>
            </html>'
    );
} else {
    echo 'No image specified.';
}
?>
