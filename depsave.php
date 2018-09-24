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


  $nom = "nom";
  $nom = addslashes($_POST[$nom]);

  if (!empty($nom)) {
  $departamento= "departamento";
  $departamento = addslashes($_POST[$departamento]);

  $domicilio = "domicilio";
  $domicilio = addslashes($_POST[$domicilio]);
  mysqli_query($con, "INSERT INTO Departamentos (Nombre, domicilio, id_cliente, main_dep) VALUES ('$nom', '$domicilio', '$id_cliente', '$departamento')");
  $ultimo = mysqli_insert_id($con);


    header ("location: departamentos.php?r=correcto");

  } else {

    header ("location: departamentos.php");

  }

?>
<?php
mysqli_close($con);
?>
