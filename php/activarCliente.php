<?php
include '../php/ConexionSQLC.php';
include "../php/ConexionMySQL.php";
include "../php/apiMikrotik.php";

$cliente = $_POST['cliente'] ?? $_GET['cliente'];

$planFibra = [
    'IFO' => [
        "PLAN15" => '15M/15M',
        'PLAN25' => '25M/25M',
        'PLAN35' => '35M/35M',
        'PLAN50' => '50M/50M',
        'PLAN100' => '100M/100M',
        'PLAN200' => '200M/200M'
    ],
    'INA' => [
        "PLAN6" => '3M/6M',
        'PLAN9' => '5M/9M',
        'PLAN12' => '6M/12M',
        'PLAN15' => '6M/15M',
        'PLAN1015' => '10M/15M',
        'PLAN20' => '10M/20M',
        'PLAN30' => '15M/30M',
        'PLAN50' => '25M/50M',
        'PLAN10' => '5M/10M',
    ]
];

//Consulta para sacar plan de internet y servicios por cliente 
$consulta = "SELECT OBSERV, DATOS =
CASE CHARINDEX ('(', OBSERV)
WHEN 0 THEN ''
ELSE SUBSTRING (OBSERV,
CHARINDEX('(',OBSERV)+1,
CHARINDEX(')',OBSERV)-CHARINDEX('(',OBSERV)-1)
END
FROM clients WHERE CLIENTE = '$cliente'";
$resulado = sqlsrv_query($ConnC, $consulta);
$Servicios = sqlsrv_fetch_array($resulado);

$planInternet = explode("|", $Servicios["DATOS"]);
$servicioTel = substr_count($Servicios["DATOS"], "TEL");
$servicioCam = substr_count($Servicios["DATOS"], "CAM");
//************************************************************

//obtener datos del cliente a activar
$consulta = "SELECT c.CLIENTE, c.PRECIO, c.ZONA, c.TIPO, c.NOMBRE FROM clients AS c WHERE c.CLIENTE = '$cliente'";
$resulado = sqlsrv_query($ConnC, $consulta);
$datosActivar = sqlsrv_fetch_array($resulado);
//********************************** */

//Consulta para saber a que router esta conectado el cliente por zona y tipo
$consulta = "SELECT *FROM router WHERE FIND_IN_SET('{$datosActivar['ZONA']}', Zonas) AND Tipo='{$datosActivar['TIPO']}'";
$resultado = mysqli_query($Conexion, $consulta);
$datosRouter = mysqli_fetch_array($resultado);
//************************************************* */

$ipRouteros = $datosRouter['IP'];
$Username = $datosRouter['Usuario'];
$Pass = $datosRouter['Pwd'];
$api_puerto = $datosRouter['PuertoAPI'];

if ($datosRouter['id'] == '9') {
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
        $API->write("/system/ident/getall", true);
        $READ = $API->read(false);
        // $ARRAY = $API->comm(
        //     "/queue/simple/disable",
        //     array("numbers" => $datosActivar['NOMBRE'])
        // );
        $ARRAY = $API->comm(
            "/queue/simple/set",
            array("numbers" => $datosActivar['NOMBRE'], "max-limit" => $planFibra[$datosActivar['TIPO']][$planInternet[0]])
        );
        $data['estado'] = "activado";
    }
} else {
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
        $API->write("/system/ident/getall", true);
        $READ = $API->read(false);
        $ARRAY = $API->comm(
            "/queue/simple/set",
            array("numbers" => $datosActivar['NOMBRE'], "max-limit" => $planFibra[$datosActivar['TIPO']][$planInternet[0]])
        );
        $data['estado'] = "activado";
    } else {
        $data['estadoReporte'] = "sinconexion";
    }
}

$data['plan'] = $planFibra[$datosActivar['TIPO']][$planInternet[0]];
$data['cliente'] = $datosActivar['CLIENTE'];
$data['nombreRouter'] = $datosRouter['Nombre'];
$data['ipRputer'] = $datosRouter['IP'];
echo json_encode($data);
