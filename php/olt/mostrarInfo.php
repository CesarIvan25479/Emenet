<?php
require_once "../ConexionMySQL.php";
$idOLT = $_POST["ref"];
$query = "SELECT *FROM olts WHERE id = '$idOLT'";
$result = mysqli_query($Conexion, $query);

if($result){
    $data["info"] = mysqli_fetch_array($result);
}else{
    $data["estado"] = "sinconexion";
}
echo json_encode($data);