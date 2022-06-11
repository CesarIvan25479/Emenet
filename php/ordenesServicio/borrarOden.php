<?php
function borrarImagenes($imgOrden, $imgCredencial, $imgCompromiso){
    $destinoOrden = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/orden/';
    $destinoCre = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/credencial/';
    $destinoCom = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/compromiso/';
    if(unlink($destinoOrden.$imgOrden) && unlink($destinoCom.$imgCompromiso)){
        if($imgCredencial != NULL || $imgCredencial != ""){
            unlink($destinoCre.$imgCredencial);
        }else{
            
        }
        return "Borrado";
    }
}
include "../ConexionMySQL.php";
$folio = $_POST["actuFolioOrden"];
$query = "SELECT ImgCompromiso, ImgCredencial, ImgOrden FROM ordenes WHERE Folio = '$folio'";
$result = mysqli_query($Conexion, $query);
$imagenes = mysqli_fetch_array($result);
$query = "DELETE FROM ordenes WHERE Folio = '$folio'";
$result = mysqli_query($Conexion, $query);
$data["estado"] = $result ? borrarImagenes($imagenes["ImgOrden"], $imagenes["ImgCredencial"], $imagenes["ImgCompromiso"]) : "";
$data["folio"] = $folio;
echo json_encode($data);