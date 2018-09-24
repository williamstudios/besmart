<?php
date_default_timezone_set("America/Mexico_City");
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

  $departamento = "maindepartamento";
  $departamento = addslashes($_POST[$departamento]);

  $usuarioa = "usuario";
  $usuarioa = addslashes($_POST[$usuarioa]);

  $reporte = "reporte";
  $reporte = addslashes($_POST[$reporte]);

  $repetido = "repetido";
  $repetido = addslashes($_POST[$repetido]);

  $main_dep = "departamento";
  $main_dep = addslashes($_POST[$main_dep]);

  $fecha = date("Y-m-d");
  $hora = date("H:i:s");

  $status = 0;
  if (!empty($usuarioa)) {
   $status = 1;
  }

  $correo = "correo";
  $correo = addslashes($_POST[$correo]);

  $metodo = "metodo";
  $metodo = addslashes($_POST[$metodo]);

  if (!empty($repetido)) {
    mysqli_query($con, "UPDATE personas SET nombre = '$nom', colonia = '$Colonia', calle = '$calle', numero = '$numero', telefono = '$telefono', correo = '$correo', id_cliente = '$id_cliente' WHERE id = '$repetido'");
  } else {
    mysqli_query($con, "INSERT INTO personas (nombre, colonia, calle, numero, telefono, correo, id_cliente) VALUES ('$nom', '$Colonia', '$calle', '$numero', '$telefono', '$correo', '$id_cliente')");
  }

  $programar = addslashes($_POST["programar"]);
  if ($programar == 1) {
    $hoy = addslashes($_POST["hoy"]);
    if ($hoy == 1) {
      mysqli_query($con, "INSERT INTO peticiones (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, departamento_asignado, status, main_dep, metodo) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$usuarioa', '$departamento', 1, '$main_dep', '$metodo')");
      $ultimo = mysqli_insert_id($con);


      $dateprogram = addslashes($_POST["dateprogram"]);
      $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
      $dia = $dias[date('w', strtotime($fecha))];

      mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, departamento_asignado, status, main_dep, dia, creado) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$usuarioa', '$departamento', 1, '$main_dep', '$dateprogram', '$dia')");
      $ultimo = mysqli_insert_id($con);

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
      <table style='width:100%; height:600px;'>
      <tr align='center'>
      <td height:50px; color:#191970' align='center'>
      <img src='http://besmart.dovesolutions.com.mx/logo.png' alt='' style='width:350px'>
      <h3 style='margin-top:15px;'>Muchas gracias por tu reporte tu petición está siendo atendida</h3>
      </td>
      <br>
      </tr>
      <tr align='center'>
      <td align='center'>Detalles del reporte: " . $reporte . "
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
    } else {
        $dateprogram = addslashes($_POST["dateprogram"]);
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $dia = $dias[date('w', strtotime($fecha))];

        mysqli_query($con, "INSERT INTO programadas (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, departamento_asignado, status, main_dep, dia, creado) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$usuarioa', '$departamento', 1, '$main_dep', '$dateprogram', '$dia')");
        $ultimo = mysqli_insert_id($con);
        header ("location: menu.php?r=correcto");
    }


  } else {
    mysqli_query($con, "INSERT INTO peticiones (nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, falla, departamento_asignado, status, main_dep, metodo) VALUES ('$nom', '$Colonia', '$correo', '$calle', '$numero', '$telefono', '$reporte', '$id_cliente', '$usuario', '$fecha', '$hora', '$usuarioa', '$departamento', 1, '$main_dep', '$metodo')");
    $ultimo = mysqli_insert_id($con);
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
    <table style='width:100%; height:600px;'>
    <tr align='center'>
    <td height:50px; color:#191970' align='center'>
    <img src='http://besmart.dovesolutions.com.mx/logo.png' alt='' style='width:350px'>
    <h3 style='margin-top:15px;'>Muchas gracias por tu reporte tu petición está siendo atendida</h3>
    </td>
    <br>
    </tr>
    <tr align='center'>
    <td align='center'>Detalles del reporte: " . $reporte . "
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
  }


  } else {
    header ("location: menu.php");
  }

?>
<?php

foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {

			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			$directorio = 'hjhjhhvhgvgh666656565sasd/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
      $tipo_archivo = $_FILES["archivo"]["type"][$key];

      $allowed_types = array ( 'application/pdf', 'image/jpeg', 'image/png', 'application/msword', 'application/vnd.ms-excel');
      $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
      $detected_type = finfo_file( $fileInfo, $source);
      if ( !in_array($detected_type, $allowed_types) ) {
        if (!((strpos($tipo_archivo, "docx") || strpos($tipo_archivo, "xlsx")))) {
                  /*se indica que la ext o el tamaño no son correctos*/
          }else{
            //Validamos si la ruta de destino existe, en caso de no existir la creamos
           if(!file_exists($directorio)){
             mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
           }
              $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
              $result = '';
              for ($i = 0; $i < 15; $i++){
                $result .= $characters[mt_rand(0, 61)];
              }
              $filename = $result . $filename;
           $dir=opendir($directorio); //Abrimos el directorio de destino
           $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo

           //Movemos y validamos que el archivo se haya cargado correctamente
           //El primer campo es el origen y el segundo el destino
           if(move_uploaded_file($source, $target_path)) {
              mysqli_query($con, "INSERT INTO archivos (ruta, id_peticion) VALUES ('$target_path', '$ultimo')");
             echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
             } else {
             echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
             }
          }
      } else {

			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
			}
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for ($i = 0; $i < 15; $i++){
          $result .= $characters[mt_rand(0, 61)];
        }
        $filename = $result . $filename;
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo

			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {
        mysqli_query($con, "INSERT INTO archivos (ruta, id_peticion) VALUES ('$target_path', '$ultimo')");
				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			  }
      }
			closedir($dir); //Cerramos el directorio de destino
      finfo_close( $fileInfo );
		}
	}



?>
<?php
mysqli_close($con);
?>
