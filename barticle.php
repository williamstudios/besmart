<?php
include_once"conect.php";
session_start();
$id = addslashes($_GET["id"]);
$q = addslashes($_GET["q"]);
if (!empty($q)) {
  $busca = mysqli_query($con, "SELECT * FROM Articulos WHERE Nombre LIKE '%$q%'");

  while ($result = mysqli_fetch_assoc($busca)) {
    header('Content-type: application/json; charset=utf-8');
    $data[] = array('id' => $result["id"], 'text' => $result["Nombre"]);
  }
  echo json_encode($data);
} elseif (!empty($id)) {


  $busca = mysqli_query($con, "SELECT * FROM Articulos WHERE id = '$id'");
  $result = mysqli_fetch_assoc($busca);

  $jsondata = array();
  $jsondata['namea'] = $result["Nombre"];
  $jsondata['idart'] = $result["id"];
  $jsondata['price'] = $result["costo"];
  $jsondata['parte'] = $result["parte"];
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata);
}

?>
