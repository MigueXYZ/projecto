<?php
    $id=$_GET["id"];
    if($id==1){
        $id='';
    }
    if(file_get_contents("files/Luzes".$id."/valor.txt")==0){
        $value=1;

        /*
         if(file_get_contents("files/Luzes".$id."/estado.txt")==0) {
            file_put_contents("files/Luzes".$id."/estado.txt", 1);
        }
        */
    }else{
        $value=0;
        /*
         if(file_get_contents("files/Luzes".$id."/estado.txt")==0) {
            file_put_contents("files/Luzes".$id."/estado.txt", 1);
        }
        */
    }
    //mete o valor
    file_put_contents("files/Luzes".$id."/valor.txt",$value);
    //mete a hora
    $hora=date('Y-m-d H:i:s');
    file_put_contents("files/Luzes".$id."/hora.txt",$hora);
    //atualiza o log
    $filePath = "files/Luzes".$id."/log.txt";
    $newContent = $hora . ';' . $value . PHP_EOL;
    $existingContent = file_get_contents($filePath);
    $updatedContent = $newContent . $existingContent;
    file_put_contents($filePath, $updatedContent);

    header("Location: ../dashboard.php");