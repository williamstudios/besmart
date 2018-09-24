<?php
include_once"conect.php";
session_start();

if (!empty($_SESSION["user"])) {
  header ("location: menu.php");
}
?>
<?php
$correo = addslashes($_POST["Correo"]);


$busca = mysqli_query($con, "SELECT * FROM Usuarios_APP WHERE correo = '$correo'");
$result = mysqli_fetch_assoc($busca);

if ($correo == $result["correo"]) {
$to = $correo;
$subject = "Bienvenid@";

$message = "
<html>
<head>
<title>Te enviamos tus datos para acceder al sistema</title>
</head>
<body>
<table style='width:100%; height:600px;'>
<tr align='center'>
<td height:50px; color:#191970' align='center'>
<img src='http://besmart.dovesolutions.com.mx/logo.png' alt='' style='width:350px'>
<h3 style='margin-top:15px;'>Te enviamos tus datos para acceder al sistema</h3>
</td>
<br>
</tr>
<tr align='center'>
<td align='center'>Usuario: " . $result["Usuario"] . "
<br>
<br>
Contraseña: " . $result["Pass"] . "</td>
</tr>
<tr style='background-color:#FFAA00;' align='center'>
<td style='background-color:#FFAA00; color:white' align='center'>Este correo electrónico contiene información legal confidencial y privilegiada. Si Usted no es el destinatario a quien se desea enviar este mensaje, tendrá prohibido darlo a conocer a persona alguna, así como a reproducirlo o copiarlo. Si recibe este mensaje por error, favor de notificarlo al correo wmsdemexico@gmail.com de inmediato y desecharlo de su sistema
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
  header ("location: index.php?r=bmail");
} else {
  echo "error";
  header ("location: index.php?r=failmail");
}

} else {
  header ("location: index.php?r=errmail");
}

?>
<?php
mysqli_close($con);
?>
