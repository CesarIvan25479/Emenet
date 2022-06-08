<?php
$fechaInicio = $_GET["fechaInicio"];
$fechaFin = $_GET["fechaFin"];
$tipo = $_GET["tipo"];
$instalacion = $_GET["instalacion"];
echo $tipo;
include "../../php/ConexionMySQL.php";
if($tipo == "-Selecciona-" && $instalacion == "-Selecciona-"){
    $query = "SELECT * FROM ordenes WHERE FechaIns BETWEEN '$fechaInicio' AND '$fechaFin'";
    $result = mysqli_query($Conexion, $query);
}else if($tipo != "-Selecciona-" && $instalacion == "-Selecciona-"){
    $query = "SELECT * FROM ordenes WHERE FechaIns BETWEEN '$fechaInicio' AND '$fechaFin' AND Tipo='$tipo'";
    $result = mysqli_query($Conexion, $query);
}else if($tipo == "-Selecciona-" && $instalacion != "-Selecciona-"){;
    $query = "SELECT * FROM ordenes WHERE FechaIns BETWEEN '$fechaInicio' AND '$fechaFin' AND Instalacion='$instalacion'";
    $result = mysqli_query($Conexion, $query);
}else if($tipo != "-Selecciona-" && $instalacion != "-Selecciona-"){
    $query = "SELECT * FROM ordenes WHERE FechaIns BETWEEN '$fechaInicio' AND '$fechaFin' AND Instalacion='$instalacion' AND Tipo='$tipo'";
    $result = mysqli_query($Conexion, $query);
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="ordenes" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>FOLIO</th>
                        <th>CLIENTE</th>
                        <th>FECHA INST.</th> 
                        <th>TIPO</th>
                        <th>ORDEN</th>
                        <th>ACCION</th>            
                    </tr>
                </thead>
                <?php while($datosOrden = mysqli_fetch_array($result)):?>
                <tr>
                    <td data-toggle="modal" data-target="#modalActualizarOrden"><?=$datosOrden["Folio"]?></td>
                    <td data-toggle="modal" data-target="#modalActualizarOrden"><?=$datosOrden["Cliente"]?></td>
                    <td data-toggle="modal" data-target="#modalActualizarOrden"><?=$datosOrden["FechaIns"]?></td>
                    <td data-toggle="modal" data-target="#modalActualizarOrden"><?=$datosOrden["Tipo"]?></td>
                    <td data-toggle="modal" data-target="#modalActualizarOrden"><?=$datosOrden["Instalacion"]?></td>
                    <td>fadsfads</td>
                </tr> 
                <?php endwhile;?>    
            </table>
        </div>
     </div>
</div>

<script>
$(document).ready(function() {
	$('#ordenes').DataTable({
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
        scrollY: '85vh',
        scrollCollapse: true
	});
});
    </script>