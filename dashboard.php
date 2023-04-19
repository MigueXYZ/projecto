<?php
    include_once("api/api_funcitons.php");
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
    //busca os valores necessários
    $veiculo_quant=getVeiculoQuant();
    $veiculo_hora=getVeiculoHora();
    $veiculo_nome=getVeiculoNome();
    $luzes_nome=getLuzesNome();
    $luzes_hora=getLuzesHora();
    $luzes_estado=trim(getLuzesEstado());
    //lógica para definir qual imagem//cor sar para os veiculos
    $percentagem=$veiculo_quant/VEICULO_MAX;
    if($percentagem<=0.1){
        $veiculo_foto="imagens/emptyParkingLot.png";
        $veiculo_cor="sensor-light-green";
    }elseif($percentagem<=0.35){
        $veiculo_foto="imagens/HalfEmptyParkinglot.png";
        $veiculo_cor="sensor-green";
    }elseif($percentagem<=0.6){
        $veiculo_foto="imagens/halfParkinglot.png";
        $veiculo_cor="sensor-yellow";
    }elseif($percentagem<=0.85){
        $veiculo_foto="imagens/halfFullParkinglot.png";
        $veiculo_cor="sensor-orange";
    }else{
        $veiculo_foto="imagens/fullParkingLot.png";
        $veiculo_cor="sensor-red";
    }

    //lógica para definir qual imagem//cor sar para as luzes
    if($luzes_estado==DESATIVADO){
        $luzes_foto="imagens/light-off.png";
        $luzes_cor="sensor-gray";
        $luzes_estado="Desativado";
    }
    elseif ($luzes_estado==ATIVADO){
        $luzes_foto="imagens/light-on.png";
        $luzes_cor="sensor-yellow";
        $luzes_estado="Ativado";
    }


//apagar depois
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
      <meta http-equiv="refresh" content="5;url=http://localhost/projecto/projecto/api/logenerator.php">
</head>
  <body class="body-park">
    <div class="container card-theme">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2 rounded-bottom ">
            <div class="container-fluid">
                <a class="navbar-brand">Dashboard Parque Inteligente</a>
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
                        <h1 class="h1">Parque Inteligente</h1>
                        <p>Bem vindo<b> <?php echo($_SESSION['username']) ?></b> </p>
                    </div>
                    <div class="col">
                        <img class="float-end d-inline" style="width:250px;" src="imagens/estg.png" alt="estg">
                    </div>
                </div>
            </div>
          </div>
    </div>
    
    <div class="container p-3 card-theme">
        <div class="row text-center">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header sensor">
                        <h2><?php echo $nome.": ".$valor_temperatura . "ºC"; ?></h2>
                    </div>
                    <div class="card-body">
                      <img class="align-center photo" src="imagens/temperature-high.png" alt="Temperatura">
                    </div>
                    <div class="card-footer">
                        <b>Atualização:</b> <?php echo $hora_temperatura; ?> - <a href="#">Histórico</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header <?php echo($veiculo_cor)?>">
                      <h2><?php echo($veiculo_nome.": ".$veiculo_quant) ?></h2>
                    </div>
                    <div class="card-body">
                        <img class="align-center photo" src="<?php echo($veiculo_foto)?>" alt="Parque">
                      </div>
                      <div class="card-footer">
                          <b>Atualização:</b> <?php echo($veiculo_hora)?> - <a href="#">Histórico</a>
                      </div>
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header <?php echo($luzes_cor) ?>">
                        <h2><?php echo($luzes_nome.": ".$luzes_estado)?></h2>
                    </div>
                    <div class="card-body">
                        <img class="align-center photo" src="<?php echo($luzes_foto)?>" alt="LED">
                      </div>
                      <div class="card-footer">
                          <b>Atualização:</b> 2023/03/10 14:31 - <a href="#">Histórico</a>
                      </div>
                  </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>