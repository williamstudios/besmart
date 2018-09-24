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
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php
    $busca = mysqli_query($con, "SELECT * FROM evidencias WHERE id_peticion = '$id'");
    $cont = 0;
    while ($result = mysqli_fetch_assoc($busca)) {
      echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $cont .'"></li>';
      $cont++;
    }

    ?>
  </ol>
  <div class="carousel-inner">
    <?php
    $busca = mysqli_query($con, "SELECT * FROM evidencias WHERE id_peticion = '$id'");
    $cont = 0;
    while ($result = mysqli_fetch_assoc($busca)) {
      echo '<div class="carousel-item">
        <img class="d-block w-100" src="sincapp/fotos' . $result["ruta"] .'" alt="">
      </div>';
      $cont++;
    }

    ?>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php
if ($cont == 0) {
  echo "No hay imágenes que mostrar";
}
?>
<?php
mysqli_close($con);
?>
