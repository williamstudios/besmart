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
          <div class="col-md-12">
            <form action="greporte.php" method="post">
            <div class="card">
              <div class="card-header"><strong>Nueva peticion</strong><small></small></div>
              <div class="card-body card-block">
                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class="typeahead form-control-label">Nombre completo</label>
                  <input class="form-control" type="text" name="nom" id="nuser" placeholder="Nombre" onkeypress="buscando(this.value)" required>
                  <script type="text/javascript">
                    function buscando(valor){
                      if (valor.length > 3) {
                      var url = "repeticiones.php?nombre=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {
                          $("#tablas").html("<h3>Buscando similares...</h3>");
                         },
                         success: function(data) {
                          $("#tablas").html(data);
                         }, error:  function(data){
                          $("#tablas").html("<h3>Ocurrio al buscar</h3>");
                         }
                      });
                      }
                    }
                  </script>
                </div>
                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class=" form-control-label">Colonia</label>
                  <input class="form-control" type="text" name="Colonia" id="apepat" placeholder="Colonia" required>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Calle</label>
                  <input class="form-control" type="text" name="calle" id="apemat" placeholder="Calle" required>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Numero</label>
                  <input class="form-control" type="text" name="numero" id="mail" placeholder="Numero" >
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Telefono</label>
                  <input class="form-control" type="text" name="telefono" id="mail" placeholder="Telefono" required>
                </div>
                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class=" form-control-label">Departamento</label>
                  <select class="form-control select2" name="departamento">
                    <option value="">Seleccionar</option>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class=" form-control-label">Usuario</label>
                  <select class="form-control select2" name="usuario">
                    <option value="">Seleccionar</option>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-12">
                  <label for="company" class=" form-control-label">Descripcion de reporte</label>
                  <textarea name="reporte" rows="2" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12 col-lg-12" id="tablas">

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
    <script src="typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
      <script src="select2/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          ComponentsTypeahead.init();
          $('#tabla').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });
          $(".select2").select2();
        });
        var ComponentsTypeahead = function () {

            var handleTwitterTypeahead = function() {

        			var custom = new Bloodhound({
        				datumTokenizer: function(d) { return d.tokens; },
        				queryTokenizer: Bloodhound.tokenizers.whitespace,
        				remote: {
        					url: 'procesas/articles-json.asp?query=%QUERY',
        					wildcard: '%QUERY'
        				}
        				//remote: 'comboPartNum-json.asp?query='+ document.getElementById('NumeroParte').value
        			});
              var cons1 = "";
        			$('#nuser').typeahead({minLength: 2, highlight: true}, {
        				name: 'datypeahead_nuser',
        				limit: 100,
        				//minLength: 3,
        				displayKey: 'Descripcion',
        				//display: 'value',
        				source: custom,
        				hint: (App.isRTL() ? false : true),
        				templates: {
        					suggestion: Handlebars.compile([
        						'<table width="100%">',
        							'<tr>',
        								'<td width="10%" align="left"><img src="{{Imagen}}" width="80" height=""/></th>',
        								'<td width="80%" align="left" style="padding:10px;">{{Descripcion}}</th>',
        								'<td width="10%" align="right" style="padding:10px;">{{Cantidad}}</th>',
        							'</tr>',
        						'</table>',
        					].join(''))
        				}
        			}).on('typeahead:selected', function(event, selection) {
                var FechaIni = document.getElementById("FechaIni").value;
                var FechaFin = document.getElementById("FechaFin").value;

                var FechaIni2 = document.getElementById("FechaIni2").value;
                var FechaFin2 = document.getElementById("FechaFin2").value;

                var FechaIni3 = document.getElementById("FechaIni3").value;
                var FechaFin3 = document.getElementById("FechaFin3").value;
                var url = 'procesas/consumo.asp?ArticuloID='+ selection.Id +'&FechaIni='+ FechaIni + '&FechaFin=' + FechaFin + '&FechaIni2='+ FechaIni2 + '&FechaFin2=' + FechaFin2 +'&FechaIni3='+ FechaIni3 + '&FechaFin3=' + FechaFin3;
                  $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    beforeSend: function () {
                      $("#main").html("Buscando...");
                    },
                      success: function(data) {
                      var respuesta = [];
                      $.each( data, function( key, val ) {
                        respuesta.push(val);
                      });
                      var newdiv = document.createElement('tr');
                      newdiv.setAttribute("id", "tr" + contador);
                      newdiv.innerHTML = '<td><a href="#" onclick="elimina(' + contador + ')"><i class="fa fa-close"></i></a></td><td>'+ selection.Clave +'</td><td>'+ selection.NumeroParte +'</td><td>'+ selection.Descripcion +'</td><td>'+ selection.minimo +'</td><td>'+ selection.maximo +'</td><td>'+ selection.Cantidad +'</td><td><input type="hidden" id="valor'+ contador +'" value="' + selection.moq + '">'+ selection.moq +'</td><td>'+ selection.Lead_Time +'</td><td>'+ selection.Clasificacion +'</td><td><input type="hidden" name="art'+ contador +'" value="' + selection.Id + '"><input type="text" name="cant'+ contador +'" value="0" id="cant'+ contador +'" onkeyup="totales('+ contador +')"></td><td><input type="hidden" name="HiCantidad'+ contador +'" id="HiCantidad'+ contador +'" value=""><span id="total'+ contador +'">0</span></td><td><input type="hidden" name="comsumo1'+ contador +'" id="comsumo1'+ contador +'" value="'+ respuesta[0] +'"><span id="tcomsumo1'+ contador +'">' + respuesta[0] + '</span></td><td><input type="hidden" name="comsumo2'+ contador +'" id="comsumo2'+ contador +'" value="' + respuesta[1] +'"><span id="tcomsumo2'+ contador +'">' + respuesta[1] +'</span></td><td><input type="hidden" name="comsumo3'+ contador +'" id="comsumo3'+ contador +'" value="' + respuesta[2] + '"><span id="tcomsumo3'+ contador +'">' + respuesta[2] +'</span></td>';
                      $("#result").append(newdiv);
                      $(".result").show();
                      $("#cantarts").val(contador);
                      contador++;
                      real++;
                    }, error: function(result) {
                      alert(result.error)
                    }
                 });

        				// clearing the selection requires a typeahead method
        				//$(this).typeahead('setQuery', '');
        			});
        		}

            return {
                //main function to initiate the module
                init: function () {
                    handleTwitterTypeahead();
                }
            };

        }();

    </script>


</body>
</html>
<?php
mysqli_close($con);
?>
