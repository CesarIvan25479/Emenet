<?php
function validarArchivo(){
    //Informacion de imagen de la orde
    $tipoOr = $_FILES['imgOrden']['type'];
    $tamanoOr = $_FILES['imgOrden']["size"];
    //Informacion de la imagen de la credencial
    $tipoCr = $_FILES['imgCredencial']['type'];
    $tamanoCr = $_FILES['imgCredencial']["size"];
    //Informacion de la imagen del Compromiso
    $tipoComp = $_FILES['imgComp']['type'];
    $tamanoComp = $_FILES['imgComp']["size"];
    $tipoArchvio = array("image/jpeg", "image/jpg", "image/png", "image/gif" , "");
    if(in_array($tipoOr, $tipoArchvio) && in_array($tipoCr, $tipoArchvio) && in_array($tipoComp, $tipoArchvio)){
        if($tamanoOr <= 500000 && $tamanoCr <= 500000 && $tamanoComp <= 500000 ){
            return guardaImagen();
        }else{
            return "tamano";
        }
    }else{
        return "tipoarchvio";
    }
}


include "../ConexionMySQL.php";
$folio = $_POST["actuFolioOrden"];
$nombre = $_POST["actuNombre"];
$fechaInt = $_POST["actuFechaInst"];
$tipo = $_POST["actuTipoServicio"];
$instalacion = $_POST["actuTipoIns"];

$query = "UPDATE ordenes SET Cliente = '$nombre', FechaIns = '$fechaInt', Tipo = '$tipo', Instalacion = '$instalacion'  WHERE Folio = '$folio'";
$result = mysqli_query($Conexion, $query);
if($result){
    $data["info"] = $_POST;
    $data["folio"] = $folio;
    $data["estado"] = "actualizado";
}
echo json_encode($data);