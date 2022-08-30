<?php
//Se inicializan Variables de conexión
include "./apiMikrotik.php";
$ipRouteros = "192.168.48.1";
$Username = "mnet";
$Pass = "mnet2020";
$api_puerto = "9849";

$API = new routeros_api();
$API->debug = false;
$name = "PABLO MATIAS LOPEZ";
if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
    $API->write("/queue/simple/print", false);
    $API->write("?name=".$name, true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);

    $API->write("/ip/dhcp-server/lease/print",false);
    $API->write("?address=".substr($ARRAY[0]['target'], 0, -3), true);
    $READ = $API->read(false);
    $ARRAY2 = $API->parse_response($READ);

    echo "<pre>";
    var_dump($ARRAY);
    echo "</pre>";

    
    echo substr($ARRAY[0]['target'], 0, -3);

    echo "<pre>";
    var_dump($ARRAY2);
    echo "</pre>";
}