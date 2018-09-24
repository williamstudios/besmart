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

            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-md-3">
                              <strong class="card-title">Estatus de peticiónes</strong>
                            </div>
                            <div class="col-md-3">
                              <input type="text" name="" value="" class="form-control" placeholder="Folio" id="folio">
                            </div>
                            <div class="col-md-3">
                              <button type="button" name="button" class="btn btn-info" onclick="folio()" data-toggle="modal" data-target="#largeModal2">Buscar</button>
                              <script type="text/javascript">
                                function folio(){
                                  var folio = document.getElementById('folio').value;
                                  if(folio == ""){
                                    $(".modal-body").html("");
                                  } else {
                                    buscando2(folio);
                                  }
                                }
                              </script>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pendientes</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Asignadas</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Terminadas</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-finis" role="tab" aria-controls="nav-contact" aria-selected="false">No trabajados</a>
                            </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                              <table id="tabla" class="tabla table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>id</th>
                                    <th>Descripción</th>
                                    <th>Departamento</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estatus</th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $busca = mysqli_query($con, "SELECT pet.*, depa.Nombre AS depar FROM peticiones AS pet INNER JOIN Departamentos AS depa ON pet.departamento_asignado = depa.id WHERE pet.id_cliente = '$id_cliente' AND pet.status = 1 ORDER BY pet.id DESC LIMIT 150");
                                  while ($result = mysqli_fetch_assoc($busca)) {
                                    if ($result["status"] == 1) {
                                      $stat = '<span class="badge badge-primary">Pendiente</span>';
                                    } elseif ($result["status"] == 2) {
                                      $stat = '<span class="badge badge-success">Asignado</span>';
                                    } elseif ($result["status"] == 3) {
                                      $stat = '<span class="badge badge-light">Terminado</span>';
                                    } elseif ($result["status"] == 4) {
                                      $stat = '<span class="badge badge-info">Trabajando</span>';
                                    } elseif ($result["status"] ==5) {
                                      $stat = '<span class="badge badge-danger">No trabajado</span>';
                                    }
                                    echo '<tr>
                                     <td>' . $result["id"] .'</td>
                                     <td>' . $result["Descripcion"] .'</td>
                                     <td>' . $result["depar"] .'</td>
                                     <td>' . $result["fecha_crea"] .'</td>
                                     <td>' . $result["hora_crea"] .'</td>
                                     <td>' . $stat .'</td>
                                     <td> <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#largeModal" onclick="buscando('. $result["id"] .')"><i class="fa fa-check-circle" aria-hidden="true"></i></button> </td>
                                     <td> <button type="button" name="button" class="btn btn-danger" onclick="eliminarlo('. $result["id"] .')"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                    </tr>';
                                  }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                              <table id="tabla" class="tabla table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>id</th>
                                    <th>Descripción</th>
                                    <th>Departamento</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estatus</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $busca = mysqli_query($con, "SELECT pet.*, depa.Nombre AS depar FROM peticiones AS pet INNER JOIN Departamentos AS depa ON pet.departamento_asignado = depa.id WHERE pet.id_cliente = '$id_cliente' AND (pet.status = 2 OR pet.status = 4)  ORDER BY pet.id DESC LIMIT 150");
                                  while ($result = mysqli_fetch_assoc($busca)) {
                                    if ($result["status"] == 1) {
                                      $stat = '<span class="badge badge-primary">Pendiente</span>';
                                    } elseif ($result["status"] == 2) {
                                      $stat = '<span class="badge badge-success">Asignado</span>';
                                    } elseif ($result["status"] == 3) {
                                      $stat = '<span class="badge badge-light">Terminado</span>';
                                    } elseif ($result["status"] == 4) {
                                      $stat = '<span class="badge badge-info">Trabajando</span>';
                                    } elseif ($result["status"] ==5) {
                                      $stat = '<span class="badge badge-danger">Trabajando</span>';
                                    }
                                    echo '<tr>
                                     <td>' . $result["id"] .'</td>
                                     <td>' . $result["Descripcion"] .'</td>
                                     <td>' . $result["depar"] .'</td>
                                     <td>' . $result["fecha_crea"] .'</td>
                                     <td>' . $result["hora_crea"] .'</td>
                                     <td>' . $stat .'</td>
                                     <td> <button type="button" name="button" class="btn btn-rimary" data-toggle="modal" data-target="#fotosmodal" onclick="buscandof('. $result["id"] .')"><i class="fa fa-camera" aria-hidden="true"></i></button> </td>
                                     <td> <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#largeModal2" onclick="buscando2('. $result["id"] .')"><i class="fa fa-eye" aria-hidden="true"></i></button> </td>
                                     <td> <button type="button" name="button" class="btn btn-danger" onclick="eliminarlo('. $result["id"] .')"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                    </tr>';
                                  }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                              <table id="tabla" class="tabla table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>id</th>
                                    <th>Descripción</th>
                                    <th>Departamento</th>
                                    <th>Tiempo total</th>
                                    <th>Estatus</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $busca = mysqli_query($con, "SELECT pet.*, depa.Nombre AS depar FROM peticiones AS pet INNER JOIN Departamentos AS depa ON pet.departamento_asignado = depa.id WHERE pet.id_cliente = '$id_cliente' AND pet.status = 3 ORDER BY pet.id DESC LIMIT 150");
                                  while ($result = mysqli_fetch_assoc($busca)) {
                                    if ($result["status"] == 1) {
                                      $stat = '<span class="badge badge-primary">Pendiente</span>';
                                    } elseif ($result["status"] == 2) {
                                      $stat = '<span class="badge badge-success">Asignado</span>';
                                    } elseif ($result["status"] == 3) {
                                      $stat = '<span class="badge badge-light">Terminado</span>';
                                    } elseif ($result["status"] == 4) {
                                      $stat = '<span class="badge badge-info">Trabajando</span>';
                                    } elseif ($result["status"] ==5) {
                                      $stat = '<span class="badge badge-danger">Trabajando</span>';
                                    }
                                    $fecha1 = new DateTime($result["fecha_crea"] . ' ' .  $result["hora_crea"]);
                                    $fecha2 = new DateTime($result["fecha_cierre"] . ' ' .  $result["hora_cierre"]);
                                    $fecha = $fecha1->diff($fecha2);
                                    $tiempo = "";

                                    //años
                                    if($fecha->y > 0)
                                    {
                                        $tiempo .= $fecha->y;

                                        if($fecha->y == 1)
                                            $tiempo .= " año, ";
                                        else
                                            $tiempo .= " años, ";
                                    }

                                    //meses
                                    if($fecha->m > 0)
                                    {
                                        $tiempo .= $fecha->m;

                                        if($fecha->m == 1)
                                            $tiempo .= " mes, ";
                                        else
                                            $tiempo .= " meses, ";
                                    }

                                    //dias
                                    if($fecha->d > 0)
                                    {
                                        $tiempo .= $fecha->d;

                                        if($fecha->d == 1)
                                            $tiempo .= " día, ";
                                        else
                                            $tiempo .= " días, ";
                                    }

                                    //horas
                                    if($fecha->h > 0)
                                    {
                                        $tiempo .= $fecha->h;

                                        if($fecha->h == 1)
                                            $tiempo .= " hora, ";
                                        else
                                            $tiempo .= " horas, ";
                                    }

                                    //minutos
                                    if($fecha->i > 0)
                                    {
                                        $tiempo .= $fecha->i;

                                        if($fecha->i == 1)
                                            $tiempo .= " minuto";
                                        else
                                            $tiempo .= " minutos";
                                    }
                                    else if($fecha->i == 0) //segundos
                                    $tiempo .= $fecha->s." segundos";

                                    echo '<tr>
                                     <td>' . $result["id"] .'</td>
                                     <td>' . $result["Descripcion"] .'</td>
                                     <td>' . $result["depar"] .'</td>
                                     <td>' . $tiempo .'</td>
                                     <td>' . $stat .'</td>
                                     <td> <button type="button" name="button" class="btn btn-rimary" data-toggle="modal" data-target="#fotosmodal" onclick="buscandof('. $result["id"] .')"><i class="fa fa-camera" aria-hidden="true"></i></button> </td>
                                     <td> <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#largeModal2" onclick="buscando2('. $result["id"] .')"><i class="fa fa-eye" aria-hidden="true"></i></button> </td>
                                     <td> <button type="button" name="button" class="btn btn-danger" onclick="eliminarlo('. $result["id"] .')"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                    </tr>';
                                  }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane fade" id="nav-finis" role="tabpanel" aria-labelledby="nav-contact-tab">
                              <table id="tabla" class="tabla table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>id</th>
                                    <th>Descripción</th>
                                    <th>Departamento</th>
                                    <th>Tiempo total</th>
                                    <th>Estatus</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $busca = mysqli_query($con, "SELECT pet.*, depa.Nombre AS depar FROM peticiones AS pet INNER JOIN Departamentos AS depa ON pet.departamento_asignado = depa.id WHERE pet.id_cliente = '$id_cliente' AND pet.status = 5 ORDER BY pet.id DESC LIMIT 150");
                                  while ($result = mysqli_fetch_assoc($busca)) {
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

                                    $fecha1 = new DateTime($result["fecha_crea"] . ' ' .  $result["hora_crea"]);
                                    $fecha2 = new DateTime($result["fecha_cierre"] . ' ' .  $result["hora_cierre"]);
                                    $fecha = $fecha1->diff($fecha2);
                                    $tiempo = "";

                                    //años
                                    if($fecha->y > 0)
                                    {
                                        $tiempo .= $fecha->y;

                                        if($fecha->y == 1)
                                            $tiempo .= " año, ";
                                        else
                                            $tiempo .= " años, ";
                                    }

                                    //meses
                                    if($fecha->m > 0)
                                    {
                                        $tiempo .= $fecha->m;

                                        if($fecha->m == 1)
                                            $tiempo .= " mes, ";
                                        else
                                            $tiempo .= " meses, ";
                                    }

                                    //dias
                                    if($fecha->d > 0)
                                    {
                                        $tiempo .= $fecha->d;

                                        if($fecha->d == 1)
                                            $tiempo .= " día, ";
                                        else
                                            $tiempo .= " días, ";
                                    }

                                    //horas
                                    if($fecha->h > 0)
                                    {
                                        $tiempo .= $fecha->h;

                                        if($fecha->h == 1)
                                            $tiempo .= " hora, ";
                                        else
                                            $tiempo .= " horas, ";
                                    }

                                    //minutos
                                    if($fecha->i > 0)
                                    {
                                        $tiempo .= $fecha->i;

                                        if($fecha->i == 1)
                                            $tiempo .= " minuto";
                                        else
                                            $tiempo .= " minutos";
                                    }
                                    else if($fecha->i == 0) //segundos
                                    $tiempo .= $fecha->s." segundos";
                                    echo '<tr>
                                     <td>' . $result["id"] .'</td>
                                     <td>' . $result["Descripcion"] .'</td>
                                     <td>' . $result["depar"] .'</td>
                                     <td>' . $tiempo .'</td>
                                     <td>' . $stat .'</td>
                                     <td> <button type="button" name="button" class="btn btn-rimary" data-toggle="modal" data-target="#fotosmodal" onclick="buscandof('. $result["id"] .')"><i class="fa fa-camera" aria-hidden="true"></i></button> </td>
                                     <td> <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#largeModal2" onclick="buscando2('. $result["id"] .')"><i class="fa fa-eye" aria-hidden="true"></i></button> </td>
                                     <td> <button type="button" name="button" class="btn btn-danger" onclick="eliminarlo('. $result["id"] .')"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                    </tr>';
                                  }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <script type="text/javascript">
                            function eliminarlo(id){
                              var txt;
                              var r = confirm("Deseas eliminar la petición " + id + "?");
                              if (r == true) {
                                window.location="elimina.php?id=" + id;
                              } else {

                              }
                            }
                          </script>
                          <script type="text/javascript">
                           var petprint = 0;
                            function buscando(valor){
                              petprint = valor;
                              var url = "bpeticion.php?id=" + valor; // El script a dónde se realizará la petición.
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
                              petprint = valor;
                              var url = "bpeticion2.php?id=" + valor; // El script a dónde se realizará la petición.
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
                              petprint = valor;
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
                        </div>
                    </div>
                </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

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
        $(document).ready(function() {
          $('.tabla').DataTable( {

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
    <script type="text/javascript">
      function printer(){
        window.open('print.php?id=' + petprint, 'Imprimir', 'width=600,height=700');
      }
    </script>
</body>
</html>
