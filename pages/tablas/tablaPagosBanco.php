
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
include '../../php/ConexionMySQL.php';
$estado = $_GET["estado"] ?? null;
$mes = $_GET["mes"] ?? null;
$todosReg = $_GET["todosreg"] ?? null;
$todosReg == "off" ? $pagosEstado = registrosMes($estado, $mes, $Conexion) : $pagosEstado = registrosTodos($estado, $Conexion);

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
                    <?php endif;?>
                </thead>

                        
                <?php if($estado == "PENDIENTE"):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                        <tr class="table-danger">
                            <th scope="row"><?=$count?></th>
                            <td><?=$datosPago['Nombre']?></td>
                            <td><?=$datosPago['FechaPago']?></td>
                            <td><?=$datosPago['Mes']?></td>
                            <td><?=$datosPago['NumOperacion']?></td>
                            <td><?=$datosPago['Importe']?></td>
                            <td><?=$datosPago['FormaPago']?></td>
                            <td><?=$datosPago['Observacion']?></td>
                            <td><button type="submit" class="btn btn-link" id="GenerarPgos" 
                                        onclick=""><img src="./asset/verify.png" width="25px"></button></td>
                        </tr>       
                <?php endwhile?>
                <?php elseif($estado == "REGISTRADOS"):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                    <tr class="table-warning">
                        <th scope="row"><?=$count?></th>
                        <td><?=$datosPago['Nombre']?></td>
                        <td><?=$datosPago['Mes']?></td>
                        <td><?=$datosPago['Importe']?></td>
                        <td><?=$datosPago['NumOperacion']?></td>
                        <td><?=$datosPago['FormaPago']?></td>
                        <td><button type="submit" class="btn btn-link" id="GenerarPgos" 
                                    onclick=""><img src="./asset/verify.png" width="25px"></button></td>
                    </tr>       
                <?php endwhile?>
                <?php elseif($estado == "FINALIZADO"):?>
                    <?php
                    $count = 0; 
                    while($datosPago = mysqli_fetch_array($pagosEstado)):
                    $count += 1;?>
                    <tr class="table-success">
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
                <?php endif;?>
            </table>
        </div>
    </div>
</div>