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
  $Colonia = "Colonia";
  $Colonia = addslashes($_POST[$Colonia]);

  $calle = "calle";
  $calle = addslashes($_POST[$calle]);

  $numero = "numero";
  $numero = addslashes($_POST[$numero]);

  $telefono = "telefono";
  $telefono = addslashes($_POST[$telefono]);

  $departamento = "departamento";
  $departamento = addslashes($_POST[$departamento]);

  $usuarioa = "usuario";
  $usuarioa = addslashes($_POST[$usuarioa]);

  $reporte = "reporte";
  $reporte = addslashes($_POST[$reporte]);

  $repetido = "repetido";
  $repetido = addslashes($_POST[$repetido]);

  $fecha = date("Y-m-d");
  $hora = date("H:i:s");

  $status = 0;
  if (!empty($usuarioa)) {
   $status = 1;
  }

  $correo = "correo";
  $correo = addslashes($_POST[$correo]);

  if (!empty($repetido)) {
    mysqli_query($con, "UPDATE personas SET nombre = '$nom', colonia = '$Colonia', calle = '$calle', numero = '$numero', telefono = '$telefono', correo = '$correo', id_cliente = '$id_cliente' WHERE id = '$repetido'");
  } else {
    mysqli_query($con, "INSERT INTO personas (nombre, colonia, calle, numero, telefono, correo, id_cliente) VALUES ('$nom', '$Colonia', '$calle', '$numero', '$telefono', '$correo', '$id_cliente')");
  }
  mysqli_query($con, "INSERT INTO peticiones (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, departamento_asignado, status) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$usuarioa', '$departamento', 1)");


  } else {
    header ("location: menu.php");
  }

?>
<?php
echo $correo;
if (!empty($correo)) {
$to = $correo;
$subject = "Recibimos tu solicitud";

$message = "
<html>
<head>
<title>Muchas gracias por tu reporte tu petición está siendo atendida</title>
</head>
<body>
<p>Datos del reporte</p>
<table>
<tr>
<td>" . $reporte . "</td>

</tr>
<tr>
<td></td>
<td>Por favor no respondas este mensaje</td>
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
  header ("location: menu.php?r=correcto");
} else {
  echo "error";
  header ("location: menu.php?r=correcto");
}

} else {
  header ("location: menu.php?r=correcto");
}

?>
<?php
mysqli_close($con);
?>
