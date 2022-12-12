<?php
include "../ConexionMySQL.php";
$id = strip_tags(trim($_POST["idolt"]));

$query = "DELETE FROM olts WHERE id = '$id'";
$result = mysqli_query($Conexion, $query);

if($result){
    $data["info"] = $_POST;
}else{
    $data["estado"] = "sinconexion";
}
echo json_encode($data);