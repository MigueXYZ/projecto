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
    $luzes_nome=getLuzesNome(0);
    $luzes_hora=getLuzesHora(0);
    $luzes_estado=trim(getLuzesEstado(0));
    $luzes_nome2=getLuzesNome(2);
    $luzes_hora2=getLuzesHora(2);
    $luzes_estado2=trim(getLuzesEstado(2));
    $luzes_nome3=getLuzesNome(3);
    $luzes_hora3=getLuzesHora(3);
    $luzes_estado3=trim(getLuzesEstado(3));
    $fotos_atual=getFotosAtual();
    $fotos_hora=getFotosHora();
    $fotos_nome=getFotosNome();
    $auto=getAuto(0);
    $auto2=getAuto(2);
    $auto3=getAuto(3);

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

    //lógica para definir qual imagem//cor sar para as Luzes
    if($luzes_estado==DESATIVADO){
        $luzes_foto="imagens/light-off.png";
        $luzes_cor="sensor-gray";
        $luzes_classe="danger";
        $luzes_estado="Desativado";
    }
    elseif ($luzes_estado==ATIVADO){
        $luzes_foto="imagens/light-on.png";
        $luzes_cor="sensor-yellow";
        $luzes_classe="success";
        $luzes_estado="Ativado";
    }
    if($luzes_estado2==DESATIVADO){
        $luzes_foto2="imagens/light-off.png";
        $luzes_cor2="sensor-gray";
        $luzes_classe2="danger";
        $luzes_estado2="Desativado";
    }
    elseif ($luzes_estado2==ATIVADO){
        $luzes_foto2="imagens/light-on.png";
        $luzes_cor2="sensor-yellow";
        $luzes_classe2="success";
        $luzes_estado2="Ativado";
    }
    if($luzes_estado3==DESATIVADO){
        $luzes_foto3="imagens/light-off.png";
        $luzes_cor3="sensor-gray";
        $luzes_classe3="danger";
        $luzes_estado3="Desativado";
    }
    elseif ($luzes_estado3==ATIVADO){
        $luzes_foto3="imagens/light-on.png";
        $luzes_cor3="sensor-yellow";
        $luzes_classe3="success";
        $luzes_estado3="Ativado";
    }

    if($auto==DESATIVADO){
        $auto_text="Desativado";
        $auto_class="danger";
    }else{
        $auto_text="Ativado";
        $auto_class="success";
    }
    if($auto2==DESATIVADO){
        $auto_text2="Desativado";
        $auto_class2="danger";
    }else{
        $auto_text2="Ativado";
        $auto_class2="success";
    }
    if($auto3==DESATIVADO){
        $auto_text3="Desativado";
        $auto_class3="danger";
    }else{
        $auto_text3="Ativado";
        $auto_class3="success";
    }
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
                        <a class="nav-link" href="historico.php?log=<?php echo TODOS;?>">Histórico</a>
                    </div>
                    <div class="w-100 text-end">
                        <button class="btn btn-outline-danger" onclick="window.location.replace('logout.php');">Logout</button>
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
                        <h2><?php echo $fotos_nome; ?></h2>
                    </div>
                    <div class="card-body">
                      <img class="align-center photo" src="imageLogs/<?php echo $fotos_atual;?>" alt="<?php echo $fotos_atual;?>">
                    </div>
                    <div class="card-footer">
                        <b>Atualização:</b> <?php echo $fotos_hora; ?> - <a href="historico.php?log=<?php echo CAMARA;?>">Histórico</a>
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
                          <b>Atualização:</b> <?php echo $veiculo_hora; ?> - <a href="historico.php?log=<?php echo CONTADOR ;?>">Histórico</a>
                      </div>
                  </div>
            </div>
        </div>
        <div class="row text-center mt-2">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header <?php echo($luzes_cor);?>">
                        <h2><?php echo($luzes_nome.": ".$luzes_estado)?></h2>
                    </div>
                    <div class="card-body">
                        <img class="align-center photo" src="<?php echo($luzes_foto);?>" alt="LED">
                    </div>
                    <div class="card-footer">
                        <!--<a href="api/auto.php?id=1" class="btn btn-<?php echo($auto_class);?>">Modo Auto: <?php echo $auto_text ?></a>-->
                        <a href="api/changeLuzes.php?id=1" class="btn btn-<?php echo($luzes_classe);?>"><?php echo $luzes_estado ?></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header <?php echo($luzes_cor2);?>">
                        <h2><?php echo($luzes_nome2.": ".$luzes_estado2)?></h2>
                    </div>
                    <div class="card-body">
                        <img class="align-center photo" src="<?php echo($luzes_foto2);?>" alt="LED">
                    </div>
                    <div class="card-footer">
                        <!--<a href="api/auto.php?id=2" class="btn btn-<?php echo($auto_class2);?>">Modo Auto: <?php echo $auto_text2 ?></a>-->
                        <a href="api/changeLuzes.php?id=2" class="btn btn-<?php echo($luzes_classe2);?>"><?php echo $luzes_estado2 ?></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header <?php echo($luzes_cor3);?>">
                        <h2><?php echo($luzes_nome3.": ".$luzes_estado3)?></h2>
                    </div>
                    <div class="card-body">
                        <img class="align-center photo" src="<?php echo($luzes_foto3);?>" alt="LED">
                    </div>
                    <div class="card-footer">
                        <!--<a href="api/auto.php?id=3" class="btn btn-<?php echo($auto_class3);?>">Modo Auto: <?php echo $auto_text3 ?></a>-->
                        <a href="api/changeLuzes.php?id=3" class="btn btn-<?php echo($luzes_classe3);?>"><?php echo $luzes_estado3 ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>