<?php

// Veiculo Log
$veiculo_quant = file_get_contents("files/veiculo/quantidade.txt");

// Define file path
$file_path = 'files/veiculo/log.txt';

$timestamp = date('Y/m/d H:i:s') . ';' . $veiculo_quant;

// Append timestamp to file
$file = fopen($file_path, 'a');
fwrite($file, $timestamp . "\n");
fclose($file);


// Luzes Log

$luzes_estado = file_get_contents("files/luzes/estado.txt");

// Define file path
$file_path = 'files/luzes/log.txt';

$timestamp = date('Y/m/d H:i:s') . ';' . $luzes_estado;

// Append timestamp to file
$file = fopen($file_path, 'a');
fwrite($file, $timestamp . "\n");
fclose($file);



header("Location: ../dashboard.php");
