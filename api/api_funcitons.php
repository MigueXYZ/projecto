<?php
//criação de constantes
const SUCESSO = 1;
const INSUCESSO = 0;
const VEICULO_MAX=100;
const DESATIVADO=0;
const ATIVADO=1;
const CAMARA=1;
const CONTADOR=2;
const LUZES=3;
const TODOS=4;
const HUMIDADE = 6;
const TEMPERATURA=5;
const CANCELAA=7;
const CANCELAB=8;

//função para ver se o nome é valido
function existe($nome){
    if(strcmp($nome,"Luzes")==0){
        return 1;
    }elseif(strcmp($nome,"Fotos")==0){
        return 1;
    }elseif(strcmp($nome,"Veiculos")==0){
        return 1;
    }elseif(strcmp($nome,"Luzes2")==0){
        return 1;
    }elseif(strcmp($nome,"Luzes3")==0){
        return 1;
    }elseif(strcmp($nome,"Temperatura")==0){
        return 1;
    }elseif(strcmp($nome,"CancelaA")==0){
        return 1;
    }elseif(strcmp($nome,"CancelaB")==0){
        return 1;
    }else{
        return 0;
    }
}

//função para buscar os utilizadores
function getUsers(){
    return (explode("\n", file_get_contents('api/files/Users/users.txt')));
}

//Função para buscar as credenciais
function getCreds(){
    return(explode("\n", file_get_contents('api/files/Users/creds.txt')));
}

function getPerms(){
    return(explode("\n",file_get_contents('api/files/Users/perms.txt')));
}
//Fução para catalogar as tentativas de Login
function logAttempt($flag,$user){
    $aux='';
    if($flag==SUCESSO){
        $aux="Sucesso";
    }elseif($flag==INSUCESSO){
        $aux="Insucesso";
    }
    $aux=$aux.";".$user.";".date("Y/m/d H:i").PHP_EOL;
    file_put_contents("api/files/Users/log.txt",$aux,FILE_APPEND);
}
//função para buscar a hora da ultima atualização dos veiculos
function getVeiculoHora(){
    return(file_get_contents("api/files/Veiculos/hora.txt"));
}
//função para buscar a quantidade da ultima atualização dos veiculos
function getVeiculoQuant(){
    return(file_get_contents("api/files/Veiculos/valor.txt"));

}
//função para buscar o nome da ultima atualização dos veiculos
function getVeiculoNome(){
    return(file_get_contents("api/files/Veiculos/nome.txt"));

}

//função para buscar o log da ultima atualização dos veiculos
function getVeiculoLog(){
    return(explode("\n",file_get_contents("api/files/Veiculos/log.txt")));
}

function getTemperaturaLog(){
    return(explode("\n",file_get_contents("api/files/Temperatura/log.txt")));
}
function getHumidadeLog(){
    return(explode("\n",file_get_contents("api/files/Temperatura/log.txt")));
}

function getCancelaALog(){
    return(explode("\n",file_get_contents("api/files/CancelaA/log.txt")));
}

function getCancelaBLog(){
    return(explode("\n",file_get_contents("api/files/CancelaB/log.txt")));
}

//função para buscar o estado das Luzes
function getLuzesEstado($valor){
    if ($valor == 0) {
        $pasta = "Luzes";
    } else {
        $pasta = "Luzes" . $valor;
    }

    $url = "api/files/" . $pasta . "/valor.txt";
    return(file_get_contents($url));
}
//função para buscar a hora da ultima atualização das Luzes
function getLuzesHora($valor){
    if ($valor == 0) {
        $pasta = "Luzes";
    } else {
        $pasta = "Luzes" . $valor;
    }

    $url = "api/files/" . $pasta . "/hora.txt";
    return(file_get_contents($url));
}
//função para buscar o nome das Luzes
function getLuzesNome($valor){
    if ($valor == 0) {
        $pasta = "Luzes";
    } else {
        $pasta = "Luzes" . $valor;
    }

    $url = "api/files/" . $pasta . "/nome.txt";
    return(file_get_contents($url));
}

//função para buscar o log das Luzes
function getLuzesLog($valor){
    if ($valor == 0) {
        $pasta = "Luzes";
    } else {
        $pasta = "Luzes" . $valor;
    }

    $url = "api/files/" . $pasta . "/nome.txt";
    return(explode("\n",file_get_contents($url)));
}

//funções para buscar informações relevantes sobre as Fotos
function getFotosAtual(){
    return(file_get_contents("api/files/Fotos/valor.txt"));
}
function getFotosHora(){
    return(file_get_contents("api/files/Fotos/hora.txt"));
}
function getFotosNome(){
    return(file_get_contents("api/files/Fotos/nome.txt"));
}
function getFotosLog(){
    return(explode("\n",file_get_contents("api/files/Fotos/log.txt")));
}

function getTemperaturaAtual(){
    return(file_get_contents("api/files/Temperatura/valor.txt"));
}

function getTemperaturaNome(){
    return(file_get_contents("api/files/Temperatura/nome.txt"));
}

function getTemperaturaHora(){
    return(file_get_contents("api/files/Temperatura/hora.txt"));
}

function getHumidadeAtual(){
    return(file_get_contents("api/files/Humidade/valor.txt"));
}

function getHumidadeNome(){
    return(file_get_contents("api/files/Humidade/nome.txt"));
}

function getHumidadeHora(){
    return(file_get_contents("api/files/Humidade/hora.txt"));
}

function getCancelaAAtual(){
    return(file_get_contents("api/files/CancelaA/valor.txt"));
}

function getCancelaANome(){
    return(file_get_contents("api/files/CancelaA/nome.txt"));
}

function getCancelaAHora(){
    return(file_get_contents("api/files/CancelaA/hora.txt"));
}

function getCancelaBAtual(){
    return(file_get_contents("api/files/CancelaB/valor.txt"));
}

function getCancelaBNome(){
    return(file_get_contents("api/files/CancelaB/nome.txt"));
}

function getCancelaBHora(){
    return(file_get_contents("api/files/CancelaB/hora.txt"));
}

function getAuto($valor){
    if ($valor == 0) {
        $pasta = "Luzes";
    } else {
        $pasta = "Luzes" . $valor;
    }

    $url = "api/files/" . $pasta . "/estado.txt";
    return(file_get_contents($url));
}