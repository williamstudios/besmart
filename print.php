<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WMS DE MEXICO</title>
  </head>
  <body>
    <?php
    $id = addslashes($_GET["id"]);
      $busca = mysqli_query($con, "SELECT * FROM peticiones WHERE id = '$id'");
      while ($result = mysqli_fetch_assoc($busca)) {
    ?>
    <?php
    $cliente = mysqli_query($con, "SELECT * FROM Clientes WHERE id  = '$id_cliente'");
    $elcliente = mysqli_fetch_assoc($cliente);
    ?>
    <table style="width:100%;" cellspacing="0">
    <tr>
      <td>
        <img src="logos/<?php echo $elcliente["logo"]; ?>" alt="" style="height:90px;">
      </td>
      <td align="center" >
        <p><h1><?php echo $elcliente["Nombre"]; ?> </h1></p>
        <p><h3>Petición de servicio</h3></p>
      </td>
    </tr>

    </table>
    <br>
    <table style="width:100%;" >
      <tr>

        <td align="center" bgcolor="#999999" style="color:white; width:20%;" >Folio</td>
        <td align="center" bgcolor="#999999" style="color:white; width:20%;">Fecha</td>
          <td align="center" bgcolor="#999999" style="color:white; width:20%;">Estatus</td>
      </tr>
      <tr>

        <td align="center" valign="top" style="padding-bottom:0px;"><?php echo $result["id"]; ?></td>
        <td align="center" valign="top" style="padding-bottom:0px;"><?php echo $result["fecha_crea"] . ' ' . $result["hora_crea"]; ?></td>
        <?php
        if ($result["status"] == 1) {
          $stat = '<span class="badge badge-primary">Pendiente</span>';
        } elseif ($result["status"] == 2) {
          $stat = '<span class="badge badge-success">Asignado</span>';
        } elseif ($result["status"] == 3) {
          $stat = '<span class="badge badge-light">Terminado</span>';
        } elseif ($result["status"] == 4) {
          $stat = '<span class="badge badge-info">Trabajando</span>';
        } elseif ($result["status"] ==5) {
          $stat = '<span class="badge badge-danger">No Trabajado</span>';
        }
        ?>
          <td align="center"><?php echo $stat; ?></td>
      </tr>


    </table>
    <br><br>
    <table>
      <tr>
        <td bgcolor="#999999" style="color:white; width:40%;" colspan="3">
        Datos del cliente:
        </td>
      </tr>
      <tr>
        <td>
          Nombre: <?php echo $result["nombre"]; ?>
        </td>
        <td>
          Colonia: <?php echo $result["colonia"]; ?>
        </td>
        <td>
          Calle: <?php echo $result["calle"] . ' ' . $result["numero"]; ?>
        </td>
      </tr>
      <tr>
        <td>
          Teléfono: <?php echo $result["telefono"]; ?>
        </td>
        <td colspan="2">
          Correo: <?php echo $result["correo"]; ?>
        </td>

      </tr>
    </table>

    <br>
    <br>

    <table style="width:100%;" >
      <tr>
        <td bgcolor="#999999" style="color:white;">
        Reporte:
        </td>
      </tr>
      <tr>
        <td valign="top" style="border: 1px solid black; height:300px;">
             <?php echo $result["Descripcion"]; ?>
        </td>
      </tr>
    </table>

    <br>
    <br>

    <table style="width:100%;" cellspacing="0">
      <tr>
        <td align="center" bgcolor="#999999" style="color:white; width:45%" >Departamento</td>
        <td style="width:10%"></td>
        <td align="center" bgcolor="#999999" style="color:white;">Subdepartamento</td>
      </tr>
      <tr>
        <?php
        $idb = $result["main_dep"];
        $depa = mysqli_query($con, "SELECT Nombre FROM main_Departamentos WHERE id = '$idb'");
        $rdepas = mysqli_fetch_assoc($depa);
        ?>
       <td align="center" ><?php echo $rdepas["Nombre"]; ?></td>
       <td></td>
       <?php
       $idb = $result["departamento_asignado"];
       $depa = mysqli_query($con, "SELECT Nombre FROM Departamentos WHERE id = '$idb'");
       $rdepas = mysqli_fetch_assoc($depa);
       ?>
       <td align="center" ><?php echo $rdepas["Nombre"]; ?></td>
      </tr>
    </table>

    <br>
    <br>

    <table style="width:100%;" cellspacing="0">
      <tr>
        <td align="center" bgcolor="#999999" style="color:white; width:45%">Captura:</td>
        <td style="width:10%"></td>

        <td align="center" bgcolor="#999999" style="color:white;">Asignado a:</td>
      </tr>
      <tr>
        <?php
        $idb = $result["usuario_crea"];
        $depa = mysqli_query($con, "SELECT Nombre FROM Usuarios_APP WHERE id = '$idb'");
        $rdepas = mysqli_fetch_assoc($depa);
        ?>
       <td align="center" ><?php echo $rdepas["Nombre"]; ?></td>
       <td></td>
       <?php
       $idb = $result["usuario_asignado"];
       $depa = mysqli_query($con, "SELECT Nombre FROM Usuarios_APP WHERE id = '$idb'");
       $rdepas = mysqli_fetch_assoc($depa);
       ?>
       <td align="center" ><?php
       if ($idb > 0) {
         echo "Sin Asignar";
       } else {
         echo $rdepas["Nombre"];
       }

       ?></td>
      </tr>
    </table>
    <?php
      }
    ?>
  </body>
</html>
<style media="screen">
@media print {
body {-webkit-print-color-adjust: exact;}
}
</style>
<script type="text/javascript">
  window.print();
</script>
