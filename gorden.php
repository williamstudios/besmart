<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}

if (!empty($_SESSION["admin"])) {
  $usuario = $_SESSION["admin"];
} else {
  $usuario = $_SESSION["usuario"];
}
?>
<?php

  $proveedor = addslashes($_POST["proveedor"]);

  if (!empty($proveedor)) {
  $fechasolicitada = addslashes($_POST["fechasolicitada"]);

  $almacen = addslashes($_POST["almacen"]);

  $recibe = addslashes($_POST["recibe"]);

  $iva = addslashes($_POST["iva"]);
  $autoriz = addslashes($_POST["autoriz"]);

  $fecha = date("Y-m-d");
  $hora = date("H:i:s");
  mysqli_query($con, "INSERT INTO ordenes (proveedor, iva, autoriza, status, fecha_req, fecha, hora, recibe)  VALUES ('$proveedor', '$iva', '$autoriz', 1,'$fechasolicitada', '$fecha', '$hora', '$recibe')");
  $orden = mysqli_insert_id($con);
  $contador = 0;

  while (1 == 1) {

    $art = "art" . $contador;
    $art = addslashes($_POST[$art]);

    if (!empty($art)) {
      $cant = "cant" . $contador;
      $cant = addslashes($_POST[$cant]);

      $price = "price" . $contador;
      $price = addslashes($_POST[$price]);

      mysqli_query($con, "INSERT INTO orden_arts (id_art, id_orden, cantidad, precio, status) VALUES ('$art', '$orden', '$cant', '$price', 1)");

    }

    $contador++;
    if ($contador == 100) {
      break;
    }
  }

  header ("location: ordenes.php?r=correcto");

  } else {
    header ("location: ordenes.php");
  }

?>
<?php
mysqli_close($con);
?>
