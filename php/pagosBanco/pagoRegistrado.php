<?php
include "../ConexionMySQL.php";
$cliente = $_POST["cliente"];
$data["cliente"] = $cliente;
$consulta = "UPDATE pagosazteca SET Estado = 'REGISTRADOS' WHERE id = '$cliente'";
$resultado = mysqli_query($Conexion, $consulta);
if($resultado){
    $data["estado"] = "Actualizado";
    echo json_encode($data);
}
