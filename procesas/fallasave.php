<?php
include_once"../conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}

if (!empty($_SESSION["admin"])) {
  $usuario = $_SESSION["admin"];
} else {
  $usuario = $_SESSION["usuario"];
}
?>
<?php

  $nom = "nom";
  $nom = addslashes($_POST[$nom]);

  if (!empty($nom)) {

  $depar = addslashes($_POST["departamento"]);
  mysqli_query($con, "INSERT INTO Fallas (NombreNombre, id_cliente, id_departamento) VALUES ('$nom', '$id_cliente', '$depar')");
  $ultimo = mysqli_insert_id($con);

    echo '<select class="form-control " name="usuario" required>
      <option value="">Seleccionar</option>';

      $depas = mysqli_query($con, "SELECT id, NombreNombre, id_departamento FROM Fallas WHERE id_cliente = '$id_cliente' ORDER BY NombreNombre ASC");
      while ($rdepas = mysqli_fetch_assoc($depas)) {
        echo '<option value="' . $rdepas["id"] .'" class="dep' . $rdepas["id_departamento"] .' fallas" style="display:none;"';
        if ($rdepas["id"] == $ultimo) {
          echo 'selected';
        }

        echo '>' . $rdepas["NombreNombre"] .'</option>';
      }

    echo '</select>
    <script type="text/javascript">
      function ocultar(valor) {

        $(".fallas").hide();
        $(".dep" + valor).show();
      }
    </script>';
  } else {
    echo '<select class="form-control " name="usuario" required>
      <option value="">Seleccionar</option>';

      $depas = mysqli_query($con, "SELECT id, NombreNombre, id_departamento FROM Fallas WHERE id_cliente = '$id_cliente' ORDER BY NombreNombre ASC");
      while ($rdepas = mysqli_fetch_assoc($depas)) {
        echo '<option value="' . $rdepas["id"] .'" class="dep' . $rdepas["id_departamento"] .' fallas" style="display:none;">' . $rdepas["NombreNombre"] .'</option>';
      }

    echo '</select>
    <script type="text/javascript">
      function ocultar(valor) {

        $(".fallas").hide();
        $(".dep" + valor).show();
      }
    </script>';
  }

?>
<?php
mysqli_close($con);
?>
