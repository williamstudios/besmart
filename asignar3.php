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
include_once"conect.php";

  $peticion = "peticion";
  $peticion = addslashes($_POST[$peticion]);

  if (!empty($peticion)) {

   mysqli_query($con, "UPDATE peticiones SET status = 4 WHERE id = '$peticion'");
  $contando = 0;
  while (1 == 1) {
    $articulo = "art" . $contando;
    $articulo = addslashes($_POST[$articulo]);
    if (!empty($articulo)) {
      $cconcepto = "cconcepto" . $contando;
      $cconcepto = addslashes($_POST[$cconcepto]);
      mysqli_query($con, "INSERT INTO conceptos (id_con, cantidad, id_cliente, id_peticion) VALUES ('$articulo', '$cconcepto', '$id_cliente', '$peticion')");
    }

    $cuadril = "cuadril" . $contando;
    $cuadril = addslashes($_POST[$cuadril]);
    if (!empty($cuadril)) {

      mysqli_query($con, "INSERT INTO cuadrillas (id_cuad, id_cliente, id_peticion) values ('$cuadril', '$id_cliente', '$peticion')");
    }

    $vehi = "vehi" . $contando;
    $vehi = addslashes($_POST[$vehi]);
    if (!empty($vehi)) {
      $km = "km" . $contando;
      $km = addslashes($_POST[$km]);
      $costo = "costo" . $contando;
      $costo = addslashes($_POST[$costo]);
      mysqli_query($con, "INSERT INTO kilometrajes (id_auto, km	, costo, id_cliente, id_peticion) VALUES ('$vehi', '$km', '$costo', '$id_cliente', '$peticion')");
    }
    $contando++;
    if ($contando == 100) {
      break;
    }

  }


  header ("location: tarjetas.php?r=correcto");

  } else {
    header ("location: tarjetas.php");
  }

?>
<?php
mysqli_close($con);
?>
