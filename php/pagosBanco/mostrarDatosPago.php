<?php
include "../ConexionMySQL.php";
$cliente = $_POST["cliente"];
$consulta = "SELECT *FROM pagosazteca WHERE id = '$cliente'";
$resultado  = mysqli_query($Conexion, $consulta);

if($resultado){
    $informacionPago = mysqli_fetch_array($resultado);
    $data["info"] = $informacionPago;
    echo json_encode($data);
}else{
    echo json_encode("error");
}
