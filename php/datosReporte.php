<?php
include '../php/ConexionSQL.php';
//se obtiene las variables del formulario
$cliente = $_POST['cliente'];
$fechaReporte = $_POST['fechaReporte'];
$opcion = $_POST['opcion'];
$todasFechas = $_POST['todasFechas'] ?? false;
$todosConceptos = $_POST['todosConceptos'] ?? false;
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
$resulado = sqlsrv_query($Conn, $consulta);
$Servicios = sqlsrv_fetch_array($resulado);

$planInternet = explode("|",$Servicios["DATOS"]);
$servicioTel = substr_count($Servicios["DATOS"], "TEL");
$servicioCam = substr_count($Servicios["DATOS"], "CAM");
//************************************************************

if($opcion == "Mostrar y Activar"){
    $data['opcion'] = $opcion;
    $consulta = "SELECT C.CLIENTE, C.PRECIO, V.comodin, C.ZONA, C.TIPO, C.NOMBRE 
    FROM clients C INNER JOIN ventas V ON C.CLIENTE=V.CLIENTE 
    WHERE C.CLIENTE='$cliente' and V.comodin='MAY 2023' AND V.TIPO_DOC!='PE'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $resultado = sqlsrv_query($Conn, $consulta, $params, $options);
    $DatosActivar = sqlsrv_fetch_array($resultado);
    $VerificaPago = sqlsrv_num_rows( $resultado);
    $zona = $DatosActivar['ZONA'];
    $tipo = $DatosActivar['TIPO'];
    $data['pago']= $VerificaPago;
}





$data['cliente'] = $cliente;
$data['fechaInicio'] = $fechaReporte; 
$data['estado'] = 'mostrar';
echo json_encode($data);


    



