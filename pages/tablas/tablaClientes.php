<?php
include '../../php/ConexionSQL.php';
$cliente = $_GET['cliente'];
$consulta = "SELECT NOMBRE, CLIENTE, TIPO FROM clients WHERE NOMBRE LIKE '%$cliente%' OR CLIENTE ='$cliente'";
$resultado = sqlsrv_query($Conn, $consulta);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table class="table table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">CLIENTE</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($datos = sqlsrv_fetch_array($resultado)): ?>
                    <tr>
                        <th scope="row" onclick="InfoCliente('<?=$datos['CLIENTE']?>')"><?=$datos['CLIENTE']?></th>
                        <td onclick="InfoCliente('<?=$datos['CLIENTE']?>')"><?=$datos['NOMBRE']?></td>
                        <td>
                            <?php if($datos['TIPO'] == "BAJA"):?>
                            <?php else: ?>
                                <button class="btn btn-block btn-outline-success btn-xs" onclick="activar('<?=$datos['CLIENTE']?>')"><span class="fa fa-power-off"></span></button>
                                <button class="btn btn-block btn-outline-danger btn-xs" onclick="desactivar('<?=$datos['CLIENTE']?>')"><span class="fa fa-power-off"></span></button>
                            <?php endif;?>
                        </td>
                        
                    </tr>
                <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>
</div>