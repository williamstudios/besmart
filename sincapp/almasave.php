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
  $depar = "departamento";
  $depar = addslashes($_POST[$depar]);

  if (!empty($nom)) {

  mysqli_query($con, "INSERT INTO Almacenes (Nombre, Departamento, id_cliente) VALUES ('$nom', '$depar', '$id_cliente')");

  header ("location: almacenes.php?r=correcto");
  echo '</select>';
  } else {
    header ("location: almacenes.php");
  }

?>
<?php
mysqli_close($con);
?>
