
<?php
$to = "hdeleonleal@gmail.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>Muchas gracias por tu reporte tu petición está siendo atendida</title>
</head>
<body>
<p>Datos del reporte</p>
<table>
<tr>
<th'. $reporte .'</th>

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
$headers .= 'From: <be-smrt@wms.com.mx>' . "\r\n";

if (mail($to,$subject,$message,$headers)) {
  echo "correcto";
} else {
  echo "error";
}
?>
