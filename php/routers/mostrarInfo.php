<?php
require_once "../ConexionMySQL.php";
$idRouter = $_POST["idRouter"];
$query = "SELECT *FROM router WHERE id = '$idRouter'";
$result = mysqli_query($Conexion, $query);
$datosRouter = mysqli_fetch_array($result);
$data["estado"] = "mostrar";
$data["info"] = $datosRouter;
echo json_encode($data);