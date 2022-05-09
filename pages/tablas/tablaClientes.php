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
                <?php
                set_time_limit(0);
                include '../../php/ConexionSQL.php';
                $consulta = "SELECT NOMBRE, CLIENTE, TIPO FROM clients WHERE CLIENTE LIKE '%02376%'";
                $resultado = sqlsrv_query($Conn, $consulta);
                while ($datos = sqlsrv_fetch_array($resultado)){
                ?>
                    <tr>
                        <th scope="row"><?php echo $datos['CLIENTE']?></th>
                        <td><?php echo $datos['NOMBRE']?></td>
                        <td><?php echo $datos['TIPO']?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>