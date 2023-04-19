<?php
    //começa uma sessão
    session_start();
    //se o username não existir na sessão
    if(!isset($_SESSION['username'])){
        //vai para index.php
        header("refresh:5;url=index.php");
        //mostra ACESSO RESTRITO
        die("Acesso Restrito.");
        //acaba o if
    }
    $valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
    $hora_temperatura=file_get_contents("api/files/temperatura/hora.txt");
    $nome=file_get_contents("api/files/temperatura/nome.txt");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataforma IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboardStyle.css">
      <meta http-equiv="refresh" content="5">
</head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">Dashboard EI-TI</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="#">Histórico</a>
                    </div>
                    <div class="w-100 text-end">
                        <button class="btn btn-outline-danger" type="" onclick="window.location.replace('logout.php');">Logout</button>
                    </div>
                </div>
            </div>
        </nav>
        <div class="card">
            <div class="card-body ">
                <div class="row">
                    <div class="col">
                        <h1 class="h1">Servidor IoT</h1>
                        <p>Bem vindo<b> UTILIZADOR XPTO</b> </p>
                        <p>Tecnologias de Internet - Engenharia Informática</p>
                    </div>
                    <div class="col">
                        <img class="float-end d-inline" style="width:300px;" src="imagens/estg.png" alt="estg">
                    </div>
                </div>
            </div>
          </div>
    </div>
    
    <div class="container ">
        <div class="row text-center">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header sensor">
                        <h2><?php echo $nome.": ".$valor_temperatura . "ºC"; ?></h2>
                    </div>
                    <div class="card-body">
                      <img class="align-center" src="imagens/temperature-high.png" alt="Temperatura">
                    </div>
                    <div class="card-footer">
                        <b>Atualização:</b> <?php echo $hora_temperatura; ?> - <a href="#">Histórico</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header sensor">
                      <h2>Humidade: 70%</h2>
                    </div>
                    <div class="card-body">
                        <img class="align-center" src="imagens/humidity-high.png" alt="Humidade">
                      </div>
                      <div class="card-footer">
                          <b>Atualização:</b> 2023/03/10 14:31 - <a href="#">Histórico</a>
                      </div>
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header atuador">
                        <h2>Led Arduino: Ligado</h2>
                    </div>
                    <div class="card-body">
                        <img class="align-center" src="imagens/light-on.png" alt="LED">
                      </div>
                      <div class="card-footer">
                          <b>Atualização:</b> 2023/03/10 14:31 - <a href="#">Histórico</a>
                      </div>
                  </div>
            </div>
        </div>
        <div class="row mt-10">
            <div class="col-sm-12">
                <div class="card">
                    <div class="class-header">
                        <h3>Tabela de Sensores</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tipo de Dispositivo IoT</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Data de Atualização</th>
                                <th scope="col">Estado/Alertas</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td scope="row"><?php echo $nome;?></th>
                                <td><?php echo $valor_temperatura;?> </td>
                                <td><?php echo $hora_temperatura;?></td>
                                <td><span class="badge text-bg-danger"> Elevada </span></td>
                            </tr>
                            <tr>
                                <td scope="row">Humidade</th>
                                <td>70%</td>
                                <td>2023/03/10 14:31</td>
                                <td><span class="badge text-bg-primary"> Normal</span></td>
                            </tr>
                            <tr>
                                <td scope="row">Led Arduino</td>
                                <td>Ligado</td>
                                <td>2023/03/10 14:31</td>
                                <td><span class="badge text-bg-success"> Ativo</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>