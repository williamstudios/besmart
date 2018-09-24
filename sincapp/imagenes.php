<?php
include_once"../conect.php";
$nombre_archivo =$_FILES['file']['name'];
$tipo_archivo = $_FILES['file']['type'];
$tamano_archivo = $_FILES['file']['size'];
$archivo= $_FILES['file']['tmp_name'];
$id = addslashes($_POST["id"]);


$target_path = "fotos/";
$target_path = $target_path . basename( $_FILES['file']['name']);
$ruta = basename( $_FILES['file']['name']);
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) { echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido";
mysqli_query($con, "INSERT INTO evidencias (ruta, id_peticion) VALUES ('$ruta', '$id')");
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}

?>
