<?php
include "../../php/ConexionMySQL.php";
$puerto = $_GET["puerto"];
$caja = $_GET["caja"];
$query = "SELECT * FROM datos_punteo WHERE puerto_id = '$puerto' and caja_id = '$caja' AND estado = '0'";
$result = mysqli_query($Conexion, $query);
$cont = mysqli_num_rows($result);
?> 
<?php if ($cont == 0):?>
    <option>No hay ID ONT Disponibles</option>
<?php else: ?>
    <option>Selecciona ID ONT</option>
<?php endif; ?>


<?php while($ontid = mysqli_fetch_array($result)): ?>
<option value="<?=$ontid['id']?>"><?= $ontid["ontID"]?></option>
<?php endwhile;?>