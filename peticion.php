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
    <link rel="stylesheet" href="assets/css/notify.css">
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
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>

    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link href="select2/select2.min.css" rel="stylesheet" media="all">
    <link href="typeahead/typeahead.css" rel="stylesheet" type="text/css">

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
          <div class="col-md-12">
            <form action="greporte.php" method="post" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header"><strong>Nueva petición</strong><small></small></div>
              <div class="card-body card-block">
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class="typeahead form-control-label">Nombre completo</label>
                  <div class="autocomplete">
                    <input type="hidden" name="repetido" id="repetido" value="">
                    <input class="form-control" type="text" name="nom" id="nuser" placeholder="Nombre" onkeypress="buscando(this.value)" autocomplete="off" required>
                  </div>
                  <script type="text/javascript">
                    function buscando(valor){
                      if (valor.length > 1) {
                      var url = "repeticiones.php?nombre=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#tablas").html(data);
                         }, error:  function(data){
                          $("#tablas").html("");
                         }
                      });
                      $("#repetido").val("");
                      var url = "repeticion.php?nombre=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#nombres").html(data);
                         }, error:  function(data){
                          $("#nombres").html("");
                         }
                      });
                      }
                      if (valor == "") {
                        $("#tablas").html("");
                      }
                    }
                  </script>
                </div>

                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Colonia</label>
                  <input class="form-control" type="text" name="Colonia" id="colonia" placeholder="Colonia" autocomplete="off" onkeypress="buscando2(this.value)" required>
                  <script type="text/javascript">
                    function buscando2(valor){

                      if (valor.length > 1) {
                      var url = "repeticiones.php?colonia=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#tablas").html(data);
                         }, error:  function(data){
                          $("#tablas").html("");
                         }
                      });

                      }
                      if (valor == "") {
                        $("#tablas").html("");
                      }
                    }
                  </script>
                </div>

                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Calle</label>
                  <input class="form-control" type="text" name="calle" id="calle" placeholder="Calle" autocomplete="off" onkeypress="buscando3(this.value)" required>
                  <script type="text/javascript">
                    function buscando3(valor){

                      if (valor.length > 1) {
                      var url = "repeticiones.php?calle=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#tablas").html(data);
                         }, error:  function(data){
                          $("#tablas").html("");
                         }
                      });

                      }
                      if (valor == "") {
                        $("#tablas").html("");
                      }
                    }
                  </script>
                </div>
                <div class="form-group col-md-12 col-lg-12" id="nombres">

                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Número</label>
                  <input class="form-control" type="text" name="numero" id="numero" placeholder="Numero" >
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Celular</label>
                  <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Telefono" autocomplete="off" >
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Correo</label>
                  <input class="form-control" type="email" name="correo" id="Correo" placeholder="Correo" autocomplete="off" >
                </div>
                <div class="form-group col-lg-4 ">
                  <label for="company" class=" form-control-label">Departamento</label>
                  <div class="row">
                    <div class="col-md-10 moddepa2">
                      <select class="form-control" name="departamento" onchange="ocultar2(this.value)">
                        <option value="">Seleccionar</option>
                        <?php
                        $depas = mysqli_query($con, "SELECT * FROM main_Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                        while ($rdepas = mysqli_fetch_assoc($depas)) {
                          echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#addMAINdepa"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </div>
                <div class="form-group col-lg-4">
                  <label for="company" class=" form-control-label">Subdepartamendo</label>
                  <div class="row">
                    <div class="col-md-10 moddepa">
                      <select class="form-control" name="maindepartamento" onchange="ocultar(this.value)">
                        <option value="">Seleccionar</option>
                        <?php
                        $depas = mysqli_query($con, "SELECT * FROM Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                        while ($rdepas = mysqli_fetch_assoc($depas)) {
                          echo '<option value="' . $rdepas["id"] .'" class="sudep' . $rdepas["main_dep"] .' sudepas" style="display:none;">' . $rdepas["Nombre"] .'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#adddepa"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </div>
                <div class="form-group col-lg-4">
                  <label for="company" class=" form-control-label">Tipo de solicitud</label>
                  <div class="row">
                    <div class="col-md-10 almac">
                      <select class="form-control " name="usuario" required>
                        <option value="">Seleccionar</option>
                        <?php
                        $depas = mysqli_query($con, "SELECT id, NombreNombre, id_departamento FROM Fallas WHERE id_cliente = '$id_cliente' ORDER BY NombreNombre ASC");
                        while ($rdepas = mysqli_fetch_assoc($depas)) {
                          echo '<option value="' . $rdepas["id"] .'" class="dep' . $rdepas["id_departamento"] .' fallas" style="display:none;">' . $rdepas["NombreNombre"] .'</option>';
                        }
                        ?>
                      </select>
                      <script type="text/javascript">
                        function ocultar(valor) {
                          $(".fallas").hide();
                          $(".dep" + valor).show();
                        }
                        function ocultar2(valor) {
                          $(".sudepas").hide();
                          $(".sudep" + valor).show();
                        }
                      </script>
                    </div>
                    <div class="col-md-2">
                      <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#addalma"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <label>Cargar archivos</label>
                  <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">
                </div>
                <div class="col-md-4">
                  <label>Metodo</label>
                  <select class="form-control" name="metodo">
                    <option value="Telefono">Telefono</option>
                    <option value="Correo">Correo</option>
                    <option value="Personal">Personal</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Whatsapp">Whatsapp</option>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-12">
                  <label for="company" class=" form-control-label">Descripcion de reporte</label>
                  <textarea name="reporte" rows="2" class="form-control" required></textarea>
                </div>
                <div class="form-group col-md-12 col-lg-12" id="tablas">

                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm guardalo1" onclick="grep()">
                  <i class="fa fa-dot-circle-o " ></i> Guardar
                </button>
                <button type="button" class="btn btn-primary guardalo2" style="display:none;" ><i class="fa fa-spinner fa-spin"></i>Guardando..</button>
                <script type="text/javascript">
                  function grep(){
                    $(".guardalo1").hide();
                    $(".guardalo2").show();
                  }
                </script>
              </div>
            </div>
            </form>
            <form class="" id="formAINdepa">
              <div class="modal fade" id="addMAINdepa" tabindex="-1" role="dialog" aria-labelledby="adddepa" aria-hidden="true">
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
                        <input class="form-control" type="text" name="nom" id="ndepa2" placeholder="Nombre" required>
                      </div>
                      <div class="form-group">
                        <label for="company" class=" form-control-label">Presupuesto</label>
                        <input class="form-control" type="number" name="presupuesto" id="presupuesto" placeholder="Presupuesto" step="any" required="">
                      </div>
                      <div class="form-group">
                        <label for="company" class=" form-control-label">Domicilio</label>
                        <textarea rows="2" class="form-control" name="domicilio" required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" onclick="fdepa2()" id="antes1">Guardar</button>
                      <button type="button" class="btn btn-primary" style="display:none;" id="despues1"><i class="fa fa-spinner fa-spin"></i>Guardando..</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <script type="text/javascript">
            function fdepa2(){
              var nomb = document.getElementById("ndepa2").value;
              if (nomb == "") {
                alert("Por favor coloca un nombre al departamento");
              } else {
                var url = "procesas/maindepsave.php"; // El script a dónde se realizará la petición.
                $.ajax({
                   type: "POST",
                   url: url,
                   data: $("#formAINdepa").serialize(),
                   beforeSend: function () {
                     $("#antes1").hide();
                     $("#despues1").show();
                   },
                   success: function(data) {
                     $("#despues1").hide();
                     $("#antes1").show();
                     $(".moddepa2").html(data);
                     $('#addMAINdepa').modal('hide');
                     $(".modal-backdrop").remove();
                   }, error:  function(data){
                     $('#addMAINdepa').modal('hide');
                     $("#despues1").hide();
                     $("#antes1").show();
                     $(".modal-backdrop").remove();
                     alert("Ocurrio un error al guardar");
                   }
                });
              }

            }
            </script>
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
                        <input class="form-control" type="text" name="nom" id="ndepa" placeholder="Nombre" required>
                      </div>
                      <div class="form-group moddepa2" >
                        <label for="company" class=" form-control-label">Departamento</label>
                        <select class="form-control" name="departamento">
                          <option value="">Seleccionar</option>
                          <?php
                          $depas = mysqli_query($con, "SELECT * FROM main_Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                          while ($rdepas = mysqli_fetch_assoc($depas)) {
                            echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                          }
                          ?>
                        </select>
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
            <form class="" id="fomralma">
              <div class="modal fade" id="addalma" tabindex="-1" role="dialog" aria-labelledby="addalma" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Agregar tipo de solicitud</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="company" class=" form-control-label">Descripcion</label>
                        <input class="form-control" type="text" name="nom" placeholder="Nombre" id="nalma" required>
                      </div>
                      <div class="form-group moddepa" >
                        <label for="company" class=" form-control-label">Departamento</label>
                        <select class="form-control" name="departamento">
                          <option value="">Seleccionar</option>
                          <?php
                          $depas = mysqli_query($con, "SELECT * FROM Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                          while ($rdepas = mysqli_fetch_assoc($depas)) {
                            echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" onclick="falma()" id="antess">Guardar</button>
                      <button type="button" class="btn btn-primary" style="display:none;" id="despuess"><i class="fa fa-spinner fa-spin"></i>Guardando..</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <script type="text/javascript">
              function falma(){
                var nomb = document.getElementById("nalma").value;
                if (nomb == "") {
                  alert("Por favor coloca un nombre de almacén");
                } else {
                  var url = "procesas/fallasave.php"; // El script a dónde se realizará la petición.
                  $.ajax({
                     type: "POST",
                     url: url,
                     data: $("#fomralma").serialize(),
                     beforeSend: function () {
                       $("#antess").hide();
                       $("#despuess").show();
                     },
                     success: function(data) {
                       $("#despuess").hide();
                       $("#antess").show();
                       $(".almac").html(data);
                       $('#addalma').modal('hide');
                       $(".modal-backdrop").remove();
                     }, error:  function(data){
                       $('#addalma').modal('hide');
                       $("#despuess").hide();
                       $("#antess").show();
                       $(".modal-backdrop").remove();
                       alert("Ocurrio un error al guardar");
                     }
                  });
                }

              }

              function fdepa(){
                var nomb = document.getElementById("ndepa").value;
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
                       $(".moddepa").html(data);
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

              function buscando2(valor){
                var url = "bpeticion2.php?id=" + valor; // El script a dónde se realizará la petición.
                $.ajax({
                   url: url,
                   beforeSend: function () {
                   },
                   success: function(data) {
                    $(".bodymodal").html(data);
                   }, error:  function(data){
                    $(".bodymodal").html("");
                   }
                });
              }
            </script>
            <div class="modal fade" id="largeModal2" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" style="display: none;" aria-hidden="true">
              <form class="" action="asignar2.php" method="post">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Información de petición</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body bodymodal" id="body-modal">

                      Buscando información espere

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="reasignar">Reenviar</button>
                  </div>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div><!-- .content -->
    <br><br><br>
    <!-- Right Panel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>




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
    <script src="select2/select2.min.js"></script>
    <script src="assets/js/notify.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {


          $('#tabla').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });
          $(".select2").select2();


        });


    </script>


</body>
</html>
<?php include_once"footer.php"; ?>
<?php
mysqli_close($con);
?>
