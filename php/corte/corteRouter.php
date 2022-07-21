<?php
include "../ConexionMySQL.php";
include "../apiMikrotik.php";
include "../ConexionSQLC.php";
set_time_limit(0);
$idRouter = $_POST["idRouter"];
$mesCorte = $_POST["mesCorte"];
// Consulta para mostrar los datos del router para hacer corte
$queryMysql = "SELECT *FROM router WHERE id = '$idRouter'";
$resultMysql = mysqli_query($Conexion, $queryMysql);
$datosRouter = mysqli_fetch_array($resultMysql);
$zonas = explode(",", $datosRouter['Zonas']);

$ipRouteros = $datosRouter['IP'];
$Username = $datosRouter['Usuario'];
$Pass = $datosRouter['Pwd'];
$api_puerto = $datosRouter['PuertoAPI'];
$tipo = $datosRouter['Tipo'];
//************************************ */
$contador = 0;
$API = new routeros_api();
$API->debug = false;
if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
    $API->write("/system/ident/getall", true);
    $READ = $API->read(false);
    $data["estado"] = "listo";
    foreach ($zonas as &$zona) :
        $consulta = "SELECT DISTINCT clients.CLIENTE ,clients.NOMBRE, clients.PRECIO FROM clients 
                    INNER JOIN ventas ON clients.CLIENTE = ventas.CLIENTE 
                    WHERE ventas.CLIENTE not in 
                    (SELECT DISTINCT CLIENTE FROM ventas WHERE comodin = '$mesCorte') 
                    AND ZONA='$zona' AND clients.TIPO='{$datosRouter['Tipo']}'";
        $mostrar = sqlsrv_query($ConnC, $consulta);
        while ($cliente = sqlsrv_fetch_array($mostrar)) {
            $contador += 1;
            $ARRAY = $API->comm("/queue/simple/enable",
                array("numbers" => $cliente['NOMBRE']));
            $ARRAY = $API->comm("/queue/simple/set",
                array("numbers" => $cliente['NOMBRE'], "max-limit" => '1K/1K'));
        }
    endforeach;
    $data["count"] = $contador;
}
echo json_encode($data);
