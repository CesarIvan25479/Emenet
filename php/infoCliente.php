<?php
include './ConexionSQL.php';
include './ConexionSQLC.php';
require_once "./ConexionMySQL.php";
require_once "./apiMikrotik.php";

$cliente = $_POST['cliente'] ?? $_GET['cliente'];
$data = array();




$consulta = "SELECT CLIENTE, NOMBRE, ESTADO, CP, POBLA, COLONIA, CALLE, NUMERO, TELEFONO, TIPO, ZONA, PRECIO, OBSERV FROM clients WHERE CLIENTE='$cliente'";
$resultado = sqlsrv_query($Conn, $consulta);
$informacion  = sqlsrv_fetch_array($resultado);

if ($informacion["TIPO"] != "BAJA") {
    //obtener datos del cliente a activar
    $consulta = "SELECT c.CLIENTE, c.PRECIO, c.ZONA, c.TIPO, c.NOMBRE FROM clients AS c WHERE c.CLIENTE = '$cliente'";
    $resulado = sqlsrv_query($ConnC, $consulta);
    $SinFormato = sqlsrv_fetch_array($resulado);
    //********************************** */

    //Extrar informacion del router a la que corresponde el cliente
    $consulta = $Conexion->query("SELECT *FROM router WHERE FIND_IN_SET('{$informacion['ZONA']}', Zonas) AND Tipo='{$informacion['TIPO']}'");
    $infoRouter = $consulta->fetch_assoc();
    //********************************** */


    //Se inicializan Variables de conexión
    $ipRouteros = $infoRouter['IP'];
    $Username = $infoRouter['Usuario'];
    $Pass = $infoRouter['Pwd'];
    $api_puerto = $infoRouter['PuertoAPI'];
    $tipo = $infoRouter['Tipo'];

    $API = new routeros_api();
    $API->debug = false;
    $name = "OSCAR CHAVEZ YA\D1EZ";
    if ($API->connect($ipRouteros, $Username, $Pass, $api_puerto)) {
        $API->write("/queue/simple/print", false);
        $API->write("?name=".$SinFormato["NOMBRE"], true);
        $READ = $API->read(false);
        $ARRAY = $API->parse_response($READ);
    }
}




$data['estado'] = "si";
$data['info']  = $informacion;
$data["target"] = $ARRAY[0]["target"] ?? "No se encontro IP";
$data["status"] = $ARRAY[0]["max-limit"] ?? "Inactivo";
echo json_encode($data);
