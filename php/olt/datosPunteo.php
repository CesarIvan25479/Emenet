<?php
include "../ConexionMySQL.php";
$ontID = $_POST["ontId"];
$query = "SELECT inter.interface, pto.numPuerto, dp.ontID, olt.lineProfile, olt.serviceProfile,
pto.vlanInternet, pto.vlanHotspot, dp.serPort, dp.serPort2
FROM datos_punteo AS dp 
INNER JOIN puertos AS pto ON dp.puerto_id = pto.id 
INNER JOIN cajas AS caj ON dp.caja_id = caj.id 
INNER JOIN interfaces AS inter ON inter.id = pto.interface_id 
INNER JOIN olts AS olt ON inter.olt_id = olt.id WHERE dp.id = '$ontID'";
$result = mysqli_query($Conexion, $query);
if($result){
    $data["info"] = mysqli_fetch_array($result);    
}else{
    $data["estado"] = "error";
}

echo json_encode($data);