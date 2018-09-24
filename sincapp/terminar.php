<?php
header('Access-Control-Allow-Origin: *');
include_once"../conect.php";

?>
<?php


  $peti = "peti";
  $peti = addslashes($_POST[$peti]);
  $id_cliente = addslashes($_POST["idcliente"]);
  $vehiculo = addslashes($_POST["vehiculo"]);
  $km = addslashes($_POST["km"]);
  $fecha = date("Y-m-d");
  $hora = date("H:i:s");

  mysqli_query($con, "UPDATE peticiones SET status = 3, fecha_cierre = '$fecha', hora_cierre = '$hora' WHERE id = '$peti' AND id_cliente = '$id_cliente'");


?>
<?php
mysqli_close($con);
?>
