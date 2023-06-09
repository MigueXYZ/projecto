<?php
header('Content-Type: text/html; charset=utf-8');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Recebido por um POST";
    print_r($_POST);

    $imagem = $_FILES['imagem'];
    echo $imagem['name'];
    var_dump($imagem);
    $date = date('Y-m-d H:i:s');


    if (isset($_FILES['imagem'])) {
        if ($_FILES['imagem']['size'] > 1000000) {//se a imagem passar 1000KB
            throw new RuntimeException('Exceeded filesize limit.');
        }else{
            $type=$_FILES[ 'imagem' ][ 'type' ];
            $extensions=array( 'image/jpeg', 'image/png');
            if( in_array( $type, $extensions )){ //se a imagem for png ou jpeg
                 file_put_contents("api/files/Fotos/valor.txt", $imagem['name']);
                 file_put_contents("api/files/Fotos/hora.txt", $date);
                $data = $date . ";" . $imagem['name']. PHP_EOL;
                $data .= file_get_contents("api/files/Fotos/log.txt");
                 file_put_contents("api/files/Fotos/log.txt", $data);


                $tmp_name = $_FILES['imagem']['tmp_name'];
                $name = basename($_FILES['imagem']['name']);

                move_uploaded_file($tmp_name, "imageLogs/".$imagem['name']);
            }
        }
    } else {
        echo "Parametros nao respeitados";
        exit();
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {

    $valores = array(//transformação para um array
        'nome' => file_get_contents("api/files/Fotos/nome.txt"),
        'valor' => file_get_contents("api/files/Fotos/valor.txt"),
        'hora' => file_get_contents("api/files/Fotos/hora.txt"),
        'tirar' => file_get_contents("api/files/Fotos/tirar.txt"),
        'log' => file_get_contents("api/files/Fotos//log.txt"),
    );
    echo json_encode($valores); //retorna uma string contendo a representação do json


} else {
    echo "Metodo nao permitido";
    exit();
}

?>