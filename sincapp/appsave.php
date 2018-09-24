
<?php
header('Access-Control-Allow-Origin: *');
include_once"../conect.php";
  $nom = "nom";
  $nom = addslashes($_POST[$nom]);
  $id_cliente = addslashes($_POST["idcliente"]);
  if (!empty($nom)) {
  $apep = "apep";
  $apep = addslashes($_POST[$apep]);

  $apem = "apem";
  $apem = addslashes($_POST[$apem]);

  $usuario = "usuario";
  $usuario = addslashes($_POST[$usuario]);

  $contra = "contra";
  $contra = addslashes($_POST[$contra]);

  $departamento = "departamento";
  $departamento = addslashes($_POST[$departamento]);

  $fecha = date("Y-m-d");
  $hora = date("H:i:s");



  mysqli_query($con, "INSERT INTO Usuarios_APP (Nombre, AppelidoP, AppelidoM, Departamento, Usuario, Pass, fecha_alta, hora_alta, id_cliente) VALUES ('$nom', '$apep', '$apem', '$departamento', '$usuario', '$contra', '$fecha', '$hora', '$id_cliente')");
  echo 1;

  } else {
    echo 0;
  }

?>
<?php
mysqli_close($con);
?>
