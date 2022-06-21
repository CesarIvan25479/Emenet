<?php
function validarMesPago($id,$nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion){
    $consulta = "SELECT *FROM pagosazteca WHERE Nombre = '$nombre' AND Mes = '$mesPago'";
    $resultado = mysqli_query($Conexion, $consulta);
    $verifica = mysqli_num_rows($resultado);
    if($verifica){
        return "errormes";
    }else{
        return actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
    }
}
function validaNumOperacion($numOperacion, $Conexion){
    $consulta = "SELECT * FROM pagosazteca WHERE NumOperacion='$numOperacion' AND NumOperacion!=''"; 
    $resultado = mysqli_query($Conexion, $consulta);
    $verifica = mysqli_num_rows($resultado);
    return $verifica;
}
function actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion){
    $consulta="UPDATE pagosazteca SET 
    Nombre = '$nombre', FechaPago = '$fechaDeposito', Mes = '$mesPago', Importe = '$pago', FormaPago = '$formaPago', NumOperacion = '$numOperacion', Observacion = '$observacion' 
    WHERE id = '$id'";
    $resultado = mysqli_query($Conexion, $consulta);
    if($resultado){
        return "Actualizado";
    }else{
        return "error";
    }
}

function CamposSinCambios($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion){
    if($formaPago == "Efectivo Almoloya"){
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }else{
            if(empty($observacion) || empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }else{
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre) || empty($numOperacion)){
                return "llenaCampos";
            }else{
                return actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }else{
            if(empty($pago) || empty($nombre) || empty($numOperacion) || empty($observacion)){
                return "llenaCampos";
            }else{
                return actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }
}

function CamposCambioMes($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion){
    if($formaPago == "Efectivo Almoloya"){
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return validarMesPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }else{
            if(empty($observacion) || empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return actualizarPago($id,$nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }else{
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre) || empty($numOperacion)){
                return "llenaCampos";
            }else{
                return validarMesPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }else{
            if(empty($pago) || empty($nombre) || empty($numOperacion) || empty($observacion)){
                return "llenaCampos";
            }else{
                return actualizarPago($id,$nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }
}

function CamposCambioTodos($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion){
    if($formaPago == "Efectivo Almoloya"){
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return validarMesPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }else{
            if(empty($observacion) || empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return actualizarPago($id,$nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }else{
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre) || empty($numOperacion)){
                return "llenaCampos";
            }else{
                if(validaNumOperacion($numOperacion, $Conexion)){
                    return "erroroperacion";
                }else{
                    return validarMesPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
                }
            }
        }else{
            if(empty($pago) || empty($nombre) || empty($numOperacion) || empty($observacion)){
                return "llenaCampos";
            }else{
                return actualizarPago($id,$nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }
}

function CamposCambioNumOpe($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion){
    if($formaPago == "Efectivo Almoloya"){
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }else{
            if(empty($observacion) || empty($pago) || empty($nombre)){
                return "llenaCampos";
            }else{
                return actualizarPago($id,$nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }else{
        if($mesPago != "OTRO"){
            if(empty($pago) || empty($nombre) || empty($numOperacion)){
                return "llenaCampos";
            }else{
                if(validaNumOperacion($numOperacion, $Conexion)){
                    return "erroroperacion";
                }else{
                    return actualizarPago($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
                }
            }
        }else{
            if(empty($pago) || empty($nombre) || empty($numOperacion) || empty($observacion)){
                return "llenaCampos";
            }else{
                return actualizarPago($id,$nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
            }
        }
    }
}

include "../../php/ConexionMySQL.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$fechaDeposito = $_POST["fechaPago"];
$formaPago = $_POST["formaPago"];
$mesPago = $_POST["mesPago"];
$numOperacion = $_POST["numOperacion"];
$observacion = $_POST["observacion"];
$pago = $_POST["pago"];

// $id = "32";
// $nombre = "SHERLYN BELTRAN SOSA";
// $fechaDeposito = "2022-05-26";
// $formaPago = "Efectivo Almoloya";
// $mesPago = "OTRO";
// $numOperacion = "";
// $observacion = "nada";
// $pago = "300";

$consulta = "SELECT Mes, FormaPago, NumOperacion FROM pagosazteca WHERE id = '$id'";
$resultado = mysqli_query($Conexion, $consulta);
$infoActualPago = mysqli_fetch_array($resultado);
$verMes = $infoActualPago["Mes"];
$verFormPago = $infoActualPago["FormaPago"];
$verNumOpe = $infoActualPago["NumOperacion"];
//Valida los campos de mes, forma de pago y numero de operacion si se realizan cambios
if($mesPago == $verMes && $formaPago == $verFormPago && $numOperacion == $verNumOpe){
    //no se hizo ningun cambio en los campos
    $data["estado"] = CamposSinCambios($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}elseif($mesPago != $verMes && $formaPago == $verFormPago && $numOperacion == $verNumOpe){
    //se realizo en cambio en el campo mes
    $data["estado"] = CamposCambioMes($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}elseif($mesPago != $verMes && $formaPago != $verFormPago && $numOperacion == $verNumOpe){
    //se realizo un cambio en mes y forma de pago;
    $data["estado"] = CamposCambioMes($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}elseif($mesPago != $verMes && $formaPago != $verFormPago && $numOperacion != $verNumOpe){
    //se modificaron todos los campos
    $data["estado"] = CamposCambioTodos($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}elseif($mesPago == $verMes && $formaPago != $verFormPago && $numOperacion == $verNumOpe){
    //Se realizo cambio en la forma de pago
    $data["estado"] = CamposSinCambios($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}elseif($mesPago == $verMes && $formaPago == $verFormPago && $numOperacion != $verNumOpe){
    //Se realizo cambio en el numero de operacion
    $data["estado"] = CamposCambioNumOpe($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}elseif($mesPago == $verMes && $formaPago != $verFormPago && $numOperacion != $verNumOpe){
    //se cambio la forma de pago y el numero de operacion
    $data["estado"] = CamposCambioNumOpe($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}elseif($mesPago != $verMes && $formaPago == $verFormPago && $numOperacion != $verNumOpe){
    //se cambio el mes y el numero de operacion
    $data["estado"] = CamposCambioTodos($id, $nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $Conexion);
}
echo json_encode($data);



