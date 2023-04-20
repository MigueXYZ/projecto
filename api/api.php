<?php
header('Content-Type: text/html; charset=utf-8');
//se o servidor receber um POST
if($_SERVER['REQUEST_METHOD']=="POST"){
    //procura se tipo está definido
    if(isset($_POST['tipo'])){
        /*
         * Nesta secção nós comparamos se o ficheiro se ele tem um tipo conhecido e se sim ele tenta escrever os ficheiros
         * se falhar ele passa um código de erro e uma mensagem
         */
        if($_POST['tipo']==LUZES){
            if(isset($_POST['hora']) && isset($_POST['estado']) && isset($_POST['nome'])){
                file_put_contents("files/luzes/estado.txt",$_POST['estado']);
                file_put_contents("files/luzes/hora.txt",$_POST['hora']);
                file_put_contents("files/luzes/nome.txt",$_POST['nome']);
                file_put_contents("files/luzes/log.txt",$_POST["hora"].';'.$_POST["estado"].PHP_EOL,FILE_APPEND);
                http_response_code(200);
                echo "Ficheiro escrito com sucesso";
            }else{
                http_response_code(400);
                echo 'Erro ao escrever o ficheiro';
            }
        }elseif ($_POST['tipo']==CONTADOR){
            if(isset($_POST['hora']) && isset($_POST['quantidade']) && isset($_POST['nome'])){
                file_put_contents("files/veiculo/quantidade.txt",$_POST['quantidade']);
                file_put_contents("files/veiculo/hora.txt",$_POST['hora']);
                file_put_contents("files/veiculo/nome.txt",$_POST['nome']);
                file_put_contents("files/veiculo/log.txt",$_POST["hora"].';'.$_POST["quantidade"].PHP_EOL,FILE_APPEND);
                http_response_code(200);
                echo "Ficheiro escrito com sucesso";
            }else{
                http_response_code(400);
                echo 'Erro ao escrever o ficheiro';
            }
        }elseif($_POST['tipo']==CAMARA){
            if(isset($_POST['hora']) && isset($_POST['atual']) && isset($_POST['nome'])){
                file_put_contents("files/fotos/atual.txt",$_POST['atual']);
                file_put_contents("files/fotos/hora.txt",$_POST['hora']);
                file_put_contents("files/fotos/nome.txt",$_POST['nome']);
                file_put_contents("files/fotos/log.txt",$_POST["hora"].';'.$_POST["atual"].PHP_EOL,FILE_APPEND);
                http_response_code(200);
                echo "Ficheiro escrito com sucesso";
            }else{
                http_response_code(400);
                echo 'Erro ao escrever o ficheiro';
            }
        }
    }
}