<?php
//criação de constantes
const SUCESSO = 1;
const INSUCESSO = 0;
const VEICULO_MAX=100;
//função para buscar os utilizadores
function getUsers(){
    return (explode("\n", file_get_contents('api/files/users/users.txt')));
}

//Função para buscar as credenciais
function getCreds(){
    return(explode("\n", file_get_contents('api/files/users/creds.txt')));
}

//Fução para catalogar as tentativas de Login
function logAttempt($flag,$user){
    if($flag==SUCESSO){
        $aux="Sucesso";
    }elseif($flag==INSUCESSO){
        $aux="Insucesso";
    }
    $aux=$aux.";".$user.";".date("Y/m/d H:i").PHP_EOL;
    file_put_contents("api/files/users/log.txt",$aux,FILE_APPEND);
}
//função para buscar a hora da ultima atualização dos veiculos
function getVeiculoHora(){
    return(file_get_contents("api/files/veiculo/hora.txt"));
}
//função para buscar a quantidade da ultima atualização dos veiculos
function getVeiculoQuant(){
    return(file_get_contents("api/files/veiculo/quantidade.txt"));

}
//função para buscar o nome da ultima atualização dos veiculos
function getVeiculoNome(){
    return(file_get_contents("api/files/veiculo/nome.txt"));

}

//função para buscar o log da ultima atualização dos veiculos
function getVeiculoLog(){
    return(file_get_contents("api/files/veiculo/log.txt"));
}

//função para buscar o estado das luzes
function getLuzesEstado(){
    return(file_get_contents("api/files/veiculo/estado.txt"));
}