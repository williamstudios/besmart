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
  $depar = "depar";
  $depar = addslashes($_POST[$depar]);

  if (!empty($nom)) {

  mysqli_query($con, "INSERT INTO Almacenes (Nombre, Departamento, id_cliente) VALUES ('$nom', '$depar', '$id_cliente')");
  echo '<select class="form-control select2" name="almacen">
  <option value="">sel</option>';
  $depas = mysqli_query($con, "SELECT * FROM Almacenes WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
  while ($rdepas = mysqli_fetch_assoc($depas)) {
    echo '<option value="' . $rdepas["id"] .'" class="almacenes alma'. $rdepas["Departamento"] .'" >' . $rdepas["Nombre"] .'</option>';
  }
  echo '</select>';
  } else {

  }

?>
<?php
mysqli_close($con);
?>
