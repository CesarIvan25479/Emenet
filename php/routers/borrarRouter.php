<?php
require_once "../ConexionMySQL.php";

$query = "DELETE FROM router WHERE id = '{$_POST['idRouter']}'";
$result = mysqli_query($Conexion, $query);
$data = array();
$data["info"] = "{$_POST['idRouter']} {$_POST['nombreRouter']}";
if(!$result){
    $data["estado"] = "error";
}
echo json_encode($data);