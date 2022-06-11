
<?php
function registrosMes($estado, $mes, $Conexion){
    $consulta = "SELECT *FROM pagosazteca WHERE Estado='$estado' AND Mes = '$mes'";
    $pagosEstado = mysqli_query($Conexion, $consulta);
    return $pagosEstado;
}

function registrosTodos($estado, $Conexion){
    $consulta = "SELECT *FROM pagosazteca WHERE Estado='$estado'";
    $pagosEstado = mysqli_query($Conexion, $consulta);
    return $pagosEstado;
}
function registrosMesCliente($estado, $mes, $nombre, $Conexion){
    $consulta = "SELECT *FROM pagosazteca 
    WHERE Estado='$estado' AND Mes = '$mes' AND Nombre LIKE '%$nombre%' OR NumOperacion LIKE '%$nombre%' OR FechaPago LIKE '%$nombre%'";
    $pagosEstado = mysqli_query($Conexion, $consulta);
    return $pagosEstado;
}

function registrosTodosCliente($estado, $nombre, $Conexion){
    $consulta = "SELECT *FROM pagosazteca WHERE Estado='$estado' AND Nombre LIKE '%$nombre%' OR NumOperacion LIKE '%$nombre%' OR FechaPago LIKE '%$nombre%'";
    $pagosEstado = mysqli_query($Conexion, $consulta);
    return $pagosEstado;
}
//Todo el primer proceso termina aqui
//******************************* */

function registrosMesTodos($mes, $Conexion){
    $consulta = "SELECT *FROM pagosazteca WHERE Mes = '$mes'";
    $pagosEstado = mysqli_query($Conexion, $consulta);
    return $pagosEstado;
}


function registrosMesClienteTodos($mes, $nombre, $Conexion){
    $consulta = "SELECT *FROM pagosazteca 
    WHERE Mes = '$mes' AND Nombre LIKE '%$nombre%' OR NumOperacion LIKE '%$nombre%' OR FechaPago LIKE '%$nombre%'";
    $pagosEstado = mysqli_query($Conexion, $consulta);
    return $pagosEstado;
}

function registrosTodosClienteTodos($nombre, $Conexion){
    $consulta = "SELECT *FROM pagosazteca WHERE Nombre LIKE '%$nombre%' OR NumOperacion LIKE '%$nombre%' OR FechaPago LIKE '%$nombre%'";
    $pagosEstado = mysqli_query($Conexion, $consulta);
    return $pagosEstado;
}

include '../../php/ConexionMySQL.php';
$estado = $_GET["estado"] ?? null;
$mes = $_GET["mes"] ?? null;
$todosReg = $_GET["todosreg"] ?? null;


if($estado != "TODOS"){
    if(isset($_GET["nombre"])){
        $nombre = $_GET["nombre"];
        $todosReg == "off" ? $pagosEstado = registrosMesCliente($estado, $mes, $nombre, $Conexion) : $pagosEstado = registrosTodosCliente($estado, $nombre, $Conexion);
    }else{
        $todosReg == "off" ? $pagosEstado = registrosMes($estado, $mes, $Conexion) : $pagosEstado = registrosTodos($estado, $Conexion);
    }
}else{
    if(isset($_GET["nombre"])){
        $nombre = $_GET["nombre"];
        $todosReg == "off" ? $pagosEstado = registrosMesClienteTodos($mes, $nombre, $Conexion) : $pagosEstado = registrosTodosClienteTodos($nombre, $Conexion);
    }else{
        $nombre = "";
        $todosReg == "off" ? $pagosEstado =  registrosMesTodos($mes, $Conexion) : $pagosEstado = registrosMesClienteTodos($mes, $nombre, $Conexion);
    }
}

