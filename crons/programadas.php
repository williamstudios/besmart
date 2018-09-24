#!/usr/local/bin/ea-php56
<?php
date_default_timezone_set("America/Mexico_City");
header('Access-Control-Allow-Origin: *');
include_once"conect.php";

?>
<?php
$fecha = date("Y-m-d");
$dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$dia = $dias[date('w', strtotime($fecha))];

$busca = mysqli_query($con, "SELECT * FROM programadas WHERE dia = '$dia' OR dia = 'todos'");
while ($result = mysqli_fetch_assoc($busca)) {
 $nombre = $result["nombre"];
 $colonia = $result["colonia"];
 $correo = $result["correo"];
 $calle = $result["calle"];
 $numero = $result["numero"];
 $telefono = $result["telefono"];
 $Descripcion = $result["Descripcion"];
 $id_cliente = $result["id_cliente"];
 $usuario_crea = $result["usuario_crea"];
 $fecha_crea = $result["fecha_crea"];
 $hora_crea = $result["hora_crea"];
 $falla = $result["falla"];
 $departamento_asignado = $result["departamento_asignado"];
 $status = $result["status"];
 $main_dep = $result["main_dep"];
 $dia = $result["dia"];
 $usuario_asignado = $result["usuario_asignado"];
 mysqli_query($con, "INSERT INTO peticiones (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, usuario_asignado, falla, departamento_asignado, status, main_dep) VALUES ('$nombre', '$colonia', '$correo', '$calle', '$numero', '$telefono', '$Descripcion', '$id_cliente', '$usuario_crea', '$fecha_crea', '$hora_crea', '$usuario_asignado', '$falla', '$departamento_asignado', '$status', '$main_dep')");
 $ultimo = mysqli_insert_id($con);

 if (!empty($correo)) {
 $to = $correo;
 $subject = "Recibimos tu solicitud";

 $message = "
 <html>
 <head>
 <title>Muchas gracias por tu reporte tu petición está siendo atendida</title>
 </head>
 <body>
 <table style='width:100%; height:600px;'>
 <tr align='center'>
 <td height:50px; color:#191970' align='center'>
 <img src='http://besmart.dovesolutions.com.mx/logo.png' alt='' style='width:350px'>
 <h3 style='margin-top:15px;'>Muchas gracias por tu reporte tu petición está siendo atendida</h3>
 </td>
 <br>
 </tr>
 <tr align='center'>
 <td align='center'>Detalles del reporte: " . $Descripcion . "
 <br>
 <br>
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

   mail($to,$subject,$message,$headers);
   echo "correcto";

 }
}
?>
<?php
mysqli_close($con);
?>
