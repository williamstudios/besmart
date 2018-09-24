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
  $apep = "apep";
  $apep = addslashes($_POST[$apep]);

  $apem = "apem";
  $apem = addslashes($_POST[$apem]);

  $salario = "salario";
  $salario = addslashes($_POST[$salario]);

  $domicilio = "domicilio";
  $domicilio = addslashes($_POST[$domicilio]);

  $departamento = "departamento";
  $departamento = addslashes($_POST[$departamento]);

  $fecha = date("Y-m-d");
  $hora = date("H:i:s");



  mysqli_query($con, "INSERT INTO empleados (Nombre, AppelidoP, AppelidoM, Departamento, salario, domicilio, fecha_alta, hora_alta, id_cliente) VALUES ('$nom', '$apep', '$apem', '$departamento', '$salario', '$domicilio', '$fecha', '$hora', '$id_cliente')");
  $ultimo = mysqli_insert_id($con);

  header ("location: empleados.php?r=correcto");
  } else {
    header ("location: empleados.php");
  }

?>
<?php
mysqli_close($con);
?>
