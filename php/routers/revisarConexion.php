<?php
require_once "../apiMikrotik.php";
require_once "../apiMikrotik.php";
$ipRouter = $_POST["ipRouter"];
$pwd = $_POST["passwordRouter"];
$puerto = $_POST["puertoApi"];
$usuario = $_POST["usuarioRouter"];
$data = array();
$API = new routeros_api();
$API->debug = false;
if ($API->connect($ipRouter, $usuario, $pwd, $puerto)) {
    $API->write("/system/ident/getall", true);
    $READ = $API->read(false);
    
    $data["estado"] = "si";
}
$data["post"] = $_POST;
echo json_encode($data);
