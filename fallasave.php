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


    $depar = addslashes($_POST["departamento"]);
    mysqli_query($con, "INSERT INTO Fallas (NombreNombre, id_cliente, id_departamento) VALUES ('$nom', '$id_cliente', '$depar')");
  header ("location: fallas.php?r=correcto");

  } else {
    header ("location: fallas.php");
  }

?>
<?php
mysqli_close($con);
?>
