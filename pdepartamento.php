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
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WMS DE MEXICO</title>
    <meta name="description" content="wms">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href="select2/select2.min.css" rel="stylesheet" media="all">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="assets/css/notify.css">
</head>
<body>
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

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Sistema de peticiónes de servicio</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
          <div class="col-md-4">
            <label for="">Departamento</label>
            <select class="form-control" name="" id="concepto">
              <option value="Todos">Todos</option>
              <?php
              $depas = mysqli_query($con, "SELECT * FROM main_Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
              while ($rdepas = mysqli_fetch_assoc($depas)) {
                echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label>Estatus</label>
            <select class="form-control" name="" id="tipo">
              <option value="todos">Todos</option>
              <option value="1">Pendientes</option>
              <option value="2">Asignados</option>
              <option value="4">Trabajando</option>
              <option value="3">Terminados</option>
              <option value="5">No trabajados</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>&nbsp; &nbsp;  </label>
            <button type="button" class="btn btn-info btn-block" name="button" onclick="busca()"><i class="fa fa-search" aria-hidden="true"></i> Buscar </button>
          </div>
          <div class="col-md-12 tablamain">

          </div>
        </div><!-- .content -->
        <script type="text/javascript">
          function busca(){
            var concepto = document.getElementById('concepto').value;
            var tipo = document.getElementById('tipo').value;
            var url = "reportedepartamento.php?concepto=" + concepto + "&tipo=" + tipo; // El script a dónde se realizará la petición.
            $.ajax({
               url: url,
               beforeSend: function () {
                 $(".tablamain").html("");
                 $(".tablamain").html("Cargando información");
               },
               success: function(data) {
                $(".tablamain").html(data);
               }, error:  function(data){
                $(".tablamain").html("Ocurrio un error al cargar");
               }
            });
          }
        </script>


        <div class="modal fade" id="fotosmodal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" style="display: none;" aria-hidden="true">
          <form class="" action="asignar.php" method="post">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Evidencia de trabajos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body bodymodal" id="body-modal">

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width:100%; height:100%;">
                <div class="carousel-inner">

                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
                </div>

              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
              </div>
          </div>
          </form>
        </div>
        <div class="modal fade" id="largeModal" role="dialog" aria-labelledby="largeModalLabel" style="display: none;" aria-hidden="true">
          <form class="" action="asignar.php" method="post">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Asignar petición</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body bodymodal1" id="body-modal">

                  Buscando información espere

              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Aceptar</button>
                  <button type="button" name="button" class="btn btn-rimary" onclick="printer()">Imprimir</button>
                </div>
              </div>
          </div>
          </form>
        </div>
        <div class="modal fade" id="largeModal2" role="dialog" aria-labelledby="largeModalLabel" style="display: none;" aria-hidden="true">
          <form class="" action="asignar2.php" method="post">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Información de petición</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body bodymodal2" id="body-modal">

                  Buscando información espere

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="reasignar">Reenviar</button>
                  <button type="button" name="button" class="btn btn-rimary" onclick="printer()">Imprimir</button>
              </div>
              </div>
          </div>
          </form>
        </div>
    <br><br><br>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

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
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/notify.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
    <script src="select2/select2.min.js"></script>

    <?php include_once"footer.php"; ?>
    <script type="text/javascript">
      function buscando(valor){
        var url = "bpeticion4.php?id=" + valor; // El script a dónde se realizará la petición.
        $.ajax({
           url: url,
           beforeSend: function () {
             $(".modal-body").html("");
             $(".bodymodal1").html("Cargando información");
           },
           success: function(data) {
            $(".bodymodal1").html(data);
           }, error:  function(data){
            $(".bodymodal1").html("");
           }
        });
      }

      function buscando2(valor){
        var url = "bpeticion3.php?id=" + valor; // El script a dónde se realizará la petición.
        $.ajax({
           url: url,
           beforeSend: function () {
             $(".modal-body").html("");
             $(".bodymodal2").html("Cargando información");
           },
           success: function(data) {
            $(".bodymodal2").html(data);
           }, error:  function(data){
            $(".bodymodal2").html("");
           }
        });
      }
      function buscandof(valor){
        var url = "bfotos.php?id=" + valor; // El script a dónde se realizará la petición.
        $.ajax({
           url: url,
           beforeSend: function () {
             $(".carousel-inner").html("Cargando información");
           },
           success: function(data) {
            $(".carousel-inner").html(data);
           }, error:  function(data){
            $(".carousel-inner").html("");
           }
        });
      }
    </script>
</body>
</html>
