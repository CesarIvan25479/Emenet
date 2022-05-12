<?php
require_once "./ConexionMySQL.php";
include './apiMikrotik.php';
require_once "./ConexionSQLC.php";
$data = array();
$cliente = $_POST["cliente"];

//Extraer información del cliente a cortar
$consulta = "SELECT c.CLIENTE, c.PRECIO, c.ZONA, c.TIPO, c.NOMBRE FROM clients AS c WHERE c.CLIENTE = '$cliente'";
$resultado = sqlsrv_query($ConnC, $consulta);
$infoCliente = sqlsrv_fetch_array($resultado);

//Extrar informacion del router a la que corresponde el cliente
$consulta =$Conexion ->query("SELECT *FROM router WHERE FIND_IN_SET('{$infoCliente['ZONA']}', Zonas) AND Tipo='{$infoCliente['TIPO']}'");
$infoRouter = $consulta ->fetch_assoc();

if($infoCliente['TIPO'] != "BAJA"){

    //Se inicializan Variables de conexión
    $ipRouteros=$infoRouter['IP']; 
    $Username=$infoRouter['Usuario'];
    $Pass=$infoRouter['Pwd'];        
    $api_puerto=$infoRouter['PuertoAPI'];
    $tipo = $infoRouter['Tipo'];


    //Se establece conexión al rotuer
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
        $API->write("/system/ident/getall",true);
        $READ = $API->read(false);
        //comando para modificar el queue
        $ARRAY = $API->comm("/queue/simple/enable",
        array("numbers"=>$infoCliente['NOMBRE']));   
        $ARRAY = $API->comm("/queue/simple/set",  
        array("numbers"=>$infoCliente['NOMBRE'],"max-limit" =>'1K/1K'));

        $data['infoRouter'] = $infoRouter;
        $data['infoCliente'] = $infoCliente['CLIENTE'];
        
    }else{
        $data['infoRouter'] = $infoRouter;
        $data['infoCliente'] = $infoCliente['CLIENTE'];
        $data['estado'] = "errorrouter";
    }
}
echo json_encode($data);







