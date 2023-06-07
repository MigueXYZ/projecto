<?php
$id=$_GET["id"];
if($id==1){
    $id='';
}
if(file_get_contents("files/Luzes".$id."/estado.txt")==0){
    file_put_contents("files/Luzes".$id."/estado.txt",1);
}else{
    file_put_contents("files/Luzes".$id."/estado.txt",0);
}
header("Location: ../dashboard.php");