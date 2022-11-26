<?php
include "../ConexionMySQL.php";
$nombre = strip_tags(trim($_POST["nombreolt"]));
$password = strip_tags(trim($_POST["passwordolt"]));
$usuario = strip_tags(trim($_POST["usuarioolt"]));
$puertoTelnet = strip_tags(trim($_POST["puertoTelnet"]));
$servidor = strip_tags(trim($_POST["servidorolt"]));
$data = array();
$query = "INSERT INTO olts (nombre, servidor, usuario, pwd, ptoTelnet)
    VALUES ('$nombre','$servidor','$usuario','$password','$puertoTelnet')";
$result = mysqli_query($Conexion, $query);
if(!$result){
    $data["estado"] = "sinconexion";
    
}else{
    $data["info"] = $_POST;
}
echo json_encode($data);