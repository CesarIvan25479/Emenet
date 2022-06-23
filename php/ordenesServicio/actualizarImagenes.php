<?php

function validarArchivo($tipo, $tamano, $nombre)
{
    $tipoArchvio = array("image/jpeg", "image/jpg", "image/png", "image/gif");
    if (in_array($tipo, $tipoArchvio)) {
        if ($tamano <= 500000) {
            return guardaImagen($nombre);
        } else {
            return "tamano";
        }
    } else {
        return "tipoarchvio";
    }
}
function guardaImagen($nombre)
{
    include "../../php/ConexionMySQL.php";
    $folio = $_POST["folioAct"];
    if ($nombre == "orden") {
        $datosImg = $_FILES['imgOrden']['tmp_name'] ?? "";
        $imgExt = $folio . "orden." . pathinfo($_FILES['imgOrden']['name'], PATHINFO_EXTENSION);
        $destino = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/orden/';

        $query2 = "SELECT ImgOrden FROM ordenes WHERE Folio = '$folio'";
        $result2 = mysqli_query($Conexion, $query2);
        $borrarImagen = mysqli_fetch_array($result2);
        unlink($destino . $borrarImagen["ImgOrden"]);
    } else if ($nombre == "credencial") {
        $datosImg = $_FILES['imgCredencial']['tmp_name'] ?? "";
        $imgExt = $folio . "credencial." . pathinfo($_FILES['imgCredencial']['name'], PATHINFO_EXTENSION) ?? "";
        $destino = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/credencial/';

        $query2 = "SELECT ImgCredencial FROM ordenes WHERE Folio = '$folio'";
        $result2 = mysqli_query($Conexion, $query2);
        $borrarImagen = mysqli_fetch_array($result2);
        unlink($destino . $borrarImagen["ImgCredencial"]);
    } else if ($nombre == "compromiso") {
        $datosImg = $_FILES['imgComp']['tmp_name'] ?? "";
        $imgExt = $folio . "compromiso." . pathinfo($_FILES['imgComp']['name'], PATHINFO_EXTENSION) ?? "";
        $destino = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/compromiso/';

        $query2 = "SELECT ImgCompromiso FROM ordenes WHERE Folio = '$folio'";
        $result2 = mysqli_query($Conexion, $query2);
        $borrarImagen = mysqli_fetch_array($result2);
        unlink($destino . $borrarImagen["ImgCompromiso"]);
    }

    if (move_uploaded_file($datosImg, $destino . $imgExt)) {
        if ($nombre == "orden") {
            $query = "UPDATE ordenes SET ImgOrden = '$imgExt' WHERE Folio = '$folio'";
        } else if ($nombre == "credencial") {
            $query = "UPDATE ordenes SET ImgCredencial = '$imgExt' WHERE Folio = '$folio'";
        } else if ($nombre == "compromiso") {
            $query = "UPDATE ordenes SET ImgCompromiso = '$imgExt' WHERE Folio = '$folio'";
        }
        $result = mysqli_query($Conexion, $query);
        if ($result) {
            return "actualizado";
        } else {
            return "sinconexion";
        }
    } else {
        return "error";
    }
}

$data = array();
//Informacion de la imagen Orden
$tipoOr = $_FILES['imgOrden']['type'] ?? "";
$tamanoOr = $_FILES['imgOrden']["size"] ?? "";
//Informacion de la imagen credencial
$tipoCre = $_FILES['imgCredencial']['type'] ?? "";
$tamanoCre = $_FILES['imgCredencial']["size"] ?? "";

//Informacion de la imagen compromiso
$tipoCom = $_FILES['imgComp']['type'] ?? "";
$tamanoCom = $_FILES['imgComp']["size"] ?? "";


if ($tipoOr != "") {
    $data["tipo"] = "ORden";
    $data["estado"] = validarArchivo($tipoOr, $tamanoOr, "orden");
} else if ($tipoCre != "") {
    $data["tipo"] = "Credencial";
    $data["estado"] = validarArchivo($tipoCre, $tamanoCre, "credencial");
} else if ($tipoCom != "") {
    $data["tipo"] = "Compromiso";
    $data["estado"] = validarArchivo($tipoCom, $tamanoCom, "compromiso");
}

$data["folio"] =  $_POST["folioAct"];
echo json_encode($data);
