<?php
include_once"conect.php";
session_start();
$user = addslashes($_POST["usuario"]);
$pass = addslashes($_POST["pass"]);

if (!empty($user)) {
  if (!empty($pass)) {
    $buscar = mysqli_query($con, "SELECT * FROM Usuarios_APP WHERE Usuario = '$user' AND Pass = '$pass'");
    $result = mysqli_fetch_assoc($buscar);
    if ($result["Pass"] == $pass) {
      $jsondata = array();
      $jsondata['error'] = 1;
      $jsondata['idcliente'] = $result["id_cliente"];
      $jsondata['usuarioID'] = $result["id"];
      $jsondata['Departamento'] = $result["id_cliente"];
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    } else {
      $jsondata = array();
      $jsondata['error'] = 2;
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    }
  } else {
    $jsondata = array();
    $jsondata['error'] = 2;
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
  }

} else {
  $jsondata = array();
  $jsondata['error'] = 2;
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata);
}

mysqli_close($con);
?>
