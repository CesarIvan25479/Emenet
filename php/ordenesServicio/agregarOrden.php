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
function guardaImagen(){
    $folio = $_POST["folioOrden"];
    //Informacion de imagen de la orde
    $datosOr = $_FILES['imgOrden']['tmp_name'];
    $ordenExt = $folio."orden.".pathinfo($_FILES['imgOrden']['name'], PATHINFO_EXTENSION);
    //Informacion de la imagen de la credencial
    $datosCr = $_FILES['imgCredencial']['tmp_name'];
    $ext = pathinfo($_FILES['imgCredencial']['name'], PATHINFO_EXTENSION);
    $credExt = $ext != "" ? $folio."credencial.".$ext : "";
    //Informacion de la imagen del Compromiso
    $datosComp = $_FILES['imgComp']['tmp_name'];
    $comExt = $folio."compromiso.".pathinfo($_FILES['imgComp']['name'], PATHINFO_EXTENSION);
    
    $nombre = $_POST["nombre"];
    $fechaOrden = $_POST["fechaInst"];
    $tipoServicio = $_POST["tipoServicio"];
    $tipoIns = $_POST["tipoIns"];
    $destinoOrden = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/orden/';
    $destinoCre = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/credencial/';
    $destinoCom = $_SERVER['DOCUMENT_ROOT'] . '/Emenet/imagenesOrden/compromiso/';
    if(move_uploaded_file($datosOr,$destinoOrden.$ordenExt) && move_uploaded_file($datosComp,$destinoCom.$comExt)){
        move_uploaded_file($datosCr,$destinoCre.$credExt);
        include "../ConexionMySQL.php";
        $consulta = "INSERT INTO ordenes(Folio,Cliente, FechaIns, Tipo, ImgOrden, ImgCredencial, ImgCompromiso, Instalacion)
            VALUE ('$folio', '$nombre', '$fechaOrden', '$tipoServicio', '$ordenExt', '$credExt', '$comExt', '$tipoIns')";
        $result = mysqli_query($Conexion, $consulta);
        if($result){
            return "Agregado";
        }else{
            return "sinconexion";
        }
        
    }else{
        return "error";
    }
}
$data["folio"] = $_POST["folioOrden"];
$data["estado"] = validarArchivo();
echo json_encode($data);
