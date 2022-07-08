<?php
include '../../php/ConexionMySQL.php';
$query = "SELECT *FROM router";
$result = $Conexion -> query($query);

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="tablaRouters" class="dataTable display cell-border compact table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>IP</th>
                        <th>PuertoAPI</th>
                        <th>Zonas</th>
                        <th>TIPO</th>
                        <th>Acción</th>

                    </tr>
                </thead>
                <?php while($datosRouter = $result -> fetch_array(MYSQLI_BOTH)):?>
                <tr>
                    <th scope="row"><?=$datosRouter['id']?></th>
                    <td><?=$datosRouter['Nombre']?></td>
                    <td><?=$datosRouter['IP']?></td>
                    <td><?=$datosRouter['PuertoAPI']?></td>
                    <td><?=$datosRouter['Zonas']?></td>
                    <td><?=$datosRouter['Tipo']?></td>
                    <td>
                        <button class="btn btn-block btn-outline-primary btn-xs" type="submit"><i class="fas fa-chart-bar"></i></button>
                    </td>
                </tr>
                <?php endwhile;?>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
	$('#tablaRouters').DataTable({
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