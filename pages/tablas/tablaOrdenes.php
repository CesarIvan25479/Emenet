<?php
$fechaInicio = $_GET["fechaInicio"];
$fechaFin = $_GET["fechaFin"];
$tipo = $_GET["tipo"] ?? "-Selecciona-";
$instalacion = $_GET["instalacion"] ?? "-Selecciona-";
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
            <table id="ordenes" class="dataTable display cell-border compact table">
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
                <?php while($datosOrden = mysqli_fetch_array($result)):
                    $infoOrden = $datosOrden["Folio"]."||".$datosOrden["Cliente"]."||".$datosOrden["FechaIns"]."||".$datosOrden["Tipo"]."||".$datosOrden["Instalacion"];
                    ?>
                <tr>
                    <th scope="row" data-toggle="modal" data-target="#modalActualizarOrden" onclick="mostrarDatosAct('<?=$infoOrden?>')"><?=$datosOrden["Folio"]?></th>
                    <td data-toggle="modal" data-target="#modalActualizarOrden" onclick="mostrarDatosAct('<?=$infoOrden?>')"><?=$datosOrden["Cliente"]?></td>
                    <td data-toggle="modal" data-target="#modalActualizarOrden" onclick="mostrarDatosAct('<?=$infoOrden?>')"><?=$datosOrden["FechaIns"]?></td>
                    <td data-toggle="modal" data-target="#modalActualizarOrden" onclick="mostrarDatosAct('<?=$infoOrden?>')"><?=$datosOrden["Tipo"]?></td>
                    <td data-toggle="modal" data-target="#modalActualizarOrden" onclick="mostrarDatosAct('<?=$infoOrden?>')"><?=$datosOrden["Instalacion"]?></td>
                    <td>
                        <form action="../../../Emenet/pages/ordenesDocumentos.php" method="post">
                            <input type="hidden" value="<?=$datosOrden["Folio"]?>" name="folio">
                            <button class="btn btn-block btn-outline-primary btn-xs" type="submit"><i class="fas fa-images"></i></button>
                        </form>
                    </td>
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
        scrollCollapse: true
	});
});
    </script>