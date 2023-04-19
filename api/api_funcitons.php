<?php
//criação de constantes
const SUCESSO = 1;
const INSUCESSO = 0;
//função para buscar os utilizadores
function getUsers(){
    return (explode("\n", file_get_contents('api/files/users/users.txt')));
}

//Função para buscar as credenciais
function getCreds(){
    return(explode("\n", file_get_contents('api/files/creds/users.txt')));
}

//Fução para catalogar as tentativas de Login
function logAttempt($flag,$user){
    if($flag==SUCESSO){
        $aux="Sucesso";
    }elseif($flag==INSUCESSO){
        $aux="Insucesso";
    }
    file_put_contents('files/users/log.txt',$aux.";".$user.";".date("Y/m/d H:i"));
}