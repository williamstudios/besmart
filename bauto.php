<?php
include_once"conect.php";
session_start();
$id = addslashes($_GET["id"]);
$q = addslashes($_GET["q"]);
if (!empty($q)) {
  $busca = mysqli_query($con, "SELECT * FROM Autos WHERE Nombre LIKE '%$q%'");
  while ($result = mysqli_fetch_assoc($busca)) {
    header('Content-type: application/json; charset=utf-8');
    $data[] = array('id' => $result["id"], 'text' => $result["Nombre"]);
  }
  echo json_encode($data);
}

?>
