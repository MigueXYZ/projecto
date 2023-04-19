<?php


$valor_temperatura = file_get_contents("files/temperatura/valor.txt");
// Set timezone
date_default_timezone_set('WET');

// Define file path
$file_path = 'files/temperatura/log.txt';

// Loop every 5 seconds
$timestamp = date('Y/m/d H:i:s') . ';' . $valor_temperatura;
echo $timestamp;
// Append timestamp to file
$file = fopen($file_path, 'a');
fwrite($file, $timestamp . "\n");
fclose($file);

header("Location: http://localhost/projecto/projecto/dashboard.php");
