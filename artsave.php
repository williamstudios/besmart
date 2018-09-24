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

  $nom = "nom";
  $nom = addslashes($_POST[$nom]);

  if (!empty($nom)) {
  $costo = addslashes($_POST["costo"]);

  $stock = addslashes($_POST["stock"]);

  $depar = addslashes($_POST["departamento"]);

  $almacen = addslashes($_POST["almacen"]);



  mysqli_query($con, "INSERT INTO Articulos (Nombre, stock, costo, almacen, Departamento, id_cliente) VALUES ('$nom', '$stock', '$costo', '$almacen','$depar', '$id_cliente')");
  header ("location: articulos.php?r=correcto");

  } else {
    header ("location: articulos.php");
  }

?>
<?php
mysqli_close($con);
?>
