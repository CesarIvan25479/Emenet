
<?php
include '../../php/ConexionMySQL.php';
$estado = $_GET["estado"] ?? null;
$mes = $_GET["mes"] ?? null;
$todosReg = $_GET["todosreg"] ?? null;
if($todosReg == "off"){
    switch ($estado){
        case "PENDIENTE":
            $consulta = "SELECT *FROM pagosazteca WHERE Estado='PENDIENTE' AND Mes = '$mes'";
            $pagosEstado = mysqli_query($Conexion, $consulta);
        break;
        case "REGISTRADOS":
            echo "registrados";
        break;
        case "FINALIZADO":
            echo "finazlizado";
        break;
        case "TODOS":
            echo "todos";
        break;
    }
}else{
    switch ($estado){
        case "PENDIENTE":
            $consulta = "SELECT *FROM pagosazteca WHERE Estado='PENDIENTE'";
            $pagosEstado = mysqli_query($Conexion, $consulta);
        break;
        case "REGISTRADOS":
            echo "registrados";
        break;
        case "FINALIZADO":
            echo "finazlizado";
        break;
        case "TODOS":
            echo "todos";
        break;
    }
}


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
                    <?php endif;?>
                </thead>
                <?php
                $count = 0; 
                while($datosPago = mysqli_fetch_array($pagosEstado)):
                $count += 1;?>
                    <?php if()?>

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
                    onclick=""><img src="./asset/verify.png" width="20px"></button></td>
                </tr>       
                <?php endwhile?>
            </table>
        </div>
    </div>
</div>