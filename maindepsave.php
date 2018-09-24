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
  $presupuesto = "presupuesto";
  $presupuesto = addslashes($_POST[$presupuesto]);

  $domicilio = "domicilio";
  $domicilio = addslashes($_POST[$domicilio]);
  mysqli_query($con, "INSERT INTO main_Departamentos (Nombre, presupuesto, id_cliente, domicilio) VALUES ('$nom', '$presupuesto', '$id_cliente', '$domicilio')");
  header ("location: maindepartamentos.php?r=correcto");

  } else {
    header ("location: maindepartamentos.php");
  }

?>
<?php
mysqli_close($con);
?>
