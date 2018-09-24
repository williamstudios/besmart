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

  $falla = "falla";
  $falla = addslashes($_POST[$falla]);

  $reporte = "reporte";
  $reporte = addslashes($_POST[$reporte]);

  $repetido = "repetido";
  $repetido = addslashes($_POST[$repetido]);

  $fecha = date("Y-m-d");
  $hora = date("H:i:s");

  $correo = "correo";
  $correo = addslashes($_POST[$correo]);

  $asignado = addslashes($_POST["asignado"]);

  $peticion = addslashes($_POST["peticion"]);
  $programar = addslashes($_POST["programar"]);
  $dateprogram = addslashes($_POST["dateprogram"]);

  if ($programar == 1) {
    if ($dateprogram == "lumesmiercolesviernes") {
      mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, usuario_asignado, departamento_asignado, status, dia) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$falla', '$asignado', '$departamento', 2, 'Lunes')");
      mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, usuario_asignado, departamento_asignado, status, dia) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$falla', '$asignado', '$departamento', 2, 'Miercoles')");
      mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, usuario_asignado, departamento_asignado, status, dia) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$falla', '$asignado', '$departamento', 2, 'Viernes')");

    } elseif ($dateprogram == "martesjueves") {
      mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, usuario_asignado, departamento_asignado, status, dia) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$falla', '$asignado', '$departamento', 2, 'Martes')");
      mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, usuario_asignado, departamento_asignado, status, dia) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$falla', '$asignado', '$departamento', 2, 'Jueves')");
    } else {
      mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, usuario_asignado, departamento_asignado, status, dia) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$falla', '$asignado', '$departamento', 2, '$dateprogram')");
    }
  }

  mysqli_query($con, "UPDATE peticiones SET nombre = '$nom', colonia = '$Colonia', correo = '$correo', calle = '$calle', numero = '$numero', telefono = '$telefono', Descripcion = '$reporte', id_cliente = '$id_cliente', usuario_crea = '$usuario', fecha_crea = '$fecha', hora_crea = '$hora', falla = '$falla', usuario_asignado = '$asignado', departamento_asignado = '$departamento', status = 2 WHERE id_cliente = '$id_cliente' AND id = '$peticion'");

  $bcorreo = mysqli_query($con, "SELECT correo FROM Usuarios_APP WHERE id = '$asignado'");
  while ($rcorreo = mysqli_fetch_assoc($bcorreo)) {
   $to =  $rcorreo["correo"];
   $subject = "Nueva solicitud por atender";

   $message = "
   <html>
   <head>
   <title>Se llevó a cabo el registro de una nueva petición</title>
   </head>
   <body>
   <table style='width:100%; height:600px;'>
   <tr align='center'>
   <td height:50px; color:#191970' align='center'>
   <img src='http://besmart.dovesolutions.com.mx/logo.png' alt='' style='width:350px'>
   <h3 style='margin-top:15px;'>Se llevó a cabo el registro de una nueva petición</h3>
   </td>
   <br>
   </tr>
   <tr align='center'>
   <td align='center'>
    Numero de petición: " . $peticion . "
   <br>
   <br>
    Detalles: " . $reporte . "
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
  }
  $contando = 0;
  while (1 == 1) {
    $articulo = "art" . $contando;
    $articulo = addslashes($_POST[$articulo]);
    if (!empty($articulo)) {
      $cconcepto = "cconcepto" . $contando;
      $cconcepto = addslashes($_POST[$cconcepto]);
      mysqli_query($con, "INSERT INTO conceptos (id_con, cantidad, id_cliente, id_peticion) VALUES ('$articulo', '$cconcepto', '$id_cliente', '$peticion')");
    }

    $cuadril = "cuadril" . $contando;
    $cuadril = addslashes($_POST[$cuadril]);
    if (!empty($cuadril)) {

      mysqli_query($con, "INSERT INTO cuadrillas (id_cuad, id_cliente, id_peticion) values ('$cuadril', '$id_cliente', '$peticion')");
    }

    $vehi = "vehi" . $contando;
    $vehi = addslashes($_POST[$vehi]);
    if (!empty($vehi)) {
      $km = "km" . $contando;
      $km = addslashes($_POST[$km]);
      $costo = "costo" . $contando;
      $costo = addslashes($_POST[$costo]);
      mysqli_query($con, "INSERT INTO kilometrajes (id_auto, km	, costo, id_cliente, id_peticion) VALUES ('$vehi', '$km', '$costo', '$id_cliente', '$peticion')");
    }
    $contando++;
    if ($contando == 100) {
      break;
    }

  }

  header ("location: menu.php?r=correcto");

  } else {
    header ("location: menu.php");
  }

?>
<?php
mysqli_close($con);
?>
