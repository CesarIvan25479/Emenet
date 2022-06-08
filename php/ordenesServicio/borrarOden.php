<?php
include "../ConexionMySQL.php";
$folio = $_POST["folioOrden"];
$query = "DELETE FROM ordenes WHERE Folio = '$folio'";
$data["estado"] = "Agregado";
echo json_encode($data);