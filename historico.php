<?php
include_once("api/api_funcitons.php");
//começa uma sessão
session_start();
//se o username não existir na sessão
if (!isset($_SESSION['username'])) {
    //vai para index.php
    header("refresh:5;url=index.php");
    //mostra ACESSO RESTRITO
    die("Acesso Restrito.");
    //acaba o if
    //<meta http-equiv="refresh" content="5">
}
if(!isset($_GET['log'])){
    $aux=TODOS;
}else{
    $aux=$_GET['log'];
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataforma IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboardStyle.css">

</head>
<body class="body-park">
<div class="container">
    <div class="row">
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
                        <a class="nav-link" aria-current="page" href="#">Histórico</a>
                        <a class="nav-link" aria-current="page" href="#fotos">Fotos</a>
                        <a class="nav-link" aria-current="page" href="#luzes">Luzes</a>
                        <a class="nav-link" aria-current="page" href="#veiculos">Veiculos</a>
                    </div>
                    <div class="w-100 text-end">
                        <button class="btn btn-outline-danger" type="" onclick="window.location.replace('logout.php');">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>
                <?php
                //escolher que logs mostrar
                if ($aux == CAMARA || $aux == TODOS) {
                    echo('<div class="card card-theme mt-2 mb-2"><div class="card-body"><h5><a id="fotos">Fotos</a></h5>');
                    $log = getFotosLog();
                    echo('<table class="table">
                  <thead>
                    <tr>
                      <th>Data/Hora</th>
                      <th>Foto</th>
                    </tr>
                  </thead>
                  <tbody>');
                    //dividir a informação dos logs
                    $log_array = array();
                    foreach ($log as $entry) {
                        $log_array[] = explode(";", $entry);
                    }
                    //imprimir a informação dos logs
                    foreach ($log_array as $entry) {
                        echo("<tr><td>" . $entry[0] . "</td><td><a href='image.php?image=imageLogs/" . $entry[1] . "&log=" . $aux . "' target='_self'>" . $entry[1] . "</a></td></tr>");
                    }
                    echo('   </tbody>
                </table>
                ');
                    echo('</div></div>');
                }

                if ($aux == LUZES || $aux == TODOS) {
                    echo('<div class="card card-theme mt-2 mb-2"><div class="card-body"><h5><a id="luzes">Luzes</a></h5>');
                    $log = getLuzesLog();
                    echo('<table class="table">
                              <thead>
                                <tr>
                                  <th>Data/Hora</th>
                                  <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>');
                    $log_array = array();
                    foreach ($log as $entry) {
                        $log_array[] = explode(";", $entry);
                    }
                    foreach ($log_array as $l) {
                        echo('<tr>
                                  <td>' . $l[0] . '</td>
                                  <td>');
                        if ($l[1] == "1") {
                            echo '<span class="nav-pill nav-pill-success">Ativado</span>';
                        } else {
                            echo '<span class="nav-pill nav-pill-danger">Desativado</span>';
                        }
                        echo('</td></tr>');
                    }
                    echo('</tbody></table>');
                    echo('</div></div>');
                }

                if ($aux == CONTADOR || $aux == TODOS) {
                    echo('<div class="card card-theme mt-2 mb-2"><div class="card-body"><h5><a id="veiculos">Veiculos</a></h5>');
                    $log = getVeiculoLog();
                    echo('<table class="table">
                              <thead>
                                <tr>
                                  <th>Data/Hora</th>
                                  <th>Quantidade</th>
                                </tr>
                              </thead>
                              <tbody>');
                    foreach ($log as $entry) {
                        $log_array[] = explode(";", $entry);
                    }
                    foreach ($log_array as $l) {
                        print('<tr><td>' . $l[0] . '</td>
                               <td>' . $l[1] . '</td></tr>');
                    }
                    echo('</tbody></table>');
                    echo('</div></div>');
                }
                ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</div>
</body>
</html>
