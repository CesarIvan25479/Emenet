<?php
function validarMesPago($nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $telefono, $poblacion, $Conexion){
    $consulta = "SELECT *FROM pagosazteca WHERE Nombre = '$nombre' AND Mes = '$mesPago'";
    $resultado = mysqli_query($Conexion, $consulta);
    $verifica = mysqli_num_rows($resultado);
    if($verifica){
        return "errormes";
    }else{
        return agregaRegistroPago($nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $telefono, $poblacion, $Conexion);;
    }
}
function validaNumOperacion($numOperacion, $Conexion){
    $consulta = "SELECT * FROM pagosazteca WHERE NumOperacion='$numOperacion' AND NumOperacion!=''"; 
    $resultado = mysqli_query($Conexion, $consulta);
    $verifica = mysqli_num_rows($resultado);
    return $verifica;
}
function agregaRegistroPago($nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $telefono, $poblacion, $Conexion){
    $consulta="INSERT INTO pagosazteca (Nombre, FechaPago, Mes, Importe, NumOperacion, FormaPago, Observacion, Telefono, Poblacion) 
    VALUES 
    ('$nombre', '$fechaDeposito', '$mesPago', '$pago', '$numOperacion', '$formaPago', '$observacion', '$telefono', '$poblacion')";
    $resultado = mysqli_query($Conexion, $consulta);
    if($resultado){
        return "Agregado";
    }else{
        return "error";
    }
}



include "../../php/ConexionMySQL.php";
$nombre = $_POST["nombre"];
$fechaDeposito = $_POST["fechaDeposito"];
$formaPago = $_POST["formaPago"];
$mesPago = $_POST["mesPago"];
$numOperacion = $_POST["numeroOperacion"];
$observacion = $_POST["observacion"];
$pago = $_POST["pago"];
$telefono = $_POST["telefono"];
$poblacion = $_POST["poblacion"];

$data["nombre"] = $nombre;
$data["mes"] = $mesPago;

if($formaPago == "Efectivo Almoloya"){
    if($mesPago != "OTRO"){
        if(empty($pago) || empty($nombre)){
            $data['estado'] = "llenaCampos";
        }else{
            $data['estado'] = validarMesPago($nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $telefono, $poblacion, $Conexion);
        }
    }else{
        if(empty($observacion) || empty($pago) || empty($nombre)){
            $data['estado'] = "llenaCampos";
        }else{
            $data['estado'] = agregaRegistroPago($nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $telefono, $poblacion, $Conexion);
        }
    }
}else{
    if($mesPago != "OTRO"){
        if(empty($pago) || empty($nombre) || empty($numOperacion)){
            $data['estado'] = "llenaCampos";
        }else{
            if(validaNumOperacion($numOperacion, $Conexion)){
                $data['estado'] = "erroroperacion";
            }else{
                $data['estado'] = validarMesPago($nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $telefono, $poblacion, $Conexion);
            }
        }
    }else{
        if(empty($pago) || empty($nombre) || empty($numOperacion) || empty($observacion)){
            $data['estado'] = "llenaCampos";
        }else{
            $data['estado'] = agregaRegistroPago($nombre, $fechaDeposito, $mesPago, $pago, $numOperacion, $formaPago, $observacion, $telefono, $poblacion, $Conexion);
        }
    }
}
echo json_encode($data);