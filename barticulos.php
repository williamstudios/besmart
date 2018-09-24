<?php
include_once"conect.php";
session_start();
$id = addslashes($_GET["id"]);
$busca = mysqli_query($con, "SELECT id, Nombre FROM Articulos WHERE almacen = '$id' ORDER BY Nombre ASC");
$si = 0;
echo '<label for="company" class=" form-control-label">Agregar articulos</label>
<select class="form-control" name="articulo" id="elart">
<option value="0">Seleccionar</option>';
while ($result = mysqli_fetch_assoc($busca)) {
   echo '<option value="' . $result["id"] . '">' . $result["Nombre"] . '</option>';
  $si = 1;
}
echo '</select>'

?>
