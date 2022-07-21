<?php
require_once "../ConexionMySQL.php";
$ip = $_POST["ipRouter"];
$nombre = $_POST["nombreRouter"];
$pwd = $_POST["passwordRouter"];
$puerto = $_POST["puertoApi"];
$tipo = $_POST["tipoServicio"];
$usuario = $_POST["usuarioRouter"];
$zonas = $_POST["zonas"];
$idRouter = $_POST["idRouter"];
$data = array();
$data["info"] = "$idRouter $nombre";
$query = "UPDATE router 
SET Nombre = '$nombre', IP = '$ip', Usuario = '$usuario', 
Pwd = '$pwd', PuertoAPI = '$puerto', Zonas = '$zonas', Tipo = '$tipo' WHERE id = '$idRouter'";
$result = mysqli_query($Conexion, $query);
if (!$result) {
    $data["estado"] = "error";
}
echo json_encode($data);
