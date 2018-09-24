<?php
include_once"conect.php";
session_start();
$user = addslashes($_POST["usuario"]);
$pass = addslashes($_POST["pass"]);
if (!empty($user)) {
  $buscar = mysqli_query($con, "SELECT * FROM Clientes WHERE user = '$user' AND pass = '$pass'");
  $result = mysqli_fetch_assoc($buscar);
  if ($result["pass"] == $pass) {
    $_SESSION["user"] = $result["id"];
    $_SESSION["admin"] = $result["id"];
    header("Location: menu.php");
  } else {
    $buscar2 = mysqli_query($con, "SELECT * FROM Usuarios_APP WHERE Usuario = '$user' AND Pass = '$pass'");
    $result2 = mysqli_fetch_assoc($buscar2);
    if ($result2["Pass"] == $pass) {
      $_SESSION["user"] = $result2["id_cliente"];
      $_SESSION["usuario"] = $result2["id"];
      header("Location: menu.php");
    }else {
      header("Location: index.php?status=error");
    }
  }
}
mysqli_close($con);
?>
