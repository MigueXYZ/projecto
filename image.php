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

            <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2 rounded-bottom card-theme">
                <div class="container-fluid">
                    <a class="navbar-brand">Dashboard Parque Inteligente</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" href="dashboard.php">Home</a>
                            <a class="nav-link" href="historico.php?log='.$_GET["log"].'">Histórico</a>
                        </div>
                        <div class="w-100 text-end">
                            <button class="btn btn-outline-danger" onclick="window.location.replace(\'logout.php\');">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
        </nav>

                            
    ');
    echo '<div class="card card-full">';
    echo '<div class="card-body d-flex justify-content-center">';
    echo '<img class="card-img-top card-full rounded" src="' . $image . '" alt="'.$image.'">';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Mostrar um botão voltar
    echo('    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
              </body>
            </html>'
    );
} else {
    echo 'No image specified.';
}
?>
