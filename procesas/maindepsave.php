<?php
include_once"../conect.php";
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


  $nom = "nom";
  $nom = addslashes($_POST[$nom]);

  if (!empty($nom)) {
  $presupuesto = "presupuesto";
  $presupuesto = addslashes($_POST[$presupuesto]);

  $domicilio = "domicilio";
  $domicilio = addslashes($_POST[$domicilio]);
  mysqli_query($con, "INSERT INTO main_Departamentos (Nombre, presupuesto, id_cliente, domicilio) VALUES ('$nom', '$presupuesto', '$id_cliente', '$domicilio')");
  $ultimo = mysqli_insert_id($con);


  echo '<select class="form-control select2" name="departamento">
  <option value="">Seleccionar</option>';
  $depas = mysqli_query($con, "SELECT * FROM main_Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
  while ($rdepas = mysqli_fetch_assoc($depas)) {
    echo '<option value="' . $rdepas["id"] .'"';
    if ($rdepas["id"] == $ultimo) {
     echo 'selected';
    }
    echo '>' . $rdepas["Nombre"] .'</option>';
  }
  echo '</select>';
  } else {

  }

?>
<?php
mysqli_close($con);
?>
