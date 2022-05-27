<?php
include "../ConexionMySQL.php";
$idcliente = $_POST["id"];
$consulta = "DELETE FROM pagosazteca WHERE id = '$idcliente'";
$resultado = mysqli_query($Conexion, $consulta);
if($resultado){
    $data["id"] = $_POST["id"];
    $data["nombre"] = $_POST["nombre"];
    $data["estado"] = "borrado";
    echo json_encode($data);
}