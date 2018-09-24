<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}
?>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>id</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Colonia</th>
      <th>Calle</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Estatus</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $nombres = addslashes($_GET["nombre"]);
    $colonia = addslashes($_GET["colonia"]);
    $calle = addslashes($_GET["calle"]);
    if (!empty($nombres)) {
      $busca = mysqli_query($con, "SELECT * FROM peticiones WHERE id_cliente = '$id_cliente' AND nombre LIKE '%$nombres%' ORDER BY fecha_crea DESC LIMIT 5");
    } elseif (!empty($colonia)) {
      $busca = mysqli_query($con, "SELECT * FROM peticiones WHERE id_cliente = '$id_cliente' AND colonia LIKE '%$colonia%' ORDER BY fecha_crea DESC LIMIT 5");
    } elseif (!empty($calle)) {
      $busca = mysqli_query($con, "SELECT * FROM peticiones WHERE id_cliente = '$id_cliente' AND calle LIKE '%$calle%' ORDER BY fecha_crea DESC LIMIT 5");
    }
    while ($result = mysqli_fetch_assoc($busca)) {
      if ($result["status"] == 1) {
        $stat = '<span class="badge badge-primary">Pendiente</span>';
      } elseif ($result["status"] == 2) {
        $stat = '<span class="badge badge-success">Asignado</span>';
      } elseif ($result["status"] == 3) {
        $stat = '<span class="badge badge-light">Terminado</span>';
      } elseif ($result["status"] == 4) {
        $stat = '<span class="badge badge-info">Trabajando</span>';
      } elseif ($result["status"] == 5) {
        $stat = '<span class="badge badge-danger">No Trabajado</span>';
      }
      echo '<tr>
       <td><a href="#"  data-toggle="modal" data-target="#largeModal2" onclick="buscando2('. $result["id"] .')">' . $result["id"] .'</a></td>
       <td><a href="#"  data-toggle="modal" data-target="#largeModal2" onclick="buscando2('. $result["id"] .')">' . $result["nombre"] .'</a></td>
       <td><a href="#"  data-toggle="modal" data-target="#largeModal2" onclick="buscando2('. $result["id"] .')">' . $result["Descripcion"] .'</a></td>
       <td>' . $result["colonia"] .'</td>
       <td>' . $result["calle"] .'</td>
       <td>' . $result["fecha_crea"] .'</td>
       <td>' . $result["hora_crea"] .'</td>
       <td>' . $stat .'</td>

      </tr>';
    }
    ?>
  </tbody>
</table>

<?php
mysqli_close($con);
?>
