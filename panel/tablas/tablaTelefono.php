<?php
include '../../php/ConexionSQL.php';
$cliente = $_GET["cliente"];
$fechaInicio = $_GET["fechaInicio"];
$todasFechas = $_GET['todasFechas'];
$fechaInicio = $todasFechas == "on" ? "20150101" : $fechaInicio;
$numeroTelefono = $_GET["numTel"];
date_default_timezone_set('America/Mexico_City');
$fechaActual=date('Ymd');

$consulta = "SELECT P.OBSERV ,V.NO_REFEREN, C.NOMBRE, F_EMISION, P.PRECIO, V.TIPO_DOC,
            P.ARTICULO,V.comodin FROM clients C 
            INNER JOIN ventas V ON 
            C.CLIENTE=V.CLIENTE INNER JOIN
            partvta P ON V.VENTA=P.VENTA 
            WHERE C.CLIENTE='$cliente' 
            AND V.F_EMISION BETWEEN '$fechaInicio' 
            AND '$fechaActual' AND ARTICULO='RT' 
            AND V.TIPO_DOC!='PE' order by V.F_EMISION  asc";
$resultado = sqlsrv_query($Conn, $consulta);
?>

<div class="row">
	<div class="col-sm-12">
        <div class="card-box table-responsive">
            <div class="col-md-12">
                <h5><?=$numeroTelefono?> Lineas de Telefono</h5>
            </div>
            <table class="table table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>DOC</th>
                        <th>F. EM</th>
                        <th>MES-AÑO</th>            
                        <th>CLAVE</th>
                        <th>DESC.</th>
                        <th>TOTAL</th>            
                    </tr>
                </thead>
                <?php while($reporteVentas = sqlsrv_fetch_array($resultado)):
                    $result =$reporteVentas['F_EMISION']->format('d-m-Y');?>
                <tr class="table-info">
                    <td><?=$reporteVentas['TIPO_DOC'],$reporteVentas['NO_REFEREN']?></td>
                    <td><?=$result?></td>
                    <td><?=$reporteVentas['comodin']?></td>
                    <td><?=$reporteVentas['ARTICULO']?></td>
                    <td><?=$reporteVentas['OBSERV']?></td>
                    <td><?=$reporteVentas['PRECIO']?></td>
                </tr>
                <?php endwhile;?>       
                 
        </table>
            </div>
    </div>
</div>