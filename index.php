<?php
//incluir funções de api
include_once("api/api_funcitons.php");
//criar sessão de utilizador
session_start();
//buscar os utilizadores
$username=getUsers();
//buscar as credenciais criptografadas
$array=getCreds();

// se credenciais forem inseridas comparar a sessão para ver se existem pares compativeis
if(isset($_POST['username']) && isset($_POST['password'])){
    //criptografar a password para comparação
    $temp=sha1($_POST['password']);
    //percorrer o array
    for($i=0;$i<count($array);$i++){
        //trim para retirar carateres 'new line'
        $password=trim($array[$i]);
        //comparar se existe a password
        if(strcmp($password,$temp)==0){
            //se existe fazer o mesmo tratamento de texto com o username
            $username[$i]=trim($username[$i]);
            //compara o username para ver se faz par
            if(strcmp(trim($username[$i]),$_POST['username'])==0){
                //catalogar o login ,criar uma sessão e redirecionar
                logAttempt(SUCESSO,$username[$i]);
                $_SESSION['username']=$_POST['username'];
                header("Location:dashboard.php");
            }else{
                //catalogar a tentativa de login
                logAttempt(INSUCESSO,$username[$i]);
            }
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="body-park">
<div class="container">

    <div class="row justify-content-center">
        <form class="TIform" method="POST">
            <a href="index.php">
                <img src="imagens/estg_h.png" alt="estg">
            </a>
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input required type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>