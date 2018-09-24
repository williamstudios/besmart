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
  $buscarp = mysqli_query($con, "SELECT * FROM peticiones WHERE id_cliente = '$id_cliente' AND id = '$id'");
  $rbusca = mysqli_fetch_assoc($buscarp);
  ?>


    <?php
    $busca = mysqli_query($con, "SELECT * FROM evidencias WHERE id_peticion = '$id'");
    $cont = 0;
    while ($result = mysqli_fetch_assoc($busca)) {
      if ($cont == 0) {
        $active = "active";
      } else {
        $active = "";
      }
      echo '<div class="carousel-item ' . $active . '">
        <img class="d-block w-100" src="sincapp/fotos/' . $result["ruta"] .'" style="width:100%;">
      </div>';
      $cont++;
    }

    ?>


<?php
if ($cont == 0) {
  echo "No hay imágenes que mostrar";
}
?>
<?php
mysqli_close($con);
?>
