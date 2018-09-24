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
include_once"conect.php";

  $id = addslashes($_GET["id"]);
  if (!empty($id)) {

    if (!empty($_SESSION["admin"])) {
      mysqli_query($con, "DELETE FROM peticiones WHERE id = '$id' AND id_cliente = '$id_cliente'");
      header ("location: menu.php?r=correcto");
    } else {
      
        mysqli_query($con, "DELETE FROM peticiones WHERE id = '$id' AND id_cliente = '$id_cliente'");
        header ("location: menu.php?r=correcto");

    }


  } else {
    header ("location: menu.php");
  }

?>
<?php
mysqli_close($con);
?>
