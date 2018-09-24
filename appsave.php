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

  $correo = "correo";
  $correo = addslashes($_POST[$correo]);

  $usuario = "usuario";
  $usuario = addslashes($_POST[$usuario]);

  $contra = "contra";
  $contra = addslashes($_POST[$contra]);

  $departamento = "departamento";
  $departamento = addslashes($_POST[$departamento]);

  $fecha = date("Y-m-d");
  $hora = date("H:i:s");



  mysqli_query($con, "INSERT INTO Usuarios_APP (Nombre, AppelidoP, AppelidoM, Departamento, correo, Usuario, Pass, fecha_alta, hora_alta, id_cliente) VALUES ('$nom', '$apep', '$apem', '$departamento', '$correo', '$usuario', '$contra', '$fecha', '$hora', '$id_cliente')");
  $ultimo = mysqli_insert_id($con);

  $usuarios = addslashes($_POST["usuarios"]);
  $peticion = addslashes($_POST["peticion"]);
  $catalogos = addslashes($_POST["catalogos"]);
  $reportes = addslashes($_POST["reportes"]);
  $finanzas = addslashes($_POST["finanzas"]);
  $inventarios = addslashes($_POST["inventarios"]);
  $ordenes = addslashes($_POST["ordenes"]);
  $tarjetas = addslashes($_POST["tarjetas"]);

  if ($usuarios == 1) {
    mysqli_query($con, "INSERT INTO menus_ligados (Departamento, id_usuario, id_cliente) VALUES (1, '$ultimo', '$id_cliente')");
  }
  if ($peticion == 1) {
    mysqli_query($con, "INSERT INTO menus_ligados (Departamento, id_usuario, id_cliente) VALUES (2, '$ultimo', '$id_cliente')");
  }
  if ($catalogos == 1) {
    mysqli_query($con, "INSERT INTO menus_ligados (Departamento, id_usuario, id_cliente) VALUES (3, '$ultimo', '$id_cliente')");
  }
  if ($reportes == 1) {
    mysqli_query($con, "INSERT INTO menus_ligados (Departamento, id_usuario, id_cliente) VALUES (4, '$ultimo', '$id_cliente')");
  }
  if ($finanzas == 1) {
    mysqli_query($con, "INSERT INTO menus_ligados (Departamento, id_usuario, id_cliente) VALUES (5, '$ultimo', '$id_cliente')");
  }
  if ($inventarios == 1) {
    mysqli_query($con, "INSERT INTO menus_ligados (Departamento, id_usuario, id_cliente) VALUES (6, '$ultimo', '$id_cliente')");
  }
  if ($ordenes == 1) {
    mysqli_query($con, "UPDATE Usuarios_APP SET auth = 1 WHERE id = '$ultimo'");
  }
  if ($tarjetas == 1) {
    mysqli_query($con, "INSERT INTO menus_ligados (Departamento, id_usuario, id_cliente) VALUES (7, '$ultimo', '$id_cliente')");
  }


  } else {
    header ("location: userapp.php");
  }

?>
<?php
if (!empty($correo)) {
$to = $correo;
$subject = "Bienvenid@";

$message = "
<html>
<head>
<title>Te enviamos tus datos para acceder al sistema</title>
</head>
<body>
<table style='width:100%; height:600px;'>
<tr style='background-color:#272c33; width:100%; color:white' align='center'>
<td style='background-color:#272c33; width:100%; height:50px; color:white' align='center'>
<h2 style='margin-top:15px;'>Te enviamos tus datos para acceder al sistema</h2>
</td>
<br>
</tr>
<tr align='center'>
<td align='center'>Usuario: " . $usuario . "
<br>
<br>
Contraseña: " . $contra . "</td>
</tr>
<tr style='background-color:#272c33;' align='center'>
<td style='background-color:#272c33; color:white' align='center'>Este correo electrónico contiene información legal confidencial y privilegiada. Si Usted no es el destinatario a quien se desea enviar este mensaje, tendrá prohibido darlo a conocer a persona alguna, así como a reproducirlo o copiarlo. Si recibe este mensaje por error, favor de notificarlo al correo wmsdemexico@gmail.com de inmediato y desecharlo de su sistema
</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <be-smart@wms.com.mx>' . "\r\n";

if (mail($to,$subject,$message,$headers)) {
  echo "correcto";
  header ("location: userapp.php?r=correcto");
} else {
  echo "error";
  header ("location: userapp.php?r=correcto");
}

} else {
  header ("location: userapp.php?r=correcto");
}

?>
<?php
mysqli_close($con);
?>
