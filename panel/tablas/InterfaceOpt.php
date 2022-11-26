<?php
include "../../php/ConexionMySQL.php";
$olt_id = $_GET["olt_id"];
$query = "SELECT *FROM interfaces WHERE olt_id = '$olt_id'";
$result = mysqli_query($Conexion, $query);
?> 

<option>Selecciona interface</option>
<?php while($interface = mysqli_fetch_array($result)): ?>
<option value="<?=$interface['id']?>"><?=$interface['nombre'] . " " . $interface["interface"]?></option>
<?php endwhile;?>