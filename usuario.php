<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}
?>

    <?php
    $id = addslashes($_GET["id"]);
    $busca = mysqli_query($con, "SELECT * FROM personas WHERE id_cliente = '$id_cliente' AND id = '$id' LIMIT 1");
    while ($result = mysqli_fetch_assoc($busca)) {
      $jsondata = array();
      $jsondata['nombre'] = $result["nombre"];
      $jsondata['colonia'] = $result["colonia"];
      $jsondata['calle'] = $result["calle"];
      $jsondata['numero'] = $result["numero"];
      $jsondata['telefono'] = $result["telefono"];
      $jsondata['correo'] = $result["correo"];
      $jsondata['id'] = $result["id"];
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);

    }
    ?>

<?php
mysqli_close($con);
?>
