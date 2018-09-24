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
  $date = addslashes($_POST["date"]);
  mysqli_query($con, "UPDATE peticiones SET status = 4 WHERE id = '$peti' AND id_cliente = '$id_cliente'");
  mysqli_query($con, "INSERT INTO kilometrajes (id_auto, km, id_cliente, fecha, id_peticion) VALUES ('$vehiculo', '$km', '$id_cliente', '$date', '$peti')");
  if (!empty($peti)) {
  $contando = 0;

  while (1 == 1) {
    $idconcepto = "idconcepto" . $contando;
    $idconcepto = addslashes($_POST[$idconcepto]);

    $concepto = "concepto" . $contando;
    $concepto = addslashes($_POST[$concepto]);

    $cconcepto = "cconcepto" . $contando;
    $cconcepto = addslashes($_POST[$cconcepto]);

    if (!empty($idconcepto)) {
      mysqli_query($con, "INSERT INTO conceptos (id_con, Nombre, cantidad, id_cliente, id_peticion) VALUES ('$idconcepto', '$concepto', '$cconcepto', '$id_cliente', '$peti')");
    }

    $idcuadrilla = "idcuadrilla" . $contando;
    $idcuadrilla = addslashes($_POST[$idcuadrilla]);

    $cuadrilla = "cuadrilla" . $contando;
    $cuadrilla = addslashes($_POST[$cuadrilla]);

    if (!empty($idcuadrilla)) {
      mysqli_query($con, "INSERT INTO cuadrillas (id_cuad, Nombre, id_cliente, id_peticion) VALUES ('$idcuadrilla', '$cuadrilla', '$id_cliente', '$peti')");
    }
    $contando++;
    if ($contando == 100) {
      break;
    }
  }


  } else {
    echo 0;
  }

?>
<?php
mysqli_close($con);
?>
