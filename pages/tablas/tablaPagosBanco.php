<?php
include '../../php/ConexionMySQL.php';
$consulta = "SELECT *FROM pagosazteca WHERE Estado='PENDIENTE'";
$pagosPendiente = mysqli_query($Conexion, $consulta);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table class="table table-sm">
                <thead class="thead-dark">
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
                </thead>
                <?php
                $count = 0; 
                while($datosPago = mysqli_fetch_array($pagosPendiente)):
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
                    <td>DAD</td>
                </tr>       
                <?php endwhile?>
            </table>
        </div>
    </div>
</div>