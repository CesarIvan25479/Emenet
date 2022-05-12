<?php
include './ConexionSQL.php';
$cliente = $_POST['cliente'];
$data = array();
$consulta="SELECT CLIENTE, NOMBRE, ESTADO, CP, POBLA, COLONIA, CALLE, NUMERO, TELEFONO, TIPO, ZONA, PRECIO, OBSERV FROM clients WHERE CLIENTE='$cliente'";
$resultado = sqlsrv_query($Conn, $consulta);
$informacion  = sqlsrv_fetch_array($resultado);
$data['estado'] = "si";
$data['info']  = $informacion;
echo json_encode($data);

