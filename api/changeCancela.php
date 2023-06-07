<?php
    $id=$_GET["id"];
    if($id==1){
        $id="CancelaA";
    }else{
        $id="CancelaB";
    }
    if(file_get_contents("files/".$id."/valor.txt")==0){
        $value=1;
    }else{
        $value=0;
    }
    //mete o valor
    file_put_contents("files/".$id."/valor.txt",$value);
    //mete a hora
    $hora=date('Y-m-d H:i:s');
    file_put_contents("files/".$id."/hora.txt",$hora);
    //atualiza o log
    $filePath = "files/".$id."/log.txt";
    $newContent = $hora . ';' . $value . PHP_EOL;
    $existingContent = file_get_contents($filePath);
    $updatedContent = $newContent . $existingContent;
    file_put_contents($filePath, $updatedContent);

    header("Location: ../dashboard.php");