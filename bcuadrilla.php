<?php
include_once"conect.php";
session_start();
$id = addslashes($_GET["id"]);
$q = addslashes($_GET["q"]);
if (!empty($q)) {
  $busca = mysqli_query($con, "SELECT id, CONCAT(Nombre, ' ', AppelidoP, ' ', AppelidoM) AS completo FROM empleados WHERE Nombre LIKE '%$q%' OR  AppelidoP LIKE '%$q%' OR  AppelidoM LIKE '%$q%'");
  while ($result = mysqli_fetch_assoc($busca)) {
    header('Content-type: application/json; charset=utf-8');
    $data[] = array('id' => $result["id"], 'text' => $result["completo"]);
  }
  echo json_encode($data);
}

?>
