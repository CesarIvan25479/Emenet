<?php
include "../ConexionMySQL.php";
$folio = $_POST["actuFolioOrden"];
$query = "SELECT ImgCompromiso, ImgCredencial, ImgOrden FROM ordenes WHERE Folio = '$folio'";
$result = mysqli_query($Conexion, $query);
$images = mysqli_fetch_array($result);

$nombre = $_POST["actuNombre"];
$fechaInt = $_POST["actuFechaInst"];
$tipo = $_POST["actuTipoIns"];
$instalacion = $_POST["actuTipoServicio"];


$data["img"] = $images;
$data["archvios"] = $_FILES;
$data["info"] = $_POST;
$data["estado"] = "Agregado";
echo json_encode($data);