<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WMS DE MÉXICO</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/notify.css">
</head>
<body>
        <!-- Left Panel -->
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="menu.php">WMS</a>
                    <a class="navbar-brand hidden" href="menu.php">WMS</a>
                </div>
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                      <li class="active">
                          <a href="#">Bienvenido </a>
                      </li>
                      <h3 class="menu-title">Menu</h3>
                      <?php include_once"menus.php"; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </aside><!-- /#left-panel -->
    <!-- Left Panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
          <div class="header-menu">
              <div class="col-sm-7">
                  <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                  <div class="header-left">
                      <div class="form-inline">
                          <form class="search-form">
                              <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                              <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                          </form>
                      </div>
                      <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-bell"></i>
                          <span class="count bg-danger">0</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                          <p class="red">Notificaciones</p>
                          <a class="dropdown-item media" href="#">
                              <i class="fa fa-check"></i>
                              <p>Prueba de notificacion</p>
                          </a>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-5">
                  <div class="user-area dropdown float-right">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php echo $resultado["Nombre"]; ?>
                      </a>
                      <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="salir.php"><i class="fa fa-power -off"></i>Cerrar sesión</a>
                      </div>
                  </div>
              </div>
          </div>
        </header><!-- /header -->
        <!-- Header-->
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Vehículos</strong> <button type="button" name="button" class="btn btn-warning" onclick="window.location='advehiculo.php'">Agregar</button>
                        </div>
                        <div class="card-body">
                          <table id="tabla" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th>Kilometraje</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $busca = mysqli_query($con, "SELECT * FROM Autos WHERE id_cliente = '$id_cliente'");
                              while ($result = mysqli_fetch_assoc($busca)) {
                                $auto = $result["id"];
                                echo '<tr>
                                  <td>' . $result["Nombre"] . '</td>';
                                  $buscakm = mysqli_query($con, "SELECT * FROM kilometrajes WHERE id_auto = '$auto'");
                                  echo '<td>' . $result["km"] .'</td>';
                                echo '</tr>';
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    <br><br><br>
    <!-- Right Panel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>
    <script src="assets/js/notify.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
    <?php include_once"footer.php"; ?>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#tabla').DataTable( {

                          dom: 'Bfrtip',
                          buttons: [

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


</body>
</html>

<?php
mysqli_close($con);
?>
