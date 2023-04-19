<?php
header('Content-Type: text/html; charset=utf-8');
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST["valor"]) && isset($_POST["nome"]) && isset($_POST["hora"])){
        if(file_put_contents("files/temperatura/valor.txt",$_POST["valor"])!=0){
            file_put_contents("files/temperatura/nome.txt",$_POST["nome"]);
            file_put_contents("files/temperatura/hora.txt",$_POST["hora"]);
            file_put_contents("files/temperatura/log.txt",$_POST["hora"].';'.$_POST["valor"].PHP_EOL,FILE_APPEND);
            http_response_code(200);
            echo "Ficheiro escrito com sucesso";
        }else{
            http_response_code(400);
            echo 'Erro ao escrever o ficheiro';
        }

    }else{
        http_response_code(400);
        echo 'Erro, falta de parametros';
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == 'GET'){
    if(isset($_GET["nome"])){
        $aux=file_get_contents("files/".$_GET["nome"]."/valor.txt");
        if(!$aux){
            http_response_code(404);
            echo 'Erro, sensor não encontrado';
        }else{
            http_response_code(200);
            echo $aux;
        }
    }else{
        http_response_code(400);
        echo "Erro, faltam parametros";
    }
}
else{
    http_response_code(403);
    echo "Método não permitido";
}