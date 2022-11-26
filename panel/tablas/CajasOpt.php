<?php
include "../../php/ConexionMySQL.php";
$puerto = $_GET["puerto"];
$query = "SELECT *FROM cajas WHERE puerto_id = '$puerto'";
$result = mysqli_query($Conexion, $query);
?> 

<option>Selecciona Caja</option>
<?php while($caja = mysqli_fetch_array($result)): ?>
<option value="<?=$caja['id']?>">Caja <?= $caja["nap"]?> <?=$caja["caja"]?></option>
<?php endwhile;?>