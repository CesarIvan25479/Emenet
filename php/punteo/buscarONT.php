<?php
$direccion = "172.16.28.2";
$puerto = "23";
$tiempo_colapsa = 120;
$password_telnet = "mundo16--";
$comandos = "enable";
$comandos2 = "config";
$comando3 = "interface gpon 0/3";
$comando5 = "display ont info 0 all";
$comando4 = "quit";
$usuario = "edmundom";


$salida = "$usuario\n";
$salida .= "$password_telnet\n";
$salida .= "enable\n";
$salida .= "config\n";
$salida .= "interface gpon 0/3\n";
$salida .= "display ont autofind 5\n";
$salida .= "quit\n";
$salida .= "quit\n";
$salida .= "quit\n";
$salida .= "y\n";

$response = array();
$conecta_telnet = fsockopen($direccion, $puerto, $errno, $errstr, $tiempo_colapsa);
if (!$conecta_telnet) {
    echo "$errstr ($errno)";
    echo "<br>";
} else {
    while (!feof($conecta_telnet)) {
        fwrite($conecta_telnet, $salida);
        array_push($response, fgets($conecta_telnet, 128));
    } 
    fclose($conecta_telnet);
}
foreach ($response as &$texto) {
    $valor = $valor * 2;
}
$data["estado"] = "listo";
$data["info"] = $response[21];
echo json_encode($data);