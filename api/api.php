<?php
include_once ("api_funcitons.php");
header('Content-Type: text/html; charset=utf-8');
//se o servidor receber um POST
if($_SERVER['REQUEST_METHOD']=="POST"){
    //procura se tipo está definido
    if(isset($_POST['nome'])){
        /*
         * Nesta secção nós comparamos se o ficheiro se ele tem um tipo conhecido e se sim ele tenta escrever os ficheiros
         * se falhar ele passa um código de erro e uma mensagem
         */
            $teste=existe($_POST['nome']);
            $nome=$_POST['nome'];
            if(!isset($_POST['hora'])){
                $hora=date('Y-m-d H:i:s');
            }else{
                $hora=$_POST['hora'];
            }

            if($teste==1 && isset($_POST['valor'])  ){
                $valor=$_POST['valor'];
                if(strcmp($nome,"Veiculos")==0){
                    $url="../api/files/Veiculos/valor.txt";
                    if($_POST['valor']==1){
                        $valor=file_get_contents($url)+1;
                    }else{
                        $valor=file_get_contents($url)-1;
                    }
                }
                $url="files/".$nome."/valor.txt";
                file_put_contents($url,$valor);
                $url="files/".$nome."/hora.txt";
                file_put_contents($url,$hora);
                $url="files/".$nome."/nome.txt";
                file_put_contents($url,$_POST['nome']);
                $filePath = "files/".$nome."/log.txt";
                $newContent = $hora . ';' . $valor . PHP_EOL;
                $existingContent = file_get_contents($filePath);
                $updatedContent = $newContent . $existingContent;
                file_put_contents($filePath, $updatedContent);
                http_response_code(200);
                echo "Ficheiro escrito com sucesso";
            }else{

                http_response_code(400);
                echo 'Erro ao aceder ao ficheiro';
            }

    }
}
if($_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_GET['nome'])){
        $teste=existe($_GET['nome']);
        $nome=$_GET['nome'];
        if($teste==1){
            if(isset($_GET['estado'])){
                $temp= file_get_contents("files/".$nome."/estado.txt");
                echo $temp;
            }else{
                $temp= file_get_contents("files/".$nome."/valor.txt");
                echo $temp;
            }
        }
    }
}