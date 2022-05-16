<?php
include '../php/ConexionSQLC.php';
include "../php/ConexionMySQL.php";
include "../php/apiMikrotik.php";

$cliente = $_POST['cliente'];

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

$planInternet = explode("|",$Servicios["DATOS"]);
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

$ipRouteros= $datosRouter['IP']; 
$Username= $datosRouter['Usuario'];
$Pass= $datosRouter['Pwd'];        
$api_puerto= $datosRouter['PuertoAPI'];

if($datosRouter['id'] == '9'){
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
        $API->write("/system/ident/getall",true);
        $READ = $API->read(false);
        $ARRAY = $API->comm("/queue/simple/disable",  
        array("numbers"=>$datosActivar['NOMBRE']));
        $ARRAY = $API->comm("/queue/simple/set",  
        array("numbers"=>$datosActivar['NOMBRE'],"max-limit" =>$planInternet[0]));
        $data['estado'] = "activado";
    }
}else{
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
        $API->write("/system/ident/getall",true);
        $READ = $API->read(false);
        $ARRAY = $API->comm("/queue/simple/set",  
        array("numbers"=>$datosActivar['NOMBRE'],"max-limit" =>$planInternet[0]));
        $data['estado'] = "activado";
    }else{
        $data['estadoReporte'] = "sinconexion";
    }
}

$data['plan'] = $planInternet[0];
$data['cliente'] = $datosActivar['CLIENTE'];
$data['nombreRouter'] = $datosRouter['Nombre'];
$data['ipRputer'] = $datosRouter['IP'];
echo json_encode($data);