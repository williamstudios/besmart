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
if (!empty($_SESSION["admin"])) {
  $elusuario = $_SESSION["admin"];
?>

<li>
<a href="menu.php"><i class="fa fa-window-maximize" aria-hidden="true"></i> Inicio </a>
</li>
<?php
$bmenu = mysqli_query($con, "SELECT * FROM Menus");
while ($rmenu = mysqli_fetch_assoc($bmenu)) {
$iddepa = $rmenu["id"];
if ($rmenu["tipo"] == 1) {
?>
<li>
<a href="<?php echo $rmenu["url"]; ?>"><i class="<?php echo $rmenu["icono"]; ?>" aria-hidden="true"></i> <?php echo $rmenu["Nombre"]; ?> </a>
</li>
<?php
}else {
?>

<li class="menu-item-has-children dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="<?php echo $rmenu["icono"]; ?>" aria-hidden="true"></i> <?php echo $rmenu["Nombre"]; ?></a>
    <ul class="sub-menu children dropdown-menu">
        <?php
        $bsubmenu = mysqli_query($con, "SELECT * FROM submenus WHERE id_departamento = '$iddepa'");
        while ($rsubmenu = mysqli_fetch_assoc($bsubmenu)) {
        ?>
        <li><a href="<?php echo $rsubmenu["url"]; ?>"><i class="<?php echo $rsubmenu["icono"]; ?>" aria-hidden="true"></i> <?php echo $rsubmenu["Nombre"]; ?></a></li>
        <?php
        }
        ?>
    </ul>
</li>

<?php
}
}
?>
<?php

} else {
  echo '<li>
  <a href="menu.php"><i class="fa fa-window-maximize" aria-hidden="true"></i> Inicio </a>
  </li>';
  $usuario = $_SESSION["usuario"];


  $bmenu = mysqli_query($con, "SELECT lig.Departamento, lig.id_usuario, menus.id, menus.Nombre, menus.tipo, menus.icono, menus.url FROM menus_ligados AS lig INNER JOIN Menus AS menus ON lig.Departamento = menus.id WHERE lig.id_usuario = '$usuario'");
  while ($rmenu = mysqli_fetch_assoc($bmenu)) {
    $iddepa = $rmenu["Departamento"];
    if ($rmenu["tipo"] == 1) {
  ?>
    <li>
    <a href="<?php echo $rmenu["url"]; ?>"><i class="<?php echo $rmenu["icono"]; ?>" aria-hidden="true"></i> <?php echo $rmenu["Nombre"]; ?> </a>
    </li>
  <?php
    } else {
  ?>
  <li class="menu-item-has-children dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="<?php echo $rmenu["icono"]; ?>" aria-hidden="true"></i> <?php echo $rmenu["Nombre"]; ?></a>
      <ul class="sub-menu children dropdown-menu">
          <?php
          $bsubmenu = mysqli_query($con, "SELECT * FROM submenus WHERE id_departamento = '$iddepa'");
          while ($rsubmenu = mysqli_fetch_assoc($bsubmenu)) {
          ?>
          <li><a href="<?php echo $rsubmenu["url"]; ?>"><i class="<?php echo $rsubmenu["icono"]; ?>" aria-hidden="true"></i> <?php echo $rsubmenu["Nombre"]; ?></a></li>
          <?php
          }
          ?>
      </ul>
  </li>
  <?php
    }
  }
}
?>
<li>
<a href="salir.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Salir </a>
</li>
