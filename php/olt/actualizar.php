<?php
include "../ConexionMySQL.php";
$id = strip_tags(trim($_POST["idolt"]));
$nombre = strip_tags(trim($_POST["nombreolt"]));
$password = strip_tags(trim($_POST["passwordolt"]));
$usuario = strip_tags(trim($_POST["usuarioolt"]));
$puertoTelnet = strip_tags(trim($_POST["puertoTelnet"]));
$servidor = strip_tags(trim($_POST["servidorolt"]));
$data = array();

$query = "UPDATE olts SET 
    nombre = '$nombre', servidor = '$servidor',
    usuario = '$usuario', pwd = '$password',
    ptoTelnet = '$puertoTelnet' WHERE id = '$id'";
$result = mysqli_query($Conexion, $query);
if($result){
    $data["info"] = $_POST;
}else{
    $data["estado"] = "sinconexion";
}
echo json_encode($data);