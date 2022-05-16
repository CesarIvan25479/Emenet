<?php
include '../php/ConexionSQLC.php';
//se obtiene las variables del formulario y se declaran las demas variables
$cliente = $_POST['cliente'];
$fechaReporte = $_POST['fechaReporte'];
$opcion = $_POST['opcion'];
$todasFechas = $_POST['todasFechas'] ?? false;
$todosConceptos = $_POST['todosConceptos'] ?? false;

setlocale(LC_TIME, "spanish");
$MesActual = strftime('%b %Y');
$MesActual = str_replace('.','',$MesActual);
$MesActual = strtoupper($MesActual);
//*********************** ************************************

//Consulta para sacar plan de internet y servicios por cliente 
$consulta = "SELECT  OBSERV, DATOS =
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

$data['servicioCamara'] = $servicioCam;
$data['servicioTelefono'] = $servicioTel;


if($opcion == "Mostrar y Activar"){
    //Consulta para revisar pagos hasta el mes actual
    $consulta = "SELECT C.CLIENTE, C.PRECIO, V.comodin, C.ZONA, C.TIPO, C.NOMBRE 
    FROM clients C INNER JOIN ventas V ON C.CLIENTE=V.CLIENTE 
    WHERE C.CLIENTE='$cliente' and V.comodin='$MesActual' AND V.TIPO_DOC!='PE'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $resultado = sqlsrv_query($ConnC, $consulta, $params, $options);
    $datosActivar = sqlsrv_fetch_array($resultado);
    $VerificaPago = sqlsrv_num_rows( $resultado);
    //************************************************* */

    if($VerificaPago >= 1){
        include "../php/ConexionMySQL.php";
        include "../php/apiMikrotik.php";

        //Consulta para saber a que router esta conectado el cliente por zona y tipo
        $consulta = "SELECT *FROM router WHERE FIND_IN_SET('{$datosActivar['ZONA']}', Zonas) AND Tipo='{$datosActivar['TIPO']}'";
        $resultado = mysqli_query($Conexion, $consulta);
        $datosRouter = mysqli_fetch_array($resultado);
        //************************************************* */

        $ipRouteros=$datosRouter['IP']; 
        $Username=$datosRouter['Usuario'];
        $Pass=$datosRouter['Pwd'];        
        $api_puerto=$datosRouter['PuertoAPI'];

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
                $data['estadoReporte'] = "corriente";
            }else{
                $data['estadoReporte'] = "sinconexion";
            }
        }else{
            $API = new routeros_api();
            $API->debug = false;
            if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
                $API->write("/system/ident/getall",true);
                $READ = $API->read(false);
                $ARRAY = $API->comm("/queue/simple/set",  
                array("numbers"=>$datosActivar['NOMBRE'],"max-limit" =>$planInternet[0]));
                $data['estadoReporte'] = "corriente";
            }else{
                $data['estadoReporte'] = "sinconexion";
            }
        }
        
        $data['nombreRouter'] = $datosRouter['Nombre'];
        $data['ipRouter'] = $datosRouter['IP'];
        $data['plan'] = $planInternet[0];
        $data['estado'] = "mostrarActivar";
    }else{
        $data['estadoReporte'] = "adeudo";
        $data['estado'] = "mostrarActivar";
    }

    
    
}else{
    $data['estado'] = 'mostrar';
    
}
$data['todosConceptos'] = $todosConceptos;
$data['todasFechas'] = $todasFechas;
$data['cliente'] = $cliente;
$data['fechaInicio'] = $fechaReporte;
echo json_encode($data);







    



