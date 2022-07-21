<?php
require_once "../ConexionMySQL.php";
$ip = $_POST["ipRouter"];
$nombre = $_POST["nombreRouter"];
$pwd = $_POST["passwordRouter"];
$puerto = $_POST["puertoApi"];
$tipo = $_POST["tipoServicio"];
$usuario = $_POST["usuarioRouter"];
$zonas = $_POST["zonas"];
$data = array();
$data["info"] = "$ip $nombre";
if (!empty($ip) and !empty($nombre) and !empty($pwd) and !empty($puerto) and !empty($usuario) and !empty($zonas)) {
    $query = "INSERT INTO router (Nombre, IP, Usuario, Pwd, PuertoAPI, Zonas, Tipo) 
    VALUES ('$nombre','$ip','$usuario','$pwd','$puerto','$zonas', '$tipo')";
    $result = mysqli_query($Conexion, $query);
    if ($result) {
        $data["estado"] = "guardado";
        $data["post"] = $_POST;
    }
}
echo json_encode($data);
