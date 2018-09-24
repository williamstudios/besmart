<?php
header('Access-Control-Allow-Origin: *');
include_once"../conect.php";

?>
<?php


  $contando = 0;

  while (1 == 1) {
    $idcuad = "idcuad" . $contando;
    $idcuad = addslashes($_POST[$idcuad]);

    if (!empty($idcuad)) {
      $idcliente = "idcliente" . $contando;
      $idcliente = addslashes($_POST[$idcliente]);

      $petcuad = "petcuad" . $contando;
      $petcuad = addslashes($_POST[$petcuad]);
      mysqli_query($con, "INSERT INTO cuadrillas (id_cuad, id_cliente, id_peticion) VALUES ('$idcuad', '$idcliente', '$petcuad')");
    }

    $idauto = "idauto" . $contando;
    $idauto = addslashes($_POST[$idauto]);

    if (!empty($idauto)) {
      $km = "km" . $contando;
      $km = addslashes($_POST[$km]);

      $costoauto = "costoauto" . $contando;
      $costoauto = addslashes($_POST[$costoauto]);

      $petauto = "petauto" . $contando;
      $petauto = addslashes($_POST[$petauto]);

      $idcliente = "idcliente" . $contando;
      $idcliente = addslashes($_POST[$idcliente]);

      mysqli_query($con, "INSERT INTO kilometrajes (id_auto, km, costo, id_cliente, id_peticion) VALUES ('$idauto', '$km', '$costoauto', '$idcliente', '$petauto')");
    }

    $idconcept = "idconcept" . $contando;
    $idconcept = addslashes($_POST[$idconcept]);

    if (!empty($idconcept)) {

      $cantconcept = "cantconcept" . $contando;
      $cantconcept = addslashes($_POST[$cantconcept]);

      $petconcept = "petconcept" . $contando;
      $petconcept = addslashes($_POST[$petconcept]);

      $idcliente = "idcliente" . $contando;
      $idcliente = addslashes($_POST[$idcliente]);

      mysqli_query($con, "INSERT INTO conceptos (id_con, cantidad, id_cliente, id_peticion) VALUES ('$idconcept', '$cantconcept', '$idcliente', '$petconcept')");
    }

    $idpet = "idpet" . $contando;
    $idpet = addslashes($_POST[$idpet]);

    if (!empty($idpet)) {

      $status = "status" . $contando;
      $status = addslashes($_POST[$status]);

      $idcliente = "idcliente" . $contando;
      $idcliente = addslashes($_POST[$idcliente]);

      mysqli_query($con, "UPDATE peticiones SET status = '$status' WHERE id_cliente = '$idcliente' AND id = '$idpet'");
    }
    $contando++;
    if ($contando == 100) {
      break;
    }
  }


?>
<?php
mysqli_close($con);
?>
