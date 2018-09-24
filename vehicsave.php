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
  $departamento = "departamento";
  $departamento = addslashes($_POST[$departamento]);

  $km = addslashes($_POST["km"]);

  mysqli_query($con, "INSERT INTO Autos (Nombre, km, departamento, id_cliente) VALUES ('$nom', '$km', '$departamento', '$id_cliente')");
  header ("location: vehiculos.php?r=correcto");

  } else {
    header ("location: vehiculos.php");
  }

?>
<?php
mysqli_close($con);
?>
