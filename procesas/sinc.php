<?php
header('Access-Control-Allow-Origin: *');
include_once"../conect.php";
session_start();
?>
<?php
  $id = addslashes($_GET["id"]);
  $usuarioa = addslashes($_GET["usuario"]);
  $idcliente = addslashes($_GET["idcliente"]);
  $Departamento = addslashes($_GET["Departamento"]);
  echo $idcliente . ' ' . $Departamento;
  $busca = mysqli_query($con, "SELECT * FROM peticiones WHERE usuario_asignado = '$usuarioa' AND id > '$id' ORDER BY id DESC");
  $contador = 0;
  $si = 0;
?>
<script type="text/javascript">
$( document ).ready(function() {
  var db = openDatabase('mydb', '1.0', 'usuarios', 2 * 1024 * 1024);
  db.transaction(function (tx) {

   tx.executeSql('INSERT INTO pets (peticion, nombre, colonia, correo, calle, numero, telefono, Descripcion, id_cliente, usuario_crea, fecha_crea, hora_crea, usuario_asignado, departamento_asignado, falla, status, fecha_cierre, hora_cierre, actualizado) VALUES <?php while ($result = mysqli_fetch_assoc($busca)) {
      if ($contador == 0) {
        $contador++;
      } else {
        echo ",";
        $contador++;
      }
      echo ' (' . $result["id"] . ', "' . $result["nombre"] . '", "' . $result["colonia"] . '", "' . $result["correo"] . '", "' . $result["calle"] . '", "' . $result["numero"] . '", "' . $result["telefono"] . '", "' . $result["Descripcion"] . '", "' . $result["id_cliente"] . '", "' . $result["usuario_crea"] . '", "' . $result["fecha_crea"] . '", "' . $result["hora_crea"] . '", "' . $result["usuario_asignado"] . '", "' . $result["departamento_asignado"] . '", "' . $result["falla"] . '", "' . $result["status"] . '", "' . $result["fecha_cierre"] . '", "' . $result["hora_cierre"] . '", "0")'; } ?>');
  });
  <?php
  if ($contador > 0) {
    echo "
    cordova.plugins.notification.local.requestPermission(function (granted) {
      alert('permiso para notificacion');
    });
    cordova.plugins.notification.local.hasPermission(function (granted) {
    });
    cordova.plugins.notification.local.schedule({
    title: 'Be-smart',
    text: 'Tienes nuevas peticiones pendientes'
    });";
  }
  ?>
});
</script>



<?php

  $busca = mysqli_query($con, "SELECT * FROM Articulos WHERE id_cliente = '$idcliente' AND Departamento = '$Departamento'");
  $contador = 0;
?>
<script type="text/javascript">
$( document ).ready(function() {
  var db = openDatabase('mydb', '1.0', 'usuarios', 2 * 1024 * 1024);
  db.transaction(function (tx) {
    tx.executeSql('DELETE FROM Articulos');
   tx.executeSql('INSERT INTO Articulos (Articuloid, Nombre, stock, costo, almacen, id_cliente, actualizado) VALUES <?php while ($result = mysqli_fetch_assoc($busca)) {
      if ($contador == 0) {
        $contador++;
      } else {
        echo ",";
        $contador++;
      }
      echo ' ("' . $result["id"] . '", "' . $result["Nombre"] . '", "' . $result["stock"] . '", "' . $result["costo"] . '", "' . $result["almacen"] . '", "' . $result["id_cliente"] . '",  "0")'; } ?>');
  });
});
</script>

<?php

  $busca = mysqli_query($con, "SELECT * FROM Departamentos WHERE id_cliente = '$idcliente'");
  $contador = 0;
?>
<script type="text/javascript">
$( document ).ready(function() {
  var db = openDatabase('mydb', '1.0', 'usuarios', 2 * 1024 * 1024);
  db.transaction(function (tx) {
    tx.executeSql('DELETE FROM Departamentos');
   tx.executeSql('INSERT INTO Departamentos (Departamentoid, Nombre, Encargado, id_cliente, actualizado) VALUES <?php while ($result = mysqli_fetch_assoc($busca)) {
      if ($contador == 0) {
        $contador++;
      } else {
        echo ",";
        $contador++;
      }
      echo ' ("' . $result["id"] . '", "' . $result["Nombre"] . '", "' . $result["Encargado"] . '", "' . $result["id_cliente"] . '", "0")'; } ?>');
  });
});
</script>

<?php

  $busca = mysqli_query($con, "SELECT * FROM Autos WHERE id_cliente = '$idcliente' AND departamento = '$Departamento'");
  $contador = 0;
?>
<script type="text/javascript">
$( document ).ready(function() {
  var db = openDatabase('mydb', '1.0', 'usuarios', 2 * 1024 * 1024);
  db.transaction(function (tx) {
    tx.executeSql('DELETE FROM Autos');
   tx.executeSql('INSERT INTO Autos (Autoid, Nombre, departamento, id_cliente) VALUES <?php while ($result = mysqli_fetch_assoc($busca)) {
      if ($contador == 0) {
        $contador++;
      } else {
        echo ",";
        $contador++;
      }
      echo ' ("' . $result["id"] . '", "' . $result["Nombre"] . '", "' . $result["departamento"] . '", "' . $result["id_cliente"] . '")'; } ?>');
  });
});
</script>

<?php

  $busca = mysqli_query($con, "SELECT * FROM Fallas WHERE id_cliente = '$idcliente'");
  $contador = 0;
?>
<script type="text/javascript">
$( document ).ready(function() {
  var db = openDatabase('mydb', '1.0', 'usuarios', 2 * 1024 * 1024);
  db.transaction(function (tx) {
    tx.executeSql('DELETE FROM Fallas');
   tx.executeSql('INSERT INTO Fallas (Fallaid, Nombre,id_cliente) VALUES <?php while ($result = mysqli_fetch_assoc($busca)) {
      if ($contador == 0) {
        $contador++;
      } else {
        echo ",";
        $contador++;
      }
      echo ' ("' . $result["id"] . '", "' . $result["NombreNombre"] . '", "' . $result["id_cliente"] . '")'; } ?>');
  });
});
</script>

<?php

  $busca = mysqli_query($con, "SELECT * FROM empleados WHERE id_cliente = '$idcliente' AND Departamento = '$Departamento'");
  $contador = 0;
?>
<script type="text/javascript">
$( document ).ready(function() {
  var db = openDatabase('mydb', '1.0', 'usuarios', 2 * 1024 * 1024);
  db.transaction(function (tx) {
    tx.executeSql('DELETE FROM cuadrilla');
   tx.executeSql('INSERT INTO cuadrilla (Cuadrillaid, Nombre, id_cliente) VALUES <?php while ($result = mysqli_fetch_assoc($busca)) {
      if ($contador == 0) {
        $contador++;
      } else {
        echo ",";
        $contador++;
      }
      echo ' ("' . $result["id"] . '", "' . $result["Nombre"] . '  ' . $result["AppelidoP"] . ' ' . $result["AppelidoM"] . '", "' . $result["id_cliente"] . '")'; } ?>');
  });
});
</script>



<?php
mysqli_close($con);
?>
