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
    $nombres = addslashes($_GET["nombre"]);
    $busca = mysqli_query($con, "SELECT id, nombre FROM personas WHERE id_cliente = '$id_cliente' AND nombre LIKE '%$nombres%' LIMIT 1");
    while ($result = mysqli_fetch_assoc($busca)) {
      echo '<a href="#" onclick="select(' . $result["id"] . ')">' . $result["nombre"] . '</a>';
    }
    ?>

<?php
mysqli_close($con);
?>
<script type="text/javascript">
function select(valor){
  var url = "usuario.php?id=" + valor; // El script a dónde se realizará la petición.
  $.ajax({
     url: url,
     dataType: "json",
     beforeSend: function () {
     },
     success: function(data) {
       $("#nuser").val(data.nombre);
       $("#colonia").val(data.colonia);
       $("#calle").val(data.calle);
       $("#numero").val(data.numero);
       $("#telefono").val(data.telefono);
       $("#Correo").val(data.correo);
       $("#repetido").val(data.id);

     }, error:  function(data){
     }
  });
}

</script>
</a>
