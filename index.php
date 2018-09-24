<?php
include_once"conect.php";
session_start();

if (!empty($_SESSION["user"])) {
  header ("location: menu.php");
}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WMS</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/notify.css">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/notify.css">

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        WMS DE MÉXICO
                    </a>
                </div>
                <div class="login-form">
                    <form method="post" action="login.php" id="normal">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" placeholder="Email" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" placeholder="Password" name="pass" required>
                        </div>
                        <div class="checkbox">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Entrar</button>
                        <a href="#" onclick="recordarr()">Recordar contraseña</a>
                    </form>
                    <form method="post" action="reenviar.php" id="recor" style="display:none;">
                        <div class="form-group">
                            <label>Por favor coloca tu correo para enviar la contraseña</label>
                            <input type="email" class="form-control" placeholder="Email" name="Correo" required>
                        </div>

                        <div class="checkbox">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Enviar</button>
                        <a href="#" onclick="cancelarr()">Cancelar </a>
                    </form>

                </div>
            </div>
        </div>
    </div>


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
    <?php include_once"footer.php"; ?>
    <script type="text/javascript">
      function recordarr(){
        document.getElementById("normal").style.display = 'none';
        document.getElementById("recor").style.display = 'block';
      }

      function cancelarr(){
        document.getElementById("normal").style.display = 'block';
        document.getElementById("recor").style.display = 'none';
      }

    </script>
</body>
</html>
