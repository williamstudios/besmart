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
            <form action="gorden.php" method="post">
            <div class="card">
              <div class="card-header"><strong>Nueva orden de compra</strong><small></small></div>
              <div class="card-body card-block">
                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class="typeahead form-control-label">Proveedor</label>
                  <div class="autocomplete">
                    <select class="form-control" name="proveedor" required>
                      <option value="">Seleccionar</option>
                      <?php
                      $depas = mysqli_query($con, "SELECT id, nombre FROM proveedores WHERE id_cliente = '$id_cliente' ORDER BY nombre ASC");
                      while ($rdepas = mysqli_fetch_assoc($depas)) {
                        echo '<option value="' . $rdepas["id"] .'">' . $rdepas["nombre"] .'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class=" form-control-label">Fecha requerida</label>
                  <input class="form-control" type="date" name="fechasolicitada" required>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Almacen</label>
                  <select class="form-control" name="almacen" onchange="selectalma(this.value)" required>
                    <option value="">Seleccionar</option>
                    <?php
                    if (!empty($_SESSION["admin"])) {
                      $depas = mysqli_query($con, "SELECT id, Nombre FROM Almacenes WHERE id_cliente = '$id_cliente' ORDER BY nombre ASC");
                    } else {
                      $idusuario = $_SESSION["usuario"];
                      $eluser = mysqli_query($con, "SELECT Departamento FROM Usuarios_APP WHERE id = '$idusuario'");
                      $ruser = mysqli_fetch_assoc($eluser);
                      $depuser = $ruser["Departamento"];
                      $depas = mysqli_query($con, "SELECT id, Nombre FROM Almacenes WHERE id_cliente = '$id_cliente' AND Departamento = '$depuser' ORDER BY nombre ASC");
                    }
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Autoriza</label>
                  <select class="form-control" name="autoriz" required>
                    <option value="">Seleccionar</option>
                    <?php
                    if (!empty($_SESSION["admin"])) {
                      $depas = mysqli_query($con, "SELECT id, Nombre FROM Usuarios_APP WHERE id_cliente = '$id_cliente' AND auth = 1 ORDER BY nombre ASC");
                    } else {
                      $depas = mysqli_query($con, "SELECT id, Nombre FROM Usuarios_APP WHERE id_cliente = '$id_cliente' AND Departamento = '$depuser' AND auth = 1 ORDER BY nombre ASC");
                    }
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Recibe</label>
                  <select class="form-control" name="recibe" required>
                    <option value="">Seleccionar</option>
                    <?php
                    if (!empty($_SESSION["admin"])) {
                      $depas = mysqli_query($con, "SELECT id, Nombre FROM Usuarios_APP WHERE id_cliente = '$id_cliente' ORDER BY nombre ASC");
                    } else {
                      $depas = mysqli_query($con, "SELECT id, Nombre FROM Usuarios_APP WHERE id_cliente = '$id_cliente' AND Departamento = '$depuser' ORDER BY nombre ASC");
                    }
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-8">
                  <div class="row">
                    <div class="col-md-6" id="tdart">
                      <label for="company" class=" form-control-label">Agregar articulos</label>
                      <select class="form-control" name="articulo" id="elart">
                       <option value="">Seleccionar</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <button type="button" name="button" class="btn btn-info" onclick="addart()" style="margin-top:32px;">Agregar</button>
                    </div>
                  </div>


                  <script type="text/javascript">
                    var subtotal = 0;
                    var iva = 0;
                    var total = 0;
                    function selectalma(value){
                      var url = "barticulos.php?id=" + value; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                           $("#tdart").html(data);
                         }, error:  function(data){
                           alert("Ocurrio un error al cargar lo articulos");
                         }
                      });
                    }
                    var contador = 0;
                    function addart(){
                      var value = document.getElementById("elart").value;
                      var url = "barticle.php?id=" + value; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         dataType: "json",
                         beforeSend: function () {

                         },
                         success: function(data) {
                           var newdiv = document.createElement('tr');
                           newdiv.setAttribute("id", "tr" + contador);
                           newdiv.innerHTML = '<td><a href="#" onclick="elimina('+ contador +')" ><i class="fa fa-window-close-o" aria-hidden="true"></i></td><td><input type="hidden" name="art'+contador+'" value="' + data.idart + '">'+ data.namea +'</td><td>'+ data.parte +'</td><td><input type="number" name="cant'+ contador +'" value="1" step="any" onchange="cambiacant(this.value, '+ contador +')"></td><td>'+ data.price +'</td><td id="price'+ contador +'"></td>';
                           document.getElementById("arts").appendChild(newdiv);
                           contador++;
                           subtotal = parseFloat(subtotal) + parseFloat(data.price);
                           var valiva = document.getElementById("iva").value;
                           iva = (subtotal * valiva) / 100;
                           total = parseFloat(subtotal) + parseFloat(iva);
                           $("#elsubtotal").html("$" + subtotal.toFixed(2));
                           $("#eliva").html("$" + iva.toFixed(2));
                           $("#eltotal").html("$" + total.toFixed(2));
                         }, error:  function(data){
                           alert("Ocurrio un error al cargar lo articulos");
                         }
                      });
                    }

                    function elimina(valor){
                      $("#tr" + valor).remove()
                    }
                  </script>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">IVA</label>
                  <input class="form-control" type="number" name="iva" id="iva" placeholder="IVA" required value="16">
                </div>


                <div class="form-group col-md-12 col-lg-12">
                  <table class="table" id="arts">
                    <tr>
                      <th></th>
                      <th>Articulo</th>
                      <th>No. Parte</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total</th>
                    </tr>
                  </table>
                  <table style="width:100%">
                    <tr align="right">
                      <td align="right">Subtotal: <span id="elsubtotal"></span> </td>
                    </tr>
                    <tr align="right">
                      <td align="right">Iva: <span id="eliva"></span> </td>
                    </tr>
                    <tr align="right">
                      <td align="right">Total: <span id="eltotal"></span> </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="fa fa-dot-circle-o"></i> Guardar
                </button>
              </div>
            </div>
            </form>
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
