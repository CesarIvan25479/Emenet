<?php
include "../../php/apiMikrotik.php";
$ipRouteros = "192.168.3.254";
$Username = "mnet";
$Pass = "mnet2020";
$api_puerto = "9849";
$API = new routeros_api();
$API->debug = false;
$nombre = "CONCEPCION ALARCON LEALDE";
if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)){
        //comando para modificar el queue
        $API->write("/queue/simple/print", false);
        $ARRAY = $API->write("?name=JUANA LOPEZ ZETINA",true);
        $READ = $API->read(false);
        $ARRAY = $API->parse_response($READ);
        echo "<pre>";
        var_dump($ARRAY);
        echo "</pre>";
}