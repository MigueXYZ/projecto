<?php
include_once ("api_funcitons.php");
header('Content-Type: text/html; charset=utf-8');
//se o servidor receber um POST
if($_SERVER['REQUEST_METHOD']=="POST"){
    //procura se tipo está definido
    if(isset($_POST['tipo'])){
        /*
         * Nesta secção nós comparamos se o ficheiro se ele tem um tipo conhecido e se sim ele tenta escrever os ficheiros
         * se falhar ele passa um código de erro e uma mensagem
         */
        if($_POST['tipo']){
            $nome=existe($_POST['tipo']);
            if($nome!=null && isset($_POST['hora']) && isset($_POST['valor']) && isset($_POST['nome'])){
                file_put_contents("files/".$nome."/valor.txt",$_POST['valor']);
                file_put_contents("files/".$nome."/hora.txt",$_POST['hora']);
                file_put_contents("files/".$nome."/nome.txt",$_POST['nome']);
                file_put_contents("files/".$nome."/log.txt",$_POST["hora"].';'.$_POST["estado"].PHP_EOL,FILE_APPEND);
                http_response_code(200);
                echo "Ficheiro escrito com sucesso";
            }else{

                http_response_code(400);
                echo 'Erro ao aceder ao ficheiro';
            }
        }
    }
}