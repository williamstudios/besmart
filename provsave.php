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
  $rfc = addslashes($_POST["rfc"]);

  $ciudad = addslashes($_POST["ciudad"]);
  $estado = addslashes($_POST["estado"]);
  $domicilio = addslashes($_POST["domicilio"]);
  $telefono = addslashes($_POST["telefono"]);
  $correo = addslashes($_POST["correo"]);
  $contacto = addslashes($_POST["contacto"]);
  $celular= addslashes($_POST["celular"]);

  mysqli_query($con, "INSERT INTO proveedores (nombre, rfc, telefono, contacto, celular, email, estado, ciudad, domicilio, id_cliente)  VALUES ('$nom', '$rfc', '$telefono', '$contacto', '$celular', '$correo', '$estado', '$ciudad', '$domicilio', '$id_cliente')");

  header ("location: proveedores.php?r=correcto");
  } else {
    header ("location: proveedores.php");
  }

?>
<?php
mysqli_close($con);
?>
