<?php
include '../../php/ConexionSQL.php';
$cliente = $_GET["cliente"];
$FechaInicio = $_GET["fechaInicio"];
$FechaInicio = str_replace("-","",$FechaInicio);
$todasFechas = $_GET['todasFechas'];
$FechaInicio = $todasFechas == "on" ? "20150101" : $FechaInicio;
$todosConceptos = $_GET['todasConceptos'] ?? false;

date_default_timezone_set('America/Mexico_City');
$FechaActual=date('Ymd');

//Consulta para datos del cliente
$consultaCliente = "SELECT NOMBRE, COLONIA,TELEFONO, TIPO, CLIENTE FROM clients WHERE CLIENTE='$cliente'";
$resultadoCliente = sqlsrv_query($Conn, $consultaCliente);
$datosCliente = sqlsrv_fetch_array($resultadoCliente);
//*********************************

//Consulta reporte de pagos
if($todosConceptos == "on"){
    $consulta = "SELECT P.OBSERV ,V.NO_REFEREN, C.NOMBRE, F_EMISION, P.PRECIO, V.TIPO_DOC,
            P.ARTICULO,V.comodin FROM clients C 
            INNER JOIN ventas V ON 
            C.CLIENTE=V.CLIENTE INNER JOIN
            partvta P ON V.VENTA=P.VENTA 
            WHERE C.CLIENTE='$cliente' AND V.F_EMISION BETWEEN '$FechaInicio' AND '$FechaActual' 
            AND V.TIPO_DOC!='PE' order by V.F_EMISION  asc";
            $reporteVentas = sqlsrv_query($Conn , $consulta);

}else{
    $consulta = "SELECT P.OBSERV ,V.NO_REFEREN, C.NOMBRE, F_EMISION, P.PRECIO, V.TIPO_DOC,
            P.ARTICULO,V.comodin FROM clients C 
            INNER JOIN ventas V ON 
            C.CLIENTE=V.CLIENTE INNER JOIN
            partvta P ON V.VENTA=P.VENTA 
            WHERE C.CLIENTE='$cliente' AND V.F_EMISION BETWEEN '$FechaInicio' AND '$FechaActual' 
            AND ARTICULO='RI' AND V.TIPO_DOC!='PE' order by V.F_EMISION  asc";
            $reporteVentas = sqlsrv_query($Conn , $consulta);
}


//*********************************************** */

?>



<div class="row">
	<div class="col-sm-12">
        <div class="card-box table-responsive">
            <div class="col-md-12">
                <h5><?=$datosCliente['CLIENTE']?> <?=$datosCliente['NOMBRE']?> 
                <small><?=$datosCliente['TELEFONO']?> <?=$datosCliente['COLONIA']?> <?=$datosCliente['TIPO']?>
                </small>
                </h5>
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
            <?php while($datosReporte = sqlsrv_fetch_array($reporteVentas)):
                    $result =$datosReporte['F_EMISION']->format('d-m-Y');?>
                <tr class="table-info">
                    <td><?=$datosReporte['TIPO_DOC'],$datosReporte['NO_REFEREN']?></td>
                    <td><?=$result?></td>
                    <td><?=$datosReporte["comodin"]?></td>
                    <td><?=$datosReporte["ARTICULO"]?></td>
                    <td><?=$datosReporte["OBSERV"]; ?></td>
                    <td><?=$datosReporte["PRECIO"]; ?></td>
                </tr>
                <?php endwhile;?>         
                 
        </table>
            </div>
    </div>
</div>