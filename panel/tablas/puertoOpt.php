<?php
include "../../php/ConexionMySQL.php";
$interface = $_GET["interface"];
$query = "SELECT *FROM puertos WHERE interface_id = '$interface'";
$result = mysqli_query($Conexion, $query);

?> 

<option>Selecciona Puerto</option>
<?php while($puerto = mysqli_fetch_array($result)): ?>
<option value="<?=$puerto['id']?>">Puerto <?= $puerto["numPuerto"]?> <?=$puerto["nombre"]?></option>
<?php endwhile;?>