$count = 0; 

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">

                    <?php if($estado == "PENDIENTE"):?>
                    <tr>
                        <th>#</th>
                        <th>CLIENTE</th>
                        <th>FECHA</th>
                        <th>MES</th>            
                        <th>N. OPE</th>
                        <th>IMPORTE</th>
                        <th>FO. PAGO.</th>
                        <th>OBSERVACION</th>
                        <th>MOV.</th>   
                    </tr>
                    <?php elseif($estado == "REGISTRADOS"):?>
                    <tr>
                        <th>#</th>
                        <th>CLIENTE</th>
                        <th>MES</th>
                        <th>IMPORTE</th>            
                        <th>N. OPE</th>
                        <th>FO. PAGO.</th>
                        <th>MOV.</th>   
                    </tr>
                    <?php elseif($estado == "FINALIZADO"):?>
                    <tr>
                        <th>#</th>
                        <th>CLIENTE</th>
                        <th>FECHA</th>
                        <th>MES</th>            
                        <th>N. OPE</th>
                        <th>IMPORTE</th>
                        <th>FO. PAGO.</th>
                        <th>OBSERVACION</th> 
                    </tr>
                    <?php elseif($estado == "TODOS"):?>
                        <tr>
                        <th>#</th>
                        <th>CLIENTE</th>
                        <th>FECHA</th>
                        <th>MES</th>            
                        <th>N. OPE</th>
                        <th>IMPORTE</th>
                        <th>FO. PAGO.</th>
                        <th>OBSERVACION</th>
                        <th>POBLACION</th> 
                        <th>ESTADO</th>
                    </tr>
                    <?php endif;?>
                </thead>

                        
                <?php if($estado == "PENDIENTE"):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                        <tr class="table-danger">
                            <th scope="row" onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$count?></th>
                            <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['Nombre']?></td>
                            <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['FechaPago']?></td>
                            <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['Mes']?></td>
                            <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['NumOperacion']?></td>
                            <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['Importe']?></td>
                            <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['FormaPago']?></td>
                            <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['Observacion']?></td>
                            <td><button type="submit" class="btn btn-link" id="GenerarPgos" 
                                        onclick="pagoRegistrado('<?=$datosPago['id']?>')"><img src="./asset/verify.png" width="25px"></button></td>
                        </tr>       
                <?php endwhile?>
                <?php elseif($estado == "REGISTRADOS"):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                    <tr class="table-warning">
                        <th scope="row" onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$count?></th>
                        <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['Nombre']?></td>
                        <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['Mes']?></td>
                        <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['Importe']?></td>
                        <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['NumOperacion']?></td>
                        <td onclick="mostrarDatosPagos('<?=$datosPago['id']?>')"><?=$datosPago['FormaPago']?></td>
                        <td><button type="submit" class="btn btn-link" id="GenerarPgos" 
                                    onclick="pagoFinalizado('<?=$datosPago['id']?>')"><img src="./asset/verify.png" width="25px"></button></td>
                    </tr>       
                <?php endwhile?>
                <?php elseif($estado == "FINALIZADO" && $todosReg == "off"):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                    <tr class="table-success" onclick="mostrarDatosPagos('<?=$datosPago['id']?>')">
                        <th scope="row"><?=$count?></th>
                        <td><?=$datosPago['Nombre']?></td>
                        <td><?=$datosPago['FechaPago']?></td>
                        <td><?=$datosPago['Mes']?></td>
                        <td><?=$datosPago['NumOperacion']?></td>
                        <td><?=$datosPago['Importe']?></td>
                        <td><?=$datosPago['FormaPago']?></td>
                        <td><?=$datosPago['Observacion']?></td>
                    </tr>       
                <?php endwhile?>
                <?php elseif($estado == "FINALIZADO" && $todosReg == "on" && isset($_GET["nombre"])):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                    <tr class="table-success" onclick="mostrarDatosPagos('<?=$datosPago['id']?>')">
                        <th scope="row"><?=$count?></th>
                        <td><?=$datosPago['Nombre']?></td>
                        <td><?=$datosPago['FechaPago']?></td>
                        <td><?=$datosPago['Mes']?></td>
                        <td><?=$datosPago['NumOperacion']?></td>
                        <td><?=$datosPago['Importe']?></td>
                        <td><?=$datosPago['FormaPago']?></td>
                        <td><?=$datosPago['Observacion']?></td>
                    </tr>       
                <?php endwhile?>
                <?php elseif($estado == "TODOS" && $todosReg == "on" && isset($_GET["nombre"])):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                    <tr class="table-success" onclick="mostrarDatosPagos('<?=$datosPago['id']?>')">
                        <th scope="row"><?=$count?></th>
                        <td><?=$datosPago['Nombre']?></td>
                        <td><?=$datosPago['FechaPago']?></td>
                        <td><?=$datosPago['Mes']?></td>
                        <td><?=$datosPago['NumOperacion']?></td>
                        <td><?=$datosPago['Importe']?></td>
                        <td><?=$datosPago['FormaPago']?></td>
                        <td><?=$datosPago['Observacion']?></td>
                        <td><?=$datosPago['Poblacion']?></td>
                        <td><?=$datosPago['Estado']?></td>
                    </tr>       
                <?php endwhile?>
                <?php elseif($estado == "TODOS" && $todosReg == "off"):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                    <tr class="table-success" onclick="mostrarDatosPagos('<?=$datosPago['id']?>')">
                        <th scope="row"><?=$count?></th>
                        <td><?=$datosPago['Nombre']?></td>
                        <td><?=$datosPago['FechaPago']?></td>
                        <td><?=$datosPago['Mes']?></td>
                        <td><?=$datosPago['NumOperacion']?></td>
                        <td><?=$datosPago['Importe']?></td>
                        <td><?=$datosPago['FormaPago']?></td>
                        <td><?=$datosPago['Observacion']?></td>
                        <td><?=$datosPago['Poblacion']?></td>
                        <td><?=$datosPago['Estado']?></td>
                    </tr>       
                <?php endwhile?>
                <?php endif;?>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(() =>{
        document.getElementById("text-resultados").innerText = "Numero de resultados: <?=$count?>";
    });
</script>