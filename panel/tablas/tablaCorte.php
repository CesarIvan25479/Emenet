<?php
include "../../php/ConexionMySQL.php";
include "../../php/ConexionSQL.php";
set_time_limit(0);
$idRouter = $_GET["idRouter"];
$mesCorte = $_GET["mesCorte"];
// Consulta para mostrar los datos del router para hacer corte
$queryMysql = "SELECT *FROM router WHERE id = '$idRouter'";
$resultMysql = mysqli_query($Conexion, $queryMysql);
$datosRouter = mysqli_fetch_array($resultMysql);
$zonas = explode(",", $datosRouter['Zonas']);
//************************************ */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="tablaCor" class="dataTable display cell-border compact table">
                <thead class="thead-dark">
                    <tr>
                        <th>CLIENTE</th>
                        <th>NOMBRE</th>
                        <th>PAGOS</th>
                    </tr>
                </thead>

                <?php foreach ($zonas as &$zona) :
                    $consulta = "SELECT DISTINCT clients.CLIENTE ,clients.NOMBRE, clients.PRECIO FROM clients 
                                INNER JOIN ventas ON clients.CLIENTE = ventas.CLIENTE 
                                WHERE ventas.CLIENTE not in 
                                (SELECT DISTINCT CLIENTE FROM ventas WHERE comodin = '$mesCorte') 
                                AND ZONA='$zona' AND clients.TIPO='{$datosRouter['Tipo']}'";
                    $mostrar = sqlsrv_query($Conn, $consulta);
                    while ($datosCliente = sqlsrv_fetch_array($mostrar)) : ?>
                        <tr>
                            <th scope="row"><?= $datosCliente["CLIENTE"] ?></th>
                            <td><?= $datosCliente["NOMBRE"] ?></td>
                            <th scope="row">
                                <?php
                                $meses = "";
                                $query = "SELECT top(5) P.OBSERV ,V.NO_REFEREN, C.NOMBRE, F_EMISION, V.IMPORTE, V.TIPO_DOC,
                                P.ARTICULO,V.comodin FROM clients C 
                                INNER JOIN ventas V ON 
                                C.CLIENTE=V.CLIENTE INNER JOIN
                                partvta P ON V.VENTA=P.VENTA 
                                WHERE C.CLIENTE='".$datosCliente['CLIENTE']."' AND V.TIPO_DOC!='PE' order by V.F_EMISION  desc";
                                $result = sqlsrv_query($Conn, $query);
                                while($datosPago = sqlsrv_fetch_array($result)):
                                $meses .= $datosPago["comodin"].", ";
                                ?>
                                <?php endwhile;?>
                                <?=$meses?>
                            </th>
                        </tr>
                    <?php endwhile; ?>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
	$('#tablaCor').DataTable({
		"columnDefs": [{
			"targets": 0
		}],
		language: {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Resultados _START_-_END_ de  _TOTAL_",
			"sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "",
			"sSearch": "Buscar Cliente:",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},   
		},
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        scrollCollapse: true
	});
});
</script>