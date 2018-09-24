<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}
?>
<br><br>
<?php
$concepto = addslashes($_GET["concepto"]);
$tipo = addslashes($_GET["tipo"])
?>
<table id="tabla" class="tabla table table-striped table-bordered">
  <thead>
    <tr>
      <th>id</th>
      <th>Descripción</th>
      <th>Departamento</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Estatus</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($concepto == "Todos") {
      $busca = mysqli_query($con, "SELECT pet.*, depa.Nombre AS depar FROM peticiones AS pet INNER JOIN Departamentos AS depa ON pet.departamento_asignado = depa.id WHERE pet.id_cliente = '$id_cliente' ORDER BY pet.id DESC LIMIT 500");
    } else {
      if ($tipo == "todos") {
        $busca = mysqli_query($con, "SELECT pet.*, depa.Nombre AS depar FROM peticiones AS pet INNER JOIN Departamentos AS depa ON pet.departamento_asignado = depa.id WHERE pet.id_cliente = '$id_cliente' AND pet.falla = '$concepto' ORDER BY pet.id DESC LIMIT 500");
      } else {
        $busca = mysqli_query($con, "SELECT pet.*, depa.Nombre AS depar FROM peticiones AS pet INNER JOIN Departamentos AS depa ON pet.departamento_asignado = depa.id WHERE pet.id_cliente = '$id_cliente' AND pet.falla = '$concepto' AND pet.status = '$tipo' ORDER BY pet.id DESC LIMIT 500");
      }
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
      } elseif ($result["status"] ==5) {
        $stat = '<span class="badge badge-danger">Trabajando</span>';
      }
      echo '<tr>
       <td>' . $result["id"] .'</td>
       <td>' . $result["Descripcion"] .'</td>
       <td>' . $result["depar"] .'</td>
       <td>' . $result["fecha_crea"] .'</td>
       <td>' . $result["hora_crea"] .'</td>
       <td>' . $stat .'</td>
       <td> <button type="button" name="button" class="btn btn-rimary" data-toggle="modal" data-target="#fotosmodal" onclick="buscandof('. $result["id"] .')"><i class="fa fa-camera" aria-hidden="true"></i></button> </td>
       <td> <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#largeModal2" onclick="buscando2('. $result["id"] .')"><i class="fa fa-eye" aria-hidden="true"></i></button> </td>
      </tr>';
    }
    ?>
  </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
      $('.tabla').DataTable( {

          dom: 'Bfrtip',
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
          ],  language: {
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
              "infoFiltered": "(Filtrado de _MAX_ total entradas)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ Entradas",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
          }
      });
    });
</script>

<?php
mysqli_close($con);
?>
