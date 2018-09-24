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
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </a>

                        <div class="user-menu dropdown-menu">
                          <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Salir</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                      </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->



        <div class="content mt-3">
          <div class="col-lg-6">
            <form action="fallasave.php" method="post">

            <div class="card">
              <div class="card-header"><strong>Nueva Solicitud</strong><small></small></div>
              <div class="card-body card-block">
                <div class="form-group">
                  <label for="company" class=" form-control-label">Descripcion</label>
                  <input class="form-control" type="text" name="nom" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                  <label for="company" class=" form-control-label">Departamento</label>
                  <div class="row">
                    <div class="col-md-10" id="moddepa">
                      <select class="form-control select2" name="departamento">
                        <option value="">Seleccionar</option>
                        <?php
                        $depas = mysqli_query($con, "SELECT * FROM Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                        while ($rdepas = mysqli_fetch_assoc($depas)) {
                          echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#adddepa"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="fa fa-dot-circle-o"></i> Guardar
                </button>
              </div>
            </div>

            </form>
            <form class="" id="formdepa">
              <div class="modal fade" id="adddepa" tabindex="-1" role="dialog" aria-labelledby="adddepa" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Agregar departamento</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="company" class=" form-control-label">Nombre</label>
                        <input class="form-control" type="text" name="nom" id="nuser" placeholder="Nombre" required>
                      </div>
                      <div class="form-group">
                        <label for="company" class=" form-control-label">Presupuesto</label>
                        <input class="form-control" type="number" name="presupuesto" id="presupuesto" placeholder="Presupuesto" step="any" required>
                      </div>
                      <div class="form-group">
                        <label for="company" class=" form-control-label">Domicilio</label>
                        <textarea rows="2" class="form-control" name="domicilio" required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" onclick="fdepa()" id="antes">Guardar</button>
                      <button type="button" class="btn btn-primary" style="display:none;" id="despues"><i class="fa fa-spinner fa-spin"></i>Guardando..</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <script type="text/javascript">
              function fdepa(){
                var nomb = document.getElementById("nuser").value;
                if (nomb == "") {
                  alert("Por favor coloca un nombre al departamento");
                } else {
                  var url = "procesas/depsave.php"; // El script a dónde se realizará la petición.
                  $.ajax({
                     type: "POST",
                     url: url,
                     data: $("#formdepa").serialize(),
                     beforeSend: function () {
                       $("#antes").hide();
                       $("#despues").show();
                     },
                     success: function(data) {
                       $("#despues").hide();
                       $("#antes").show();
                       $("#moddepa").html(data);
                       $('#adddepa').modal('hide');
                       $(".modal-backdrop").remove();
                     }, error:  function(data){
                       $('#adddepa').modal('hide');
                       $("#despues").hide();
                       $("#antes").show();
                       $(".modal-backdrop").remove();
                       alert("Ocurrio un error al guardar");
                     }
                  });
                }

              }
            </script>
          </div>
        </div><!-- .content -->
    <br><br><br>
    <!-- Right Panel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
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

    <script type="text/javascript">
        $(document).ready(function() {
          $('#tabla').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });
        });
    </script>


</body>
</html>
<?php
mysqli_close($con);
?>
